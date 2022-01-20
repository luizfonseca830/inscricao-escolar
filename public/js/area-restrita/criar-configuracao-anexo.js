$('#pontuar_publica_privada_sim').click(function () {
    $('#experienciapublicoprivado').removeAttr('hidden');
    $('#inputPontuacaoPorItem').attr('hidden', true);
    $('#inputManual').attr('hidden', true);
    $('#inputQuantiadeAnexos').attr('hidden', true);
    $('input[name=inputQuantiadeAnexos]').val(1);
});

$('#pontuar_publica_privada_nao').click(function () {
    $('#inputPontuacaoPorItem').removeAttr('hidden');
    $('#inputManual').removeAttr('hidden');
    $('#experienciapublicoprivado').attr('hidden', true);
    $('input[name=inputTipoExperiencia]').prop('checked', false);
    $('input[name=inputPorAno]').val("");
    $('input[name=inputPorMes]').val("");
    $('input[name=inputPontuacaoPorItem]').val("");
    $('#inputQuantiadeAnexos').removeAttr('hidden');
    $('input[name=inputQuantiadeAnexos]').val("");
});

$('#pontuar_publica_privada_edita_sim').click(function () {
    $('#experienciapublicoprivadoEdita').removeAttr('hidden');
    $('#inputPontuacaoPorItemEdita').attr('hidden', true);
    $('#inputManualEdita').attr('hidden', true);
    $('#inputQuantiadeAnexosEdita').attr('hidden', true);
    $('input[name=inputQuantiadeAnexosEdita]').val(1);
});

$('#pontuar_publica_privada_edita_nao').click(function () {
    $('#inputPontuacaoPorItemEdita').removeAttr('hidden');
    $('#inputManualEdita').removeAttr('hidden');
    $('#experienciapublicoprivadoEdita').attr('hidden', true);
    $('input[name=inputTipoExperiencia]').prop('checked', false);
    $('input[name=inputPorAno]').val("");
    $('input[name=inputPorMes]').val("");
    $('input[name=inputPontuacaoPorItem]').val("");
    $('#inputQuantiadeAnexosEdita').removeAttr('hidden');
});
