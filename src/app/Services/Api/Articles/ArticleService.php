<?php

namespace App\Services\Api\Articles;

use App\Repositories\Api\Article\EloquentArticleCategoryRepository;
use App\Repositories\Api\Article\EloquentArticleRepository;
use App\Traits\HttpResponse;
use Exception;

class ArticleService
{
    use HttpResponse;

    private EloquentArticleRepository $articleRepo;
    private EloquentArticleCategoryRepository $categoryRepo;

    public function __construct(EloquentArticleRepository $articleRepo, EloquentArticleCategoryRepository $categoryRepo)
    {
        $this->articleRepo = $articleRepo;
        $this->categoryRepo = $categoryRepo;
    }

    public function read(string $name, int $id)
    {
        try {
            $article = $this->articleRepo->find($id);
            return $this->success($article);
        } catch (Exception $e) {
            return $this->error('Not found');
        }
    }

    public function search(?string $param = null)
    {
        $articles = $this->articleRepo->search($param);
        return $this->success($articles);
    }

    public function index()
    {
        try {
            $categories = $this->categoryRepo->all();

            if ($categories) {
                return $this->success($categories);
            }
        } catch (Exception $e) {
            return $this->error('Unknown error');
        }
    }

    public function articles(string $name)
    {
        try {
            $catalog = $this->categoryRepo->findByUrl($name);
            if (!$catalog) {
                return $this->error('Catalog not found');
            }

            $articles = $this->articleRepo->getByCategory($catalog->id);

            if ($articles) {
                return $this->success($articles);
            }

        } catch (Exception $e) {
            return $this->error('Unknown error');
        }
    }
}
