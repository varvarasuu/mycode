<?php

namespace App\Services\Api\JobOffer;

use App\Models\Account;
use App\Models\AvailabilityOption;
use App\Models\Company;
use App\Models\JobOffer;
use App\Services\Api\Account\AccountService;
use Illuminate\Http\Request;

class JobOfferService implements JobOfferServiceInterface
{
    protected AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function getJobOffers()
    {
        $account = Account::find($this->accountService->getAccountId());

        $jobOffers = $account->jobOffers()->where('is_archive', 0)->get();

        $data = [];
        foreach ($jobOffers as $offer) {
            $data[] = $this->returnDataForGetJobOffers($offer);
        }

        return $data;
    }

    private function returnDataForGetJobOffers(JobOffer $offer): array
    {
        return [
            'id' => $offer->id,
            'full_name' => $offer->full_name,
            'company' => [
                'id' => $this->getCurrentCompany()['id'],
                'name' => $this->getCurrentCompany()['name'],
                'logo_path' => $this->getCurrentCompany()['logo_path'],
            ],
            'vacancy' => [
                'id' => $offer->Vacancy->id,
                'name' => $offer->Vacancy->title,
            ],
            'reporting_to' => $offer->reporting_to,
            'responsibilities' => $offer->responsibilities,
            'created_at' => $offer->created_at,
        ];
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
            "logo_path" => $select->logoCompany ? $select->logoCompany->file_path : null
        ];

