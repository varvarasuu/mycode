<?php

namespace App\Services\Api\Privileges\Services;

use App\Traits\HttpResponse;
use App\Models\Bonus;
use App\Models\User;
use App\Models\DeletedAccount;
use Illuminate\Support\Facades\Crypt;


class ReferalService
{
    use HttpResponse;


    public function getBonusReferal()
    {
        $account_id = auth()->id();
        $bonuses = Bonus::where('account_id', $account_id)->where('type', 1)->get();
        $bonus_sum = 0;
        foreach ($bonuses as $bonus) {
            $bonus_sum += $bonus->number_of_points;
            if ($bonus->account_id_refered != null) {
                if (!DeletedAccount::where('account_id', $bonus->account_id_refered)->first()) {
                    $user_refered = User::where('account_id', $bonus->account_id_refered)->first();
                    if ($user_refered) {
                        $name = $user_refered->name;
                        $lastname = $user_refered->lastname;

                        $bonus->name_refered = $lastname . ' ' . mb_substr($name, 0, 1, 'UTF-8') . '.';
                    } else {
                        $bonus->name_refered  = 'Не указано';
                    }
                } else {
                    $bonus->name_refered = 'DELETED';
                }
            }
        }

        return ['total_number' => $bonus_sum, 'list' => $bonuses];
    }
}
