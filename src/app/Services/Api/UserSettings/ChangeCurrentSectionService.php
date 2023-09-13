<?php

namespace App\Services\Api\UserSettings;

use App\Http\Requests\Settings\ChangeCurrentSectionRequest;
use App\Models\Section;
use App\Services\Api\Account\AccountService;
use App\Traits\HttpResponse;

class ChangeCurrentSectionService
{
    use HttpResponse;

    private $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function change_current_section(ChangeCurrentSectionRequest $request)
    {
        $nextSectionID = $request->input('section_id');
        $currentCompanyID = $this->accountService->getCurrentCompanyID();
        if($this->canChangeSection($currentCompanyID, $nextSectionID)){
            $this->accountService->changeCurrentSectionID($nextSectionID);
            // $data = $this->accountService->responseInfo($this->accountService->getCurrentAccount());
            // return $this->success(['message' => 'Current section was updated', 'user' => $data]);
            return $this->accountService->responseInfo($this->accountService->getCurrentAccount());
        }
        else{
            return false;
            // return $this->error('nel');
        }
    }

    public function canChangeSection($currentCompanyID, $nextSectionID): bool
    {
        if($nextSectionID === 0) return true;
        $section = Section::find($nextSectionID);

        if ($currentCompanyID != null && $section->can_company == 0) {
            return false;
        } else if ($currentCompanyID == null && $section->can_user == 0) {
            return false;
        } else {
            return true;
        }
    }
}
