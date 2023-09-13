<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRekvisit extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'media_file_id'
    ];

    public function file()
    {
        return $this->belongsTo(MediaFile::class, 'media_file_id', 'id');
    }

}
