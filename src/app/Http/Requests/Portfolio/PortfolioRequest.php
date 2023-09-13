<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PortfolioRequest extends FormRequest
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
        return [
            'occupation' => ['required', 'string', 'max:70'],
            'about' => ['string', 'nullable', 'max:150'],
            'link' => ['string', 'nullable'],
            'case_ids.*' => ['integer', 'nullable', Rule::exists('case_portfolios', 'id')->where("account_id", auth()->id())],
            'document_ids.*' => ['integer', 'nullable', Rule::exists('document_portfolios', 'id')->where("account_id", auth()->id())],
        ];
    }
}
