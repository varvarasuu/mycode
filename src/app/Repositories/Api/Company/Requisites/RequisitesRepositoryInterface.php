<?php

namespace App\Repositories\Api\Company\Requisites;

interface RequisitesRepositoryInterface
{
    public function getRequisites(int $company_id);
    public function create($data);
    public function getAllCompanyRequisites($company_id);
}
