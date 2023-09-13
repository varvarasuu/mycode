<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCode extends Model {
    use HasFactory;

    protected $fillable = [
        'code',
        'is_active',
        'ip',
        'account_id',
        'email',
        'type',
    ];

    public function generateCode($email, $type, $user_ip_adress) {
        $code = mt_rand(1000, 9999);

        $user_code = EmailCode::create([
            'email' => $email,
            'code' => $code,
            'type' => $type,
            'ip' => $user_ip_adress,

        ]);
        return $code;
    }

    public function codeExpired($email, $type) {

        $recordOfCode = EmailCode::where('email', $email)
            ->where('type', $type)
            ->where('is_expired', 0)->get();

        if ($recordOfCode) {
            EmailCode::where('email', $email)
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
}
