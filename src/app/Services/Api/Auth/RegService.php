<?php

namespace App\Services\Api\Auth;


use App\Models\Account;
use App\Models\PhoneCode;
use App\Models\User;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\Bonus;
use App\Services\Api\Chat\Services\ChatUserService;

class RegService
{
    use HttpResponse;

    public function registerPhone($request)
    {
        $first_2 = substr($request->phone_number, 0, 2);
        $first_4 = substr($request->phone_number, 0, 4);
        if ($first_2 != '+7' && $first_4 != '+375' && $first_4 != '+380' && $first_4 != '+998' &&  $first_4 != '+373' && $first_4 != '+374') {
            return $this->error('Phone number is not valid', 'error', 422);
        }

        $existing_user = Account::where('phone_number', $request->phone_number)->first();

        $phoneCodeGenerator = new PhoneCode;

        if ($existing_user) {
            return $this->error("User with that number already exists", 'error', 404);
        } else {
            $phoneCodeGenerator->codeExpired($request->phone_number, 'register');
            $user_ip_adress = $request->ip();
            $code = $phoneCodeGenerator->generateCode($request->phone_number, 'register', $user_ip_adress);

            $smssend = $phoneCodeGenerator->sendCodeSms($code, $request->phone_number, '- ваш код подтверждения');
            if ($smssend == true) {
                return $this->success(['sms_is_sent' => $smssend]);
            } else {
                return $this->error("Sms is not send", 'error', 404);
            }
        }
        return $this->error("Unkown error", 'error', 404);
    }


    public function registerCode($request)
    {

        $recordedCode = PhoneCode::where('phone_number', $request->phone_number)
            ->where('is_expired', 0)->where('type', 'register')->first();

        if ($recordedCode != null && $recordedCode->code == $request->code) {
            $recordedCode->is_active = 1;
            $recordedCode->save();
            return $this->success('Codes match, can continue with registration');
        } else {
            if ($recordedCode != null) {
                $recordedCode->is_expired = 1;
                $recordedCode->save();
                return $this->error("Code doesn't match, send new code", 'error', 404);
            } else {
                return $this->error("Code or phone don't exist", 'error', 404);
            }
        }
        return $this->error("Unkown error", 'error', 404);
    }


    public function registerUser($request, $code)
    {

        if ($code) {
            $new_id = (int)base64_decode($code);
            $referal_account = Account::find($new_id);
            if (!isset($referal_account)) {
                return $this->error('Реферальная ссылкка не действительна.');
            }
        }
        $existing_user_phone = Account::where('phone_number', $request->phone_number)->first();

        $existing_user_email = Account::where('email', $request->email)->first();
        if ($existing_user_phone || $existing_user_email) {
            return $this->error("User with this phone or email already exist", 'error', 404);
        }

        $codeConfirmed = PhoneCode::where('phone_number', $request->phone_number)
            ->where('is_active', 1)->where('type', 'register')->first();

        if ($codeConfirmed) {

            $new_account = Account::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'is_active' => 1,
            ]);
            $new_user = User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'account_id' => $new_account->id,
                'gender_id' => 1,
                'region_id' => 1,
            ]);
            $user = User::where('account_id', $new_account->id)->first();
            $new_account->name = $user->name;
            $new_account->lastname = $user->lastname;
            $new_account->birthday = $user->birthday;
            $new_account->balance = $user->balance;
            $new_account->current_section_name = 'general';

            if ($code) {
                $this->referal($code, $new_account->id);
            }
            $new_account->referal_code = base64_encode($new_account->id);
            $token = $new_account->createToken('API Token of ' . $new_account->id)->plainTextToken;
            $chat_user_service =  new ChatUserService($new_account, $new_user, $token);
            $chat_user_service->createUser();
            return $this->success([
                'user' => $new_account,
                'token' => $token,
            ]);
        } else {
            return $this->error("Phone number is not confirmed", 'error', 404);
        }
        return $this->error("Unkown error", 'error', 404);
    }

    public function referal($code, $new_account_id)
    {
        $referal_account_id = (int)base64_decode($code);

        $timecreated = time();
        $threeMonthsForward = strtotime('+3 months', $timecreated);

        Bonus::create([
            'number_of_points' => 100,
            'account_id' => $referal_account_id,
            'account_id_refered' => $new_account_id,
            'start' => date('Y-m-d H:i:s', $timecreated),
            'finish' => date('Y-m-d H:i:s', $threeMonthsForward),
            'type' => 1,
        ]);

        Bonus::create([
            'number_of_points' => 50,
            'account_id' => $new_account_id,
            'account_id_refered' => null,
            'start' => date('Y-m-d H:i:s', $timecreated),
            'finish' => date('Y-m-d H:i:s', $threeMonthsForward),
            'type' => 2,
        ]);
    }
}
