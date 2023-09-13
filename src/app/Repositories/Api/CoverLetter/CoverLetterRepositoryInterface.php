<?php

namespace App\Repositories\Api\CoverLetter;

interface CoverLetterRepositoryInterface
{
    public function create($data);

    public function get($id);

    public function update($data);

    public function getNotDeleted($account_id);

    public function delete($id);
}