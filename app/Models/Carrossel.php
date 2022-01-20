<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrossel extends Model {

    protected $table = 'carrossel';
    protected $fillable = [
        'url_img',
        'url_link',
    ];
}
