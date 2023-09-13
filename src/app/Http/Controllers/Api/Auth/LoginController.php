<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\BaseException;
use App\Exceptions\NotFoundException;
use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Models\Company;
use App\Services\Api\Account\AccountService;
use App\Services\Api\Auth\LoginService;
use App\Services\Api\MediaFile\MediaFileService;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;

/**
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\Auth
 *
 * @group Auth
 *
 * @unauthenticated
 */
class LoginController extends Controller
{
    use HttpResponse;

    private LoginService $service;
    private Logger $logger;
    private $accountService;
    private $mediaFileService;
    public function __construct(LoginService $service, Logger $logger, AccountService $accountService, MediaFileService $mediaFileService)
    {
        $this->service = $service;
        $this->logger = $logger;
        $this->accountService = $accountService;
        $this->mediaFileService = $mediaFileService;
    }

    /**
     * Login
     *
     * @subgroup Login
     *
     * @subgroupDescription Ниже мы увидим методы, необходимые для входа в систему
     *
     * @bodyParam email email Это поле является обязательным, если <code>phone_number</code> отсутствует.  Должен быть действительный адрес электронной почты. Example: test@at-work.pro
     * @bodyParam password string required Это поле является обязательным. Должно быть не менее 6 символов. Example: AtW0rk##
     * @bodyParam phone_number string Это поле является обязательным, если <code>email</code> отсутствует. Длина не должна превышать 13 символов. Example: +79817569728
     *
     * @responseFile status=200 scenario="успешный вход в систему" storage/responses/Auth/login/login-success.json
     * @responseFile status=422 scenario="Некоторые параметры неверны" storage/responses/Auth/login/login-unknown-error.json
     * @responseFile status=404 scenario="Указанные учетные данные неверны" storage/responses/Auth/login/login-credentials.json
     */
    public function login(LoginUserRequest $request)
    {
        try {
            $response = $this->service->login($request);
            return $this->success($response);
        } catch (BaseException $error) {
            return throw new BaseException($error->getMessage(), $error->getErrorCode());
        }
    }

    public function handShake()
    {
        $info_account = $this->accountService->responseInfo($this->accountService->getCurrentAccount());
        if ($this->accountService->getCurrentCompanyID()) {
            $company = Company::select('companies.id as company_id', 'companies.inn as inn', 'companies.type_short as type_company', 'companies.name as name_company', 'accounts.avatar as avatar', 'companies.logo_image_id as logo_image_id', 'accounts.id as account_id')
                ->leftJoin('list_of_employees', 'companies.id', '=', 'list_of_employees.company_id')
                ->leftJoin('detail_list_of_employees', 'detail_list_of_employees.list_of_employees_id', '=', 'list_of_employees.id')
                ->leftJoin('accounts', 'accounts.id', '=', 'companies.account_id')
                ->where('detail_list_of_employees.employee_id', '=', $this->accountService->getAccountId())
                ->where('companies.id', '=', $this->accountService->getCurrentCompanyID())
                ->first();
            $company->profileImg = $this->mediaFileService->getImagePathAndFileName($company['logo_image_id']);
            return [
                'account' => $info_account,
                'company' => $company
            ];
        } else {
            return [
                'account' => $info_account,
                'company' => null
            ];
        }
    }
}
