@extends('layouts.header-footer')

@section('title')
    <title>SEINFRA - REGISTRO</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
    <style>
        #progress li {
            width: {{$porcetagemProgress}}% !important;
        }
    </style>
@endsection

@section('content')

    <main class="container" id="ajuste">
        <div class="row">
            <form id="formulario_registro" method="post" action="{{route('registro/parte2')}}"
                  enctype="multipart/form-data">
                @csrf
                <ul id="progress">
                    @foreach($tipoAnexoCargo as $tipo)
                        <li>{{$tipo->tipoAnexo->tipo}}</li>
                    @endforeach
                    <input type="number" name="editalDinamicoID" value="{{$editalDinamico->id}}" hidden>
                </ul>

                <div class="card text-white bg-danger mb-3" id="card-error" hidden>
                    <div class="card-body">
                        <p class="card-text" id="message-error">Parece que algum anexo obrigatório não foi preenchido,
                            verifique novamente.</p>
                    </div>
                </div>

                @foreach($tipoAnexoCargo as $key => $progress)
                    <fieldset>
                        <h2>{{$progress->tipoAnexo->tipo}}</h2>
                        <div class="row justify-content-end pr-4">
                            <b>Os campos com <b class="text-danger">*</b> são obrigatórios</b>
                        </div>
                        @foreach($progress->editalDinamicoTipoAnexoCargo($editalDinamico->id, $progress->tipo_anexo_id, $pessoa->cargo_id) as $keyEditais=>$editalDinamicoTipoAnexos)
                            @if(!is_null($editalDinamicoTipoAnexos->documentoDinamico))
                                @for ($i = 0; $i < $editalDinamicoTipoAnexos->documentoDinamico->quantidade_anexos; $i++)
                                    <div class="div-ajuste">
                                        <div class="row">
                                            @if ($editalDinamicoTipoAnexos->documentoDinamico->obrigatorio == 1)
                                                <div class="col col-6">
                                                    <label id="clickfupload1"
                                                           class="control-label label-bordered nomeArquivo">ADICIONE
                                                        {{$editalDinamicoTipoAnexos->documentoDinamico->nome_documento}}</label>
                                                    <label class="text-danger label-bordered ">*</label>
                                                </div>
                                            @else
                                                <label id="clickfupload1"
                                                       class="control-label label-bordered nomeArquivo">ADICIONE
                                                    {{$editalDinamicoTipoAnexos->documentoDinamico->nome_documento}}</label>
                                            @endif
                                        </div>
                                        @if ($editalDinamicoTipoAnexos->documentoDinamico->obrigatorio == 1)
                                            <input type="file" id="fupload1"
                                                   name="anexosDocumentos[{{$editalDinamicoTipoAnexos->tipo_anexo_id}}][]"
                                                   class="@error('anexosDocumentos[]') is-invalid @enderror"
                                                   class="fupload form-control" accept="application/pdf" required/>
                                        @else
                                            <input type="file" id="fupload1"
                                                   name="anexosDocumentos[{{$editalDinamicoTipoAnexos->tipo_anexo_id}}][]"
                                                   accept="application/pdf"
                                                   class="@error('anexosDocumentos[]') is-invalid @enderror"
                                                   class="fupload form-control"/>
                                        @endif

                                        @error('anexosDocumentos.'.$editalDinamicoTipoAnexos->tipo_anexo_id.'.'.$keyEditais)
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <input type="text"
                                               name="anexosDocumentos[{{$editalDinamicoTipoAnexos->tipo_anexo_id}}][documentoDinamico][]"
                                               value="{{$editalDinamicoTipoAnexos->documentoDinamico->id}}" hidden>
                                    </div>
                                @endfor
                            @endif
                        @endforeach

                        @if ($key < ($tipoAnexoCargo->count() - 1))
                            <input type="button" name="next" id="next" class="next acao" value="Próximo"/>
                        @endif
                        @if($key != 0)
                            <input type="button" name="prev" id="prev" class="prev acao" value="Anterior"/>
                        @endif

                        @if($key == ($tipoAnexoCargo->count() - 1))
                            <div class="row justify-content-end">
                                <input type="submit" id="enviar" name="next" class="btn btn-success mr-3"
                                       style="width: 100px"
                                       value="Enviar"/>
                            </div>
                        @endif

                    </fieldset>
                @endforeach
            </form>
        </div>
    </main>
@endsection

@section('script')
    <script src="{{asset('js/registro/function.js')}}"></script>
@endsection
