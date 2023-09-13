<?php

namespace App\Services\Api\UserSettings;

use App\Http\Requests\Settings\DeleteBlackListRequest;
use App\Http\Requests\Settings\SaveBlackListRequest;
use App\Models\Account;
use App\Models\BlackList;
use App\Models\BlackListDetail;
use App\Models\Company;
use App\Models\User;
use App\Services\Api\MediaFile\MediaFileService;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlackListService
{
    use HttpResponse;

    private MediaFileService $md_service;

    public function __construct()
    {
        $this->md_service = new MediaFileService();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $authID = Auth::id();
            $blackList = BlackList::where('account_id', $authID)->first();

            $blackListDetails = BlackListDetail::where('black_list_id', $blackList->id)->get();

            $blackListUsers = [];

            foreach ($blackListDetails as $blackListDetail) {
                foreach ($blackListDetail->accounts as $account) {
                    $user = User::where('account_id', $account->id)->first();
                    $company = Company::where('account_id', $account->id)->first();

                    $name = '';
                    $is_company = false;

                    if ($user !== null) {
                        $name = $user->name . ' ' . $user->lastname;
                    } else if ($company !== null) {
                        $name = $company->name_company;
                        $is_company = true;
                    }

                    $blackListUsers[] = [
                        'id' => $blackListDetail['id'],
                        'black_list_id' => $blackListDetail['black_list_id'],
                        'account_id' => $account['id'],
                        'avatar' => $this->md_service->getImagePathAndFileName($account['avatar']),
                        'name' => $name,
                        'is_company' => $is_company,
                        'section_id' => $blackListDetail->section_id,
                        'section_title' => $blackListDetail->section_title->section_title
                    ];
                }
            }

            return $this->success($blackListUsers);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage());
        }
    }

    public function save(SaveBlackListRequest $request)
    {
        try {
            $request->validated($request->all());

            $black_list = Account::find(Auth::id())->blacklist;

            if ($black_list != null) {
                try {
                    $black_list_details = BlackListDetail::create([
                        'black_list_id' => $black_list->id,
                        'account_id' => intval($request->input('blocked_account')),
                        'section_id' => intval($request->input('section_id')),
                    ]);

                    $data = [
                        'black_list_id' => $black_list_details->black_list_id,
                        'account_id' => $black_list_details->account_id,
                        'section_id' => $black_list_details->section_id,
                        'updated_at' => $black_list_details->updated_at,
                        'created_at' => $black_list_details->created_at,
                        'id' => $black_list_details->id,
                        'section_title' => $black_list_details->section_title->section_title,
                    ];

                    return $this->success($data);
                } catch (\Exception $exception) {
                    return $this->error('Unknown error');
                }
            }
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage());
        }
    }

    public function destroy(DeleteBlackListRequest $request)
    {
        try {
            $request->validated($request->all());
            $blackListDetail = BlackListDetail::where('id',$request->black_list_detail_id)
                ->where('black_list_id', Account::find(Auth::id())->blacklist->id)->first();
            if ($blackListDetail) {
                $blackListDetail->delete();
                return $this->delete('deleted successfully');
            }
            else{
                return $this->error('Black List Detail not found', 'error', 404);
            }
        } catch (\Exception $exception) {
            return $this->error('Unknown error');
        }
    }
}
