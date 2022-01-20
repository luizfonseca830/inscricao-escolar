@extends('layouts.app', ['activePage' => 'lista_participantes', 'titlePage' => __('Lista Candidatos')])
@extends('layouts.modal-message')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/area-restrita/lista.css')}}">
    {{--    <style>--}}
    {{--        .bmd-form-group {}--}}
    {{--    </style>--}}
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col col-12">
                <div class="card w-100">
                    <form method="post" action="{{route('lista.candidatos.filtro')}}">
                        @csrf
                        <div class="card-body">
                            <h5 class="font-weight-bold">FILTRO</h5>
                            <hr>
                            <div class="row">
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label for="cargo" class="text-dark">CARGO</label>
                                        <select class="custom-select" name="cargo_id" id="cargo">
                                            @foreach($cargos as $item)
                                                <option value="{{$item->id}}">{{$item->cargo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col col-6">
                                    <div class="form-group">
                                        <label for="nome_candidato" class="text-dark">NOME CANDIDATO</label>
                                        <input type="text" class="form-control" id="nome_candidato" name="nome_candidato">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <input type="submit" class="btn btn-outline-info" value="BUSCAR">
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col col-12">
                <div class="card" id="dataTables-lista" style="width: 100%; padding: 20px">
                    <table id="data-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pessoas as $key=>$pessoa)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$pessoa->nome_completo}}</td>
                                <td>{{$pessoa->cpf}}</td>
                                @if(is_null($pessoa->status_avaliado))
                                    <td class="text-warning">Aguardando Avaliação</td>
                                @elseif(!is_null($pessoa->status_avaliado) && is_null($pessoa->status) && is_null($pessoa->status_revisado))
                                    <td class="text-warning">Aguardando Revisão</td>
                                @elseif(!is_null($pessoa->status_avaliado) && is_null($pessoa->status) && $pessoa->status_revisado == 0)
                                    <td class="text-warning">Aguardando Reavaliação</td>
                                @elseif($pessoa->status_avaliado == 1 && $pessoa->status == 1 && $pessoa->status_revisado == 1)
                                    <td class="text-success">Aprovado</td>
                                @elseif($pessoa->status_avaliado == 0 && $pessoa->status == 0 && $pessoa->status_revisado == 0)
                                    <td class="text-danger">Reprovado</td>
                                @elseif(is_null($pessoa->status_avaliado) || is_null($pessoa->status) || is_null($pessoa->status_revisado) || ($pessoa->status_avaliado)==0 || ($pessoa->status)==0 || ($pessoa->status_revisado)==0)
                                    <td class="text-info">Avaliação Incorreta retorna a tela de avaliação</td>
                                @endif
                                <td>
                                    <a href="{{route('lista.candidatos.devolverAvaliacao', $pessoa->id)}}" class="text-info">Devolver para avaliação</a>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/lista-candidatos/lista.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.form-group').odd().removeClass('bmd-form-group')
        })
    </script>
@endpush
