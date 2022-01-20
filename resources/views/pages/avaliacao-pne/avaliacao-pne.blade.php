@extends('layouts.app', ['activePage' => 'avaliacao-pne', 'titlePage' => __('avaliacao-pne')])
@extends('layouts.modal-message')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <input class="form-control" id="pesquisa" type="text" placeholder="Procurar..">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Cargo</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Status Perícia</th>
                            <th scope="col">Opções</th>
                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @forelse($pessoas as $pessoa)
                            <tr>
                                <th>{{$pessoa->id}}</th>
                                <th>{{$pessoa->nome_completo}}</th>
                                <th>{{$pessoa->cpf}}</th>
                                <th>{{$pessoa->cargo->cargo}}</th>
                                <th><a href="{{asset('storage/anexos/documentos/'.$pessoa->anexos->anexo_deficiencia)}}" target="_blank">Anexo PNE</a></th>
                                @if(is_null($pessoa->status_pericia_pne))
                                    <th>Não Verificado</th>
                                @elseif($pessoa->status_pericia_pne == 1)
                                    <th style="color: green">Perícia Aceita</th>
                                @else
                                    <th style="color: red">Perícia Recusada</th>
                                @endif
                                @if (is_null($pessoa->status_pericia_pne))
                                    <th>
                                        <a href="{{route('avaliacao-pne-aceitar', $pessoa->id)}}"><input type="button" class="btn btn-outline-success" value="Aceitar"></a>
                                        <a href="{{route('avaliacao-pne-recusar-motivo', $pessoa->id)}}"><input type="button" class="btn btn-outline-danger" value="Negar"></a>
                                    </th>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2">Nenhum Resultado Encontrado</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div style="width: 100%; margin-left: 50%">
                        {!! $pessoas->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
@endsection
