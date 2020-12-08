
//** ----------------- EDITAR INVENTARIO  --------------------------*/
$(document).on("click",".btnEditarInventario",function(){
    var idInventario = $(this).attr("idInventario");
    // console.log("idInventario", idInventario)

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
            console.log("respuesta",respuesta)


            $("#editarCodigo").val(respuesta["codigo"]);
            $("#editarNombreProducto").val(respuesta["nombre_producto"]);
            $("#editarTipoProducto").val(respuesta["id_inventario"]);
            $("#editarStock").val(respuesta["stock"]);
            $("#editarPrecio").val(respuesta["precio_venta"]);
            // $("#editarPrecioCompra").val(respuesta["precio_compra"]);
            // $("#editarProveedor").val(respuesta["proveedor"]);
            $("#editarProductoMinimo").val(respuesta["producto_minimo"]);
            $("#editarProductoMaximo").val(respuesta["producto_maximo"]);

            if (respuesta["foto"] !=""){
               
                $("#editarFotoProducto").val(respuesta["foto"]); 
                $("#previsualizar").attr("src", respuesta["foto"]);
            }
             
            
        }    
    });

})



//** ----------------- EDITAR EQUIPO  --------------------------*/


$(document).on("click",".btnEditarEquipo",function(){
    var idEquipo = $(this).attr("idInventario");
    // console.log("idEquipo", idEquipo)

    var datos = new FormData();
    datos.append("idInventario", idEquipo);
    
    $.ajax({ 
        url:"ajax/inventario.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            console.log("respuesta",respuesta)


            $("#editarCodigoE").val(respuesta["codigo"]);
            $("#editarNombreEquipo").val(respuesta["nombre_producto"]);
            $("#editarTipoEquipo").val(respuesta["id_inventario"]);
            $("#editarStockEquipo").val(respuesta["stock"]);

            if (respuesta["foto"] !=""){
               
                $("#editarFotoEquipo").val(respuesta["foto"]); 
                $("#previsualizar").attr("src", respuesta["foto"]);
            }  
        }    
    });

})

//** ----------------- GENERAR CODIGO  --------------------------*/


$("#nuevoTipoProducto").change(function(){
    var idCategoria = $(this).val();
    var datos = new FormData();
    datos.append("idCategoria", idCategoria);
    console.log("idCategoria", idCategoria)
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
            var nuevoCodigo = parseInt(respuesta["codigo"]) + 1;
            console.log("nuevoCodigo",nuevoCodigo);

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


//** ------------------------------------*/
//         IMPRIMIR PRODUCTO
// --------------------------------------*/ 
$(document).on('click', '.btnExportarProductos', function () {
    window.open("extensiones/tcpdf/pdf/productos-pdf.php", "_blank");
});


//** ------------------------------------*/
//         IMPRIMIR PRODUCTO
// --------------------------------------*/ 
$(document).on('click', '.btnExportarEquipo', function () {
    window.open("extensiones/tcpdf/pdf/productos-pdf.php", "_blank");
});



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
    EJECUCION DE VALIDACIONES
=============================================*/
var identidad = $('.nombre_producto');
validarDoc(identidad);
$('.nombre_producto').keydown(sinNumeros)
$('.editar_Nombre_Producto').keydown(sinNumeros)
$('.precio').keydown(sinLetras)
$('.editar_Precio').keydown(sinLetras)

//** ------------------------------------*/
//         IMPRIMIR PDF BITACORA
// --------------------------------------*/ 

exportarPdf('.btnExportarCompras', 'compras');

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

    
    });
}
