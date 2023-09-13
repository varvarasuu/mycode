<?php

namespace App\Repositories\Api\Category;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function show_applicant() {
        $categories = Category::join('category_names', 'categories.category_names_id', '=', 'category_names.id')
            ->join('section_for_categories', 'categories.section_for_categories_id', '=', 'section_for_categories.id')
            ->select('categories.parent_id', 'categories.img', 'category_names.name', 'category_names.id', 'section_for_categories.title')
            ->whereNull('categories.parent_id')
            ->where('section_for_categories.title', "Я соискатель")
            ->get();
        return $categories;
    }

    public function show_employer() {
        $categories = Category::join('category_names', 'categories.category_names_id', '=', 'category_names.id')
            ->join('section_for_categories', 'categories.section_for_categories_id', '=', 'section_for_categories.id')
            ->select('categories.parent_id', 'categories.img', 'category_names.name', 'category_names.id', 'section_for_categories.title')
            ->whereNull('categories.parent_id')
            ->where('section_for_categories.title', "Я работодатель")
            ->get();
        return $categories;
    }
}
