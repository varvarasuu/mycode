<?php

namespace App\Services\Api\Template;

use App\Traits\HttpResponse;
use App\Models\DefaultTemplate;
use App\Models\Account;
use App\Models\Company;
use App\Models\Template;
use App\Repositories\Api\Template\TemplateRepository;
use App\Services\Api\Account\AccountService;

class TemplateService implements TemplateServiceInterface
{
    use HttpResponse;

    private $accountService;
    private $repository;
 
    public function __construct(AccountService $accountService, TemplateRepository $repository)
    {
        $this->accountService = $accountService;
        $this->repository = $repository;
    }

    public function getTempates()
    {
        $company_id = $this->accountService->getLoggedAs();
        $templates = $this->repository->getByCompany($company_id);
        $templates = $this->sortTemplates($templates);
        return $templates;
    }

    public function sortTemplates($templates)
    {
        $sortedArray = [];
        foreach ($templates as $item) {
            $category = $item["category"];
            $id = $item["id"];
            $name = $item["name"];
            $text = $item["text"];
    
            if (!isset($sortedArray[$category])) {
                $sortedArray[$category] = [
                    "category" => $category,
                    "template" => [],
                ];
            }
    
             $sortedArray[$category]["template"][] = [
                "id" => $id,
                "name" => $name,
                "text" => $text,
                "default" => $text,
                
            ];
            }

        return $sortedArray;
    }
    public function changeTemplate($request)
    {
        $data = $this->prepare_data($request);
        $template = $this->repository->change($data);

        return $this->success(["message" => "Шаблон обновлен"]);
    }

    public function prepare_data($request)
    {
        return [
            "id" => $request->id,
            "text" => htmlspecialchars($request->text),
        ];
    }
}