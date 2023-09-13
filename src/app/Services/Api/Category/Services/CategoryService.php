<?php

namespace App\Services\Api\Category\Services;

use App\Repositories\Api\Category\CategoryRepository;
use App\Traits\HttpResponse;

use App\Services\Api\Category\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryService implements CategoryServiceInterface
{
    use HttpResponse;

    protected Request $request;
    protected CategoryRepository $repository;

    function __construct()
    {
        $this->repository = new CategoryRepository();
        $this->request = Request();
    }

    public function show_applicant()
    {
        $categories = $this->repository->show_applicant();
        return $this->success($categories);
    }

    public function show_employer()
    {
        $categories = $this->repository->show_employer();
        return $this->success($categories);
    }
}
