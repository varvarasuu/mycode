<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model {
    use HasFactory;

    protected $fillable = [
        'category_names_id',
        'parent_id',
    ];

    public function categoryName() //зачем названия в отельной таблице???
    {
        return $this->belongsTo(CategoryName::class, 'category_names_id');
    }
}
