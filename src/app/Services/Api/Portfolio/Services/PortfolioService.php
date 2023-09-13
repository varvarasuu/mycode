<?php

namespace App\Services\Api\Portfolio\Services;

use App\Http\Requests\Portfolio\PortfolioDeleteRequest;
use App\Traits\HttpResponse;
use App\Models\CasePortfolio;
use App\Models\DocumentPortfolio;
use App\Models\DocumentPortfolioType;
use App\Models\Portfolio;
use App\Repositories\Api\Portfolio\CaseRepository;
use App\Repositories\Api\Portfolio\DocumentRepository;
use App\Repositories\Api\Portfolio\PortfolioRepository;
use App\Services\Api\MediaFile\MediaFileService;
use App\Services\Api\Portfolio\Interfaces\PortfolioServiceInterface;
use App\Traits\NotificationTrait;

class PortfolioService implements PortfolioServiceInterface
{
    use HttpResponse, NotificationTrait;

    private MediaFileService $md_service;
    private CasePortfolioService $case_service;
    private DocumentPortfolioService $document_service;
    private PortfolioRepository $repository;
    private CaseRepository $case_repository;
    private DocumentRepository $document_repository;

    public function __construct()
    {
        $this->md_service = new MediaFileService();
        $this->case_service = new CasePortfolioService();
        $this->document_service = new DocumentPortfolioService();
        $this->repository = new PortfolioRepository();
        $this->case_repository = new CaseRepository();
        $this->document_repository = new DocumentRepository;
    }

    public function make($request)
    {
        $data = $this->prepare_data($request);
        $account_id = auth()->id();

        $portfolio = $this->repository->create($data);
        
        
        if (!empty($data["case_ids"])) {
            foreach ($data["case_ids"] as $case_id) {
               $this->case_repository->updatePortfolio($case_id, $portfolio->id);
            }
        }

        if (!empty($data["document_ids"])) {
            foreach ($data["document_ids"] as $document_id) {
                $this->document_repository->updatePortfolio($document_id, $portfolio->id);
            }
        }
        $this->notifyUser("default", $data["account_id"]);
        //return $this->success($new_portfolio,  'success', 201);
        return $portfolio;
    }

    public function prepare_data($request)
    {
        return [
            "account_id" => auth()->id(),
            "about" => $request->about ? htmlspecialchars($request->about) : "",
            "link" => $request->link ? htmlspecialchars($request->link) : "",
            "occupation" => htmlspecialchars($request->occupation),
            "case_ids" => $request->case_ids ?? null, 
            "document_ids" => $request->document_ids ?? null,
            "portfolio_id" => $request->portfolio_id ?? null,
        ];
    }

    public function update($request)
    {
        $data = $this->prepare_data($request);

        if($this->repository->update($data)){
            $this->case_repository->updatePortfolioToNull($data["portfolio_id"]);
            $this->document_repository->updatePortfolioToNull($data["portfolio_id"]);
    
            
            if (!empty($data["case_ids"])) {
                foreach ($data["case_ids"] as $case_id) {
                   $this->case_repository->updatePortfolio($case_id, $data["portfolio_id"]);
                }
            }
    
            if (!empty($data["document_ids"])) {
                foreach ($data["document_ids"] as $document_id) {
                    $this->document_repository->updatePortfolio($document_id, $data["portfolio_id"]);
                }
            }
            return true;
        }
        
        return false;
    }
    public function prepare_data_id($request)
    {
        return [
            "id" => $request["id"],
           
        ];

    }   
    public function delete($request)
    {
        $data = $this->prepare_data_id($request);
        return $this->repository->delete($data["id"]);
        
    }

    public function archive($request)
    {
        $data = $this->prepare_data_id($request);
        return $this->repository->archive($data["id"]);
        
    }

    public function unArchive($request)
    {
        $data = $this->prepare_data_id($request);
        return $this->repository->unArchive($data["id"]);
    }

    public function prepare_data_list($archived)
    {
        return [
            "account_id" => auth()->id(),
            "archived" => $archived,
        ];
    }
    public function getList($archived)
    {
        $data = $this->prepare_data_list($archived);
        $portfolios = $this->repository->getList($data);
        $result = [];
        foreach ($portfolios as $portfolio) {
            $portfolio_id = $portfolio->id;
            $cases = $this->getCasesByPortfolio($portfolio->id);
            $documents = $this->getDocumentsByPortfolio($portfolio->id);
            $result[] = ['portfolio' => $portfolio, 'cases' => $cases, 'documents' => $documents];
        }
        return $result;
    }

    public function get($request)
    {
        $data = $this->prepare_data_id($request);
        $portfolio = $this->repository->get($data["id"]);
        $cases = $this->getCasesByPortfolio($data["id"]);
        $documents = $this->getDocumentsByPortfolio($data["id"]);
        return ["portfolio" => $portfolio, "cases" => $cases, "documents" => $documents];
    }

    public function getCasesByPortfolio($portfolio_id)
    {
        $cases = $this->case_repository->getByPortfolio($portfolio_id);
        foreach ($cases as $case) {
            $case->file_path_1 = isset($case->file_path_1) ? $this->md_service->getImagePathAndFileName($case->file_path_1) : '';
            $case->file_path_2 = isset($case->file_path_2) ? $this->md_service->getImagePathAndFileName($case->file_path_2) : '';
            $case->file_path_3 = isset($case->file_path_3) ? $this->md_service->getImagePathAndFileName($case->file_path_3) : '';
        }
        return $cases;
    }

    public function getDocumentsByPortfolio($portfolio_id)
    {
        $documents = $this->document_repository->getByPortfolio($portfolio_id);
        foreach ($documents as $document) {
            $document->file_path_1 = isset($document->file_path_1) ? $this->md_service->getImagePathAndFileName($document->file_path_1) : '';
            $document->file_path_2 = isset($document->file_path_2) ? $this->md_service->getImagePathAndFileName($document->file_path_2) : '';
            $document->file_path_3 = isset($document->file_path_3) ? $this->md_service->getImagePathAndFileName($document->file_path_3) : '';
        }

        return $documents;
    }

    public function createCase($request)
    {
        return $this->case_service->create($request);
    }
    public function updateCase($request)
    {
        return $this->case_service->update($request);
    }
    public function getCase($request)
    {
        return $this->case_service->get($request);
    }

    public function createDocument($request)
    {
        return $this->document_service->create($request);
    }
    public function updateDocument($request)
    {
        return $this->document_service->update($request);
        
    }
    public function getDocument($request)
    {
        return $this->document_service->get($request);
    }

    public function getDocumentTypes()
    {
        return $this->document_service->getDocumentTypes();
    }

}
