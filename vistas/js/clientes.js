// VALIDACIONES DE DOCUMENTO
// $('.tipoDocumentoCliente').change(function (e) { 
//     e.preventDefault();
//     $('.idCliente').val("");

//     var valorTipoDocumento =$(this).val();
//     // console.log(valorTipoDocumento);

//     if(valorTipoDocumento === 3){
//         $('.idCliente').keydown(sinNumeros);
//     } else {
//         $('.idCliente').keydown(sinLetras);
//         $('.idCliente').keydown(sinCaracteres);
//     }
// });
// verificarDocumento($('.tipoDocumentoCliente'))

// redireccion('.SwalBtnNuevoCliente', 'clientes');

lenguageDataTable('.tablaClientes', 'ajax/datatable-clientes.ajax.php');


function redireccion(selector, ruta) {
    
    $(document).on('click', selector, function () {
        window.location = ruta;
    });
}
    


//VALIDACIONES AGREGAR CLIENTE
validarDoc($('.numeroDocumento'), $('.alertaDocumento'))
validarEmail($('.emailCliente'))
longitudString($('.nombreCliente'),30); 
$('.nombreCliente').keydown(sinNumeros)
$('.nombreCliente').keydown(sinCaracteres)
$('.nombreCliente').keydown(permitirUnEspacio);
$('.numeroDocumentoCliente').keydown(impedirEspacios);
$('.apellidoCliente').keydown(sinCaracteres)
$('.apellidoCliente').keydown(sinNumeros)
$('.apellidoCliente').keydown(permitirUnEspacio);
longitudString($('.apellidoCliente'),30); 

// VALIDACIONES EDITAR CLIENTE GIMNASIO
validarEmail($('.editarEmail'))
longitudString($('.editarNombre'),30); 
longitudString($('.editarApellido'),30); 
validarDoc($('.editarNumeroDocumento'));
$('.editarNombre').keydown(sinNumeros)
$('.editarNombre').keydown(sinCaracteres)
$('.editarNombre').keydown(permitirUnEspacio);
$('.editarApellido').keydown(sinNumeros)
$('.editarApellido').keydown(sinCaracteres)
$('.editarApellido').keydown(permitirUnEspacio);
$('.editarNumeroDocumento').keydown(impedirEspacios);
// VALIDACIONES EDITAR CLIENTE VENTA
validarEmail($('.editarEmailVentas'))
longitudString($('.nombreClienteVentas'),30);
longitudString($('.apellidoClienteVentas'),30); 
validarDoc($('.numeroDocumentoClienteVentas'));
$('.nombreClienteVentas').keydown(sinNumeros)
$('.nombreClienteVentas').keydown(sinCaracteres)
$('.nombreClienteVentas').keydown(permitirUnEspacio);
$('.apellidoClienteVentas').keydown(sinNumeros)
$('.apellidoClienteVentas').keydown(sinCaracteres)
$('.apellidoClienteVentas').keydown(permitirUnEspacio);
$('.numeroDocumentoClienteVentas').keydown(impedirEspacios);



//** ------------------------------------*/
// AGREGAR CLIENTE 
// MUESTRA LOS DATOS DE PAGO DEL CLIENTE, AL ELEGIR TIPO CLIENTE GIMNASIO
// --------------------------------------*/
$('.datosClientes').hide();
$('.btnNuevoClienteVentas').hide();

$(document).on('change', '.tipoCliente', function () {
    var valor = $(this).val();
    // console.log(valor)
    if (valor == "Gimnasio") {
        // SumaTotal()
        $('.btnNuevoClienteVentas').hide();
        $('.datosClientes').show();
        $('.btnConfirmarPago').show();
        // sumar();
    } else {
        $('.btnNuevoClienteVentas').show();
        $('.btnConfirmarPago').hide();
        $('.datosClientes').hide();
    }
   
});


//** ------------------------------------*/
// ALERTA PARA CONFIRMAR PAGO ANTES DE GUARDAR CLIENTE
// --------------------------------------*/ 
$('.btnNuevoClienteGym').hide();

$(document).on('click', '.btnConfirmarPago', function (e) {
    e.preventDefault();
    // console.log('click')
    Swal.fire({
        icon: 'info',
        title: '¿Se realizo el pago correctamente?',
        html: '<button type="submit" role="button" class="SwalBtnGuardarCliente btn btn-success customSwalBtn">' + 'Si, guardar' + '</button>' +
            '<button type="button" role="button" class="SwalBtnCancelarCliente btn btn-danger customSwalBtn">' + 'No, salir' + '</button>',
        width: 500,
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false
    });
});

