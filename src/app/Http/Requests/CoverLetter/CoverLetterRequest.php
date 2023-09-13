<?php

namespace App\Http\Requests\CoverLetter;

use Illuminate\Foundation\Http\FormRequest;

class CoverLetterRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:50'],
            'content' => ['string', 'max:1000'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'title обязанельно для заполнения.',
            'title.string' => 'title должно быть string.',
            'title.max' => 'title не должно быть больше 50 знаков.',
            
            'content.string' => 'content должен быть string.',
            'content.max' => 'content не должно быть больше 1000 знаков.',
        ];
    }
}
