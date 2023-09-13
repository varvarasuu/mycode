<?php

namespace App\Services;

use App\Traits\HttpResponse;

use App\Models\Metro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Exception;

class MetroService
{
    use HttpResponse;
    protected Request $request;

    function __construct()
    {
        $this->request = Request();
    }

    public function search(): \Symfony\Component\HttpFoundation\Response
    {
        try {
            $search_str = str_replace('%', '\\%', $this->request->string);
            $search_result = Metro::where('station_name', 'LIKE', '%'.$search_str.'%');
            $search_result->where('city_id', $this->request->city_id);
            return $this->success($search_result->get());
        } catch (Exception $e) {
            return $this->error('Error');
        }
    }
    public function metro_by_id(): \Symfony\Component\HttpFoundation\Response
    {
        try {
            $search_result = Metro::where('city_id', $this->request->city_id);
            return $this->success($search_result->get());
        } catch (Exception $e) {
            return $this->error('Error');
        }
    }

}
