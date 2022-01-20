<?php

namespace App\Http\Controllers;

use App\Http\Requests\PontuacaoReprovar;
use App\Models\AnexoExperiencia;
use App\Models\Pessoa;
use App\Models\Pontuacao;
use App\Models\PontuacaoAnexos;
use App\Models\PontuacaoDoutorado;
use App\Models\PontuacaoEspecializacao;
use App\Models\PontuacaoExperiencia;
use App\Models\PontuacaoMestrado;
use App\Models\PontuacaoTecnico;
use App\Models\Transparencia;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class PontuacaoController extends Controller
{
    //
    public function store(PontuacaoReprovar $request)
    {
        try {
            DB::beginTransaction();
            //VERIFICAR SE EXISTER ALGUM MOTIVO PARA REPROVAR E ANEXA OS TEXTOS
            $texto_reprovar = '';
            $reprovou = 0;

            if (!is_null($request->motivo_recusar['documentos_pessoais'])) {
                $texto_reprovar .= 'Dados Pessoais: ' . $request->motivo_recusar['documentos_pessoais'] . '<br><br>';
                $reprovou = 1;
            }
            if (!is_null($request->motivo_recusar['escolaridade'])) {
                $texto_reprovar .= 'Escolaridade: ' . $request->motivo_recusar['escolaridade'] . '<br><br>';
                $reprovou = 1;
            }
            if (isset($request->motivo_recusar['curso_tecnico'])) {
                if (!is_null($request->motivo_recusar['curso_tecnico'])) {
                    $texto_reprovar .= 'Curso Técnico: ' . $request->motivo_recusar['curso_tecnico'] . '<br><br>';
                    $reprovou = 1;
                }
            }
            if (isset($request->motivo_recusar['experiencia'])) {
                if (!is_null($request->motivo_recusar['experiencia'])) {
                    $texto_reprovar .= 'Experiencia: ' . $request->motivo_recusar['experiencia'] . '<br><br>';
                    $reprovou = 1;
                }
            }

            //SUPERIOR
            if (isset($request->motivo_recusar['especializacao'])) {
                if (!is_null($request->motivo_recusar['especializacao'])) {
                    $texto_reprovar .= 'Especialização: ' . $request->motivo_recusar['especializacao'] . '<br><br>';
                    $reprovou = 1;
                }
            }
            if (isset($request->motivo_recusar['mestrado'])) {
                if (!is_null($request->motivo_recusar['mestrado'])) {
                    $texto_reprovar .= 'Mestrado: ' . $request->motivo_recusar['mestrado'] . '<br><br>';
                    $reprovou = 1;
                }
            }
            if (isset($request->motivo_recusar['doutorado'])) {
                if (!is_null($request->motivo_recusar['doutorado'])) {
                    $texto_reprovar .= 'Mestrado: ' . $request->motivo_recusar['doutorado'] . '<br><br>';
                    $reprovou = 1;
                }
            }

            //VARIAVEIS
            $pontuacao_total = 0;
            $pontuacao_tecnico = 0;
            $pontuacao_especializacao = 0;
            $pontuacao_mestrado = 0;
            $pontuacao_douturado = 0;
            $pontuacao_experiencia = 0;
            //VERIFICAR SE PESSOA JA FOI AVALIADA
            $pessoa = Pessoa::findOrFail($request->pessoa_id);

            if ($pessoa->status == 1) {
                session()->put('error', 'Parece que alguém já avaliou essa pessoa!');
                return redirect()->route('/visualizacao');
            }

            //Pontuacao
            $pontuacao_id = Pontuacao::create([
                'avaliar_cpfDef' => $request->avaliar_cpfDef,
                'avaliar_escolaridade' => $request->avaliar_escolaridade,
            ])->id;


            //Tecnico
            if (isset($request->pontuacao_tecnico)) {
                $tecnico = $request->pontuacao_tecnico;
                for ($i = 0; $i < count($tecnico['id']); $i++) {
                    PontuacaoTecnico::create([
                        'pontuacao_id' => $pontuacao_id,
                        'anexo_id' => $tecnico['id'][$i],
                        'pontuacao' => $tecnico['pontuacao'][$i],
                    ]);

                    $pontuacao_tecnico += $tecnico['pontuacao'][$i];
                    if ($pontuacao_tecnico <= 3.0) {
                        $pontuacao_total += $tecnico['pontuacao'][$i];
                    }
                }
            }

            //Especializacao
            if (isset($request->pontuacao_especializacao)) {
                $especializacao = $request->pontuacao_especializacao;
                for ($i = 0; $i < count($especializacao['id']); $i++) {
                    PontuacaoEspecializacao::create([
                        'pontuacao_id' => $pontuacao_id,
                        'anexo_id' => $especializacao['id'][$i],
                        'pontuacao' => $especializacao['pontuacao'][$i],
                    ]);
                    $pontuacao_especializacao += $especializacao['pontuacao'][$i];
                    if ($pontuacao_especializacao <= 6) {
                        $pontuacao_total += $especializacao['pontuacao'][$i];
                    }
                }
            }

            //Doutorado
            if (isset($request->pontuacao_doutorada)) {
                $doutorado = $request->pontuacao_doutorada;
                for ($i = 0; $i < count($doutorado['id']); $i++) {
                    PontuacaoDoutorado::create([
                        'pontuacao_id' => $pontuacao_id,
                        'anexo_id' => $doutorado['id'][$i],
                        'pontuacao' => $doutorado['pontuacao'][$i],
                    ]);
                    $pontuacao_douturado += $doutorado['pontuacao'][$i];
                    if ($pontuacao_douturado <= 5) {
                        $pontuacao_total += $doutorado['pontuacao'][$i];
                    }
                }
            }

            //Mestrado
            if (isset($request->pontuacao_mestrado)) {
                $mestrado = $request->pontuacao_mestrado;
                for ($i = 0; $i < count($mestrado['id']); $i++) {
                    PontuacaoMestrado::create([
                        'pontuacao_id' => $pontuacao_id,
                        'anexo_id' => $mestrado['id'][$i],
                        'pontuacao' => $mestrado['pontuacao'][$i],
                    ]);
                    $pontuacao_mestrado += $mestrado['pontuacao'][$i];
                    if ($pontuacao_mestrado <= 6) {
                        $pontuacao_total += $mestrado['pontuacao'][$i];
                    }
                }
            }

            //Experiencia
            if (isset($request->pontuacao_experiencia)) {
                $experiencia = $request->pontuacao_experiencia;
                for ($i = 0; $i < count($experiencia['id']); $i++) {
                    PontuacaoExperiencia::create([
                        'pontuacao_id' => $pontuacao_id,
                        'anexo_id' => $experiencia['id'][$i],
                        'pontuacao' => $experiencia['pontuacao'][$i],
                    ]);
                    //ALTERAR AS DATAS DE ENTRADA E SAIDA
                    $anexo_experiencia = AnexoExperiencia::findOrFail($experiencia['id'][$i]);
                    $anexo_experiencia->update([
                        'data_entrada' => $experiencia['data_entrada'][$i],
                        'data_saida' => $experiencia['data_saida'][$i],
                    ]);
                    $pontuacao_experiencia += $experiencia['pontuacao'][$i];
                    if ($pontuacao_experiencia <= 40) {
                        $pontuacao_total += $experiencia['pontuacao'][$i];
                    }
                }
            }

            //UPDATE PONTUACAO
            $pontuacao = Pontuacao::findOrFail($pontuacao_id);
            //VERIFICAR A PONTUACAO TOTAL
            $pontuacao->update([
                'pontuacao_total' => $pontuacao_total,
                'avaliador_id' => auth()->id()
            ]);

            //VERIFICAR SE REPROVOU
            if ($reprovou == 1) {
                $pessoa = Pessoa::findOrFail($request->pessoa_id);
                $pessoa->update([
                    'status' => 0,
                    'motivo_rev' => $texto_reprovar,
                    'pontuacao_id' => $pontuacao_id,
                ]);

                //SALVA NO LOG DE TRANSPARECIAN O QUE O AVALIADOR FEZ
                Transparencia::create([
                    'instrutor_id' => auth()->id(),
                    'pessoa_id' => $pessoa->id,
                    'tela' => 'Avaliação',
                    'motivo' => $texto_reprovar,
                ]);

                session()->put('sucess', 'Pessoa avaliada com sucesso! ');
                return redirect()->route('/visualizacao');
            }

            //CASO N TENHA REPROVADO PROSSEGUE NORMALMENTE
            //UPDATE PESSOA
            $pessoa->update([
                'pontuacao_id' => $pontuacao_id,
                'status' => 1,
            ]);

            //SALVA NO LOG DE TRANSPARECIAN O QUE O AVALIADOR FEZ
            Transparencia::create([
                'instrutor_id' => auth()->id(),
                'pessoa_id' => $pessoa->id,
                'tela' => 'Avaliação',
                'pontuacao_total' => $pontuacao_total,
            ]);
            DB::commit();
            session()->put('sucess', 'Pessoa avaliada com sucesso! Pontuação Total:' . $pontuacao_total);
            return redirect()->route('/visualizacao');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->route('/visualizacao')->withInput()->withErrors([
                'message' => $ex->getMessage()
            ]);

        }
    }


    public function aceitarAvaliacao($id)
    {
        $pessoa = Pessoa::findOrFail($id);

        if (!is_null($pessoa->aprovado)) {
            session()->put('error', 'Parece que alguém já verificou essa pessoa');
            return redirect()->route('visualizacao-aprovar');
        }

        $pessoa->pontuacao->update([
            'aprovador_id' => auth()->id(),
        ]);

        //DEPOIS ACRESCENTAR A DATA
        //VERIFICAR SE FOI UMA REVISAO DE ALGUM QUE FOI REPROVADO OU ACEITO
        if ($pessoa->status == 0) {
            $pessoa->update([
                'status_aprovado' => 0,
            ]);
        } else {
            $pessoa->update([
                'status_aprovado' => 1,
            ]);
        }
        //SALVA NO LOG DE TRANSPARECIAN O QUE O AVALIADOR FEZ
        Transparencia::create([
            'instrutor_id' => auth()->id(),
            'pessoa_id' => $pessoa->id,
            'tela' => 'Revisão',
        ]);

        session()->put('sucess', 'Pessoa verificada com sucesso!');
        return redirect()->route('visualizacao-aprovar');

    }

    public function reavaliar(PontuacaoReprovar $request)
    {
        $pessoa = Pessoa::findOrFail($request->pessoa_id);
        $texto_reprovar = '';
        if (!is_null($request->motivo_recusar['documentos_pessoais'])) {
            $texto_reprovar .= 'Dados Pessoais: ' . $request->motivo_recusar['documentos_pessoais'] . '<br><br>';
        }
        if (!is_null($request->motivo_recusar['escolaridade'])) {
            $texto_reprovar .= 'Escolaridade: ' . $request->motivo_recusar['escolaridade'] . '<br><br>';
        }
        if (isset($request->motivo_recusar['curso_tecnico'])) {
            if (!is_null($request->motivo_recusar['curso_tecnico'])) {
                $texto_reprovar .= 'Curso Técnico: ' . $request->motivo_recusar['curso_tecnico'] . '<br><br>';
            }
        }
        if (isset($request->motivo_recusar['experiencia'])) {
            if (!is_null($request->motivo_recusar['experiencia'])) {
                $texto_reprovar .= 'Experiencia: ' . $request->motivo_recusar['experiencia'] . '<br><br>';
            }
        }
        //SUPERIOR
        if (isset($request->motivo_recusar['especializacao'])) {
            if (!is_null($request->motivo_recusar['especializacao'])) {
                $texto_reprovar .= 'Especialização: ' . $request->motivo_recusar['especializacao'] . '<br><br>';
            }
        }
        if (isset($request->motivo_recusar['mestrado'])) {
            if (!is_null($request->motivo_recusar['mestrado'])) {
                $texto_reprovar .= 'Mestrado: ' . $request->motivo_recusar['mestrado'] . '<br><br>';
            }
        }
        if (isset($request->motivo_recusar['doutorado'])) {
            if (!is_null($request->motivo_recusar['doutorado'])) {
                $texto_reprovar .= 'Mestrado: ' . $request->motivo_recusar['doutorado'] . '<br><br>';
            }
        }

        if (empty($texto_reprovar)) {
            session()->put('error', 'Para enviar alguém para a reavalição é necessário descrever algum motivo!');
            return redirect()->route('/aprovar', $pessoa->id);
        }

        if (!is_null($pessoa->aprovado)) {
            session()->put('error', 'Parece que alguém já verificou essa pessoa');
            return redirect()->route('visualizacao-aprovar');
        }

        //VERIFICA SE EXISTE PONTUACAO
        if (!is_null($pessoa->pontuacao_id)) {
            $pessoa->pontuacao->update([
                'aprovador_id' => auth()->id(),
            ]);
            //DELETAR AS PONTUACOES PARA VOLTAR A AVALIACAO NOVAMENTE
            $pontuacao = Pontuacao::findOrFail($pessoa->pontuacao_id);

            foreach (PontuacaoTecnico::where('pontuacao_id', $pontuacao->id)->get() as $tecnico) {
                $tecnico->delete();
            }
            foreach (PontuacaoExperiencia::where('pontuacao_id', $pontuacao->id)->get() as $experiencia) {
                $experiencia->delete();
            }
            foreach (PontuacaoEspecializacao::where('pontuacao_id', $pontuacao->id)->get() as $especializacao) {
                $especializacao->delete();
            }
            foreach (PontuacaoDoutorado::where('pontuacao_id', $pontuacao->id)->get() as $doutorado) {
                $doutorado->delete();
            }
            foreach (PontuacaoMestrado::where('pontuacao_id', $pontuacao->id)->get() as $mestrado) {
                $mestrado->delete();
            }

        }

        if (is_null($pessoa->pontuaao_id)) {
            //SALVA NA TRANSPARENCIA CASO N TENHA PONTUACAO
            Transparencia::create([
                'instrutor_id' => auth()->id(),
                'pessoa_id' => $pessoa->id,
                'tela' => 'Revisão',
                'motivo' => $request->motivo_rep,
            ]);
        }

        if (!is_null($pessoa->pontuacao_id)) {
            //SALVA NO LOG DE TRANSPARECIAN O QUE O AVALIADOR FEZ
            Transparencia::create([
                'instrutor_id' => auth()->id(),
                'pessoa_id' => $pessoa->id,
                'tela' => 'Revisão',
                'motivo' => $texto_reprovar,
                'pontuacao_total' => $pontuacao->pontuacao_total,
            ]);
        }

        //DEPOIS ACRESCENTAR A DATA
        $pessoa->update([
            'motivo_rev' => $texto_reprovar,
            'status' => null,
            'pontuacao_id' => null,
        ]);


        //DELETA PONTUACAO
        if (isset($pontuacao)) {
            $pontuacao->delete();
        }
        session()->put('sucess', 'Pessoa revisada com sucesso!');
        return redirect()->route('visualizacao-aprovar');

    }
}
