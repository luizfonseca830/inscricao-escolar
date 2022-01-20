$('#verificar').click(function () {

    if ($('#fupload1').val() != "" && $('#fupload2').val() != "" && $('#fupload3').val() != "") {
        console.log('1')
        $('#verificar').css('display', 'none');
        $('#erro_anex').css('display', 'none');
        $('#next').css('visibility', 'visible');
        $('#next').css('background', 'green');
    }
    else if ($('#fupload1').val() != "" && $('#fupload2').val() != "" && !$('#fupload3').length) {
        console.log('2')
        $('#verificar').css('display', 'none');
        $('#erro_anex').css('display', 'none');
        $('#next').css('visibility', 'visible');
        $('#next').css('background', 'green');
    } else {
        $('#erro_anex').removeAttr('hidden');
    }
});

