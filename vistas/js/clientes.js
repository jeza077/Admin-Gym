// VALIDACIONES DE DOCUMENTO
$('.tipoDocumentoCliente').change(function (e) { 
    e.preventDefault();
    $('.idCliente').val("");

    var valorTipoDocumento =$(this).val();
    console.log(valorTipoDocumento);

    if(valorTipoDocumento === 3){
        $('.idCliente').keydown(sinNumeros);
    } else {
        $('.idCliente').keydown(sinLetras);
        $('.idCliente').keydown(sinCaracteres);
    }
});

validarEmail($('.emailCliente'))
$('.numeroDocumentoCliente').keydown(impedirEspacios);
$('.numeroDocumentoCliente').blur(validarDoc)

//VALIDACIONES AGREGAR CLIENTE
$('.nombreCliente').keydown(sinCaracteres)
$('.nombreCliente').keydown(sinNumeros)
$('.nombreCliente').keydown(permitirUnEspacio);
longitudString($('.nombreCliente'),30); 
//VALIDACIONES AGREGAR CLIENTE apellido
$('.apellidoCliente').keydown(sinCaracteres)
$('.apellidoCliente').keydown(sinNumeros)
$('.apellidoCliente').keydown(permitirUnEspacio);
longitudString($('.apellidoCliente'),30); 
;

$('#datosClientes').hide();
$(document).on('change', '.tipoCliente', function () {
    var valor = $(this).val();
    // console.log(valor)
    if (valor == "Gimnasio") {
        // SumaTotal()
       
        $('#datosClientes').show();
        // sumar();
    } else {
        $('#datosClientes').hide();
    }
   
});
// $('#datosCliente').hide();
// $(document).on('change', '.editarTipoCliente', function () {
//     var valor = $(this).val();
//     // console.log(valor)
//     if (valor == "Gimnasio") {
//         $('#datosCliente').show();
//     } else {
//         $('#datosCliente').hide();
//     }
   
// });
//** ------------------------------------*/
//         IMPRIMIR USUARIOS 
// --------------------------------------*/ 
$(document).on('click', '.btnExportarClientes', function () {
    window.open("extensiones/tcpdf/pdf/clientes-pdf.php", "_blank");
});

/*=============================================
        EDITAR CLIENTE
=============================================*/

$('.btnEditarCliente').click(function () { 
    
    var idEditarCliente = $(this).attr("idEditarCliente");
    // console.log(idEditarCliente)
    var datos = new FormData();
    datos.append("idEditarCliente", idEditarCliente);
    

    $.ajax({
    
        url:"ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {

            console.log("respuesta", respuesta);
            
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

            $('#editarTipoCliente').html(respuesta["tipo_cliente"])
            $('#editarTipoCliente').val(respuesta["tipo_cliente"])

            $('#editarMatricula').html(respuesta["tipo_matricula"])
            $('#editarMatricula').val(respuesta["id_matricula"])

            $('#editarPromocion').html(respuesta["tipo_descuento"])
            $('#editarPromocion').val(respuesta["id_descuento"])
            
             $('#editarInscripcion').html(respuesta["tipo_inscripcion"])
            $('#editarInscripcion').val(respuesta["id_inscripcion"])

            $('.editarPrecioMatricula').val(respuesta["pago_matricula"])
            $('.editarPrecioPromocion').val(respuesta["pago_descuento"])
            $('.editarPrecioInscripcion').attr('value', respuesta["pago_inscripcion"])
            $('.editarTotalPagar').val(respuesta["pago_total"])
            
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
                // console.log(respuesta[precio]);
                // SumaTotal();
                var precioInscripcion = respuesta[precio];            
                //    if (selector1 == $('.nuevaPromocion')){
                    
                    // } 
                selector2.attr("value",precioInscripcion);
            

            }
        });   
  
    });
}

// MOSTRAR TABLA INSCRIPCION
mostrarDinamico($('.nuevaInscripcion'),'tbl_inscripcion','id_inscripcion',$('.nuevoPrecioInscripcion'),'precio_inscripcion')
// MOSTRAR TABLA PROMOCIONES
mostrarDinamico($('.nuevaPromocion'),'tbl_descuento', 'id_descuento',$('.nuevoPrecioPromocion'),'valor_descuento')

mostrarDinamico($('.actualizarInscripcion'),'tbl_inscripcion','id_inscripcion',$('.actualizarPagoInscripcion'),'precio_inscripcion')

mostrarDinamico($('.descuentoNuevo'),'tbl_descuento', 'id_descuento',$('.actualizarPrecioDescuento'),'valor_descuento')

/*=============================================
        SUMAR TOTAL CLIENTES
=============================================*/

