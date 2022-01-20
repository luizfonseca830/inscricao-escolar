<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Pontuacao extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'pontuacoes';

    protected $fillable = [
        'id',
        'pessoa_id',
        'avaliador_id',
        'revisor_id',
        'pontuacao_total',
        'pontuacao_total_anexos',
        'pontuacao_total_publica',
        'pontuacao_total_privada'
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }

    public function avaliador(){
        return $this->belongsTo(User::class, 'avaliador_id', 'id');
    }

    public function revisor(){
        return $this->belongsTo(User::class, 'revisor_id', 'id');
    }
}
