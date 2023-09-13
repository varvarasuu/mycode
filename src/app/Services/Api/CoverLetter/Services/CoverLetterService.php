<?php

namespace App\Services\Api\CoverLetter\Services;

use App\Services\Api\CoverLetter\Interfaces\CoverLetterServiceInterface;
use App\Traits\HttpResponse;
use App\Repositories\Api\CoverLetter\CoverLetterRepository;

class CoverLetterService implements CoverLetterServiceInterface
{
    use HttpResponse;

    protected CoverLetterRepository $repository;

    function __construct()
    {
        $this->repository = new CoverletterRepository;
    }

    public function create($request)
    {

        $data = $this->prepare_data_create($request);

        return $this->repository->create($data);
    }

    public function get($request)
    {
        $id = $this->prepare_data_id($request);
        return $this->repository->get($id);
    }

    public function update($request)
    {
        $data = $this->prepare_data_update($request);
        return $this->repository->update($data);
    }

    public function delete($request)
    {
        $data = $this->prepare_data_id($request);
        return $this->repository->delete($data);
    }

    public function massDelete($request)
    {
        $data = $this->prepare_data_mass($request);

        foreach ($data["ids"] as $id) {
            $this->repository->delete($id);
        }

        return true;
    }

    public function index()
    {
        return $this->repository->getNotDeleted(auth()->id());
    }



    public function prepare_data_create($request)
    {
        return [
            "account_id" => auth()->id(),
            "title" => htmlspecialchars($request->title),
            "content" => htmlspecialchars($request->content)
        ];
    }

    public function prepare_data_update($request)
    {
        return [
            "account_id" => auth()->id(),
            "title" => htmlspecialchars($request->title),
            "content" => htmlspecialchars($request->content),
            "id" => $request->cover_letter_id
        ];
    }

    public function prepare_data_id($request)
    {
        return $request["id"];
    }

    public function prepare_data_mass($request)
    {
        return [
            "account_id" => auth()->id(),
            "ids" => $request->cover_letter_ids,
        ];
    }
}
