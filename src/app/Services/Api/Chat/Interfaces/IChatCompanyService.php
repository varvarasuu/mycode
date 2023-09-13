<?php

namespace App\Services\Api\Chat\Interfaces;


interface IChatCompanyService
{
    public function createCompany();
    public function updateCompany();
    public function addEmploye();
    public function removeEmploye();
}
