<?php

namespace App\Http\Controllers\TelasDinamicas;

use App\Http\Controllers\Controller;
use App\Models\TipoTelas;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class TelaCriarController extends Controller
{
    //
    public function index()
    {
        $directory = public_path();
        $telas = TipoTelas::all();

        $files = \File::allFiles($directory);
        return view('pages.telas-dinamicas.criar-tela-anexo', [
            'arquivos' => $files,
            'telas' => $telas,
        ]);
    }
}
