<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'title_in_privacy',
        'title_all_privacy',
        'title_only_me',
        'can_user',
        'can_company'
    ];
}
