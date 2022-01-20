<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecursoAdminRequest;
use App\Models\EditalDinamico;
use App\Models\Pessoa;
use App\Models\Pontuacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class RecursoAdminController extends Controller
{
    //
    public function index()
    {
        $editalDinamicos = EditalDinamico::all();
        $progressQuantiadePorcento = '';
        return view('pages.recurso-tipo-edital', compact('editalDinamicos'));
    }

    public function negar(RecursoAdminRequest $request)
    {
        $pessoa = Pessoa::findOrFaiL($request->pessoa_id);
//        dd([$request->all(), $pessoa, $pessoa->recurso, date('Y-m-d H:i:s')]);

        if (!is_null($pessoa->recurso->status)) {
            session()->put('error', 'Esse recurso já foi avaliado.');
        }

        $pessoa->recurso->update([
            'avaliador_id' => auth()->user()->id,
            'status' => 0,
            'data_avaliado' => date('Y-m-d H:i:s'),
            'recusar_motivo' => $request->motivo_reav,
        ]);

        session()->put('sucess', 'Recuso negado com sucesso.');
        return redirect()->route('visualizacao-recurso', $pessoa->edital_dinamico_id);
    }

    public function aceitar(Request $request)
    {
        $pessoa = Pessoa::findOrFaiL($request->pessoa_id);
        $pontuarRecurso = 0;
        $pontuacaoMaximaRecurso = (100 - (!is_null($pessoa->pontuacao($pessoa->id)) ? $pessoa->pontuacao($pessoa->id)->pontuacao_total : 0));
        if (!is_null($pessoa->recurso->status)) {
            session()->put('error', 'Esse recurso já foi avaliado.');
        }

        if (!is_null($request->pontuar_recurso)) {
            if ($request->pontuar_recurso <= $pontuacaoMaximaRecurso && $request->pontuar_recurso > 0) {
                $pontuarRecurso = $request->pontuar_recurso;
                $this->updatePontuacaoTotal($pessoa, $pontuarRecurso);
            }
        }

        if (!is_null($request->pontuar_recurso)) $pontuarRecurso = $request->pontuar_recurso;

        $pessoa->recurso->update([
            'avaliador_id' => auth()->user()->id,
            'status' => 1,
            'data_avaliado' => date('Y-m-d H:i:s'),
            'recusar_motivo' => $request->motivo_reav,
            'pontuacao' => $pontuarRecurso,
        ]);
        if ($pontuarRecurso <= 0) {
            $pessoa->status = null;
            $pessoa->status_avaliado = null;
            $pessoa->status_revisado = null;
        }
        if ($pessoa->update()) {
            session()->put('sucess', 'Recurso avaliado com sucesso, enviado para avaliação.');
        } else session()->put('error', 'Não foi possível aceitar esse recurso, entre em contato com o suporte do sistema.');
        return true;
        return redirect()->route('visualizacao-recurso', $pessoa->edital_dinamico_id);
    }

    public function updatePontuacaoTotal($pessoa, $recursoPontuacao)
    {
        try {
            $pontuacaoTotal2 = ((!is_null($pessoa->pontuacao($pessoa->id)) ? $pessoa->pontuacao($pessoa->id)->pontuacao_total : 0) + $recursoPontuacao);
            DB::beginTransaction();
            $pontuacaoTotal = new Pontuacao();
            $pontuacaoTotal->pessoa_id = $pessoa->id;
            $pontuacaoTotal->avaliador_id = auth()->user()->id;
            $pontuacaoTotal->pontuacao_total = $pontuacaoTotal2;
            $pontuacaoTotal->pontuacao_total_anexos = $pontuacaoTotal2;
            $pontuacaoTotal->pontuacao_total_publica = (!is_null($pessoa->pontuacao($pessoa->id)) ? $pessoa->pontuacao($pessoa->id)->pontuacao_total_publica : 0);
            $pontuacaoTotal->pontuacao_total_privada = (!is_null($pessoa->pontuacao($pessoa->id)) ? $pessoa->pontuacao($pessoa->id)->pontuacao_total_privada: 0);
            $pontuacaoTotal->save();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception;
        }

    }
}
