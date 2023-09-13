<?php

namespace App\Services\Api\Portfolio\Interfaces;

interface PortfolioServiceInterface 
{
    public function make($request);
    public function update($request);
    public function delete($id);
    public function archive($id);
    public function unArchive($id);
    public function getList($archived);
    public function get($request);

    public function prepare_data($respose);
    public function prepare_data_id($response);
    public function prepare_data_list($archived);
    public function getCasesByPortfolio($portfolio_id);
    public function getDocumentsByPortfolio($portfolio_id);
    
}