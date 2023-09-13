<?php

namespace App\Services\Api\Privileges\Interfaces;

interface BirthdayServiceInterface
{
    public function getCupon();
    public function checkDateForNewCupon($birthday_cupons, $birthday_date, $timecreated);
    public function useBirthdayBonus();
    public function getNotExpriredCupon($birthday_cupon_active, $cupons);
    public function prepare_data();

}