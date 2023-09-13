<?php

namespace App\Services\Api\Resume;


use App\Models\Country;
use App\Models\Region;
use App\Models\Metro;
use Illuminate\Http\Request;

use App\Traits\HttpResponse;

use Illuminate\Support\Facades\Auth;

use Exception;

class ResumeFirstStepService
{

    use HttpResponse;

    protected Request $request;

    public $city_id = '';

    function __construct()
    {
        $this->request = Request();
    }

    function check_city()
    {
        $region = Region::find($this->request->input('city_id'));
        if(!$region) {
            return false;
        }
        $this->city_id = $this->request->input('city_id');
        return true;
    }

    function check_metro()
    {
        if($this->request->input('metro_id') !== null) {
            $metro = Metro::where('id', $this->request->input('metro_id'))->where('city_id', $this->city_id)->first();            
            if($metro === null) {
                return false;
            } else {
                return true;
            }
        }
        return null;
    }

    function check_citizenship()
    {
        if (is_array($this->request->input('citizenship'))) {
            $post_data = [];
            foreach ($this->request->input('citizenship') as $ship) {
                if (!Country::find($ship)) {
                    return false;
                }
                $post_data[] = $ship;
            }
            return $post_data;
        } else return false;
    }
    
    function check_work_permit()
    {
        if (is_array($this->request->input('work_permit'))) {
            $post_data = [];
            foreach ($this->request->input('work_permit') as $ship) {
                if (!Country::find($ship)) {
                    return false;
                }
                $post_data[] = $ship;
            }
            return $post_data;
        } else return false;
    }


}