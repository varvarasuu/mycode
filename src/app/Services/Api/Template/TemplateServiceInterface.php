<?php

namespace App\Services\Api\Template;

interface TemplateServiceInterface 
{
    public function getTempates();
    public function sortTemplates($templates);
    public function changeTemplate($request);
    public function prepare_data($request);

}