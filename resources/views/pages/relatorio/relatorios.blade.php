@php
    ini_set('memory_limit', '1024M');
@endphp
@extends('layouts.app', ['activePage' => 'relatorio', 'titlePage' => __('Relatorio')])
@extends('layouts.modal-message')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/area-restrita/lista.css')}}">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col col-12">
                <form action="{{route('relatorio.gerar')}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5 style="font-weight: bolder">Filtros de Relatório</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-3">
                                    <label for="exampleFormControlSelect2">Cargos</label>
                                    <select class="form-control" name="cargoID">
                                        <option value="">Não selecionado</option>
                                        @foreach($cargos as $cargo)
                                            <option value="{{$cargo->id}}">{{$cargo->cargo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col col-3">
                                    <label for="exampleFormControlSelect2">Nível de Escolaridade</label>
                                    <select class="form-control" name="escolaridadeID">
                                        <option value="">Não selecionado</option>
                                        @foreach($niveisEscolaridades as $escolaridade)
                                            <option
                                                value="{{$escolaridade->id}}">{{$escolaridade->nivel_escolaridade}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col col-3">
                                    <label for="exampleFormControlSelect2">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Não selecionado</option>
                                        <option value="1">Aprovado</option>
                                        <option value="0">Reprovado</option>
                                    </select>
                                </div>

                                <div class="col col-3">
                                    <label for="exampleFormControlSelect2">Tipo</label>
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option value="1">Tabela</option>
                                        <option value="2">PDF</option>
                                        <option value="3">Excel</option>
                                    </select>
                                </div>

                                <div class="col col-4 mt-2" id="divShowPNE" hidden>
                                    <label for="exampleFormControlSelect2">COM PNE</label>
                                    <select name="show_pne" class="custom-select">
                                        <option value="1" selected>SIM</option>
                                        <option value="0">NÃO</option>
                                    </select>
                                </div>

                                <div class="col col-6 mt-2" id="divTitulo" hidden>
                                    <label for="exampleFormControlSelect2">Título do PDF</label>
                                    <input type="text" name="titulo" id="titulo" class="form-control"
                                           placeholder="Informe o título do pdf">
                                </div>

                                <div class="col col-12 mt-3" id="divConstruirExcel" hidden>
                                    <label for="constructorPDFIsExcel">Exibir Excel</label>
                                    <select class="custom-select h-100" id="constructorPDFIsExcel" name="constructorPDFIsExcel[]" multiple>
                                        @foreach($listaDoMultiSelect as $key=>$item)
                                            <option value="{{$item['nome']}}" {{$item['selecionado'] == 1 ? 'selected' : ''}}>{{$item['nome']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="text" name="editalDinamicoID" value="{{$editalDinamico->id}}" hidden>
                            </div>

                            <div class="row mt-4">
                                <div class="col col-sm-12 text-right mt-3">
                                    <input type="submit" class="btn btn-outline-info" value="Busca">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="w-100 text-center" id="loading">
                <img src="{{asset('assets/gifs/Spinner-1s-164px.gif')}}">
            </div>

            <div class="col col-12">
                <div class="card" id="dataTables-lista" style="width: 100%; padding: 20px" hidden>
                    <table id="lista-relatorio">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Cargo</th>
                            <th>Escolaridade</th>
                            <th>PNE</th>
                            <th>Pontuação Publica</th>
                            <th>Pontuação</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody @foreach($pessoas as $key=>$pessoa)


                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$pessoa->nome_completo}}</td>
                                <td>{{$pessoa->cpf}}</td>
                                <td>{{$pessoa->cargo->cargo}}</td>
                                <td>{{$pessoa->escolaridade->nivel_escolaridade}}</td>
                                @if ($pessoa->portador_deficiencia == 1)
                                    <td class="font-weight-bold">SIM</td>
                                @else
                                    <td>NÃO</td>
                                @endif
                                @if(isset($pessoa->pontuacao($pessoa->id)->pontuacao_total_publica))
                                    <td>{{$pessoa->pontuacao($pessoa->id)->pontuacao_total_publica}}</td>
                                @else
                                    <td>Não existe pontuação</td>
                                @endif
                                @if(!is_null($pessoa->pontuacao($pessoa->id)))
                                    <td>{{$pessoa->pontuacao($pessoa->id)->pontuacao_total}}</td>
                                @else
                                    <td>Não existe pontuação</td>
                                @endif
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
                                    <a href="{{route('relatorio.unico', $pessoa->id)}}" class="text-info">
                                        <i class="fa fa-2x fa-user"></i>
                                    </a>
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
                                <th>Escolaridade</th>
                                <th>PNE</th>
                                <th>Pontuação Publica</th>
                                <th>Pontuação</th>
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
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('assets/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('js/area-restrita/lista-relatorio.js')}}"></script>
@endsection
