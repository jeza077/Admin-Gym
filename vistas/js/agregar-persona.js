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
    // $longitud = 10; //numero de caracteres
    // $clave = generarClave($longitud); 
    $clave = generatePasswordRand(10, 'rand')
    console.log($clave);
    $('.passwordGenerado').val($clave);
    if(/^(\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.,"'|´;])\S{8,16}$/.test($clave)){
        console.log('Bien')
    } else {
        console.log('mal')

    }
});

function generatePasswordRand(length,type) {
    switch(type){
        case 'num':
            characters = "0123456789";
            break;
        case 'alf':
            characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            break;
        case 'rand':
            //FOR ↓
            break;
        default:
            characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            break;
    }
    var pass = "";
    if(/^(\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.,"'|´;])\S{8,16}$/.test(pass)){
        return pass;
    } else {
        for (i=0; i < length; i++){
            if(type == 'rand'){
                pass += String.fromCharCode((Math.floor((Math.random() * 100)) % 94) + 33);
            }else{
                pass += characters.charAt(Math.floor(Math.random()*characters.length));   
            }
        }
        return pass;
    }
}

// /*Función principal | Generador de claves*/
// function generarClave(long){
// 	/*caracteres permitidos*/
// 	let caracteres = "Aa0BbCc1DdEe2FfGgHh3IiJj4KkLl5MmNn6OoPp7QqRr8SsTt9UuVv*#.%!@WwXxYyZz$",
// 		clave = '',
// 		numero;

//     /*creacion de clave*/
//     if(/^(\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/.test(clave)){      
//         return "bien";
//     } else {
//         for(let i=0;i<long;i++){
//             numero = getNumero( 0, caracteres.length );
//             clave += caracteres.substring( numero, numero + 1 );
//         }  
//         return "mal";
//     }
// }
// /*Función para generar un numero aleatorio*/
// function getNumero(min,max){
// 	return Math.floor( Math.random() * ( max - min ) ) + min;
// }