@extends('layouts.app', ['activePage' => 'list_formulario_ativo', 'titlePage' => __('list_formulario_ativo')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container">
                <table id="lista-formulario">
                    <div class="row">
                        <div class="w-100 text-center" id="loading">
                            <img src="{{asset('assets/gifs/Spinner-1s-164px.gif')}}">
                        </div>
                        <div id="dataTables-lista">
                            <div class="float-right">
                                <input type="button" class="btn btn-sm btn-outline-info mb-3" value="Novo Cargo"
                                       data-toggle="modal" data-target="#storeCargo">
                            </div>
                            <table id="lista-cargo" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Escolaridade</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cargos as $cargo)
                                    <tr>
                                        <td>{{$cargo->cargo}}</td>
                                        <td>{{$cargo->escolaridade->nivel_escolaridade}}</td>
                                        <td>
                                            <a id="edita-cargo" data-id="{{$cargo->id}}"
                                               data-nome="{{$cargo->cargo}}"
                                               data-escolaridadeEditalDinamico="{{$cargo->escolaridadeEditalDinamico->id}}">
                                                <i class="fas fa-edit mr-2 text-info"></i>
                                            </a>
                                            <a href="javascript:void(0);"
                                               data-action="{{route('cargo.delete', $cargo->id)}}"
                                               class="delete_item_sweet">
                                                <i class="fas fa-trash mr-2 text-danger"></i>
                                            </a>
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
@include('pages.lista-inscricoes.escolaridades.cargos.modal')
@include('pages.lista-inscricoes.escolaridades.cargos.edita')

@push('js')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/area-restrita/lista-cargo.js')}}"></script>
@endpush


