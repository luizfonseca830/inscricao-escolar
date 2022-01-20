@extends('layouts.app', ['activePage' => 'transparencia', 'titlePage' => __('Transparencia')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/recurso/style.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <form id="formulario_registro" method="post" action="{{route('recurso-pedir')}}">
                        @csrf
                        <ul id="progress">
                            <li class="ativo" style="width: 100%">Transparência</li>
                        </ul>

                        <fieldset>
                            <h2>Transparência</h2>
                            <p>Nome do Instrutor</p>
                            <input type="text" value="{{$transparencia->instrutor->name}}" disabled/>
                            <p>Nome do Inscrito</p>
                            <input type="text" value="{{$transparencia->pessoa->nome_completo}}" disabled/>
                            <p>Tela</p>
                            <input type="text" value="{{$transparencia->tela}}" disabled/>
                            <p>Data e Hora</p>
                            <input type="text" value="{{$transparencia->created_at}}" disabled/>
                            @if(!is_null($transparencia->pontuacao_total_anexos))
                                <p>Pontuação Total Anexo Aplicada</p>
                                <input type="text" value="{{$transparencia->pontuacao_total_anexos}}" disabled/>
                            @endif
                            @if(!is_null($transparencia->pontuacao_total_publica))
                                <p>Pontuação Total Publica Aplicada</p>
                                <input type="text" value="{{$transparencia->pontuacao_total_publica}}" disabled/>
                            @endif
                            @if(!is_null($transparencia->pontuacao_total_privada))
                                <p>Pontuação Total Privada Aplicada</p>
                                <input type="text" value="{{$transparencia->pontuacao_total_privada}}" disabled/>
                            @endif
                            @if(!is_null($transparencia->pontuacao_total))
                                <p>Pontuação Total Aplicada</p>
                                <input type="text" value="{{$transparencia->pontuacao_total}}" disabled/>
                            @endif
                            @if(!is_null($transparencia->motivo))
                                <p>Motivo</p>
                                <input type="text" value="{{$transparencia->motivo}}" disabled/>
                            @endif
                            <a  href="{{url()->previous()}}">
                                <input type="button" name="prev" id="prev" class="acao" value="Voltar"/>
                            </a>
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
