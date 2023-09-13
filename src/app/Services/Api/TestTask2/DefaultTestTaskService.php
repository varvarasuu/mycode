<?php

namespace App\Services\Api\TestTask2;

use App\Models\Account;
use App\Models\TestTask;
use App\Services\Api\Account\AccountService;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DefaultTestTaskService implements DefaultTestTaskServiceInterface
{
    use HttpResponse;

    private AccountService $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function createTestTask(array $data): array
    {
        $preparedData = $this->prepareData($data);

        $testTask = TestTask::create($preparedData);

        $this->saveFiles($testTask, $data['files'] ?? []);

        $data = $this->returnData($testTask);

        return $data;
    }

    private function prepareData(array $data): array
    {
        return [
            'vacancy_id' => $data['vacancy_id'],
            'description' => $data['description'],
            'material_link' => $data['material_link'] ?? null,
            'format' => $data['format'] ?? null,
            'account_id' => $this->accountService->getAccountId(),
            'test_task_deadline_id' => $data['test_task_deadline_id'],
            'detail_list_employees_id' => $this->accountService->getLoggedAs(),
        ];
    }

    private function saveFiles(TestTask $testTask, array $images): void
    {
        $filePaths = [];
        foreach ($images as $image) {
            $filePath = $image->store('test_tasks_images', 'public');
            $filePaths[] = ['image_path' => '/storage/' . $filePath];
        }

        $testTask->files()->createMany($filePaths);
    }

    private function getFiles($testTaskID)
    {
        $fileData = TestTask::find($testTaskID)->files->map(function ($file) {
            return [
                'id' => $file->id,
                'path' => $file->image_path,
            ];
        });

        return $fileData;
    }

    private function overwriteFiles(TestTask $testTask, array $images): void
    {
        foreach ($testTask->files as $file) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $file->image_path));
            $file->delete();
        }

        $filePaths = [];
        foreach ($images as $image) {
            $filePath = $image->store('test_tasks_images', 'public');
            $filePaths[] = ['image_path' => '/storage/' . $filePath];
        }

        $testTask->files()->createMany($filePaths);
    }

    private function returnData(TestTask $testTask,): array
    {
        return [
            'id' => $testTask['id'],
            'vacancy_id' => $testTask['vacancy_id'],
            'description' => htmlspecialchars($testTask['description']),
            'material_link' => htmlspecialchars($testTask['material_link']) ?? null,
            'format' => htmlspecialchars($testTask['format']) ?? null,
            'test_task_deadline_id' => $testTask['test_task_deadline_id'],
            'detail_list_employees_id' => $this->accountService->getLoggedAs(),
            'files' => $this->getFiles($testTask->id)
        ];
    }

    public function getTestTasks()
    {
        $account = Account::find($this->accountService->getAccountId());

        $testTasks = $account->testTasks()
            ->select('id', 'description', 'vacancy_id', 'created_at')
            ->where('is_archive', 0)
            ->with('vacancy:id,title')
            ->get();

        return $testTasks;
    }

    public function getTestTask(int $id): array
    {
        $testTask = TestTask::with(['vacancy:id,title', 'files', 'deadline'])
            ->where('account_id', $this->accountService->getAccountId())
            ->where('id', $id)
            ->where('is_archive', 0)
            ->first();

        if (!$testTask) {
            return [
                "error" => true
            ];
        }

        $vacancy = $testTask->vacancy;
        $files = $testTask->files()->select('id', 'image_path')->get();
        $deadline = $testTask->deadline;

        $result = [];

        $result[] = [
            'id' => $testTask->id,
            'vacancy' => [
                'id' => $vacancy->id,
                'title' => $vacancy->title
            ],
            'description' => $testTask->description,
            'material_link' => $testTask->material_link,
            'format' => $testTask->format,
            'deadline' => [
                'id' => $deadline->id,
                'title' => $deadline->title
            ],
            'files' => $files
        ];

        return $result;
    }

    public function editTestTask(int $id, $data)
    {
        $testTask = TestTask::with(['vacancy:id,title', 'files', 'deadline'])
            ->where('account_id', $this->accountService->getAccountId())
            ->where('id', $id)
            ->where('is_archive', 0)
            ->first();

        if (!$testTask) {
            return false;
        }

        if (isset($data['files'])) {
            $this->overwriteFiles($testTask, $data['files']);
            unset($data['files']);
        }

        $testTask->update($data);

        $testTask = $this->returnData($testTask);

        return $testTask;
    }

    public function removeTestTasks(Request $request)
    {
        $result = [];

        foreach ($request->ids as $id) {
            $testTask = TestTask::where('id', $id)
                ->where('account_id', '=', $this->accountService->getAccountId())
                ->where('is_archive', 0)
                ->first();

            if ($testTask) {
                $testTask->is_archive = 1;
                $result[] = $testTask->save();
            }
        }

        if (array_sum($result) == 0) {
            return 0;
        }

        return $result;
    }
}
