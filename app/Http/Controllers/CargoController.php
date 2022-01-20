<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\EscolaridadeEditalDinamico;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        dd($request->all());
        $escolaridadeEditalDinamico = EscolaridadeEditalDinamico::findOrFail($request->escolaridadeEditalDinamicoID);
        $idEdital = $escolaridadeEditalDinamico->edital_dinamico_id;
        $escolaridade_id = $escolaridadeEditalDinamico->escolaridade_id;

        $cargo = Cargo::create([
            'escolaridade_id' => $escolaridadeEditalDinamico->escolaridade_id,
            'cargo' => $request->inputCargo,
            'escolaridade_edital_dinamico_id' => $escolaridadeEditalDinamico->id
        ]);
        if (!is_null($cargo)) session('sucess', 'Cargo criado com sucesso.');
        else session()->put('error', 'Não possível criar o cargo.');

        return redirect()->route('escolaridade.edital.cargo', [$idEdital, $escolaridade_id]);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);
        $escolaridadeEditalDinamico = $cargo->escolaridadeEditalDinamico;
        return view('pages.lista-inscricoes.escolaridades.cargos.edita',
            compact('cargo', 'escolaridadeEditalDinamico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cargo = Cargo::findOrFail($request->cargo_id);
        $cargo->cargo = $request->inputCargo;

        if (!$cargo->update()) {
            return redirect()->back()->withErrors(['error' => 'Ops, não foi possível alterar o nome do cargo.']);
        }
        return redirect()->back()->with(['sucess' => 'Cargo alterado com sucesso.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $cargo = Cargo::findOrFail($id);
            $cargo->delete();
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->withException($ex->getMessage());
        }
    }
}
