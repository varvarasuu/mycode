<?php

namespace App\Services\Api\RequestDispatcher;

interface HttpRequestInterface
{
    public function get(string $url, array $queryParameters = [], array $headers = []);
    public function post(string $url, array $data = [], array $headers = []);
    public function defaultPostDispatcher(string $url, array $data = []);
    public function defaultGetDispatcher(string $url, array $data = []);
}
