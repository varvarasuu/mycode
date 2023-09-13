<?php

namespace App\Services\Api\Portfolio\Services;

use App\Traits\HttpResponse;
use App\Models\DocumentPortfolio;
use App\Models\DocumentPortfolioType;
use App\Services\Api\MediaFile\MediaFileService;
use App\Services\Api\Portfolio\Interfaces\DocumentPortfolioServiceInterface;
use App\Services\Api\Portfolio\Interfaces\PortfolioDetailInterface;
use Illuminate\Support\Facades\DB;
use App\Repositories\Api\Portfolio\DocumentRepository;

class DocumentPortfolioService implements PortfolioDetailInterface, DocumentPortfolioServiceInterface
{
    use HttpResponse;

    private MediaFileService $md_service;
    private DocumentRepository $repository;
    public function __construct()
    {
        $this->md_service = new MediaFileService();
        $this->repository = new DocumentRepository();
    }

    public function create($request)
    {
        $data = $this->prepare_data($request);
        foreach ($data["files"] as $file) {
                if(!empty($file)){
                    $data["file_path"][] = $this->md_service->storeOne($file, $data["folder_name"]);    

                }
        }
    
        $new_document = $this->repository->create($data);
        return $new_document->id;
       
    }

    public function update($request)
    {
        
        $data = $this->prepare_data($request);
        $document = $this->repository->get($data["document_id"]);

        for ($i = 0; $i < 3; $i++) {
           if(!empty($data["files"][$i])){
            $file_path = $this->md_service->update($document->{$data["fields_name"][$i]}, $data["files"][$i], $data["folder_name"]);
            $data["file_path"][$i] = $file_path->id;
           } else {
            if ($document->{$data["fields_name"][$i]}) {
                $this->md_service->delete($document->{$data["fields_name"][$i]});
            }
            $data["file_path"][$i] = null;
           }        
        }

        return $this->repository->update($data);
    }

    public function getDocumentTypes()
    {
        $types = DocumentPortfolioType::all();

        return $types;
    }

    public function get($request)
    {
        $data = $this->prepare_data_id($request);
        $document = $this->repository->get($data["id"]);
        $type = DocumentPortfolioType::find($document->type_id);
        $document->type = $type->title;
        $document->file_path_1 = isset($document->file_path_1) ? $this->md_service->getImagePathAndFileName($document->file_path_1) : '';
        $document->file_path_2 = isset($document->file_path_2) ? $this->md_service->getImagePathAndFileName($document->file_path_2) : '';
        $document->file_path_3 = isset($document->file_path_3) ? $this->md_service->getImagePathAndFileName($document->file_path_3) : '';
        return $document;
    }

    public function prepare_data($request)
    {
        return [
            "account_id" => auth()->id(),
            'files' => [$request->hasFile("file1") ? $request->file("file1") : null, 
            $request->hasFile("file2") ? $request->file("file2") : null, 
            $request->hasFile("file3") ? $request->file("file3") : null,],
            "description" => $request->filled('description') ? htmlspecialchars($request->description) : '', 
            "title" => htmlspecialchars($request->document_title),
            "type_id" => $request->document_type,
            "file_path" => [], 
            "folder_name" => 'uploads/' . 'document' . '/' . auth()->id(),
            "document_id" => $request->document_id ?? null,
            "fields_name" => ['file_path_1', 'file_path_2','file_path_3'],

        ];

    }
    public function prepare_data_id($request){
        return [
            "id" => $request["id"],
        ];
    }

}
