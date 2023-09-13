<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountWorkSpaces extends Model {
    use HasFactory;

    protected $fillable = [
        'account_id',
        'work_space_id'
    ];
}