$(document).on('click', '.SwalBtnGuardarCliente', function () {
    // $('#btnNuevoCliente').show();
    // $('.btnConfirmarPago').hide();
    // console.log('click')
    // return;
    var btnGuardar = $('.btnNuevoClienteGym');
    btnGuardar.click(); 
    // window.location = ruta;
});

$(document).on('click', '.SwalBtnCancelarCliente', function () {
    // window.location = ruta;
    Swal.close();
});



// EDITAR CLIENTE VENTA
// AL ELEJIR TIPO CLIENTE GIMNASIO MUESTRA LOS DATOS A AGREGAR DE PAGOS CLIENTE
$('#datosClienteVenta').hide();
$(document).on('change', '.tipoClienteVenta', function () {
    var valor = $(this).val();
    // console.log(valor)
    if (valor == "Gimnasio") {
        // SumaTotal()
       
        $('#datosClienteVenta').show();
        // sumar();
    } else {
        $('#datosClienteVenta').hide();
    }
   
});


//** ------------------------------------*/
//     ALERTA AL AGREGAR NUEVO USUARIO
// --------------------------------------*/
$(document).on('click', '#clienteNuevo', function (e) {
    e.preventDefault();
    // console.log('click')
    Swal.fire({
        icon: 'info',
        title: '¿Crear cliente desde una persona ya registrada?',
        html: '<button type="submit" role="button" class="SwalBtnGuardarClienteYaRegistrado btn btn-success customSwalBtn px-5" data-toggle="modal" data-target="#modalAgregarClienteYaRegistrado" data-dismiss="modal">' + 'Si' + '</button>' +
            '<button type="button" role="button" class="SwalGuardarClienteNuevo btn btn-primary customSwalBtn" data-toggle="modal" data-target="#modalAgregarClienteNuevo" data-dismiss="modal">' + 'No, nuevo' + '</button>'+ 
            '<button type="button" role="button" class="SwalBtnCancelar btn btn-danger customSwalBtn">' + 'Cancelar' + '</button>',
        width: 550,
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false
    });
});


cancelarAlerta('.SwalBtnGuardarClienteYaRegistrado');
cancelarAlerta('.SwalGuardarClienteNuevo');
cancelarAlerta('.SwalBtnCancelar');


//** ------------------------------------*/
//        IMPRIMIR PDF CLIENTES 
// --------------------------------------*/ 
exportarPdf('.btnExportarClientes', 'clientes');
exportarPdf('.btnExportarClientesInscripciones', 'clientes-inscripciones');
exportarPdf('.btnExportarClientesInscripcionesHistorico', 'clientes-inscripciones-historico');
exportarPdf('.btnExportarHistorialPagosClientes', 'clientes-pagos-historico');



/*=============================================
        EDITAR CLIENTE GIMNASIO
=============================================*/

