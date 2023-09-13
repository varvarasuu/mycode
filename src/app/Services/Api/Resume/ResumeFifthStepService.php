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
use App\Models\ResumeLanguageLevel;
use App\Models\ResumeLevelEducation;
use Illuminate\Http\Request;

use App\Traits\HttpResponse;

use Illuminate\Support\Facades\Auth;

use Exception;

class ResumeFifthStepService
{

    use HttpResponse;

    protected Request $request;

    function __construct()
    {
        $this->request = Request();
    }

    function check_education()
    {
        //education_level[] //обязательно
        //name_institut[] //обязательно
        //education_specialization[] ~
        //education_faculty[] ~
        //year_end //обязательно

        if (!is_array($this->request->input('education_level'))
                OR !is_array($this->request->input('education_name'))
                OR !is_array($this->request->input('education_year_end'))
            ) {
            return null;
        }
        for ($i = 0; $i < count($this->request->input('education_level')); $i++) {
            if (!$this->request->input('education_level')[$i]) {
                return false;
            }
            if (!ResumeLevelEducation::find($this->request->input('education_level')[$i])) {
                return false;
            }
            if (!$this->request->input('education_name')[$i]) {
                return false;
            }
            if (!$this->request->input('education_year_end')[$i]) {
                return false;
            }
        }
        return true;
    }

    function check_add_education()
    {

        //add_education_name[] //обязательно
        //add_education_org[] //обязательно
        //add_education_specialization[] ~
        //add_education_year_end //обязательно

        if (!is_array($this->request->input('add_education_name'))
                OR !is_array($this->request->input('add_education_org'))
                OR !is_array($this->request->input('add_education_year_end'))
            ) {
            return null;
        }
        for ($i = 0; $i < count($this->request->input('add_education_name')); $i++) {
            if (!$this->request->input('add_education_org')[$i]) {
                return false;
            }
            if (!$this->request->input('add_education_org')[$i]) {
                return false;
            }
        }
        return true;
    }

    function check_languages()
    {
        //знание языков и уровень владения
        //позже перепишу
        if ($this->request->input('languages')
                AND $this->request->input('language_level')
                AND is_array($this->request->input('languages'))
                ) {
            $native_lang = false;
            $lang = $this->request->input('languages');
            $lang_lvl = $this->request->input('language_level');

            for ($i = 0; $i < count($lang); $i++) {
                if (!Languages::find($lang[$i])) {
                    return false;
                }
                if (isset($lang_lvl[$i]) AND $lang_lvl[$i]) {
                    if (!ResumeLanguageLevel::find($lang_lvl[$i])) {
                        return false;
                    }
                    if ($lang_lvl[$i] == 1 AND !$native_lang) {
                        $native_lang = true;
                    } elseif ($lang_lvl[$i] == 1 AND $native_lang) {
                        return false;
                        //return $this->error('Native language already specified', 'error', 401);
                    }
                } else {
                    return false;
                }
                $post_data['languages'][] = $lang[$i];
                $post_data['languages_lvl'][] = $lang_lvl[$i];
            }
            return true;
        }
        return null;
    }

    function check_drive_license()
    {
        if ($this->request->input('driver_license') AND is_array($this->request->input('driver_license'))) {
            foreach ($this->request->input('driver_license') as $_dlicence) {
                if (!ResumeDriverLicenseLevel::find($_dlicence)) {
                    return false;
                }
            }
            return true;
        }
        return null;
    }

}