@extends('layouts.app', ['activePage' => 'recurso', 'titlePage' => __('Recurso')])

@section('css')
    <link rel="stylesheet" href="{{asset('css/area-restrita/avaliar.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <form id="formulario_registro" method="post" action="{{route('recurso-recusar')}}">
                        @csrf
                        <ul id="progress">
                            <li class="ativo" style="width: 100%">Recurso</li>
                        </ul>
                        @if(session()->has('error'))
                            <div class="alert alert-danger">{{session('error')}}</div>
                            {{session()->forget('error')}}
                        @endif
                        @if (session()->has('sucess'))
                            <div class="alert alert-success">{{session('sucess')}}</div>
                            {{session()->forget('sucess')}}
                        @endif
                        <fieldset>
                            <h2>Recurso - Recusar</h2>
                            <h3>Descrição do Motivo</h3>
                            <input type="number" name="recurso_id" value="{{$recurso->id}}" hidden/>
                            <textarea name="motivo_recusar" id="comentario" rows="10" cols="30" placeholder="Descreva.."></textarea>
                            @error('comentario')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <p><small class="caracteres"></small></p>
                            <input type="submit" name="next" id="next" class="acao" style="background: red" value="Recusar"/>
                            <a  href="{{url()->previous()}}">
                                <input type="button" name="prev" id="prev" class="acao" value="Anterior"/>
                            </a>
                        </fieldset>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/contador.js')}}"></script>
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('js/registro/function.js')}}"></script>
@endsection