$(document).on('click', '.btnEditarClienteGimnasio', function () { 
    
    var idEditarCliente = $(this).attr("idEditarClienteGimnasio");
    var tipoCliente = $(this).attr("tipoClienteGimnasio");
    // console.log(idEditarCliente)
    var datos = new FormData();
    datos.append("idEditarCliente", idEditarCliente);
    datos.append("tipoCliente", tipoCliente)
    // console.log(tipoClienteGimnasio)

    $.ajax({
    
        url:"ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {

            // console.log("respuesta", respuesta);
            
            $('#idEditarCliente').val(respuesta["id_persona"])

            $('#editarTipoDocumento').html(respuesta["tipo_documento"])
            $('#editarTipoDocumento').val(respuesta["id_documento"])

            $('.editarNumeroDocumento').val(respuesta["num_documento"])
            $('.editarNombre').val(respuesta["nombre"])
            $('.editarApellido').val(respuesta["apellidos"])
            $('.editarEmail').val(respuesta["correo"])
            $('.editarTelefono').val(respuesta["telefono"])
            $('.editarFechaNacimiento').val(respuesta["fecha_nacimiento"])
            $('.editarDireccion').val(respuesta["direccion"])
            $('#editarSexo').html(respuesta["sexo"])
            $('#editarSexo').val(respuesta["sexo"])

            // $tipoClienteGimnasio = respuesta["tipo_cliente"];
            // console.log(tipoClienteGimnasio)

            // $('.editarTipoCliente').html(respuesta["tipo_cliente"])
            // $('.editarTipoCliente').attr('value', tipoCliente)
            $('#EditarTipoClienteGimnasio').html(respuesta["tipo_cliente"])
            

            // $('#editarMatricula').html(respuesta["tipo_matricula"])
            // $('#editarMatricula').val(respuesta["id_matricula"])

            // $('#editarPromocion').html(respuesta["tipo_descuento"])
            // $('#editarPromocion').val(respuesta["id_descuento"])
            
            // $('#editarInscripcion').html(respuesta["tipo_inscripcion"])
            // $('#editarInscripcion').val(respuesta["id_inscripcion"])

            // $('.editarPrecioMatricula').val(respuesta["pago_matricula"])
            // $('.editarPrecioPromocion').val(respuesta["pago_descuento"])
            // $('.editarPrecioInscripcion').attr('value', respuesta["pago_inscripcion"])
            // $('.editarTotalPagar').val(respuesta["pago_total"])
            
        }
    });
});

/*============================================================
    MOSTRAR PRECIOS DE MATRICULA, DESCUENTO Y INSCRIPCION
============================================================*/
function mostrarDinamico(selector1,tablaDB,itemDB,selector2,precio) {  
  
    selector1.change(function (e) { 
        e.preventDefault();
        // if (selector1 == $('.nuevaPromocion')){
        //     sumar();    
        // } 
        
        var item = itemDB;
        var valor = selector1.val();
        // console.log(valor)
        // return;
        var tabla = tablaDB;
        var datos = new FormData();
        datos.append("tabla", tabla);
        datos.append("item", item);
        datos.append("valor", valor);
    
        
        $.ajax({
        
            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,  
            dataType: "json",
            success: function(respuesta) {
                // console.log(respuesta);
                // SumaTotal();
                var precioInscripcion = respuesta[precio];            
                //    if (selector1 == $('.nuevaPromocion')){
                    
                    // } 
                selector2.attr("value",precioInscripcion);
                // console.log(selector2.attr("value",precioInscripcion))

            }
        });   
  
    });
}

// MOSTRAR TABLA INSCRIPCION
mostrarDinamico($('.nuevaMatricula'),'tbl_matricula','id_matricula',$('.nuevoPrecioMatricula'),'precio_matricula')

mostrarDinamico($('.nuevaInscripcion'),'tbl_inscripcion','id_inscripcion',$('.nuevoPrecioInscripcion'),'precio_inscripcion')
// MOSTRAR TABLA PROMOCIONES
mostrarDinamico($('.nuevaPromocion'),'tbl_descuento', 'id_descuento',$('.nuevoPrecioPromocion'),'valor_descuento')

// MOSTRAR TABLA INSCRIPCION PARA CLIENTE YA REGISTRADO
mostrarDinamico($('.nuevaMatriculaRegistrado'),'tbl_matricula','id_matricula',$('.nuevoPrecioMatriculaRegistrado'),'precio_matricula')

mostrarDinamico($('.nuevaInscripcionRegistrado'),'tbl_inscripcion','id_inscripcion',$('.nuevoPrecioInscripcionRegistrado'),'precio_inscripcion')
// MOSTRAR TABLA PROMOCIONES PARA CLIENTE YA REGISTRADO
mostrarDinamico($('.nuevaPromocionRegistrado'),'tbl_descuento', 'id_descuento',$('.nuevoPrecioPromocionRegistrado'),'valor_descuento')


// Inscripcion nuevas
mostrarDinamico($('.actualizarInscripcion'),'tbl_inscripcion','id_inscripcion',$('.actualizarPagoInscripcion'),'precio_inscripcion')
mostrarDinamico($('.nuevaTipoInscripcion2'),'tbl_inscripcion','id_inscripcion',$('.nuevaPagoInscripcion2'),'precio_inscripcion')


// mostrarDinamico($('.descuentoNuevo'),'tbl_descuento', 'id_descuento',$('.actualizarPrecioDescuento'),'valor_descuento')  
// MOSTRAR PRECIOS EN EDITAR CLIENTE VENTAS
mostrarDinamico($('.nuevaMatriculaClienteVenta'),'tbl_matricula', 'id_matricula',$('.precioMatriculaClienteVentas'),'precio_matricula')  

