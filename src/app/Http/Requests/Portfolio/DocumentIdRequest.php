<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class DocumentIdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {

        return [
            'id' => [
                'required',
                'integer',
                Rule::exists('document_portfolios', 'id'),
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
