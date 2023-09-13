<?php

namespace App\Services\Api\Company\Employee;

use App\Exceptions\NotFoundException;
use App\Exceptions\ServerErrorException;
use App\Exceptions\UnauthorizedException;
use App\Models\RoleInCompany;
use App\Models\DetailListOfEmployees;
use App\Models\Account;
use App\Models\User;
use App\Models\Company;
use App\Models\DefaultPermission;
use App\Models\EmployeePermission;
use App\Models\ProfessionalLevel;
use App\Repositories\Api\Company\CompanyRepositoryInterface;
use App\Repositories\Api\Company\EloquentCompanyRepository;
use App\Services\Api\Account\AccountService;

class EmployeeService implements EmployeeServiceInterface
{
    private $accountService;
    private CompanyRepositoryInterface $companyRepository;

    public function __construct(AccountService $accountService, EloquentCompanyRepository $companyRepository)
    {
        $this->accountService = $accountService;
        $this->companyRepository = $companyRepository;
    }

    public function changeRole($role_id, $employee_id, $list_id)
    {
        $employee = DetailListOfEmployees::where('id', $employee_id)->where('list_of_employees_id', $list_id)->first();
        $admin_id = RoleInCompany::where('name', 'Администратор')->first()->id;
        if ($role_id !== $admin_id) {
            $employees = DetailListOfEmployees::where('list_of_employees_id', $list_id)->where('role_in_company_id', $admin_id)->get();
            $number_of_admins = count($employees);
            if ($number_of_admins == 1) {
                if (($employee->role_in_company_id == $admin_id) && ($role_id != $admin_id)) {
                    return false;
                }
            }
        }

        $employee->role_in_company_id = $role_id;
        $employee->save();

        return true;
    }

