<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\BaseException;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CodeRequest;
use App\Http\Requests\Auth\PhoneRequest;
use App\Models\Account;
use App\Models\PhoneCode;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Hash;
use App\Services\Api\Auth\RecoveryService;

/**
 * Контроллер для обработки восстановления учетной записи.
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\Auth
 *
 * @group Auth
 * @subgroup Recovery
 * @unauthenticated
 */
class RecoveryController extends Controller
{
    use HttpResponse;

    private RecoveryService $service;

    public function __construct(RecoveryService $service)
    {

        $this->service = $service;
    }

    /**
     * Recovery Phone Check
     *
     * @bodyParam phone_number string required Это поле является обязательным. Длина не должна превышать 13 символов. Example: +79817569728
     *
     * @responseFile status=200 scenario="успешная регистрация телефона" storage/responses/Auth/register/register_phone-success.json
     */
    public function recoveryPhoneCheck(PhoneRequest $request)
    {
        try {
            return $this->success($this->service->recoveryPhoneCheck($request));
        } catch (BaseException $error) {
            return throw new BaseException($error->getMessage(), $error->getErrorCode());
        }
    }

    /**
     * Get recovery password
     *
     * @bodyParam phone_number string required Это поле является обязательным. Длина не должна превышать 13 символов. Example: +79817569728
     * @bodyParam code string required Этот параметр является обязательным и состоит из 4 цифр. Example: 4444
     *
     *
     */
    public function recoveryCode(CodeRequest $request)
    {
        try {
            return $this->success($this->service->recoveryCode($request));
        } catch (BaseException $error) {
            return throw new BaseException($error->getMessage(), $error->getErrorCode());
        }
    }
}
