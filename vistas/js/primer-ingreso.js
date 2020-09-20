$('#btnPrimerIngreso').attr('disabled', true);
$('#primerIngreso').on('change', function () {
    var valorInputPassword = $('input[type="password"]', this).val()
    var valorInputTexto = $('input[type="text"]', this).val()
    console.log(valorInputTexto);
    // console.log(valorInputPassword);

    if(valorInputTexto == ""){
        $('#btnPrimerIngreso').attr('disabled', true);
    } else {
        $('#btnPrimerIngreso').attr('disabled', false);
    }
});
