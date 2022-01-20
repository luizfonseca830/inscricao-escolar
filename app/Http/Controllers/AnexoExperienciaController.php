<?php

namespace App\Http\Controllers;

use App\Models\AnexoExperiencia;
use Illuminate\Http\Request;

class AnexoExperienciaController extends Controller
{
    //
    public function store($experiencia, $id)
    {
        if ($experiencia != null) {
            for ($i = 0; $i < 5; $i++) {
                if (!is_null($experiencia['cargo'][$i])) {
                    AnexoExperiencia::create([
                        'anexo_id' => $id,
                        'cargo' => $experiencia['cargo'][$i],
                        'empregador' => $experiencia['empregador'][$i],
                        'nome_supervisor' => $experiencia['nome_contato'][$i],
                        'data_entrada' => $experiencia['data_entrada'][$i],
                        'data_saida' => $experiencia['data_saida'][$i],
                        'atribuicoes' => $experiencia['atribuicoes'][$i],
                        'anexo' => $experiencia['anexo_exp'][$i]
                    ]);
                }
            }
        }
        return true;
    }

    public function anexoNome(Request $request)
    {
        $anexoNome = [];
        if (isset($request->file('expe')['anexo_exp'])) {
            $anexos = $request->file('expe')['anexo_exp'];
        } else {
            $anexos = null;
        }
        if (!is_null($anexos)) {
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
                $anexo->storeAs('public/anexos/experiencia', $fileNameToStore);
                //SALVANDO NOME DO ARRAY
                array_push($anexoNome, $fileNameToStore);
            }

            //Clona O ARRAY EXP QUE VEIO NA REQUEST
            $experiencia = $request->all()['expe'];
            //INDEX PARA CONTROLAR O ANEXO NOME (POSICAO)
            $j = 0;
            //ALGORITMO PARA ORGANAZINAR O NOME DO ANEXO DA POSICAO ANTIGO ONDE ESTAVA O ANEXO
            for ($i = 0; $i < 6; $i++) {
                if (isset($experiencia['anexo_exp'][$i])) {
                    $experiencia['anexo_exp'][$i] = $anexoNome[$j];
                    $j++;
                } else {
                    $experiencia['anexo_exp'][$i] = null;
                }
            }
            return $experiencia;
        }

        return null;
    }
}
