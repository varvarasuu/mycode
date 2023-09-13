<?php

namespace App\Services\Api\Auth;

use App\Services\Api\Account\AccountService;

class LogoutService implements LogoutServiceInterface
{
    private $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function logout()
    {
        return $this->accountService->logoutAccount();
    }
}
