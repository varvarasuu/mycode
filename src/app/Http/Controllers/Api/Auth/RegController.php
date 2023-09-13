<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CodeRequest;
use App\Http\Requests\Auth\PhoneRequest;
use App\Http\Requests\Auth\StoreAccountRequest;
use App\Traits\HttpResponse;
use App\Services\Api\Auth\RegService;

/**
 * Controller for handling Help Articles.
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\Auth
 *
 * @group Auth
 *
 * @unauthenticated
 */
class RegController extends Controller
{
    use HttpResponse;

    private RegService $service;

    public function __construct(RegService $service)
    {

        $this->service = $service;
    }
    /**
     * Register Phone
     *
     * @subgroup Register
     *
     * @bodyParam name string required Это поле является обязательным. Example: test
     * @bodyParam lastname string required Это поле является обязательным. Example: test
     * @bodyParam phone_number string required Это поле является обязательным. Длина не должна превышать 13 символов. Example: +79817569728
     *
     * @responseFile status=404 scenario="Пользователь с таким номером уже существует" storage/responses/Auth/register/register_phone-userexist.json
     * @responseFile status=200 scenario="успешная регистрация телефона" storage/responses/Auth/register/register_phone-success.json
     * @responseFile status=422 scenario="Код страны не найден, телефон не валидный" storage/responses/Auth/register/register_error-phone.json
     * 
     */
    public function registerPhone(PhoneRequest $request)
    {
        $request->validated($request->all());
        return $this->service->registerPhone($request);
    }

    /**
     * Register Code
     *
     * @subgroup Register
     *
     * @bodyParam name string required Это поле является обязательным. Example: test
     * @bodyParam lastname string required Это поле является обязательным. Example: test
     * @bodyParam phone_number string required Это поле является обязательным. Длина не должна превышать 13 символов. Example: +79817569728
     * @bodyParam code string required Этот параметр является обязательным и состоит из 4 цифр. Example: 4444
     *
     * @responseFile status=404 scenario="Ошибка регистрации кода" storage/responses/Auth/register/register_code-fail.json
     * @responseFile status=404 scenario="Регистрационный код не существует" storage/responses/Auth/register/register_code-noexist.json
     * @responseFile status=200 scenario="Успешная регистрация кода" storage/responses/Auth/register/register_code-success.json
     */
    public function registerCode(CodeRequest $request)
    {
        $request->validated($request->all());
        return $this->service->registerCode($request);
    }


    /**
     * Register User
     *
     * @subgroup Register
     *
     *
     * @bodyParam name string required
     * @bodyParam lastname string required
     * @bodyParam phone_number string required Это поле является обязательным. Длина не должна превышать 13 символов. Example: +79817569728
     * @bodyParam password string required
     * @bodyParam password_confirmation string required
     * @bodyParam email email required Это поле является обязательным. Должен быть действительный адрес электронной почты. Example: test@at-work.pro
     *
     * @responseFile status=404 scenario="телефон не подтвержден" storage/responses/Auth/register/register_user-phonenotconfirmed.json
     * @responseFile status=422 scenario="ошибка в имени / фамилии" storage/responses/Auth/register/register_user-name-lastname.json
     * @responseFile status=422 scenario="ошибка в password confirmation" storage/responses/Auth/register/register_user-password-confirmation.json
     * @responseFile status=422 scenario="ошибка в password email" storage/responses/Auth/register/register_user-email.json
     * @responseFile status=200 scenario="Успешная регистрация пользователя" storage/responses/Auth/register/register_user-success.json
     */
    public function registerUser(StoreAccountRequest $request, $code = null)
    {
        $request->validated($request->all());

        return $this->service->registerUser($request, $code);
    }
}
