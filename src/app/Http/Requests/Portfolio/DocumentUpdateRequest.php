<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class DocumentUpdateRequest extends FormRequest
{
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
        $accountId = auth()->id();
        return [
            'document_type' => ['required', 'integer', Rule::exists('document_portfolio_types', 'id')],
            'document_title' => ['required', 'string', 'max:100'],
            'description' => ['string', 'nullable', 'max:600'],
            'confirmation' => ['required', 'accepted'],
            'file1' => 'mimes:png,jpg,jpeg,pdf,gif|max:10240',
            'file2' => 'mimes:png,jpg,jpeg,pdf,gif|max:10240',
            'file3' => 'mimes:png,jpg,jpeg,pdf,gif|max:10240',
            "document_id" => ['required', 'integer', Rule::exists('document_portfolios', 'id')->where("account_id", $accountId),],

        ];
    }
}
