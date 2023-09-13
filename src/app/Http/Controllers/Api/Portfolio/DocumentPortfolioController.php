<?php

namespace App\Http\Controllers\Api\Portfolio;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use App\Http\Requests\Portfolio\DocumentRequest;
use App\Services\Api\Portfolio\Services\DocumentPortfolioService;


/**
 * Controller for Documents
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\Portfolio
 *
 * @group Portfolio
 *
 * @authenticated
 */
class DocumentPortfolioController extends Controller
{
    use HttpResponse;

    private DocumentPortfolioService $service;

    public function __construct(DocumentPortfolioService $service)
    {

        $this->service = $service;
    }
    /**
     * @subgroup Document
     * 
     * @bodyParam document_type required integer это поле обязательно. Example: 1
     * @bodyParam document_title required Это поле является обязательным. Должно быть не более 100 символов. Example: Project Manager
     * @bodyParam description  Это поле не обязательно. Должно быть не более 600 символов. Example: I managed a lot of projects
     * @bodyParam confirmation boolean 1 0 Это поле обязательно. Example: 1
     * 
     *  
     * @responseFile status=500 scenario="Подтверждение не равно 1 документ не сохранен" storage/responses/Portfolio/Case/case-error-confirmation.json
     * @responseFile status=201 scenario="Документ создан" storage/responses/Portfolio/Document/document-success-create.json
     * @responseFile status=404 scenario="Тип документа не найден" storage/responses/Portfolio/Document/document-error-type.json
     * 
     */
    public function createDocument(DocumentRequest $request) {

        $request->validated($request->all());
        return $this->service->create($request);

    }
    /**
     * @subgroup Document
     * 
     * @responseFile status=200 scenario="Типы документов отданы" storage/responses/Portfolio/Document/document-success-type.json
     */
    public function getDocumentTypes()
    {
        return $this->service->getDocumentTypes();
    }
    /**
     * @subgroup Document
     * 
     * @bodyParam document_id required integer Это поле обязательно. Example: 18
     * @bodyParam document_type required integer это поле обязательно. Example: 1
     * @bodyParam document_title required Это поле является обязательным. Должно быть не более 100 символов. Example: Project Manager
     * @bodyParam description  Это поле не обязательно. Должно быть не более 600 символов. Example: I managed a lot of projects
     * @bodyParam confirmation boolean 1 0 Это поле обязательно. Example: 1
     * 
     *  
     * @responseFile status=500 scenario="Подтверждение не равно 1 документ не сохранен" storage/responses/Portfolio/Case/case-error-confirmation.json
     * @responseFile status=200 scenario="Документ обновлен" storage/responses/Portfolio/Document/document-success-update.json
     * @responseFile status=404 scenario="Тип документа не найден" storage/responses/Portfolio/Document/document-error-type.json
     * @responseFile status=404 scenario="Документ с указанным id не найден для данного пользователя" storage/responses/Portfolio/PortfolioOnly/portfolio-error-document.json
     */
    public function updateDocument(DocumentRequest $request) {
        if (!$request->document_id) {
            return $this->error('Submit document_id', 'error', 422);
        }

        $request->validated($request->all());
        return $this->service->update($request);
    }
    /**
     * @subgroup Document
     * 
     * @urlParam id integer
     * 
     * @responseFile status=200 scenario="Документ найден" storage/responses/Portfolio/Document/document-success-get.json
     */
    public function getDocument($id)
    {
        return $this->service->get($id);
    }
}
