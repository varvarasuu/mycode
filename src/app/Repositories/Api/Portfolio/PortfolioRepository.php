<?php

namespace App\Repositories\Api\Portfolio;

use App\Models\Portfolio;

class PortfolioRepository implements PortfolioRepositoryInterface
{
    public function create($data)
    {
        $new_portfolio = Portfolio::create(
            [
                'name' => $data["occupation"],
                'about' => $data["about"],
                'link' => $data["link"],
                'account_id' => $data["account_id"],
            ]
        );

        return $new_portfolio;
    }

    public function update($data)
    {
        Portfolio::where('id', $data['portfolio_id'])->update(
            [
                'name' => $data["occupation"],
                'about' => $data["about"],
                'link' => $data["link"],
                'status' => 'moderation',
            ]
        );

        return true;
    }

    public function delete($id)
    {
        Portfolio::where('id', $id)->update(
            [
                'deleted' => 1,
                'archived' => 0,
            ]
        );

        return true;
    }

    public function archive($id)
    {
        $portfolio = Portfolio::find($id);

        if ($portfolio->status != 'active') {
            return false;
        }
        $portfolio->archived = 1;
        $portfolio->save();
        return true;
    }

    public function unArchive($id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio->archived = 0;
        $portfolio->save();
        return true;
    }

    public function get($id)
    {
        $portfolio =  Portfolio::find($id);
        return $portfolio;
    }

    public function getList($data)
    {
        $portfolios = Portfolio::where('account_id', $data["account_id"])
            ->where('deleted', 0)
            ->where('archived', $data["archived"])
            ->orderBy('updated_at', 'desc')
            ->get();

        return $portfolios;
    }
}
