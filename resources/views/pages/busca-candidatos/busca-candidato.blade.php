@extends('layouts.app', ['activePage' => 'BuscaCandidato', 'titlePage' => __('BuscaCandidato')])
@extends('layouts.modal-message')
@section('css')
    <link rel="stylesheet" href="{{asset('css/registro/style.css')}}">
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <main class="container" id="ajuste">
                <div id="formulario_registro">
                    @csrf
                    <ul id="progress">
                        <li class="ativo" style="width: 100%">Relatório</li>
                    </ul>

                    <fieldset>
                        <h2>Buscar Candidato</h2>
                        <div id="tela">
                            <p>Informe o CPF do Candidato</p>
                            <input type="text" id="cpf" name="cpf_candidato" value=""/>
                        </div>

                        <div class="row">
                            <strong style="color: red" id="error"></strong>
                        </div>

                        <input type="button" name="next" id="confirma" class="acao" value="Busca"/>
                    </fieldset>
                </div>


            </main>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/area-restrita/functions.js')}}"></script>
    <script src="{{asset('js/registro/mask.js')}}"></script>

    <script>
        $(document).ready(function() {
            $(".acao").click(function(e){
                e.preventDefault();

                var cpf = $("#cpf").val();
                var _token = $("input[name='_token']").val();

                $.ajax({
                    url: "{{ route('pesquisa-candidato') }}",
                    type:'POST',
                    data: {_token:_token, cpf:cpf},
                    success: function(data) {
                        printMsg(data);
                    }
                });
            });

            function printMsg (msg) {
                if($.isEmptyObject(msg.error)){
                    console.log(msg.success);
                    $('#error').text('')

                    $('.alert-block').css('display','block').append('<strong>'+msg.success+'</strong>');
                }
                else{
                    console.log(msg.error)
                    $('#error').text(msg.error)
                }
            }
        });
    </script>
@endsection
