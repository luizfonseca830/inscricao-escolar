<?php

namespace App\Http\Controllers;
ini_set('memory_limit', '-1');
use App\Http\Requests\Recurso;
use App\Models\Pessoa;
use App\Models\Progress;
use App\Models\RecursoModel;
use App\Models\TipoAnexoCargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaRestritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //lista avaliar
    public function index($editalID)
    {
        if (Auth::user()->tipo != 'Avaliador' && Auth::user()->tipo != 'Admin' && Auth::user()->tipo != 'Supervisor') {
            session()->put('error', 'Você não tem acesso a essa página!');
            return redirect()->route('home');
        }

        $pessoas = Pessoa::where('check_cadastro_anexo', 1)->where('edital_dinamico_id', $editalID)->get();

        return view('pages.visualizacao', compact('pessoas'));
    }

    //id avaliar
    public function index2($id){
        if (Auth::user()->tipo != 'Avaliador' && Auth::user()->tipo != 'Admin' && Auth::user()->tipo != 'Supervisor') {
            session()->put('error', 'Você não tem acesso a essa página!');
            return redirect()->route('home');
        }

        $pessoa =  Pessoa::findOrFail($id);
        $edital_dinamico_id = !is_null($pessoa->pessoaEditalAnexos->first()) ? $pessoa->pessoaEditalAnexos->first()->edital_dinamico_id : null;

        $registroController = neW RegistroController();

        $progress = $registroController->gerarProgress($edital_dinamico_id, $pessoa->cargo_id);
        $tipoAnexoCargo = TipoAnexoCargo::where('cargo_id', $pessoa->cargo_id)->get();
        $tipoAnexoCargo = $registroController->gerarTipoAnexoCargo($tipoAnexoCargo, $pessoa->cargo_id, $edital_dinamico_id);
        $progressQuantiadePorcento = 100 / ($tipoAnexoCargo->count() + 2);

        if ($pessoa->status == 1) {
            session()->put('error', 'Parece que alguém já avaliou essa pessoa!');
            return redirect()->route('/visualizacao');
        }
        return view('pages.avaliar', compact('pessoa', 'progress', 'progressQuantiadePorcento', 'tipoAnexoCargo'));
    }

    //lista revisao
    public function index3($editalID){
        if (Auth::user()->tipo != 'Revisor' && Auth::user()->tipo != 'Admin' && Auth::user()->tipo != 'Supervisor') {
            session()->put('error', 'Você não tem acesso a essa página!');
            return redirect()->route('home');
        }

        $pessoas = Pessoa::whereNull('status')->whereNotNull('status_avaliado')->where('edital_dinamico_id', $editalID)->get();

        return view('pages.revisao', compact('pessoas'));
    }

    //Aprovar
    public function aprovar($id){
        if (Auth::user()->tipo != 'Revisor' && Auth::user()->tipo != 'Admin') {
            session()->put('error', 'Você não tem acesso a essa página!');
            return redirect()->route('home');
        }

        $pessoa = Pessoa::findOrFail($id);
        return view('pages.revisao-unico', [
            'pessoa' => $pessoa
        ]);
    }

    //lista recurso
    public function index4($editalDinamicoID){
        if (Auth::user()->tipo != 'Recurso' && Auth::user()->tipo != 'Admin') {
            session()->put('error', 'Você não tem acesso a essa página!');
            return redirect()->route('home');
        }

        $recursos = RecursoModel::all();
        return view('pages.recurso', compact('recursos', 'editalDinamicoID'));
    }

    //mostra pessoa unica que pediu recurso
    public function recursoUnico($id){
        if (Auth::user()->tipo != 'Recurso' && Auth::user()->tipo != 'Admin' && Auth::user()->tipo != 'Supervisor') {
            session()->put('error', 'Você não tem acesso a essa página!');
            return redirect()->route('home');
        }


        $pessoa = Pessoa::findOrFail($id);
        $edital_dinamico_id = !is_null($pessoa->pessoaEditalAnexos->first()) ? $pessoa->pessoaEditalAnexos->first()->edital_dinamico_id : null;
        $progress = Progress::where('edital_dinamico_id', $edital_dinamico_id)->get();
        $tipoAnexoCargo = TipoAnexoCargo::where('cargo_id', $pessoa->cargo_id)->get();
        $progressQuantiadePorcento = 100 / ($tipoAnexoCargo->count() + 2);

        #VERIFICA SE O RECURSO JA FOI AVALIADO
        if (!is_null($pessoa->recurso->status)) {
            session()->put('error', 'Parece que alguém já revisou esse recurso!');
            return redirect()->route('/visualizacao-recurso');
        }

        return view('pages.recurso-unico', compact('pessoa', 'progress', 'progressQuantiadePorcento', 'tipoAnexoCargo'));

    }
}
