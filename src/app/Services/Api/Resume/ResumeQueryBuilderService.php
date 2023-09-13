<?php

namespace App\Services\Api\Resume;

use App\Models\TimeOfPublication;
use App\Repositories\Api\Resume\ResumeQueryBuilderInterface;
use Carbon\Carbon;

class ResumeQueryBuilderService implements ResumeQueryBuilderInterface
{
    protected $query;

    public function __construct($model)
    {
        $this->query = $model::query();
    }

    public function filterByCity(array $cityIds): self
    {
        if (!empty($cityIds)) {
            $this->query->whereIn('city_id', $cityIds);
        }
        return $this;
    }

    public function filterBySpecialization(int $spec_id): self
    {
        $this->query->where('category_specialization', $spec_id);
        return $this;
    }

    public function filterBySubSpecializations(array $spec_ids): self
    {
        if (!empty($spec_ids)) {
            $this->query->whereHas('specializations', function ($q) use ($spec_ids) {
                $q->whereIn('cpec_id', $spec_ids);
            });
        }

        return $this;
    }

    public function filterByBusinessTrip(?int $btID): self
    {
        if ($btID) {
            $this->query->whereHas('businessTripsValues', function ($query) use ($btID) {
                $query->where('bt_id', $btID);
            });
        }
        return $this;
    }

    public function filterBySalaryRange(?int $minSalary = null, ?int $maxSalary = null, ?int $currencyId = null): self
    {
        $hasNotNullSalary = $this->query->whereNotNull('salary')->exists();

        if ($hasNotNullSalary) {
            $this->query->where(function ($query) use ($minSalary, $maxSalary, $currencyId) {
                $query->whereNotNull('salary');

                if ($minSalary !== null) {
                    $query->where('salary', '>=', $minSalary);
                }

                if ($maxSalary !== null) {
                    $query->where('salary', '<=', $maxSalary);
                }

                if ($currencyId !== null) {
                    $query->where('currency', $currencyId);
                }
            });
        } else {
            $this->query->orWhereNull('salary');
        }

        return $this;
    }

    public function filterByNoExperience(): self
    {
        $this->query->whereDoesntHave('workExperiences');
        return $this;
    }

    public function filterByOneToThreeYearsExperience($query): self
    {
        $query->where(function ($subQuery) {
            $subQuery->whereRaw(
                '(SELECT SUM(TIMESTAMPDIFF(MONTH, start_date, IFNULL(end_date, CURRENT_DATE))) FROM resume_work_experiences WHERE resume_work_experiences.resume_id = resumes.id) BETWEEN ? AND ?',
                [12, 36]  // Опыт от 12 до 36 месяцев
            );
        });

        return $this;
    }

    public function filterByThreeToSixYearsExperience($query): self
    {
        $query->where(function ($subQuery) {
            $subQuery->whereRaw(
                '(SELECT SUM(TIMESTAMPDIFF(MONTH, start_date, IFNULL(end_date, CURRENT_DATE))) FROM resume_work_experiences WHERE resume_work_experiences.resume_id = resumes.id) BETWEEN ? AND ?',
                [36, 72]  // Опыт от 36 до 72 месяцев
            );
        });

        return $this;
    }

    public function filterByMoreThanSixYearsExperience($query): self
    {
        $query->where(function ($subQuery) {
            $subQuery->whereRaw(
                '(SELECT SUM(TIMESTAMPDIFF(MONTH, start_date, IFNULL(end_date, CURRENT_DATE))) FROM resume_work_experiences WHERE resume_work_experiences.resume_id = resumes.id) > ?',
                [72]  // Опыт более 72 месяцев
            );
        });

        return $this;
    }

    public function filterByExperienceIds(array $experienceIds): self
    {
        $this->query->where(function ($query) use ($experienceIds) {
            if (in_array(1, $experienceIds)) {
                $query->orWhereDoesntHave('workExperiences');
            }
            if (in_array(2, $experienceIds)) {
                $query->orWhereHas('workExperiences', function ($query) {
                    $this->filterByOneToThreeYearsExperience($query);
                });
            }
            if (in_array(3, $experienceIds)) {
                $query->orWhereHas('workExperiences', function ($query) {
                    $this->filterByThreeToSixYearsExperience($query);
                });
            }
            if (in_array(4, $experienceIds)) {
                $query->orWhereHas('workExperiences', function ($query) {
                    $this->filterByMoreThanSixYearsExperience($query);
                });
            }
        });

        return $this;
    }

    public function filterByGenderId(?int $genderId): self
    {
        if ($genderId !== null) {
            $this->query->whereHas('account', function ($query) use ($genderId) {
                $query->whereHas('user', function ($query) use ($genderId) {
                    $query->where('gender_id', $genderId);
                });
            });
        }

        return $this;
    }

    public function filterByBusynessIds(array $busynessIds = []): self
    {
        if (!empty($busynessIds)) {
            $this->query->whereHas('resumeBusynessValues', function ($query) use ($busynessIds) {
                $query->whereIn('busy_id', $busynessIds);
            });
        }

        return $this;
    }

    public function filterByScheduleIds(array $scheduleIds = [])
    {
        if (!empty($scheduleIds)) {
            $this->query->whereHas('resumeScheduleValues', function ($query) use ($scheduleIds) {
                $query->whereIn('schedule_id', $scheduleIds);
            });
        }

        return $this;
    }

