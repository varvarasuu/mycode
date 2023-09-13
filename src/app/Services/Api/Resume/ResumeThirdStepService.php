<?php

namespace App\Services\Api\Resume;

use App\Models\Category;
use App\Models\Country;
use App\Models\Languages;
use App\Models\ResumeBusinessTrips;
use App\Models\ResumeBusyness;
use App\Models\ResumeCurrency;
use App\Models\ResumeSchedule;
use App\Models\ResumeWorkFormats;
use App\Models\Region;
use App\Models\Metro;
use App\Models\ResumeDriverLicenseLevel;
use App\Models\ResumeDrivingCategory;
use Illuminate\Http\Request;

use App\Traits\HttpResponse;

use Illuminate\Support\Facades\Auth;

use Exception;

class ResumeThirdStepService
{

    use HttpResponse;

    protected Request $request;


    function __construct()
    {
        $this->request = Request();
    }

    function check_business_trip()
    {
        if ($this->request->input('business_trip')) {
            if(!ResumeBusinessTrips::find($this->request->input('business_trip'))) {
                return false;
            }
            return $this->request->input('business_trip');
        }
        return null;
    }

    function check_work_format()
    {
        if ($this->request->input('work_format') AND is_array($this->request->input('work_format'))) {
            $post_data = [];
            foreach ($this->request->input('work_format') as $format) {
                if (!ResumeWorkFormats::find($format)) {
                    return false;
                }
                $post_data[] = $format;
            }
            return $post_data;
        }
        return null;
    }

    function check_busyness()
    {
        //Занятость
        if ($this->request->input('employment') AND is_array($this->request->input('employment'))) {
            $post_data = [];
            foreach ($this->request->input('employment') as $eml) {
                if (!ResumeBusyness::find($eml)) {
                    return false;
                }
                $post_data[] = $eml;
            }
            return $post_data;
        }
        return null;
    }

    function check_schedules()
    {
        //график
        if ($this->request->input('schedule') AND is_array($this->request->input('schedule'))) {
            $post_data = [];
            foreach ($this->request->input('schedule') as $eml) {
                if (!ResumeSchedule::find($eml)) {
                    return false;
                }
                $post_data[] = $eml;
            }
            return $post_data;
        }
        return null;
    }

    function check_relocation()
    {
        if (is_array($this->request->input('relocation_region'))) {
            $post_data = [];
            foreach ($this->request->input('relocation_region') as $ship) {
                if (!Region::find($ship)) {
                    return false;
                }
                $post_data[] = $ship;
            }
            return $post_data;
        }
        return null;
    }

}