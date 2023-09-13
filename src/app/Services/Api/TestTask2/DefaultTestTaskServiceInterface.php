<?php

namespace App\Services\Api\TestTask2;

use App\Models\TestTask;

interface DefaultTestTaskServiceInterface
{
    public function createTestTask(array $data);
}
