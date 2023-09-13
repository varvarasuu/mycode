<?php
namespace App\Repositories\Api\Company;

use App\Models\ListOfEmployees;

interface CompanyRepositoryInterface
{
    public function getListOfEmployees(int $company_id) : ListOfEmployees;
    public function getDetailListOfEmployees($company_id, $id);
    public function getEmployeer($company_id, $id);


    public function getQuotasEmployee($company_id, $id_employee);
}
