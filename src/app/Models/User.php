<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'account_id',
        'region_id',
        'gender_id',
        'birthday',
        'balance',
    ];

    public function gender() {
        return $this->hasOne(Gender::class, 'id', 'gender_id');
    }

    public function account() {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }

    public function region() {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }
}
