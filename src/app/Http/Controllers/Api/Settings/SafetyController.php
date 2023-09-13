<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Controller;
use App\Services\Api\UserSettings\SafetyService;

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
class SafetyController extends Controller
{
    private SafetyService $service;

    public function __construct(SafetyService $service)
    {
        $this->service = $service;
    }

    /**
     * Email
     *
     * @subgroup Safety
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для изменения почты текущего пользователя
     *
     * @bodyParam email string required Это поле является обязательным, Example: user@gmail.com
     *
     * @responseFile status=200 scenario="Email пользователя успешно изменен" storage/responses/UserSettings/Safety/email/email-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/UserSettings/Safety/email/email-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/UserSettings/Safety/email/email-credentials.json
     */
    public function email()
    {
        return $this->service->email();
    }

    /**
     * Phone
     *
     * @subgroup Safety
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для изменения номера телефона текущего пользователя
     *
     * @bodyParam phone_number string required Это поле является обязательным, Example: +77777777777
     *
     * @responseFile status=200 scenario="Номер телефона пользователя успешно изменен" storage/responses/UserSettings/Safety/phone/phone-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/UserSettings/Safety/phone/phone-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/UserSettings/Safety/phone/phone-credentials.json
     */
    public function phone()
    {
        return $this->service->phone();
    }

    /**
     * Password
     *
     * @subgroup Safety
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для изменения пароля текущего пользователя
     *
     * @bodyParam current_password string required Старый пароль.Это поле является обязательным, Example: password1
     * @bodyParam password string required Новый пароль.Это поле является обязательным, Example: password2
     *
     * @responseFile status=200 scenario="Номер телефона пользователя успешно изменен" storage/responses/UserSettings/Safety/password/password-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/UserSettings/Safety/password/password-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/UserSettings/Safety/password/password-credentials.json
     */
    public function password()
    {
        return $this->service->password();
    }

    /**
     * Account
     *
     * @subgroup Safety
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для удаления аккаунта текущего пользователя
     *
     * @bodyParam reason_id int required Example: 1
     * @bodyParam code int Example: 123
     *
     * @responseFile status=200 scenario="Аккаунт пользователя успешно удален" storage/responses/UserSettings/Safety/account/account-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/UserSettings/Safety/account/account-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/UserSettings/Safety/account/account-credentials.json
     */
    public function account()
    {
        return $this->service->account();
    }

    /**
     * SendCodePhone
     *
     * @subgroup Safety
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для отправки смс на телефон текущего пользователя
     *
     * @bodyParam type string required Example: email_change|phone_change|account_delete
     *
     * @responseFile status=200 scenario="Смс код успешно отправлен" storage/responses/UserSettings/Safety/sendCodePhone/send-code-phone-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/UserSettings/Safety/sendCodePhone/send-code-phone-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/UserSettings/Safety/sendCodePhone/send-code-phone-credentials.json
     */
    public function sendCodePhone()
    {
        return $this->service->code_phone();
    }

    /**
     * SendCodeEmail
     *
     * @subgroup Safety
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для отправки смс на почту текущего пользователя
     *
     * @bodyParam type string required Example: email_change|phone_change|account_delete
     *
     * @responseFile status=200 scenario="Смс код успешно отправлен" storage/responses/UserSettings/Safety/sendCodeEmail/send-code-email-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/UserSettings/Safety/sendCodeEmail/send-code-email-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/UserSettings/Safety/sendCodeEmail/send-code-email-credentials.json
     */
    public function sendCodeEmail()
    {
        return $this->service->code_email();
    }
}