function SumaTotal(selector) {  

    selector.click(function (e) { 
        e.preventDefault();
        var precioMatricula = $('.nuevoPrecioMatricula');
        // console.log("matricula", precioMatricula)
        
        // var precioMatricula = $('.nuevoPrecioMatricula');
        var precioDescuento = $('.nuevoPrecioPromocion');
        var precioInscripcion = $('.nuevoPrecioInscripcion');
        // console.log("Descuento", precioDescuento)
        // console.log("Inscripcion", precioInscripcion)
        // return;
     
        var arrayMatricula = [];
        var arrayDescuento = [];
        var arrayInscripcion = [];
     
        var arrayTotal =[];
    
        for (var i = 0; i  < precioMatricula.length; i++) {
            arrayMatricula.push(Number($(precioMatricula[i]).val()));   
        }
        for (var i = 0; i  < precioDescuento.length; i++) {
            arrayDescuento.push(Number($(precioDescuento[i]).val()));   
        }
        for (var i = 0; i  < precioInscripcion.length; i++) {
            arrayInscripcion.push(Number($(precioInscripcion[i]).val()));   
        }
        
        function sumaArrayTotal(total, numero) {
            return total + numero;
        }
        // console.log("matricula", arrayMatricula)
        // console.log("descuento",arrayDescuento)
        // console.log("inscripcion", arrayInscripcion)
        var matricula = arrayMatricula.reduce(sumaArrayTotal);
        var descuento = arrayDescuento.reduce(sumaArrayTotal);
        var matriculaTotal = matricula - descuento;
        var inscripcion = arrayInscripcion.reduce(sumaArrayTotal);
        
        arrayTotal = matriculaTotal + inscripcion;
        $('#pagoMatricula').val(arrayMatricula);
        $('#nuevoPrecioDescuento').val(arrayDescuento);
        $('#pagoInscripcion').val(arrayInscripcion);
        $('#nuevoTotalCliente').val(arrayTotal);
        $('#totalPagar').val(arrayTotal);
        // if (selector.change("nuevaPromocion")) {
        //     $('.totalPagar').val(matriculaTotal);
        // } else if (selector.change("nuevaInscripcion")){

            // }
            
            
        
        console.log("arrayDescuento", arrayDescuento)
    });


}
// SumaTotal($('.verTotalPago'))
// SumaTotal($('.verTotalPagoEditado'))
// SumaTotal($('.nuevaMatricula'))
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
        } else {
            var porcentaje = parseInt(totalDescuento) / 100;
            var descuento = ((parseInt(totalMatricula) * porcentaje));
            var suma = (parseInt(totalMatricula) - descuento) + parseInt(totalInscripcion);
            $('input[name=nuevoPrecioDescuento]').attr('value', descuento);
            
        }
        console.log('desc',descuento);
        console.log('suma',suma)
    
        $('.totalPagar').val(suma);
        

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
$('.btnEditarPago').click(function (e) { 
    e.preventDefault();

    Swal.fire({
        title: 'Actualizar Pago',
        html: '<p class="SwalParrafo">¿Deseás mantener el Tipo de Inscripcion actual?</p>' +
            '<button type="button" role="button" tabindex="0" class="SwalBtnMantenerInscripcion btn btn-success customSwalBtn">' + 'Si, mantener' + '</button>' +
            '<button type="button" role="button" tabindex="0" class="SwalBtnCambiarInscripcion btn btn-danger customSwalBtn" data-toggle="modal" data-target="#modalEditarPagos">' + 'No, cambiar' + '</button>' +
            '<button type="button" role="button" tabindex="0" class="SwalBtnCancelar btn btn-secondary customSwalBtn">' + 'Cancelar' + '</button>',
        width: 600,
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false
    });
});

$(document).on('click', '.SwalBtnMantenerInscripcion', function (e) { 
    e.preventDefault();
    console.log('click')
    // Swal.showLoading()

});

$(document).on('click', '.SwalBtnCambiarInscripcion', function (e) { 
    e.preventDefault();
    // console.log('click')
    Swal.close();
    // Swal.hideLoading()
});

$(document).on('click', '.SwalBtnCancelar', function (e) { 
    e.preventDefault();
    Swal.close();
});



/*=============================================
        ELIMINAR CLIENTE
=============================================*/
$('.btnEliminarCliente').click(function () { 

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
        EDITAR CLIENTE
=============================================*/

$('.btnPagosCliente').click(function () { 
    
    var idPago = $(this).attr("idPagoCliente");
    // console.log(idPago)
    var datos = new FormData();
    datos.append("idPago", idPago);
    

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

            $('#actualizarDescuento').html(respuesta["tipo_descuento"])
            $('#actualizarDescuento').val(respuesta["id_descuento"])
            
             $('#actualizarInscripcion').html(respuesta["tipo_inscripcion"])
            $('#actualizarInscripcion').val(respuesta["id_inscripcion"])

            $('.actualizarPrecioDescuento').val(respuesta["pago_descuento"])
            $('.actualizarPagoInscripcion').val(respuesta["pago_inscripcion"])
            $('.pagoTotalActualizado').val(respuesta["pago_total"])
            
        }
    });
});