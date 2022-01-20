@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('DashBoard')])
@extends('layouts.modal-message')
@section('content')
    <div class="content content-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon" style="background-color: #ffa726">
                                <i class="material-icons">content_copy</i>
                            </div>
                            <p class="card-category">Total de Inscrições</p>
                            <h3 class="card-title">{{$inscricao_total}}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon" style="background-color: #26c6da">
                                <i class="material-icons">content_copy</i>
                            </div>
                            <p class="card-category">Total de Avaliações</p>
                            <h3 class="card-title">{{$avaliacao_total}}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon" style="background-color: #ef5350">
                                <i class="material-icons">content_copy</i>
                            </div>
                            <p class="card-category">Total de Recursos</p>
                            <h3 class="card-title">{{$recurso_total}}</h3>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
            <!-- GRAFICOS -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon" style="background-color: #66bb6a">
                                <i class="material-icons">insert_chart</i>
                            </div>
                            <h3 class="card-title">Inscrições por cargo</h3>
                        </div>
                        <div class="card-footer justify-content-center">
                            <!-- Chart's container -->
                            <div id="inscricao" style="width: 100%; height: 260px"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon" style="background-color: #ab47bc">
                                <i class="material-icons">insert_chart</i>
                            </div>
                            <h3 class="card-title">Avaliação por cargo</h3>
                        </div>
                        <div class="card-footer justify-content-center">
                            <!-- Chart's container -->
                            <div id="avaliacao" style="width: 100%; height: 260px"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon" style="background-color: #26c6da">
                                <i class="material-icons">insert_chart</i>
                            </div>
                            <h3 class="card-title">Recurso por cargo</h3>
                        </div>
                        <div class="card-footer justify-content-center">
                            <!-- Chart's container -->
                            <div id="recurso" style="width: 100%; height: 260px"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script>
        const incricao = new Chartisan({
            el: '#inscricao',
            url: "@chart('chart_inscricao')",
            hooks: new ChartisanHooks()
                .datasets('doughnut')
                .pieColors(),
        });

        const avaliacao = new Chartisan({
            el: '#avaliacao',
            url: "@chart('chart_avaliacao')",
            hooks: new ChartisanHooks()
                .datasets('doughnut')
                .pieColors(),
        });

        const recurso = new Chartisan({
            el: '#recurso',
            url: "@chart('chart_recurso')",
            hooks: new ChartisanHooks()
                .datasets('doughnut')
                .pieColors(),
        });

    </script>
@endsection
