<?php

namespace App\Http\Controllers\Api\CoverLetter;

use Illuminate\Http\Request;
use App\Traits\HttpResponse;
use App\Http\Requests\CoverLetter\CoverLetterRequest;
use App\Http\Requests\CoverLetter\CoverLetterUpdateRequest;
use App\Http\Requests\CoverLetter\CoverLetterIdRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\CoverLetter\ArrayCoverLetterRequest;

use App\Services\Api\CoverLetter\Services\CoverLetterService;
/**
 * Controller for CoverLetters
 *
 * @category Controller
 *
 * @package App\Http\Controllers\Api\CoverLetter
 *
 * @group CoverLetter
 *
 * @authenticated
 */
class CoverLetterController extends Controller
{
    use HttpResponse;

    private CoverLetterService $service;

    public function __construct(CoverLetterService $service)
    {
        $this->service = $service;
    }
    /**
     * @subgroup Create
     *
     * @bodyParam title required string Данное поле обязательно. Максимум 50 символов. Example: Официальное
     * @bodyParam content string Данное поле не обязательно. Максимум 1000 символов. Example: Я очень хороший работник
     *
     * @responseFile status=201 scenario="Сопроводительное письмо создано" storage/responses/CoverLetter/cover-success-create.json
     * @responseFile status=500 scenario="Сопроводительное письмо не создано, ошибка сервера" storage/responses/CoverLetter/cover-error-create.json
     *
     */
    public function createCoverLetter(CoverLetterRequest $request)
    {
        $request->validated($request->all());
        $response = $this->service->create($request);

        if(empty($response)) {
            return $this->error('Сопроводительное письмо не создано');
        } else {
            return $this->success($response, 'success', 201);
        }

    }
    /**
     * @subgroup Get
     *
     * @urlParam id integer
     *
     * @responseFile status=404 scenario="Сопроводительное с указанным id не найден" storage/responses/CoverLetter/cover-error-id.json
     * @responseFile status=200 scenario="Сопроводительное найдено" storage/responses/CoverLetter/cover-success-get-id.json
     *
     */
    public function getCoverLetter(CoverLetterIdRequest $request)
    {
        $urlParamValue = $request->validated();
        return $this->success(
            $this->service->get($urlParamValue)
        );
    }

    /**
     * @subgroup Update-delete
     *
     * @bodyParam cover_letter_id required integer Данное поле обязательно. Example: 12
     * @bodyParam title required string Данное поле обязательно. Максимум 50 символов. Example: Официальное
     * @bodyParam content string Данное поле не обязательно. Максимум 1000 символов. Example: Я очень хороший работник
     *
     *
     * @responseFile status=200 scenario="Сопроводительное письмо обновлено" storage/responses/CoverLetter/cover-success-update.json
     * @responseFile status=400 scenario="Сопроводительное письмо было удалено" storage/responses/CoverLetter/cover-error-update-deleted.json
     * @responseFile status=404 scenario="Сопроводительное письмо не найдено для данного пользователя" storage/responses/CoverLetter/cover-error-update.json
     *
     */
    public function updateCoverLetter(CoverLetterUpdateRequest $request)
    {
        $request->validated($request->all());

        $response = $this->service->update($request);

        return $this->success($response);
    }
    /**
     * @subgroup Update-delete
     *
     * @urlParam id integer
     *
     * @responseFile status=404 scenario="Сопроводительное письмо не найдено для данного пользователя" storage/responses/CoverLetter/cover-error-update.json
     * @responseFile status=400 scenario="Сопроводительное письмо уже было удалено" storage/responses/CoverLetter/cover-error-deleted.json
     * @responseFile status=200 scenario="Сопроводительное письмо удалено" storage/responses/CoverLetter/cover-success-deleted.json
     *
     */
    public function deleteCoverLetter(CoverLetterIdRequest $request)
    {
        $urlParamValue = $request->validated();
        return $this->success(
            $this->service->delete($urlParamValue)
        );
    }

    /**
     * @subgroup Update-delete
     *
     * @urlParam id integer
     *
     * @responseFile status=404 scenario="Сопроводительное письмо не найдено для данного пользователя" storage/responses/CoverLetter/cover-error-update.json
     * @responseFile status=400 scenario="Сопроводительное письмо уже было удалено" storage/responses/CoverLetter/cover-error-deleted.json
     * @responseFile status=200 scenario="Сопроводительные письма удалены" storage/responses/CoverLetter/cover-success-deleted.json
     *
     */
    public function massDeleteCoverLetter(ArrayCoverLetterRequest $request)
    {
        $this->service->massDelete($request);
        return $this->success(["message" => "Сопроводительные письма удалены"]);
    }
    /**
     * @subgroup Get
     *
     * @responseFile status=200 scenario="Сопроводительные письма отправлены" storage/responses/CoverLetter/cover-success-get-list.json
     */
    public function getCoverletterList()
    {
        return $this->success(
            $this->service->index()
        );
    }
}
