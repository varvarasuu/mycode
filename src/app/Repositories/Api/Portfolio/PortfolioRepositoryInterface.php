<?php

namespace App\Repositories\Api\Portfolio;

interface PortfolioRepositoryInterface
{
    public function create($data);
    public function update($data);
    public function delete($id);
    public function archive($id);
    public function unArchive($id);
    public function get($id);
}
