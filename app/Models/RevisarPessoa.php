<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class RevisarPessoa extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'revisar_pessoas';
    protected $fillable = [
        'pessoa_id',
        'revisor_id',
        'motivo',
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }

    public function revisor(){
        return $this->belongsTo(User::class, 'revisor_id', 'id');
    }
}
