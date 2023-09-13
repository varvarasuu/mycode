<?php

namespace App\Http\Requests\Template;

use App\Services\Api\Account\AccountService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class TemplateChangeRequest extends FormRequest
{

    private $accountService;
    public function __construct()
    {
        parent::__construct();
        // $this->accountService = $accountService;

    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "id" => [
                'required',
                'integer',
                // Rule::exists('templates', 'id')->where("company_id", $this->accountService->getLoggedAs()),
            ],
            "text" => "required|string"
        ];
    }

    public function messages(): array
    {
        return [
            "id.required" => "id обязательно для заполения.",
            "id.integer" => "id должно быть integer.",
            "id.exists" => "Шаблон не найден",
            "text.required" => "text  обязательно для заполения.",
            "text.string" => "text должно быть string.",
        ];
    }
}
