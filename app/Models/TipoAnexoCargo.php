<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class TipoAnexoCargo extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'tipo_anexo_cargos';
    protected $fillable = [
        'tipo_anexo_id',
        'cargo_id'
    ];

    public function tipoAnexo(){
        return $this->belongsTo(TipoAnexo::class, 'tipo_anexo_id', 'id');
    }

    public function editalDinamicoTipoAnexoCargo($editalDinamicoID, $tipoAnexoID, $cargoID){
        return EditalDinamicoTipoAnexo::where('tipo_anexo_id', $tipoAnexoID)->where('edital_dinamico_id', $editalDinamicoID)->where('cargo_id', $cargoID)->get();
    }

    public function pessoaEditalAnexos($pessoa_id, $edital_dinamico_id, $tipo_anexo_id){
        return PessoaEditalAnexo::where('pessoa_id', $pessoa_id)->where('edital_dinamico_id', $edital_dinamico_id)->where('tipo_anexo_id', $tipo_anexo_id)->get();
    }
}
