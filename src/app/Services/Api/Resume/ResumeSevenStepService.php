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
use App\Models\Portfolio;
use App\Models\ResumeDriverLicenseLevel;
use App\Models\ResumeDrivingCategory;
use Illuminate\Http\Request;

use App\Traits\HttpResponse;

use Illuminate\Support\Facades\Auth;

use Exception;

class ResumeSevenStepService
{

    use HttpResponse;

    protected Request $request;


    function __construct()
    {
        $this->request = Request();
    }

    function check_portfolio()
    {
        if(!$this->request->input('portfolio_id')) {
            return null;
        }
        if (!Portfolio::find($this->request->input('portfolio_id')))
            return false;
        return true;
    }

}