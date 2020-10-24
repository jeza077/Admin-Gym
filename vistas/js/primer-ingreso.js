
//** FUNCION PARA PASAR A LA SIGUIENTE PREGUNTA DE SEGURIDAD */
function togglePregunta1(){
    var container = document.querySelector('body');
    container.classList.toggle('pregunta-uno');
}
function togglePregunta2(){
    var container = document.querySelector('body');
    container.classList.toggle('pregunta-dos');
}
function togglePregunta3(){
    var container = document.querySelector('body');
    container.classList.toggle('pregunta-tres');
}

//** FUNCION PARA MOSTRAR CONTENEDOR CAMBIAR CONTRASEÑA */ 
function togglePassPrimeraVez(){
    var container = document.querySelector('body');
    container.classList.toggle('password-primera-vez');
}

//**AGREGAR BOTONES A CONTENEDOR PREGUNTAS DE SEGURIDAD */
// Pregunta 1
$("#pregunta1").append("<a href='javascript:void(0);' class='btn btn-primary float-right' onclick='togglePregunta2();'>Siguiente</a>");
// Pregunta 2
$("#pregunta2").append("<a href='javascript:void(0);' class='btn btn-danger float-left' onclick='togglePregunta2();'>Atras</a>");
$("#pregunta2").append("<a href='javascript:void(0);' class='btn btn-primary float-right' onclick='togglePregunta3();'>Siguiente</a>");

// Pregunta 3
$("#pregunta3").append("<a href='javascript:void(0);' class='btn btn-danger float-left' onclick='togglePregunta3();'>Atras</a>");
$("#pregunta3").append("<a href='javascript:void(0);' class='btn btn-primary float-right' onclick='togglePassPrimeraVez();'>Siguiente</a>");

// Contraseña nueva primer ingreso
$("#passwordPrimerIngreso").append("<label class='mt-2'>Nueva contraseña</label>");
$("#passwordPrimerIngreso").append("<input type='password' class='form-control password nueva-password' placeholder='Ingrese nueva contraseña' name='editarPassword' required>");
$("#passwordPrimerIngreso").append("<label class='mt-2'>Confirmar contraseña</label>");
$("#passwordPrimerIngreso").append("<input type='password' class='form-control password confirmar-password' placeholder='Confirmar contraseña'>");

$("#guardarPassPrimerIngreso").append("<button type='submit' class='btn btn-orange btn-block btn-flat' id='cambiarPasPrimerIngreso'>Cambiar Contraseña</button>");

requisitosPassword("center-start");
$('#cambiarPasPrimerIngreso').attr('disabled', true);
$(".nueva-password").on('change', function(){
    cambiarPass = $(this).val();
});

$('.nueva-password').keydown(impedirEspacios);
$('.confirmar-password').keydown(impedirEspacios);

$(".confirmar-password").on('input', function(){
    var confirPass = $(this).val();
    var btnCambiarPass = $('#cambiarPasPrimerIngreso');

    confirmarContraseña(cambiarPass, confirPass, btnCambiarPass);
})

