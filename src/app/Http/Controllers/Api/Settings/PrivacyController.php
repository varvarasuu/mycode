<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdatePrivacyRequest;
use App\Services\Api\UserSettings\PrivacyService;
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
class PrivacyController extends Controller
{
    use HttpResponse;

    private PrivacyService $service;

    public function __construct(PrivacyService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Show
     *
     * @subgroup Privacy
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для вывода приватности текущего пользователя
     *
     * @responseFile status=200 scenario="Рабочее пространство пользователя успешно получено" storage/responses/UserSettings/Privacy/index/index-success.json
     * @responseFile status=500 scenario="Внутреняя ошибка сервера" storage/responses/UserSettings/Privacy/index/index-unknown-error.json
     */
    public function index()
    {
        return $this->service->index();
    }

    /**
     * Update
     *
     * @subgroup Privacy
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для изменения приватности текущего пользователя
     *
     *
     * @bodyParam id int required Это поле является обязательным, Example: 1
     * @bodyParam who_can_see_id int required Это поле является обязательным, Example: 1
     *
     * @responseFile status=200 scenario="Рабочее пространство пользователя успешно измененно" storage/responses/UserSettings/Privacy/update/update-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/UserSettings/Privacy/update/update-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/UserSettings/Privacy/update/update-credentials.json
     */
    public function update(UpdatePrivacyRequest $request){
        return $this->service->update($request);
    }
}
