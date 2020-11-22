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
        SumaTotal()
       
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

            // console.log("respuesta", respuesta);
            
            $('#idEditarCliente').val(respuesta["id_persona"])
            $('.editarTipoDocumento').val(respuesta["id_documento"])
            $('.editarNumeroDocumento').val(respuesta["num_documento"])
            $('.editarNombre').val(respuesta["nombre"])
            $('.editarApellido').val(respuesta["apellidos"])
            $('.editarEmail').val(respuesta["correo"])
            $('.editarTelefono').val(respuesta["telefono"])
            $('.editarFechaNacimiento').val(respuesta["fecha_nacimiento"])
            $('.editarDireccion').val(respuesta["direccion"])
            $('.editarSexo').val(respuesta["sexo"])

            $('.editarTipoCliente').val(respuesta["tipo_cliente"])
            $('.editarMatricula').val(respuesta["id_matricula"])
            $('.editarPromocion').val(respuesta["id_descuentos_promociones"])
            $('.editarInscripcion').val(respuesta["id_inscripcion"])
        }
    });
});
/*=============================================
        EDITAR CLIENTE
=============================================*/
function mostrarDinamico(selector1,tablaDB,itemDB,selector2,precio) {  
  
    selector1.change(function (e) { 
        e.preventDefault();
        // if (selector1 == $('.nuevaPromocion')){
        //     sumar();    
        // } 
        
        var item = itemDB;
        var valor = selector1.val();
        // console.log(valor)
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
                SumaTotal();
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
mostrarDinamico($('.nuevaPromocion'),'tbl_promociones_descuentos', 'id_promociones_descuentos',$('.nuevoPrecioPromocion'),'valor_promociones_descuentos')

/*=============================================
        SUMAR TOTAL CLIENTES
=============================================*/

function SumaTotal() {  

    selector.change(function (e) { 
        e.preventDefault();
        // var precioMatricula = $('.nuevoPrecioMatricula').val();
        // console.log("matricula", precioMatricula)
        
        var precioMatricula = $('.nuevoPrecioMatricula');
        var precioDescuento = $('.nuevoPrecioPromocion').val();
        var precioInscripcion = $('.nuevoPrecioInscripcion').val();
        // console.log("Descuento", precioDescuento)
        // console.log("Inscripcion", precioInscripcion)
        // return;
     
        var arrayMatricula = [];
        var arrayInscripcion = [];
        var arrayDescuento = [];
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
        console.log("matricula", arrayMatricula)
        console.log("descuento",arrayDescuento)
        console.log("inscripcion", arrayInscripcion)
        var matricula = arrayMatricula.reduce(sumaArrayTotal);
        var descuento = arrayDescuento.reduce(sumaArrayTotal);
        var matriculaTotal = precioMatricula - descuento;
        var inscripcionTotal = arrayInscripcion.reduce(sumaArrayTotal);
        
        arrayTotal = matriculaTotal+inscripcionTotal;
        $('.totalPagar').val(arrayTotal);
        
        // console.log("arrayDescuento", arrayDescuento)
    });


}
// SumaTotal($('.tipoCliente'))
// SumaTotal($('.nuevaPromocion'))
// SumaTotal($('.nuevaInscripcion'))

// function sumar() {

//     var precioMatricula = $('.nuevoPrecioMatricula').val();
//     var precioDescuento = $('.nuevoPrecioPromocion').val();
//     var precioInscripcion = $('.nuevoPrecioInscripcion').val();
//     var resultado = parseInt(precioMatricula) + parseInt(precioDescuento) + parseInt(precioInscripcion);
//     console.log(precioMatricula)
//     console.log(precioDescuento)
//     console.log(precioInscripcion)

//     console.log(resultado)

  
// }
// sumar();
// $('.tipoCliente').change(function (e) { 
//     e.preventDefault();
//     sumar();
// });
// $('.nuevoPrecioPromocion').change(function (e) { 
//     e.preventDefault();
//     sumar();
// });
// $('.nuevoPrecioInscripcion').change(function (e) { 
//     e.preventDefault();
//     sumar();
// });

/*=============================================
        ELIMINAR CLIENTE
=============================================*/
$('.btnEliminarCliente').click(function () { 

    var idCliente = $(this).attr("idCliente");
    
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
          
            window.location = "index.php?ruta=clientes&idCliente="+idCliente;
        }
    });
});