<?php

namespace App\Services\Api\Company\Offices;

use App\Models\Metro;
use App\Models\User;
use App\Repositories\Api\Company\Office\EloquentOfficeRepository;
use App\Repositories\Api\Metro\EloquentMetroRepository;
use App\Services\Api\Account\AccountService;
use App\Traits\NotificationTrait;

class OfficeService implements OfficeServiceInterface
{
    use NotificationTrait;
    private $accountService;
    private $officeRepository;
    private $metroRepository;

    public function __construct(
        AccountService $accountService,
        EloquentOfficeRepository $officeRepository,
        EloquentMetroRepository $metroRepository)
    {
        $this->accountService = $accountService;
        $this->officeRepository = $officeRepository;
        $this->metroRepository = $metroRepository;
    }

    public function prepareDataForAddOffice($request)
    {
        return [
            'company_id' => $this->accountService->getCurrentCompanyID(),
            'address' => htmlspecialchars($request->address),
            'lat' => $request->coordinate[0],
            'lng' => $request->coordinate[1],
            'account_id' => $this->accountService->getAccountId()
        ];
    }

    public function createOffice($request)
    {
        $data = $this->prepareDataForAddOffice($request);
        return $this->officeRepository->createOffice($data);
    }

    public function createOfficeMetro($request, $office)
    {
        $metros_all = $this->prepareDataForAddOfficeMetro($request);
        foreach ($metros_all as $metro) {
            $this->officeRepository->createOfficeMetro(['office_id' => $office->id, 'metro_id' => $metro->id]);
        }
        return $metros_all;
    }

    public function prepareDataForAddOfficeMetro($request)
    {
        $metros_all = [];
        if (isset($request->metro)  && !empty($request->metro)) {
            if (is_int($request->metro[0]["line"])) {
                foreach ($request->metro as $metro_name) {
                    $temp = $this->metroRepository->findMetroStationByCityAndStationName("Санкт-Петербург", $metro_name['name']);
                    if (isset($temp)) {
                        $metros_all[] = $temp;
                    }
                }
            } else {
                foreach ($request->metro as $metro_name) {
                    $wordToRemove = "линия";
                    $line_name = trim(str_replace($wordToRemove, '', $metro_name['line']));
                    $temp = $this->metroRepository->findMetroStationByLineAndName($metro_name['name'], $line_name);
                    if (isset($temp)) {
                        $metros_all[] = $temp;
                    }
                }
            }
        }
        return $metros_all;
    }

    public function addOffice($request)
    {
        $office = $this->createOffice($request);
        $user = User::where('account_id', $this->accountService->getAccountId())->first();
        $added_by = $user->lastname . ' ' . mb_substr($user->name, 0, 1, 'UTF-8') . '.';
        $metros_all = $this->createOfficeMetro($request, $office);
        $company_id = $this->accountService->getLoggedAs();
        if(!empty($office)){
            $this->notifyUser("default", null, $company_id);   
        }
        return $this->serializeOffice($office, $added_by, $metros_all);
    }

    public function updateOffice($request)
    {
        $user = User::where('account_id', $this->accountService->getAccountId())->first();
        $added_by = $user->lastname . ' ' . mb_substr($user->name, 0, 1, 'UTF-8') . '.';

        $office = $this->officeRepository->getByID($request->office_id);
        $office->update($this->prepareDataForAddOffice($request));
        $this->deleteOfficeMetros($office);
        $metros_all = $this->createOfficeMetro($request, $office);
        return $this->serializeOffice($office, $added_by, $metros_all);
    }

    public function deleteOfficeMetros($office){
        $office_metros = $this->officeRepository->getOfficeMetrosByOffice($office->id);
        if (isset($office_metros)) {
            foreach ($office_metros as $office_metro) {
                $office_metro->delete();
            }
        }
    }

    public function serializeOffices($offices)
    {
        $data = [];
        if (isset($offices)) {
            foreach ($offices as $office) {
                $metros_id = $this->officeRepository->getOfficeMetrosByOffice($office->id);
                $metros = [];
                if (isset($metros_id)) {
                    foreach ($metros_id as $metro) {
                        $metros[] = $this->metroRepository->find($metro->metro_id);
                    }
                }
                $user = User::where('account_id', $office->account_id)->first();
                $added_by = $user->lastname . ' ' . mb_substr($user->name, 0, 1, 'UTF-8') . '.';
                $data[] = ['id' => $office->id, 'address' => $office->address, 'added_by' => $added_by, "metro" => $metros];
            }
        }
        return $data;
    }
    public function getOffices()
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        $offices = $this->officeRepository->getOfficesOfCompany($company_id);
        return $this->serializeOffices($offices);
    }

    public function deleteOffice($id)
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        $office = $this->officeRepository->getByIDAndCompany($id, $company_id);
        $office->delete();
        return ['message' => "Офис успешно удален"];
    }

    public function serializeOffice($office, $added_by, $metros_all)
    {
        return [
            "id" => $office->id,
            'address' => $office->address,
            'added_by' => $added_by,
            "metro" => $metros_all,
        ];
    }
}
