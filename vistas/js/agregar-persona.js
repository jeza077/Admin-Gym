//***VALIDACIONES */
validarEmail($('.email')); //Validar email de la persona ingresada


//** MOSTRAR TIPO DE PERSONA */
function toggleUser(){
    var container = document.querySelector('.card');
    container.classList.toggle('emplea');
}
function toggleCliente(){
    var container = document.querySelector('.card');
    container.classList.toggle('clien');
}

$(".agregarEmpleado").hide();

$("#tipoPersona").change(function(){
    var valor = $(this).val();

    if(valor === "empleado"){
        $('#btnSiguiente a').remove('.aCliente');
        $('#btnSiguiente').append('<a href="#" class="btn btn-primary aEmpleado float-right" onclick="toggleUser();">Siguiente</a>');
        $(".agregarEmpleado").show();
    } else {
        $('#btnSiguiente a').remove('.aEmpleado');
        $('#btnSiguiente').append('<a href="#" class="btn btn-primary aCliente float-right" onclick="toggleCliente();">Siguiente</a>');
    }
})