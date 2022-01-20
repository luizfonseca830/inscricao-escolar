@extends('layouts.app', ['activePage' => 'transparencia', 'titlePage' => __('Transparencia')])
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
                <table id="lista-pessoas">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Instrutor</th>
                        <th>Avaliado</th>
                        <th>Tela</th>
                        <th>Detalhes</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transparencias as $transparencia)
                        @if($transparencias->count() != 0)
                            <tr>
                                <td>{{$transparencia->id}}</td>
                                <td>{{$transparencia->instrutor->name}}</td>
                                <td>{{$transparencia->pessoa->nome_completo}}</td>
                                <td>{{$transparencia->tela}}</td>
                                <td><a href="{{route('unico-transparencia', $transparencia->id)}}"
                                       style="color: #ff9800">Mais Detalhes</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Instrutor</th>
                        <th>Avaliado</th>
                        <th>Tela</th>
                        <th>Detalhes</th>
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
