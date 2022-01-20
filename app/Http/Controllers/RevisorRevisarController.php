<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Progress;
use App\Models\RevisarPessoa;
use App\Models\TipoAnexoCargo;
use App\Models\Transparencia;
use Illuminate\Http\Request;

class RevisorRevisarController extends Controller
{
    //
    public function index($id){
        $pessoa = Pessoa::findOrFail($id);
        $edital_dinamico_id = !is_null($pessoa->pessoaEditalAnexos->first()) ? $pessoa->pessoaEditalAnexos->first()->edital_dinamico_id : null;
        $progress = Progress::where('edital_dinamico_id', $edital_dinamico_id)->get();
        $tipoAnexoCargo = TipoAnexoCargo::where('cargo_id', $pessoa->cargo_id)->get();
        $progressQuantiadePorcento = 100 / ($tipoAnexoCargo->count() + 2);

        return view('pages.revisao-unico', compact('pessoa', 'progressQuantiadePorcento', 'progress', 'tipoAnexoCargo'));
    }

    public function reavaliar(Request $request){
        $pessoa = Pessoa::findOrFail($request->pessoa_id);

        $pessoa->update([
            'status_revisado' => 0,
        ]);

        $revisarPessoa = new RevisarPessoa();

        $revisarPessoa->pessoa_id = $pessoa->id;
        $revisarPessoa->revisor_id = auth()->user()->id;
        $revisarPessoa->motivo = $request->motivo_reav;

        if($revisarPessoa->save()){
            session()->put('sucess', 'Pessoa enviada para reavaliação.');
        } else session()->put('error', 'Não foi possível enviar essa pessoa para reavaliação, contate o surpote.');
        return redirect()->route('revisao', $pessoa->edital_dinamico_id);
    }

    public function aceitarAvaliar(Request $request){

        $pessoa = Pessoa::findOrFail($request->pessoa_id);

        $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);

        $pessoa->update([
            'status_revisado' => $pessoa->status_avaliado,
            'status' => $pessoa->status_avaliado,
        ]);

        $transparencia = Transparencia::create([
            'instrutor_id' => auth()->id(),
            'pessoa_id' => $pessoa->id,
            'tela' => $url,
            'pontuacao_total' => $pessoa->pontuacao($pessoa->id)->pontuacao_total,
            'pontuacao_total_publica' => $pessoa->pontuacao($pessoa->id)->pontuacao_total_publica,
            'pontuacao_total_privada' => $pessoa->pontuacao($pessoa->id)->pontuacao_total_privada,
            'pontuacao_total_anexos' => $pessoa->pontuacao($pessoa->id)->pontuacao_total_anexos,
        ]);

        if (!is_null($transparencia)) {
            session()->put('sucess', 'Revisão realizada com sucesso.');
        }
        else session()->put('sucess', 'Não foi possível realizar essa avaliação.');
        return redirect()->route('revisao', $pessoa->edital_dinamico_id);
    }
}
