@extends('layouts.app', ['activePage' => 'avaliacao-pne', 'titlePage' => __('avaliacao-pne')])
@section('css')
    <link rel="stylesheet" href="{{asset('css/area-restrita/avaliar.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <form id="formulario_registro" method="post" action="{{route('avaliacao-pne-recusar', $pessoa->id)}}">
                        @csrf
                        <ul id="progress">
                            <li class="ativo" style="width: 100%">Recusar PNE</li>
                        </ul>
                        <fieldset>
                            <h2>PNE - Recusar</h2>
                            <h3>Descrição do Motivo</h3>
                            <textarea name="motivo_recusar" id="comentario" rows="10" cols="30" placeholder="Descreva.."></textarea>

                            <p><small class="caracteres"></small></p>
                            <input type="submit" name="next" id="next" class="acao" style="background: red" value="Negar"/>
                            <a href="{{url()->previous()}}">
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
