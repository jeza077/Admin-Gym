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
        $('#datosClientes').show();
    } else {
        $('#datosClientes').hide();
    }
   
});

/*=============================================
        EDITAR CLIENTE
=============================================*/

$('.btnEditarCliente').click(function () { 
    
    var idCliente = $(this).val("idCliente");
    var datos = new FormData();
    datos.append("idCliente", idCliente);
    // console.log(datos)

    $.ajax({
    
        url:"ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {

            $('.editarDocumento').val(respuesta["num_documento"])
            $('.editarNombre').val(respuesta["nombre"])
            $('.editarApellidos').val(respuesta["apellidos"])
            $('.editarEmail').val(respuesta["correo"])
            $('.editarTelefono').val(respuesta["telefono"])
            $('.editarFechaNacimiento').val(respuesta["fecha_nacimiento"])
            $('.editarDireccion').val(respuesta["direccion"])
            $('.editarSexo').val(respuesta["sexo"])


            // console.log("respuesta", respuesta);
            
        }
    });
    
});
/*=============================================
        EDITAR CLIENTE
=============================================*/
function mostrarDinamico(selector1,tablaDB,itemDB,selector2,precio) {  
  
    selector1.change(function (e) { 
        e.preventDefault();
        
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
               var precioInscripcion = respuesta[precio];             
            //    SumaTotal()      
    
               selector2.val(precioInscripcion);

            }
        });   
  
    });
}

// MOSTRAR TABLA INSCRIPCION
mostrarDinamico($('.nuevaInscripcion'),'tbl_inscripcion','id_inscripcion',$('.nuevoPrecioInscripcion'),'precio_inscripcion')
// MOSTRAR TABLA PROMOCIONES
mostrarDinamico($('.nuevaPromocion'),'tbl_promociones_descuentos', 'id_promociones_descuentos',$('.nuevoPrecioPromocion'),'valor_promociones_descuentos')

// CALCULAR EL TOTAL A PAGAR 
function SumaTotal(selector) {  

    selector.change(function (e) { 
        e.preventDefault();
        
        var precioMatricula = $('.nuevoPrecioMatricula');
        var precioDescuento = $('.nuevoPrecioPromocion');
        var precioInscripcion = $('.nuevoPrecioInscripcion');
     
        var arrayMatricula = [];
        var arrayInscripcion = [];
        var arrayDescuento = [];
        // var arraySuma =[];
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
        
        var matricula = arrayMatricula.reduce(sumaArrayTotal);
        var descuento = arrayDescuento.reduce(sumaArrayTotal);
        var matriculaTotal = matricula-descuento;
        var inscripcionTotal = arrayInscripcion.reduce(sumaArrayTotal);
        

        // arraySuma = matriculaTotal+inscripcionTotal;
        arrayTotal = matriculaTotal+inscripcionTotal;
        $('.totalPagar').val(arrayTotal);
        
        // console.log("arrayDescuento", arrayDescuento)
    });

}
SumaTotal($('.nuevaMatricula'))
SumaTotal($('.nuevaPromocion'))
SumaTotal($('.nuevaInscripcion'))



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
// VALIDACIONES DE EMAIL
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