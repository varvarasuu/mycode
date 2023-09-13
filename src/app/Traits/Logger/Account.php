<?php

namespace App\Traits\Logger;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

$currentDate = Carbon::today();


trait Account
{
    //Account has been validated
    public function isValidated()
    {
        Log::build([
            'driver' => 'daily',
            'path' => storage_path('logs/daily/auth/login.log'),
        ])->info('Account has been validated');
    }

    //Account exists
    public function hasAccount()
    {
        Log::build([
            'driver' => 'daily',
            'path' => storage_path('logs/daily/auth/login.log'),
        ])->info('Account exists!');
    }

    //Account logged in
    public function accountLoggedIn($data = [], $controller = null, $ip = null)
    {
        Log::build([
            'driver' => 'daily',
            'path' => storage_path('logs/daily/auth/login.log'),
        ])->info(['account' => $data, 'controller' => $controller, 'ip' => $ip]);
    }
}
