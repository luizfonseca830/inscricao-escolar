@extends('layouts.app', ['activePage' => 'TelaCriar', 'titlePage' => __('TelaCriar')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">

@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                @foreach($arquivos as $arquivo)
                @endforeach
                <div class="row">
                    <form id="formulario_registro" method="post" action="{{route('tela-criar-salvar')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <ul id="progress">
                            <li class="ativo" style="width: 100%">Criar</li>
                        </ul>

                        <fieldset>
                            <h2>Criar Tela</h2>
                            <h3>Tipo Tela</h3>
                            <select id="tipo_tela" name="tipo_tela">
                                <option value="0">Não Selecionado</option>
                                @foreach($telas as $tela)
                                    <option value="{{$tela->id}}">{{$tela->tipo}}</option>
                                @endforeach
                            </select>
                            <div id="tela" hidden>
                                <p id="texto"></p>
                                <input type="text" name="tela_nome" value=""/>
                            </div>

                            <div id="pontuacao" hidden>
                                <p>Pontuação Máxima do Edital</p>
                                <input type="number" name="pontuacao_maxima" id="pontuacao_maxima" value="" placeholder="0.0" required disabled/>
                            </div>

                            <div id="pdf" hidden>
                                <p>Nome da Tela</p>
                                <input type="text" name="tela_nome_pdf" value=""/>
                                <p>Escolha o PDF</p>
                                <input type="file" name="pdf_carregar" class="form_control">
                                @error('pdf_carregar')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div id="liberar" hidden>
                                <p>Liberar tela</p>
                                <select id="status_liberar" name="status_liberar">
                                    @if ($tela->status_liberar == 1)
                                        <option value="1" selected>Sim</option>
                                    @else
                                        <option value="1">Sim</option>
                                    @endif
                                    @if ($tela->status_liberar == 0)
                                        <option value="0" selected>Não</option>
                                    @else
                                        <option value="0">Não</option>
                                    @endif
                                </select>
                            </div>

                            @if ($tela->status_liberar == 0)
                                <div id="data_liberar" hidden>
                                    <p>Selecione uma Data para liberar a Tela</p>
                                    @if(!is_null($tela->data_liberar) && !is_null($tela->data_fecha))
                                        <p><strong>Data Inicial: {{$tela->data_liberar}} - Até
                                                - {{$tela->data_fecha}}</strong></p>
                                    @endif
                                    <h3><strong>Data Inicial</strong></h3>
                                    <input type="datetime-local" id="input-data_liberar" name="data_liberar"
                                           value="{{date('d/m/Y H:i', strtotime($tela->data_liberar))}}">

                                    <h3><strong>Data Final</strong></h3>
                                    <input type="datetime-local" id="input-data_liberar" name="data_final"
                                           value="{{date('d/m/Y H:i', strtotime($tela->data_liberar))}}">
                                </div>
                            @else
                                <div id="data_liberar" hidden>
                                    <p>Selecione uma Data para liberar a Tela</p>
                                    <input type="date" id="input-data_liberar" name="data_liberar">
                                </div>
                            @endif

                            <input type="submit" name="next" id="confirma" class="acao" value="Criar"/>
                        </fieldset>
                    </form>
                </div>
            </main>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script>
        $('#tipo_tela').click(function () {
            if ($('#tipo_tela').val() == 1) {
                $('#tela').removeAttr('hidden');
                $('#texto').html('Informe o nome da Tela');
                $('#pdf').attr('hidden', true);
                $('#liberar').removeAttr('hidden');
                $('#data_liberar').removeAttr('hidden');
                $('#pontuacao').attr('hidden', true);
                $('#pontuacao_maxima').attr('disabled', true);
                $('#pontuacao_maxima').removeAttr('required');
            } else if ($('#tipo_tela').val() == 2) {
                $('#pdf').removeAttr('hidden');
                $('#tela').attr('hidden', true);
                $('#liberar').removeAttr('hidden');
                $('#data_liberar').removeAttr('hidden');
                $('#pontuacao').attr('hidden', true);
                $('#pontuacao_maxima').attr('disabled', true);
                $('#pontuacao_maxima').removeAttr('required');
            } else if ($('#tipo_tela').val() == 3) {
                $('#texto').html('Informe o nome do Formulário');
                $('#tela').removeAttr('hidden');
                $('#pdf').attr('hidden', true);
                $('#liberar').removeAttr('hidden');
                $('#data_liberar').removeAttr('hidden');
                $('#pontuacao').removeAttr('hidden');
                $('#pontuacao_maxima').removeAttr('disabled');
                $('#pontuacao_maxima').attr('required');
            }
        });

        $('#status_liberar').click(function () {
            if ($('#status_liberar').val() == 0) {
                $('#data_liberar').removeAttr('hidden');
            } else {
                $('#data_liberar').attr('hidden', true);
            }
        });
    </script>
@endsection
