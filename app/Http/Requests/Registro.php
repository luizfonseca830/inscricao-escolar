<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Registro extends FormRequest
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
            'endereco' => 'required|string|max:200',
            'bairro' => 'required|string|max:200',
            'cep' => 'required|formato_cep',
            'nome_completo' => 'required|string|min:10|max:150',
            'cpf' => 'required|cpf|formato_cpf',
            'rg' => 'required|digits_between:5,14|alpha_num',
            'pis' => 'nullable|alpha_num|digits:11',
            'telefone' => 'required|celular_com_ddd',
            'nacionalidade' => 'required|string|max:50',
            'naturalidade' => 'required|string|max:50',
            'email' => 'required|string|max:150|confirmed',
            'data_nascimento' => 'required|date',
            'numero' => 'required|numeric|digits_between:1,5|min:0',
            'orgao_emissor' => 'required|string|max:50',
            'escolaridade' => 'required|exists:escolaridade,id',
            'CARGO' => 'exists:cargos,id',
        ];
    }

    public function messages()
    {
        return ([
            'nome_completo.required' => 'O campo nome é obrigatório.',
            'endereco.required' => 'O campo endereço é obrigatório. ',
            'cep.formato_cep' => 'O campo cep não possui um formato válido de CEP. Ex (99999-999 ou 99.999-999)',
            'numero.required' => 'O campo número é obrigatório',
            'numero.numeric' => 'Só é aceito números.',
            'escolaridade.exists' => 'Você deve selecionar um nível de escolaridade',
            'CARGO.exists' => 'Você deve selecionar um cargo',
            'rg.digits_between' => 'O campo RG só aceita números, com quantidade mínima de 5 dígitos até 14 dígitos, favor remover os trasos se tiver.',
            'rg.alpha_num' => 'O campo RG só aceita números',
            'pis.alpha_num' => 'O campo PIS só aceita números',
            'pis.digits' => 'O campo PIS só aceita números, com quantidade mínima de 11 dígitos',
            'email.required' => 'O campo email é obrigatório',
            'email.confirmed' => 'Favor digitar o mesmo email para confirmação'
        ]);
    }
}
