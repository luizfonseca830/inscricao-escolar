@extends('layouts.app', ['activePage' => 'TelaLiberar', 'titlePage' => __('TelaLiberar')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">

@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <form id="formulario_registro" method="post" action="{{route('tela-editar', $tela->id)}}">
                        @csrf
                        <ul id="progress">
                            <li class="ativo" style="width: 100%">Editar</li>
                        </ul>

                        <fieldset>
                            <h2>Editar Tela</h2>
                            <h3>Tipo Tela</h3>
                            <input type="text" value="{{$tela->tipoTelas->tipo}}" name="tipo" disabled/>
                            @if ($tela->tipoTelas->id == 1)
                                <div id="tela">
                                    <p>Informe o nome da Tela</p>
                                    <input type="text" name="nome_ou_anexo" value="{{$tela->nome_ou_anexo}}"/>
                                </div>
                            @elseif($tela->tipoTelas->id == 2)
                                <div id="pdf">
                                    <p>Escolha o PDF</p>
                                    <select name="nome_ou_anexo">
                                        <option value="0">Não Selecionado</option>
                                        @foreach($arquivos as $arquivo)
                                            @if (substr($arquivo, 62) == $tela->nome_ou_anexo)
                                                <option value="{{substr($arquivo, 62)}}"
                                                        selected>{{substr($arquivo, 62)}}</option>
                                            @else
                                                <option value="{{substr($arquivo, 62)}}"
                                                >{{substr($arquivo, 62)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @elseif($tela->tipoTelas->id == 3)
                                <div id="tela">
                                    <p>Informe o nome da Tela</p>
                                    <input type="text" name="nome_ou_anexo" value="{{$tela->nome_ou_anexo}}"/>
                                </div>
                            @endif
                            <div id="liberar">
                                <p>Liberar tela</p>
                                <select id="status_liberar" name="status_liberar">
                                    @if ($tela->status_liberar == 1)
                                        <option value="1" selected>Sim</option>
                                    @else
                                        <option value="1">Sim</option>
                                    @endif
                                    @if ($tela->status_liberar == 0)
                                        <option value="0" selected>Não</option>
                                    @else
                                        <option value="0">Não</option>
                                    @endif
                                </select>
                            </div>
                            @if ($tela->status_liberar == 0)
                                <div id="data_liberar">
                                    <p>Selecione uma Data para liberar a Tela</p>
                                    @if(!is_null($tela->data_liberar) && !is_null($tela->data_fecha))
                                        <p><strong>Data Inicial: {{$tela->data_liberar}} - Até
                                                - {{$tela->data_fecha}}</strong></p>
                                    @endif
                                    <h3><strong>Data Inicial</strong></h3>
                                    <input type="datetime-local" id="input-data_liberar" name="data_liberar"
                                           value="{{date('d/m/Y H:i', strtotime($tela->data_liberar))}}">

                                    <h3><strong>Data Final</strong></h3>
                                    <input type="datetime-local" id="input-data_liberar" name="data_final"
                                           value="{{date('d/m/Y H:i', strtotime($tela->data_liberar))}}">
                                </div>
                            @else
                                <div id="data_liberar" hidden>
                                    <p>Selecione uma Data para liberar a Tela</p>
                                    <input type="date" id="input-data_liberar" name="data_liberar">
                                </div>
                            @endif
                            <input type="submit" name="next" id="confirma" class="acao" value="Editar"/>
                        </fieldset>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script>
        $('#tipo_tela').click(function () {
            if ($('#tipo_tela').val() == 1) {
                $('#tela').removeAttr('hidden');
                $('#pdf').attr('hidden', true);
            } else if ($('#tipo_tela').val() == 2) {
                $('#pdf').removeAttr('hidden');
                $('#tela').attr('hidden', true);
            }
        });

        $('#status_liberar').click(function () {
            if ($('#status_liberar').val() == 0) {
                $('#data_liberar').removeAttr('hidden');
            } else {
                $('#data_liberar').attr('hidden', true);
                $('#input-data_liberar').val('null');
            }
        });
    </script>
@endsection
