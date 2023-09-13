<?php

namespace App\Services\Api\RequestDispatcher;

use Illuminate\Support\Facades\Http;

class RequestDispatcher implements HttpRequestInterface
{
    private string $base_url = '';

    public function defaultBaseUrl(): void{
        $this->base_url = "http://chat-web:2000";
    }

    public function defaultHeaders() : array {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . '<:]b-}qIIWVPd+L5TH+2e:~;p$/xG'
        ];
    }

    public function __construct()
    {
        $this->defaultBaseUrl();
    }

    public function setBaseUrl($base_url) :void {
        $this->$base_url = $base_url;
    }

    public function getBaseUrl(): string{
        return $this->base_url;
    }

    public function get(string $url, array $queryParameters = [], array $headers = [])
    {
        $response = Http::withHeaders($headers)->get($this->base_url.$url, $queryParameters);
        return $response->json();
    }

    public function post(string $url, array $data = [], array $headers = [])
    {
        $response = Http::withHeaders($headers)->post($this->base_url.$url, $data);
        return $response->json();
    }

    public function defaultGetDispatcher(string $url, array $data = [])
    {
        return $this->get($url, $data, $this->defaultHeaders());
    }

    public function defaultPostDispatcher(string $url, array $data = [])
    {
        return $this->post($url, $data, $this->defaultHeaders());
    }
}
