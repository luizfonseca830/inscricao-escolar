$('#confirma').click(function () {
    $('#modal').css('display', 'block');
    $('#nome_conf').html($('#nome_completo').val())
    $('#cpf_conf').html($('#cpf').val())
    $('#rg_conf').html($('#rg').val())
    $('#orgao_emissor_conf').html($('#orgao_emissor').val())
    // $('#pis_conf').html($('#pis').val())
    $('#telefone_conf').html($('#telefone').val())
    $('#nacionalidade_conf').html($('#nacionalidade').val())
    $('#naturalidade_conf').html($('#naturalidade').val())
    $('#email_conf').html($('#email').val())
    $('#data_nascimento_conf').html(moment($('#data_nascimento').val()).format('DD/MM/YYYY'))
    if ($('#sexo').val() == 'H') {
        $('#sexo_conf').html('Masculino')
    }
    else{
        $('#sexo_conf').html('Feminino')
    }

    if ($('#data_nascimento').val() > $('#data_nascimento').attr('max')) {
        $('#data_nascimento_error').removeAttr('hidden')
    }
    else $('#data_nascimento_error').attr('hidden', true)
    $('#pne_conf').html($('#pne').val())

    $('#cep_conf').html($('#cep').val())
    $('#bairro_conf').html($('#bairro').val())
    $('#endereco_conf').html($('#endereco').val() + ', ' + $('#numero').val())
    $('#escolaridade_conf').html($('#escolaridade :selected').text())
    $('#cargo_conf').html($('#cargo :selected').text())

});

$('#close').click(function () {
    $('#modal').css('display', 'none');
});
