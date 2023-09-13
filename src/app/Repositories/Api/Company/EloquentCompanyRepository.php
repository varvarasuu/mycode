<?php

namespace App\Repositories\Api\Company;

use App\Models\DetailListOfEmployees;
use App\Models\ListOfEmployees;

class EloquentCompanyRepository implements CompanyRepositoryInterface
{
    public function getListOfEmployees(int $company_id) : ListOfEmployees
    {
        return ListOfEmployees::where('company_id', $company_id)->first();
    }

    public function getDetailListOfEmployees($company_id, $id)
    {
        $list_of_employees = $this->getListOfEmployees($company_id);
        return DetailListOfEmployees::where('id', $id)->where('list_of_employees_id', $list_of_employees->id);
    }

    public function getEmployeer($company_id, $id)
    {
        $list_of_employees = $this->getListOfEmployees($company_id);
        return DetailListOfEmployees::where('id', $id)->where('list_of_employees_id', $list_of_employees->id)->first();
    }

    public function getQuotasEmployee($company_id, $id_employee)
    {
        $employee = $this->getEmployeer($company_id, $id_employee);
        if($employee){
            return $this->serializeQuotas($employee);
        }
        else{
            return [];
        }
    }

    private function serializeQuotas($employee)
    {
        return [
            'max_vacancies_direct_response' => $employee->max_vacancies_direct_response,
            'max_anon_vacancies' => $employee->max_anon_vacancies,
            'max_standard_vacancies' => $employee->max_standard_vacancies,
            'max_hot_vacancies' => $employee->max_hot_vacancies,
            'max_premium_vacancies' => $employee->max_premium_vacancies,
        ];
    }
}
