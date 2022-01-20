@extends('layouts.header-footer')

@section('title')
    <title>SEINFRA - REGISTRO</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/comprovante.css')}}"/>
@endsection
<!-- -->
@section('content')
    <main class="container">
        <h1>Comprovante de Inscrição: </h1>
        <hr>
        <div class="card">
            <div class="card-body text-center">
                <div>
                    <div class="row">
                        <div class="col col-md-6 text-left">
                            <h4>Número de protocolo: <label class="text-info">{{$comprovante}}</label></h4>
                            <p class="text-info">Verificar a caixa de spam e lixeira.</p>
                        </div>
                        <div class="col col-md-6 text-right">
                            <a href="{{route('gerarpdf-comprovante', $comprovante)}}" target="_blank">Download Do Comprovante de Inscrição</a>
                        </div>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9 mt-4">
                        <iframe class="embed-responsive-item" src="{{route('gerarpdf-comprovante', $comprovante)}}" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@section('script')

@endsection
