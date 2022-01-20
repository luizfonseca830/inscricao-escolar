<?php

namespace App\Http\Controllers\TelasDinamicas;

use App\Http\Controllers\Controller;
use App\Http\Requests\TelasEditalRequest;
use App\Models\EditalDinamico;
use App\Models\TelasEdital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TelasEditalController extends Controller
{
    //
    public function store(TelasEditalRequest $request)
    {
        try {
            //SALVA PDF
            if ($request->tipo_tela == 2) {
                //VERIFICAR SE O PDF VEIO
                if ($request->nome_pdf == '0') {
                    session()->put('error', 'Parece que você não selecionou o PDF!');
                    return redirect()->route('tela-criar');
                } else {
                    //VERIFICAR SE O NOME JA EXISTE
                    $telasEdital = TelasEdital::where('nome_ou_anexo', $request->nome_pdf)->first();
                    if (!is_null($telasEdital)) {
                        session()->put('error', 'Parece que esse anexo já está sendo utilizado!');
                        return redirect()->route('tela-criar');
                    }
                    //UPLOAD FILE
                    $documento = $request->pdf_carregar;
                    //GET NAME FILE
                    $name = $documento->getClientOriginalName();
                    //MOVE FILE
                    $upload = $documento->move('anexos', $name);
                    //VALIDATION UPLOAD
                    if (!$upload) {
                        session()->put('error', 'Algo de errado aconteceu, entre em contato com o suporte.');
                        return redirect()->route('tela-criar');
                    } else {
                        TelasEdital::create([
                            'tipo_tela_id' => 2,
                            'nome_anexo_mostrar' => $request->tela_nome_pdf,
                            'nome_ou_anexo' => $name,
                            'status_liberar' => $request->status_liberar,
                            'data_liberar' => $request->data_liberar,
                        ]);
                    }

                    session()->put('sucess', 'Tela Criada com sucesso!');
                    return redirect()->route('tela-criar');
                }
            } //SALVAR TELA
            else if ($request->tipo_tela == 1) {
                //VERIFICAR SE O NOME JA EXISTE
                $telasEdital = TelasEdital::where('nome_ou_anexo', $request->nome_tela)->first();
                if (!is_null($telasEdital)) {
                    session()->put('error', 'Parece que esse nome já está sendo utilizado!');
                    return redirect()->route('tela-criar');
                }
                TelasEdital::create([
                    'tipo_tela_id' => 1,
                    'nome_ou_anexo' => $request->tela_nome,
                    'status_liberar' => $request->status_liberar,
                    'data_liberar' => $request->data_liberar,
                ]);
                session()->put('sucess', 'Tela Criada com sucesso!');
                return redirect()->route('tela-criar');
            } else if ($request->tipo_tela == 3) {
//            dd($request->all());
                $telasEdital = TelasEdital::where('nome_ou_anexo', $request->nome_tela)->first();
                if (!is_null($telasEdital)) {
                    session()->put('error', 'Parece que esse nome já está sendo utilizado!');
                    return redirect()->route('tela-criar');
                }
                $telasEdital = TelasEdital::create([
                    'tipo_tela_id' => 3,
                    'pontuacao_total' => $request->pontuacao_maxima,
                    'nome_ou_anexo' => $request->tela_nome,
                    'status_liberar' => $request->status_liberar,
                    'data_liberar' => $request->data_liberar,
                ]);

                EditalDinamico::create([
                    'telas_edital_id' => $telasEdital->id,
                ]);
                session()->put('sucess', 'Tela Criada com sucesso!');
                return redirect()->route('tela-liberar');
            } //ERROS FINAIS
            else {
                session()->put('error', 'Parece que algo de errado aconteceu!');
                return redirect()->route('tela-criar');
            }
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->withException($ex->getMessage());
        }

    }


    public function delete($id)
    {
        try {
            $tela = TelasEdital::findOrFail($id);
            $tela->delete();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->withException($ex->getMessage());
        }
    }

    public function show($id)
    {
        $tela = TelasEdital::findOrFail($id);
        $directory = public_path();
        $files = \File::allFiles($directory);
        return view('pages.telas-dinamicas.tela-mostra-unico', [
            'tela' => $tela,
            'arquivos' => $files,
        ]);
    }

    public function update(Request $request, $id)
    {
        //VERIFICAR SE N FOI MARCADO A DATA E SELECIONADO O LIBERAR
        if ($request->status_liberar == '1' && !is_null($request->data_liberar)) {
            session()->put('error', 'Parece que algo de errado aconteceu!');
            return redirect()->route('tela-unica-mostra', $id);
        }

        //CRAIR UMA VARIVAVEL COM OS DADOS DA TELA PARA SER EDITADA
        $tela = TelasEdital::findOrFail($id);
        //VERIFICA SE A TELA EXISTE
        if (is_null($tela)) {
            session()->put('error', 'Parece que algo de errado aconteceu!');
            return redirect()->route('tela-liberar');
        } else {
            //EDITAR A TELA
            $tela->update([
                'nome_ou_anexo' => $request->nome_ou_anexo,
                'status_liberar' => $request->status_liberar,
                'data_liberar' => $request->data_liberar,
                'data_fecha' => $request->data_final
            ]);
            session()->put('sucess', 'Tela Editada com Sucesso!');
            return redirect()->route('tela-unica-mostra', $id);
        }
    }
}
