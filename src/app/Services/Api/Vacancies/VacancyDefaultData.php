<?php

namespace App\Services\Api\Vacancies;

use App\Models\Account;
use App\Models\ResumeDriverLicenseLevel;
use App\Models\Vacancy;
use App\Repositories\Api\Vacancies\VacanciesRepositoryInterface;
use App\Services\Api\MediaFile\MediaFileService;
use App\Services\Api\Account\AccountService;
use Illuminate\Support\Facades\Storage;
use App\Models\VacanciesLanguages;
use App\Models\VacancyApplicationCriteria;
use App\Models\VacancyBonus;
use App\Models\VacansiesWorkMode;
use App\Models\VehicleType;
use App\Models\ResumeLanguageLevel;
use App\Models\Languages;
use App\Models\Region;
use App\Models\Company;
use App\Models\Category;
use App\Models\Office;
use App\Models\ResumeBusyness;
use App\Models\ResumeCurrency;
use App\Models\ResumeSchedule;
use App\Models\ResumeWorkFormats;
use App\Models\Template;
use App\Models\User;
use App\Models\VacancyWorkExperience;
use Illuminate\Support\Arr;

class VacancyDefaultData
{
    protected $accountService;
    private $company_id = null;
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function getDefault()
    {
        $this->company_id = $this->accountService->getCurrentCompanyID();
        $offices = Office::where('company_id', $this->company_id)
                            ->get(['id', 'address'])
                            ->toArray();
        $resultData = [
            'offices' => $offices,
            'employmentList' => ResumeBusyness::all(),
            'scheduleList' => ResumeSchedule::all(),
            'workFormatList' => ResumeWorkFormats::all(),
            'workExpList' => VacancyWorkExperience::all(),
            'currencyList' => ResumeCurrency::all(),
            'driverLicense' => ResumeDriverLicenseLevel::all(),
            'carTypes' => VehicleType::all(),
            'applicantTypes' => VacancyApplicationCriteria::all(),
            'template' => Template::select('id', 'text')->where('id', 197)->first()
        ];
        return response()->json([
            'data' => $resultData,
        ]);
    }
}