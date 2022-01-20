<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroAnexos extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'anexosDocumentos.*' => 'max:2|nullable',
        ];
    }

//    public function messages()
//    {
//        return ([
//            'anexosDocumentos' => 'Este campo só aceitar arquivos do tipo pdf.',
//            'anexosDocumentos.*.max' => 'Este campo não poder ter anexo maior que 5MB.',
//        ]);
//    }
}
