<?php

namespace App\Http\Controllers;

use App\Models\TipoAnexo;
use Illuminate\Http\Request;

class TipoAnexoController extends Controller
{
    //
    public function destroy($id)
    {
        $tipoAnexo = TipoAnexo::findOrFail($id);
        $id = $tipoAnexo->cargo->id;
        if ($tipoAnexo->delete()) {
            session()->put('sucess', 'Removido com sucesso.');
        }

        return redirect()->route('formulario.show', $id);
    }

    public function store(Request $request)
    {
        try {
            if ($this->searchExist(mb_strtoupper($request->inputTitulo))) {
                $tipoAnexo = new TipoAnexo();
                $tipoAnexo->tipo = mb_strtoupper($request->inputTitulo);

                $tipoAnexo->save();
                return redirect()->route('edital.formulario.anexo', $request->editalDinamicoID)->with(['type' => 'success', 'msg' => 'Título criado com sucesso']);
            }
            return redirect()->route('edital.formulario.anexo',$request->editalDinamicoID)->with(['type'=> 'error', 'msg' => 'Esse título já existe.']);
        } catch (\Exception $exception) {
            return redirect()->route('edital.formulario.anexo',$request->editalDinamicoID)->with(['type' => 'error', 'msg' => $exception->getMessage()]);
        }

    }

    public function searchExist($titulo)
    {
        $tipoAnexo = TipoAnexo::where('tipo', $titulo)->first();
        if (is_null($tipoAnexo)) return true;
        return false;
    }
}
