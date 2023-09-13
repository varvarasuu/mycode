<?php

namespace App\Services\Api\Vacancies;


use App\Models\Vacancy;
use App\Repositories\Api\Vacancies\VacanciesRepositoryInterface;
use App\Services\Api\Account\AccountService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class DefaultVacanciesService implements VacanciesServiceInterface
{

    const DELETED = 1;
    const NOT_DELETED = 0;
    const ARCHIEVE = 1;
    const NOT_ARCHIEVE = 0;
    const ACTIVE = 1;
    const NOT_ACTIVE = 0;

    private VacanciesRepositoryInterface $vacanciesRepository;
    private AccountService $accountService;
    private VacancyDataExtractor $dataExtractor;

    public function __construct(
            VacanciesRepositoryInterface $vacanciesRepository,
            AccountService $accountService,
            VacancyDataExtractor $dataExtractor
            )
    {
        $this->vacanciesRepository = $vacanciesRepository;
        $this->accountService = $accountService;
        $this->dataExtractor = $dataExtractor;
    }

    protected function queryVacancy(int $vacancyId): ?Builder
    {
        $accountId = $this->accountService->getAccountId();
        $companyId = $this->accountService->getLoggedAs();
        return Vacancy::where('account_id', $accountId)
                    ->where('company_id', $companyId)
                    ->where('is_deleted', self::NOT_DELETED)
                    ->where('id', $vacancyId);
    }

    protected function findVacancy($vacancyId): ?Vacancy
    {
        return $this->queryVacancy($vacancyId)->first();
    }

    public function deleteVacancy(int $vacancyId): void
    {
        $vacancy = $this->findVacancy($vacancyId);
        if (!$vacancy) {
            throw new \Exception("Vacancy with ID {$vacancyId} not found");
        }
        $vacancy->update(['is_deleted' => self::DELETED]);
    }

    public function unarchieveVacancy(int $vacancyId): void
    {
        $vacancy = $this->queryVacancy($vacancyId)
                    ->where('is_archieve', self::ARCHIEVE)
                    ->where('is_active', self::NOT_ACTIVE)
                    ->first();
        if (!$vacancy) {
            throw new \Exception("Vacancy with ID {$vacancyId} not found");
        }
        $vacancy->update(['is_archieve' => self::NOT_ARCHIEVE, 'is_moderation' => 1]);
    }

    public function archieveVacancy(int $vacancyId): void
    {
        $vacancy = $this->queryVacancy($vacancyId)
                    ->where('is_archieve', self::NOT_ARCHIEVE)
                    ->where('is_active', self::ACTIVE)
                    ->first();
        if (!$vacancy) {
            throw new \Exception("Vacancy with ID {$vacancyId} not found");
        }
        $vacancy->update(['is_archieve' => self::ARCHIEVE, 'is_active' => self::NOT_ACTIVE]);
    }

    public function viewVacancy(int $vacancyId): array
    {
        $vacancy = Vacancy::find($vacancyId);
        if (!$vacancy) {
            throw new \Exception("Vacancy with ID {$vacancyId} not found");
        }
        return $this->dataExtractor->extract($vacancy);
    }

    public function createVacancy(array $request): array
    {
        $data = $this->prepareData($request);
        $vacancy = $this->vacanciesRepository->create($data);
        $this->syncRelationships($vacancy, $request);
        return $this->dataExtractor->extract($vacancy);
    }

    public function updateVacancy(array $request): array
    {
        $vacancy = $this->findVacancy($request['vacancy_id']);
        if (!$vacancy) {
            throw new \Exception("Vacancy with ID {$request['vacancy_id']} not found");
        }
        if ($vacancy->video_vacancy) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $vacancy->video_vacancy));
            $vacancy->video_vacancy = null;
            $vacancy->save();
        }
        $request['city_id'] = $vacancy->city_id;
        $data = $this->prepareData($request);
        $updatedVacancy = $this->vacanciesRepository->update($vacancy, $data);
        $this->syncRelationships($vacancy, $request);
        return $this->dataExtractor->extract($updatedVacancy);
    }

    public function duplicateVacancy(int $vacancyId): array
    {
        $originalVacancy = $this->findVacancy($vacancyId);
        if (!$originalVacancy) {
            throw new \Exception("Vacancy with ID {$vacancyId} not found");
        }

        $duplicatedVacancy = $originalVacancy->replicate();
        $duplicatedVacancy->title .= ' (Duplicate)';

        $duplicatedVacancy->is_draft = 1;
        $duplicatedVacancy->is_active = 0;
        $duplicatedVacancy->is_archieve = 0;
        $duplicatedVacancy->is_pending_payment = 0;
        $duplicatedVacancy->is_rejected = 0;
        $duplicatedVacancy->is_moderation = 0;

        $duplicatedVacancy->save();

        $this->saveOffices($duplicatedVacancy, $originalVacancy->offices->pluck('office_id')->toArray());
        $this->saveSpecializations($duplicatedVacancy, $originalVacancy->specializations->pluck('specialization_id')->toArray());
        $this->saveWorkModes($duplicatedVacancy, $originalVacancy->workModes->pluck('work_mode_id')->toArray());
        $this->saveVacancyBonuses($duplicatedVacancy, $originalVacancy->bonuses->pluck('bonus_id')->toArray());
        $this->saveSkills($duplicatedVacancy, $originalVacancy->skills->pluck('skill')->toArray());

        $languages = $originalVacancy->languages->pluck('language_id')->toArray();
        $languageLevels = $originalVacancy->languages->pluck('language_level_id')->toArray();

        $this->saveLanguages($duplicatedVacancy, $languages, $languageLevels);
        $this->saveDriverLicenseCategories($duplicatedVacancy, $originalVacancy->driverLicenseCategories->pluck('license_category_id')->toArray());
        $this->saveVehicleTypes($duplicatedVacancy, $originalVacancy->vehicleTypes->pluck('vehicle_type_id')->toArray());
        $this->saveApplicationCriteria($duplicatedVacancy, $originalVacancy->applicationCriteria->pluck('application_criteria_id')->toArray());

        // $newImages = [];
        // foreach ($originalVacancy->images as $image) {
        //     $newImagePath = Storage::disk('public')->copy(
        //         str_replace('/storage/', '', $image->file_path),
        //         'duplicated_vacancy_images/' . basename($image->file_path)
        //     );
        //     $newImages[] = new UploadedFile(storage_path('app/public/' . $newImagePath), basename($image->file_path));
        // }
        // $this->saveImages($duplicatedVacancy, $newImages);

        return $this->dataExtractor->extract($duplicatedVacancy);
    }

    private function prepareData(array $request): array
    {
        return [
            'account_id' => $this->accountService->getAccountId(),
            'city_id' => $request['city_id'],
            'company_id' => $this->accountService->getLoggedAs(),
            'detail_list_employees_id' => $request['detail_list_of_employees'],
            'title' => $request['job_title'],
            'specialization_category_id' => $request['specialization_category_id'],
            'description_short' => $request['description_short'] ?? null,
            'description' => $request['description'],
            'employment_type' => $request['employment_type'] ?? null,
            'work_schedule' => $request['work_schedule'] ?? null,
            'work_format' => $request['work_format'] ?? null,
            'temporary_employment' => $request['temporary_employment'] ?? null,
            'currency_id' => $request['currency_id'] ?? 1,
            'salary_from' => $request['salary_from'] ?? null,
            'salary_to' => $request['salary_to'] ?? null,
            'percent_bonus' => $request['percent_bonus'] ?? null,
            'before_taxes' => $request['before_taxes'] ?? null,
            'work_experience_id' => $request['work_experience_id'] ?? null,
            'has_own_transport' => $request['has_own_transport'] ?? false,
            'send_notifications_to_manager' => $request['send_notifications_to_manager'] ?? false,
            'enable_auto_reply' => $request['enable_auto_reply'] ?? false,
            'auto_reply_text' => $request['auto_reply_text'] ?? null
        ];
    }
    private function syncRelationships(Vacancy $vacancy, array $request): void
    {
        $this->saveVideo($vacancy, $request['video_vacancy'] ?? []);
        $this->saveOffices($vacancy, $request['office_id'] ?? []);
        $this->saveSpecializations($vacancy, $request['specialization_id'] ?? []);
        $this->saveWorkModes($vacancy, $request['work_modes'] ?? []);
        $this->saveVacancyBonuses($vacancy, $request['vacancy_bonuses'] ?? []);
        $this->saveSkills($vacancy, $request['skills'] ?? []);
        $this->saveLanguages($vacancy, $request['language_id'] ?? [], $request['language_level_id'] ?? []);
        $this->saveDriverLicenseCategories($vacancy, $request['driver_license_categories'] ?? []);
        $this->saveVehicleTypes($vacancy, $request['vehicle_types'] ?? []);
        $this->saveApplicationCriteria($vacancy, $request['application_criteria'] ?? []);
        $this->saveImages($vacancy, $request['images'] ?? []);
    }
    private function saveOffices(Vacancy $vacancy, array $offices): void
    {
        $vacancy->offices()->delete();
        foreach ($offices as $office) {
            $vacancy->offices()->create([
                    'office_id' => $office
                ]);
        }
    }
    private function saveSpecializations(Vacancy $vacancy, array $spces): void
    {
        $vacancy->specializations()->delete();
        foreach ($spces as $spce) {
            $vacancy->specializations()->create([
                    'specialization_id' => $spce
                ]);
        }
    }
    private function saveWorkModes(Vacancy $vacancy, array $workModes): void
    {
        $vacancy->workModes()->delete();
        foreach ($workModes as $workMode) {
            $vacancy->workModes()->create([
                    'work_mode_id' => $workMode
                ]);
        }
    }
    private function saveVacancyBonuses(Vacancy $vacancy, array $bonuses): void
    {
        $vacancy->bonuses()->delete();
        foreach ($bonuses as $bonus) {
            $vacancy->bonuses()->create(['bonus_id' => $bonus]);
        }
    }
    private function saveSkills(Vacancy $vacancy, array $skills): void
    {
        $vacancy->skills()->delete();
        foreach ($skills as $skill) {
            $vacancy->skills()->create(['skill' => $skill]);
        }
    }
    private function saveLanguages(Vacancy $vacancy, array $languages, array $level): void
    {
        $vacancy->languages()->delete();
        $length = min(count($languages), count($level));
        for ($i = 0; $i < $length; $i++) {
            $vacancy->languages()->create([
                'language_id' => $languages[$i],
                'language_level_id' => $level[$i],
            ]);
        }
    }
    private function saveDriverLicenseCategories(Vacancy $vacancy, array $driverLicenseCategories): void
    {
        $vacancy->driverLicenseCategories()->delete();
        foreach ($driverLicenseCategories as $category) {
            $vacancy->driverLicenseCategories()->create(['license_category_id' => $category]);
        }
    }
    private function saveVehicleTypes(Vacancy $vacancy, array $vehicleTypes): void
    {
        $vacancy->vehicleTypes()->delete();
        foreach ($vehicleTypes as $type) {
            $vacancy->vehicleTypes()->create(['vehicle_type_id' => $type]);
        }
    }

    private function saveApplicationCriteria(Vacancy $vacancy, array $applicationCriteria): void
    {
        $vacancy->applicationCriteria()->delete();
        foreach ($applicationCriteria as $criteria) {
            $vacancy->applicationCriteria()->create(['application_criteria_id' => $criteria]);
        }
    }
    private function saveVideo(Vacancy $vacancy, $video): void
    {
        if ($video) {
            $videoPath = $video->store('vacancy_videos', 'public');
            $vacancy->video_vacancy = '/storage/'.$videoPath;
            $vacancy->save();
        }
    }
    private function saveImages(Vacancy $vacancy, array $images): void
    {
        foreach ($vacancy->images as $image) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $image->file_path));
            $image->delete();
        }
        $vacancy->images()->delete();
        foreach ($images as $image) {
            $imagePath = $image->store('vacancy_images', 'public');
            $vacancy->images()->create(['file_path' => '/storage/'.$imagePath]);
        }
    }
}
