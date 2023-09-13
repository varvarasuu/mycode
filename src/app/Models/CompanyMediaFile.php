<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyMediaFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'media_file_id'
    ];
}
