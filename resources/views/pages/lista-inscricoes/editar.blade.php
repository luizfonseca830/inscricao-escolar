@extends('layouts.app', ['activePage' => 'list_formulario_ativo', 'titlePage' => __('list_formulario_ativo')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/area-restrita/lista.css')}}">
    <link rel="stylesheet" href="{{asset('css/area-restrita/inscricoes/editar.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container">
                <div class="row">
                    <div class="card" style="width: 100%">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Cargos</h5>

                            </div>
                            {{--SEARCH CARGO --}}
                            <form action="{{route('cargo.search')}}" method="POST">
                                @csrf
                                <input type="text" name="tela_id" value="{{$tela->id}}" hidden>
                                <div class="row">
                                    <div class="col col-sm-8">
                                        <div class="form-group">
                                            <select name="cargo" id="cargo_select" class="form-control">
                                                @foreach ($cargos as $item)
                                                    @if(isset($cargo))
                                                        @if ($cargo->id == $item->id)
                                                            <option value="{{$item->id}}"
                                                                    selected>{{$item->cargo}}</option>
                                                        @else
                                                            <option value="{{$item->id}}">{{$item->cargo}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->cargo}}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col col-sm-4">
                                        <div class="form-group float-right">
                                            <input type="submit" class="btn btn-sm btn-outline-info" value="Procurar">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- MOSTRA OS ANEXOS QUE ESSE CARGO VAI TER --}}
                        <div class="card-body">
                            <div class="text-center" id="loading">
                                <img src="{{asset('assets/gifs/Spinner-1s-164px.gif')}}">
                            </div>
                            <div id="dataTables-lista" hidden>
                                <form method="post" action="{{route('tipoanexo.store')}}">
                                    @csrf
                                    <input type="text" name="tela_id" value="{{$tela->id}}" hidden>
                                    <input type="text" name="cargo_id" id="cargo_id_tipo" value="" hidden>

                                    <div class="row mb-3">
                                        <div class="col col-sm-8">
                                            <div class="form-group">
                                                <label>Nome do Anexo: </label>
                                                <input type="text" class="form-control" name="novoAnexo">
                                            </div>
                                        </div>
                                        <div class="col col-sm-4">
                                            <div class="form-group float-right">
                                                <input type="submit" class="btn btn-sm btn-outline-info"
                                                       value="Adicionar">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @if(isset($cargo))
                                    <div class="card-title mb-3">
                                        <h4>{{$cargo->cargo}}</h4>
                                    </div>
                                @endif

                                <table id="lista-anexos">
                                    <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!isset($cargo))
                                        @foreach($cargos->first()->tipoAnexo as $tipoAnexo)
                                            <tr>
                                                <td>{{$tipoAnexo->tipo}}</td>
                                                <td>
                                                    <a href="{{route('tipoanexo.delete', $tipoAnexo->id)}}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach($cargo->tipoAnexo as $tipoAnexo)
                                            <tr>
                                                <td>{{$tipoAnexo->tipo}}</td>
                                                <td>
                                                    <a href="{{route('tipoanexo.delete', $tipoAnexo->id)}}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Formulário</th>
                                        <th>Ações</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/area-restrita/inscricao/editar.js')}}"></script>
@endpush
