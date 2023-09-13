<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCode extends Model
{
    use HasFactory;

    protected $fillable = [

        'email',
        'code',
        'confirmed',
        'role_in_company_id',
    ];
}
