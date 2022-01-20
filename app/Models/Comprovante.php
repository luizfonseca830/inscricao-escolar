<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Comprovante extends Model implements Auditable
{
    //
    //
    use AuditableTrait;
    protected $table = 'comprovante';
    protected $fillable = [
        'id',
        'comprovante',
    ];

    public function pessoa(){
        return $this->hasOne(Pessoa::class, 'comprovante_id', 'id');
    }
}
