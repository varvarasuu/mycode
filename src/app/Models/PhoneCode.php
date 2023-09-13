<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneCode extends Model {
    use HasFactory;

    public $login = 'at-work';
    public $password = 'VsehPobedim777$';

    protected $fillable = [
        'code',
        'is_active',
        'ip',
        'account_id',
        'phone_number',
        'type',
    ];
    /**
     * @params $phone_number
     * generate code and record in database that it is created
     */
    public function generateCode($phone_number, $type, $user_ip_adress) {
        $code = mt_rand(1000, 9999);
        

        $user_code = PhoneCode::create([
            'phone_number' => $phone_number,
            'code' => $code,
            'type' => $type,
            'ip' => $user_ip_adress,

        ]);


        return $code;
    }

    /**
     * send code by sms
     */
    public function sendCodeSms($code, $phone_number, $message) {
        $msg = $message . ' на https://at-work.pro/';
        if ($phone_number) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://smsc.ru/sys/send.php?login=' . urlencode($this->login) . '&psw=' . urlencode($this->password) . '&phones=' . urlencode($phone_number) . '&mes=' . urlencode($code . ' ' . $msg));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($curl);
            curl_close($curl);
            if ($res) {
                return $res;
            }
        }

        return false;
    }

    /**
     * update record in database, make code expired
     */
    public function codeExpired($phone_number, $type) {

        $recordOfCode = PhoneCode::where('phone_number', $phone_number)
            ->where('type', $type)
            ->where('is_expired', 0)->get();

        if ($recordOfCode) {
            PhoneCode::where('phone_number', $phone_number)
                ->where('type', $type)
                ->where('is_expired', 0)
                ->update([
                    'is_expired' => 1,
                ]);

            return "code is expired";
        } else {
            return "no records to update";
        }
        return true;
    }

    public function randomPassword() {
        $pass = array();
        $alphabet_small = 'abcdefghijklmnopqrstuvwxyz';
        $alphabet_big = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $special_symbols = '!@#$%&*()';
        $alphaSmallLength = strlen($alphabet_small) - 1;
        $alphaBigLength = strlen($alphabet_big) - 1;
        $symbolsLength = strlen($special_symbols) - 1;
        for ($i = 0; $i < 4; $i++) {
            $n = rand(0, $alphaBigLength);
            $pass[] = $alphabet_big[$n];
        }
        for ($i = 0; $i < 4; $i++) {
            $n = rand(0, $alphaSmallLength);
            $pass[] = $alphabet_small[$n];
        }
        for ($i = 0; $i < 4; $i++) {
            $n = rand(0, 9);
            $pass[] = $n;
        }
        for ($i = 0; $i < 2; $i++) {
            $n = rand(0, $symbolsLength);
            $pass[] = $special_symbols[$n];
        }

        shuffle($pass);
        return implode($pass);
    }
}
