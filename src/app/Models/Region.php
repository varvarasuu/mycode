<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model {
    protected $fillable = ['name', 'parent_id', 'country_id'];

    public function parent() {
        return $this->belongsTo(Region::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Region::class, 'parent_id');
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
