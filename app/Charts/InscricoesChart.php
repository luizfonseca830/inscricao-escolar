<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\Cargo;
use App\Models\Escolaridade;
use App\Models\Pessoa;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class InscricoesChart extends BaseChart
{
    public ?string $name = 'chart_inscricao';
    public ?string $routeName = 'chart_inscricao';
    public ?string $prefix = 'some_prefix';
    public ?array $middlewares = ['auth'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {

        $cargos = Cargo::all();
        $escolaridades = Escolaridade::all();
        $nome_cargos = [];
        foreach ($cargos as $key => $cargo) {

            $nome_cargos[$key] = $cargo->cargo;
        }

        $nomes_escolaridade = [];
        $contador = array();
        $chart = Chartisan::build()->labels($nome_cargos);
        foreach ($cargos as $key => $cargo) {
            if (count($cargo->pessoas) != 0) {
                array_push($contador, count($cargo->pessoas));
            } else array_push($contador, 0);
        }
        $chart->dataset($cargo->cargo,$contador);
        return $chart;

    }
}
