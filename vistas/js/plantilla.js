/*=============================================
    INPUT MASK
=============================================*/
//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

window.onload = agregarClase;
function agregarClase() {
$('#DataTables_Table_0_filter input[type=search]').addClass('ClaseBuscar');
}

/*=============================================
****    FUNCION ALERTAS
=============================================*/
const alertaDinamica = (titulo, texto, icono) => {
    var pathname = window.location.href;
    // $host= $_SERVER["HTTP_HOST"];
    // $url= $_SERVER["REQUEST_URI"];
    // $urlF = "http://" . $host . $url;
    if(pathname == 'http://localhost/admin/dashboard'){
        Swal.fire({
            title: titulo,
            text: texto,
            icon: icono,
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
        });
    }

}

// alertaDinamica('hola', 'prueba', 'warning')

// setTimeout(() => {
    
//     alertaDinamica('holaHola', 'prueba2', 'warning')
// }, 3000);


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

// FUNCION DATATABLE DINAMICA
const lenguageDataTable = (selector, archivoAjax) => {

    $(selector).DataTable( {
        "responsive": true,
        "autoWidth": false,    
        "ajax": archivoAjax,
        "deferRender": true,
        "retrieve": true,
        "processing": true,
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
    
    } );
    
}


 //Initialize Select2 Elements
 $('.select2').select2()

 //Initialize Select2 Elements
 $('.select2bs4').select2({
   theme: 'bootstrap4'
 })


//*============================================
//*     SIDEBAR MENU ACTIVO COLOR AZUL
//*============================================
var pathname = window.location.href;
const claseActivo = $('.menu-lateral');
// console.log(claseActivo[4]);
var stock = claseActivo[3];
var ventas = claseActivo[4];

for (let i = 0; i < claseActivo.length; i++) {
    // console.log(claseActivo[i]['href']);
    if(pathname == claseActivo[i]['href']){
        $(claseActivo[i]).addClass('active');     
        break;
    }
    if(pathname == 'http://localhost/admin/productos' || pathname == 'http://localhost/admin/equipo'){
        $(stock).addClass('active');
    }
    if(pathname == 'http://localhost/admin/administrar-venta' || pathname == 'http://localhost/admin/crear-venta' || pathname == 'http://localhost/admin/reportes'){
        $(ventas).addClass('active');
    }
}


/*=============================================
    DATERANGE PICKER
  ===========================================*/
function datarangeDinamico(selector1, selector2, nombreRangoStorage, ruta) {
    var nombreStorage = nombreRangoStorage;
    selector1.daterangepicker({
    ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
        'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
        'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
        'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
    },
    function (start, end) {
        selector2.html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    
        var fechaInicial = start.format('YYYY-MM-DD');

        var fechaFinal = end.format('YYYY-MM-DD');

        nombreRangoStorage = selector2.html();
        // console.log(nombreRangoStorage)
        localStorage.setItem(nombreStorage, nombreRangoStorage);

        window.location = "index.php?ruta="+ruta+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
    }
)
}

