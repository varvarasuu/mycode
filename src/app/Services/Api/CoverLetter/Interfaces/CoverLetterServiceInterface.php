<?php

namespace App\Services\Api\CoverLetter\Interfaces;

interface CoverLetterServiceInterface
{
    public function create($data);

    public function get($id);

    public function update($data);

    public function delete($id);

    public function massDelete($data);

    public function index();

    public function prepare_data_create($request);

    public function prepare_data_update($request);

    public function prepare_data_id($request);

    public function prepare_data_mass($request);
}
