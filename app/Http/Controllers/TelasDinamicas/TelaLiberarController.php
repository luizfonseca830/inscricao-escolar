<?php

namespace App\Http\Controllers\TelasDinamicas;

use App\Http\Controllers\Controller;
use App\Models\TelasEdital;

class TelaLiberarController extends Controller
{
    //
    public function index(){
        return view('pages.telas-dinamicas.liberar-tela', [
           'telasEdital' => TelasEdital::paginate(15),
        ]);
    }
}
