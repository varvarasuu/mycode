<?php

namespace App\Services\Api\Auth;

use App\Exceptions\NotFoundException;
use App\Services\Api\Account\AccountService;
use Illuminate\Support\Facades\Hash;

class LoginService implements LoginServiceInterface
{
    private $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function login($request)
    {
        $account = $this->accountService->findByEmailOrPhone($request->email, $request->phone_number);
        if ($account && Hash::check($request->password, $account->password)) {
            $response = $this->accountService->responseInfo($account);
            $token = $account->createToken('API Token of ' . $account->id, ['user:general'], null, null)->plainTextToken;
            return [
                'user' => $response,
                'token' => $token,
            ];
        }
        throw new NotFoundException("Неправильная почта или пароль");
    }
}
