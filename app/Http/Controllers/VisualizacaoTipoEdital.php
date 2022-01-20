<?php

namespace App\Http\Controllers;

use App\Models\EditalDinamico;
use Illuminate\Http\Request;

class VisualizacaoTipoEdital extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $editalDinamicos = EditalDinamico::all();
        return view('pages.visualizacao-tipo-edital', compact('editalDinamicos'));
    }

}
