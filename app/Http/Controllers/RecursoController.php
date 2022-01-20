<?php

namespace App\Http\Controllers;

use App\Http\Requests\Recurso;
use App\Models\EditalDinamico;
use App\Models\Pessoa;
use App\Models\Pontuacao;
use App\Models\PontuacaoDoutorado;
use App\Models\PontuacaoEspecializacao;
use App\Models\PontuacaoExperiencia;
use App\Models\PontuacaoMestrado;
use App\Models\PontuacaoTecnico;
use App\Models\RecursoModel;
use App\Models\Transparencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecursoController extends Controller
{
    //
    public function index(){
        $editaisDinamicos = EditalDinamico::all();
        return view('recurso.recurso', compact('editaisDinamicos'));
    }

    public function pedirRecurso(Recurso $request)
    {
        $pessoa = Pessoa::where('cpf', $request->CPF)->where('edital_dinamico_id', $request->editalDinamicoID)->first();
        if (isset($pessoa->recurso) ) {
            session()->put('error', 'Ops, você não pode solicitar novamente um recurso!');
            return redirect()->route('recurso');
        }

        $nameFile = null;
        if (isset($request->anexoRecurso)){

            $documento = $request->anexoRecurso;
            $name = uniqid(date('HisYmd'));
            $extesion = $documento->extension();

            //Define o nome do arquivo
            $nameFile = "{$name}.{$extesion}";
            //Faz Upload
            $nameFile = $documento->store('recurso');
        }

        //CADASTRA O RECURSO
        RecursoModel::create([
            'pessoa_id' => $pessoa->id,
            'recurso' => $request->comentario,
            'url_anexo' => $nameFile
        ]);

        session()->put('sucess', 'O recurso foi enviado com sucesso!');
        return redirect()->route('recurso');

    }

    public function recusarmotivo($id)
    {
        $recurso = RecursoModel::findOrFail($id);

        if (!is_null($recurso->status)) {
            session()->put('error', 'Ops, Parece que alguém acabou de analisar esse recurso!');
            return redirect()->route('/visualizacao-recurso');
        }

        return view('pages.recurso-unico-recusar', [
           'recurso' => $recurso,
        ]);


    }
    public function recusar(Request $request){
       $recurso = RecursoModel::findOrFail($request->recurso_id);

       if (!is_null($recurso->status)) {
           session()->put('error', 'Ops, Parece que alguém acabou de analisar esse recurso!');
           return redirect()->route('/visualizacao-recurso');
       }
       $recurso->update([
           'avaliador_id' => auth()->id(),
           'data_avaliado' => date('Y-m-d'),
           'status' => 0,
           'recusar_motivo' => $request->motivo_recusar,
       ]);

        //SALVA NO LOG DE TRANSPARECIAN O QUE O AVALIADOR FEZ
        Transparencia::create([
            'instrutor_id' => auth()->id(),
            'pessoa_id' => $recurso->pessoa->id,
            'tela' => 'Recurso',
            'motivo' => $request->motivo_recusar,
        ]);

        session()->put('sucess', 'O Recurso foi verificado com sucesso!');
        return redirect()->route('/visualizacao-recurso');
    }

    public function aceitar(Request $request)
    {

        $pessoa = Pessoa::findOrFail($request->pessoa_id);
        $recurso = RecursoModel::findOrFail($pessoa->recurso->id);

        //VARIAVEL PARA PONTUACAO TOTAL
        $pontuacao_total = 0;

        if (!is_null($recurso->status)) {
            session()->put('error', 'Ops, Parece que alguém acabou de analisar esse recurso!');
            return redirect()->route('/visualizacao-recurso');
        }

        session()->put('sucess', 'O Recurso foi verificado com sucesso! Pontuação Total: ' . $pontuacao_total);
        return redirect()->route('/visualizacao-recurso');

    }


}
