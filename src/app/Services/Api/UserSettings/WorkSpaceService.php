<?php

namespace App\Services\Api\UserSettings;

use App\Http\Requests\Settings\UpdateWorkSpaceRequest;
use App\Models\WorkSpace;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;

class WorkSpaceService
{
    use HttpResponse;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {

            $workSpaceModel = WorkSpace::where('account_id', Auth::id())->get();
            $work_spaces = [];

            foreach ($workSpaceModel as $work_space) {
                foreach ($work_space->section as $item) {
                    $work_spaces[] = [
                        'id' => $work_space['id'],
                        'is_active' => $work_space['is_active'],
                        'title' => $item->title,
                    ];
                }
            }

            if (empty($work_spaces)) {
                return $this->error('Workspace not found', 'error', 404);
            }

            return $this->success($work_spaces);
        } catch (\Exception $exception) {
            return $this->error('Unknown error');
        }
    }

    public function update(UpdateWorkSpaceRequest $request)
    {
        try {
            $id = $request->input('id');
            $is_active = $request->input('is_active');
            $work_space = WorkSpace::where('account_id', Auth::id())
                ->where('id', $id)->first();
            if (!$work_space) {
                return $this->error('Workspace Not Found', 'error', 404);
            }
            $work_space->is_active = $is_active;
            $work_space->save();
            return $this->success($work_space);
        } catch (\Exception $exception) {
            return $this->error('Unknown error');
        }
    }
}
