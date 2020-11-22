
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
    // console.log("idCategoria", idCategoria)
    $.ajax({ 
        url:"ajax/inventario.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            // console.log("respuesta",respuesta);
            var nuevoCodigo = parseInt(respuesta["codigo"]) + 1;
            // console.log("nuevoCodigo",nuevoCodigo);
            
            
            if(!respuesta && idCategoria == 1){
                $(".nuevoCodigo").val(100)
            } 
            else if (!respuesta && idCategoria == 2){
                $(".nuevoCodigo").val(700)
            }
            else {
                $(".nuevoCodigo").val(nuevoCodigo)
            }
        }
    });
})
