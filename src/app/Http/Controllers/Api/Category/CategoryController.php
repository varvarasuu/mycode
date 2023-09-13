<?php

namespace App\Http\Controllers\Api\Category;


use App\Services\Api\Category\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;

/**
 * Controller for handling Categories.
 *
 * @category Controller
 *
 * @package App\Http\Controllers
 *
 * @group Category
 */

class CategoryController extends Controller
{
    use HttpResponse;

    protected CategoryService $CategoryService;

    function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
    }

    /**
     * Show categories of Applicant
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show_applicant()
    {
        return $this->CategoryService->show_applicant();
    }

    /**
     * Show categories of Applicant
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show_employer()
    {
        return $this->CategoryService->show_employer();
    }
}
