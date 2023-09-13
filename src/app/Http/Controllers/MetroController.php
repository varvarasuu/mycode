<?php

namespace App\Http\Controllers;

use App\Services\MetroService;

class MetroController extends Controller
{
    protected MetroService $MetroService;

    function __construct(MetroService $MetroService)
    {
        $this->MetroService = $MetroService;
    }

    public function search(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->MetroService->search();
    }

    public function metro_by_id(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->MetroService->metro_by_id();
    }
}
