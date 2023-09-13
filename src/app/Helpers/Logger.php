<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class Logger
{
    private string $path;

    public function __construct()
    {
        $this->path = 'logs/daily/auth/login.log';
    }

    public function message(string $type = 'info', string $message = '', string $ip = '', string $endpoint = '')
    {
        $infoData = [
            'Message' => $message,
            'IP' => $ip,
            'Endpoint' => $endpoint,
        ];

        switch ($type) {
            case 'info':
                Log::build([
                    'driver' => 'daily',
                    'path' => storage_path($this->path),
                ])->info($infoData);
                break;
            case 'notice':
                Log::build([
                    'driver' => 'daily',
                    'path' => storage_path($this->path),
                ])->notice($infoData);
                break;
            case 'error':
                Log::build([
                    'driver' => 'daily',
                    'path' => storage_path($this->path),
                ])->error($infoData);
                break;
        }
    }
}
