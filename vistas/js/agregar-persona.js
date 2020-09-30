function toggleUser(){
    var container = document.querySelector('.card');
    container.classList.toggle('emplea');
}
function toggleCliente(){
    var container = document.querySelector('.card');
    container.classList.toggle('clien');
}

//***VALIDACIONES */
validarEmail($('.email')); //Validar email de la persona ingresada


// const formulario = $(".formulario").select();
// const inputs = $('.formulario input');

// const expresiones = {
//     usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
// 	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
// 	password: /^.{4,12}$/, // 4 a 12 digitos.
// 	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
// 	telefono: /^\d{7,14}$/ // 7 a 14 numeros.
// }

// var nombre = $('input[name = ]');

// $('.formulario').on('input', function () {
//     switch ($('input[name]')) {
//         case 'nuevoNombre':
//             console.log('funciona')
//             break;
    
//         default:
//             break;
//     }    
// });


// inputs.forEach((input) => {
//     input
// });


//** MOSTRAR TIPO DE PERSONA */
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