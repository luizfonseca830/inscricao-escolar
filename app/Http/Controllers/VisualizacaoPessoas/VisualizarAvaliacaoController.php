<?php

namespace App\Http\Controllers\VisualizacaoPessoas;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class VisualizarAvaliacaoController extends Controller
{
    public function show($id)
    {
        $pessoa = Pessoa::findOrFail($id);

        return view('pages.visualizacao-pessoas.visualizar-pessoa-avaliar', [
            'pessoa' => $pessoa,
        ]);
    }
}