mostrarDinamico($('.nuevoDescuentoClienteVenta'),'tbl_descuento', 'id_descuento',$('.valorDescuentoClienteVenta'),'valor_descuento')  

mostrarDinamico($('.nuevaInscripcionClienteVenta'),'tbl_inscripcion', 'id_inscripcion',$('.precioInscripcionClienteVenta'),'precio_inscripcion') 

/*=============================================
        SUMAR TOTAL CLIENTES NUEVOS
=============================================*/
$('.verTotalPago').click(function (e) { 
    e.preventDefault();

    var totalMatricula = $('.totalMatricula').val();
    var totalDescuento = $('.totalDescuento').val();
    var totalInscripcion = $('.totalInscripcion').val();

    // console.log(totalMatricula)
    // console.log(totalInscripcion)

    if(!totalMatricula){
        $('.nuevaMatricula').after('<div class="alert alert-danger fade show mt-2" role="alert">Por favor seleccione un tipo de matricula</div>');
        $('.nuevaMatricula').focus();

    } else if(!totalInscripcion) {
        $('.nuevaInscripcion').after('<div class="alert alert-danger fade show mt-2" role="alert">Por favor seleccione un tipo de inscripcion</div>');
        $('.nuevaInscripcion').focus();

  

    } else {
        $('.alert').remove();
        // console.log(totalDescuento)
        // console.log(totalInscripcion)
        // console.log(totalMatricula)
        if(!totalDescuento){

            var suma = (parseInt(totalMatricula) + parseInt(totalInscripcion));
            var descuento = 0;
            $('input[name=nuevoPrecioDescuento]').attr('value', descuento);
            $('input[name=editarPrecioDescuento]').attr('value', descuento);
        } else {
            var porcentaje = parseInt(totalDescuento) / 100;
            var descuento = ((parseInt(totalMatricula) * porcentaje));
            var suma = (parseInt(totalMatricula) - descuento) + parseInt(totalInscripcion);
            $('input[name=nuevoPrecioDescuento]').attr('value', descuento);
            $('input[name=editarPrecioDescuento]').attr('value', descuento);
            
        }
        // console.log('desc',descuento);
        // console.log('suma',suma)
    
        $('.totalPagar').val(suma);
        

    }
});

// SUMA TOTAL A PAGAR CLIENTES YA REGISTRADOS
$('.verTotalPagoRegistrado').click(function (e) { 
    e.preventDefault();

    var totalMatricula = $('.totalMatriculaRegistrado').val();
    var totalDescuento = $('.totalDescuentoRegistrado').val();
    var totalInscripcion = $('.totalInscripcionRegistrado').val();

    // console.log(totalMatricula)
    // console.log(totalInscripcion)

    if(!totalMatricula){
        $('.nuevaMatriculaRegistrado').after('<div class="alert alert-danger fade show mt-2" role="alert">Por favor seleccione un tipo de matricula</div>');
        $('.nuevaMatriculaRegistrado').focus();

    } else if(!totalInscripcion) {
        $('.nuevaInscripcionRegistrado').after('<div class="alert alert-danger fade show mt-2" role="alert">Por favor seleccione un tipo de inscripcion</div>');
        $('.nuevaInscripcionRegistrado').focus();

  

    } else {
        $('.alert').remove();
        // console.log(totalDescuento)
        // console.log(totalInscripcion)
        // console.log(totalMatricula)
        if(!totalDescuento){

            var suma = (parseInt(totalMatricula) + parseInt(totalInscripcion));
            var descuento = 0;
            $('input[name=nuevoPrecioDescuentoRegistrado]').attr('value', descuento);
            // $('input[name=editarPrecioDescuento]').attr('value', descuento);
        } else {
            var porcentaje = parseInt(totalDescuento) / 100;
            var descuento = ((parseInt(totalMatricula) * porcentaje));
            var suma = (parseInt(totalMatricula) - descuento) + parseInt(totalInscripcion);
            $('input[name=nuevoPrecioDescuentoRegistrado]').attr('value', descuento);
            // $('input[name=editarPrecioDescuento]').attr('value', descuento);
            
        }
        // console.log('desc',descuento);
        // console.log('suma',suma)
    
        $('.totalPagarRegistrado').val(suma);
        

    }
});


