<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Escolaridade extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'escolaridade';
    protected $fillable = [
        'id',
        'nivel_escolaridade',
    ];

    public function escolaridadeEditalDinamico($idEdital, $idEscolaridade)
    {
        $escolaridadeEditalDinamico = EscolaridadeEditalDinamico::where('edital_dinamico_id', $idEdital)->where('escolaridade_id', $idEscolaridade)->first();
        return $escolaridadeEditalDinamico;
    }

    public function cargos(){
        return $this->hasMany(Cargo::class, 'escolaridade_id', 'id');
    }
}
