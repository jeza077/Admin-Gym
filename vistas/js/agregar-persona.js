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


//** GENERAR CONTRASEÑAS ALEATORIAMENTE */
$('#generarPassword').on('click', function () {
    $longitud = 20; //numero de caracteres
    $clave = generarClave($longitud); 
    // console.log($clave);
    $('.nueva-password').val().html($clave);
});

/*Función principal | Generador de claves*/
function generarClave(long)
{
	/*caracteres permitidos*/
	let caracteres = "Aa0BbCc1DdEe2FfGgHh3IiJj4KkLl5MmNn6OoPp7QqRr8SsTt9UuVv*WwXxYyZz$",
		clave = '',
		numero;

	/*creacion de clave*/
	for(let i=0;i<long;i++)
	{
		numero = getNumero( 0, caracteres.length );
		clave += caracteres.substring( numero, numero + 1 );
	}
	return clave;
}


/*Función para generar un numero aleatorio*/
function getNumero(min,max)
{
	return Math.floor( Math.random() * ( max - min ) ) + min;
}