// SUMA TOTAL PAGO CLIENTE VENTAS
$('.verTotalPagoCliente').click(function (e) { 
    e.preventDefault();

    var totalMatricula = $('.precioMatriculaClienteVentas').val();
    var totalDescuento = $('.valorDescuentoClienteVenta').val();
    var totalInscripcion = $('.precioInscripcionClienteVenta').val();

    // console.log(totalMatricula)
    // console.log(totalInscripcion)

    if(!totalMatricula){
        $('.nuevaMatriculaClienteVenta').after('<div class="alert alert-danger fade show mt-2" role="alert">Por favor seleccione un tipo de matricula</div>');
        $('.nuevaMatriculaClienteVenta').focus();

    } else if(!totalInscripcion) {
        $('.nuevaInscripcionClienteVenta').after('<div class="alert alert-danger fade show mt-2" role="alert">Por favor seleccione un tipo de inscripcion</div>');
        $('.nuevaInscripcionClienteVenta').focus();

  

    } else {
        $('.alert').remove();
        // console.log(totalDescuento)
        // console.log(totalInscripcion)
        // console.log(totalMatricula)
        if(!totalDescuento){

            var suma = (parseInt(totalMatricula) + parseInt(totalInscripcion));
            var descuento = 0;
            $('input[name=editarPrecioDescuento]').attr('value', descuento);
        } else {
            var porcentaje = parseInt(totalDescuento) / 100;
            var descuento = ((parseInt(totalMatricula) * porcentaje));
            var suma = (parseInt(totalMatricula) - descuento) + parseInt(totalInscripcion);
            $('input[name=editarPrecioDescuento]').attr('value', descuento);
            
        }
        // console.log('desc',descuento);
        // console.log('suma',suma)
    
        $('.totalPagarClienteVenta').val(suma);
        

    }
});

/*=============================================
        SUMAR TOTAL PAGO ACTUALIZADO CLIENTES
=============================================*/

function actualizarSumaTotal(selector) {  

    selector.change(function (e) { 
        e.preventDefault();
        
        var actualizarPrecioDescuento = $('.actualizarPrecioDescuento');
        var actualizarPrecioInscripcion = $('.actualizarPagoInscripcion');
        // console.log("Descuento", actualizarPrecioDescuento)
        // console.log("Inscripcion", actualizarPrecioInscripcion)
        // return;
     
        var arrayNuevoDescuento = [];
        var arrayNuevaInscripcion = [];
     
        var arrayActualizarTotal =[];
    
        for (var i = 0; i  < actualizarPrecioDescuento.length; i++) {
            arrayNuevoDescuento.push(Number($(actualizarPrecioDescuento[i]).val()));   
        }
        for (var i = 0; i  < actualizarPrecioInscripcion.length; i++) {
            arrayNuevaInscripcion.push(Number($(actualizarPrecioInscripcion[i]).val()));   
        }
        
        function sumaArrayTotal(total, numero) {
            return total + numero;
        }

        // console.log("descuento",arrayDescuento)
        // console.log("inscripcion", arrayInscripcion)
        var descuento = arrayNuevoDescuento.reduce(sumaArrayTotal);
        var inscripcion = arrayNuevaInscripcion.reduce(sumaArrayTotal);
        
        arrayActualizarTotal = inscripcion - descuento;

        $('#precioDescuentoActualizado').val(arrayNuevoDescuento);
        $('#precioInscripcionActualizado').val(arrayNuevaInscripcion);
        $('#nuevoTotalPago').val(arrayActualizarTotal);
        $('#pagoTotalActualizado').val(arrayActualizarTotal);
            
        // console.log("arrayNuevoDescuento", arrayNuevaInscripcion)
        // console.log("arrayNuevoDescuento", arrayNuevoDescuento)
        // return;
    });


}
actualizarSumaTotal($('.descuentoNuevo'))


