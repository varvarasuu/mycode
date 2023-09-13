<?php

namespace App\Http\Controllers\Api\Portfolio;

use App\Traits\HttpResponse;
use App\Http\Requests\Portfolio\CaseRequest;
use App\Http\Requests\Portfolio\CaseUpdateRequest;
use App\Http\Requests\Portfolio\CaseIdRequest;
use App\Http\Requests\Portfolio\DocumentRequest;
use App\Http\Requests\Portfolio\DocumentUpdateRequest;
use App\Http\Requests\Portfolio\DocumentIdRequest;
use App\Http\Requests\Portfolio\PortfolioUpdateRequest;
use App\Http\Requests\Portfolio\PortfolioRequest;
use App\Http\Requests\Portfolio\PortfolioDeleteRequest;
use App\Http\Requests\Portfolio\PortfolioIdRequest;
use App\Services\Api\Portfolio\Services\PortfolioService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\PortfolioArchiveRequest;
use App\Http\Requests\Portfolio\PortfolioUnarchiveRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
/**
 * Controller for Portfolios
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\Portfolio
 *
 * @group Portfolio
 *
 * @authenticated
 */
class PortfolioController extends Controller {
    use HttpResponse;

    private PortfolioService $service;

    public function __construct(PortfolioService $service)
    {

        $this->service = $service;
    }

    /**
     *
     * @subgroup PortfolioOnly
     *
     * @bodyParam occupation required string max:70 Это поле является обязательным. Должно быть не более 70 символов. Example: Project Manager
     * @bodyParam about string Это поле не обязательно. Должно быть не более 150 символов. Example: I managed a lot of projects
     * @bodyParam link string это поле не обязательно. Должно быть не более 255 символов. Example: myportfolio.com
     * @bodyParam case_ids [] Это поле не обязательно. должно являться массивом и чисел. Example: [123, 14, 25]
     * @bodyParam document_ids [] Это поле не обязательно. должно являться массивом и чисел. Example: [123, 14, 25]
     *
     * @responseFile status=201 scenario="Успешное создание портфолио" storage/responses/Portfolio/PortfolioOnly/portfolio-success.json
     * @responseFile status=404 scenario="Кейс с указанным id не найден для данного пользователя" storage/responses/Portfolio/PortfolioOnly/portfolio-error-case.json
     * @responseFile status=404 scenario="Документ с указанным id не найден для данного пользователя" storage/responses/Portfolio/PortfolioOnly/portfolio-error-document.json
     *
     */
    public function makePortfolio(PortfolioRequest $request) {
        $request->validated($request->all());
        $response = $this->service->make($request);
        return $this->success($response,  'success', 201);
    }

    /**
     * @subgroup PortfolioOnly
     *
     * @bodyParam portfolio_id required integer Это поле является обязательным. Example: 32
     * @bodyParam occupation required string max:70 Это поле является обязательным. Должно быть не более 70 символов. Example: Project Manager
     * @bodyParam about string Это поле не обязательно. Должно быть не более 150 символов. Example: I managed a lot of projects
     * @bodyParam link string это поле не обязательно. Должно быть не более 255 символов. Example: myportfolio.com
     * @bodyParam case_ids [] Это поле не обязательно. должно являться массивом и чисел. Example: [123, 14, 25]
     * @bodyParam document_ids [] Это поле не обязательно. должно являться массивом и чисел. Example: [123, 14, 25]
     *
     * @responseFile status=200 scenario="Успешное обновление портфолио" storage/responses/Portfolio/PortfolioOnly/portfolio-update-success.json
     * @responseFile status=404 scenario="Кейс с указанным id не найден для данного пользователя" storage/responses/Portfolio/PortfolioOnly/portfolio-error-case.json
     * @responseFile status=404 scenario="Документ с указанным id не найден для данного пользователя" storage/responses/Portfolio/PortfolioOnly/portfolio-error-document.json
     * @responseFile status=404 scenario="Портфолио с указанным id не найден для данного пользователя" storage/responses/Portfolio/PortfolioOnly/portfolio-error-id.json
     * @responseFile status=400 scenario="Портфолио было удалено" storage/responses/Portfolio/PortfolioOnly/portfolio-error-deleted.json
     *
     */
    public function updatePortfolio(PortfolioUpdateRequest $request) {
        
        $request->validated($request->all());
        $response =  $this->service->update($request);
        if($response){
            return $this->success(["message" => "Портфолио обновлено"]);
        }

        return $this->error("Не удалось обновить портфолио. Поробуйте позже.");
    }
    /**
     * @subgroup PortfolioOnly
     *
     * @urlParam id integer required integer Example: 32
     *
     * @responseFile status=404 scenario="Портфолио с указанным id не найден для данного пользователя" storage/responses/Portfolio/PortfolioOnly/portfolio-error-id.json
     * @responseFile status=200 scenario="Портфолио удалено" storage/responses/Portfolio/PortfolioOnly/portfolio-success-deleted.json
     * @responseFile status=400 scenario="Портфолио уже удалено" storage/responses/Portfolio/PortfolioOnly/portfolio-error-deleted-already.json
     */
    public function deletePortfolio(PortfolioDeleteRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->delete($data);
        if($response){
            return $this->success(["message" => "Портфолио удалено"]);
        }

        return $this->error("Не удалось удалить портфолио");
    }
    /**
     * @subgroup PortfolioOnly
     *
     * @urlParam id integer required  Example: 32
     *
     * @responseFile status=404 scenario="Портфолио с указанным id не найден для данного пользователя" storage/responses/Portfolio/PortfolioOnly/portfolio-error-id.json
     * @responseFile status=200 scenario="Портфолио заархивировано" storage/responses/Portfolio/PortfolioOnly/portfolio-success-archive.json
     * @responseFile status=400 scenario="Портфолио уже заархивировано" storage/responses/Portfolio/PortfolioOnly/portfolio-error-archived.json
     * @responseFile status=400 scenario="действие недоступно" storage/responses/Portfolio/PortfolioOnly/portfolio-error-status.json
     */
    public function archivePortfolio(PortfolioArchiveRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->archive($data);
        if($response){
            return $this->success(["message" => "Портфолио перемещено в архив."]);
        }
        return $this->error("Не удалось архировать портфолио. Убедитесь, что оно в статусе 'активно'.");

    }
    /**
     * @subgroup PortfolioOnly
     *
     * @urlParam id required integer Example: 32
     *
     * @responseFile status=404 scenario="Портфолио с указанным id не найден для данного пользователя" storage/responses/Portfolio/PortfolioOnly/portfolio-error-id.json
     * @responseFile status=200 scenario="Портфолио вытащено из архива" storage/responses/Portfolio/PortfolioOnly/portfolio-success-unarchived.json
     * @responseFile status=400 scenario="Портфолио уже вне архива" storage/responses/Portfolio/PortfolioOnly/portfolio-error-unarchived.json
     * @responseFile status=400 scenario="действие недоступно" storage/responses/Portfolio/PortfolioOnly/portfolio-error-status.json
     */
    public function unArchivePortfolio(PortfolioUnarchiveRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->unArchive($data);
        if($response){
            return $this->success(["message" => "Портфолио перенесено в основную папку."]);
        }
        return $this->error("Не удалось достать портфолио из архива.");

    }
    /**
     * @subgroup PortfolioOnly
     *
     * @responseFile status=200 scenario="Портфолио список найденных портфолио" storage/responses/Portfolio/PortfolioOnly/portfolio-success-get-id.json
     */
    public function getPortfoliosList($archived = 0)
    {
        return $this->success($this->service->getList($archived));
    }
    /**
     * @subgroup PortfolioOnly
     *
     * @urlParam id integer
     *
     * @responseFile status=404 scenario="Портфолио с указанным id не найден для данного пользователя" storage/responses/Portfolio/PortfolioOnly/portfolio-error-id.json
     * @responseFile status=200 scenario="Портфолио найдено" storage/responses/Portfolio/PortfolioOnly/portfolio-success-get-id.json
     *
     */
    public function getPortfolio(PortfolioDeleteRequest $request) {
        return $this->success($this->service->get($request));
    }

