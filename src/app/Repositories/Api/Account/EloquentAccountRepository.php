<?php

namespace App\Repositories\Api\Account;

use App\Models\Account;

class EloquentAccountRepository implements AccountRepositoryInterface
{
    public function findOrFail(int $id): Account
    {
        return Account::findOrFail($id);
    }

    public function find(int $id): ?Account
    {
        return Account::find($id);
    }

    public function revokeCurrentToken()
    {
        return auth()->user()->currentAccessToken()->delete();
    }

    public function revokeAllTokens(): void
    {
        auth()->user()->tokens()->delete();
    }

    public function getCurrentSectionID(): ?int
    {
        if (auth()->user() != null) {
            return auth()->user()->currentAccessToken()->section_id;
        } else {
            return null;
        }
    }

    public function getCurrentCompanyID(): ?int
    {
        if (auth()->user() != null) {
            return auth()->user()->currentAccessToken()->company_id;
        } else {
            return null;
        }
    }

    public function changeCurrentSectionID($nextSectionID)
    {
        auth()->user()->currentAccessToken()->section_id = $nextSectionID;
        auth()->user()->currentAccessToken()->save();
    }

    public function setCurrentCompanyID($companyID)
    {
        auth()->user()->currentAccessToken()->company_id = $companyID;
        auth()->user()->currentAccessToken()->save();
    }

    public function findByPhone($phone_number)
    {
        return Account::where('phone_number', $phone_number)->first();
    }
}
