<?php

namespace App\Services\Api\Chat\Interfaces;

use App\Models\Account;
use App\Models\User;

interface IChatUserService
{
    public function prepareDataUser(Account $account, User $user) : array;
    public function createUser();
    public function loginUser();
    public function logoutUser();
    // public function loginAsCompany();
    // public function logoutAsCompany();
    // public function updateUser();
}
