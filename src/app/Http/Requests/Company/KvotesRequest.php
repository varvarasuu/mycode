<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class KvotesRequest extends FormRequest
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
            'employee_id' => ['required', 'integer'],
            'max_vacancies_direct_response' => ['required', 'regex:/^(?:\d+|null)$/'],
            'max_anon_vacancies' => ['required', 'regex:/^(?:\d+|null)$/'],
            'max_standard_vacancies' => ['required', 'regex:/^(?:\d+|null)$/'],
            'max_hot_vacancies' => ['required', 'regex:/^(?:\d+|null)$/'],
            'max_premium_vacancies' => ['required', 'regex:/^(?:\d+|null)$/'],
            
        ];
    }
}
