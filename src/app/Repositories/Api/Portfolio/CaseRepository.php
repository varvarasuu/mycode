<?php

namespace App\Repositories\Api\Portfolio;

use App\Models\CasePortfolio;
class CaseRepository implements CaseRepositoryInterface
{
    public function create($data)
    {
        $new_case = CasePortfolio::create(
            [
                'title' => $data["title"],
                'description' => $data["description"],
                'file_path_1' => $data["file_path"][0]["id"] ?? null,
                'file_path_2' => $data["file_path"][1]["id"]  ?? null,
                'file_path_3' => $data["file_path"][2]["id"]  ?? null,
                'account_id' => $data["account_id"],
            ]
        );

        return $new_case;
    }

    public function get($id)
    {
        $case = CasePortfolio::find($id);
        return $case;
    }

    public function update($data)
    {
        CasePortfolio::where('id', $data["case_id"])->update(
            [
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

    public function updatePortfolio($case_id, $portfolio_id)
    {
        CasePortfolio::where('id', $case_id)->update(['portfolio_id' => $portfolio_id]);
        return true;
    }
    public function updatePortfolioToNull($portfolio_id)
    {
        CasePortfolio::where('portfolio_id', $portfolio_id)->update(['portfolio_id' => null]);
        return true;
    }
    public function getByPortfolio($portfolio_id)
    {
        $cases = CasePortfolio::where('portfolio_id', $portfolio_id)->get();
        return $cases;
    }
}