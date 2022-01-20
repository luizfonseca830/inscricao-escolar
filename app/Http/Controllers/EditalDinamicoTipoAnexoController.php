<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditalDinamicoTipoAnexoRequest;
use App\Models\DocumentoDinamico;
use App\Models\EditalDinamico;
use App\Models\EditalDinamicoTipoAnexo;
use App\Models\EscolaridadeEditalDinamico;
use App\Models\Progress;
use App\Models\TipoAnexo;
use App\Models\TipoAnexoCargo;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class EditalDinamicoTipoAnexoController extends Controller
{
    //
    public function index($id)
    {
        $editalDinamico = EditalDinamico::findOrFail($id);
        $editalAnexos = EditalDinamicoTipoAnexo::where('edital_dinamico_id', $editalDinamico->id)->get();
        $tiposAnexos = TipoAnexo::all();
        $escolaridade_edital_dinamicos = EscolaridadeEditalDinamico::where('edital_dinamico_id', $editalDinamico->id)->get();
        return view('pages.lista-inscricoes.configuracoes.list', compact('editalAnexos', 'escolaridade_edital_dinamicos', 'tiposAnexos', 'editalDinamico'));
    }

    public function store(EditalDinamicoTipoAnexoRequest $request)
    {
        try {
            DB::beginTransaction();
            $progress = Progress::where('tipo_anexo_id', $request->inputTipoAnexo)->where('edital_dinamico_id', $request->editalDinamicoID)->first();
            $editalDinamicoTipoAnexos = EditalDinamicoTipoAnexo::create([
                'edital_dinamico_id' => $request->editalDinamicoID,
                'tipo_anexo_id' => $request->inputTipoAnexo,
                'cargo_id' => $request->inputCargo,
            ]);
            $tipoAnexoCargo = TipoAnexoCargo::where('cargo_id', $request->inputCargo)->where('tipo_anexo_id', $request->inputTipoAnexo)->first();
            if (is_null($tipoAnexoCargo)) {
                TipoAnexoCargo::create([
                    'cargo_id' => $request->inputCargo,
                    'tipo_anexo_id' => $request->inputTipoAnexo,
                ]);
            }
            if (!is_null($editalDinamicoTipoAnexos)) {
                $documentoDinamico = DocumentoDinamico::create([
                    'edital_dinamico_tipo_anexo_id' => $editalDinamicoTipoAnexos->id,
                    'nome_documento' => mb_strtoupper($request->inputNomeAnexo),
                    'obrigatorio' => $request->inputObrigatorio,
                    'pontuacao_maxima_documento' => $request->inputPontuacaoMaxima,
                    'pontuacao_maxima_item' => $request->inputPontuacaoMaximaDoItem,
                    'pontuacao_por_item' => $request->inputPontuacaoPorItem,
                    'quantidade_anexos' => $request->inputQuantiadeAnexos,
                    'pontuacao_por_ano' => $request->inputPorAno,
                    'pontuacao_por_mes' => $request->inputPorMes,
                    'tipo_experiencia' => $request->inputTipoExperiencia,
                    'pontuar_publica_privada' => $request->pontuar_publica_privada,
                    'pontuar_manual' => $request->pontuar_manual,
                ]);
                if (is_null($progress)) {
                    Progress::create([
                        'tipo_anexo_id' => $request->inputTipoAnexo,
                        'edital_dinamico_id' => $request->editalDinamicoID
                    ]);
                }
            }

            if (!is_null($documentoDinamico)) {
                session()->put('sucess', 'Anexo Cadastrado com sucesso');
                DB::commit();
            } else session()->put('error', 'Não foi possível fixar essa documento ao formulário, entre em contato com suporte do sistema.');
            return redirect()->route('edital.formulario.anexo', $request->editalDinamicoID);

        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->route('inical')->withInput()->withErrors([
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $editalDinamico = EditalDinamico::findOrFail($id);
        $editalAnexos = EditalDinamicoTipoAnexo::where('edital_dinamico_id', $editalDinamico->id)->get();
        $tiposAnexos = TipoAnexo::all();
        $escolaridade_edital_dinamicos = EscolaridadeEditalDinamico::where('edital_dinamico_id', $editalDinamico->id)->get();
        return view('pages.lista-inscricoes.configuracoes.edita',
            compact($editalAnexos, $tiposAnexos, $escolaridade_edital_dinamicos));
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $tipoAnexoCargo = TipoAnexoCargo::where('cargo_id', $request->inputCargo)->where('tipo_anexo_id', $request->inputTipoAnexo)->first();
            if (is_null($tipoAnexoCargo)) {
                $tipoAnexoCargo = TipoAnexoCargo::create([
                    'cargo_id' => $request->inputCargo,
                    'tipo_anexo_id' => $request->inputTipoAnexo,
                ]);
            }
            //BUSCA PELO EDITAL DINAMICO TIPO ANEXO
            $editalAnexo = EditalDinamicoTipoAnexo::findOrFail($request->editalDinamicoTipoAnexoID);
            //BUSCA PELO PROGRESS
            $progress = Progress::where('tipo_anexo_id', $request->inputTipoAnexo)->where('edital_dinamico_id', $editalAnexo->edital_dinamico_id)->first();
            //CASO NÃO EXISTA CRIAR UM NOVO
            if (is_null($progress)) {
                Progress::create([
                    'tipo_anexo_id' => $request->inputTipoAnexo,
                    'edital_dinamico_id' => $editalAnexo->edital_dinamico_id
                ]);
            }
            //REALIZAR AS ALTERAÇÕES
            $editalAnexo->cargo_id = $request->inputCargo;
            $editalAnexo->tipo_anexo_id = $tipoAnexoCargo->tipo_anexo_id;

            $documento = $editalAnexo->documentoDinamico;
            $documento->nome_documento = $request->inputNomeAnexo;
            $documento->obrigatorio = $request->inputObrigatorio;
            $documento->pontuacao_maxima_documento = $request->inputPontuacaoMaxima;
            $documento->pontuacao_maxima_item = $request->inputPontuacaoMaximaDoItem;
            $documento->pontuacao_por_item = $request->inputPontuacaoPorItem;
            $documento->quantidade_anexos = $request->inputQuantiadeAnexos;
            $documento->pontuacao_por_ano = $request->inputPorAno;
            $documento->pontuacao_por_mes = $request->inputPorMes;
            $documento->tipo_experiencia = $request->inputTipoExperiencia;
            $documento->pontuar_publica_privada = $request->pontuar_publica_privada;
            $documento->pontuar_manual = $request->pontuar_manual;
            //ATUALIZAR NA BASE DE DADOS
            $editalAnexo->update();
            $documento->update();

            DB::commit();
            return redirect()->back()->with(['type' => 'success', 'msg' => 'Informações alteradas com sucesso.']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'msg' => 'Ocorreu um erro na tentativa de atualizar as informações. log: ' . $exception->getMessage()]);
        }


    }
}
