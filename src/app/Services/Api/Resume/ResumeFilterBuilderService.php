<?php

namespace App\Services\Api\Resume;

use App\Models\TimeOfPublication;
use App\Repositories\Api\FilterBuilder\FilterBuilderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ResumeFilterBuilderService
{
    protected $repository;

    public function __construct(FilterBuilderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    protected function filterByBusinessTrip(?int $btID)
    {
        if ($btID) {
            return $this->repository->getResumesByBusinessTrip($btID);
        }
    }

    protected function filterBySalaryRange(?int $minSalary = null, ?int $maxSalary = null, ?int $currencyId = null)
    {
        return $this->repository->getResumesWithinSalaryRange($minSalary, $maxSalary, $currencyId);
    }

    protected function filterByExperienceIds(array $experienceIds)
    {
        $query = $this->repository->getModel();

        $query->where(function ($query) use ($experienceIds) {
            if (in_array(1, $experienceIds)) {
                return $this->repository->getByNoExperience($query);
            }
            if (in_array(2, $experienceIds)) {
                $query->orWhere(function ($q) {
                    return $this->repository->getByOneToThreeYearsExperience($q);
                });
            }
            if (in_array(3, $experienceIds)) {
                $query->orWhere(function ($q) {
                    return $this->repository->getByThreeToSixYearsExperience($q);
                });
            }
            if (in_array(4, $experienceIds)) {
                $query->orWhere(function ($q) {
                    return $this->repository->getByMoreThanSixYearsExperience($q);
                });
            }
        });
    }

    protected function filterByGenderId(?int $genderId)
    {
        if ($genderId !== null) {
            return $this->repository->getByGenderId($genderId);
        }
    }

    protected function filterByBusynessIds(array $busynessIds = [])
    {
        if (!empty($busynessIds)) {
            return $this->repository->getByBusynessIds($busynessIds);
        }
    }

    protected function filterByScheduleIds(array $scheduleIds = [])
    {
        if (!empty($scheduleIds)) {
            return $this->repository->getByScheduleIds($scheduleIds);
        }
    }

    protected function filterByWorkFormatIds(array $workFormatIds = [])
    {
        if (!empty($workFormatIds)) {
            return $this->repository->getByWorkFormatIds($workFormatIds);
        }
    }

    const HAVE_CAR = 1;
    protected function filterByHaveCar($haveCar = null)
    {
        if ($haveCar == self::HAVE_CAR) {
            return $this->repository->getByHaveCar();
        }
    }

    protected function filterByAvatarStatus(bool $hasAvatar)
    {
        if ($hasAvatar) {
            return $this->repository->getWithAvatar();
        }

        return $this->repository->getWithoutAvatar();
    }

    protected function filterByDrivingCategories(array $filters)
    {
        if (isset($filters['category_rights_ids']) && !empty($filters['category_rights_ids'])) {
            return $this->repository->getByDrivingCategories($filters['category_rights_ids']);
        }
    }

    protected function filterByPublicationTime(?int $timeId)
    {
        if ($timeId !== null) {
            $seconds = TimeOfPublication::find($timeId)->seconds;
        }

        if ($seconds !== null) {
            $dateFrom = Carbon::now()->subSeconds($seconds)->toDateTimeString();

            return $this->repository->getByPublicationTime($dateFrom);
        }
    }

    protected function filterBySkills(?array $skills)
    {
        if ($skills !== null || empty($skills)) {
            return $this->repository->getBySkills($skills);
        }
    }

    protected function filterByCitizenship(?array $citizenshipIds)
    {
        if ($citizenshipIds !== null || empty($citizenshipIds)) {
            return $this->repository->getByCitizenship($citizenshipIds);
        }
    }

    protected function filterByPermits(?array $permitsIds)
    {
        if ($permitsIds !== null || !empty($permitsIds)) {
            return $this->repository->getByPermits($permitsIds);
        }
    }

    protected function filterByAgeRange(?int $minAge, ?int $maxAge)
    {
        if ($minAge !== null && $maxAge !== null) {
            $oldestBirthDate = $minAge !== null ? Carbon::now()->subYears($minAge)->format('Y-m-d') : null;
            $youngestBirthDate = $maxAge !== null ? Carbon::now()->subYears($maxAge)->format('Y-m-d') : null;

            return $this->repository->getByAgeRange($oldestBirthDate, $youngestBirthDate);
        }
    }

    protected function searchResumes(?string $jobTitle = null, ?string $companyName = null, ?string $skill = null)
    {
        return $this->repository->getBySearchParameters($jobTitle, $companyName, $skill);
    }

    protected function filterByLanguagesAndLevels(?array $filterLanguages = [])
    {
        if (!empty($filterLanguages)) {
            return $this->repository->getLanguageAndLevelFilters($filterLanguages);
        }
    }

    protected function filterByStatus(string $status = 'all')
    {
        $query = $this->repository->getBaseQuery();

        $query->when($status, function ($query, $status) {
            switch ($status) {
                case 'hot':
                    return $query->where('hot', 1);
                case 'new':
                    $sevenDaysAgo = Carbon::now()->subDays(7);
                    return $query->where('created_at', '>=', $sevenDaysAgo);
                case 'all':
                default:
                    return $query;
            }
        });

        return $query;
    }

    protected function filterByOrder(string $order = null)
    {
        $query = $this->repository->getBaseQuery();

        if ($order) {
            switch ($order) {
                case 'salary_asc':
                    $query->orderBy('salary', 'asc');
                    break;
                case 'salary_desc':
                    $query->orderBy('salary', 'desc');
                    break;
            }
        }

        return $query;
    }

    public function apply(array $filters): Builder
    {
        $query = $this->repository->getBaseQuery();

        if (isset($filters['city_ids']) && !empty($filters['city_ids'])) {
            $query = $this->repository->getByCity($filters['city_ids']);
        }

        if (isset($filters['spec_id'])) {
            $query = $this->repository->getBySpecialization($filters['spec_id']);
        }

        if (isset($filters['spec_ids']) && !empty($filters['spec_ids'])) {
            $query = $this->repository->getBySubSpecializations($filters['spec_ids']);
        }

        if (isset($filters['business_trips_id']) && !empty($filters['business_trips_id'])) {
            $query = $this->filterByBusinessTrip($filters['business_trips_id']);
        }

        if (isset($filters['min_salary']) || isset($filters['max_salary']) || isset($filters['currency_id'])) {
            $query = $this->filterBySalaryRange($filters['min_salary'] ?? null, $filters['max_salary'] ?? null, $filters['currency_id'] ?? null);
        }

        if (isset($filters['experience_ids']) && is_array($filters['experience_ids'])) {
            $query = $this->filterByExperienceIds($filters['experience_ids']);
        }

        if (isset($filters['gender_id'])) {
            $query = $this->filterByGenderId($filters['gender_id']);
        }

        if (isset($filters['resume_busyness_ids']) && !empty($filters['resume_busyness_ids'])) {
            $query = $this->filterByBusynessIds($filters['resume_busyness_ids']);
        }

        if (isset($filters['schedule_ids']) && !empty($filters['schedule_ids'])) {
            $query = $this->filterByScheduleIds($filters['schedule_ids']);
        }

        if (isset($filters['work_format_ids']) && !empty($filters['work_format_ids'])) {
            $query = $this->filterByWorkFormatIds($filters['work_format_ids']);
        }

        if (isset($filters['have_car'])) {
            $query = $this->filterByHaveCar($filters['have_car']);
        }

        if (isset($filters['has_avatar'])) {
            $query = $this->filterByAvatarStatus($filters['has_avatar']);
        }

        if (isset($filters['category_rights_ids']) && !empty($filters['category_rights_ids'])) {
            $query = $this->filterByDrivingCategories($filters['category_rights_ids']);
        }

        if (isset($filters['publication_time_id'])) {
            $query = $this->filterByPublicationTime($filters['publication_time_id']);
        }

        if (isset($filters['skills']) && !empty($filters['skills'])) {
            $query = $this->filterBySkills($filters['skills']);
        }

        if (isset($filters['citizenship_ids']) && !empty($filters['citizenship_ids'])) {
            $query = $this->filterByCitizenship($filters['citizenship_ids']);
        }

        if (isset($filters['permits_ids']) && !empty($filters['permits_ids'])) {
            $query = $this->filterByPermits($filters['permits_ids']);
        }

        if (isset($filters['min_age']) || isset($filters['max_age'])) {
            $query = $this->filterByAgeRange($filters['min_age'] ?? null, $filters['max_age'] ?? null);
        }

        if (isset($filters['search_job_title']) || isset($filters['search_company_name']) || isset($filters['search_skill'])) {
            $query = $this->searchResumes($filters['search_job_title'] ?? null, $filters['search_company_name'] ?? null, $filters['search_skill'] ?? null);
        }

        if (isset($filters['filterLanguages']) && !empty($filters['filterLanguages'])) {
            $query = $this->filterByLanguagesAndLevels($filters['filterLanguages']);
        }

        if (isset($filters['status']) && !empty($filters['status'])) {
            $query = $this->filterByStatus($filters['status']);
        }

        if (isset($filters['order']) && !empty($filters['order'])) {
            $query = $this->filterByOrder($filters['order']);
        }

        return $query;
    }
}
