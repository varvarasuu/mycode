<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Services\Api\UserSettings\BlackListService;
use App\Http\Requests\Settings\DeleteBlackListRequest;
use App\Http\Requests\Settings\SaveBlackListRequest;

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
class BlackListController extends Controller
{
    private BlackListService $service;

    public function __construct(BlackListService $service)
    {
        $this->service = $service;
    }

    /**
     * Show
     *
     * @subgroup BlackList
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для вывода аккаунтов которые находятся в черном списке текущего пользователя
     *
     * @responseFile status=200 scenario="Черный список текущего пользователя успешно получен" storage/responses/UserSettings/BlackList/index/index-success.json
     * @responseFile status=500 scenario="Внутреняя ошибка сервера" storage/responses/UserSettings/BlackList/index/index-unknown-error.json
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->service->index();
    }

    /**
     * Store
     *
     * @subgroup BlackList
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для добавления аккаунта в черный список текущего пользователя
     *
     * @bodyParam section_id int required Это поле является обязательным, Example: 1
     * @bodyParam blocked_account int required Это поле является обязательным, Example: 1
     * @bodyParam black_list_id int Example: 1
     * @bodyParam account_id int Example: 1
     *
     * @responseFile status=200 scenario="Черный список текущего пользователя успешно создан" storage/responses/UserSettings/BlackList/store/store-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/UserSettings/BlackList/store/store-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/UserSettings/BlackList/store/store-credentials.json
     */
    public function store(SaveBlackListRequest $request)
    {
        return $this->service->save($request);
    }

    /**
     * Delete
     *
     * @subgroup BlackList
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для удаления аккаунта из черного списка
     *
     * @bodyParam black_list_detail_id int required Это поле является обязательным, Example: 1
     *
     * @responseFile status=200 scenario="Аккаунт из черного списка текущего пользователя успешно удален" storage/responses/UserSettings/BlackList/delete/delete-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/UserSettings/BlackList/delete/delete-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/UserSettings/BlackList/delete/delete-credentials.json
     */
    public function delete(DeleteBlackListRequest $request)
    {
        return $this->service->destroy($request);
    }
}
