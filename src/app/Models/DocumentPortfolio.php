<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentPortfolio extends Model {
    use HasFactory;

    protected $fillable = [
        'type_id',
        'title',
        'description',
        'file_path_1',
        'file_path_2',
        'file_path_3',
        'account_id',
        'portfolio_id',
    ];
}
