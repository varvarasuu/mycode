<?php

namespace App\Services\Api\Company\Quotas;

use App\Repositories\Api\Company\EloquentCompanyRepository;
use App\Services\Api\Account\AccountService;

class QuotasService implements QuotasServiceInterface
{
    protected $accountService;
    protected $companyRepository;

    public function __construct(AccountService $accountService, EloquentCompanyRepository $companyRepository)
    {
        $this->accountService = $accountService;
        $this->companyRepository = $companyRepository;
    }
    public function saveQuotas($request)
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        $employee = $this->companyRepository->getEmployeer($company_id, $request->employee_id);
        $data = $this->prepareDataQuotas($request);
        return $this->updateQuotas($data, $employee);
    }

    private function updateQuotas($data, $employee)
    {
        $employee->max_vacancies_direct_response = $data['max_vacancies_direct_response'];
        $employee->max_anon_vacancies = $data['max_anon_vacancies'];
        $employee->max_standard_vacancies = $data['max_standard_vacancies'];
        $employee->max_hot_vacancies = $data['max_hot_vacancies'];
        $employee->max_premium_vacancies = $data['max_premium_vacancies'];
        $employee->save();
        return ["message" => 'Квоты сохранены'];
    }

    public function getQuotas($id)
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        return $this->companyRepository->getQuotasEmployee($company_id, $id);
    }

    public function prepareDataQuotas($request)
    {
        return [
            'max_vacancies_direct_response' => $request->max_vacancies_direct_response === 'null' ? null : $request->max_vacancies_direct_response,
            'max_anon_vacancies' => $request->max_anon_vacancies === 'null' ? null : $request->max_anon_vacancies,
            'max_standard_vacancies' => $request->max_standard_vacancies === 'null' ? null : $request->max_standard_vacancies,
            'max_hot_vacancies' => $request->max_hot_vacancies === 'null' ? null : $request->max_hot_vacancies,
            'max_premium_vacancies' => $request->max_premium_vacancies === 'null' ? null : $request->max_premium_vacancies
        ];
    }
}
