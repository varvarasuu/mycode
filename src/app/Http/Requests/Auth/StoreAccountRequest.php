<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreAccountRequest extends FormRequest
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
            'name' => ['max:50', 'regex:/^[\p{Cyrillic}a-zA-Z]+(?:[\s-][\p{Cyrillic}a-zA-Z]+)*$/u'],
            'lastname' => ['max:50', 'regex:/^[\p{Cyrillic}a-zA-Z]+(?:[\s-][\p{Cyrillic}a-zA-Z]+)*$/u'],
            'phone_number' => ['required', 'string', 'max:14'],
            'password' => [
                'required',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&!#$%&\'*+—\/=?^_`{|}~.])[A-Za-z\d@$!%*#?&!#$%&\'*+—\/=?^_`{|}~.]{8,}$/',
                'max:20'
            ],
            'email' => ['required', 'email'],
        ];
    }
}
