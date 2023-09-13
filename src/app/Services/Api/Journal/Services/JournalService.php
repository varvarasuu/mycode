<?php

namespace App\Services\Api\Journal\Services;

use Illuminate\Http\Request;
use App\Traits\HttpResponse;
use App\Models\JournalCatalogs;
use App\Repositories\Api\Journal\JournalRepository;
use App\Repositories\Api\Journal\JournalRepositoryInterface;
use Illuminate\Support\Facades\DB;

class JournalService
{

    use HttpResponse;

    protected Request $request;
    protected JournalRepositoryInterface $repository;

    function __construct()
    {
        $this->repository = new JournalRepository();
    }

    public function getAllJournals()
    {
        return [$this->repository->getAllJournals()];
    }

    public function findJournalById($id)
    {
        return $this->repository->findJournalById($id);
    }

    public function getCatalogWithJournals($id, $page = '')
    {
        return $this->repository->getCatalogWithJournals($id, $page);
    }

    public function getCatalogs()
    {
        return $this->repository->getCatalogs();
    }
}
