
//** ----------------- MOSTRAR INVENTARIO  --------------------------*/
$(document).on("click",".btnEditarInventario",function(){
    var idInventario = $(this).attr("idInventario");
    console.log("idInventario", idInventario)

    var datos = new FormData();
    datos.append("idInventario", idInventario);

    $.ajax({ 
        url:"ajax/inventario.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log("respuesta",respuesta);
        }
    });
})

//** ----------------- GENERAR CODIGO  --------------------------*/


$("#nuevoTipoProducto").change(function(){
    var idCategoria = $(this).val();

    var datos = new FormData();
    datos.append("idCategoria", idCategoria);

    $.ajax({ 
        url:"ajax/inventario.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            var nuevoCodigo = respuesta["codigo"];
            console.log("nuevoCodigo",nuevoCodigo);
        }
    });
})
