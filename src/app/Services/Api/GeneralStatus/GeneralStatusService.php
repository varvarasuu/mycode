<?php

namespace App\Services\Api\GeneralStatus;

use App\Http\Requests\GeneralStatus\SetGeneralStatusRequest;
use App\Models\Account;
use App\Models\GeneralStatus;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;

class GeneralStatusService
{
    use HttpResponse;

    public function get_general_statuses()
    {
        $account = Account::find(Auth::id());
        $statuses = '';
        if ($account->logged_as == null) {
            $statuses = GeneralStatus::where('type', '=', 'applicant')->get();
        } else {
            $statuses = GeneralStatus::where('type', '=', 'employer')->get();
        }
        return $this->success($statuses, 'success', 200);
    }

    public function set_general_status(SetGeneralStatusRequest $request)
    {
        $general_status_id = $request->input('general_status_id');
        $general_status = GeneralStatus::find($general_status_id);
        if ($general_status == null) {
            return $this->error('Status not found', 'error', 404);
        } else {
            $account = Account::find(Auth::id());
            if ($account->logged_as == null && $general_status->type == 'applicant') {
                $account->applicant_status_id = $general_status->id;
                $account->save();
                return $this->success($account, 'success', 200);
            } else {
                return $this->error('You cant change status in another role', 'error', 422);
            }
        }
    }
}
