<?php

namespace App\Http\Controllers;

use App\Models\AnexoDoutorado;
use Illuminate\Http\Request;

class AnexoDoutoradoController extends Controller
{
    //
    public function store($doutorado, $id)
    {
        if ($doutorado != null) {
            for ($i = 0; $i < 1; $i++) {
                if (!is_null($doutorado['instituicao'][$i])) {
                    AnexoDoutorado::create([
                        'anexo_id' => $id,
                        'descricacao' => $doutorado['descricao'][$i],
                        'nome_instituicacao' => $doutorado['instituicao'][$i],
                        'carga_horaria' => $doutorado['carga_horario'][$i],
                        'anexo' => $doutorado['anexo_doutorado'][$i],
                    ]);
                }
            }
            return true;
        }
        return false;
    }

    public function anexoNome(Request $request)
    {
        $anexoNome = [];
        if (isset($request->file('doutorado')['anexo_doutorado'])) {
            $anexos = $request->file('doutorado')['anexo_doutorado'];
        } else {
            $anexos = null;
        }
        if ($anexos != null) {
            foreach ($anexos as $anexo) {
                #NOME E EXTENSAO DO ARQUIVO
                $filenameWithExt = $anexo->getClientOriginalName();
                #SOMENTE O NOME DO ARQUIVO
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                #SOMENTE A EXTENSAO
                $extension = $anexo->getClientOriginalExtension();
                #Nome do Arquivo Final
                $fileNameToStore = bcrypt($filename . '_' . time()) . '.' . $extension;

                //SALVANDO NO DIRETORIO
                $anexo->storeAs('public/anexos/doutorado', $fileNameToStore);
                //SALVANDO NOME DO ARRAY
                array_push($anexoNome, $fileNameToStore);
            }

            //Clona O ARRAY EXP QUE VEIO NA REQUEST
            $doutorado = $request->all()['doutorado'];
            //INDEX PARA CONTROLAR O ANEXO NOME (POSICAO)
            $j = 0;
            //ALGORITMO PARA ORGANAZINAR O NOME DO ANEXO DA POSICAO ANTIGO ONDE ESTAVA O ANEXO
            for ($i = 0; $i < 6; $i++) {
                if (isset($doutorado['anexo_doutorado'][$i])) {
                    $doutorado['anexo_doutorado'][$i] = $anexoNome[$j];
                    $j++;
                } else {
                    $doutorado['anexo_doutorado'][$i] = null;
                }
            }
            return $doutorado;
        }
        return null;
    }
}
