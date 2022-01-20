<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RelatorioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
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
            'cargoID' => 'nullable|exists:cargos,id',
            'escolaridadeID' => 'nullable|exists:escolaridade,id',
            'status' => 'nullable',
            'tipo' => 'required',
            'titulo' => 'nullable|string|max:60'
        ];
    }
}
