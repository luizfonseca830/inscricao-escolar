<?php

namespace App\Http\Controllers\BuscaCandidatos;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class BuscaCandidatosController extends Controller
{
    //
    public function index(){
        return view('pages.busca-candidatos.busca-candidato');
    }

    public function show(Request $request){
        $cpf = $request->cpf;
        $pessoa = Pessoa::where('cpf', $request->cpf)->first();
        if (!is_null($pessoa)) {
            return response()->json(['success'=> $pessoa]);
        }
        else {
            return response()->json(['error'=> 'Candidato não encontrado!']);
        }
    }
}
