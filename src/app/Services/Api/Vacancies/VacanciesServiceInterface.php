<?php

namespace App\Services\Api\Vacancies;

use App\Models\Vacancy;

interface VacanciesServiceInterface
{
    public function viewVacancy(int $id): array;
    public function createVacancy(array $data): array;
    public function updateVacancy(array $data): array;
    public function duplicateVacancy(int $vacancyId): array;
    public function deleteVacancy(int $vacancyId): void;
}
