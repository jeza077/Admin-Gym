
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
