<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use phpDocumentor\Reflection\Types\This;

class ResultadoExport implements FromView
{

    /**
    * @return \Illuminate\Support\Collection
    */
    private $pessoas;
    private $pessoasPNE;
    private $titulo;
    private $carrossel;
    private $listaParaCarregar;
    /**
     * @param $pessoas
     * @param $pessoasPNE
     */
    public function __construct($pessoas, $pessoasPNE, $titulo, $carrossel, $listaParaCarregar)
    {
        $this->pessoas = $pessoas;
        $this->pessoasPNE = $pessoasPNE;
        $this->titulo = $titulo;
        $this->carrossel = $carrossel;
        $this->listaParaCarregar = $listaParaCarregar;
    }

    public function view() : View
    {
        $pessoas = $this->pessoas;
        $pessoasPNE = $this->pessoasPNE;
        $titulo = $this->titulo;
        $carrossel = $this->carrossel;
        $listaParaCarregar = $this->listaParaCarregar;
        $excel = true;
        return view('pdf_view', compact('pessoas', 'pessoasPNE', 'titulo', 'carrossel', 'excel', 'listaParaCarregar'));
    }
}
