<?php

namespace App\Services\Api\Company\Requisite;

use App\Models\CompanyRekvisit;
use App\Repositories\Api\Company\Requisites\EloquentRequisitesRepository;
use App\Services\Api\Account\AccountService;
use App\Services\Api\MediaFile\MediaFileService;

class RequisiteService implements RequisiteServiceInterface
{
    private $requisiteRepository;
    private $accountService;
    private $mediaFileService;
    private $folderEndPoint;

    public function __construct(EloquentRequisitesRepository $requisiteRepository, AccountService $accountService, MediaFileService $mediaFileService)
    {
        $this->requisiteRepository = $requisiteRepository;
        $this->accountService = $accountService;
        $this->mediaFileService = $mediaFileService;
        $this->folderEndPoint = 'uploads/company/rekvisites/';
    }

    public function addRequisites($request)
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        $folder_files = $this->folderEndPoint . $company_id;
        $company_files = $this->requisiteRepository->getAllCompanyRequisites($company_id);

        $files = $request->file('company_rekvisites');

        if ($request->hasFile('company_rekvisites') && $files && count($files) > 0) {
            $len_company_files = count($company_files);
            $len_files = count($files);

            for ($i = 0; $i < $len_files; $i++) {
                if ($i < $len_company_files) {
                    $this->updateMediaRequisite($company_files[$i], $files[$i], $folder_files);
                } else {
                    $this->createRequisites($files[$i], $folder_files, $company_id);
                }
            }
            for ($i = $len_files; $i < $len_company_files; $i++) {
                $this->deleteRequisite($company_files[$i]);
            }
        } else {
            $this->deleteAllRequisites($company_files, count($company_files));
        }
        return true;
    }

    public function getRequisites()
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        $company_files = $this->requisiteRepository->getRequisites($company_id);
        return $company_files;
    }

    private function createRequisites($file, $folder_files, $company_id)
    {
        $id_file = $this->mediaFileService->storeOne($file, $folder_files)->id;
        $data = $this->prepareDataForStore($id_file, $company_id);
        $this->requisiteRepository->create($data);
    }

    private function deleteAllRequisites($company_files, $len_company_files)
    {
        $i = 0;
        while ($i < $len_company_files) {
            $this->mediaFileService->delete($company_files[$i]->media_file_id);
            $company_files[$i]->delete();
            $i++;
        }
    }

    private function deleteRequisite($file)
    {
        $this->mediaFileService->delete($file->media_file_id);
        $this->requisiteRepository->delete($file->id);
    }

    private function updateMediaRequisite($company_file, $file, $folder)
    {
        $id_file = $this->mediaFileService->update($company_file->media_file_id, $file, $folder);
        $company_media_file = $this->requisiteRepository->find($company_file->id);
        $company_media_file->media_file_id = $id_file->id;
        $company_media_file->save();
    }

    private function prepareDataForStore($id_file, $company_id)
    {
        return [
            'media_file_id' => $id_file,
            'company_id' => $company_id
        ];
    }
}
