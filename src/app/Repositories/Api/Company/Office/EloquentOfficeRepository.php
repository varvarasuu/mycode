<?php

namespace App\Repositories\Api\Company\Office;

use App\Models\Office;
use App\Models\OfficeMetro;

class EloquentOfficeRepository implements OfficeRepositoryInterface
{
    public function getByID($id): Office
    {
        return Office::find($id);
    }

    public function getOfficesOfCompany($company_id)
    {
        return Office::where('company_id', '=', $company_id)
        ->get();
    }

    public function getByIDAndCompany($id, $company_id)
    {
        return Office::where('id', '=', $id)
            ->where('company_id', '=', $company_id)
            ->get()->first();
    }

    public function createOffice($data)
    {
        return Office::create($data);
    }

    public function createOfficeMetro($data)
    {
        return OfficeMetro::create($data);
    }

    public function getOfficeMetrosByOffice($office_id)
    {
        return OfficeMetro::where('office_id', $office_id)->get();
    }
}
