<?php

namespace App\Services\Api\Privileges\Services;

use App\Traits\HttpResponse;
use App\Models\Bonus;
use App\Repositories\Api\Privileges\BonusRepository;
use Carbon\Carbon;

class BonusService
{
    use HttpResponse;

   
    private $bonus_repository;

    public function __construct(BonusRepository $bonus_repository)
    {
        $this->bonus_repository = $bonus_repository;
    }

    public function getBonusList()
    {
        return $this->bonus_repository->getAll();
    }

    public function checkBonus()
    {
        $bonuses = $this->bonus_repository->getAll();
        foreach($bonuses as $bonus){

            $date = Carbon::parse($bonus->finish); // Указанная дата
            $today = Carbon::today(); // Сегодняшний день

            if ($date->lessThan($today) && $bonus->number_of_points > 0) {
                $this->bonus_repository->update($bonus);
            }

        }
        return true;
    }

}