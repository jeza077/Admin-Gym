function toggleUser(){
    var container = document.querySelector('.card');
    container.classList.toggle('emplea');
}
function toggleCliente(){
    var container = document.querySelector('.card');
    container.classList.toggle('clien');
}

// $("#btnSiguiente").click(function(event){  
//     event.prevenDefault();
// })

$(".agregarEmpleado").hide();
$("#tipoPersona").change(function(){
    var valor = $(this).val();
    console.log(valor)
    if(valor === "empleado"){
        $('#btnSiguiente').append('<a href="#" class="btn btn-primary float-right" onclick="toggleUser();">Siguiente</a>');
        $(".agregarEmpleado").show();
    } else {
        // $('#btnSiguiente').remove('<a href="#" class="btn btn-primary float-right" onclick="toggleUser();">Siguiente</a>');
        $('#btnSiguiente').append('<a href="#" class="btn btn-primary float-right" onclick="toggleCliente();">Siguiente</a>');
    }
})