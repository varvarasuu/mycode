<?php

namespace App\Services\Api\Account;

use App\Models\Account;

interface AccountServiceInterface
{
    public function getAccountId(): int;
    public function getLoggedAs(): int;
    public function getLoggedAsForUser(int $id): int;
    public function findById(int $id) : ?Account;
    public function getCurrentAccount() : ?Account;
    public function logoutAccount() : bool;
    public function findByEmailOrPhone(string $email = null, string $phone = null): ?Account;
    public function getCurrentCompanyID();
    public function getCurrentSectionID();
    public function changeCurrentSectionID($nextSectionID);
}