/*=============================================
        EDITAR PAGOS CLIENTE
=============================================*/
$(document).on('click', '.btnEditarPago', function (e) { 
    e.preventDefault();
    idClientePago = $(this).attr('idCliente');
    // console.log(idClientePago)

    Swal.fire({
        title: 'Actualizar Pago',
        html: '<p class="SwalParrafo">¿Deseás mantener el Tipo de Inscripcion actual?</p>' +
            '<button type="button" role="button" tabindex="0" class="SwalBtnConfirmarPago btn btn-success customSwalBtn">' + 'Si, mantener' + '</button>' +
            '<button type="button" role="button" tabindex="0" class="SwalBtnCambiarInscripcion btn btn-primary customSwalBtn" data-toggle="modal" data-target="#modalEditarPagos">' + 'No, cambiar' + '</button>' +
            '<button type="button" role="button" tabindex="0" class="SwalBtnCancelar btn btn-secondary customSwalBtn">' + 'Cancelar' + '</button>',
        width: 600,
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false
    });
});

$(document).on('click', '.SwalBtnConfirmarPago', function (e) { 

    Swal.fire({
        icon: 'info',
        title: '¿Se realizo el pago correctamente?',
        html: '<button type="submit" role="button" class="SwalBtnMantenerInscripcion btn btn-success customSwalBtn">' + 'Si, guardar' + '</button>' +
            '<button type="button" role="button" class="SwalBtnCancelar btn btn-danger customSwalBtn">' + 'No, salir' + '</button>',
        width: 500,
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false
    });
});

//***** ======================================
//    PROCESAR PAGO SIN CAMBIAR INSCRIPCION 
// ========================================= *//
$(document).on('click', '.SwalBtnMantenerInscripcion', function (e) { 
    e.preventDefault();
    // console.log(idClientePago);
    // console.log('click')

    
    Swal.fire({
        title: 'Procesando...',
        allowOutsideClick: false
    });
    Swal.showLoading()
    // Swal.close();
    // return;

    
    setTimeout(function () {
        var datos = new FormData();
        datos.append("idClientePagoMantener", idClientePago);
        
        $.ajax({
    
            url:"ajax/clientes.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,  
            dataType: "json",
            success: function(respuesta) {
                // console.log(respuesta);
                var fechaProximaPago = respuesta.fecha_proximo_pago;

                if(respuesta){
                    Swal.fire({
                        title: 'El pago se agrego correctamente!',
                        text: 'Fecha proximo pago actualizada al '+fechaProximaPago,
                        icon: 'success',
                        // width: 600,
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'
                    }).then((result)=>{
                        if(result.value){
                            window.location = "clientes-inscripciones";
                        }
                    });;   
                } else {
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        // width: 600,
                        allowOutsideClick: false,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar'
                    }).then((result)=>{
                        if(result.value){
                            window.location = "clientes-inscripciones";
                        }
                    });;   
                }
                
            }
        });
        // $('.alert').remove();
    }, 1000);

});



//***** ======================================
// CALCULANDO TOTAL A PAGAR AL CAMBIAR INSCRIPCION 
// ========================================= *//
calcularPagoNuevaInscripcion('.verTotalActualizarPago', '.actualizarPagoInscripcion', '.totalActualizarPago');

function calcularPagoNuevaInscripcion(btnTotal, inputTotalInscripcion, inputTotal) {
    $(document).on('click', btnTotal, function (e) {
        e.preventDefault();
        
        var valorInscripcion = $(inputTotalInscripcion).val();
        // var valorInscripcion = $('.actualizarPagoInscripcion').val();

        // var valorPromocion = $('.actualizarTotalDescuento').val();

        // if(!valorPromocion){

        //     var suma = parseInt(valorInscripcion);
        //     var descuento = 0;
        //     $('input[name=actualizarTotalDescuento]').attr('value', descuento);
        // } else {
        //     var porcentaje = parseInt(valorPromocion) / 100;
        //     var descuento = ((parseInt(totalMatricula) * porcentaje));
        //     var suma = (parseInt(totalMatricula) - descuento) + parseInt(valorInscripcion);
        //     $('input[name=actualizarTotalDescuento]').attr('value', descuento);
            
        // }

        $(inputTotal).attr('value', valorInscripcion);
        // $('.totalActualizarPago').attr('value', valorInscripcion);


    });
}

//TOTAL NUEVA INSCRIPCION
calcularPagoNuevaInscripcion('.verTotalActualizarPago', '.nuevaPagoInscripcion2', '.nuevoTotalPago');