     /**
     * @subgroup Case
     * 
     * 
     * @bodyParam case_title required Это поле является обязательным. Должно быть не более 100 символов. Example: Project Manager
     * @bodyParam description  Это поле не обязательно. Должно быть не более 600 символов. Example: I managed a lot of projects
     * @bodyParam confirmation boolean 1 0 Это поле обязательно. Example: 1
     * 
     *  
     * 
     * @responseFile status=201 scenario="Кейс создан" storage/responses/Portfolio/Document/document-success-create.json
     * 
     * 
     */
    public function createCase(CaseRequest $request)
    {
        $request->validated($request->all());
        $response = $this->service->createCase($request);
        if(empty($response)){
            return $this->error("Внутренняя ошибка сервера. Кейс не создан. Поробуйте снова.");
        }
        return $this->success(['case_id' => $response], 'success', 201);
    }
    /**
     * @subgroup Case
     * 
     * @bodyParam case_id required Example: 5
     * @bodyParam case_title required Это поле является обязательным. Должно быть не более 100 символов. Example: Project Manager
     * @bodyParam description  Это поле не обязательно. Должно быть не более 600 символов. Example: I managed a lot of projects
     * @bodyParam confirmation boolean 1 0 Это поле обязательно. Example: 1
     * 
     *  
     * 
     * @responseFile status=201 scenario="Кейс обновлен" storage/responses/Portfolio/Document/document-success-create.json
     * 
     * 
     */
    public function updateCase(CaseUpdateRequest $request)
    {
        $request->validated($request->all());
        $response = $this->service->updateCase($request);
        if($response){
            return $this->success(['message' => 'Кейс успешно обновлен']);
        }

        return $this->error("Не удалось обновить кейс");
    }
    public function getCase(CaseIdRequest $request)
    {
        $data = $request->validated();
        return $this->service->getCase($data);
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
     * 
     * @responseFile status=201 scenario="Документ создан" storage/responses/Portfolio/Document/document-success-create.json
     * 
     * 
     */
    public function createDocument(DocumentRequest $request)
    {
        $request->validated($request->all());
        $response = $this->service->createDocument($request);
        return $this->success(['document_id' => $response], 'success', 201);
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
     * 
     * @responseFile status=200 scenario="Документ обновлен" storage/responses/Portfolio/Document/document-success-update.json
     * 
     *
     */
    public function updateDocument(DocumentUpdateRequest $request)
    {
        
        $request->validated($request->all());
        $response = $this->service->updateDocument($request);
        if($response){
            return $this->success(['message' => 'Документ успешно обновлен']);
        }

        return $this->error("Не удалось обновить документ");
    }
    /**
     * @subgroup Document
     * 
     * @urlParam id integer
     * 
     * @responseFile status=200 scenario="Документ найден" storage/responses/Portfolio/Document/document-success-get.json
     */
    public function getDocument(DocumentIdRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->getDocument($data);
        return $this->success($response);
    }
/**
     * @subgroup Document
     * 
     * @responseFile status=200 scenario="Типы документов отданы" storage/responses/Portfolio/Document/document-success-type.json
     */
    public function getDocumentTypes()
    {
       $response = $this->service->getDocumentTypes();
       return $this->success($response);
    }
}
