$(document).ready(function(){
    $('#telefone').inputmask({"mask": "(99) 99999-9999"}); //specifying options
    $('#cep').inputmask({"mask": "99.999-999"});
    $('#cpf').inputmask({"mask": "999.999.999-99"});
});