    public function filterByWorkFormatIds(array $workFormatIds = [])
    {
        if (!empty($workFormatIds)) {
            $this->query->whereHas('resumeWorkFormatValues', function ($query) use ($workFormatIds) {
                $query->whereIn('work_format_id', $workFormatIds);
            });
        }

        return $this;
    }

    const HAVE_CAR = 1;

    public function filterByHaveCar($haveCar = null)
    {
        if ($haveCar != 1) {
            return $this;
        }

        return $this->query->where('have_car', self::HAVE_CAR);
    }

    public function filterByAvatar($hasAvatar = null)
    {
        if ($hasAvatar) {
            $this->query->whereNotNull('avatar');
        } else {
            $this->query->whereNull('avatar');
        }

        return $this;
    }

    public function filterByDrivingCategory(array $categoryIds = [])
    {
        if (!empty($categoryIds)) {
            $this->query->whereHas('drivingCategories', function ($query) use ($categoryIds) {
                $query->whereIn('category', $categoryIds);
            });
        }

        return $this;
    }

    public function filterByPublicationTime(?int $timeId): self
    {
        if ($timeId !== null) {
            $seconds = TimeOfPublication::find($timeId)->seconds;

            if ($seconds === null) {
                return $this;
            }

            $dateFrom = Carbon::now()->subSeconds($seconds)->toDateTimeString();

            $this->query->where('updated_at', '>=', $dateFrom);
        }

        return $this;
    }

    public function filterBySkills(?array $skills): self
    {
        if ($skills !== null && !empty($skills)) {
            $this->query->whereHas('skills', function ($query) use ($skills) {
                $query->whereIn('skill', $skills);
            });
        }

        return $this;
    }

    public function filterByCitizenship(?array $citizenshipIds)
    {
        if ($citizenshipIds !== null && !empty($citizenshipIds)) {
            $this->query->whereHas('citizenship', function ($query) use ($citizenshipIds) {
                $query->whereIn('country_id', $citizenshipIds);
            });
        }

        return $this;
    }

    public function filterByPermits(?array $permitsIds)
    {
        if ($permitsIds !== null && !empty($permitsIds)) {
            $this->query->whereHas('permits', function ($query) use ($permitsIds) {
                $query->whereIn('country_id', $permitsIds);
            });
        }

        return $this;
    }

    public function filterByAgeRange(?int $minAge, ?int $maxAge): self
    {
        if ($minAge !== null || $maxAge !== null) {
            $this->query->whereHas('account', function ($query) use ($minAge, $maxAge) {
                $query->whereHas('user', function ($query) use ($minAge, $maxAge) {
                    if ($minAge !== null) {
                        $oldestBirthDate = Carbon::now()->subYears($minAge)->format('Y-m-d');
                        $query->where('birthday', '<=', $oldestBirthDate);
                    }
                    if ($maxAge !== null) {
                        $youngestBirthDate = Carbon::now()->subYears($maxAge)->format('Y-m-d');
                        $query->where('birthday', '>=', $youngestBirthDate);
                    }
                });
            });
        }

        return $this;
    }

    public function searchResumes(?string $jobTitle = null, ?string $companyName = null, ?string $skill = null)
    {
        $this->query
            ->when($jobTitle, function ($query, $jobTitle) {
                return $query->where('job_title', 'LIKE', "%{$jobTitle}%");
            })
            ->when($companyName, function ($query, $companyName) {
                return $query->whereHas('workExperiences', function ($query) use ($companyName) {
                    $query->where('company_name', 'LIKE', "%{$companyName}%");
                });
            })
            ->when($skill, function ($query, $skill) {
                return $query->whereHas('skills', function ($query) use ($skill) {
                    $query->where('skill', 'LIKE', "%{$skill}%");
                });
            });

        return $this;
    }

    public function filterByLanguagesAndLevels(?array $filterLanguages = []): self
    {
        if (!empty($filterLanguages)) {
            $this->query->whereHas('resume_languages', function ($query) use ($filterLanguages) {
                foreach ($filterLanguages as $index => $filter) {
                    if ($index === 0) {
                        $query->where(function ($subQuery) use ($filter) {
                            $this->applyLanguageLevelFilter($subQuery, $filter);
                        });
                    } else {
                        $query->orWhere(function ($subQuery) use ($filter) {
                            $this->applyLanguageLevelFilter($subQuery, $filter);
                        });
                    }
                }
            });
        }

        return $this;
    }

    protected function applyLanguageLevelFilter($query, $filter)
    {
        if (isset($filter['language_id'])) {
            $query->where('lang_id', $filter['language_id']);
        }

        if (isset($filter['level_id'])) {
            $query->where('lang_level', $filter['level_id']);
        }
    }

    public function filterByStatus(?string $status = 'all'): self
    {
        $this->query->when($status, function ($query, $status) {
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

        return $this;
    }

    public function filterByOrder(?string $order = null): self
    {
        if ($order) {
            switch ($order) {
                case 'salary_asc':
                    $this->query->orderBy('salary', 'asc');
                    break;
                case 'salary_desc':
                    $this->query->orderBy('salary', 'desc');
                    break;
            }
        }

        return $this;
    }

    public function get()
    {
        return $this->query->paginate(12);
    }
}
