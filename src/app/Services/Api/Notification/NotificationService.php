<?php

namespace App\Services\Api\Notification;

use App\Traits\HttpResponse;
use App\Models\Account;
use App\Models\Company;
use App\Models\EmployerNotification;
use App\Models\UserNotification;
use App\Repositories\Api\Account\EloquentAccountRepository;
use App\Services\Api\Account\AccountService;
use App\Services\Api\MediaFile\MediaFileService;
use App\Services\Api\RequestDispatcher\RequestDispatcher;

class NotificationService
{
    use HttpResponse;
    protected RequestDispatcher $requestDispatcher;
    private $accountService;
    private array $data;

    public function __construct(Account $account, UserNotification $notif)
    {
        $this->accountService = new AccountService(new EloquentAccountRepository(), new MediaFileService());
        $this->requestDispatcher = new RequestDispatcher();
        $this->data = $this->prepareData($notif, $account);
    }
    public function getNotification($request){
        $account_id = auth()->id();
        $company_id = $this->accountService->getCurrentCompanyID();
        
        $perPage = 3;
        if(!isset($request->tab)){
            return [];
        }
        if(empty($company_id)){
            $notif["all_user"] = [UserNotification::where("account_id", $account_id)->where("section_id", 4)->where("read", 0)->get(), "Все"];
            $notif["invitation"] = [UserNotification::where("account_id", $account_id)->where("section_id", 4)->where("tabs", "Приглашения")->where("read", 0)->get(), "Приглашения"];
            $notif["offers"] = [UserNotification::where("account_id", $account_id)->where("section_id", 4)->where("tabs", "Офферы")->where("read", 0)->get(), "Офферы"];
            $notif["subscr_user"] = [UserNotification::where("account_id", $account_id)->where("section_id", 4)->where("tabs", "Подписки")->where("read", 0)->get(), "Подписки"];
            $notif["other_user"] = [UserNotification::where("account_id", $account_id)->where("section_id", 4)->where("tabs", "Другое")->where("read", 0)->get(), "Другое"];
            $tabs = $this->countTabs($notif);
            if($request->tab == "Все"){
                $current = UserNotification::where("account_id", $account_id)->where("section_id", 4);
            } else {
                $current = UserNotification::where("account_id", $account_id)->where("company_id", null)->where("tabs", $request->tab);
            }
        } else {
            $notif["all_company"] = [UserNotification::where("company_id", $company_id)->where("read", 0)->get(), "Все"];
            $notif["work"] =  [UserNotification::where("company_id", $company_id)->where("tabs", "Хочу тут работать")->where("read", 0)->get(), "Хочу тут работать"];
            $notif["recomend"] =  [UserNotification::where("company_id", $company_id)->where("tabs", "Рекомендации")->where("read", 0)->get(), "Рекомендации"];
            $notif["subscr_company"] =  [UserNotification::where("company_id", $company_id)->where("tabs", "Подписки")->where("read", 0)->get(), "Подписки"];
            $notif["other_company"] =  [UserNotification::where("company_id", $company_id)->where("tabs", "Другое")->where("read", 0)->get(), "Другое"];
            $tabs = $this->countTabs($notif);
            if($request->tab == "Все"){
                $current = UserNotification::where("company_id", $company_id);
            } else {
                $current = UserNotification::where("company_id", $company_id)->where("tabs", $request->tab);
            }
            
        }

        

        if(empty($current)){
            return ["tabs" => $tabs, "notifications" => []];
        }

        $current->orderBy('id', 'desc');
        $current = $current->paginate($perPage);
        return ["tabs" => $tabs, "nofications" => [
            'current' => $current,
            'pagination' => [
                'current_page' => $current->currentPage(),
                'last_page' => $current->lastPage(),
                'total' => $current->total(),
                ]],
            ];
    }

    public function getCount()
    {
        $account_id = auth()->id();
        $company_id = $this->accountService->getCurrentCompanyID();
        $user_notif = UserNotification::where("account_id", $account_id)->where("section_id", 4)->where("read", 0)->get();
        $company_notif = UserNotification::where("company_id", $company_id)->where("read", 0)->get();
        $user_count = $this->countArray($user_notif);
        $company_count = $this->countArray($company_notif);
        return [
            "Я заказчик" => 0,
            "Я работодатель" => $company_count,
            "Я покупатель" => 0,
            "Я исполнитель" => 0,
            "Я соискатель" => $user_count,
            "Я продавец" => 0,
            "Маркетплейс" => 0,
            "Минимаркет" => 0,
            "Сервисы" => 0,

        ];

    }

    public function countArray($array){
        if(!empty($array))
        {
            $count = count($array);
        } else {
            $count = 0;
        }
        return $count;
    }
    public function countTabs($notif)
    {
        $tabs = [];
            foreach ($notif as $value){
                if(!empty($value[0])){
                     $count = count($value[0]);
                    
                } else {
                    $count = 0;
                }
                $tabs[] = ["title" => $value[1], "count" => $count];
            }
        return $tabs;
    }
    public function readNotificationAll()
    {
        $account_id = auth()->id();
        $account = Account::find($account_id);
        $company_id = $account->logged_as;
        $company = Company::find($company_id);
        
        if(empty($company)){
            $notifications = UserNotification::where("account_id", $account_id)->where("section_id", 4)->where("read", 0)->get();
        } else {
            $notifications = UserNotification::where('company_id', $company_id)->where("read", 0)->get();
        }
        if(!empty($notifications)){
            foreach($notifications as $notification){
                $notification->read = 1;
                $notification->save();
            }
        }
       return $this->success(["message" => "Уведомления прочитаны"]);
    }

    public function readNotification($request)
    {
        
        $notifications = [];
        
        if(!empty($request["ids"])){
                foreach($request["ids"] as $id){
                    $not = UserNotification::find($id);
                    if(!empty($not)){
                        $notifications[] = $not;
                     }
                }}
        
        if(!empty($notifications)){
            foreach($notifications as $notification){
                $notification->read = 1;
                $notification->save();
            }
        }
       return $this->success(["message" => "Уведомления прочитаны"]);
    }
    public function setData(Account $account, UserNotification $notif)
    {
        $this->data = $this->prepareData($notif, $account);
    }
    public function prepareData(UserNotification $notif, Account $account) : array
    {
        return [
                "idNotif" => $notif->id,
                "idAtwork" => strval($account->id), 
                "message" => $notif->message,
                "link" => $notif->link,
                "sectionId" => $notif->section_id,
                "tabs" => $notif->tabs,
                "service" => $notif->service,
                "read" => $notif->read,
        ];

    }

    public function createNotif()
    {
        $response = $this->requestDispatcher->defaultPostDispatcher(
            '/api/users/create-notification',
            $this->data
        );
        return $response;
    }
}