<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;

class CaseRequest extends FormRequest
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
            'case_title' => ['required', 'string', 'max:100'],
            'description' => ['string', 'nullable', 'max:2000'],
            'confirmation' => ['required', 'accepted'],
            'file1' => [
                'sometimes',
                'required',
                'mimes:png,jpg,jpeg,gif,pdf,mp4',
                function ($attribute, $value, $fail) {
                    $allowedFileSize = ($value->getMimeType() === 'video/mp4') ? 50 * 1024 : 10 * 1024;
                    if ($value->getSize()/1024 > $allowedFileSize) {
                        $fail('Файл с данным расширением не может превышать размер'.$allowedFileSize.' килобайт.');
                    }
                },
            ],
            'file2' => [
                'sometimes',
                'required',
                'mimes:png,jpg,jpeg,gif,pdf,mp4',
                function ($attribute, $value, $fail) {
                    $allowedFileSize = ($value->getMimeType() === 'video/mp4') ? 50 * 1024 : 10 * 1024;
                    if ($value->getSize()/1024 > $allowedFileSize) {
                        $fail('Файл с данным расширением не может превышать размер'.$allowedFileSize.' килобайт.');
                    }
                },
            ],
            'file3' => [
                'sometimes',
                'required',
                'mimes:png,jpg,jpeg,gif,pdf,mp4',
                function ($attribute, $value, $fail) {
                    $allowedFileSize = ($value->getMimeType() === 'video/mp4') ? 50 * 1024 : 10 * 1024;
                    if ($value->getSize()/1024 > $allowedFileSize) {
                        $fail('Файл с данным расширением не может превышать размер'.$allowedFileSize.' килобайт.');
                    }
                },
            ],      
        ];
    }

    public function messages()
    {
        return [
            'case_title.required' => 'Название обязательно для заполнения.',
            'case_title.string' => 'Название должно быть string.',
            'case_title.max' => 'Название не должно быть больше чем 100 знаков.',

            'description.string' => 'Текст должно быть string.',
            'description.max' => 'Текст не должен быть больше чем 2000 знаков.',

            'confirmation.required' => 'Для сохранения разрешите обработку персональных данных.',
            'confirmation.accepted' => 'Для сохранения разрешите обработку персональных данных.',
         
            'file1.mimes' => 'Недопустимое расширение файла.',
            'file2.mimes' => 'Недопустимое расширение файла.',
            'file3.mimes' => 'Недопустимое расширение файла.',
        ];
    }

}
