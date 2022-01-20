<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class DocumentoDinamico extends Model implements Auditable
{

    use AuditableTrait;
    protected $table = 'documento_dinamicos';

    protected $fillable = [
        'edital_dinamico_tipo_anexo_id',
        'nome_documento',
        'pontuacao_maxima_documento',
        'pontuacao_maxima_item',
        'pontuacao_por_item',
        'quantidade_anexos',
        'obrigatorio',
        'pontuacao_por_ano',
        'pontuacao_por_mes',
        'tipo_experiencia',
        'pontuar_publica_privada',
        'pontuar_manual',
        'especial',
    ];

    public function editalDinamicoTipoAnexo()
    {
        return $this->belongsTo(EditalDinamicoTipoAnexo::class, 'edital_dinamico_tipo_anexo_id', 'id');
    }
}
