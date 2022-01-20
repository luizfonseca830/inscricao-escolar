<?php

namespace App\Http\Controllers;

use App\Models\EditalDinamico;
use Illuminate\Http\Request;

class RevisaoTipoEdital extends Controller
{
    //
    public function index()
    {
        //
        $editalDinamicos = EditalDinamico::all();
        return view('pages.revisao-tipo-edital', compact('editalDinamicos'));
    }
}
