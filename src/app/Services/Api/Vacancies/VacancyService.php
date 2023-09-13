<?php

namespace App\Services\Api\Vacancies;

use App\Models\Account;
use App\Models\Company;
use App\Models\Vacancy;
use App\Services\Api\Account\AccountService;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class VacancyService
{
    use HttpResponse;

    private $accountService;
    protected $vacancyModel;

    public function __construct(AccountService $accountService, Vacancy $vacancyModel)
    {
        $this->accountService = $accountService;
        $this->vacancyModel = $vacancyModel;
    }

    public function getCompanyVacancies()
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        $vacancies = Vacancy::where('company_id', $company_id)->get(['id', 'company_id', 'title']);
        return $this->success($vacancies);
    }

    public function getInctiveVacanciesRegions()
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        if (!$company_id) {
            throw new \Exception("No active company found.");
        }
        $query = Vacancy::where('company_id', $company_id)
            ->where('is_deleted', 0)
            ->where(function ($query) {
                $query->where('is_draft', 1)
                    ->orWhere('is_moderation', true)
                    ->orWhere('is_rejected', true)
                    ->orWhere('is_pending_payment', true);
            })
            ->with(['region']);
        $vacancies = $query->get();
        if ($vacancies->isEmpty()) {
            return response()->json([
                'regions' => [],
            ]);
        }        
        $uniqueRegions = $vacancies->pluck('region')->unique('id');
        $formattedRegions = $uniqueRegions->map(function ($region) {
            return [
                'id' => $region->id,
                'name' => $region->name,
            ];
        });
        return response()->json([
            'regions' => $formattedRegions,
        ]);
    }

    public function getActiveVacanciesRegions()
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        if (!$company_id) {
            throw new \Exception("No active company found.");
        }
        $query = Vacancy::where('company_id', $company_id)
            ->where('is_deleted', 0)
            ->where('is_active', 1)
            ->with(['region']);
        $vacancies = $query->get();
        if ($vacancies->isEmpty()) {
            return response()->json([
                'regions' => [],
            ]);
        }
        $uniqueRegions = $vacancies->pluck('region')->unique('id');
        $formattedRegions = $uniqueRegions->map(function ($region) {
            return [
                'id' => $region->id,
                'name' => $region->name,
            ];
        });
        return response()->json([
            'regions' => $formattedRegions,
        ]);
    }

    public function getArchieveVacanciesRegions()
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        if (!$company_id) {
            throw new \Exception("No active company found.");
        }
        $query = Vacancy::where('company_id', $company_id)
            ->where('is_deleted', 0)
            ->where('is_archieve', 1)
            ->with(['region']);
        $vacancies = $query->get();
        if ($vacancies->isEmpty()) {
            return response()->json([
                'regions' => [],
            ]);
        }
        $uniqueRegions = $vacancies->pluck('region')->unique('id');
        $formattedRegions = $uniqueRegions->map(function ($region) {
            return [
                'id' => $region->id,
                'name' => $region->name,
            ];
        });
        return response()->json([
            'regions' => $formattedRegions,
        ]);
    }

    public function getArchieveVacancies(Request $request)
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        if (!$company_id) {
            throw new \Exception("No active company found.");
        }
        $perPage = 10; // Количество записей на странице
        $query = Vacancy::where('company_id', $company_id)
            ->where('is_deleted', 0)
            ->where('is_archieve', 1)
            ->with(['region', 'account', 'user']);
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        // Сортировка по дате архивации (новые вакансии будут первыми)
        if ($request->has('archive_date_order')) {
            $query->orderBy('updated_at', 'desc');
        }
        // Фильтр по городам по ид
        if ($request->has('region_id')) {
            $query->where('city_id', $request->input('region_id'));
        }
        // Сортировка по дате создания (новые вакансии будут первыми)
        if ($request->has('created_at_order')) {
            $query->orderBy('created_at', 'desc');
        }
        $vacancies = $query->paginate($perPage);
        if ($vacancies->isEmpty()) {
            return response()->json([
                'page_count' => 0,
                'vacancy_count' => 0,
                'vacancy' => [],
            ]);
        }
        $formattedVacancies = $vacancies->map(function ($vacancy) {
            return [
                'id' => $vacancy->id,
                'title' => $vacancy->title,
                'region_id' => $vacancy->region->name,
                'account_id' => $vacancy->user->name.' '.$vacancy->user->lastname,
                'created_at' => $vacancy->created_at,
                'updated_at' => $vacancy->updated_at,
                'responses' => 14,
                'archiveDate' => $vacancy->updated_at,
                'period' => $vacancy->created_at->diffInDays($vacancy->updated_at),
            ];
        });
        return response()->json([
            'data' => $formattedVacancies,
            'pagination' => [
                'current_page' => $vacancies->currentPage(),
                'last_page' => $vacancies->lastPage(),
                'total' => $vacancies->total(),
            ],
        ]);
    }
    public function getActiveVacancies(Request $request)
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        if (!$company_id) {
            throw new \Exception("No active company found.");
        }
        $perPage = 10; // Количество записей на странице
        $query = Vacancy::where('company_id', $company_id)
            ->where('is_deleted', 0)
            ->where('is_active', 1)
            ->with(['region', 'account', 'user']);
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        if ($request->has('region_id')) {
            $query->where('city_id', $request->input('region_id'));
        }
        $sortField = $request->input('sort');

        if ($sortField == '2') {
            // Сортировка по возрастанию зарплаты
            $query->orderByRaw('COALESCE(salary_from, salary_to) ASC');
        } elseif ($sortField == '1') {
            // Сортировка по убыванию зарплаты
            $query->orderByRaw('COALESCE(salary_to, salary_from) DESC');
        } else {
            // Сортировка по умолчанию, если $sortField не задан
            $query->orderBy('created_at', 'desc');
        }

        $vacancies = $query->paginate($perPage);
        if ($vacancies->isEmpty()) {
            return response()->json([
                'page_count' => 0,
                'vacancy_count' => 0,
                'vacancy' => [],
            ]);
        }
        $formattedVacancies = $vacancies->map(function ($vacancy) {
            return [
                'date' => 'Осталось ' . $vacancy->created_at->diffInDays(now()) . ' дней',
                'id' => $vacancy->id,
                'title' => $vacancy->title,
                'power_up' => 0,
                'city' => ['id' => $vacancy->region->id, 'name' => $vacancy->region->name],
                'address' => 'Санкт-Петербург, санная улица 28',
                'responses' => 1,
                'new_responses' => 1,
                'worked' => 10,
                'suitable' => 1,
            ];
        });
        return response()->json([
            'page_count' => $vacancies->lastPage(),
            'vacancy_count' => $vacancies->total(),
            'vacancy' => $formattedVacancies,
        ]);
    }

    public function getInactiveVacancies(Request $request)
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        if (!$company_id) {
            throw new \Exception("No active company found.");
        }
        $perPage = 10;
        $query = Vacancy::where('company_id', $company_id)
            ->where('is_deleted', 0)
            ->where(function ($query) {
                $query->where('is_draft', 1)
                    ->orWhere('is_moderation', 1)
                    ->orWhere('is_rejected', 1)
                    ->orWhere('is_pending_payment', 1);
            })
            ->with(['region']);
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        if ($request->has('region_id')) {
            $query->where('city_id', $request->input('region_id'));
        }

        $sortField = $request->input('sort');
        switch ($sortField) {
            case 'salary_asc':
                $query->orderBy('salary', 'asc');
                break;
            case 'salary_desc':
                $query->orderBy('salary', 'desc');
                break;
            case 'date':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $vacancies = $query->paginate($perPage);
        if ($vacancies->isEmpty()) {
            return response()->json([
                'page_count' => 0,
                'vacancy_count' => 0,
                'vacancy' => [],
            ]);
        }
        $formattedVacancies = $vacancies->map(function ($vacancy) {
            $status = '';
            if ($vacancy->is_draft) {
                $status = 'Черновик';
            } elseif ($vacancy->is_moderation) {
                $status = 'На модерации';
            } elseif ($vacancy->is_rejected) {
                $status = 'Отклонено';
            } elseif ($vacancy->is_pending_payment) {
                $status = 'Ожидает оплаты';
            }
            return [
                'id' => $vacancy->id,
                'status' => $status,
                'title' => $vacancy->title,
                'city' => ['id' => $vacancy->region->id, 'name' => $vacancy->region->name],
                'address' => 'Санкт-Петербург, санная улица 28', // Статическое значение, пока решаем как будет работать адрес
            ];
        });
        return response()->json([
            'page_count' => $vacancies->lastPage(),
            'vacancy_count' => $vacancies->total(),
            'vacancy' => $formattedVacancies,
        ]);
    }

    public function deleteVacancyById($vacancyId)
    {
        $companyId = $this->accountService->getCurrentCompanyID();
        if (!$companyId) {
            throw new \Exception("No active company found.");
        }

        $vacancy = Vacancy::where('id', $vacancyId)
            ->where('company_id', $companyId)
            ->where('is_deleted', 0)
            ->where(function ($query) {
                $query->where('is_draft', 1)
                    ->orWhere('is_moderation', 1)
                    ->orWhere('is_rejected', 1)
                    ->orWhere('is_pending_payment', 1);
            })
            ->first();

        if (!$vacancy) {
            throw new \Exception("Vacancy not found or does not belong to the current company.");
        }

        // Удаляем вакансию
        $vacancy->delete();

        return response()->json(['message' => 'Вакансия успешно удалена']);
    }



}
