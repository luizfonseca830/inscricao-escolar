@extends('layouts.app', ['activePage' => 'avaliacao', 'titlePage' => __('Typography')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/DataTables/datatables.min.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid" id="lista-table">
            <div class="w-100 text-center" id="loading">
                <img src="{{asset('assets/gifs/Spinner-1s-164px.gif')}}">
            </div>
            <div id="dataTables-lista" style="width: 100%" hidden>
                <table id="lista-pessoas">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Cargo</th>
                        <th>Status</th>
                        <th>Avaliar</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($pessoas as $pessoa)


                            <tr>
                                <td>{{$pessoa->id}}</td>
                                <td>{{$pessoa->nome_completo}}</td>
                                <td>{{$pessoa->cpf}}</td>
                                <td>{{$pessoa->cargo->cargo}}</td>
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
                                    <td class="text-info">Solicite Suporte Avaliação Incorreta</td>
                                @endif
                                <td>
                                    @if(is_null($pessoa->status_avaliado))
                                        <a href="{{route('/avaliar', $pessoa->id)}}" class="text-info"> {{--AVALIAR--}}
                                            <i class="fa fa-2x fa-user"></i>
                                        </a>
                                    @endif
                                    @if(!is_null($pessoa->status_avaliado) && is_null($pessoa->status) && ($pessoa->status_revisado == 0 && !is_null($pessoa->status_revisado))) {{--REAVALIAR--}}
                                    <a href="{{route('/avaliar', $pessoa->id)}}" class="text-info">
                                        <i class="fa fa-2x fa-user"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>

                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Cargo</th>
                        <th>Status</th>
                        <th>Avaliar</th>
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
    <script src="{{asset('js/area-restrita/lista-visualizacao.js')}}"></script>
@endsection
