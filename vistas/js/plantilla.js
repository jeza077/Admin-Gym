/*=============================================
    INPUT MASK
=============================================*/
//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()


/*=============================================
    DATATABLES
=============================================*/
$(".tablas").DataTable({
    "responsive": true,
    "autoWidth": false,

    "language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}
  });


//*============================================
//*     SIDEBAR MENU ACTIVO COLOR AZUL
//*============================================
var pathname = window.location.href;
const claseActivo = $('.menu-lateral');
// console.log(claseActivo[3]);
var stock = claseActivo[3];

for (let i = 0; i < claseActivo.length -1; i++) {
    // console.log(claseActivo[i]['href']);
    if(pathname == claseActivo[i]['href']){
        $(claseActivo[i]).addClass('active');     
        break;
    }
    if(pathname == 'http://localhost/gym/equipo' || pathname == 'http://localhost/gym/productos'){
        $(stock).addClass('active')
    }
}


//*=============================================
//* FUNCION QUE DETERMINE LA LONGITUD DE STRINGS
//*=============================================
function longitudString(selector, maxLongitud) {
	selector.keydown(function (e) {

		var valor = $(this).val();
		var codigo = e.which || e.keyCode;
		// console.log(valor.length)
		// console.log(codigo)

		if(valor.length >= maxLongitud && codigo != 8  && codigo != 116 && codigo != 9){
			e.preventDefault();
		}
	});
}

//** VALIDACIONES GLOBALES */
longitudString($('input[type=password]'),16); //Longitud maxima Input tipo Password Global.
$('input[type=password]').keydown(impedirEspacios); //Evitar espacios en Input de tipo Password, Global.
$('input[type=email]').keydown(impedirEspacios); // Evitar espacios en Input de tipo Email, Global.



//* ===================================================
//*FUNCION PARA VERIFICAR SI HAY ESPACIOS EN UN STRING
//**===================================================
function impedirEspacios(event) {
    var codigo = event.which || event.keyCode;

    if(codigo === 32){
        event.preventDefault();
        // $(this).parent().parent().after('<div class="alert alert-danger mt-2">No se aceptan espacios.</div>');
        // var identificador = $(this);
        // setTimeout(function () {
        //     $('.alert').remove();
        //     identificador.val('');
        //     identificador.attr('disabled', false);
        //     identificador.focus();
        // }, 2000)
        // $(this).attr('disabled', true);
    } else {
        $('.alert').remove();
    }
     
}


//*=======================================================
//*FUNCION PARA PERMITIR 1 SOLO ESPACIO ENTRE CADA PALABRA
//*=======================================================
var teclaAnterior = "";
function permitirUnEspacio(event) {
    teclaAnterior = teclaAnterior + " " + event.keyCode;
    var arregloTA = teclaAnterior.split(" ");
    if (event.keyCode == 32 && arregloTA[arregloTA.length - 2] == 32) {
        event.preventDefault();
    }     
}


//*==========================================
//*		FUNCION PARA VALIDAR EMAIL	
//*===========================================
function validarEmail(selector) {
	selector.blur(function() {
		var emailIngresado = selector.val();

		var datos = new FormData();
		datos.append("verificarEmail", emailIngresado);
	
		$.ajax({
	
			url:"ajax/usuarios.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,  
			dataType: "json",
			success: function(respuesta) {
				// console.log(respuesta);
	
				if(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(emailIngresado) && respuesta){
					// selector.after('<div class="alert alert-warning mt-2">Email ya existente, ingrese uno diferente.</div>');
					// setTimeout(function () {
					// 	$('.alert').remove();
					// }, 3000)
					Swal.fire({
						title: "Email ya existente, ingrese uno diferente.",
						icon: "error",
						background: "rgb(255 75 75 / 85%)",
						toast: true,
						position: "top",
						showConfirmButton: false,
						timer: 3000
					});
					
					//E inmeditamente Limpiamos el input
					selector.val("");
					// selector.focus();
				} else if(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(emailIngresado) && respuesta == false) {
					selector.addClass('border-valid').removeClass('border-invalid');
					// setTimeout(function () {
					// 	selector.removeClass('border-valid');
					// }, 3000)
				} else if(emailIngresado == ""){
					selector.removeClass('border-valid border-invalid');
				} else {
					selector.addClass('border-invalid').removeClass('border-valid');
					selector.after('<div class="alert alert-warning mt-2">Correo invalidido, intente de nuevo.</div>');
					setTimeout(function () {
						$('.alert').remove();
					}, 3000)
					
					//E inmeditamente Limpiamos el input
					selector.val("");
					// selector.focus();
					
				}
			}
	
		});

	})
}


