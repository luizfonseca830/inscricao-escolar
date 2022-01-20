<?php

namespace App\Providers;

use App\Charts\AvaliacaoRevisaoChart;
use App\Charts\AvaliacoesChart;
use App\Charts\InscricoesChart;
use App\Charts\RecursoChart;
use App\Charts\RevisaoChart;
use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        //
        $charts->register([
            InscricoesChart::class,
            RecursoChart::class,
            AvaliacoesChart::class,
        ]);
    }
}
