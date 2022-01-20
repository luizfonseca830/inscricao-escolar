<?php

namespace App\Http\Controllers\ListaCandidatos;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ListaController extends Controller
{
    //
    public function index (Collection $pessoas) {
        $cargos = Cargo::all();
        return view('pages.lista-candidatos.index', compact('pessoas', 'cargos'));
    }

    public function filtro(Request $request){
        $pessoas = Pessoa::where('cargo_id', $request->cargo_id)->where('nome_completo', 'like', "%".$request->nome_completo."%")->get();
        return $this->index($pessoas);
    }

    public function devolverAvaliacao($id){
        $pessoa = Pessoa::findOrFail($id);
        try {
            DB::beginTransaction();
            $pessoa->status = null;
            $pessoa->status_avaliado = null;
            $pessoa->status_revisado = null;
            $pessoa->update();
            DB::commit();
            return redirect()->back()->with(['type' => 'success', 'msg' => 'Candidato devolvido para tela de avaliação.']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'msg' => $exception->getMessage()]);
        }
    }
}
