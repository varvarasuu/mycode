<?php

namespace App\Services\Api\Banner;

use App\Repositories\Api\Banner\BannerRepositoryInterface;
use App\Traits\HttpResponse;
use Exception;

class BannerService
{
    use HttpResponse;

    private BannerRepositoryInterface $repository;

    public function __construct(BannerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    private function prepareData(array $data): array
    {
        $name = isset($data['name']) ? htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8') : null;
        $description = isset($data['description']) ? htmlspecialchars($data['description'], ENT_QUOTES, 'UTF-8') : null;
        $link = isset($data['link']) ? htmlspecialchars($data['link'], ENT_QUOTES, 'UTF-8') : null;
        $type = isset($data['type']) ? htmlspecialchars($data['type'], ENT_QUOTES, 'UTF-8') : null;

        if (isset($data['path_to_file']) && $data['path_to_file']->isValid()) {
            $path = $data['path_to_file']->store('public/banners');
        } else {
            $path = null;
        }

        return [
            'name' => $name,
            'description' => $description,
            'path_to_file' => $path,
            'link' => $link,
            'type' => $type,
        ];
    }

    public function create(array $data = [])
    {
        try {
            $prepareData = $this->prepareData($data);
            $this->repository->create($prepareData);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
