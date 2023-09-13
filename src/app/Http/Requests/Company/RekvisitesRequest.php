<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class RekvisitesRequest extends FormRequest
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
                'company_rekvisites' => 'array|nullable',
                'company_rekvisites.*' => 'file|mimes:pdf,docx,jpeg,svg,png,xlsx,zip,txt|max:30000'
        ];
    }
}