//*==========================================
//*		FUNCION REQUISITOS PARA CONTRASEÑA
//*===========================================
var letra = /[A-z]/;
var mayus = /[A-Z]/;
var minus = /[a-z]/;
var num = /\d/;
var caracEspe = /[!@#$&*?.,]/;
var long = /^.{8,16}$/;

function requisitosPassword(){  
    
    $(".nueva-password").keyup(function() { 
        var editPassword = $(this).val();
        
        //validar que tenga una letra
        if(editPassword.match(letra)){
            $(".letter").removeClass('invalid').addClass('valid');
        } else {
            $(".letter").removeClass('valid').addClass('invalid');
        }
    
        //validar que tenga una letra Mayuscula
        if(editPassword.match(mayus)){
            $(".capital").removeClass('invalid').addClass('valid');
        } else {
            $(".capital").removeClass('valid').addClass('invalid');
        }
    
        //validar que tenga un numero
        if(editPassword.match(num)){
            $(".number").removeClass('invalid').addClass('valid');
        } else {
            $(".number").removeClass('valid').addClass('invalid');
        }
    
        //validar que tenga un caracter especial
        if(editPassword.match(caracEspe)){
            $(".special").removeClass('invalid').addClass('valid');
        } else {
            $(".special").removeClass('valid').addClass('invalid');
        }

        //validar longitud
        if(editPassword.match(long)){
            $(".length").removeClass('invalid').addClass('valid');
        } else {
            $(".length").removeClass('valid').addClass('invalid');
        }
        
    }).focus(function() {  
        // $(".requisito-password").show();
        Swal.fire({
            // icon: "info",
            width: 350,
            html: 
            '<i class="rp-info fas fa-info-circle"></i> ' +
              '<div class="requisito-password"> ' +
              '<h4>La contraseña debe cumplir con los siguientes requerimientos:</h4> ' +
                '<ul> ' +
                '<li class="letter">Al menos debe tener <strong>una letra</strong></li> ' +
                '<li class="capital">Al menos debe tener <strong>una letra en mayuscula</strong></li> ' +
                '<li class="number">Al menos debe tener <strong>un numero</strong></li> ' +
                '<li class="special">Al menos debe tener <strong>un caracter especial</strong></li> ' +
                '<li class="length">Al menos debe tener <strong>8 caracteres como minimo y 16 maximo</strong></li> ' +
                '</ul> ' + 
              '</div>',
            toast: true,
            position: "center-end",
            showConfirmButton: false,
        })
        // $(".login-box").addClass('contenedor-rp');
    }).blur(function() { 
        // $(".requisito-password").hide();
        Swal.close();
        // $(".login-box").removeClass('contenedor-rp');
    });
}


//*==========================================
//*	   FUNCION PARA CONFIRMAR CONTRASEÑA	
//*===========================================
function confirmarContraseña(nuevaPass, confirmarPass, botonCambiarPass) {
    if(confirmarPass == nuevaPass){
        $('.resultado-password').text('Correcto');
        $('.resultado-password').addClass('valid').removeClass('invalid');
        $('input.nueva-password').addClass('valid border-valid').removeClass('invalid border-invalid');
        $('input.confirmar-password').addClass('valid border-valid').removeClass('invalid border-invalid');
        botonCambiarPass.attr('disabled', false);                                              
    } else {
        $('.resultado-password').text('Contraseñas no coinciden');
        $('.resultado-password').addClass('invalid').removeClass('valid');
        $('input.nueva-password').addClass('invalid border-invalid').removeClass('valid border-valid');
        $('input.confirmar-password').addClass('invalid border-invalid').removeClass('valid border-valid');
        botonCambiarPass.attr('disabled', true);
    }
}


//*==========================================
//*		FUNCION MOSTRAR CONTRASEÑAS
//*===========================================
function mostrarContraseña(selector, mostrar, action) {
    if(action == 'hide'){
        selector.attr('type', 'text')
        mostrar.removeClass('far fa-eye').addClass('far fa-eye-slash').attr('action', 'show')
    }

    if(action == 'show'){
        selector.attr('type', 'password')
        mostrar.removeClass('far fa-eye-slash').addClass('far fa-eye').attr('action', 'hide')
    }
}
/*=============================================
    Sin numeros
=============================================*/
// function sinNumeros(event) {
//     var codigo = event.which || event.keyCode;

//     if(codigo === 48,49,50,51,52,53,54,55,56,57){
//         event.preventDefault();
//         // $(this).parent().parent().after('<div class="alert alert-danger mt-2">No se aceptan numeros.</div>');
//         // var identificador = $(this);
//         // setTimeout(function () {
//         //     $('.alert').remove();
//         //     identificador.val('');
//         //     identificador.attr('disabled', false);
//         //     identificador.focus();
//         // }, 2000)
//         // $(this).attr('disabled', true);
//     } else {
//         // $('.alert').remove();
//         console.log(codigo)
//     }
     
// }

// $('.nombre').keydown(sinNumeros)
/*=============================================
    Sin caracteres
=============================================*/
// function sinCaracteres(event) {
//     var codigo = event.which || event.keyCode;

//     if(codigo === 92,64,164,35,33,95,42,126,45){
//         event.preventDefault();
//         // $(this).parent().parent().after('<div class="alert alert-danger mt-2">No se aceptan espacios.</div>');
//         // var identificador = $(this);
//         // setTimeout(function () {
//         //     $('.alert').remove();
//         //     identificador.val('');
//         //     identificador.attr('disabled', false);
//         //     identificador.focus();
//         // }, 2000)
//         // $(this).attr('disabled', true);
//     } else {
//         $('.alert').remove();
//     }
     
// }

// $('.nombre').keydown(sinCaracteres)
/*=============================================
    FUNCION VALIDAR DOCUMENTO
=============================================*/
function validarDocumento(selector) {
	selector.blur(function() {
        var documentoIngresado = selector.val();
        // console.log(selector)

		var datos = new FormData();
		datos.append("verificarDocumento", documentoIngresado);
	
		$.ajax({
	
			url:"ajax/personas.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,  
			dataType: "json",
			success: function(respuesta) {
                // console.log(respuesta);

                // if (select2 === 3) {
                //     if (/^[a-zA-Z0-9]$/.test(documentoIngresado) && respuesta) {
                //         Swal.fire({
                //             title: "Email ya existente, ingrese uno diferente.",
                //             icon: "error",
                //             background: "rgb(255 75 75 / 85%)",
                //             toast: true,
                //             position: "top",
                //             showConfirmButton: false,
                //             timer: 3000
                //         });
                //     } else {

                //     }

                // } else if () {

                if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(documentoIngresado) && respuesta){
					// selector.after('<div class="alert alert-warning mt-2">Email ya existente, ingrese uno diferente.</div>');
					// setTimeout(function () {
					// 	$('.alert').remove();
					// }, 3000)
					Swal.fire({
						title: "Email ya existente, ingrese uno diferente.",
						icon: "error",
						background: "rgb(255 75 75 / 85%)",
						toast: true,
						position: "top",
						showConfirmButton: false,
						timer: 3000
					});
					
					//E inmeditamente Limpiamos el input
					selector.val("");
					// selector.focus();
				} else if(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(documentoIngresado) && respuesta == false) {
					selector.addClass('border-valid').removeClass('border-invalid');
					// setTimeout(function () {
					// 	selector.removeClass('border-valid');
					// }, 3000)
				} else if(documentoIngresado == ""){
					selector.removeClass('border-valid border-invalid');
				} else {
					selector.addClass('border-invalid').removeClass('border-valid');
					selector.after('<div class="alert alert-warning mt-2">Correo invalidido, intente de nuevo.</div>');
					setTimeout(function () {
						$('.alert').remove();
					}, 3000)
					
					//E inmeditamente Limpiamos el input
					selector.val("");
					// selector.focus();
					
				}
			}
	
		});

	})
}


validarDocumento($('.id'));