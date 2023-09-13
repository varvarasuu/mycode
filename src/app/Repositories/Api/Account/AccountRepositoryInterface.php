<?php

namespace App\Repositories\Api\Account;

use App\Models\Account;

interface AccountRepositoryInterface
{
    public function findOrFail(int $id): Account;
    public function find(int $id) : ?Account;
    public function revokeCurrentToken();
    public function getCurrentSectionID() : ?int;
    public function getCurrentCompanyID() : ?int;
    public function changeCurrentSectionID($nextSectionID);
    public function setCurrentCompanyID($companyID);
    public function findByPhone($phone_number);
}
