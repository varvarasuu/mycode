<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RoleInCompany;

class DetailListOfEmployees extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_of_employees_id',
        'employee_id',
        'role_in_company_id',
        'max_vacancies_direct_response',
        'max_anon_vacancies',
        'max_standard_vacancies',
        'max_hot_vacancies',
        'max_premium_vacancies'
    ];

    public function role()
    {
        return $this->belongsTo(RoleInCompany::class, 'role_in_company_id', 'id');
    }
}
