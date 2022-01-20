<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Http\Requests\Recurso;
use App\Models\Cargo;
use App\Models\Escolaridade;
use App\Models\Pessoa;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class RecursoChart extends BaseChart
{
    public ?string $name = 'chart_recurso';
    public ?string $routeName = 'chart_recurso';
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
        $nome_cargos = [];
        foreach ($cargos as $key => $cargo) {

            $nome_cargos[$key] = $cargo->cargo;
        }

        $contador = array();
        $chart = Chartisan::build()->labels($nome_cargos);
        foreach ($cargos as $key => $cargo) {
            if (count($cargo->pessoas) != 0) {
                $contador_recurso = 0;
                foreach ($cargo->pessoas as $pessoa){
                    if(!is_null($pessoa->recurso)){
                        $contador_recurso++;
                    }
                }
                array_push($contador, $contador_recurso);
            } else array_push($contador, 0);
        }
        $chart->dataset($cargo->cargo,$contador);
        return $chart;
    }
}
