<?php

namespace App\Http\Controllers;

use App\Models\DocumentoDinamico;
use App\Models\EditalDinamicoTipoAnexo;
use App\Models\Progress;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class
DocumentoDinamicoController extends Controller
{
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $documentoDinamico = DocumentoDinamico::findOrFail($id);
            $editalDinamicoTipoAnexo = EditalDinamicoTipoAnexo::findOrFail($documentoDinamico->edital_dinamico_tipo_anexo_id);
            $progress = Progress::where('tipo_anexo_id', $editalDinamicoTipoAnexo->tipo_anexo_id)->first();
            $documentoDinamico->delete();
            $editalDinamicoTipoAnexo->delete();
            $progress->delete();
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->withException($ex->getMessage());
        }

    }
}
