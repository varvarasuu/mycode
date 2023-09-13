<?php

namespace App\Repositories\Api\Portfolio;
use App\Models\DocumentPortfolio;
class DocumentRepository implements DocumentRepositoryInterface
{
    public function create($data)
    {
        $document = DocumentPortfolio::create([
            "type_id" => $data["type_id"],
            'title' => $data["title"],
            'description' => $data["description"],
            'file_path_1' => $data["file_path"][0]["id"] ?? null,
            'file_path_2' => $data["file_path"][1]["id"]  ?? null,
            'file_path_3' => $data["file_path"][2]["id"]  ?? null,
            'account_id' => $data["account_id"],
        ]);
        return $document;

       
    }
    public function get($id)
    {
        $document = DocumentPortfolio::find($id);
        return $document;
    }
    public function update($data)
    {
        DocumentPortfolio::where('id', $data["document_id"])->update(
            [   "type_id" => $data["type_id"],
                'title' => $data["title"],
                'description' => $data["description"],
                'account_id' => $data["account_id"],
                'file_path_1' => $data["file_path"][0] ?? null,
                'file_path_2' => $data["file_path"][1] ?? null,
                'file_path_3' => $data["file_path"][2] ?? null,
            ]
        );

        return true;
    }

    public function updatePortfolio($document_id, $portfolio_id)
    {
        DocumentPortfolio::where('id', $document_id)->update(['portfolio_id' => $portfolio_id]);
        return true;
    }
    public function updatePortfolioToNull($portfolio_id)
    {
        DocumentPortfolio::where('portfolio_id', $portfolio_id)->update(['portfolio_id' => null]);
        return true;
    }
    public function getByPortfolio($portfolio_id)
    {
        $documents = DocumentPortfolio::where('portfolio_id', $portfolio_id)->get();
        return $documents;
    }
}