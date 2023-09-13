<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class RightsRequest extends FormRequest
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
            'role_id' => ['required', 'integer'],
            'permissions' => ['required', 'array'],
            'position' => ['string', 'nullable'],
            'prof_level_id' => ['integer'],
            'extra_contacts' => ['string', 'nullable'],
        ];
    }
}
