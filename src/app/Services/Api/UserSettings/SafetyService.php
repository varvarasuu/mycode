<?php

namespace App\Services\Api\UserSettings;

use App\Mail\CodeConfirmation;
use App\Models\Account;
use App\Models\DeletedAccount;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\PhoneCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Mail\PasswordChanged;
use App\Models\EmailCode;

class SafetyService
{
    use HttpResponse;

    private Request $request;
    public $login = 'at-work';
    public $password = 'VsehPobedim777$';

    public function __construct()
    {
        $this->request = Request();
    }

    public function email()
    {
        try {
            $this->request->validate([
                'email' => 'required|unique:accounts|max:255',
            ]);

            $currentID = Auth::id();
            $account = Account::where('id', $currentID)->first();

            $recordedCode = PhoneCode::where('phone_number', $account->phone_number)->where('type', 'email_change')
                ->where('is_expired', 0)->first();

            if ($recordedCode != null && $recordedCode->code == $this->request->code) {
                $recordedCode->is_active = 1;
                $recordedCode->save();

                $account->email = $this->request->email;
                $account->save();
            } else {
                if ($recordedCode != null) {
                    $recordedCode->is_expired = 1;
                    $recordedCode->save();
                    return $this->error("Code doesn't match, send new code", 'error', 404);
                } else {
                    return $this->error("Code doesn'exist", 'error', 404);
                }
            }

            return $this->success($account);
        } catch (ValidationException $exception) {
            return $this->error($exception->getMessage());
        } catch (\Exception $e) {
            return $this->error('Unknown error');
        }
    }

    public function phone()
    {
        try {
            $this->request->validate([
                'phone_number' => 'required|string|unique:accounts|min:7|max:13',
            ]);

            $currentID = Auth::id();
            $account = Account::findOrFail($currentID);

            $recordedCode = EmailCode::where('email', $account->email)->where('type', 'phone_change')
                ->where('is_expired', 0)->first();

            if ($recordedCode != null && $recordedCode->code == $this->request->code) {
                $recordedCode->is_active = 1;
                $recordedCode->save();

                $account->phone_number = $this->request->phone_number;
                $account->save();
            } else {
                if ($recordedCode != null) {
                    $recordedCode->is_expired = 1;
                    $recordedCode->save();
                    return $this->error("Code doesn't match, send new code", 'error', 404);
                } else {
                    return $this->error("Code doesn'exist", 'error', 404);
                }
            }

            return $this->success($account);
            return $this->error('Unknown error');
        } finally {

        }

    }

    public function password()
    {
        try {
            $this->request->validate([
                'current_password' => ['required'],
                'password' => [
                    'required',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&!#$%&\'*+—\/=?^_`{|}~.])[A-Za-z\d@$!%*#?&!#$%&\'*+—\/=?^_`{|}~.]{8,}$/',
                    'max:20'
                ]
            ]);

        } catch (\Exception $exception) {
            return $this->error($exception->getMessage());
        }

        try {
            $currentID = Auth::id();
            $account = Account::where('id', $currentID)->first();
            if (!Hash::check($this->request->current_password, $account->password)) {
                return $this->error('Current password is not correct');
            }
            $account->password = Hash::make($this->request->password);
            $account->update();
            Mail::to($account->email)->send(new PasswordChanged());
            return $this->success($account);
        } catch (\Exception $exception) {
            return $this->error('Unknown error');
        }
    }

    public function account()
    {
        try {
            $this->request->validate([
                'reason_id' => ['required', 'integer'],
                'code' => ['integer'],
            ]);


            $currentID = Auth::id();
            $account = Account::where('id', $currentID)->first();

            $recordedCode = PhoneCode::where('phone_number', $account->phone_number)->where('type', 'account_delete')
                ->where('is_expired', 0)->first();

            if ($recordedCode != null && $recordedCode->code == $this->request->code) {
                $recordedCode->is_active = 1;
                $recordedCode->save();

                $account->email = "";
                $account->phone_number = "";
                $account->is_deleted = 1;
                $account->save();

                DeletedAccount::create([
                    'account_id' => $currentID,
                    'reason_id' => $this->request->reason_id,
                ]);
            } else {
                if ($recordedCode != null) {
                    $recordedCode->is_expired = 1;
                    $recordedCode->save();
                    return $this->error("Code doesn't match, send new code", 'error', 404);
                } else {
                    return $this->error("Code doesn'exist", 'error', 404);
                }
            }

            return $this->delete('account deleted successfully');
        } catch (\Exception $exception) {
            return $this->error('Unknown error');
        }
    }

    public function code_phone()
    {
        $type = $this->request->type;
        $currentID = Auth::id();
        $account = Account::where('id', $currentID)->first();

        $recordOfCode = PhoneCode::where('phone_number', $account->phone_number)
            ->where('type', $type)
            ->where('is_expired', 0)->get();

        if ($recordOfCode) {
            PhoneCode::where('phone_number', $account->phone_number)
                ->where('type', $type)
                ->where('is_expired', 0)
                ->update([
                    'is_expired' => 1,
                ]);
        }

        $code = mt_rand(1000, 9999);
        $user_ip_adress = $this->request->ip();

        $user_code = PhoneCode::create([
            'phone_number' => $account['phone_number'],
            'code' => $code,
            'type' => $type,
            'ip' => $user_ip_adress,
        ]);

        $msg = 'ваш код подтверждения' . ' на https://at-work.pro/';
        if ($account->phone_number) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://smsc.ru/sys/send.php?login=' . urlencode($this->login) . '&psw=' . urlencode($this->password) . '&phones=' . urlencode($account->phone_number) . '&mes=' . urlencode($code . ' ' . $msg));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($curl);
            curl_close($curl);
            if ($res) {
                return $this->success($res);
            }
        }

        return $this->error('Unknown error');
    }

    public function code_email()
    {
        $type = $this->request->type;
        $currentID = Auth::id();
        $account = Account::where('id', $currentID)->first();

        $recordOfCode = EmailCode::where('email', $account->email)
            ->where('type', $type)
            ->where('is_expired', 0)->get();

        if ($recordOfCode) {
            EmailCode::where('email', $account->email)
                ->where('type', $type)
                ->where('is_expired', 0)
                ->update([
                    'is_expired' => 1,
                ]);
        }

        $code = mt_rand(1000, 9999);
        $user_ip_adress = $this->request->ip();

        $user_code = EmailCode::create([
            'email' => $account->email,
            'code' => $code,
            'type' => $type,
            'ip' => $user_ip_adress,

        ]);
        Mail::to($account->email)->send(new CodeConfirmation($code));

        return $this->success("Email was sended");
    }
}
