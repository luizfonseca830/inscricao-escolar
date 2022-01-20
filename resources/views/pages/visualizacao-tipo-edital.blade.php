@extends('layouts.app', ['activePage' => 'avaliacao', 'titlePage' => __('Typography')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/icofont/icofont/icofont.min.css')}}">
@endsection
@section('content')
    <section id="services" class="services" style="margin-top: 50px; padding: 30px; ">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <h3>Selecionar um Edital</h3>
                </div>
                <div class="row">
                    @foreach($editalDinamicos as $editalDinamico)
                        <div class="col-lg-4  mt-4">
                            <a href="{{route('/visualizacao', $editalDinamico->id)}}" style="width: 100%">
                                <div class="card">
                                    <button class="icon-box" style="height: 250px; border: none; ">
                                        <div class="icon"><i class="bx-menu"></i></div>
                                        <p>{{$editalDinamico->telasedital->nome_ou_anexo}}</p>
                                    </button>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
@endsection
