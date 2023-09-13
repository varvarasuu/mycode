<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryName extends Model {
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function categories()
    {
        return $this->hasMany(Category::class, 'category_names_id');
    }
}
