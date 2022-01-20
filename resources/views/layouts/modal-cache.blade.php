@if (Cookie::get('pessoa'))
    {{--    @dd(Cookie::get('tempo_expirar'))--}}
    <input type="text" id="tempo_expirar" value="{{Cookie::get('tempo_expirar')}}" hidden>
    <div class="modal" id="modal" tabindex="-1" role="dialog" style="display: block">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><p>Termina Inscrição</p></strong>
                </div>
                <div class="modal-body text-center">
                    <p><a href="{{route('registro/anexos', Cookie::get('type_edital'))}}">Parace que você não terminou
                            sua incrição, clique aqui para finalizar sua inscrição.</a>
                    </p>
                    <label class="text-warning font-weight-bold">Tempo para expirar: </label><label id="countdown" class="text-warning font-weight-bold"></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endif
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('assets/moment.js')}}"></script>
<script>
    $('#close').click(function () {
        console.log('teste');
        $('#modal').css('display', 'none');
    });

    setInterval(function () {
        var data1 = moment($('#tempo_expirar').val(), "DD/MM/YYYY hh:mm");
        var data2 = moment(moment(), "DD/MM/YYYY hh:mm");
        var diferenca = moment.duration(data1.diff(data2))
        // $('#countdown').val(diferenca['_data'].hours + ':' + diferenca['_data'].minutes + ':' + diferenca['_data'].seconds)
        $('#countdown').text(+diferenca['_data'].hours + ':' + diferenca['_data'].minutes + ':' + diferenca['_data'].seconds);
    }, 1000)

</script>

