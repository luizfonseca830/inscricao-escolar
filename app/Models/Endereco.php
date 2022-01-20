<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Endereco extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'endereco';
    protected $fillable = [
        'id',
        'endereco',
        'bairro',
        'cep',
    ];
}
