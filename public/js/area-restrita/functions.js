$('#close').click(function () {
    $('#modal').css('display', 'none');
});

$(document).ready(function(){
    $("#pesquisa").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

//ALTERAR A PONTUACAO
function calcula(data1, data2){
    data1 = new Date(data1);
    data2 = new Date(data2);
    return (data2 - data1)/(1000*3600*24)*0.027;
}

$('#data_entrada-0').blur(function(){
    var dt1 = $('#data_entrada-0').val();
    var dt2 = $('#data_saida-0').val();

    $('#pontuacao_experiencia-0').val(calcula(dt1,dt2))
});
$('#data_saida-0').blur(function(){
    var dt1 = $('#data_entrada-0').val();
    var dt2 = $('#data_saida-0').val();

    $('#pontuacao_experiencia-0').val(calcula(dt1,dt2))
});

$('#data_entrada-1').blur(function(){
    var dt1 = $('#data_entrada-1').val();
    var dt2 = $('#data_saida-1').val();

    $('#pontuacao_experiencia-1').val(calcula(dt1,dt2))
});
$('#data_saida-1').blur(function(){
    var dt1 = $('#data_entrada-1').val();
    var dt2 = $('#data_saida-1').val();
    $('#pontuacao_experiencia-1').val(calcula(dt1,dt2))
});

$('#data_entrada-2').blur(function(){
    var dt1 = $('#data_entrada-2').val();
    var dt2 = $('#data_saida-2').val();
    $('#pontuacao_experiencia-2').val(calcula(dt1,dt2))
});
$('#data_saida-2').blur(function(){
    var dt1 = $('#data_entrada-2').val();
    var dt2 = $('#data_saida-2').val();
    $('#pontuacao_experiencia-2').val(calcula(dt1,dt2))
});

$('#data_entrada-3').blur(function(){
    var dt1 = $('#data_entrada-3').val();
    var dt2 = $('#data_saida-3').val();
    $('#pontuacao_experiencia-3').val(calcula(dt1,dt2))
});
$('#data_saida-3').blur(function(){
    var dt1 = $('#data_entrada-3').val();
    var dt2 = $('#data_saida-3').val();
    $('#pontuacao_experiencia-3').val(calcula(dt1,dt2))
});

$('#data_entrada-4').blur(function(){
    var dt1 = $('#data_entrada-4').val();
    var dt2 = $('#data_saida-4').val();
    $('#pontuacao_experiencia-4').val(calcula(dt1,dt2))
});
$('#data_saida-4').blur(function(){
    var dt1 = $('#data_entrada-4').val();
    var dt2 = $('#data_saida-4').val();
    $('#pontuacao_experiencia-4').val(calcula(dt1,dt2))
});

$('#data_entrada-5').blur(function(){
    var dt1 = $('#data_entrada-5').val();
    var dt2 = $('#data_saida-5').val();
    $('#pontuacao_experiencia-5').val(calcula(dt1,dt2))
});
$('#data_saida-5').blur(function(){
    var dt1 = $('#data_entrada-5').val();
    var dt2 = $('#data_saida-5').val();
    $('#pontuacao_experiencia-5').val(calcula(dt1,dt2))
});

$('#data_entrada-6').blur(function(){
    var dt1 = $('#data_entrada-6').val();
    var dt2 = $('#data_saida6').val();
    $('#pontuacao_experiencia-6').val(calcula(dt1,dt2))
});

$('#data_saida-6').blur(function(){
    var dt1 = $('#data_entrada-6').val();
    var dt2 = $('#data_saida-6').val();
    $('#pontuacao_experiencia-6').val(calcula(dt1,dt2))
});

$('#data_entrada-7').blur(function(){
    var dt1 = $('#data_entrada-7').val();
    var dt2 = $('#data_saida7').val();
    $('#pontuacao_experiencia-7').val(calcula(dt1,dt2))
});

$('#data_saida-7').blur(function(){
    var dt1 = $('#data_entrada-7').val();
    var dt2 = $('#data_saida-7').val();
    $('#pontuacao_experiencia-7').val(calcula(dt1,dt2))
});

$('#data_entrada-8').blur(function(){
    var dt1 = $('#data_entrada-8').val();
    var dt2 = $('#data_saida8').val();
    $('#pontuacao_experiencia-8').val(calcula(dt1,dt2))
});

$('#data_saida-8').blur(function(){
    var dt1 = $('#data_entrada-8').val();
    var dt2 = $('#data_saida-8').val();
    $('#pontuacao_experiencia-8').val(calcula(dt1,dt2))
});

$('#data_entrada-9').blur(function(){
    var dt1 = $('#data_entrada-9').val();
    var dt2 = $('#data_saida9').val();
    $('#pontuacao_experiencia-9').val(calcula(dt1,dt2))
});

$('#data_saida-9').blur(function(){
    var dt1 = $('#data_entrada-9').val();
    var dt2 = $('#data_saida-9').val();
    $('#pontuacao_experiencia-9').val(calcula(dt1,dt2))
});

$('#data_entrada-10').blur(function(){
    var dt1 = $('#data_entrada-10').val();
    var dt2 = $('#data_saida10').val();
    $('#pontuacao_experiencia-10').val(calcula(dt1,dt2))
});

$('#data_saida-10').blur(function(){
    var dt1 = $('#data_entrada-10').val();
    var dt2 = $('#data_saida-10').val();
    $('#pontuacao_experiencia-10').val(calcula(dt1,dt2))
});
