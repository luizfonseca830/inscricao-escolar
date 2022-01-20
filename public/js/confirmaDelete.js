$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.delete_item_sweet').click(function () {
        const action = $(this).data('action');
        console.log(action)
        Swal.fire({
            title: 'Tem Certeza?',
            text: "Esta ação não poderá ser revertida!",
            type: 'warning',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    },
                    title: 'Aguarde'
                });

                $.ajax({
                    type: 'GET',
                    url: action,
                    dataType: 'JSON',
                    data: {
                        "token": $('input[name="_token"]').val()
                    },
                    success: function (response) {
                        console.log(response)
                        if (response) {
                            Swal.fire({
                                title: 'Excluido!',
                                text: response.message,
                                type: 'success',
                                showConfirmButton: false,
                                timer: 3000,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                onClose: window.location.replace(window.location.href)
                            })
                        }


                    },
                    error: function (response) {
                        console.log(response)
                        Swal.fire({
                            title: 'Não Excluido!',
                            text: 'Não é possivel excluir esse registro',
                            type: 'error',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: true
                        })
                    }

                });
            }
        })
    });
});
