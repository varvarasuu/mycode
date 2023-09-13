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

class ResumeFourStepService
{

    use HttpResponse;

    protected Request $request;


    function __construct()
    {
        $this->request = Request();
    }

    function check_work_experience()
    {
        if (!$this->request->input('work_experience_name'))
            return null;
        if (!is_array($this->request->input('work_experience_name'))
                OR !is_array($this->request->input('work_experience_job_title'))
                OR !is_array($this->request->input('work_experience_start_month'))
                OR !is_array($this->request->input('work_experience_start_year'))
            ) {
            return null;
        }
        for ($i = 0; $i < count($this->request->input('work_experience_name')); $i++) {
            if (!$this->request->input('work_experience_job_title')[$i]) {
                return false;
            }
            if (!$this->request->input('work_experience_start_month')[$i]) {
                return false;
            }
            if (!$this->request->input('work_experience_start_year')[$i]) {
                return false;
            }

            if (!isset($this->request->input('until_now')[$i])) {
                if (!isset($this->request->input('work_experience_end_month')[$i])) {
                    return false;
                }
                if (!isset($this->request->input('work_experience_end_year')[$i])) {
                    return false;
                }
                if ($this->request->input('work_experience_end_year')[$i] > date('Y')) {
                    return false;
                }
                if ($this->request->input('work_experience_start_year')[$i] > $this->request->input('work_experience_end_year')[$i]) {
                    return false;
                }
                if ($this->request->input('work_experience_start_year')[$i] == $this->request->input('work_experience_end_year')[$i]) {
                    if ($this->request->input('work_experience_start_month')[$i] > $this->request->input('work_experience_end_month')[$i])
                        return false;
                }
                if ($this->request->input('work_experience_end_year')[$i] == date('Y')) {
                    if ($this->request->input('work_experience_end_month')[$i] > date('m'))
                        return false;
                }
            }

            if ($this->request->input('work_experience_start_year')[$i] == date('Y')) {
                if ($this->request->input('work_experience_start_month')[$i] > date('m'))
                    return false;
            }

        }
        return true;
    }

}