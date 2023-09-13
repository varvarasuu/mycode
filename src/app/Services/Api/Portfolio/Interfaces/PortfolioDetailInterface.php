<?php

namespace App\Services\Api\Portfolio\Interfaces;

interface PortfolioDetailInterface 
{
    public function create($request);
    public function update($request);
    public function get($id);
    public function prepare_data($request);
    public function prepare_data_id($request);
}