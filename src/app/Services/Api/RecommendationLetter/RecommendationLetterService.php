<?php

namespace App\Services\Api\RecommendationLetter;

use App\Models\Account;
use App\Models\Company;
use App\Models\RecommendationLetter;
use App\Models\RecommendationRating;
use App\Services\Api\Account\AccountService;
use Illuminate\Http\Request;

class RecommendationLetterService implements RecommendationLetterServiceInterface
{
    private AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function getCurrentCompany()
    {
        $loggedAsId = $this->accountService->getLoggedAs();

        if (!$loggedAsId) {
            return null;
        }

        $select = Company::select('id', 'name_full', 'logo_image_id')
            ->with(['logoCompany' => function ($query) {
                $query->select('id', 'file_name', 'file_path', 'file_type');
            }])
            ->find($loggedAsId);

        if (!$select) {
            return ['error' => 'Company not found'];
        }

        $company = [
            "id" => $select["id"],
            "name" => $select["name_full"],
            "logo_path" => $select->logoCompany ? $select->logoCompany->file_path : null // это проверка на существование связи и file_path
        ];

        return $company;
    }

    private function prepareData(array $data): array
    {
        $work_start_period = $data['work_start_period'];
        $work_end_period = $data['work_end_period'];

        if (strtotime($work_start_period) > strtotime($work_end_period)) {
            throw new \InvalidArgumentException('work_start_period cannot be later than work_end_period');
        }

        return [
            'work_place' => $data['work_place'],
            'fio' => $data['fio'],
            'job_position' => $data['job_position'],
            'work_start_period' => $work_start_period,
            'work_end_period' => $work_end_period,
            'responsibilities' => $data['responsibilities'] ?? null,
            'performance_review' => $data['performance_review'] ?? null,
            'recommendation_summary' => $data['recommendation_summary'] ?? null,
            'personal_traits' => $data['personal_traits'] ?? null,
            'recommendation_rating_id' => $data['recommendation_rating_id'] ?? 1,
            'contact_for_details' => $data['contact_for_details'] ?? null,
            'position_recommender' => $data['position_recommender'],
            'fio_recommender' => $data['fio_recommender'],
            'account_id' => $this->accountService->getAccountId(),
        ];
    }

    private function returnData(RecommendationLetter $recommendationLetter): array
    {
        return [
            'id' => $recommendationLetter->id,
            'work_place' => $recommendationLetter->work_place,
            'company' => [
                'id' => $this->getCurrentCompany()['id'],
                'name' => $this->getCurrentCompany()['name'],
                'logo_path' => $this->getCurrentCompany()['logo_path'],
            ],
            'fio' => $recommendationLetter->fio,
            'job_position' => $recommendationLetter->job_position,
            'work_start_period' => $recommendationLetter->work_start_period,
            'work_end_period' => $recommendationLetter->work_end_period,
            'responsibilities' => htmlspecialchars($recommendationLetter->responsibilities) ?? null,
            'performance_review' => htmlspecialchars($recommendationLetter->performance_review) ?? null,
            'recommendation_summary' => htmlspecialchars($recommendationLetter->recommendation_summary) ?? null,
            'personal_traits' => htmlspecialchars($recommendationLetter->personal_traits) ?? null,
            'recommendation_rating_id' => $recommendationLetter->recommendation_rating_id,
            'contact_for_details' => htmlspecialchars($recommendationLetter->contact_for_details) ?? null,
            'position_recommender' => $recommendationLetter->position_recommender,
            'fio_recommender' => $recommendationLetter->fio_recommender,
        ];
    }

    public function createRecommendationLetter(array $data)
    {
        $preparedData = $this->prepareData($data);

        $testTask = RecommendationLetter::create($preparedData);

        $data = $this->returnData($testTask);

        return $data;
    }

    public function editRecommendationLetter(int $id, array $data)
    {
        $recommendationLetter = RecommendationLetter::where('account_id', $this->accountService->getAccountId())
            ->where('id', $id)
            ->where('is_archive', 0)
            ->first();;

        if (!$recommendationLetter) {
            return false;
        }

        $recommendationLetter->update($data);

        $recommendationLetter = $this->returnData($recommendationLetter);

        return $recommendationLetter;
    }

    public function getRecommendationLetters()
    {
        $account = Account::find($this->accountService->getAccountId());

        $recommendationLetters = $account->recommendationLetters()
            ->select('id', 'fio', 'job_position', 'work_start_period', 'work_end_period', 'responsibilities', 'created_at')
            ->where('is_archive', 0)
            ->get();

        return $recommendationLetters;
    }

    public function getRecommendationLetter(int $id): array
    {
        $recommendationLetter = RecommendationLetter::with('rating')
            ->where('account_id', $this->accountService->getAccountId())
            ->where('id', $id)
            ->where('is_archive', 0)
            ->first();

        if (!$recommendationLetter) {
            return [
                "error" => true
            ];
        }

        $rating = $recommendationLetter->rating;

        $result = [];

        $result[] = [
            'id' => $recommendationLetter->id,
            'work_place' => $recommendationLetter->work_place,
            'company' => [
                'id' => $this->getCurrentCompany()['id'],
                'name' => $this->getCurrentCompany()['name'],
                'logo_path' => $this->getCurrentCompany()['logo_path'],
            ],
            'fio' => $recommendationLetter->fio,
            'job_position' => $recommendationLetter->job_position,
            'work_start_period' => $recommendationLetter->work_start_period,
            'work_end_period' => $recommendationLetter->work_end_period,
            'responsibilities' => $recommendationLetter->responsibilities,
            'performance_review' => $recommendationLetter->performance_review,
            'recommendation_summary' => $recommendationLetter->recommendation_summary,
            'personal_traits' => $recommendationLetter->personal_traits,
            'contact_for_details' => $recommendationLetter->contact_for_details,
            'position_recommender' => $recommendationLetter->position_recommender,
            'fio_recommender' => $recommendationLetter->fio_recommender,
            'created_at' => $recommendationLetter->created_at,
            'rating' => [
                'id' => $rating->id,
                'title' => $rating->title
            ],
        ];

        return $result;
    }

    public function removeRecommendationLetters(Request $request)
    {
        $countMatching = RecommendationLetter::whereIn('id', $request->ids)
            ->where('account_id', $this->accountService->getAccountId())
            ->count();

        if ($countMatching !== count($request->ids)) {
            return false;
        }

        $updatedCount = RecommendationLetter::whereIn('id', $request->ids)
            ->where('is_archive', 0)
            ->where('account_id', $this->accountService->getAccountId())
            ->update(['is_archive' => 1]);

        if ($updatedCount == 0) {
            return false;
        }

        return true;
    }


    public function getRecommendationRatings()
    {
        $ratings = RecommendationRating::select('id', 'title')->get();

        return $ratings;
    }
}
