<?php

namespace App\Http\Controllers\TelasDinamicas;

use App\Http\Controllers\Controller;
use App\Http\Requests\TituloRequest;
use App\Models\Title;
use Illuminate\Http\Request;

class TituloController extends Controller
{
    public function index(){
        $title = Title::all()->first();
        return view('pages.telas-dinamicas.alterar-titulo', [
            'title' => $title,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TituloRequest $request, $id)
    {
        //
        $titulo = Title::findOrFail($id)->update([
            'titulo' => $request->titulo,
        ]);

        if (!$titulo){
            session()->put('error', 'Ops, algo de errado aconteceu!');
        }
        else {
            session()->put('sucess', 'Título alterado com sucesso!');
        }
        return redirect()->route('titulo.index');
    }

}
