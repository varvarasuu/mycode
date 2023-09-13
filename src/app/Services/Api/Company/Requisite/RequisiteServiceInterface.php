<?php

namespace App\Services\Api\Company\Requisite;

interface RequisiteServiceInterface
{
    public function getRequisites();
    public function addRequisites($request);
}
