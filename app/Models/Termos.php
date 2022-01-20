<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Termos extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'termos';
    protected $fillable = [
        'id',
        'pessoa_id',
        'aceito_dados'
    ];

    public function pessoa(){
        return $this->hasOne(Pessoa::class, 'id', 'pessoa_id');
    }
}
