<?php

namespace App\Http\Controllers;

use App\Models\EditalDinamico;
use App\Models\Escolaridade;
use Illuminate\Http\Request;

class EscolaridadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $editalDinamico = EditalDinamico::where('telas_edital_id', $id)->first();
        $escolaridades = Escolaridade::all();
        return view('pages.lista-inscricoes.escolaridades.list', compact('escolaridades', 'editalDinamico'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        dd($request->all());
        $escolaridade = new Escolaridade();
        $editalDinamico = EditalDinamico::findOrFail($request->editalDinamicoID);
        $escolaridade->nivel_escolaridade = $request->inputEscolaridade;

        if($escolaridade->save()){
            session()->put('sucess', 'Nível de Escolaridade criado com sucesso.');
        } else session()->put('error', 'Não foi possível cadastrar essa escolaridade.');
        return redirect()->route('escolaridade.lista.index', $editalDinamico->telas_edital_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
