<?php

namespace App\Http\Controllers;

use App\Models\AnexoEspecializacao;
use Illuminate\Http\Request;

class AnexoEspecializacaoController extends Controller
{
    //
    public function store($esp, $id)
    {
        if ($esp != null) {
            for ($i = 0; $i < 3; $i++) {
                if (!is_null($esp['instituicao'][$i])) {
                    AnexoEspecializacao::create([
                        'anexo_id' => $id,
                        'descricacao' => $esp['descricao'][$i],
                        'nome_instituicacao' => $esp['instituicao'][$i],
                        'carga_horaria' => $esp['carga_horario'][$i],
                        'anexo' => $esp['anexo_esp'][$i],
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
        if (isset($request->file('esp')['anexo_esp'])) {
            $anexos = $request->file('esp')['anexo_esp'];
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
                $anexo->storeAs('public/anexos/especializacao', $fileNameToStore);
                //SALVANDO NOME DO ARRAY
                array_push($anexoNome, $fileNameToStore);
            }

            //Clona O ARRAY EXP QUE VEIO NA REQUEST
            $especializacao = $request->all()['esp'];
            //INDEX PARA CONTROLAR O ANEXO NOME (POSICAO)
            $j = 0;
            //ALGORITMO PARA ORGANAZINAR O NOME DO ANEXO DA POSICAO ANTIGO ONDE ESTAVA O ANEXO
            for ($i = 0; $i < 6; $i++) {
                if (isset($especializacao['anexo_esp'][$i])) {
                    $especializacao['anexo_esp'][$i] = $anexoNome[$j];
                    $j++;
                } else {
                    $especializacao['anexo_esp'][$i] = null;
                }
            }
            return $especializacao;
        }
        return null;
    }

}
