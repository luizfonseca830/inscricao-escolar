<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class ReprovarPessoa extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'reprovar_pessoas';
    protected $fillable = [
        'pessoa_id',
        'avaliador_id',
        'motivo',
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }

    public function avaliador(){
        return $this->belongsTo(User::class, 'avaliador_id', 'id');
    }
}
