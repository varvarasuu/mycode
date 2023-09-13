<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Requests\Settings\ChangeCurrentSectionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Services\Api\UserSettings\ChangeCurrentSectionService;
use App\Traits\HttpResponse;

/**
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\Settings
 *
 * @group Settings
 *
 * @authenticated
 */
class ChangeCurrentSectionController extends Controller
{
    use HttpResponse;
    private ChangeCurrentSectionService $service;

    public function __construct(ChangeCurrentSectionService $service)
    {
        $this->service = $service;
    }

    /**
     * Change current section
     *
     * @subgroup Change current section
     *
     * @subgroupDescription With this method i can change current section
     *
     * @header Authorization Bearer 2|QH6xqmC0aMZ4UIbFOBAp7CPuJdEr6G2xnaxYiYug
     * @responseFile status=200 scenario="can change current section" storage/responses/Settings/change_current_section/success.json
     * @responseFile status=401 scenario="unauthentificated" storage/responses/Settings/change_current_section/unauthentificated.json
     * @responseFile status=422 scenario="cant change current section" storage/responses/Settings/change_current_section/cantchange.json
     */
    public function change_current_section(ChangeCurrentSectionRequest $request)
    {
        $data = $this->service->change_current_section($request);
        return $this->success(['message' => 'Current section was updated', 'user' => $data]);
    }
}