//***** ======================================
//    PROCESAR PAGO CAMBIANDO INSCRIPCION 
// ========================================= *//
$(document).on('click', '.SwalBtnCambiarInscripcion', function (e) { 
    e.preventDefault();
    // console.log('click')
    console.log(idClientePago);
    var datos = new FormData();
    datos.append("idClientePago", idClientePago);

    $.ajax({
    
        url:"ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {
            // console.log(respuesta);
            // return;
            
            $('#idClientePago').val(respuesta["id_cliente"]);
            
            $('#actualizarInscripcion').html(respuesta["tipo_inscripcion"])
            $('#actualizarInscripcion').val(respuesta["id_inscripcion"])
            $('#actualizarPagoInscripcion').attr('value', respuesta["precio_inscripcion"])            

            // $('.pagoTotalActualizado').val(respuesta["pago_total"])
            
        }
    });
    Swal.close();
    // Swal.hideLoading()
});

$(document).on('click', '.SwalBtnCancelar', function (e) { 
    e.preventDefault();
    Swal.close();
});




//***** ======================================
//  BOTON CANCELAR INSCRIPCION DE CLIENTES 
// ========================================= *//
$(document).on('click', '.btnCancelarInscripcion', function (e) {
    e.preventDefault();
    idClienteInscripcion = $(this).attr('idClienteInscripcion');
    idClientePagoInscripcion = $(this).attr('idClientePagoInscripcion');
    // console.log(idClientePagoInscripcion)
    // estadoClienteInscripcion = $(this).attr('estadoClienteInscripcion');

    var idClientePago = idClientePagoInscripcion;
    // console.log(idClientePago)
    var datos = new FormData();
    datos.append("idClientePago", idClientePago);

    Swal.fire({
        icon: 'info',
        title: '¿Está seguro de cancelar la inscripción?',
        html: '<button type="button" role="button" tabindex="0" class="SwalBtnCancelarInscripcion btn btn-success customSwalBtn" data-toggle="modal" data-target="">' + 'Si, cancelar' + '</button>' +
            '<button type="button" role="button" tabindex="0" class="SwalBtnCancelar btn btn-secondary customSwalBtn">' + 'No, salir' + '</button>',
        width: 500,
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false
    });
});

$(document).on('click', '.SwalBtnCancelarInscripcion', function () {
    // console.log(idClienteInscripcion)
    var estadoClienteInscripcion = 0;
    var inscrito = 0;

    var datos = new FormData();
    datos.append('idClienteInscripcion', idClienteInscripcion);
    datos.append('estadoClienteInscripcion', estadoClienteInscripcion);
    datos.append('inscrito', inscrito);

    $.ajax({

        url:"ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            // console.log(respuesta);
            // return;

            if(respuesta == 'true'){
                Swal.fire({
                    title: 'Inscripcion cancelada!',
                    icon: 'success',
                    // width: 600,
                    allowOutsideClick: false,
                    showCancelButton: false,
                    showConfirmButton: true
                }).then((result)=>{
                    if(result.value){
                        Swal.fire({
                            title: '¿Desea agregar una nueva inscripción?',
                            icon: 'info',
                            html: '<button type="button" role="button" tabindex="0" class="SwalBtnNuevaInscripcion btn btn-orange customSwalBtn" data-toggle="modal" data-target="#modalNuevaInscripcion">' + 'Si, vamos' + '</button>' +

                            '<button type="button" role="button" tabindex="0" class="SwalBtnSalirNuevaInscripcion btn btn-danger customSwalBtn">' + 'No, salir' + '</button>',
                            // width: 600,
                            allowOutsideClick: false,
                            showCancelButton: false,
                            showConfirmButton: false,
                        })
                    
                        $(document).on('click', '.SwalBtnNuevaInscripcion', function () {

                            // console.log(idClientePagoInscripcion)
                            var idCliente = idClientePagoInscripcion;
                            // console.log(idClientePago)
                            var datos = new FormData();
                            datos.append("idCliente", idCliente);

                            $.ajax({
                            
                                url:"ajax/clientes.ajax.php",
                                method: "POST",
                                data: datos,
                                cache: false,
                                contentType: false,
                                processData: false,  
                                dataType: "json",
                                success: function(respuesta) {
                                    // console.log(respuesta);

                                    $('.nuevoClienteInscripcion').val(respuesta['nombre'] +' '+ respuesta['apellidos']);
                                    $('#nuevoClienteInscripcion').attr('value', respuesta['id_cliente']);
                                }
                            });
                            Swal.close();
                            mostrarDinamico($('.actualizarNuevaInscripcion'),'tbl_inscripcion','id_inscripcion',$('.actualizarPagoNuevaInscripcion'),'precio_inscripcion');
                            calcularPagoNuevaInscripcion('.verTotalActualizarPago', '.actualizarPagoNuevaInscripcion', '.totalActualizarPago');


                            // idClienteInscripcion
                        });


                        $(document).on('click', '.SwalBtnSalirNuevaInscripcion', function () {
                            
                            window.location = "clientes-inscripciones";
                        });
                    }
                });;

            } else {
                Swal.fire({
                    title: 'Oops, algo salio mal. Intenta de nuevo!',
                    icon: 'error',
                    // width: 600,
                    allowOutsideClick: false,
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar'
                }).then((result)=>{
                    if(result.value){
                        window.location = "clientes-inscripciones";
                    }
                });;   
            }
        }

    });

});



