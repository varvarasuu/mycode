<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSpace extends Model {
    use HasFactory;

    protected $fillable = [
        'section_id',
        'account_id',
        'is_active',
    ];

    public function section() {
        return $this->hasMany(Section::class, 'id', 'section_id');
    }
}
