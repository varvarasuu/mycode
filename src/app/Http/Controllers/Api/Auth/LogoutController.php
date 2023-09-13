<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\BaseException;
use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use App\Services\Api\Auth\LogoutService;

/**
 * Контроллер для управления выходом из системы
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\Auth
 *
 * @group Auth
 *
 * @authenticated
 */
class LogoutController extends Controller
{
    use HttpResponse;

    private LogoutService $service;

    public function __construct(LogoutService $service)
    {
        $this->service = $service;
    }

    /**
     * Logout
     *
     * @subgroup Logout
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для выхода из систему
     *
     * @header Authorization Bearer 2|QH6xqmC0aMZ4UIbFOBAp7CPuJdEr6G2xnaxYiYug
     * @responseFile status=200 scenario="успешный выход из системы" storage/responses/Auth/logout/logout-success.json
     * @responseFile status=401 scenario="Не прошедший проверку подлинности" storage/responses/Auth/logout/logout-credentials.json
     */
    public function logout()
    {
        try {
            if ($this->service->logout()) {
                return $this->success("Успешный выход из системы");
            } else {
                throw new UnauthorizedException("Не прошедший проверку подлинности");
            }
        } catch (BaseException $error) {
            return throw new BaseException($error->getMessage(), $error->getErrorCode());
        }
    }
}