/*=============================================
        DATARANGE CAPTURAR HOY
=============================================*/  
function datarangeDinamicoHoy(selector, nombreRangoStorageActual, valorRangoStorage, ruta) {

    // var nombreStorage = nombreRangoStorage;
  
    $(document).on("click", selector, function(){
  
      var textoHoy = $(this).attr("data-range-key");
      console.log(textoHoy)
      if(textoHoy == "Hoy"){
    
        var d = new Date();
    
        var dia = d.getDate();
        var mes = d.getMonth()+1;
        var año = d.getFullYear();
    
        //   if(mes < 10){
    
        //       var fechaInicial = año+"-0"+mes+"-"+dia;
        //       var fechaFinal = año+"-0"+mes+"-"+dia;
    
        //   }else if(dia < 10){
    
        //       var fechaInicial = año+"-"+mes+"-0"+dia;
        //       var fechaFinal = año+"-"+mes+"-0"+dia;
    
        //   }else if(mes < 10 && dia < 10){
    
        //       var fechaInicial = año+"-0"+mes+"-0"+dia;
        //       var fechaFinal = año+"-0"+mes+"-0"+dia;
    
        //   }else{
    
        //       var fechaInicial = año+"-"+mes+"-"+dia;
        //       var fechaFinal = año+"-"+mes+"-"+dia;
    
        //   }	
    
        // dia = ("0"+dia).slice(-2);
        // mes = ("0"+mes).slice(-2);
    
        var fechaInicial = año+"-"+mes+"-"+dia;
        var fechaFinal = año+"-"+mes+"-"+dia;	
    
        localStorage.setItem(nombreRangoStorageActual, valorRangoStorage);
    
        window.location = "index.php?ruta="+ruta+"&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
    
      }
    
    })
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
function validarEmail(selector, alerta) {
	selector.blur(function() {
        $('.alert').remove();

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
                
                    alerta.append('<div class="alert alert-danger fade show mt-2" role="alert"><i class="icon fas fa-ban"></i>Email ya existente, ingrese uno diferente.</div>');
                    
					// Swal.fire({
					// 	title: "Email ya existente, ingrese uno diferente.",
					// 	icon: "error",
					// 	// background: "rgb(255 75 75 / 85%)",
					// 	toast: true,
					// 	position: "top",
					// 	showConfirmButton: false,
					// 	timer: 3000
					// });
					
					//E inmeditamente Limpiamos el input
					// selector.val("");
					selector.focus();
				} else if(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(emailIngresado) && respuesta == false) {
					selector.addClass('border-valid').removeClass('border-invalid');
					// setTimeout(function () {
					// 	selector.removeClass('border-valid');
					// }, 3000)
				} else if(emailIngresado == ""){
					selector.removeClass('border-valid border-invalid');
				} else {
					selector.addClass('border-invalid').removeClass('border-valid');
					selector.after('<div class="alert alert-warning mt-2">Correo inválido, intente de nuevo.</div>');
					setTimeout(function () {
						$('.alert').remove();
					}, 3000)
					
					//E inmeditamente Limpiamos el input
					// selector.val("");
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
var caracEspe = /[!@#$%*-,_+?¡¿=&.]/;
var long = /^.{8,16}$/;

function requisitosPassword(posicion){  
    
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
                '<li class="capital">Al menos debe tener <strong>una letra en mayúscula</strong></li> ' +
                '<li class="number">Al menos debe tener <strong>un número</strong></li> ' +
                '<li class="special">Al menos debe tener <strong>un caracter especial</strong></li> ' +
                '<li class="length">Al menos debe tener <strong>8 caracteres como mínimo y 16 máximo</strong></li> ' +
                '</ul> ' + 
              '</div>',
            toast: true,
            position: posicion,
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
    ALERTAS
=============================================*/
function alertas(modulo) {
    let pathname = window.location.href;
    if(pathname == 'http://localhost/gym/'+modulo){
        Swal.fire({
            title: "Prueba alerta.",
            icon: "error",
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 5000
        });

    }
        
}

/*=============================================
    Sin numeros
=============================================*/
function sinNumeros(event) {
    var codigo = event.which || event.keyCode;
    // console.log(codigo);
    if(codigo >= 48 && codigo <= 57  || codigo >= 97  && codigo <= 105){
        event.preventDefault();

    } else {
        $('.alert').remove();
    }
     
}

/*=============================================
    Sin letras
=============================================*/
function sinLetras(event) {
    var codigo = event.which || event.keyCode;
    // console.log(codigo);

    if(codigo >= 65 && codigo <= 90 || codigo == 192){
        event.preventDefault();

    } else {
        $('.alert').remove();
    }
     
}

/*=============================================
    Sin caracteres
=============================================*/
function sinCaracteres(event) {
    var key = event.which || event.keyCode;
    // console.log(key)

    if(key == 106 || key == 107 || key == 109 || key == 110 || key == 111 || key == 186 ||key == 187 ||key == 188 || key == 189 || key == 190 || key == 191 || key == 219 || key == 220 || key == 221 || key == 222) {
        event.preventDefault();
    } else {
        $('.alert').remove();
    }
     
}

/*=============================================
    FUNCION VALIDAR DOCUMENTO
=============================================*/
function validarDoc(selector, alerta) {
    selector.blur(function() {
        var documentoIngresado = selector.val();
        $('.alert').remove();
        // console.log(documentoIngresado)
    
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
    
                if(respuesta){
                    alerta.append('<div class="alert alert-danger fade show mt-2" role="alert"><i class="icon fas fa-ban"></i>Numero de documento ya existente, ingrese uno diferente.</div>');

                    selector.css('border', '1px solid red');
                    selector.focus();
                } else {
                    $('.alert').remove();
                    selector.css('border', '1px solid green');

                }
            }
        });
    })
}


/*=============================================
    FUNCION CONVERTIR A MAYUSCULAS
=============================================*/
$(document).on('keyup', '.mayus', function () { 
    var valor = $(this);
    // console.log(valor.val());
    valor.val(valor.val().toUpperCase());
});

/** ------------------------------------*/
//     FUNCION BORRAR DINAMICO
// --------------------------------------*/ 
function borrarDinamico(btnSelector, atributo, nombreGet, mensajeTitulo, mensajeTexto, ruta) {

    $(document).on('click', btnSelector, function () {

        var id = $(this).attr(atributo);

        Swal.fire({
            title: mensajeTitulo,
            text: mensajeTexto,
            icon: "info",
            showCancelButton: true,
            cancelButtonColor: "#DC3545",
            heightAuto: false,
            allowOutsideClick: false
        }).then((result)=>{
            if(result.value){
                window.location = `index.php?ruta=${ruta}&${nombreGet}=${id}`;
                
            }
        });
    });

}

/** ------------------------------------*/
//     FUNCION CANCELAR ALERTA
// --------------------------------------*/ 
function cancelarAlerta(btnCancelar) {
    $(document).on('click', btnCancelar, function (e) { 
        e.preventDefault();
        Swal.close();
    });
}

/*=============================================
    FUNCION VERIFCAR DOCUMENTO
=============================================*/
// function verificarDocumento(selector) { 
//     selector.change(function (e) { 
//         e.preventDefault();
        
//         var valorTipoDocumento = $(selector).val();
//         console.log(valorTipoDocumento);
    
//         if (valorTipoDocumento == 1 ) {
//             $('.idCliente').on('keypress', (e) => {
//                 //Obtenemos el código ASCII de la tecla pulsada
//                 let teclaPulsada = e.charCode;
                
//                 //Validamos el rango en el que se encuentran los caracteres No permitidos
//                 if (teclaPulsada >= 33 && teclaPulsada < 48 || teclaPulsada >= 58 && teclaPulsada < 128 || teclaPulsada >= 166 && teclaPulsada < 255) {
//                   //Con return false, bloqueamos el ingreso de estos caracteres
//                   return false;
//                 } 
//             });
//             console.log("Uno")
//         } else if (valorTipoDocumento == 2) {
//             $('.idCliente').on('keypress', (e) => {
//                 //Obtenemos el código ASCII de la tecla pulsada
//                 let teclaPulsada = e.charCode;
                
//                 //Validamos el rango en el que se encuentran los caracteres No permitidos
//                 if (teclaPulsada >= 33 && teclaPulsada < 48 || teclaPulsada >= 58 && teclaPulsada < 128 || teclaPulsada >= 166 && teclaPulsada < 255) {
//                   //Con return false, bloqueamos el ingreso de estos caracteres
//                   return false;
//                 } 
//             });
//             console.log("dos")
//         } else {
//             console.log("tres")
//         }
//     });
// }


// VALIDAR FECHAS QUE NO PASE EL AÑO MAS DEL INDICADO
$(document).on('blur', '.fecha', function () { 
    // e.preventDefault();
    
    let fecha = $('.fecha').val();
    // console.log(fecha);
    
    esFecha(fecha, $('.fecha'));
});
$(document).on('blur', '.fechaEditar', function () { 
    // e.preventDefault();
    
    let fecha = $('.fechaEditar').val();
    // console.log(fecha);
    
    esFecha(fecha, $('.fechaEditar'));
});
function esFecha(fecha,selector){
    $('.alert').remove();

    let parametro = 'ADMIN_MIN_FECHA';
    var datos = new FormData();
    datos.append("parametro", parametro)

    $.ajax({

        url:"ajax/mantenimiento.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {
            // console.log(respuesta['valor']);

            minFecha = respuesta['valor'];
     
            
            parametro = 'ADMIN_MAX_FECHA';
            datos = new FormData();
            datos.append("parametro", parametro)
        
            $.ajax({
        
                url:"ajax/mantenimiento.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,  
                dataType: "json",
                success: function(respuesta) {
                    // console.log(respuesta);
        
                    maxFecha = respuesta['valor'];
             
                    
                        if( (trim(fecha) == "") || (trim(fecha).length != 10) )
                            return false;
                            var anio = parseInt(fecha.substr(0,4), 10);
                            var mes  = parseInt(fecha.substr(5,2), 10);
                            var dia  = parseInt(fecha.substr(8,2), 10);
                            // console.log(anio);
                            // console.log(mes);
                            // console.log(dia);
                    
                            let padre = selector.closest('.form-row');
                            // console.log(padre);
                    
                            // let anioActual = (new Date).getFullYear();
                            // let anioAnterior = anioActual - 15
                            // console.log(anioAnterior);0
                    
                    
                            // Año
                            if( isNaN(anio) || (anio < minFecha) || anio > maxFecha) {
                    
                                // console.log('no se aceptan menor a 1950')
                                padre.before('<div class="alert alert-danger fade show mt-2" role="alert"><i class="icon fas fa-ban"></i>Ingrese un año valido. Entre '+ minFecha+' y ' + maxFecha + '</div>');
                                setTimeout(function () {
                                    $('.alert').remove();
                                }, 3000)
                                
                                // $('.fecha').css('border', '1px solid red');
                                selector.focus();
                                // return false;
                            } else {
                                $('.alert').remove();
                            }
                            // Mes
                            if( isNaN(mes) || (mes < 1) || (mes > 12) )
                                return false;
                            // Día
                            if( isNaN(dia) || (dia < 1) || (dia > 31) )
                                return false;
                            else {
                            if( (dia == 31) && ((mes == 4 ) || (mes == 6) || (mes == 9) || (mes == 11)) )
                                return false;
                            var diaMax = 31;
                            if( (anio % 4 == 0) && (anio % 100 != 0) || (anio % 400 == 0) )
                                diaMax = 29;
                            else
                                diaMax = 28;
                            if( dia > diaMax )
                                return false;
                        }
                }
        
            });
        }

    });

        return true;
}
// Elimina espacios al principio y fin de la fecha
function trim(fecha){
    fecha += "";
    fecha = fecha.replace(/^\s+/, '');
    return fecha.replace(/\s+$/, '');
}
/*=============================================
    EJECUCION DE VALIDACIONES
=============================================*/
$('.sinLetras').keydown(sinLetras)
$('.sinCaracteres').keydown(sinCaracteres)
$('.sinNumeros').keydown(sinNumeros)

validarEmail($('.email'), $('.alertaEmail')); //Validar que no exista en DB, email de la persona ingresada
$('.nombre').keydown(sinNumeros)
$('.nombre').keydown(sinCaracteres)
$('.apellidos').keydown(sinNumeros)
$('.apellidos').keydown(sinCaracteres)
$('.nuevoUsuario').keydown(sinNumeros)
$('.nuevoUsuario').keydown(sinCaracteres)
longitudString($('.nuevoUsuario'),45); //Longitud maxima de Usuario.
longitudString($('.longitudCantidad'),15);
longitudString($('.cantidadInt'),11);
    
//** VALIDACIONES GLOBALES */
longitudString($('input[type=password]'),100); //Longitud maxima Input tipo Password Global.
longitudString($('input[type=email]'),100);  //Longitud maxima Input email globa.
longitudString($('.longitudDireccion'),100);
longitudString($('.longitudValorParam'),100);
longitudString($('.longitudNombre'),45);
longitudString($('.longitudDocumento'),45);
longitudString($('.longitudEntero'),11);
$('input[type=password]').keydown(impedirEspacios); //Evitar espacios en Input de tipo Password, Global.
$('input[type=email]').keydown(impedirEspacios); // Evitar espacios en Input de tipo Email, Global.
$('.sinEspacioDoc').keydown(impedirEspacios);
$('.soloUnEspacio').keydown(permitirUnEspacio);

$( '.preciom').keydown(impedirEspacios)
$( '.preciom').keydown(sinCaracteres)
$( '.preciom').keydown(sinLetras)



/*=============================================
    FUNCION PARA CREAR GRAFICOS DINAMICOS
=============================================*/
function crearGrafico(contenedor, nombre, cantidad, tipoChart, colores){
        
    if(colores.length == 0){
        colores = ["red","green","yellow","lightblue","purple","blue","cyan","magenta","orange","gold"];
    }
    var pieChartCanvas = $(contenedor).get(0).getContext('2d')
    var pieData = {

        labels: nombre,
        datasets: [
        {
            data: cantidad,
            backgroundColor: colores
        }
        ]
    }
    var pieOptions = {
        legend: {
        display: false
        }
    }

    var myChart = new Chart(pieChartCanvas, {
        type: tipoChart,
        data: pieData,
        options: pieOptions
    })

}




$('#daterange-btn-bitacora').on('click', function () {  
    $('.daterangepicker').addClass('reporteBitacora');
});

datarangeDinamico($('#daterange-btn-bitacora'), $('#daterange-btn-bitacora span'), 'capturarRangoBitacora', 'bitacora');

/*=============================================
        CAPTURAR HOY
=============================================*/  
datarangeDinamicoHoy(".daterangepicker.reporteBitacora .ranges li", 'capturarRangoBitacora', 'Hoy', 'bitacora');




valorBuscar = "";
$(document).on('blur', '.ClaseBuscar', function () {
    // console.log($('.ClaseBuscar').val())
  valorBuscar = $('.ClaseBuscar').val();
});

//** ------------------------------------*/
//         IMPRIMIR PDF BITACORA
// --------------------------------------*/ 
exportarPdf('.btnExportarBitacora', 'bitacora');

function exportarPdf(btnExportar, rutaArchivoPdf) {
    
    $(document).on('click', btnExportar, function (e) {
        // console.log("click");
        // return;
        // console.log(valorBuscar);
        if(!valorBuscar){
            window.open("extensiones/tcpdf/pdf/"+rutaArchivoPdf+"-pdf.php");
        } else {
            var rango = valorBuscar;
            window.open("extensiones/tcpdf/pdf/"+rutaArchivoPdf+"-pdf.php?&rango="+rango);
        }

        /*
        function getQueryVariable(variable) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i=0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if(pair[0] == variable) {
                    return pair[1];
                }
            }
            return false;
          }


          var fechaInicial = getQueryVariable('fechaInicial');
          var fechaFinal = getQueryVariable('fechaFinal')
          // console.log(fechaInicial)
          
        //   if(fechaInicial == false && fechaFinal == false) {
        //     // console.log('si')
        //     // window.open("extensiones/tcpdf/pdf/ventas-pdf.php?&fechaInicial="+null+"&fechaFinal="+null);
        //     window.open("extensiones/tcpdf/pdf/"+rutaArchivoPdf+"-pdf.php", "_blank");
        //   } else {
        //     // console.log('no')
        //     window.open("extensiones/tcpdf/pdf/"+rutaArchivoPdf+"-pdf.php?&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal);
        //   }
      

        if(!valorBuscar && fechaInicial == false && fechaFinal == false){
            window.open("extensiones/tcpdf/pdf/"+rutaArchivoPdf+"-pdf.php");
        
        } else if(valorBuscar && fechaInicial == false && fechaFinal == false){
            var rango = valorBuscar;
            window.open("extensiones/tcpdf/pdf/"+rutaArchivoPdf+"-pdf.php?&rango="+rango);
        
        }else {
            window.open("extensiones/tcpdf/pdf/"+rutaArchivoPdf+"-pdf.php?&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal);
            // var rango = valorBuscar;
            // window.open("extensiones/tcpdf/pdf/"+rutaArchivoPdf+"-pdf.php?&rango="+rango);
        }
        */


    //     e.preventDefault();
    //     function getQueryVariable(variable) {
    //       var query = window.location.search.substring(1);
    //       var vars = query.split("&");
    //       for (var i=0; i < vars.length; i++) {
    //           var pair = vars[i].split("=");
    //           if(pair[0] == variable) {
    //               return pair[1];
    //           }
    //       }
    //       return false;
    //     }
    
    //    // console.log(window.location.search.substring(15));
    //    // console.log(getQueryVariable('fechaFinal'));
    
    //     var fechaInicial = getQueryVariable('fechaInicial');
    //     var fechaFinal = getQueryVariable('fechaFinal')
    //     // console.log(fechaInicial)
        
    //     if(fechaInicial == false && fechaFinal == false) {
    //       // console.log('si')
    //       // window.open("extensiones/tcpdf/pdf/ventas-pdf.php?&fechaInicial="+null+"&fechaFinal="+null);
    //       window.open("extensiones/tcpdf/pdf/bitacora-pdf.php", "_blank");
    //     } else {
    //       // console.log('no')
    //       window.open("extensiones/tcpdf/pdf/bitacora-pdf.php?&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal);
    //     }
    
    });
}


//** ------------------------------------*/
//    FUNCION SELECT PARA PROVEEDORES
// --------------------------------------*/ 
function selectDinamico() {
    
    var tabla = 'tbl_proveeedores';
    var datos = new FormData();
    datos.append("tabla", tabla);
    
    $.ajax({ 
        url:"ajax/inventario.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            // console.log(respuesta)

            if(respuesta) {
                // $('#nuevoProveedor').addClass('select2');
                $("#selectProveedor").prepend("<select class='form-control select2' id='nuevoProveedor' style='width: 100%;' name='nuevoProveedor'></select>");
                
                $("#nuevoProveedor").append("<option selected='selected'>Seleccionar...</option>");

                for(var i in respuesta){
                    // console.log(respuesta[i][1]);
                    $("#nuevoProveedor").append("<option value="+respuesta[i]['id_proveedor']+">"+respuesta[i]['nombre']+"</option>");
                }
            }
        }    
    });
}


//** ------------------------------------*/
//   FUNCION PARA CERRAR MODAL
// --------------------------------------*/ 
function cerrarModal() {
    
    $(document).on('click', '.modalClose', function (e) {
        e.preventDefault();

        Swal.fire({
            icon: "info",
            title: "¿Está seguro de salir del modal? Perderá la información que haya ingresado.",
            text: "Si no está seguro, puede cancelar la acción.",
            // heightAuto: false,
            allowOutsideClick: false,
            showCancelButton: true,
            showConfirmButton: true,
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: "Si, cerrar",
            cancelButtonText: "Cancelar",
            cancelButtonColor: "#dc3545"
        }).then((result)=>{
            if(result.value){
                $('.cerrar').remove('attr', 'data-dismiss');
                $('.cerrar').attr('data-dismiss', 'modal').click();
            }
        });     
    });

}

cerrarModal();