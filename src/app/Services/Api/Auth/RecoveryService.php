<?php

namespace App\Services\Api\Auth;

use App\Exceptions\NotFoundException;
use App\Exceptions\ServerErrorException;
use App\Models\Account;
use App\Models\PhoneCode;
use App\Services\Api\Account\AccountService;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Hash;

class RecoveryService
{

    use HttpResponse;

    private $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function sendPhoneCode($ip, $phone_number)
    {
        $phoneCodeGenerator = new PhoneCode;
        $phoneCodeGenerator->codeExpired($phone_number, 'recovery');
        $user_ip_adress = $ip;
        $code = $phoneCodeGenerator->generateCode($phone_number, 'recovery', $user_ip_adress);
        $smssend = $phoneCodeGenerator->sendCodeSms($code, $phone_number, '- ваш код подтверждения');

        if ($smssend == true) {
            return ['sms_is_sent' => $smssend];
        } else {
            throw new NotFoundException("Sms is not send");
        }
    }

    public function recoveryPhoneCheck($request)
    {
        $existing_user_phone = $this->accountService->findByPhone($request->phone_number);
        if ($existing_user_phone) {
            return $this->sendPhoneCode($request->ip(), $request->phone_number);
        } else {
            throw new NotFoundException("User is not found");
        }
        throw new ServerErrorException("Unknow error");
    }

    public function sendNewPassword($phone_number)
    {
        $passwordGenerater = new PhoneCode;
        $password = $passwordGenerater->randomPassword();
        $existing_user_phone = Account::where('phone_number', $phone_number)->first();
        $existing_user_phone->password = Hash::make($password);
        $existing_user_phone->save();
        $smssend = $passwordGenerater->sendCodeSms($password, $phone_number, '- ваш пароль');
        if ($smssend) {
            return 'Codes match, password is send';
        } else {
            throw new ServerErrorException("Unknow error");
        }
    }

    /**
     * @subgroup Recovery
     */
    public function recoveryCode($request)
    {
        $recordedCode = PhoneCode::where('phone_number', $request->phone_number)
            ->where('is_expired', 0)
            ->where('type', 'recovery')
            ->first();

        if ($recordedCode != null && $recordedCode->code == $request->code) {
            $recordedCode->is_active = 1;
            $recordedCode->save();
            return $this->sendNewPassword($request->phone_number);
        } else {
            if ($recordedCode == null) {
                throw new NotFoundException("Code doesn't match, send new code");
            } else {
                $recordedCode->is_expired = 1;
                $recordedCode->save();
                throw new NotFoundException("Code doesn't match, send new code");
            }
        }
    }
}
