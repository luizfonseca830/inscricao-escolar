<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class TipoInscricao extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'tipo_inscricao';
    protected $fillable = [
        'inscricao'
    ];
}
