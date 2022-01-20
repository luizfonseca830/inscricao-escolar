<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Progress extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'progress';
    protected $fillable = [
        'tipo_anexo_id',
        'edital_dinamico_id'
    ];
    public function tipoAnexo(){
        return $this->belongsTo(TipoAnexo::class, 'tipo_anexo_id', 'id');
    }
    public function editalDinamico(){
        return $this->belongsTo(EditalDinamico::class, 'edital_dinamico_id', 'id');
    }

    public function editalDinamicoTipoAnexo($editalDinamicoID, $tipoAnexoID){
        return EditalDinamicoTipoAnexo::where('tipo_anexo_id', $tipoAnexoID)->where('edital_dinamico_id', $editalDinamicoID)->get();
    }

    public function editalDinamicoTipoAnexoCargo($editalDinamicoID, $tipoAnexoID, $cargoID){
        return EditalDinamicoTipoAnexo::where('tipo_anexo_id', $tipoAnexoID)->where('edital_dinamico_id', $editalDinamicoID)->where('cargo_id', $cargoID)->get();
    }
}

