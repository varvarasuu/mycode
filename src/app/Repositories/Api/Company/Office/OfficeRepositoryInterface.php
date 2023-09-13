<?php

namespace App\Repositories\Api\Company\Office;

use App\Models\Office;

interface OfficeRepositoryInterface
{
    public function getByID($id): Office;
    public function getOfficesOfCompany($company_id);
    public function getByIDAndCompany($id, $company);
    public function createOffice($data);
    public function createOfficeMetro($data);
    public function getOfficeMetrosByOffice($office_id);
}
