<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Transparencia extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'transparencia';
    protected $fillable = [
        'id',
        'instrutor_id',
        'pessoa_id',
        'tela',
        'pontuacao_total',
        'pontuacao_total_anexos',
        'pontuacao_total_publica',
        'pontuacao_total_privada',
        'motivo'
    ];

    public function instrutor(){
        return $this->hasOne(User::class, 'id', 'instrutor_id');
    }

    public function pessoa(){
        return $this->hasOne(Pessoa::class, 'id', 'pessoa_id');
    }
}
