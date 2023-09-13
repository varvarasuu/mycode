<?php

namespace App\Services\Api\Account;

use App\Models\Account;
use App\Models\Section;
use App\Models\User;
use App\Services\Api\Account\AccountServiceInterface;
use App\Repositories\Api\Account\EloquentAccountRepository;
use App\Services\Api\MediaFile\MediaFileService;

class AccountService implements AccountServiceInterface
{
    protected $accountRepository;
    private $md_service;

    public function __construct(EloquentAccountRepository $accountRepository, MediaFileService $md_service)
    {
        $this->accountRepository = $accountRepository;
        $this->md_service = $md_service;
    }

    public function getAccountId(): int
    {
        return auth()->id();
    }

    public function getLoggedAs(): int
    {
        return $this->getCurrentCompanyID();
    }

    public function getLoggedAsForUser(int $id): int
    {
        $account = $this->accountRepository->findOrFail($id);
        return $account->logged_as;
    }

    public function findById(int $id): ?Account
    {
        $account = $this->accountRepository->find($id);
        return $account;
    }

    public function getCurrentAccount(): ?Account
    {
        $account = $this->findById($this->getAccountId());
        return $account;
    }

    public function logoutAccount(): bool
    {
        return $this->accountRepository->revokeCurrentToken($this->getCurrentAccount());
    }

    public function findByEmailOrPhone(string $email = null, string $phone = null): ?Account
    {
        $account = Account::where('email', $email)
            ->orWhere('phone_number', $phone)->first();
        return $account;
    }

    public function getCurrentSectionID()
    {
        return $this->accountRepository->getCurrentSectionID();
    }

    public function getCurrentCompanyID()
    {
        return $this->accountRepository->getCurrentCompanyID();
    }

    public function responseInfo(Account $account)
    {
        $user = User::where('account_id', $account->id)->first();
        return [
            'id' => $account->id,
            'email' => $account->email,
            'phone_number' => $account->phone_number,
            'is_active' => $account->is_active,
            'is_deleted' => $account->is_deleted,
            'employer_status_id' => $account->employer_status_id,
            'applicant_status_id' => $account->applicant_status_id,
            'avatar' => $this->md_service->getImagePathAndFileName($account->avatar),
            'current_section_id' => $this->accountRepository->getCurrentSectionID(),
            'logged_as' => $this->accountRepository->getCurrentCompanyID(),
            'name' => $user->name,
            'lastname' => $user->lastname,
            'birthday' => $user->birthday,
            'balance' => $user->balance,
            'current_section_name' => $this->getCurrentSectionName($this->accountRepository->getCurrentSectionID()),
            'referal_code' => base64_encode($account->id),
            'created_at' => $account->created_at,
            'updated_at' => $account->updated_at
        ];
    }

    public function changeCurrentSectionID($nextSectionID)
    {
        $this->accountRepository->changeCurrentSectionID($nextSectionID);
    }

    public function setCurrentCompanyID($company_id)
    {
        return $this->accountRepository->setCurrentCompanyID($company_id);
    }

    public function getCurrentSectionName($sectionID){
        if($sectionID == 0) {return 'general';}
        else{
            return Section::find($sectionID)->title;
        }
    }

    public function findByPhone($phone_number)
    {
        return $this->accountRepository->findByPhone($phone_number);
    }
}
