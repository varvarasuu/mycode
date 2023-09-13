<?php

namespace App\Http\Controllers\Api\Company;

use App\Traits\HttpResponse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\ExternalSearchCompanyRequest;
use App\Http\Requests\Company\InternalSearchCompanyRequest;
use App\Http\Requests\Company\LoginAsCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Requests\Company\RekvisitesRequest;
use App\Http\Requests\Company\OfficeRequest;
use App\Services\Api\Company\CompanyService;
use App\Http\Requests\Company\EmployeeCodeRequest;
use App\Services\Api\Company\Offices\OfficeService;
use App\Services\Api\Company\Requisite\RequisiteService;

/**
 * Controller for Companies
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\Company\CompanyController
 *
 * @group Company
 *
 * @authenticated
 */
class CompanyController extends Controller
{
    use HttpResponse;

    private CompanyService $service;
    private OfficeService $officeService;
    private $requisiteService;

    public function __construct(CompanyService $service, OfficeService $officeService, RequisiteService $requisiteService)
    {
        $this->service = $service;
        $this->officeService = $officeService;
        $this->requisiteService = $requisiteService;
    }
    /**
     * @subgroup Create
     *
     * @subgroupDescription Here i can create companies
     *
     * @bodyParam inn string required Example: 7717756611
     *
     * @responseFile status=201 scenario="company created" storage/responses/Company/create/success.json
     * @responseFile status=422 scenario="company already exist" storage/responses/Company/create/fail.json
     * @responseFile status=422 scenario="inn is required" storage/responses/Company/create/inn.json
     */
    public function create_company(CreateCompanyRequest $request)
    {
        $request->validated($request->all());
        return $this->service->create_company($request);
    }

    /**
     * @subgroup External Search
     *
     * @subgroupDescription Here i can search companies external of at-work.pro
     *
     * @urlParam query string required Example: ат ворк
     *
     * @responseFile status=200 scenario="i found company" storage/responses/Company/external_search/success.json
     * @responseFile status=404 scenario="i not found company" storage/responses/Company/external_search/fail.json
     */
    public function external_search_company(ExternalSearchCompanyRequest $request)
    {
        return $this->service->external_search_company($request);
    }

    /**
     * @subgroup Internal Search
     *
     * @subgroupDescription Here i can search companies in the system of at-work.pro
     *
     * @urlParam query string required Example: ат ворк
     *
     * @responseFile status=200 scenario="i found company" storage/responses/Company/internal_search/success.json
     * @responseFile status=200 scenario="i not found company" storage/responses/Company/internal_search/empty.json
     * @responseFile status=422 scenario="query is required" storage/responses/Company/internal_search/fail.json
     */
    public function internal_search_company(InternalSearchCompanyRequest $request)
    {
        return $this->service->internal_search_company($request);
    }

    /**
     * @subgroup Get my companies
     *
     * @subgroupDescription Here i can get companies where i am
     *
     * @responseFile status=200 scenario="i have companies" storage/responses/Company/get_my_companies/success.json
     * @responseFile status=200 scenario="i dont have companies" storage/responses/Company/get_my_companies/empty.json
     */
    public function get_my_companies()
    {
        return $this->service->get_my_companies();
    }

    /**
     * @subgroup Login as company
     *
     * @subgroupDescription Here i can login as one of my companies
     *
     * @responseFile status=200 scenario="i can login as that company" storage/responses/Company/login_as_company/success.json
     * @responseFile status=200 scenario="i cant login as that company" storage/responses/Company/login_as_company/fail.json
     * @responseFile status=200 scenario="this company no exist" storage/responses/Company/login_as_company/empty.json
     */
    public function login_as_company(LoginAsCompanyRequest $request)
    {
        return $this->service->login_as_company($request);
    }

    /**
     * @subgroup Logout is company
     *
     * @subgroupDescription Here i can logout is company
     *
     * @responseFile status=200 scenario="i can logout as that company" storage/responses/Company/logout_is_company/success.json
     */
    public function logout_is_company()
    {
        return $this->service->logout_is_company();
    }

    /**
     * @subgroup Update company
     *
     * @subgroupDescription Here i can logout is company
     *
     * @responseFile status=200 scenario="i can logout as that company" storage/responses/Company/logout_is_company/success.json
     */
    public function update_company(UpdateCompanyRequest $request)
    {
        return $this->service->update_company($request);
    }

