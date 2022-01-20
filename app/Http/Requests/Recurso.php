<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Recurso extends FormRequest
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
            'CPF' => 'required|exists:pessoa,cpf',
            'editalDinamicoID' => 'required|exists:pessoa,edital_dinamico_id',
            'comentario' => 'required|max:500',
            'anexoRecurso' => 'mimes:pdf|max:5000',
        ];
    }

    public function messages()
    {
        return ([
            'CPF.required' => 'O campo CPF é obrigatório ser preenchido!',
            'comentario.required' => 'É necessário descrever o recurso!',
            'comentario.max' => 'Não é possível ultrapassar o limite  de caracteres!',
            'anexoRecurso.mimes' => 'Somente arquivo do tipo PDF é aceito!',
            'anexoRecurso.max' => 'O arquivo só pode ter no máximo 5MB.',
            'editalDinamicoID.exists' => 'O campo edital participado selecionado é inválido.',
        ]); // TODO: Change the autogenerated stub
    }
}
