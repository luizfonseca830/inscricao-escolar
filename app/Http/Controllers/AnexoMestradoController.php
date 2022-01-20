<?php

namespace App\Http\Controllers;

use App\Models\AnexoMestrado;
use Illuminate\Http\Request;

class AnexoMestradoController extends Controller
{
    //
    public function store($mestrado, $id)
    {
        if ($mestrado != null) {
            for ($i = 0; $i < 2; $i++) {
                if (!is_null($mestrado['instituicao'][$i])) {
                    AnexoMestrado::create([
                        'anexo_id' => $id,
                        'descricacao' => $mestrado['descricao'][$i],
                        'nome_instituicacao' => $mestrado['instituicao'][$i],
                        'carga_horaria' => $mestrado['carga_horario'][$i],
                        'anexo' => $mestrado['anexo_mestrado'][$i],
                    ]);
                }
            }
        }
        return null;
    }

    public function anexoNome(Request $request)
    {
        $anexoNome = [];
        if (isset($request->file('mestrado')['anexo_mestrado'])) {
            $anexos = $request->file('mestrado')['anexo_mestrado'];
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
                $anexo->storeAs('public/anexos/mestrado', $fileNameToStore);
                //SALVANDO NOME DO ARRAY
                array_push($anexoNome, $fileNameToStore);
            }

            //Clona O ARRAY EXP QUE VEIO NA REQUEST
            $mestrado = $request->all()['mestrado'];
            //INDEX PARA CONTROLAR O ANEXO NOME (POSICAO)
            $j = 0;
            //ALGORITMO PARA ORGANAZINAR O NOME DO ANEXO DA POSICAO ANTIGO ONDE ESTAVA O ANEXO
            for ($i = 0; $i < 6; $i++) {
                if (isset($mestrado['anexo_mestrado'][$i])) {
                    $mestrado['anexo_mestrado'][$i] = $anexoNome[$j];
                    $j++;
                } else {
                    $mestrado['anexo_mestrado'][$i] = null;
                }
            }
            return $mestrado;
        }

        return null;
    }

}
