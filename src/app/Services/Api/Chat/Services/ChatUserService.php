<?php

namespace App\Services\Api\Chat\Services;

use App\Models\Account;
use App\Models\User;
use App\Services\Api\Account\AccountService;
use App\Services\Api\Chat\Interfaces\IChatUserService;
use App\Services\Api\MediaFile\MediaFileService;
use App\Services\Api\RequestDispatcher\HttpRequestInterface;
use App\Services\Api\RequestDispatcher\RequestDispatcher;
use Illuminate\Support\Facades\Http;

class ChatUserService implements IChatUserService
{

    protected RequestDispatcher $requestDispatcher;
    private MediaFileService $md_service;
    private array $data;

    public function __construct(Account $account, User $user)
    {
        $this->md_service = new MediaFileService();
        $this->requestDispatcher = new RequestDispatcher();
        $this->data = $this->prepareDataUser($account, $user);
    }

    public function setData(Account $account, User $user)
    {
        $this->data = $this->prepareDataUser($account, $user);
    }

    public function prepareDataUser(Account $account, User $user) : array
    {
        return [
            'idAtWork' => strval($account->id),
            'name' => $user->name,
            'lastName' => $user->lastname,
            'profileImg' => $this->md_service->getImagePathAndFileName($account->avatar),
            'typeCompany' => null,
            'nameCompany' => null,
            'type' => 'user'
        ];
    }

    public function createUser()
    {
        $response = $this->requestDispatcher->defaultPostDispatcher(
            '/api/users/create',
            $this->data
        );
        return $response;
    }

    public function updateUser(array $data){
        $response = $this->requestDispatcher->defaultPostDispatcher(
            '/api/users/update',
            $data
        );

        return $response;
    }

    public function loginUser()
    {
        $response = $this->requestDispatcher->defaultPostDispatcher(
            '/api/users/update',
            $this->data
        );

        return $response;
    }

    public function logoutUser()
    {
        $response = $this->requestDispatcher->defaultPostDispatcher(
            '/api/users/logout',
            $this->data
        );

        return $response;
    }
}
