<?php

namespace App\Services\Api\PaidServices;

use App\Traits\HttpResponse;
use App\Models\PaidServicies;

class PaidServicesService
{
    use HttpResponse;

    public function index()
    {
        $services = PaidServicies::select(
            'paid_servicies.id as id',
            'paid_servicies.cat_id as catalog_id',
            'paid_servicies.title as title',
            'paid_servicies.subtitle as subtitle',
            'paid_servicies.price as price',
            'paid_catalogs.name as name',
            'paid_catalogs.url as url'
        )->leftJoin('paid_catalogs', 'paid_servicies.cat_id', '=', 'paid_catalogs.id')
        ->get();

        return $this->success($services);
    }
}
