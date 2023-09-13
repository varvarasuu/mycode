<?php

namespace App\Repositories\Api\Company\Requisites;

use App\Models\CompanyRekvisit;
use App\Services\Api\MediaFile\MediaFileService;
use Carbon\Carbon;

class EloquentRequisitesRepository implements RequisitesRepositoryInterface
{
    private $mediaFileService;

    public function __construct(MediaFileService $mediaFileService)
    {
        $this->mediaFileService = $mediaFileService;
    }
    public function getRequisites(int $company_id)
    {
        $company_files = CompanyRekvisit::where('company_id', '=', $company_id)->get();
        foreach($company_files as $file){
            $file->file = $this->mediaFileService->getImagePathAndFileName($file->file->file_path);
            $carbonDate = Carbon::parse($file->created_at);
            $unixTimestamp = $carbonDate->timestamp;
            $file->time_created = $unixTimestamp;
            $carbonDate = Carbon::parse($file->updated_at);
            $unixTimestamp = $carbonDate->timestamp;
            $file->time_updated = $unixTimestamp;
        }
        return $company_files;
    }

    public function create($data)
    {
        return CompanyRekvisit::create($data);
    }

    public function getRequisite(int $requisite_id)
    {
        $requisite = CompanyRekvisit::find($requisite_id);
        $requisite->file = $this->mediaFileService->getImagePathAndFileName($requisite->file->file_path);
        $carbonDate = Carbon::parse($requisite->created_at);
        $unixTimestamp = $carbonDate->timestamp;
        $requisite->time_created = $unixTimestamp;
        $carbonDate = Carbon::parse($requisite->updated_at);
        $unixTimestamp = $carbonDate->timestamp;
        $requisite->time_updated = $unixTimestamp;
        return $requisite;
    }

    public function getAllCompanyRequisites($company_id)
    {
        return CompanyRekvisit::where('company_id', $company_id)->get();
    }

    public function find($id)
    {
        return CompanyRekvisit::find($id);
    }

    public function delete($id)
    {
        return CompanyRekvisit::find($id)->delete();
    }
}
