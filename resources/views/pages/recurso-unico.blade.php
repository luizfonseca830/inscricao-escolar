@extends('layouts.app', ['activePage' => 'recurso', 'titlePage' => __('Recurso')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/area-restrita/avaliar.css')}}">
    <style>
        #progress li {
            width: {{$progressQuantiadePorcento}}% !important;
            height: 155px;
            border: 1px solid #fff;
            padding-top: 3%;
        }

        #formulario_registro #progress li:hover {
            background: #058bff;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div class="row">
                    <form id="formulario_registro" method="post" action="{{route('recurso.aceitar')}}">
                        <input type="number" name="pessoa_id" id="pessoa_id" value="{{$pessoa->id}}" hidden/>
                        @csrf
                        @error('motivo_recusar.*')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <ul id="progress">
                            <li class="ativo progress-click" data-pos="0">Informações Pessoais</li>
                            <li class="progress-click" data-pos="1">Endereço</li>
                            @foreach($tipoAnexoCargo as $key=>$tipo)
                                <li class="progress-click" data-pos="{{$key+2}}">{{$tipo->tipoAnexo->tipo}}</li>
                            @endforeach
                        </ul>
                        @if(!is_null($pessoa->recurso))
                            <div class="card text-primary bg-info">
                                <div class="card-header"><h4 class="font-weight-bold text-white">Recurso</h4></div>
                                <div class="card-body">
                                    <p class="card-text text-white"
                                       style="font-size: 16px">{{$pessoa->recurso->recurso}}</p>
                                </div>
                                @if(!is_null($pessoa->recurso->url_anexo))
                                    <h5>
                                        <a target="_blank" class="text-justify text-body text-white font-weight-bold"
                                           href="{{asset('storage/'.(str_contains($pessoa->recurso->url_anexo, 'recurso') ? $pessoa->recurso->url_anexo : 'recurso/'.$pessoa->recurso->url_anexo))}}">Anexo</a>
                                    </h5>
                                @endif
                            </div>
                        @endif
                        @if (!is_null($pessoa->status_avaliado) && $pessoa->status_avaliado == 0)
                            <div class="card text-white bg-info">
                                <div class="card-header"><h4 class="font-weight-bold">Motivo Reprovar</h4></div>
                                <div class="card-body">
                                    <p class="card-text"
                                       style="font-size: 16px">{{$pessoa->reprovarPessoa($pessoa->id)->motivo}}</p>
                                </div>
                            </div>
                        @endif

                        <fieldset class="fild" data-pos="0">
                            <h2>Informações Pessoais</h2>
                            <p>Nome Completo</p>
                            <input type="text" placeholder="Nome Completo"
                                   value="{{$pessoa->nome_completo}}" disabled/>
                            <div class="row">
                                <div class="col col-sm-12">
                                    <p>CPF</p>
                                    <input type="text" placeholder="CPF"
                                           value="{{$pessoa->cpf}}" disabled/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-sm-6">
                                    <p>RG</p>
                                    <input type="text" placeholder="RG"
                                           value="{{$pessoa->rg}}"
                                           disabled/>
                                </div>
                                <div class="col col-sm-6">
                                    <p>Orgão Emissor</p>
                                    <input type="text" placeholder="RG"
                                           value="{{$pessoa->orgao_emissor}}"
                                           disabled/>
                                </div>
                            </div>
                            <p>Telefone</p>
                            <input type="text" placeholder="RG"
                                   value="{{$pessoa->telefone}}"
                                   disabled/>

                            <div class="row">
                                <div class="col col-sm-6">
                                    <p>Nacionalidade</p>
                                    <input type="text" placeholder="RG"
                                           value="{{$pessoa->nacionalidade}}"
                                           disabled/>
                                </div>
                                <div class="col col-sm-6">
                                    <p>Naturalidade</p>
                                    <input type="text" placeholder="RG"
                                           value="{{$pessoa->naturalidade}}"
                                           disabled/>
                                </div>
                            </div>
                            <p>PNE</p>
                            @if($pessoa->portador_deficiencia == 0)
                                <input type="text" placeholder="RG"
                                       value="Sim"
                                       disabled/>
                            @else
                                <input type="text" placeholder="RG"
                                       value="Não"
                                       disabled/>
                            @endif
                            <input type="button" style="width: 26%" name="next" id="next" class="next acao" value="Próximo"/>
                        </fieldset>

                        <fieldset class="fild" data-pos="1">
                            <h2>Endereço</h2>
                            <p>CEP</p>
                            <input type="text" placeholder="Informe seu CEP"
                                   value="{{$pessoa->endereco->cep}}" disabled/>
                            <p>Bairro</p>
                            <input type="text" placeholder="Informe seu Bairro"
                                   value="{{$pessoa->endereco->bairro}}" disabled/>
                            <p>Endereço</p>
                            <input type="text" placeholder="Informe seu Endereço"
                                   value="{{$pessoa->endereco->endereco}}"
                                   disabled/>
                            <input type="button" name="next" id="next" class="next acao" value="Próximo"/>
                            <input type="button" name="prev" id="prev" class="prev acao" value="Anterior"/>
                        </fieldset>
                        @foreach($tipoAnexoCargo as $key=>$progresso)
                            <fieldset class="fild" data-pos="{{$key+2}}">
                                <div class="row">
                                    <div class="col col-sm-12">
                                        <input type="button" name="next" class="btn btn-danger float-right mr-2"
                                               data-toggle="modal" data-target="#modalRecursoNegar" style="width: 25%"
                                               value="NEGAR RECURSO"/>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">CARGO PRETENDIDO:
                                        <h3 class="text-center font-weight-bold">{{$pessoa->cargo->cargo}}</h3>
                                    </div>
                                    @if (!is_null($pessoa->status_avaliado) && $pessoa->status_avaliado == 1)
                                        <div class="row justify-content-center mr-2">
                                            @if(isset($pessoa->pontuacao($pessoa->id)->pontuacao_total_publica))
                                                <label style="font-weight: bold; color: black;"> Pontuação Publica:
                                                    <label
                                                        style="font-weight: bold; color: black; padding: 10px;">{{$pessoa->pontuacao($pessoa->id)->pontuacao_total_publica}}</label>
                                                </label>
                                            @else
                                                <td>Não existe pontuação</td>
                                            @endif
                                            @if(isset($pessoa->pontuacao($pessoa->id)->pontuacao_total_privada))
                                                <label style="font-weight: bold; color: black;"> Pontuação Privada:
                                                    <label
                                                        style="font-weight: bold; color: black; padding: 10px;">{{$pessoa->pontuacao($pessoa->id)->pontuacao_total_privada}}</label>
                                                </label>
                                            @else
                                                <td>Não existe pontuação</td>
                                            @endif
                                            @if(!is_null($pessoa->pontuacao($pessoa->id)))
                                                <label style="font-weight: bold; color: black;"> Pontuação Total:
                                                    <label
                                                        style="font-weight: bold; color: black; padding: 10px;">{{$pessoa->pontuacao($pessoa->id)->pontuacao_total}}</label>
                                                </label>

                                            @else
                                                <td>Não existe pontuação</td>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <h2 class="text-center font-weight-bold">{{$progresso->tipoAnexo->tipo}}</h2>
                                @if (!is_null($pessoa->status_avaliado) && $pessoa->status_avaliado == 1 && is_null(($pessoa->pontuacao($pessoa->id)->pontuacao_total_publica) && ($pessoa->pontuacao($pessoa->id)->pontuacao_total_publica)))
                                    <div class="row justify-content-end mr-2">
                                        <label style="font-weight: bold; color: black;"> Pontuação Geral:
                                            <label
                                                class="text-success font-weight-bold">{{$pessoa->pontuacao($pessoa->id)->pontuacao_total}}</label>
                                        </label>
                                    </div>
                                @endif
                                @foreach($progresso->pessoaEditalAnexos($pessoa->id, $pessoa->edital_dinamico_id, $progresso->tipoAnexo->id) as $anexo)
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">{{$anexo->documentoDinamico->nome_documento}}</h3>
                                        </div>
                                        <div class="card-body text-left">
                                            <h5><a target="_blank" href="{{asset('documentos/'.$anexo->nome_arquivo)}}">Anexo</a>
                                            </h5>
                                            @if(!is_null($anexo->documentoDinamico->pontuacao_maxima_documento) && !is_null($anexo->documentoDinamico->pontuacao_por_item))
                                                <p>Pontuação: <strong
                                                        style="font-weight: bold;">{{$anexo->pontuacao}}</strong>
                                                </p>
                                            @else
                                                <td>Não existe pontuação</td>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                @if($key != $tipoAnexoCargo->count() - 1)
                                    <input type="button" name="next" id="next" class="next acao" value="Próximo"/>
                                @endif
                                @if($key == $tipoAnexoCargo->count() - 1)
                                    <div class="row justify-content-end">
                                        <input type="button" name="next" id="aceitarRecurso" class="btn btn-success mr-3"
                                               style="width: 25%"
                                               value="Aceitar Recurso"/>
                                    </div>
                                @endif
                                <input type="button" name="prev" id="prev" class="prev acao"
                                       value="Anterior"/>
                            </fieldset>
                        @endforeach
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
@include('pages.models.recurso-negar')
@push('js')
    <script src="{{asset('js/contador.js')}}"></script>
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('js/registro/function.js')}}"></script>

    <script>
        $('#aceitarRecurso').click(function () {
            Swal.fire({
                title: 'Pontuar recurso',
                text: "Pontuação total {{!is_null($pessoa->pontuacao($pessoa->id)) ? $pessoa->pontuacao($pessoa->id)->pontuacao_total : 0}} + Recurso: ",
                input: 'number',
                inputAttributes: {
                    autocapitalize: 'off',
                    min:0,
                    max: {{100 - (!is_null($pessoa->pontuacao($pessoa->id)) ? $pessoa->pontuacao($pessoa->id)->pontuacao_total : 0)}}
                },
                inputPlaceholder: "PONTUAR",
                showCancelButton: true,
                confirmButtonText: 'SALVAR',
                showLoaderOnConfirm: true,
                preConfirm: (recurso_pontuacao) => {
                    $.ajax({
                        url: "{{ route('recurso.aceitar') }}",
                        type:'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            pessoa_id: $('#pessoa_id').val(),
                            pontuar_recurso: recurso_pontuacao
                        },
                        success: function(data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Recurso avaliado com sucesso.',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = "{{route('visualizacao-recurso', $pessoa->edital_dinamico_id)}}"
                            })
                        },
                        error: function (data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Problema com o recurso.',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = "{{route('visualizacao-recurso', $pessoa->edital_dinamico_id)}}"
                            })
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        })
    </script>
@endpush
