<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\EditalDinamico;
use App\Models\Escolaridade;
use App\Models\EscolaridadeEditalDinamico;
use Illuminate\Http\Request;

class EscolaridadeEditalDinamicoController extends Controller
{
    //
    public function aceito($idEdital, $idEscolaridade)
    {
        $editalDinamico = EditalDinamico::findOrFail($idEdital);
        $escolaridade = Escolaridade::findOrFail($idEscolaridade);
        $escolaridadeEditalDinamico = new EscolaridadeEditalDinamico();

        if (!is_null($escolaridade->escolaridadeEditalDinamico($editalDinamico->id, $escolaridade->id))) {
            session()->put('error', 'Essa escolaridade já está ativa no edital.');
            return redirect()->route('escolaridade.lista.index', $editalDinamico->telas_edital_id);
        }

        $escolaridadeEditalDinamico->edital_dinamico_id = $idEdital;
        $escolaridadeEditalDinamico->escolaridade_id = $idEscolaridade;

        if ($escolaridadeEditalDinamico->save()) {
            session()->put('sucess', 'O nível de escolaridade ' . $escolaridade->nivel_escolaridade . ' foi ativado para esse edital.');
        } else session()->put('error', 'Não foi possível ativar essa escolaridade, entre em contato com o suporte.');

        return redirect()->route('escolaridade.lista.index', $editalDinamico->telas_edital_id);
    }

    public function remover($idEdital, $idEscolaridade)
    {
        $editalDinamico = EditalDinamico::findOrFail($idEdital);
        $escolaridade = Escolaridade::findOrFail($idEscolaridade);
        $escolaridadeEditalDinamico = EscolaridadeEditalDinamico::where('edital_dinamico_id', $idEdital)->where('escolaridade_id', $idEscolaridade)->first();
        if (is_null($escolaridadeEditalDinamico)) {
            session()->put('error', 'Não é possível desativar, pois essa escolaridade não está ativa no edital.');
            return redirect()->route('escolaridade.lista.index', $editalDinamico->telas_edital_id);
        }
//        dd($escolaridadeEditalDinamico);
        if ($escolaridadeEditalDinamico->delete()) {
            session()->put('sucess', 'O nível de escolaridade ' . $escolaridade->nivel_escolaridade . ' foi desativado para esse edital.');
        } else session()->put('error', 'Não foi possível desativar esse nível de escolaridade para o edital.');

        return redirect()->route('escolaridade.lista.index', $editalDinamico->telas_edital_id);
    }

    public function escolaridadeEditalCargo($idEdital, $idEscolaridade)
    {
        $escolaridadeEditalDinamico = EscolaridadeEditalDinamico::where('edital_dinamico_id', $idEdital)->where('escolaridade_id', $idEscolaridade)->first();
        if (!is_null($escolaridadeEditalDinamico)) {
            $cargos = Cargo::where('escolaridade_id', $idEscolaridade)->where('escolaridade_edital_dinamico_id', $escolaridadeEditalDinamico->id)->get();
        } else $cargos = [];
        return view('pages.lista-inscricoes.escolaridades.cargos.list', compact('escolaridadeEditalDinamico', 'cargos'));
    }
}
