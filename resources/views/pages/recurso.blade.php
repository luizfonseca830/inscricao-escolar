@extends('layouts.app', ['activePage' => 'recurso', 'titlePage' => __('Recurso')])
@extends('layouts.modal-message')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/area-restrita/lista.css')}}">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid" id="lista-table">
            <div class="w-100 text-center" id="loading">
                <img src="{{asset('assets/gifs/Spinner-1s-164px.gif')}}">
            </div>

            <div id="dataTables-lista" style="width: 100%" hidden>
                <table id="lista-recurso">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Cargo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recursos as $recurso)
                        @if($recurso->pessoa->edital_dinamico_id == $editalDinamicoID)
                            <tr>
                                <td>{{$recurso->id}}</td>
                                <td>{{$recurso->pessoa->nome_completo}}</td>
                                <td>{{$recurso->pessoa->cpf}}</td>
                                <td>{{$recurso->pessoa->cargo->cargo}}</td>
                                @if(!is_null($recurso->status))
                                    @if($recurso->status == 1)
                                        <td class="text-success">Recurso enviado para avaliação</td>
                                    @else
                                        <td class="text-warning">Recurso Negado</td>
                                    @endif
                                @else
                                    <td class="text-warning">Aguardando Revisão do Recurso</td>
                                @endif
                                <td>
                                    @if(is_null($recurso->status))
                                        <a href="{{route('recurso-unico', $recurso->pessoa->id)}}">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Cargo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>


@endsection
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/area-restrita/lista-recurso.js')}}"></script>
@endsection
