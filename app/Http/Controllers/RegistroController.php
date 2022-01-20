<?php

namespace App\Http\Controllers;
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');
use App\Http\Requests\Registro;
use App\Models\Cargo;
use App\Models\EditalDinamico;
use App\Models\EditalDinamicoTipoAnexo;
use App\Models\Endereco;
use App\Models\Pessoa;
use App\Models\PessoaEditalAnexo;
use App\Models\Progress;
use App\Models\Termos;
use App\Models\TipoAnexoCargo;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegistroController extends Controller
{
    public function index($id)
    {

        $cargos = \App\Models\Cargo::all();
        $editalDinamico = EditalDinamico::where('telas_edital_id', $id)->first();

        $telasEdital = $editalDinamico->telasEdital;


        if ($telasEdital->status_liberar == 0 && !is_null($telasEdital->data_fecha)) {

            if (strtotime($telasEdital->data_liberar) >= strtotime(date('Y-m-d H:i'))) {
                return redirect()->route('inical');
            }

            if (strtotime($telasEdital->data_fecha) < strtotime(date('Y-m-d H:i'))) {

                return redirect()->route('inical');
            }
        }
        if (($telasEdital->status_liberar == 0 && is_null($telasEdital->data_liberar) && is_null($telasEdital->data_fecha))) {
            return redirect()->route('inical');
        }
        return view('registro.registro', compact('editalDinamico', 'cargos', 'id'));
    }

    //CADASTRO DA PESSOA NA 1 REQUISAO
    public function storePart1(Registro $request)
    {
        try {
            DB::beginTransaction();

            $editalDinamico = EditalDinamico::where('telas_edital_id', $request->type_edital)->first();
            //CASO O CPF EXISTA
            $pessoa_confirma = Pessoa::where('cpf', $request->cpf)->where('edital_dinamico_id', $editalDinamico->id)->first();
            if (!isset($request->termo_de_condicao) && !isset($request->termo_de_privacidade)) {
                session()->put('error', 'Ops, parece que você não aceito os termos e políticas de privacidade!');
                return redirect()->route('registro');
            }

            if (!is_null($pessoa_confirma)) {
                session()->put('sucess', 'Ops, parece que você já concluiu seu cadastro!');
                return redirect()->route('inical');
            }

            //VERIFICAO DE CARGOS -> IMPEDIR DE PASSAR CARGOS DE OUTRO NIVEL DE ESCOLARIDADE
            $cargo = Cargo::findOrFail($request->CARGO);
            if ($cargo->escolaridadeEditalDinamico->escolaridade_id != $request->escolaridade) {
                session()->put('error', 'Ops, parece que o cargo não condizem com o nível de escolaridade selecionado.');
                return redirect()->route('registro', $editalDinamico->id);
            }

            $endereco = new Endereco();
            $endereco->endereco = $request->endereco . ', ' . $request->numero;
            $endereco->bairro = $request->bairro;
            $endereco->cep = $request->cep;

            if ($request->deficiencia == 'Nao') {
                $deficiencia = 0;
            } else {
                $deficiencia = 1;
            }
            $pessoa = new Pessoa();
            $pessoa->edital_dinamico_id = $editalDinamico->id;
            $pessoa->nome_completo = strtoupper($request->nome_completo);
            $pessoa->cargo_id = $request->CARGO;
            $pessoa->escolaridade_id = $request->escolaridade;
            $pessoa->cpf = strtoupper($request->cpf);
            $pessoa->rg = $request->rg;
            $pessoa->orgao_emissor = strtoupper($request->orgao_emissor);
            $pessoa->pis = $request->pis;
            $pessoa->telefone = $request->telefone;
            $pessoa->nacionalidade = strtoupper($request->nacionalidade);
            $pessoa->naturalidade = strtoupper($request->naturalidade);
            $pessoa->email = strtolower($request->email);
            $pessoa->data_nascimento = $request->data_nascimento;
            $pessoa->portador_deficiencia = $deficiencia;
            $pessoa->sexo = $request->sexo;

            //SALVA NO CACHE
            $expiresAt = 1440;
            $tempoExpirar = date('d-m-Y H:i', strtotime('+24 Hours'));
            Cookie::queue('pessoa', $pessoa, $expiresAt);
            Cookie::queue('endereco', $endereco, $expiresAt);
            Cookie::queue('type_edital', $request->type_edital, $expiresAt);
            Cookie::queue('tempo_expirar', $tempoExpirar);

            DB::commit();

            return redirect()->route('registro/anexos', $request->type_edital);

        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->route('inical')->withInput()->withErrors([
                'message' => $ex->getMessage()
            ]);
        }
    }

    //SEGUNDA PARTE DO CADASTRO PARA SALVAR OS ANEXOS E ALGUMAS INFORMACOES
    public function storePart2(Request $request)
    {
        try {

            DB::beginTransaction();

            $rules = [];
            $messages = [
                'required' => 'Esse campo é obrigatório.',
                'mimes' => 'Esse campo aceita somente pdf.',
                'max' => 'Esse campo aceita arquivo com no máximo 5MB'
            ];
//            dd($request->anexosDocumentos);
            foreach (array_keys($request->anexosDocumentos) as $index) {
                foreach (array_keys($request->anexosDocumentos[$index]['documentoDinamico']) as $indexKey) {

                    if (isset($request->anexosDocumentos[$index][$indexKey])) {
                        $rules['anexosDocumentos.' . $index . '.' . $indexKey] = 'nullable|max:50000';
                    }
                }
            }

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
//                dd($validator->getMessageBag());
                return back()->withErrors($validator->getMessageBag()->toArray());
            }

            $enderecoCookie = json_decode(Cookie::get('endereco'));
            $pessoaCookie = json_decode(Cookie::get('pessoa'));

            //VALIADAR PESSOA NOVAMENTE

            if (!is_null($enderecoCookie) && !is_null($pessoaCookie)) {
                $pessoa_confirma = Pessoa::where('cpf', $pessoaCookie->cpf)->where('edital_dinamico_id', $pessoaCookie->edital_dinamico_id)->first();
            } else {
                $pessoa_confirma = null;
            }
            if (!is_null($pessoa_confirma)) {
                session()->put('sucess', 'Ops, parece que você já concluiu seu cadastro!');
                return redirect()->route('inical');
            }

            if (is_null($enderecoCookie) && is_null($pessoaCookie)) {
                session()->put('sucess', 'Ops, parece que você já concluiu seu cadastro!');
                return redirect()->route('inical');
            }

            $endereco = new Endereco();
            $pessoa = new Pessoa();

            $endereco->endereco = $enderecoCookie->endereco;
            $endereco->bairro = $enderecoCookie->bairro;
            $endereco->cep = $enderecoCookie->cep;
            $endereco->save();

            $pessoa->endereco_id = $endereco->id;
            $pessoa->edital_dinamico_id = $pessoaCookie->edital_dinamico_id;
            $pessoa->nome_completo = $pessoaCookie->nome_completo;
            $pessoa->cargo_id = $pessoaCookie->cargo_id;
            $pessoa->escolaridade_id = $pessoaCookie->escolaridade_id;
            $pessoa->cpf = $pessoaCookie->cpf;
            $pessoa->rg = $pessoaCookie->rg;
            $pessoa->orgao_emissor = $pessoaCookie->orgao_emissor;
            $pessoa->pis = $pessoaCookie->pis;
            $pessoa->telefone = $pessoaCookie->telefone;
            $pessoa->nacionalidade = $pessoaCookie->nacionalidade;
            $pessoa->naturalidade = $pessoaCookie->naturalidade;
            $pessoa->email = $pessoaCookie->email;
            $pessoa->data_nascimento = $pessoaCookie->data_nascimento;
            $pessoa->portador_deficiencia = $pessoaCookie->portador_deficiencia;
            $pessoa->sexo = $pessoaCookie->sexo;
            $pessoa->save();

            //SALVA OS TERMOS
            Termos::create([
                'pessoa_id' => $pessoa->id,
                'aceito_dados' => 1,
            ]);

            if (is_null($pessoa)) {
                session()->put('sucess', 'Ops, parece que você já concluiu seu cadastro!');
                return redirect()->route('inical');
            }
            if ($pessoa->pessoaEditalAnexos->count() != 0) {
                session()->put('sucess', 'Ops, parece que você já concluiu seu cadastro!');
                return redirect()->route('inical');
            }
            session()->put('pessoa_email', $pessoa->email);

            foreach (array_keys($request->anexosDocumentos) as $index) {
                foreach (array_keys($request->anexosDocumentos[$index]['documentoDinamico']) as $indexKey) {

                    if (isset($request->anexosDocumentos[$index][$indexKey])) {
                        $documento = $request->anexosDocumentos[$index][$indexKey];
                        $name = uniqid(date('HisYmd'));
                        $extesion = $documento->extension();
                        //Define o nome do arquivo
                        $nameFile = "{$name}.{$extesion}";
                        //criar arquivo documentos não existe
                        $upload = $documento->move('documentos', $nameFile);
                        if (!$upload) {
                            return redirect()
                                ->back()
                                ->with('error', 'Falha ao fazer upload')
                                ->withInput();
                        } else {
                            PessoaEditalAnexo::create([
                                'edital_dinamico_id' => $request->editalDinamicoID,
                                'tipo_anexo_id' => $index,
                                'pessoa_id' => $pessoa->id,
                                'documento_dinamico_id' => $request->anexosDocumentos[$index]['documentoDinamico'][$indexKey],
                                'nome_arquivo' => $nameFile,
                                'pontuacao' => null,
                            ]);
                        }
                    }
                }
            }

            //REALIZAR O UPDATE NA PESSOA ADICIONANDO O ANEXO
            $comprovante = ComprovanteController::gerarComprovante($pessoa);
            $comprovate_id = ComprovanteController::store($comprovante);

            //SALVAR O COMPROVANTE NA PESSOA
            $pessoa->update([
                'comprovante_id' => $comprovate_id,
                'check_cadastro_anexo' => 1,
            ]);

            //DELETAR O COKKIE
            Cookie::queue(Cookie::forget('pessoa'));
            Cookie::queue(Cookie::forget('endereco'));
            Cookie::queue(Cookie::forget('type_edital'));

            DB::commit();

            //ENVIAR O EMAIL
            Mail::send('registro.comprovante-email', ['comprovante' => $comprovante,], function ($message) {
                $message->from(getenv('MAIL_USERNAME'), 'Processo Seletivo Simplificado');
                $message->to(session('pessoa_email'));
                $message->subject('Comprovante do Processo Seletivo Simplificado');
            });
            session()->forget('pessoa_email');


            return redirect()->route('registro/comprovante', $comprovante);

        } catch (Exception $ex) {
            dd($ex->getMessage());
            DB::rollBack();
            return redirect()->route('inical')->withInput()->withErrors([
                'message' => $ex->getMessage()
            ]);
        }
    }

    //DEVOLVER PARA O REGISTRO OS DADOS DA PESSOA + ALTERACOES NO STYLE
    public function buscaIndex($id)
    {
        $editalDinamico = EditalDinamico::where('telas_edital_id', $id)->first();
        $pessoa = json_decode(Cookie::get('pessoa'));
        $progress = $this->gerarProgress($editalDinamico->id, $pessoa->cargo_id);


        $tipoAnexoCargo = TipoAnexoCargo::where('cargo_id', $pessoa->cargo_id)->get();
        //VAI VERIFICAR SE EXISTE ESSE ANEXO NO EDITAL
        $tipoAnexoCargo = $this->gerarTipoAnexoCargo($tipoAnexoCargo, $pessoa->cargo_id, $editalDinamico->id);

        if ($tipoAnexoCargo->count() > 0) {
            $porcetagemProgress = 100 / $tipoAnexoCargo->count();
        } else $porcetagemProgress = 0;

        if (isset($pessoa->id)) {
            Cookie::queue(Cookie::forget('pessoa'));
            Cookie::queue(Cookie::forget('endereco'));
            return redirect()->route('inical');
        }

        return view('registro.registros_anexos', compact('progress', 'pessoa', 'editalDinamico', 'porcetagemProgress', 'tipoAnexoCargo'));
    }


    public function gerarProgress($id, $cargo_id)
    {
        $progressM = Progress::where('edital_dinamico_id', $id)->get();
        $progress = new Collection();

        foreach ($progressM as $item) {
            $editalDinamicoTipoAnexo = EditalDinamicoTipoAnexo::where('tipo_anexo_id', $item->tipo_anexo_id)->where('edital_dinamico_id', $item->edital_dinamico_id)->where('cargo_id', $cargo_id)->first();
            if (!is_null($editalDinamicoTipoAnexo)) $progress->add($item);
        }
        return $progress;
    }

    public function gerarTipoAnexoCargo($tipoAnexo, $cargo_id, $editaDinamicoID)
    {
        $collection = new Collection();
        foreach ($tipoAnexo as $item) {
            $editalDinamicoTipoAnexo = EditalDinamicoTipoAnexo::where('tipo_anexo_id', $item->tipo_anexo_id)->where('edital_dinamico_id', $editaDinamicoID)->where('cargo_id', $item->cargo_id)->first();
            if (!is_null($editalDinamicoTipoAnexo)) $collection->add($item);
        }
        return $collection;
    }
}
