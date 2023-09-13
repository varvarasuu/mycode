<?php

namespace App\Repositories\Api\Template;

interface TemplateRepositoryInterface
{
    public function getByCompany($company_id);
    public function change($id);
}