<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoneRequest extends FormRequest
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
            'name' => ['required', 'max:50', 'regex:/^[\p{Cyrillic}a-zA-Z]+(?:[\s-][\p{Cyrillic}a-zA-Z]+)*$/u'],
            'lastname' => ['required', 'max:50', 'regex:/^[\p{Cyrillic}a-zA-Z]+(?:[\s-][\p{Cyrillic}a-zA-Z]+)*$/u'],
            'phone_number' => ['required', 'string', 'max:14'],
        ];
    }
}
