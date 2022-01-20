<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvaliacaoReprovarRequest;
use App\Models\Pessoa;
use App\Models\PessoaEditalAnexo;
use App\Models\Pontuacao;
use App\Models\ReprovarPessoa;
use App\Models\Transparencia;
use App\Models\DocumentoDinamico;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvaliadorAvaliarController extends Controller
{

    public function aprovar(Request $request)
    {
        $anexo = $request->anexo;
        $pontuacao_verificar = 0;
        $pontuacao_maxima_documento = $request->pontuacao_maxima_documento;
        $pontuar_publica_privada = $request->pontuar_publica_privada;
        $pontuacao_por_ano = $request->pontuacao_por_ano;
        $pontuacao_por_mes = $request->pontuacao_por_mes;
        $pessoa = Pessoa::findOrFail($request->pessoa_id);
        $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);
        $pontuacaoTotal = 0;
        $pontuacaoTotalPublica2 = 0;
        $pontuacaoTotalPrivada2 = 0;
        $pontuacaoTotalPublica = 0;
        $pontuacaoTotalPrivada = 0;
        $pontuacaoTotalAnexos = 0;

        try {
            DB::beginTransaction();

            foreach ($pessoa->pessoaEditalAnexos as $editalAnexo) {

                if (!is_null($editalAnexo->documentoDinamico->pontuacao_por_item)) {
                    if ($anexo[$editalAnexo->id][0] >= 0) {
                        $editalAnexo->update([
                            'pontuacao' => $anexo[$editalAnexo->id][0]
                        ]);
                        if ($anexo[$editalAnexo->id][0] != 1) {
                            $pontuacaoTotalAnexos = $pontuacaoTotalAnexos + $anexo[$editalAnexo->id][0];
                        }
                        if ($pontuacaoTotalAnexos > $editalAnexo->documentoDinamico->pontuacao_maxima_documento) {
                            return redirect()->back()->withErrors([
                                'limite' => 'Ops, você passou o limite de pontuação maxima que é : ' . $editalAnexo->documentoDinamico->pontuacao_maxima_documento . ' e pontuação total de anexo está com : ' . $pontuacaoTotalAnexos . '.'
                            ]);
                        }
                    }
                }
            }
            foreach ($anexo as $anexos) {
                if (isset($anexos['anexoAno']) && isset($anexos['anexoMes'])) {
                    $documenDinamico = DocumentoDinamico::findorFail($anexos['documento_id']);

                    if ($documenDinamico->tipo_experiencia == 0) {
                        $pontuacaoTotalPublica = (($anexos['anexoAno'] * $pontuacao_por_ano) + ($anexos['anexoMes'] * $pontuacao_por_mes));
                        if ($pontuacaoTotalPublica > $documenDinamico->pontuacao_maxima_item) {
                            return redirect()->back()->withErrors([
                                'limite' => 'O limite da Pontuação Total Pública é: ' . $pontuacaoTotalPublica . ' e a pontuação total de anexo pública está com : ' . $documenDinamico->pontuacao_maxima_item .''
                            ]);
                        }
                        //Fazendo a somatorio de pontos por anexo
                        $editalAnexo = PessoaEditalAnexo::findOrFail($anexos['anexo_id']);
                        $editalAnexo->update([
                            'pontuacao_exp_publico' => $pontuacaoTotalPublica
                        ]);
                        $pontuacaoTotalPublica2 = $pontuacaoTotalPublica2 + $pontuacaoTotalPublica;
                    } else {
                        $pontuacaoTotalPrivada = (($anexos['anexoAno'] * $pontuacao_por_ano) + ($anexos['anexoMes'] * $pontuacao_por_mes));

                        if ($pontuacaoTotalPrivada > $documenDinamico->pontuacao_maxima_item) {
                            return redirect()->back()->withErrors([
                                'limite' => 'O limite da Pontuação Total Privada é: ' . $pontuacaoTotalPrivada . ' e a pontuação total de anexo privado está com : ' . $documenDinamico->pontuacao_maxima_item .''
                            ]);
                        }
                        $editalAnexo = PessoaEditalAnexo::findOrFail($anexos['anexo_id']);
                        $editalAnexo->update([
                            'pontuacao_exp_privado' => $pontuacaoTotalPrivada
                        ]);
                        $pontuacaoTotalPrivada2 = $pontuacaoTotalPrivada2 + $pontuacaoTotalPrivada;
                    }
                } else {
                    if (isset($anexos['anexo_id'])) {
                        $editalAnexo = PessoaEditalAnexo::findOrFail($anexos['anexo_id']);
                        if (!is_null($editalAnexo)) {
                            $editalAnexo->update([
                                'pontuacao_exp_privado' => 0,
                                'pontuacao_exp_publica' => 0
                            ]);
                        }
                    }
                }
            }
                $pontuacaoTotal = $pontuacaoTotalAnexos + ($pontuacaoTotalPrivada2 + $pontuacaoTotalPublica2);
                if ($pontuacaoTotal > $pontuacao_maxima_documento) {
                    return redirect()->back()->withErrors([
                        'limite' => 'Você passou o limite de pontuação que é: ' .$pontuacao_maxima_documento. ' a sua pontuação Total deu: ' . $pontuacaoTotal . ' Favor refazer a avaliação'
                    ]);
                }


            $pessoa->update([
                'status_revisado' => null,
                'status_avaliado' => 1
            ]);

            $transparencia = Transparencia::create([
                'instrutor_id' => auth()->id(),
                'pessoa_id' => $pessoa->id,
                'tela' => $url,
                'pontuacao_total' => $pontuacaoTotal,
                'pontuacao_total_publica' => $pontuacaoTotalPublica2,
                'pontuacao_total_privada' => $pontuacaoTotalPrivada2,
                'pontuacao_total_anexos' => $pontuacaoTotalAnexos,
            ]);

            $pontuacao = Pontuacao::create([
                'pessoa_id' => $pessoa->id,
                'avaliador_id' => auth()->id(),
                'pontuacao_total' => $pontuacaoTotal,
                'pontuacao_total_publica' => $pontuacaoTotalPublica2,
                'pontuacao_total_privada' => $pontuacaoTotalPrivada2,
                'pontuacao_total_anexos' => $pontuacaoTotalAnexos,
            ]);

            if (!is_null($transparencia) && !is_null($pontuacao)) {
                DB::commit();
                session()->put('sucess', 'Avaliação Realizada com sucesso. Pontuação Geral: ' . $pontuacaoTotal . '');
            }

            $pontuacaoTotal = 0;
            foreach ($pessoa->pessoaEditalAnexos as $anexosPessoa){
                $pontuacaoTotal = $pontuacaoTotal + $anexosPessoa->pontuacao;
            }
            return redirect()->route('/visualizacao', $pessoa->edital_dinamico_id);

        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function reprovar(AvaliacaoReprovarRequest $request)
    {
        dd($request->all());
        try {
            DB::beginTransaction();

            $pessoa = Pessoa::findOrFail($request->pessoa_id);
            $pessoa->update([
                'status_revisado' => null
            ]);
            $reprovar = new ReprovarPessoa();
            $reprovar->pessoa_id = $pessoa->id;
            $reprovar->avaliador_id = auth()->user()->id;
            $reprovar->motivo = $request->motivo_rep;

            $pessoa->update([
                'status_avaliado' => 0,
            ]);

            foreach ($pessoa->pessoaEditalAnexos as $editalAnexo) {
                if (!is_null($editalAnexo->documentoDinamico->pontuacao_maxima_documento) && !is_null($editalAnexo->documentoDinamico->pontuacao_por_item)) {
                    $editalAnexo->update([
                        'pontuacao' => 0
                    ]);
                }
            }

            if ($reprovar->save()) {
                $url = str_replace("Novo/", "", $_SERVER["REQUEST_URI"]);

                $transparencia = Transparencia::create([
                    'instrutor_id' => auth()->id(),
                    'pessoa_id' => $pessoa->id,
                    'tela' => $url,
                    'pontuacao_total' => 0,
                    'pontuacao_total_publica' => 0,
                    'pontuacao_total_privada' => 0,
                    'pontuacao_total_anexos' => 0
                ]);

                $pontuacao = Pontuacao::create([
                    'pessoa_id' => $pessoa->id,
                    'avaliador_id' => auth()->id(),
                    'pontuacao_total' => 0,
                    'pontuacao_total_publica' => 0,
                    'pontuacao_total_privada' => 0,
                    'pontuacao_total_anexos' => 0
                ]);
            }

            DB::commit();
            return redirect()->route('/visualizacao', [$pessoa->edital_dinamico_id])->with([
                'color' => 'success',
                'message' => 'Pessoa avaliado com sucesso.'
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors([
                'message' => $ex->getMessage()
            ]);
        }
    }

}
