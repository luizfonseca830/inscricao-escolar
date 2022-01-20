<?php

namespace App\Http\Controllers;

use App\Exports\ResultadoExport;
use App\Http\Controllers\Jasper\JasperController;
use App\Http\Requests\RelatorioRequest;
use App\Models\Cargo;
use App\Models\Carrossel;
use App\Models\EditalDinamico;
use App\Models\Escolaridade;
use App\Models\Pessoa;
use App\Models\Progress;
use App\Models\TipoAnexoCargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class RelatoriosController extends Controller
{
    //
    private $listaDoMultiSelect = [
        0 => ['nome' => 'NOME', 'selecionado' => 1],
        1 => ['nome' => 'CPF', 'selecionado' => 1],
        2 => ['nome' => 'CARGO', 'selecionado' => 1],
        3 => ['nome' => 'ESCOLARIDADE', 'selecionado' => 1],
        4 => ['nome' => 'PONTUAÇÃO PÚBLICA', 'selecionado' => 0],
        5 => ['nome' => 'PONTUAÇÃO PRIVADA', 'selecionado' => 0],
        6 => ['nome' => 'PNE', 'selecionado' => 1],
        7 => ['nome' => 'PONTUAÇÃO', 'selecionado' => 1],
        8 => ['nome' => 'STATUS', 'selecionado' => 1],
        9 => ['nome' => 'MOTIVO DE RECUSAR', 'selecionado' => 0],
    ];

    public function selecionarEdital()
    {
        $editalDinamicos = EditalDinamico::all();
        return view('pages.relatorio.relatorio-tipo-edital', compact('editalDinamicos'));
    }

    public function index($id)
    {

        if (Auth::user()->tipo != 'Admin') {
            session()->put('error', 'Você não tem permissão para acessar essa página!');
            return redirect()->route('home');
        }


        $pessoas = Pessoa::where('edital_dinamico_id', $id)->get();
        $editalDinamico = EditalDinamico::findOrFail($id);
        $cargos = Cargo::all();
        $niveisEscolaridades = Escolaridade::all();
        $listaDoMultiSelect = $this->listaDoMultiSelect;
        return view('pages.relatorio.relatorios', compact('pessoas', 'cargos', 'niveisEscolaridades', 'editalDinamico', 'listaDoMultiSelect'));
    }

    public function gerarRelatorio(RelatorioRequest $request)
    {
        //TIPO
        //1 = TABELA | 2  = PDF | 3 = execel
        $tipo = $request->tipo;
        //
        $cargos = Cargo::all();
        $niveisEscolaridades = Escolaridade::all();
        $editalDinamico = EditalDinamico::findOrFail($request->editalDinamicoID);
        $listaDoMultiSelect = $this->listaDoMultiSelect;
        //VERIFICAR SE TODOS ESTÃO VAZIOS
        if (is_null($request->cargoID) && is_null($request->escolaridadeID) && is_null($request->status)) {
            if (!is_null($request->titulo)) {
                $titulo = $request->titulo;
            } else $titulo = 'Processo Seletivo Simplificado ' . date('Y');
            if ($tipo == 1) {
                $pessoas = $this->gerarTodasPessoas($request);
                return view('pages.relatorio.relatorios', compact('pessoas', 'cargos', 'niveisEscolaridades', 'editalDinamico', 'listaDoMultiSelect'));
            } else if ($tipo == 2) {
                $pessoas = $this->gerarPessoasS($request, 0);
                $pessoasPNE = $this->gerarPessoasS($request, 0);
                view()->share(['pessoas', $pessoas, 'pessoasPNE', $pessoasPNE]);
                $listaParaCarregar = $request->constructorPDFIsExcel;
                $pdf = PDF::loadView('pdf_view', compact('pessoas', 'titulo', 'pessoasPNE', 'listaParaCarregar'));
                return $pdf->download('pdf_file.pdf');
            } else {
                $pessoas = $this->gerarPessoasS($request, 0);
                $pessoasPNE = $this->gerarPessoasS($request, 0);

                $carrossel = Carrossel::all()->last();
                $listaParaCarregar = $request->constructorPDFIsExcel;
                return $this->export($pessoas, $pessoasPNE, 'GERADO_EXECEL', $carrossel, $listaParaCarregar);
            }
        }
        if ($tipo == 1) {
            $pessoas = $this->gerarTodasPessoas($request);
            return view('pages.relatorio.relatorios', compact('pessoas', 'cargos', 'niveisEscolaridades', 'editalDinamico', 'listaDoMultiSelect'));
        } // GENERATE PDF
        else if ($tipo == 2) {
            $pessoas = $this->gerarPessoasS($request, 0);
            $pessoasPNE = $this->gerarPessoasS($request, 1);

            $carrossel = Carrossel::all()->last();
            if (!$request->show_pne) $pessoasPNE = null;
            if (!is_null($request->titulo)) {
                $titulo = $request->titulo;
            } else $titulo = 'Processo Seletivo Simplificado ' . date('Y');
            $listaParaCarregar = $request->constructorPDFIsExcel;
            view()->share('pessoas', $pessoas);
            $pdf = PDF::loadView('pdf_view', compact('pessoas', 'titulo', 'pessoasPNE', 'carrossel', 'listaParaCarregar'));
            return $pdf->download('pdf_file.pdf');

        } else {
            $pessoas = $this->gerarPessoasS($request, 0);
            $pessoasPNE = $this->gerarPessoasS($request, 1);
            $carrossel = Carrossel::all()->last();
            if (!$request->show_pne) $pessoasPNE = null;
            if (!is_null($request->titulo)) {
                $titulo = $request->titulo;
            } else $titulo = 'Gerado_' . date('Y');
            $listaParaCarregar = $request->constructorPDFIsExcel;
            return $this->export($pessoas, $pessoasPNE, $titulo, $carrossel, $listaParaCarregar);
        }
    }

    public function requestPDFJasper(Request $request)
    {
        $file = JasperController::index($request->cargo, $request->deferimento);
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->download($file, $request->cargo . '.pdf', $headers);
    }

    public function visualizar($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        $edital_dinamico_id = !is_null($pessoa->pessoaEditalAnexos->first()) ? $pessoa->pessoaEditalAnexos->first()->edital_dinamico_id : null;
        $progress = Progress::where('edital_dinamico_id', $edital_dinamico_id)->get();
        $tipoAnexoCargo = TipoAnexoCargo::where('cargo_id', $pessoa->cargo_id)->get();
        $progressQuantiadePorcento = 100 / ($tipoAnexoCargo->count() + 2);

        return view('pages.relatorio-unico', compact('pessoa', 'progressQuantiadePorcento', 'progress', 'tipoAnexoCargo'));
    }

    public function export($pessoas, $pessoasPNE, $titulo, $carrossel, $listaParaCarregar)
    {
        $resultadoExport = new ResultadoExport($pessoas, $pessoasPNE, $titulo, $carrossel, $listaParaCarregar);
        return Excel::download($resultadoExport, 'resultado.xlsx');
    }

    public function gerarPessoasS(Request $request, $status)
    {
        if (!is_null($request->cargoID)) {
            $pessoas = Pessoa::where('cargo_id', $request->cargoID);
            if (!is_null($request->escolaridadeID)) {
                $pessoas->where('escolaridade_id', $request->escolaridadeID);
            }
            if (!is_null($request->status)) {
                $pessoas->where('status', $request->status);
            }
        } else if (!is_null($request->escolaridadeID)) {
            $pessoas = Pessoa::where('escolaridade_id', $request->escolaridadeID);
            if (!is_null($request->cargoID)) {
                $pessoas = Pessoa::where('cargo_id', $request->cargoID);
            }
            if (!is_null($request->status)) {
                $pessoas->where('status', $request->status);
            }
        } else if (!is_null($request->status)) {
            $pessoas = Pessoa::where('status', $request->status);
            if (!is_null($request->cargoID)) {
                $pessoas = Pessoa::where('cargo_id', $request->cargoID);
            }
            if (!is_null($request->escolaridadeID)) {
                $pessoas = Pessoa::where('escolaridade_id', $request->escolaridadeID);
            }
        }

        //caso não exista filtro
        if(!isset($pessoas)){
            $pessoas = new Pessoa();
        }
        $pessoas->with('pontuacao2')->where('portador_deficiencia', $status);

        $pessoas = $pessoas->get()->sortBy([
            ['pontuacao2.pontuacao_total', 'desc'],
            ['data_nascimento', 'asc']
        ]);
        return $pessoas;
    }

    public function gerarTodasPessoas(Request $request)
    {
        if (!is_null($request->cargoID)) {
            $pessoas = Pessoa::where('cargo_id', $request->cargoID);
            if (!is_null($request->escolaridadeID)) {
                $pessoas->where('escolaridade_id', $request->escolaridadeID);
            }
            if (!is_null($request->status)) {
                $pessoas->where('status', $request->status);
            }
        } else if (!is_null($request->escolaridadeID)) {
            $pessoas = Pessoa::where('escolaridade_id', $request->escolaridadeID);
            if (!is_null($request->cargoID)) {
                $pessoas = Pessoa::where('cargo_id', $request->cargoID);
            }
            if (!is_null($request->status)) {
                $pessoas->where('status', $request->status);
            }
        } else if (!is_null($request->status)) {
            $pessoas = Pessoa::where('status', $request->status);
            if (!is_null($request->cargoID)) {
                $pessoas = Pessoa::where('cargo_id', $request->cargoID);
            }
            if (!is_null($request->escolaridadeID)) {
                $pessoas = Pessoa::where('escolaridade_id', $request->escolaridadeID);
            }
        }

        if(!isset($pessoas)){
            $pessoas = new Pessoa();
        }
        $pessoas->where('edital_dinamico_id', $request->editalDinamicoID);
        $pessoas = $pessoas->get();
        return $pessoas;
    }
}
