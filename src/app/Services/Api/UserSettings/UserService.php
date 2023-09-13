<?php

namespace App\Services\Api\UserSettings;

use App\Http\Requests\Settings\UpdateUserRequest;
use App\Models\Account;
use App\Models\Gender;
use App\Models\MediaFile;
use App\Models\Region;
use App\Models\User;
use App\Services\Api\MediaFile\MediaFileService;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;

class UserService {

    use HttpResponse;
    private MediaFileService $md_service;

    public function __construct()
    {
        $this->md_service = new MediaFileService();
    }

    public function show() {
        try {
            $authID = Auth::id();
            $userModel = User::where('account_id', $authID)->first();
            $account = Account::find($authID);

            if (!$userModel) {
                return $this->error('User Not Found', 'error', 404);
            }

            if ($userModel->gender == null && $userModel->region == null) {
                $gender = 'Пол не указан';
                $region = 'Регион не указан';
            } else {
                $gender = $userModel->gender->name;
                $region = $userModel->region->name;
            }
            $user = [
                'id' => $userModel->id,
                'name' => $userModel->name,
                'lastname' => $userModel->lastname,
                'birthday' => $userModel->birthday,
                'gender' => $gender,
                'region' => $region,
                'avatar' => $this->md_service->getImagePathAndFileName($account->avatar)
            ];

            return $this->success($user);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage());
        }
    }

    /**
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request)
    {
        $request->validated($request->all());
        try {
            $authID = Auth::id();
            $user = User::where('account_id', $authID)->first();

            if (!$user) {
                return $this->error('User Not Found', 'error', 404);
            }

            if ($request->input('birthday')) {
                $currentDate = new \DateTime();
                $userDate = new \DateTime($request->input('birthday'));

                $diff = $currentDate->diff($userDate);

                $years = floor($diff->days / 365);

                if (intval($years) < 14) {
                    return $this->error('Для регистрации на At-work вы должны быть старше 14 лет', 'error', 404);
                }
            }

            $account = Account::find($authID);
            if($request->hasFile('avatar')){

                $file = $this->md_service->update($account->avatar, $request->file('avatar'), 'uploads/avatars');

                $account->avatar = $file->id;
                $account->save();
            }

            $user->id = $authID;
            $user->name = $request->input('name');
            $user->lastname = $request->input('lastname');

            if($request->input('gender_id') !== null) {
                $gender = Gender::find($request->input('gender_id'));
                $user->gender_id = $request->input('gender_id');
                if($gender == null){
                    return $this->error('Gender id not found', 'error', 404);
                }
            }

            if($request->input('region_id') !== null) {
                $region = Region::find($request->input('region_id'));
                if($region == null){
                    return $this->error('Region id not found', 'error', 404);
                }
                $user->region_id = $request->input('region_id');
            }

            $user->birthday = $request->input('birthday');

            $user->update();
            $user->avatar = $this->md_service->getImagePathAndFileName($account->avatar);
            return $this->success($user);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage());
        }
    }
}
