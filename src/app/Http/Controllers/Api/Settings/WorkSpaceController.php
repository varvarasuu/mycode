<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateWorkSpaceRequest;
use App\Services\Api\UserSettings\WorkSpaceService;
use App\Traits\HttpResponse;

/**
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\Settings
 *
 * @group UserSettings
 *
 * @unauthenticated
 */
class WorkSpaceController extends Controller
{
    use HttpResponse;

    private WorkSpaceService $service;

    public function __construct(WorkSpaceService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Show
     *
     * @subgroup WorkSpaces
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для вывода рабочего пространства текущего пользователя
     *
     * @responseFile status=200 scenario="Рабочее пространство пользователя успешно получено" storage/responses/UserSettings/WorkSpace/index/index-success.json
     * @responseFile status=500 scenario="Внутреняя ошибка сервера" storage/responses/UserSettings/WorkSpace/index/index-unknown-error.json
     */
    public function index()
    {
        return $this->service->index();
    }

    /**
     * Update
     *
     * @subgroup WorkSpaces
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для изменения рабочего пространства текущего пользователя
     *
     * @bodyParam id int required Это поле является обязательным, Example: 1
     *
     * @responseFile status=200 scenario="Рабочее пространство пользователя успешно измененно" storage/responses/UserSettings/WorkSpace/update/update-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/UserSettings/WorkSpace/update/update-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/UserSettings/WorkSpace/update/update-credentials.json
     */
    public function update(UpdateWorkSpaceRequest $request)
    {
        return $this->service->update($request);
    }
}
