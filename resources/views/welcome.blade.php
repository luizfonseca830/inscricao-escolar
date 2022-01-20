@extends('layouts.header-footer')
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>
        button {
            border: none;
            width: 100%;
        }
    </style>
@endsection
@section('content')
{{--    @extends('layouts.modal-cache')--}}
    <section class="container-fluid">
        <div class="row justify-content-center">
            <div id="carouselExampleIndicators" class="carousel slide w-100 text-center" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach($carrossels as $carrossel)
                        <div class="carousel-item active">
                            <a href="{{is_null($carrossel->url_link) ? '#' : $carrossel->url_link}}" target="_blank">
                                <img class="container" src="{{asset('storage/'.$carrossel->url_img)}}" alt="First slide" style="width: 100%;">
                            </a>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>


        </div>
    </section>

    <main id="main">
        <!-- ======= Featured Section ======= -->
        <section id="featured" class="featured">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Processos Seletivos</h2>
                </div>
                <div class="row justify-content-md-center">
                    @foreach($inscricoes as $inscricao)
                        @if (($inscricao->status_liberar == '1' || !is_null($inscricao->data_liberar)) && (is_null($inscricao->data_fecha) || strtotime($inscricao->data_fecha) > strtotime(date('Y-m-d H:i'))))
                            @if (($inscricao->status_liberar == 1) || strtotime($inscricao->data_liberar) <= strtotime(date('Y-m-d H:i')))
                                <div class="col-lg-4 mt-3">
                                    <a href="{{route('registro', $inscricao->id)}}">
                                        <button class="icon-box" style="height: 250px">
                                            <i class="icofont-plus"></i>
                                            <h3>{{$inscricao->nome_ou_anexo}}</h3>
                                        </button>
                                    </a>
                                </div>
                            @endif
                        @endif
                    @endforeach
                    @if(!is_null($protocolo))
                        @if ($protocolo->status_liberar == '1' || !is_null($protocolo->data_liberar) )
                            @if ($protocolo->nome_ou_anexo == 'Protocolo' && ($protocolo->status_liberar == 1) || strtotime($protocolo->data_liberar) <= strtotime(date('Y-m-d H:i')))
                                <div class="col-lg-4 mt-4 mt-lg-0">
                                    <a href="{{route('protocolo')}}">
                                        <button class="icon-box">
                                            <i class="icofont-ui-note"></i>
                                            <h3>Buscar Protocolo</h3>
                                        </button>
                                    </a>
                                </div>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </section><!-- End Featured Section -->
        @if(!is_null($recurso))
            @if ($recurso->status_liberar == '1' || !is_null($recurso->data_liberar) )
                @if ($recurso->nome_ou_anexo == 'Recurso' && ($recurso->status_liberar == 1) || strtotime($recurso->data_liberar) <= strtotime(date('Y-m-d H:i')))
                    <section id="featured" class="featured">
                        <div class="container">
                            <div class="section-title" data-aos="fade-up">
                                <h2>Recurso</h2>
                            </div>
                            <div class="row justify-content-md-center">

                                <div class="col-lg-4 mt-4 mt-lg-0">
                                    <a href="{{route('recurso')}}">
                                        <button class="icon-box">
                                            <i class="icofont-tasks-alt"></i>
                                            <h3>Recurso</h3>
                                        </button>
                                    </a>

                                </div>

                            </div>
                        </div>
                    </section><!-- End Featured Section -->
            @endif
        @endif
    @endif

    <!-- ======= Services Section ======= -->
        <section id="services" class="services ">
            <div class="container">
                <div class="section-title" data-aos="fade-up">
                    <h2>Editais</h2>
                </div>
                <div class="row justify-content-center">
                    {{--                    @dd($pdfs)--}}
                    @foreach($pdfs as $pdf)
                        {{--                        @dd($pdf)--}}
                        @if ( ($pdf->status_liberar == '1' || !is_null($pdf->data_liberar)) && (is_null($pdf->data_fecha) || strtotime($pdf->data_fecha) > strtotime(date('Y-m-d H:i'))))
                            @if (($pdf->status_liberar == '1') || strtotime($pdf->data_liberar) <= strtotime(date('Y-m-d H:i')))
                                <div class="col-lg-4 col-md-4  align-items-stretch mt-2">
                                    <a href="{{asset('anexos/'.$pdf->nome_ou_anexo)}}" target="_blank">
                                        <button class="icon-box">
                                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                                            <h4>{{$pdf->nome_anexo_mostrar}}</h4>
                                            <p>Clique aqui para baixar</p>
                                        </button>
                                    </a>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </section><!-- End Services Section -->

    </main>
@endsection

@section('script')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
@endsection
