<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;
use App\Http\Requests\Company\RightsRequest;
use App\Http\Requests\Company\KvotesRequest;
use App\Services\Api\Company\Employee\EmployeeService;
use App\Services\Api\Company\Quotas\QuotasService;

/**
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\Company
 *
 * @group Company
 *
 * @authenticated
 */
class EmployeeController extends Controller
{
    use HttpResponse;

    private $employeeService;
    private $quotasService;

    public function __construct(EmployeeService $employeeService, QuotasService $quotasService)
    {
        $this->employeeService = $employeeService;
        $this->quotasService = $quotasService;
    }

    /**
     * @subgroup EmployeeRightsAndKvotes
     *
     * @subgroupDescription Здесь настраиваются права и квоты
     *
     * @bodyParam employee_id int required Example: 77
     * @bodyParam role_id int required Example: 2
     * @bodyParam premissions required Example: [{"id":1, "is_active":1 }, {"id":2, "is_active":0 }, {"id":3, "is_active":0 }, {"id":4, "is_active":1 }, {"id":5, "is_active":1 }, {"id":6, "is_active":1 }, {"id":7, "is_active":1 }, {"id":8, "is_active":1 }, {"id":9, "is_active":1 }, {"id":10, "is_active":1 }, {"id":11, "is_active":1 }, {"id":12, "is_active":1 },{"id":13, "is_active":1 },{"id":14, "is_active":1 },{"id":15, "is_active":1 },{"id":16, "is_active":1 },{"id":17, "is_active":1}]
     *
     *
     * @responseFile status=200 scenario="Данные обновлены" storage/responses/Company/employee/employee-success-save-rights.json
     * @responseFile status=404 scenario="Роль или сотрудник не найдены" storage/responses/Company/employee/employee-error-change-role.json
     * @responseFile status=404 scenario="Профессиональный уровень не найден" storage/responses/Company/employee/employee-error-level.json
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     * @responseFile status=400 scenario="Вы не можете удалить последнего администратора" storage/responses/Company/employee/employee-error-admin.json
     * @responseFile status=400 scenario="Изменение выбранных прав недоступно для данной роли" storage/responses/Company/employee/employee-error-rights.json
     *
     */
    public function rightsSave(RightsRequest $request)
    {
        return $this->success(
            $this->employeeService->rightsSave($request)
        );
    }

    /**
     * @subgroup Employee
     *
     * @subgroupDescription Здесь получаешь список сотрудников и удаляешь
     *
     *
     * @responseFile status=200 scenario="Список отдан" storage/responses/Company/employee/employee-success-get.json
     * @responseFile status=400 scenario="В компании должен присутствовать хотя бы один администратор" storage/responses/Company/employee/employee-error-company-login.json
     *
     *
     */
    public function getEmployee()
    {
        return $this->success(
            $this->employeeService->getEmployee()
        );
    }

    /**
     * @subgroup Employee
     *
     * @subgroupDescription Здесь получаешь список сотрудников и удаляешь
     *
     *
     * @responseFile status=200 scenario="Сотрудник удален" storage/responses/Company/employee/employee-success-delete.json
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     * @responseFile status=400 scenario="В компании должен присутствовать хотя бы один администратор" storage/responses/Company/employee/employee-error-admin.json
     * @responseFile status=404 scenario="Сотрудник не найден" storage/responses/Company/employee/employee-error-not-found.json
     *
     */
    public function deleteEmployee($id)
    {
        return $this->employeeService->deleteEmployee($id);
    }
    /**
     * @subgroup EmployeeRightsAndKvotes
     *
     * @bodyParam employee_id required int Example: 3
     * @bodyParam max_vacancies_direct_response required int Example: null
     * @bodyParam max_anon_vacancies required int Example: 3
     * @bodyParam max_standard_vacancies required int Example: 3
     * @bodyParam max_hot_vacancies required int Example: 3
     * @bodyParam max_premium_vacancies required int Example: 3
     *
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     * @responseFile status=200 scenario="Квоты сохранены" storage/responses/Company/employee/employee-success-kvotes.json
     * @responseFile status=404 scenario="Сотрудник не найден" storage/responses/Company/employee/employee-error-employee-notfound.json
     */
    public function saveQuotas(KvotesRequest $request)
    {
        return $this->success(
            $this->quotasService->saveQuotas($request)
        );
    }

    /**
     * @subgroup EmployeeRightsAndKvotes
     *
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     * @responseFile status=200 scenario="Данные отправлены" storage/responses/Company/employee/employee-success-get-rights.json
     * @responseFile status=404 scenario="Сотрудник не найден" storage/responses/Company/employee/employee-error-employee-notfound.json
     *
     */
    public function getRights($id)
    {
        return $this->success(
            $this->employeeService->getRights($id)
        );
    }
    /**
     *
     * @subgroup EmployeeRightsAndKvotes
     *
     * @responseFile status=404 scenario="Сотрудник не найден" storage/responses/Company/employee/employee-error-employee-notfound.json
     * @responseFile status=200 scenario="Данные отправлены" storage/responses/Company/employee/employee-success-get-kvotes.json
     */
    public function getQuotas($id)
    {
        return $this->success(
            $this->quotasService->getQuotas($id)
        );
    }
}
