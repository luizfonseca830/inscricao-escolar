<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComprovanteRequest;
use App\Models\Comprovante;
use App\Models\Pessoa;
use App\Models\Title;
use Illuminate\Http\Request;
use PDF;
class ComprovanteController extends Controller
{
    //
    //
    static public function store($comprovate){
        $comprovante_id = Comprovante::create([
            'comprovante' => $comprovate,
        ])->id;

        return $comprovante_id;
    }

    static public function gerarComprovante($pessoa){
        $comprovante = Title::all()->first()->titulo . time() . $pessoa->id;
        return $comprovante;
    }

    public function index($comprovante){
        return view('registro.registro_comprovate')->with('comprovante', $comprovante);
    }

    public function protocolo(){
        return view('registro.protocolo-pedir');
    }

    public function procurar(ComprovanteRequest $request){
        $pessoa = Pessoa::where('cpf', $request->cpf)->first();
        if (is_null($pessoa)) {
            session()->put('error', 'Ops parecer que não possuimos esse registro');
            return redirect()->route('protocolo');
        }

        $comprovante = Comprovante::findOrFail($pessoa->comprovante_id);
        session()->put('sucess', $comprovante->comprovante);
        return redirect()->route('protocolo');
    }

    public function gerarComprovanteCpf($comprovante){
        $comprovante = Comprovante::where('comprovante', $comprovante)->first();
        $pdf = PDF::loadView('pdf', ['comprovante' => $comprovante]);
        return $pdf->setPaper('a4')->stream('file_pdf.pdf');;
    }
}
