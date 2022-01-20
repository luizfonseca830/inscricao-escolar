@extends('layouts.app', ['activePage' => 'list_formulario_ativo', 'titlePage' => __('list_formulario_ativo')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/area-restrita/lista.css')}}">

@endsection
@section('content')
    <div class="content">
           <div class="container-fluid"  id="lista-table">
            <main class="container">
                <table id="lista-formulario">
                    <div class="row">
                        <div class="w-100 text-center" id="loading">
                            <img src="{{asset('assets/gifs/Spinner-1s-164px.gif')}}">
                        </div>
                        <div id="dataTables-lista" hidden>
                            <div class="float-right">
                                <input type="button" class="btn btn-sm btn-outline-info mb-3" value="Novo Anexo"
                                       data-toggle="modal" data-target="#storeEditalDinamicoAnexo">
                                <input type="button" class="btn btn-sm btn-outline-info mb-3" value="Novo Título"
                                       data-toggle="modal" data-target="#storeTitulo">
                            </div>
                            <table id="lista-configuracoes" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Nome do Documento</th>
                                    <th>Cargo</th>
                                    <th>Tipo de Documento</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($editalAnexos as $editalAnexo)
                                    @if (!is_null($editalAnexo->documentoDinamico))
                                        <tr>
                                            <td>{{$editalAnexo->documentoDinamico->nome_documento}}</td>
                                            <td>{{$editalAnexo->cargo->cargo}}</td>
                                            <td>{{$editalAnexo->tipoAnexo->tipo}}</td>
                                            <td>
                                                <a id="edita-anexo" data-id="{{$editalAnexo->id}}"
                                                   data-nome="{{$editalAnexo->documentoDinamico->nome_documento}}"
                                                   data-EditalDinamico="{{$editalAnexo->documentoDinamico->id}}"
                                                   data-cargo="{{$editalAnexo->cargo->id}}"
                                                   data-tipo-documento="{{$editalAnexo->tipoAnexo->id}}"
                                                   data-obrigatorio="{{$editalAnexo->documentoDinamico->obrigatorio}}"
                                                   data-inserir-publica-privada="{{$editalAnexo->documentoDinamico->pontuar_publica_privada}}"
                                                   data-pontuacao-maxima="{{$editalDinamico->telasEdital->pontuacao_total}}"
                                                   data-pontuacao_maxima_item="{{$editalAnexo->documentoDinamico->pontuacao_maxima_item}}"
                                                   data-pontuacao-item="{{$editalAnexo->documentoDinamico->pontuacao_por_item}}"
                                                   data-quantidade-anexo="{{$editalAnexo->documentoDinamico->quantidade_anexos}}"
                                                   data-tipo-experiencia="{{$editalAnexo->documentoDinamico->tipo_experiencia}}"
                                                   data-pontuacao-por-ano="{{$editalAnexo->documentoDinamico->pontuacao_por_ano}}"
                                                   data-pontuacao-mes="{{$editalAnexo->documentoDinamico->pontuacao_por_mes}}"
                                                   data-pontuar-manual="{{$editalAnexo->documentoDinamico->pontuar_manual}}">
                                                    <i class="fas fa-edit mr-2 text-info"></i>
                                                </a>
                                                <a href="javascript:void(0);"
                                                   data-action="{{route('documento.dinamico.delete', $editalAnexo->documentoDinamico->id)}}"
                                                   class="delete_item_sweet">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Nome do Documento</th>
                                    <th>Cargo</th>
                                    <th>Tipo de Documento</th>
                                    <th>Ações</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </table>
            </main>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/area-restrita/lista-configuraoes.js')}}"></script>
    <script src="{{asset('js/area-restrita/criar-configuracao-anexo.js')}}"></script>
@endpush

@include('pages.lista-inscricoes.configuracoes.modal')
@include('pages.lista-inscricoes.configuracoes.modal-titulo')
@include('pages.lista-inscricoes.configuracoes.edita')
