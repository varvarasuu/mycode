<?php

namespace App\Repositories\Api\Portfolio;

interface DocumentRepositoryInterface 
{
    public function create($data);
    public function get($id);
    public function update($data);
    public function updatePortfolio($document_id, $portfolio_id);
    public function updatePortfolioToNull($portfolio_id);
    public function getByPortfolio($portfolio_id);
}