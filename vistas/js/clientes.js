// $('#datosClientes').hide();
// $(document).on('change', '.tipoCliente', function () {
//     var valor = $(this).val();
//     // console.log(valor)
//     if (valor == "gimnasio") {
//         $('#datosClientes').show();
//     } else {
//         $('#datosClientes').hide();
//     }
   
// });
/*=============================================
        EDITAR CLIENTE
=============================================*/

$('.btnEditarCliente').click(function () { 
    


    var tabla = $(this).val("idCliente");

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
            console.log("personas", respuesta);
            

         
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
                console.log(respuesta[precio]);
               var precioInscripcion = respuesta[precio];
    
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
