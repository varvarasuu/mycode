<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class, 'vacancies_languages', 'language_id', 'vacancy_id')
            ->withPivot('language_level_id');
    }
}
