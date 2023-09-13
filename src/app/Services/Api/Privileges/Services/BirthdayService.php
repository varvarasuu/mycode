<?php

namespace App\Services\Api\Privileges\Services;

use App\Traits\HttpResponse;
use Carbon\Carbon;
use App\Models\Bonus;
use App\Models\Cupon;
use App\Models\User;
use App\Repositories\Api\Privileges\BonusRepository;
use App\Repositories\Api\Privileges\CuponRepository;
use DateTime;

class BirthdayService
{
    use HttpResponse;

    private $cupon_repository;
    private $bonus_repository;

    public function __construct(CuponRepository $cupon_repository, BonusRepository $bonus_repository)
    {
        $this->cupon_repository = $cupon_repository;
        $this->bonus_repository = $bonus_repository;
    }
    public function getCupon()
    {
        
        $data = $this->prepare_data();
        $not_expired = $this->getNotExpriredCupon($data["birthday_cupon_active"]);
        if($not_expired){
            $data["cupons"][] = $not_expired;
        }

        if(isset($data["birthday_date"]) && empty($data["cupons"])){
            if($this->checkDateForNewCupon($data["birthday_cupons"], $data["birthday_date"], $data["timecreated"])){           
                $data["cupons"][] = $this->cupon_repository->create($data);  
            }
        }

        return $data["cupons"];
    }

    public function getNotExpriredCupon($birthday_cupon_active)
    {
        if(isset($birthday_cupon_active)){ 
        $date_finish = Carbon::parse($birthday_cupon_active->finish); 
            $today = Carbon::today(); 
            if ($today->lessThan($date_finish)){
                return $birthday_cupon_active;
                
            } else {
                $birthday_cupon_active->expired = 1;
                $birthday_cupon_active->save();
            }
        }
        return false;
    }

    public function prepare_data()
    {
        $account_id = auth()->id();
        $user = User::where('account_id', $account_id)->first();
        $birthday_cupon_active = $this->cupon_repository->getNotExpired($account_id);
        $birthday_cupons = $this->cupon_repository->get($account_id);
        return [
            "account_id" => $account_id, 
            "user" => $user,
            "cupons" => [],
            "birthday_cupon_active" => $birthday_cupon_active,
            "birthday_cupons" => $birthday_cupons,
            "birthday_date" => $user->birthday,
            "birthday_cupons" => $birthday_cupons,
            "timecreated" => time(), 
            "oneMonthsForward" => strtotime('+1 months', time()),
        ];

    }
    public function checkDateForNewCupon($birthday_cupons, $birthday_date, $timecreated)
    {
        $currentYear = date('Y');
        list($year, $month, $day) = explode('-', $birthday_date);
        $birthdayInCurrentYear = "$currentYear-$month-$day";
            
        if ($birthdayInCurrentYear != date('Y-m-d', $timecreated)){
                return false;
        }
            
        if(isset($birthday_cupons)){                  
            foreach($birthday_cupons as $cupon){
                $dateToCheck = new DateTime($cupon->start);
                $referenceDate = new DateTime($birthdayInCurrentYear);
               
                $yearDiff = $referenceDate->diff($dateToCheck)->days;
                
                    if ($yearDiff < 365) {
                        return false;
                    }
            }            
        }
        return true;
    }
    public function useBirthdayBonus()
    {      

        $data = $this->prepare_data_use();
        $birthday_bonus = $this->cupon_repository->getNotActive($data["account_id"]);
        if(isset($birthday_bonus)){
            $this->bonus_repository->create($data);                           
            $this->cupon_repository->update($data);
            return true;
        }
        return false;
    }

    public function prepare_data_use()
    {
        return [
            "account_id" => auth()->id(),
            "birthday_bonus" => $this->cupon_repository->getNotActive(auth()->id()), 
            "timecreated" => date('Y-m-d H:i:s', time()), 
            "oneMonthsForward" => date('Y-m-d H:i:s', strtotime('+1 months', time())),
        ];
    }
  }