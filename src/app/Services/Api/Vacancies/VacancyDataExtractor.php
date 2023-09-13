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
use App\Models\User;
use App\Models\VacancyWorkExperience;
use Illuminate\Support\Arr;

class VacancyDataExtractor
{
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function extract(Vacancy $vacancy): array
    {
        return [
            'id' => $vacancy->id,
            'is_draft' => $vacancy->is_draft,
            'is_active' => $vacancy->is_active,
            'is_archieve' => $vacancy->is_archieve,
            'account_id' => $this->extractAccountData($vacancy),
            'city_id' => $this->extractCityData($vacancy),
            'offices_id' => $this->extractAddresses($vacancy),
            'company_id' => $this->extractCompanyData($vacancy),
            'detail_list_employees_id' => $vacancy['detail_list_employees_id'],
            'job_title' => $vacancy->title,
            'specialization_category_id' => $this->extractCategory($vacancy),
            'specializations' => $this->extractSpecializations($vacancy),
            'description_short' => $vacancy['description_short'] ?? null,
            'description' => $vacancy['description'],
            'employment_type' => $this->extractEmploymentData($vacancy) ?? null,
            'work_schedule' => $this->extractWorkSchedulData($vacancy) ?? null,
            'work_format' => $this->extractWorkFormatData($vacancy) ?? null,
            'temporary_employment' => $vacancy['temporary_employment'] ?? null,
            'currency_id' => $this->extractCurrencyData($vacancy['currency_id']) ?? [],
            'salary_from' => $vacancy['salary_from'] ?? null,
            'salary_to' => $vacancy['salary_to'] ?? null,
            'percent_bonus' => $vacancy['percent_bonus'] ?? null,
            'before_taxes' => $vacancy['before_taxes'] ?? null,
            'work_experience_id' => $this->extractWorkExperienceData($vacancy) ?? null, //vacancy_work_experiences
            'has_own_transport' => $vacancy['has_own_transport'] ?? false,
            'send_notifications_to_manager' => $vacancy['send_notifications_to_manager'] ?? false,
            'enable_auto_reply' => $vacancy['enable_auto_reply'] ?? false,
            'auto_reply_text' => $vacancy['auto_reply_text'] ?? null,
            'video_vacancy' => $vacancy['video_vacancy'] ?? null,
            'work_modes' => $this->extractWorkModesData($vacancy),
            'bonuses' => $this->extractBonusesData($vacancy),
            'skills' => $this->extractSkills($vacancy),
            'languages' => $this->extractLanguagesData($vacancy),
            'driver_license_categories' => $this->extractDriverLicenseCategories($vacancy),
            'vehicle_types' => $this->extractVehicleData($vacancy),
            'application_criteria' => $this->extractApplicationCriteria($vacancy),
            'images' => $this->extractImages($vacancy),
        ];
    }

    private function extractCurrencyData($vacancy): array
    {
        if (!isset($vacancy['currency_id'])) {
            return [];
        }

        $currencyId = $vacancy['currency_id'];
        $currency = ResumeCurrency::find($currencyId);

        if (!$currency) {
            return [];
        }

        return [
            'id' => $currencyId,
            'name' => $currency->name,
        ];
    }

    private function extractWorkExperienceData($vacancy): array
    {
        if (!isset($vacancy['work_experience_id'])) {
            return [];
        }

        $workExperienceId = $vacancy['work_experience_id'];
        $workExperience = VacancyWorkExperience::find($workExperienceId);

        if (!$workExperience) {
            return [];
        }

        return [
            'id' => $workExperienceId,
            'name' => $workExperience->name,
        ];
    }

    private function extractWorkFormatData($vacancy): array
    {
        if (!isset($vacancy['work_format'])) {
            return [];
        }

        $work_format = $vacancy['work_format'];
        $workSchedule = ResumeWorkFormats::find($work_format);

        if (!$workSchedule) {
            return [];
        }

        return [
            'id' => $work_format,
            'name' => $workSchedule->title,
        ];
    }

    private function extractEmploymentData($vacancy): array
    {
        if (!isset($vacancy['employment_type'])) {
            return [];
        }
        $employmentTypeId = $vacancy['employment_type'];
        $employmentType = ResumeBusyness::find($employmentTypeId);

        if (!$employmentType) {
            return [];
        }
        return [
            'id' => $employmentTypeId,
            'name' => $employmentType->name,
        ];
    }

    private function extractWorkSchedulData($vacancy): array
    {
        if (!isset($vacancy['work_schedule'])) {
            return [];
        }

        $workScheduleId = $vacancy['work_schedule'];
        $workSchedule = ResumeSchedule::find($workScheduleId);

        if (!$workSchedule) {
            return [];
        }

        return [
            'id' => $workScheduleId,
            'name' => $workSchedule->title,
        ];
    }


    private function extractAccountData(Vacancy $vacancy): array
    {
        $usr = User::find($vacancy['account_id']);
        return [
                'id' => $vacancy['account_id'],
                'name' => $usr->name . ' ' . $usr->lastname,
            ];
    }

    private function extractAddresses(Vacancy $vacancy): array
    {
        $officesData = [];
        $officesIds = $vacancy->offices()->pluck('office_id')->toArray();
        $offices = Office::whereIn('id', $officesIds)->get();
        foreach ($offices as $office) {
            $officesData[] = [
                'id' => $office->id,
                'address' => $office->address,
            ];
        }
        return $officesData;
    }

