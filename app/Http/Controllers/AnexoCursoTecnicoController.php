<?php

namespace App\Http\Controllers;

use App\Models\AnexoCursoTecnico;
use Illuminate\Http\Request;

class AnexoCursoTecnicoController extends Controller
{
    //
    public function store($tecnico, $id)
    {

        if ($tecnico != null) {
            for ($i = 0; $i < 6; $i++) {
                if (!is_null($tecnico['instituicao'][$i])) {
                    AnexoCursoTecnico::create([
                        'anexo_id' => $id,
                        'descricacao' => $tecnico['descricoes'][$i],
                        'nome_instituicacao' => $tecnico['instituicao'][$i],
                        'carga_horaria' => $tecnico['carga_horario'][$i],
                        'anexo' => $tecnico['anexo_tecnico'][$i],
                    ]);
                }
            }
            return true;
        }
        //CASO NAO POSSUA NENHUM TECNICO
        return false;
    }

    public function anexoNome(Request $request)
    {
        $anexoNome = [];
        if (isset($request->file('tecnico')['anexo_tecnico'])) {
            $anexos = $request->file('tecnico')['anexo_tecnico'];
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
                $anexo->storeAs('public/anexos/tecnico', $fileNameToStore);
                //SALVANDO NOME DO ARRAY
                array_push($anexoNome, $fileNameToStore);
            }

            //INDEX PARA CONTROLAR O ANEXO NOME (POSICAO)
            $j = 0;
            //ALGORITMO PARA ORGANAZINAR O NOME DO ANEXO DA POSICAO ANTIGO ONDE ESTAVA O ANEXO
            for ($i = 0; $i < 6; $i++) {
                if (isset($tecnico['anexo_tecnico'][$i])) {
                    $tecnico['anexo_tecnico'][$i] = $anexoNome[$j];
                    $j++;
                }
            }

            //Clona O ARRAY EXP QUE VEIO NA REQUEST
            $tecnico = $request->all()['tecnico'];
            //INDEX PARA CONTROLAR O ANEXO NOME (POSICAO)
            $j = 0;
            //ALGORITMO PARA ORGANAZINAR O NOME DO ANEXO DA POSICAO ANTIGO ONDE ESTAVA O ANEXO
            for ($i = 0; $i < 6; $i++) {
                if (isset($tecnico['anexo_tecnico'][$i])) {
                    $tecnico['anexo_tecnico'][$i] = $anexoNome[$j];
                    $j++;
                } else {
                    $tecnico['anexo_tecnico'][$i] = null;
                }
            }

            return $tecnico;
        }
        return null;
    }

}
