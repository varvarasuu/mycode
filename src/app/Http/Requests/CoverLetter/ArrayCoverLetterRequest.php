<?php

namespace App\Http\Requests\CoverLetter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ArrayCoverLetterRequest extends FormRequest
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
            'cover_letter_ids' => 'required|array',
            'cover_letter_ids.*' => [
                'integer',
                Rule::exists('cover_letters', 'id')
            ->where('account_id', $accountId)->where("deleted", 0),
            ],
        ];
    }

    public function messages()
    {
        return [
            'cover_letter_ids.required' => 'Необходимо указать cover_letter_ids.',
            'cover_letter_ids.array' => 'cover_letter_ids должно быть массивом.',
            'cover_letter_ids.*.integer' => 'Каждый cover letter ID должен быть integer.',
            'cover_letter_ids.*.exists' => 'Выбранный cover letter ID не найден.',
        ];
    }
}
