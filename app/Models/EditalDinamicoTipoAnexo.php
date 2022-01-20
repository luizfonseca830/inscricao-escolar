<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class EditalDinamicoTipoAnexo extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'edital_dinamico_tipo_anexos';

    protected $fillable = [
        'edital_dinamico_id',
        'cargo_id',
        'tipo_anexo_id',
    ];

    public function tipoAnexo(){
        return $this->hasOne(TipoAnexo::class, 'id', 'tipo_anexo_id');
    }

    public function editalDinamico(){
        return $this->hasOne(EditalDinamico::class, 'id', 'edital_dinamico_id');
    }

    public function cargo(){
        return $this->hasOne(Cargo::class, 'id', 'cargo_id');
    }

    public function documentoDinamico(){
        return $this->hasOne(DocumentoDinamico::class, 'edital_dinamico_tipo_anexo_id', 'id');
    }

    public function progress($tipo_anexo_id, $edital_dinamico_id){
        return Progress::where('tipo_anexo_id', $tipo_anexo_id)->where('edital_dinamico_id', $edital_dinamico_id)->first();
    }
}
