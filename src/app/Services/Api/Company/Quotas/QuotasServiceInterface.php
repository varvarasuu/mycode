<?php

namespace App\Services\Api\Company\Quotas;

interface QuotasServiceInterface
{
    public function saveQuotas($request);
    public function getQuotas($id);
}
