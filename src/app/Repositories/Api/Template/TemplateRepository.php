<?php

namespace App\Repositories\Api\Template;
use App\Models\Template;
class TemplateRepository implements TemplateRepositoryInterface
{
    public function getByCompany($company_id)
    {
        $templates = Template::where("company_id", $company_id)->get();
        return $templates;
    }

    public function change($data)
    {
        $template = Template::find($data["id"]);
        $template->text = htmlspecialchars($data["text"]);
        $template->save();

        return true;
    }
}