    public function getEmployee()
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        return $this->getListOfEmployees($company_id);
    }

    public function getListOfEmployees($company_id)
    {
        $list_of_employees = $this->companyRepository->getListOfEmployees($company_id);
        $employees = DetailListOfEmployees::where('list_of_employees_id', $list_of_employees->id)->get();
        return $this->serializeListOfEmployees($employees);
    }

    public function serializeListOfEmployees($employees)
    {
        $employee_list = [];
        foreach ($employees as $employee) {
            $employee_account = $this->accountService->findById($employee->employee_id);
            $employee_user = User::where('account_id', $employee->employee_id)->first();

            $employee_list[] = [
                'id' => $employee->id,
                'role' => $employee->role->name,
                'name' => $employee_user->name,
                'lastname' => $employee_user->lastname,
                'email' => $employee_account->email,
                'phone' => $employee_account->phone_number,
            ];
        }
        return $employee_list;
    }

    public function deleteEmployee($id)
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        $employee = $this->companyRepository->getEmployeer($company_id, $id);
        $admin_id = RoleInCompany::where('name', 'Администратор')->first()->id;
        $employees = DetailListOfEmployees::where('list_of_employees_id', $list_of_employees->id)->where('role_in_company_id', $admin_id)->get();
        $number_of_admins = count($employees);
        if ($number_of_admins == 1) {
            if ($employees->first()->employee_id == $id) {
                throw new ServerErrorException('В компании должен присутствовать хотя бы один администратор');
            }
        }

        $employee->delete();
        return ['message' => 'Сотрудник удалён'];
    }

    public function rightsSave($request)
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        $company = Company::find($company_id);

        //check if action is allowed
        if (!isset($company)) {
            throw new UnauthorizedException('Вы не зашли в профиль компании');
        }
        $list_of_employees = $this->companyRepository->getListOfEmployees($company_id);
        $employee = DetailListOfEmployees::where('id', $request->employee_id)->where('list_of_employees_id', $list_of_employees->id)->first();
        if (!isset($employee)) {
            throw new NotFoundException('Роль или сотрудник не найдены');
        }

        $role = RoleInCompany::find($request->role_id);
        if (!isset($role)) {
            throw new NotFoundException('Роль или сотрудник не найдены');
        }

        $defualt_permissions_disabled = DefaultPermission::where('role_id', $request->role_id)->where('is_disabled', 1)->get();
        foreach ($request->permissions as $permission) {
            foreach ($defualt_permissions_disabled as $disabled) {
                if ($permission["id"] == $disabled->permission_id && $permission["is_active"] != $disabled->is_active) {
                    throw new ServerErrorException('Изменение выбранных прав недоступно для данной роли');
                }
            }
        }

        if (!$this->changeRole($request->role_id, $request->employee_id, $list_of_employees->id)) {
            throw new ServerErrorException('В компании должен присутствовать хотя бы один администратор');
        }

        if (isset($request->prof_level_id)) {
            $level = ProfessionalLevel::find($request->prof_level_id);
            if (!isset($level)) {
                throw new NotFoundException('Профессиональный уровень не найден');
            }
        }
        //change default disabled according to role
        if ($request->role !== $employee->role_in_company_id) {
            $defaults = DefaultPermission::where('role_id', $request->role_id)->get();
            foreach ($defaults as $default) {
                $old_permission_to_disable = EmployeePermission::where('employee_id', $employee->id)->where('permission_id', $default->permission_id)->first();
                $old_permission_to_disable->is_disabled = $default->is_disabled;
                $old_permission_to_disable->save();
            }
        }

        //change "is active" according to request
        foreach ($request->permissions as $permission) {
            $old_permission = EmployeePermission::where('employee_id', $employee->id)->where('permission_id', $permission["id"])->first();
            $old_permission->is_active = $permission["is_active"];
            $old_permission->save();
        }


        //change employee data
        if (isset($request->position)) {
            $employee->position = htmlspecialchars($request->position);
        } else {
            $employee->position = null;
        }
        if (isset($request->prof_level_id)) {
            $employee->prof_level_id = $request->prof_level_id;
        }
        if (isset($request->extra_contacts)) {
            $employee->extra_contacts = htmlspecialchars($request->extra_contacts);
        } else {
            $employee->extra_contacts = null;
        }
        $employee->save();
        return ['message' => 'Данные обновлены'];
    }

    public function getRights($id)
    {
        $company_id = $this->accountService->getCurrentCompanyID();
        $company = Company::find($company_id);

        if (!isset($company)) {
            throw new UnauthorizedException('Вы не зашли в профиль компании');
        }
        $employee = $this->companyRepository->getEmployeer($company_id, $id);
        if (!isset($employee)) {
            throw new NotFoundException('Сотрудник не найден');
        }

        $roles_all = RoleInCompany::all();
        $roles_show = [];
        foreach ($roles_all as $role) {
            $is_active = 0;
            if ($role->id == $employee->role_in_company_id) {
                $is_active = 1;
            }
            $roles_show[] = ['role_id' => $role->id, "role_name" => $role->name, "is_active" => $is_active];
        }

        $default_all = DefaultPermission::all();
        $default_show = [];
        foreach ($default_all as $default) {
            $default_show[] = [
                "role_id" => $default->role_id,
                "permission_id" => $default->permission_id,
                "permission_name" => $default->permission->name,
                "is_active" => $default->is_active,
                "is_disabled" => $default->is_disabled
            ];
        }

        $employee_permission_all = EmployeePermission::where('employee_id', $id)->get();
        $employee_permission_show = [];
        foreach ($employee_permission_all as $permission) {
            $employee_permission_show[] = [
                "permission_id" => $permission->permission_id,
                "permission_name" => $permission->permission->name,
                "is_active" => $permission->is_active,
                "is_disabled" => $permission->is_disabled
            ];
        }

        $level_all = ProfessionalLevel::all();
        $level_show = [];
        foreach ($level_all as $level) {
            $is_active = 0;
            if ($level->id == $employee->prof_level_id) {
                $is_active = 1;
            }

            $level_show[] = ['level_id' => $level->id, "level_name" => $level->name, "is_active" => $is_active];
        }

        $account_employee = Account::find($employee->employee_id);

        return [
            "roles" => $roles_show,
            "current_permissions" => $employee_permission_show,
            "default_permissions" => $default_show,
            "position" => $employee->position,
            "professional_level" => $level_show,
            "email" => $account_employee->email,
            "phone_number" => $account_employee->phone_number,
            "extra_contacts" => $employee->extra_contacts,

        ];
    }
}
