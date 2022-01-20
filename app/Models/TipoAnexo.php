<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class TipoAnexo extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'tipo_anexo';
    protected $fillable = [
        'tipo'
    ];

    public function pessoaEditalAnexosPessoa($pessoaID, $editalDinamicoID, $tipoAnexoID){
        return PessoaEditalAnexo::where('edital_dinamico_id', $editalDinamicoID)->where('tipo_anexo_id', $tipoAnexoID)->where('pessoa_id', $pessoaID)->get();
    }
}
