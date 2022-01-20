<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncoesExtraController extends Controller
{
    //
    static function diasDatas($data_inicial, $data_final) {
        $diferenca = strtotime($data_final) - strtotime($data_inicial);
        $dias = floor($diferenca / (60 * 60 * 24));
        return $dias * 0.027;
    }
}
