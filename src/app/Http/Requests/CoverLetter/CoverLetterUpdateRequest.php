<?php

namespace App\Http\Requests\CoverLetter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\CoverLetter;
class CoverLetterUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'title' => ['required', 'string', 'max:50'],
            'content' => ['string', 'max:1000'],
            'cover_letter_id' => ['required', 'integer',  Rule::exists('cover_letters', 'id')
            ->where('account_id', $accountId)->where("deleted", 0),],
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

            'cover_letter_id.required' => 'cover letter ID обязательно для заполнения.',
            'cover_letter_id.integer' => 'cover letter ID должно быть integer.',
            'cover_letter_id.exists' => 'Выбранный cover letter ID не найден.',
        ];
    }

}
