<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'type_short',
        'type_full',
        'name',
        'name_full',
        'inn',
        'kpp',
        'ogrn',
        'ogrn_date',
        'okved',
        'okved_text',
        'manager_name',
        'manager_position',
        'okato',
        'oktmo',
        'okfs',
        'okogu',
        'type_capital',
        'sum_capital',
        'status',
        'status_text',
        'address',
        'region_id',
        'logo_image_id',
        'cover_image_id'
    ];

    public function listOfEmployees()
    {
        return $this->hasMany(ListOfEmployees::class, 'company_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function cover(){
        return $this->hasOne(MediaFile::class, 'cover_image_id');
    }

    public function logo(){
        return $this->hasOne(MediaFile::class, 'logo_image_id');
    }

    public function logoCompany()
    {
        return $this->belongsTo(MediaFile::class, 'logo_image_id');
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class, 'company_id');
    }
}
