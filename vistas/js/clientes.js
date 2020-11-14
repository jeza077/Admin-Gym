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
    
    var idCliente = $(this).val("idCliente");

    var datos = new FormData();
    datos.append("idCliente", idCliente);
    // console.log(tabla)

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
            //    var precioItem = precio;
            //    var arraySuma = [];
            //     for (var i = 0; i  < precioItem.length; i++) {
            //         arraySuma.push($(precioItem[i]).val());
            //     }
            //     function sumaArrayTotal(total, numero) {
            //         return total + numero;
            //     }
            //     var sumaTotalCliente = arraySuma.reduce(sumaArrayTotal);
            //     $('.totalPagar').val(sumaTotalCliente);
    
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
function SumaTotal() {  
    
    
        var precioItem = $('.nuevoPrecio');
        // var precioDescuento = $('.nuevoPrecioPromocion');
        var arraySuma = [];
        // var arrayResta = [];
        for (var i = 0; i  < precioItem.length; i++) {
            arraySuma.push(Number($(precioItem[i]).val()));
            
        }
        // for (var i = 0; i  < precioDescuento.length; i++) {
        //     arrayResta.push(Number($(precioDescuento[i]).val()));
            
        // }
        function sumaArrayTotal(total, numero) {
            return total + numero;
        }
        
        var sumaTotal = arraySuma.reduce(sumaArrayTotal);
        // var totalCliente = sumaTotal[i]-resta[i];
        $('.totalPagar').val(sumaTotal);
        // console.log("arraySuma", arraySuma)
}
$('.nuevaInscripcion').change(SumaTotal)
// $('.nuevaPromocion').change(SumaTotal)
// SumaTotal($('.nuevaInscripcion'));
// SumaTotal($('.nuevaPromocion'));

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
          
            // window.location = "index.php?ruta=clientes&idCliente="+idCliente;
        }
    });
});