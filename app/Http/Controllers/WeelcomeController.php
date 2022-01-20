<?php

namespace App\Http\Controllers;

use App\Models\Carrossel;
use App\Models\TelasEdital;
use Illuminate\Http\Request;

class WeelcomeController extends Controller
{
    //

    public function index(){
        $recurso = TelasEdital::where('nome_ou_anexo', 'Recurso')->first();
        $pdfs = TelasEdital::where('tipo_tela_id', 2)->get();
        $inscricoes = TelasEdital::where('tipo_tela_id', 3)->get();
        $protocolo = TelasEdital::where('nome_ou_anexo', 'Protocolo')->first();
        $carrossels = Carrossel::all();


        return view('welcome', compact('recurso', 'pdfs', 'inscricoes', 'carrossels', 'protocolo'));
    }
}
