<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateUserRequest;
use App\Services\Api\MediaFile\MediaFileService;
use App\Services\Api\UserSettings\UserService;

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
class UserController extends Controller
{
    private UserService $service;
    private MediaFileService $md_service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Show
     *
     * @subgroup User
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для вывода учетных данных текущего пользователя
     *
     * @responseFile status=200 scenario="Учетные данные пользователя успешно получены" storage/responses/UserSettings/User/show/show-success.json
     * @responseFile status=500 scenario="Внутреняя ошибка сервера" storage/responses/UserSettings/User/show/show-unknown-error.json
     */
    public function show()
    {
        return $this->service->show();
    }

    /**
     * Update
     *
     * @subgroup User
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для изменения учетных данных текущего пользователя
     *
     * @bodyParam name string required Это поле является обязательным, Example: Ivan
     * @bodyParam lastname string required Это поле является обязательным, Example: Ivanov
     * @bodyParam birthday date_format required Это поле является обязательным, Example: 2000-01-01
     * @bodyParam gender_id int
     * @bodyParam region_id int
     * @bodyParam avatar string Example: image.png|jpg|jpeg
     *
     * @responseFile status=200 scenario="Учетные данные пользователя успешно изменены" storage/responses/UserSettings/User/update/update-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/UserSettings/User/update/update-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/UserSettings/User/update/update-credentials.json
     */
    public function update(UpdateUserRequest $request)
    {
        return $this->service->update($request);
    }
}
