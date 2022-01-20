<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class RecursoModel extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'recurso';
    protected $fillable = [
        'id',
        'pessoa_id',
        'avaliador_id',
        'status',
        'data_avaliado',
        'recurso',
        'recusar_motivo',
        'url_anexo',
        'pontuacao',
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class, 'pessoa_id', 'id');
    }
}
