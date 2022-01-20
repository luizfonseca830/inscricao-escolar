<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Title extends Model implements Auditable
{
    //
    use AuditableTrait;
    protected $table = 'titulo';
    protected $fillable = [
        'titulo'
    ];
}