    /**
     * @subgroup Get Company sizes
     *
     * @subgroupDescription List all possible sizes of companies
     *
     * @responseFile status=200 scenario="success" storage/responses/Company/company_sizes/success.json
     */
    public function get_company_sizes()
    {
        return $this->service->get_company_sizes();
    }

    /**
     * @subgroup addEmployee
     *
     * @bodyParam email required Example: test@mail.ru
     * @bodyParam role required integer Example: 1
     * @bodyParam start_link required string Example: at-work.pro/invite/
     * @responseFile status=200 scenario="Email успешно отправлен" storage/responses/Company/add_employee/send_link_success.json
     */
    public function sendLink(EmployeeCodeRequest $request)
    {
        return $this->service->sendLink($request);
    }
    /**
     * @subgroup addEmployee
     *
     * @responseFile status=200 scenario="Email успешно подтвержден" storage/responses/Company/add_employee/use_link_success.json
     */
    public function useLink($code)
    {
        return $this->service->useLink($code);
    }

    /**
     * @subgroup Update juridical data
     *
     * @responseFile status=200 scenario="Email успешно подтвержден" storage/responses/Company/add_employee/use_link_success.json
     */
    public function update_juridical_data()
    {
        return $this->service->update_juridical_data();
    }
    /**
     * @subgroup Rekvisites
     *
     * @bodyParam  company_rekvisites array of files
     *
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     * @responseFile status=200 scenario="Реквизиты добавлены" storage/responses/Company/rekvisites/company-success-rekvisites.json
     */
    public function addRekvisites(RekvisitesRequest $request)
    {
        if($this->requisiteService->addRequisites($request))
        {
            return $this->success(
                "Реквизиты добавлены"
            );
        }
    }

    /**
     * @subgroup Rekvisites
     *
     *
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     *
     */
    public function getRekvisites()
    {
        return $this->success(
            $this->requisiteService->getRequisites()
        );
    }

    /**
     * @subgroup Office
     *
     *
     * @bodyParam address required string Example:  "Санкт-Петербург, Гражданский проспект, 22"
     * @bodyParam coordinate reuired array Example: [60.003979, 30.387329]
     * @bodyParam metro required array Example:  [ { "name": "Политехническая", "line": 1, "city": "Санкт-Петербург" }, { "name": "Академическая", "line": 1, "city": "Санкт-Петербург"  }]
     *
     *
     * @responseFile status=200 scenario="Офис добавлен" storage/responses/Company/office/office-success-add.json
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     */
    public function addOffice(OfficeRequest $request)
    {
        return $this->success($this->officeService->addOffice($request));
    }
    /**
     * @subgroup Office
     *
     * @responseFile status=200 scenario="Офис отдан" storage/responses/Company/office/office-success-add.json
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     *
     */
    public function getOffices()
    {
        return $this->success(
            $this->officeService->getOffices()
        );
    }
    /**
     * @subgroup Office
     *
     * @responseFile status=404 scenario="Офис не найден" storage/responses/Company/office/office-error-not-found.json
     * @responseFile status=200 scenario="Офис успешно удален" storage/responses/Company/office/office-success-delete.json
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     */
    public function deleteOffice($id)
    {
        return $this->success(
            $this->officeService->deleteOffice($id)
        );
    }
    /**
     * @subgroup Office
     *
     * @bodyParam office_id required integer Example: 1
     * @bodyParam address required string Example:  "Санкт-Петербург, Гражданский проспект, 22"
     * @bodyParam coordinate reuired array Example: [60.003979, 30.387329]
     * @bodyParam metro required array Example:  [ { "name": "Политехническая", "line": 1, "city": "Санкт-Петербург" }, { "name": "Академическая", "line": 1, "city": "Санкт-Петербург"  }]
     *
     *
     * @responseFile status=200 scenario="Офис обновлен" storage/responses/Company/office/office-success-add.json
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     * @responseFile status=404 scenario="Офис не найден" storage/responses/Company/office/office-error-not-found.json
     */
    public function updateOffice(OfficeRequest $request)
    {
        return $this->success(
            $this->officeService->updateOffice($request)
        );
    }
}