/*=============================================
        ELIMINAR CLIENTE
=============================================*/
$(document).on('click', '.btnEliminarCliente', function () { 

    var idCliente = $(this).attr("idPersona");
    
    Swal.fire({
        title: '¿Está seguro de borrar el cliente?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=clientes&idPersona="+idCliente;
        }
    });
});

/*=============================================
        EDITAR CLIENTE VENTA
=============================================*/

$(document).on('click', '.btnEditarClienteVenta', function () { 
    
    var idEditarClienteVenta = $(this).attr("idEditarClienteVenta");
    var tipoClienteDeVenta = $(this).attr("tipoClienteVenta");
    // console.log(tipoClienteVenta)
    var datos = new FormData();
    datos.append("idEditarClienteVenta", idEditarClienteVenta);
    datos.append("tipoClienteDeVenta", tipoClienteDeVenta);
    // console.log(idEditarClienteVenta)

    $.ajax({
    
        url:"ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {

            // console.log("respuesta", respuesta);
            
            $('#idEditarClienteVenta').val(respuesta["id_persona"])

            $('#tipoDocumentoClienteVentas').html(respuesta["tipo_documento"])
            $('#tipoDocumentoClienteVentas').val(respuesta["id_documento"])

            $('.numeroDocumentoClienteVentas').val(respuesta["num_documento"])
            $('.nombreClienteVentas').val(respuesta["nombre"])
            $('.apellidoClienteVentas').val(respuesta["apellidos"])
            $('.editarEmailVentas').val(respuesta["correo"])
            $('.telefonoClienteVentas').val(respuesta["telefono"])
            $('.fechaNacimientoClienteVentas').val(respuesta["fecha_nacimiento"])
            $('.direccionClienteVentas').val(respuesta["direccion"])
            $('#editarSexoClienteVentas').html(respuesta["sexo"])
            $('#editarSexoClienteVentas').val(respuesta["sexo"])

            $('#editarTipoClienteVenta').html(respuesta["tipo_cliente"])
            $('#editarTipoClienteVenta').val(respuesta["tipo_cliente"])

            // $('#tipoMatriculaClienteVenta').html(respuesta["tipo_matricula"])
            // $('#tipoMatriculaClienteVenta').val(respuesta["id_matricula"])

            // $('#editarPromocionClienteVenta').html(respuesta["tipo_descuento"])
            // $('#editarPromocionClienteVenta').val(respuesta["id_descuento"])
            
            // $('#inscripcionClienteVenta').html(respuesta["tipo_inscripcion"])
            // $('#inscripcionClienteVenta').val(respuesta["id_inscripcion"])

            // $('.precioMatriculaClienteVentas').val(respuesta["pago_matricula"])
            // $('.valorDescuentoClienteVenta').val(respuesta["pago_descuento"])
            // $('.precioInscripcionClienteVenta').val(respuesta["pago_inscripcion"])
            // $('.totalPagarClienteVenta').val(respuesta["pago_total"])
            
        }
    });
});



/*=============================================
IMPRIMIR PAGO EN PDF
=============================================*/
$(".tablas").on("click", ".btnReciboPagoCliente", function(){
    // console.log('click')
    var idClientePago = $(this).attr("idClientePago");
  
    window.open("extensiones/tcpdf/pdf/recibo-pago-cliente-pdf.php?codigo="+idClientePago, "_blank");

})