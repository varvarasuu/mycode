<?php

namespace App\Services\Api\EmployerFiles;

use App\Helpers\Logger;
use App\Http\Requests\EmployerFile\TestTaskRequest;
use App\Http\Requests\EmployerFile\TestTaskEditRequest;
use App\Models\Account;
use App\Models\Company;
use App\Models\MediaFile;
use App\Models\TestTask;
use App\Models\Vacancy;
use App\Services\Api\MediaFile\MediaFileService;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TestTaskFile;

class TestTaskService
{
    use HttpResponse;

    private Logger $logger;
    private MediaFileService $md_service;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
        $this->md_service = new MediaFileService();
    }

    public function getMyTestTask(int $id)
    {
        $myTestTasks = DB::select("
                SELECT test_tasks.id AS id, vacancies.title AS title, test_tasks.description AS description
                FROM test_tasks
                INNER JOIN vacancies ON test_tasks.vacancy_id = vacancies.id
                WHERE test_tasks.detail_list_employees_id = :employer_id;
            ", ['employer_id' => Auth::id()]);

        $testTask = null;

        foreach ($myTestTasks as $myTestTask) {
            if ($myTestTask->id == $id) {
                $testTask = TestTask::find($id);
            }
        }

        return $testTask;
    }

    public function index()
    {
        try {
            $testTasks = TestTask::select('test_tasks.id as id', 'vacancies.title as title', 'test_tasks.description as description')
                ->join('vacancies', 'test_tasks.vacancy_id', '=', 'vacancies.id')
                ->where('test_tasks.detail_list_employees_id', Auth::id())
                ->get();

            return $this->success($testTasks);
        } catch (\Exception $exception) {
            return $this->error('Unknown error');
        }
    }

    public function create(TestTaskRequest $request)
    {
        try {
            $company_id = Account::find(Auth::id())->logged_as;

            $myCompany = Company::find($company_id);
            if (!$myCompany) {
                return $this->error("company not found");
            }

            $folder_name_cover = 'uploads/test-task/files/' . $company_id;

            $path_covers = [];

            $fkeys = [
                "file_1",
                "file_2",
                "file_3"
            ];

            foreach ($fkeys as $file) {
                if ($request->hasFile($file)) {
                    $path_cover = $this->md_service->storeOne($request->file($file), $folder_name_cover);
                    $path_covers[] = $path_cover;
                } else {
                    if ($myCompany->cover_image_id != null) {
                        $this->md_service->delete($myCompany->cover_image_id);
                        $myCompany->cover_image_id = null;
                    }
                }
            }

            $test_task = TestTask::create([
                'vacancy_id' => $request->input('vacancy_id'),
                'description' => $request->input('description'),
                'material_link' => $request->input('material_link'),
                'format' => $request->input('format'),
                'days_for_task_id' => $request->input('days_for_task_id'),
                'file_1' => $path_covers[0]->id ?? null,
                'file_2' => $path_covers[1]->id ?? null,
                'file_3' => $path_covers[2]->id ?? null,
                'detail_list_employees_id' => Auth::id()
            ]);

            $vacancy = Vacancy::find($test_task['vacancy_id']);

            $carbonDate = Carbon::parse($test_task['created_at']);
            $date_of_creation = $carbonDate->format('Y-m-d H:i:s');

            $testTask = [
                'id' => $test_task['id'],
                'title' => htmlspecialchars($vacancy['title']),
                'description' => htmlspecialchars($test_task['description']),
                'material_link' => htmlspecialchars($test_task['material_link']),
                'format' => htmlspecialchars($test_task['format']),
                'deadline' => $test_task->days_for_task->title,
                'file_1' => $path_covers[0]->file_path ?? null,
                'file_2' => $path_covers[1]->file_path ?? null,
                'file_3' => $path_covers[2]->file_path ?? null,
                'date_of_creation' => $date_of_creation
            ];

            return $this->success($testTask);
        } catch (\Exception $exception) {
            return $this->error('Unknown error');
        }
    }

    public function get(int $id)
    {
        try {
            $test_task = $this->getMyTestTask($id);

            if ($test_task != null) {
                $vacancy = Vacancy::find($test_task['vacancy_id']);

                $test_task['file_1_path'] = $this->md_service->getImagePathAndFileName($test_task['file_1']);
                $test_task['file_2_path'] = $this->md_service->getImagePathAndFileName($test_task['file_2']);
                $test_task['file_3_path'] = $this->md_service->getImagePathAndFileName($test_task['file_3']);

                $testTask = [
                    'id' => $test_task->id,
                    'vacancy_id' => $vacancy->id,
                    'vacancy_title' => $vacancy->title,
                    'description' => $test_task->description,
                    'material_link' => $test_task->material_link,
                    'format' => $test_task->format,
                    'deadline_id' => $test_task->days_for_task->id,
                    'deadline_title' => $test_task->days_for_task->title,
                    'file_1' => $test_task['file_1_path'],
                    'file_2' => $test_task['file_2_path'],
                    'file_3' => $test_task['file_3_path']
                ];

                return $this->success($testTask);
            } else {
                return $this->notFound('test task not found');
            }
        } catch (\Exception $exception) {
            return $this->error('Unknown error');
        }
    }

    public function edit(int $id, TestTaskRequest $request)
    {
        try {
            $company_id = Account::find(Auth::id())->logged_as;

            $myCompany = Company::find($company_id);
            if (!$myCompany) {
                return $this->error("company not found");
            }

            $folder_name_cover = 'uploads/test-task/files/' . $company_id;

            $path_covers = [];

            $fkeys = [
                "file_1",
                "file_2",
                "file_3"
            ];

            foreach ($fkeys as $file) {
                if ($request->hasFile($file)) {
                    $path_cover = $this->md_service->storeOne($request->file($file), $folder_name_cover);
                    $path_covers[] = $path_cover;
                } else {
                    if ($myCompany->cover_image_id != null) {
                        $this->md_service->delete($myCompany->cover_image_id);
                        $myCompany->cover_image_id = null;
                    }
                }
            }

            $test_task = TestTask::find($id);

            $test_task->vacancy_id = $request->input('vacancy_id');
            $test_task->description = $request->input('description');
            $test_task->material_link = $request->input('material_link');
            $test_task->format = $request->input('format');
            $test_task->days_for_task_id = $request->input('days_for_task_id');
            $test_task->file_1 = $path_covers[0]->id ?? null;
            $test_task->file_2 = $path_covers[1]->id ?? null;
            $test_task->file_3 = $path_covers[2]->id ?? null;

            $test_task->update();

            $vacancy = Vacancy::find($test_task['vacancy_id']);

            $testTask = [
                'id' => $test_task['id'],
                'title' => htmlspecialchars($vacancy['title']),
                'description' => htmlspecialchars($test_task['description']),
                'material_link' => htmlspecialchars($test_task['material_link']),
                'format' => htmlspecialchars($test_task['format']),
                'deadline' => $test_task->days_for_task->title,
                'file_1' => $path_covers[0]->file_path ?? null,
                'file_2' => $path_covers[1]->file_path ?? null,
                'file_3' => $path_covers[2]->file_path ?? null,
            ];

            return $this->success($testTask);
        } catch (\Exception $exception) {
            return $this->error('Unknown error');
        }
    }

    public function removeTestTasks(Request $request)
    {
        try {
            foreach ($request->ids as $id) {
                $result[] = TestTask::where('id', $id)->where('detail_list_employees_id', '=', Auth::id())->delete();
            }
            if ($result) {
                return $this->success('Test task deleted');
            } else {
                return $this->success('Test task not found');
            }
        } catch (\Exception $exception) {
            return $this->error('Unknown error');
        }
    }
}
