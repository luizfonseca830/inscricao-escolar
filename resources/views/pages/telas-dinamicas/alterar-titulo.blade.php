@extends('layouts.app', ['activePage' => 'TituloAlterar', 'titlePage' => __('TituloAlterar')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">

@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <form id="formulario_registro" method="post" action="{{route('titulo.update', $title->id)}}">
                        @csrf
                        <ul id="progress">
                            <li class="ativo" style="width: 100%">Título</li>
                        </ul>

                        <fieldset>
                            <div id="tela">
                                <p>Alterar título</p>
                                <input type="text" name="titulo" value="{{$title->titulo}}" placeholder="Informe o título"/>
                            </div>
                            @error('titulo')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <input type="submit" name="next" id="confirma" class="acao" value="Criar"/>
                        </fieldset>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
@endsection
