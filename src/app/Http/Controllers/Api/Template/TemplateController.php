<?php

namespace App\Http\Controllers\Api\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HttpResponse;
use App\Http\Requests\Template\TemplateChangeRequest;
use App\Models\DefaultTemplate;
use App\Services\Api\Template\TemplateService;
/**
 * Controller for Templates
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\Template
 *
 * @group Template
 *
 * @authenticated
 */
class TemplateController extends Controller
{
    use HttpResponse;

    private TemplateService  $service;

    /**
     *
     * @bodyParam id reuired interger Example: 1
     * @bodyParam text required string Example: jdfijsdo
     *
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     *
     * @responseFile status=200 scenario="Данные обновлены" storage/responses/Template/template-success-change.json
     * @responseFile status=404 scenario="Шаблон не найден" storage/responses/Template/template-error-not-found.json
     */
    public function __construct(TemplateService $service)
    {
        $this->service = $service;
    }

    /**
     *
     * @bodyParam id reuired interger Example: 1
     * @bodyParam text required string Example: jdfijsdo
     *
     * @responseFile status=400 scenario="Вы не зашли в профиль компании" storage/responses/Company/employee/employee-error-company-login.json
     *
     * @responseFile status=200 scenario="Данные обновлены" storage/responses/Template/template-success-change.json
     * @responseFile status=404 scenario="Шаблон не найден" storage/responses/Template/template-error-not-found.json
     */
    public function changeTemplate(TemplateChangeRequest $request)
    {
        $response = $this->service->changeTemplate($request);
        if($response){
            return $this->success(["message" => "Шаблон обновлен"]);
        }

        return $this->error("Шаблон не сохранен");
    }

    /**
     * @responseFile status=200 scenario="Данные отправлены" storage/responses/Template/template-success-get.json
     */
    public function get()
    {
        return $this->success($this->service->getTempates());
    }
}
