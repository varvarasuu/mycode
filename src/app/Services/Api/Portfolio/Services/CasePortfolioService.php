<?php

namespace App\Services\Api\Portfolio\Services;

use App\Traits\HttpResponse;
use App\Models\CasePortfolio;
use App\Services\Api\MediaFile\MediaFileService;
use App\Services\Api\Portfolio\Interfaces\PortfolioDetailInterface;
use App\Repositories\Api\Portfolio\CaseRepository;


class CasePortfolioService implements PortfolioDetailInterface
{
    use HttpResponse;

    private MediaFileService $md_service;
    private CaseRepository $repository;

    public function __construct()
    {
        $this->md_service = new MediaFileService();
        $this->repository = new CaseRepository();
    }

    public function create($request)
    {
        $data = $this->prepare_data($request);
        foreach ($data["files"] as $file) {
                if(!empty($file)){
                    $data["file_path"][] = $this->md_service->storeOne($file, $data["folder_name"]);    

                }
        }

        $case = $this->repository->create($data);
        return $case->id;
    }  

    public function update($request)
    {

        $data = $this->prepare_data($request);
        $case = $this->repository->get($data["case_id"]);

        for ($i = 0; $i < 3; $i++) {
           if(!empty($data["files"][$i])){
            $file_path = $this->md_service->update($case->{$data["fields_name"][$i]}, $data["files"][$i], $data["folder_name"]);
            $data["file_path"][$i] = $file_path->id;
           } else {
            if ($case->{$data["fields_name"][$i]}) {
                $this->md_service->delete($case->{$data["fields_name"][$i]});
            }
            $data["file_path"][$i] = null;
           }        
        }

        return $this->repository->update($data);
    }

    public function get($request)
    {
        
        $data = $this->prepare_data_id($request);
        $case = $this->repository->get($data["id"]);
        $case->file_path_1 = isset($case->file_path_1) ? $this->md_service->getImagePathAndFileName($case->file_path_1) : '';
        $case->file_path_2 = isset($case->file_path_2) ? $this->md_service->getImagePathAndFileName($case->file_path_2) : '';
        $case->file_path_3 = isset($case->file_path_3) ? $this->md_service->getImagePathAndFileName($case->file_path_3) : '';
        return $case;
    }

    public function prepare_data($request)
    {
        return [
            "account_id" => auth()->id(),
            'files' => [$request->hasFile("file1") ? $request->file("file1") : null, 
            $request->hasFile("file2") ? $request->file("file2") : null, 
            $request->hasFile("file3") ? $request->file("file3") : null,],
            "description" => $request->filled('description') ? htmlspecialchars($request->description) : '', 
            "title" => htmlspecialchars($request->case_title),
            "file_path" => [], 
            "folder_name" => 'uploads/' . 'case' . '/' . auth()->id(),
            "case_id" => $request->case_id ?? null,
            "fields_name" => ['file_path_1', 'file_path_2','file_path_3'],

        ];

    }
    
    public function prepare_data_id($request){
        return [
            "id" => $request["id"],
        ];
    }

}