    private function extractSpecializations(Vacancy $vacancy): array
    {
        $specializationData = [];
        $specializationIds = $vacancy->specializations->pluck('specialization_id')->toArray();

        // Предварительно загружаем связанные категории с именами категорий
        $categories = Category::whereIn('id', $specializationIds)->with('categoryName')->get();

        foreach ($categories as $category) {
            $specializationData[] = [
                'specialization_id' => $category->id,
                'category_name' => $category->categoryName->name,
            ];
        }
        return $specializationData;
    }

    private function extractCategory(Vacancy $vacancy): array
    {
        return [
                "cat_id" => $vacancy['specialization_category_id'],
                "cat_name" => Category::find($vacancy['specialization_category_id'])->categoryName->select('name')->first()
            ];
    }

    private function extractWorkModesData(Vacancy $vacancy): array
    {
        $workModesData = [];
        $workModeIds = $vacancy->workModes->pluck('work_mode_id')->toArray();
        $workModes = VacansiesWorkMode::whereIn('id', $workModeIds)->get();
        foreach ($workModes as $workMode) {
            $workModesData[] = [
                'work_mode_id' => $workMode->id,
                'value' => $workMode->name,
            ];
        }
        return $workModesData;
    }

    private function extractBonusesData(Vacancy $vacancy): array
    {
        $bonusesData = [];
        $bonusesIds = $vacancy->bonuses->pluck('bonus_id')->toArray();
        $bonusesValues = VacancyBonus::whereIn('id', $bonusesIds)->pluck('name', 'id')->toArray();
        foreach ($bonusesIds as $bonusId) {
            $bonusesData[] = [
                'bonus_id' => $bonusId,
                'value' => $bonusesValues[$bonusId] ?? [],
            ];
        }
        return $bonusesData;
    }

    private function extractApplicationCriteria(Vacancy $vacancy): array
    {
        $applicationCriteria = [];
        $applicationCriteriaIds = $vacancy->applicationCriteria->pluck('application_criteria_id')->toArray();
        $applicationCriterValues = VacancyApplicationCriteria::whereIn('id', $applicationCriteriaIds)->pluck('name', 'id')->toArray();
        foreach ($applicationCriteriaIds as $applicationCriteriId) {
            $applicationCriteria[] = [
                'id' => $applicationCriteriId,
                'value' => $applicationCriterValues[$applicationCriteriId] ?? [],
            ];
        }
        return $applicationCriteria;
    }

    private function extractSkills(Vacancy $vacancy): array
    {
        return $vacancy->skills()->pluck('skill')->toArray();
    }

    private function extractImages(Vacancy $vacancy): array
    {
        return $vacancy->images()->pluck('file_path')->toArray();
    }


    private function extractCityData(Vacancy $vacancy): array
    {
        return [
                'id' => $vacancy['city_id'],
                'name' => Region::find($vacancy['city_id'])->name,
            ];
    }

    private function extractCompanyData(): array
    {
        return [
                'id' => $this->accountService->getLoggedAs(),
                'name' => Company::find($this->accountService->getLoggedAs())->name,
            ];
    }

    private function extractDriverLicenseCategories(Vacancy $vacancy): array
    {
        $driverLicenseCategoriesData = [];
        $driverLicenseIds = $vacancy->driverLicenseCategories->pluck('license_category_id')->toArray();
        $driverLicenseValues = ResumeDriverLicenseLevel::whereIn('id', $driverLicenseIds)->pluck('name', 'id')->toArray();
        foreach ($driverLicenseIds as $driverLicenseId) {
            $driverLicenseCategoriesData[] = [
                'id' => $driverLicenseId,
                'value' => $driverLicenseValues[$driverLicenseId] ?? [],
            ];
        }
        return $driverLicenseCategoriesData;
    }

    private function extractVehicleData(Vacancy $vacancy): array
    {
        $vehicleData = [];
        $vehicleIds = $vacancy->vehicleTypes->pluck('vehicle_type_id')->toArray();
        $vehicleValues = VehicleType::whereIn('id', $vehicleIds)->pluck('name', 'id')->toArray();
        foreach ($vehicleIds as $vehicleId) {
            $vehicleData[] = [
                'vih_id' => $vehicleId,
                'value' => $vehicleValues[$vehicleId] ?? [],
            ];
        }
        return $vehicleData;
    }

    private function extractLanguagesData(Vacancy $vacancy): array
    {
        $languagesData = [];
        $languages = $vacancy->languages()->pluck('language_level_id', 'language_id')->toArray();

        // Предварительно загружаем связанные уровни языков и названия языков
        $resumeLanguageLevels = ResumeLanguageLevel::whereIn('id', array_values($languages))->pluck('level_name', 'id')->toArray();
        $languagesList = Languages::whereIn('id', array_keys($languages))->pluck('name', 'id')->toArray();

        foreach ($languages as $languageId => $languageLevelId) {
            $languagesData[] = [
                'language_id' => $languageId,
                'language_level_id' => $languageLevelId,
                'language_name' => $languagesList[$languageId] ?? null,
                'language_level_name' => $resumeLanguageLevels[$languageLevelId] ?? null,
            ];
        }

        return $languagesData;
    }
}