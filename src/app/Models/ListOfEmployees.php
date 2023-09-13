<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListOfEmployees extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
    ];

    public function detailListOfEmployees()
    {
        return $this->hasMany(DetailListOfEmployees::class, 'list_of_employees_id');
    }
}