        return $company;
    }

    public function view($id)
    {
        $offer = JobOffer::where('id', $id)
            ->where('account_id', $this->accountService->getAccountId())
            ->where('is_archive', 0)->first();

        if (!$offer) {
            return false;
        }

        return $this->returnData($offer);
    }

    public function createJobOffer(array $request): array
    {
        $data = $this->prepareData($request);
        $offer = JobOffer::create($data);
        return $this->returnData($offer);
    }

    public function updateJobOffer(array $request)
    {
        $currentAccountId = $this->accountService->getAccountId();

        $offer = JobOffer::where('id', $request['offer_id'])
            ->where('is_archive', 0)
            ->where('account_id', $currentAccountId)
            ->first();

        if (!$offer) {
            return false;
        }

        $data = $this->prepareData($request);
        $offer->update($data);

        return $this->returnData($offer);
    }

    private function returnData(JobOffer $offer): array
    {
        $offer->load('Vacancy', 'WorkingWeek', 'ResumeSchedule', 'ResumeWorkFormats', 'WorkingHoursType');

        return [
            'id' => $offer->id,
            'full_name' => $offer->full_name,
            'company' => [
                'id' => $this->getCurrentCompany()['id'],
                'name' => $this->getCurrentCompany()['name'],
                'logo_path' => $this->getCurrentCompany()['logo_path'],
            ],
            'vacancy' => [
                'id' => $offer->Vacancy->id,
                'name' => $offer->Vacancy->title,
            ],
            'position_name' => $offer->position_name,
            'reporting_to' => $offer->reporting_to,
            'responsibilities' => $offer->responsibilities,
            'probation_period' => $offer->probation_period,
            'probation_duration_months' => $offer->probation_duration_months,
            'probation_tasks' => $offer->probation_tasks,
            'consider_new_responsibilities' => $offer->consider_new_responsibilities,
            'new_responsibilities' => $offer->new_responsibilities,
            'fixed_salary' => $offer->fixed_salary,
            'variable_salary_percentage' => $offer->variable_salary_percentage,
            'percentage_from' => $offer->percentage_from,
            'additional_bonuses' => $offer->additional_bonuses,
            'salary_paid' => $offer->salary_paid,
            'penalties' => $offer->penalties,
            'overtime_compensation' => $offer->overtime_compensation,
            'overtime_compensation_text' => $offer->overtime_compensation_text,
            'sick_leave_paid' => $offer->sick_leave_paid,
            'sick_leave_text' => $offer->sick_leave_text,
            'salary_review_opportunity' => $offer->salary_review_opportunity,
            'salary_indexation' => $offer->salary_indexation,
            'working_week' => [
                'id' => $offer->WorkingWeek->id,
                'title' => $offer->WorkingWeek->title,
            ],
            'working_day' => $offer->working_day,
            'work_start_time' => $offer->work_start_time,
            'work_end_time' => $offer->work_end_time,
            'lunch_break_duration' => $offer->lunch_break_duration,
            'lunch_break_start_time' => $offer->lunch_break_start_time,
            'lunch_break_end_time' => $offer->lunch_break_end_time,

            'work_schedule' => [
                'id' => $offer->ResumeSchedule->id,
                'title' => $offer->ResumeSchedule->title,
            ],
            'work_format' => [
                'id' => $offer->ResumeWorkFormats->id,
                'title' => $offer->ResumeWorkFormats->title,
            ],
            'working_hours_type' => [
                'id' => $offer->WorkingHoursType->id,
                'title' => $offer->WorkingHoursType->title,
            ],
            'work_address' => $offer->work_address,
            'vacation_duration' => $offer->vacation_duration,
            'job_start_date' => $offer->job_start_date,
            'job_start_time' => $offer->job_start_time,
            'additional_conditions' => $offer->additional_conditions,

            'contact_person' => $offer->contact_person,
            'position' => $offer->position,
            'phone_number' => $offer->phone_number,
            'email' => $offer->email,
            'call_time_from' => $offer->call_time_from,
            'call_time_to' => $offer->call_time_to,

            'availability_option' => [
                'id' => $offer->availability_option_id,
                'title' => AvailabilityOption::find($offer->availability_option_id)->title
            ],
            'response_due_date' => $offer->response_due_date,

            'created_at' => $offer->created_at,
        ];
    }

    private function prepareData(array $request): array
    {
        return [
            'account_id' => $this->accountService->getAccountId(),
            'full_name' => htmlspecialchars($request['full_name'] ?? '', ENT_QUOTES, 'UTF-8'),
            'vacancy_id' => $request['vacancy_id'] ?? null,
            'reporting_to' => htmlspecialchars($request['reporting_to'] ?? '', ENT_QUOTES, 'UTF-8'),
            'responsibilities' => htmlspecialchars($request['responsibilities'] ?? '', ENT_QUOTES, 'UTF-8'),
            'probation_duration_months' => $request['probation_duration_months'] ?? null,
            'probation_tasks' => htmlspecialchars($request['probation_tasks'] ?? '', ENT_QUOTES, 'UTF-8'),
            'consider_new_responsibilities' => $request['consider_new_responsibilities'] ?? null,
            'new_responsibilities' => htmlspecialchars($request['new_responsibilities'] ?? '', ENT_QUOTES, 'UTF-8'),
            'fixed_salary' => $request['fixed_salary'] ?? null,
            'variable_salary_percentage' => $request['variable_salary_percentage'] ?? null,
            'percentage_from' => $request['percentage_from'] ?? null,
            'additional_bonuses' => htmlspecialchars($request['additional_bonuses'] ?? '', ENT_QUOTES, 'UTF-8'),
            'salary_paid' => htmlspecialchars($request['salary_paid'] ?? '', ENT_QUOTES, 'UTF-8'),
            'penalties' => htmlspecialchars($request['penalties'] ?? '', ENT_QUOTES, 'UTF-8'),
            'overtime_compensation' => $request['overtime_compensation'] ?? null,
            'overtime_compensation_text' => htmlspecialchars($request['overtime_compensation_text'] ?? '', ENT_QUOTES, 'UTF-8'),
            'sick_leave_paid' => $request['sick_leave_paid'] ?? null,
            'sick_leave_text' => htmlspecialchars($request['sick_leave_text'] ?? '', ENT_QUOTES, 'UTF-8'),
            'salary_review_opportunity' => $request['salary_review_opportunity'] ?? null,
            'salary_indexation' => $request['salary_indexation'] ?? null,
            'working_week_id' => $request['working_week_id'] ?? null,
            'working_day' => htmlspecialchars($request['working_day'] ?? '', ENT_QUOTES, 'UTF-8'),
            'work_start_time' => $request['work_start_time'] ?? null,
            'work_end_time' => $request['work_end_time'] ?? null,
            'lunch_break_duration' => htmlspecialchars($request['lunch_break_duration'] ?? '', ENT_QUOTES, 'UTF-8'),
            'lunch_break_start_time' => $request['lunch_break_start_time'] ?? null,
            'lunch_break_end_time' => $request['lunch_break_end_time'] ?? null,
            'work_schedule_id' => $request['work_schedule_id'] ?? null,
            'work_format_id' => $request['work_format_id'] ?? null,
            'working_hours_type_id' => $request['working_hours_type_id'] ?? null,
            'work_address' => htmlspecialchars($request['work_address'] ?? '', ENT_QUOTES, 'UTF-8'),
            'vacation_duration' => htmlspecialchars($request['vacation_duration'] ?? '', ENT_QUOTES, 'UTF-8'),
            'job_start_date' => $request['job_start_date'] ?? null, // Assuming this is a date and doesn't need to be escaped
            'job_start_time' => $request['job_start_time'] ?? null, // Assuming this is a date and doesn't need to be escaped
            'additional_conditions' => htmlspecialchars($request['additional_conditions'] ?? '', ENT_QUOTES, 'UTF-8'),

            'contact_person' => htmlspecialchars($request['contact_person'] ?? '', ENT_QUOTES, 'UTF-8'),
            'position' => htmlspecialchars($request['position'] ?? '', ENT_QUOTES, 'UTF-8'),
            'phone_number' => htmlspecialchars($request['phone_number'] ?? '', ENT_QUOTES, 'UTF-8'),
            'email' => htmlspecialchars($request['email'] ?? '', ENT_QUOTES, 'UTF-8'),
            'call_time_from' => $request['call_time_from'] ?? null,
            'call_time_to' => $request['call_time_to'] ?? null,
            'availability_option_id' => $request['availability_option_id'] ?? null,
            'response_due_date' => $request['response_due_date'] ?? null,
        ];
    }

    public function removeJobOffers(Request $request)
    {
        $countMatching = JobOffer::whereIn('id', $request->ids)
            ->where('is_archive', 0)
            ->where('account_id', $this->accountService->getAccountId())
            ->count();

        if ($countMatching !== count($request->ids)) {
            return false;
        }

        $archivedCount = JobOffer::whereIn('id', $request->ids)
            ->where('is_archive', 0)
            ->where('account_id', $this->accountService->getAccountId())
            ->update(['is_archive' => 1]);

        if ($archivedCount == 0) {
            return false;
        }

        return true;
    }
}
