<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required_without:phone_number', 'email'],
            'password' => ['required', 'string', 'min:6'],
            'phone_number' => ['required_without:email', 'max:14'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required_without' => 'Пожалуйста, укажите электронную почту или номер телефона.',
            'email.email' => 'Пожалуйста, укажите действительный адрес электронной почты.',
            'password.required' => 'Пожалуйста, укажите пароль.',
            'password.min' => 'Пароль должен содержать не менее :min символов.',
            'phone_number.required_without' => 'Пожалуйста, укажите электронную почту или номер телефона.',
            'phone_number.max' => 'Номер телефона не может быть длиннее :max символов.',
        ];
    }
}
