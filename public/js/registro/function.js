$(function () {
    var atual_fs, next_fs, prev_fs;

    $('.next').click(function () {
        atual_fs = $(this).parent();
        next_fs = $(this).parent().next();

        $('#progress li').eq($('fieldset').index(next_fs)).addClass('ativo')
        atual_fs.hide(800);
        next_fs.show(800);
        $('html,body').scrollTop(0);
        $('html, body').animate({scrollTop: 0}, 'slow');
    });

    $('.prev').click(function () {
        atual_fs = $(this).parent();
        prev_fs = $(this).parent().prev();

        $('#progress li').eq($('fieldset').index(atual_fs)).removeClass('ativo')
        atual_fs.hide(800);
        prev_fs.show(800);
    });

    $('.progress-click').click(function () {
        // var select = $(this).attr('data-pos') -1;
        // atual_fs = $(`.next`).parent()
        //
        // prev_fs =  $(`.prev[data-pos='${select}']`).parent().prev();
        // next_fs = $(`.next[data-pos='${select}']`).parent().next();
        //
        //
        // prev_fs.hide(800)
        // atual_fs.hide(800)
        // next_fs.show(800)
        $('.fild').map(function () {
            $(`.progress-click[data-pos=${$(this).attr('data-pos')}]`).css('background', '#e96b56')
            return $(this).css('display', 'none')
        })
        $(`.fild[data-pos=${$(this).attr('data-pos')}]`).css('display', 'block')
        $(this).css('background', '#058bff')
        $('html,body').scrollTop(0);
        $('html, body').animate({scrollTop: 0}, 'slow');

    })

    $('select[name="escolaridade"]').on('change', function () {
        var escolaridade = this.value;
        var vazio = ''
        if (escolaridade === '') {
            $('#cargo').val('').prop('selected', true)
            $('#cargo-div').attr('hidden', true)
        }
        else {
            $('#cargo-div').removeAttr('hidden');
            $('#cargo').val('')
        }
        $('select[name="CARGO"] option').each(function () {
            var $this = $(this);
            if ($this.data('escolaridade') == escolaridade){
                $this.show();
            }
            else $this.hide();
        });
    });

    $(function () {
        $('input.checkgroup').click(function () {
            if ($(this).is(":checked")) {
                $('input.checkgroup').attr('disabled', true);
                $(this).removeAttr('disabled');
            } else {
                $('input.checkgroup').removeAttr('disabled');
            }
        })
    })

    // $('#escolaridade').click(function () {
    //     var nivel = $('#escolaridade').val()
    //     if (nivel == 1 || nivel == 2 || nivel == 3) {
    //         $('#cargo-div').removeAttr('hidden', false);
    //     }
    // });


    $('#enviar').click(function () {
        $('[required]').each(function () {
            if (this.files.length === 0) {
                $(this).addClass('form-control is-invalid')
                $('#card-error').removeAttr('hidden')
                console.log('Parece que algum campo não foi preenchido.')
            } else {
                $(this).removeClass('form-control is-invalid')
                $('#card-error').attr('hidden')
            }
        })
    })

});
