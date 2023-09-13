<?php

namespace App\Http\Requests\CoverLetter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CoverLetterIdRequest extends FormRequest
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
            'id' => [
                'required',
                'integer',
                Rule::exists('cover_letters', 'id')
            ->where('account_id', $accountId)->where("deleted", 0),
            ],
        ];
    }

    public function all($keys = null)
    {
        
        $data = parent::all();
        $data['id'] = $this->route('id');
       
        return $data;
        
    }

    public function messages()
    {
        return [
            'id.required' => 'id необходимо для заполнения.',
            'id.integer' => 'id должно быть integer.',
            'id.exists' => 'Выбранный id не найден.',
        ];
    }
}
