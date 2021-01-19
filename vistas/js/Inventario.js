
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
            // console.log("respuesta",respuesta)


            $("#editarCodigo").val(respuesta["codigo"]);
            $("#editarNombreProducto").val(respuesta["nombre_producto"]);
            $("#editarTipoProducto").val(respuesta["id_inventario"]);
            $("#editarStock").val(respuesta["stock"]);
            $("#editarPrecio").val(respuesta["precio_venta"]);
            // $("#editarPrecioCompra").val(respuesta["precio_compra"]);
            // $("#editarProveedor").val(respuesta["proveedor"]);
            $("#editarProductoMinimo").val(respuesta["producto_minimo"]);
            $("#editarProductoMaximo").val(respuesta["producto_maximo"]);

            if(respuesta["stock"] == null){

                $("#editarStock").val(0);

            } else {

                $("#editarStock").val(respuesta["stock"]);
            }

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
            // console.log("respuesta",respuesta["foto"])


            $("#editarCodigoE").val(respuesta["codigo"]);
            $("#editarNombreEquipo").val(respuesta["nombre_producto"]);
            $("#editarTipoEquipo").val(respuesta["id_inventario"]);
            $("#imagenActualEquipo").val(respuesta["foto"]);

            if(respuesta["stock"] == null){
                // console.log('es nulo')
                $("#editarStockEquipo").val(0);

            } else {
                // console.log('no es nulo')

                $("#editarStockEquipo").val(respuesta["stock"]);
            }

            if(respuesta["foto"] != "" && respuesta["foto"] != null){

                $('.previsualizar').attr('src', respuesta['foto']);

            } else if(respuesta["foto"] != "" && respuesta["foto"] == null){

                $('.previsualizar').attr('src', 'vistas/img/productos/default/product.png');

            } else {

                $('.previsualizar').attr('src', 'vistas/img/productos/default/product.png');

            }
        }    
    });

})


//** ----------------- BORRAR EQUIPO  --------------------------*/
$(document).on('click', '.btnEliminarEquipo', function () {
    var idEquipo = $(this).attr('idEquipo');
    var fotoEquipo = $(this).attr('fotoEquipo');
    var equipo = $(this).attr('equipo');

    Swal.fire({
        title: "¿Estás seguro de borrar el equipo?",
        text: "¡Si no lo estas, puedes cancelar la acción!",
        icon: "info",
        showCancelButton: true,
        cancelButtonColor: "#DC3545",
        heightAuto: false,
        allowOutsideClick: false
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=equipo&idEquipo="+idEquipo+"&equipo="+equipo+"&fotoEquipo="+fotoEquipo;
        }
    });
});

//** -----------------------------------------------------*/
//MOSTRAR INFO EN SELECT DESDE LA BASE DE DATOS DINAMICAMENTE
// -------------------------------------------------------*/ 
$(document).on('click', '#nuevaCompra', function () {
    // console.log('clickkk')
    selectDinamico();    
});


//** ------------------------------------*/
//         IMPRIMIR PRODUCTO
// // --------------------------------------*/ 
// $(document).on('click', '.btnExportarProductos', function () {
//     window.open("extensiones/tcpdf/pdf/productos-pdf.php", "_blank");
// });


// //** ------------------------------------*/
// //         IMPRIMIR PRODUCTO
// // --------------------------------------*/ 
// $(document).on('click', '.btnExportarEquipo', function () {
//     window.open("extensiones/tcpdf/pdf/productos-pdf.php", "_blank");
// });



/*=============================================
    EJECUCION DE VALIDACIONES
=============================================*/
// var identidad = $('.nombre_producto');
// validarDoc(identidad);
// $('.nombre_producto').keydown(sinNumeros)
// $('.editar_Nombre_Producto').keydown(sinNumeros)
// $('.precio').keydown(sinLetras)
// $('.editar_Precio').keydown(sinLetras)
$('.sinLetras').keydown(sinLetras)
$('.sinCaracteres').keydown(sinCaracteres)
$('.sinNumeros').keydown(sinNumeros)




//** ------------------------------------*/
//         IMPRIMIR PDF INVENTARIO
// --------------------------------------*/ 
exportarPdf('.btnExportarInventario', 'inventario');
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
