<?php

namespace App\Http\Controllers;

use App\Models\Anexos;
use Illuminate\Http\Request;

class AnexoController extends Controller
{
    //
    public function store($anexo, $extra){
        $anexo_id = Anexos::create([
            'documento_pessoas' => $anexo[0],
            'anexo_escolaridade' => $anexo[1],
            'anexo_deficiencia' =>  $anexo[2],
            'extra' => $extra,
        ])->id;
        return $anexo_id;
    }

    public function anexoNome(Request $request){
        //ARRAY PARA SALVAR O NOME DO ANEXO
        $anexoNomes = [];
        /* SALVA OS PRIMEIROS ARQUIVOS */
        foreach ($request->file('anexosDocumentos') as $anexosDoc){
            #NOME E EXTENSAO DO ARQUIVO
            $filenameWithExt  = $anexosDoc->getClientOriginalName();
            #SOMENTE O NOME DO ARQUIVO
            $filename  = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            #SOMENTE A EXTENSAO
            $extension = $anexosDoc->getClientOriginalExtension();
            #Nome do Arquivo Final
            $fileNameToStore = bcrypt($filename.'_'.time()).'.'.$extension;
            //SALVA NO ARRAY O NOME DOS ANEXO
            array_push($anexoNomes, $fileNameToStore);

            //SALVANDO NO DIRETORIO
            $anexosDoc->storeAs('public/anexos/documentos', $fileNameToStore);
        }
        //VERIFICAR O TAMANHO DO ARRAY - CASO ELE NAO SEJA PORTADOR DE DEFICENCIA
        if (count($anexoNomes) == 2) {
            array_push($anexoNomes, null);
        }

        return $anexoNomes;
    }
}
