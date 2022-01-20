@extends('layouts.app', ['activePage' => 'list_formulario_ativo', 'titlePage' => __('list_formulario_ativo')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/area-restrita/lista.css')}}">

@endsection
@section('content')
    <div class="content">
        <div class="container-fluid" id="lista-table">
            <main class="container">
                <table id="lista-formulario">
                    <div class="row">
                        <div class="w-100 text-center" id="loading">
                            <img src="{{asset('assets/gifs/Spinner-1s-164px.gif')}}">
                        </div>
                        <div id="dataTables-lista" hidden>
                            <div class="float-right">
                                <input type="button" class="btn btn-sm btn-outline-info mb-3" value="Nova Escolaridade"
                                       data-toggle="modal" data-target="#storeEscolaridade">
                            </div>
                            <table id="lista-escolaridade" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Nivel Escolaridade</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($escolaridades as $escolaridade)
                                    <tr>
                                        <td>{{$escolaridade->nivel_escolaridade}}</td>
                                        <td>
                                            @if(is_null($escolaridade->escolaridadeEditalDinamico($editalDinamico->id, $escolaridade->id)))
                                                <label class="text-danger">Não ativado</label>
                                            @else
                                                <label class="text-success">Ativado no Edital</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('escolaridade.edital.dinamico', [$editalDinamico->id, $escolaridade->id])}}">
                                                <i class="far fa-check-circle text-info mr-2"></i>
                                            </a>
                                            <a href="{{route('escolaridade.edital.dinamico.remover', [$editalDinamico->id, $escolaridade->id])}}">
                                                <i class="fas fa-minus-circle text-danger mr-2"></i>
                                            </a>
                                            @if(!is_null($escolaridade->escolaridadeEditalDinamico($editalDinamico->id, $escolaridade->id)))
                                                <a href="{{route('escolaridade.edital.cargo', [$editalDinamico->id, $escolaridade->id])}}">
                                                    <i class="fas fa-briefcase text-info mr-2"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Nivel Escolaridade</th>
                                    <th>Status</th>
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
    <script src="{{asset('js/area-restrita/lista-escolaridade.js')}}"></script>
@endpush

@include('pages.lista-inscricoes.escolaridades.modal')
