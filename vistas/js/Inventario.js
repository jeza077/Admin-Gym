
// Datatable Compras
// $.ajax({
//     url: "ajax/datatable-productos.ajax.php",
//     success: function (response) {  
//         console.log(response)
//     }
// });
lenguageDataTable('.tablaCompras', 'ajax/datatable-compras.ajax.php');
lenguageDataTable('.tablaInventario', 'ajax/datatable-inventario.ajax.php');
lenguageDataTable('.tablaProductos', 'ajax/datatable-productos.ajax.php');


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
            // console.log(respuesta)


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
                $(".previsualizarFotoProducto").attr("src", respuesta["foto"]);
                
            } else {
                
                $(".previsualizarFotoProducto").attr("src", "vistas/img/productos/default/product.png");

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



/*=============================================
    EJECUCION DE VALIDACIONES
=============================================*/
// var identidad = $('.nombre_producto');
// validarDoc(identidad);
// $('.nombre_producto').keydown(sinNumeros)
// $('.editar_Nombre_Producto').keydown(sinNumeros)
// $('.precio').keydown(sinLetras)
// $('.editar_Precio').keydown(sinLetras)





//** ------------------------------------*/
//         IMPRIMIR PDF INVENTARIO
// --------------------------------------*/ 
exportarPdf('.btnExportarInventario', 'inventario');
exportarPdf('.btnExportarCompras', 'compras');


// function exportarPdf(btnExportar, rutaArchivoPdf) {
    
//     $(document).on('click', btnExportar, function (e) {
//         // console.log("click");
//         // return;
//         // console.log(valorBuscar);
//         if(!valorBuscar){
//             window.open("extensiones/tcpdf/pdf/"+rutaArchivoPdf+"-pdf.php");
//         } else {
//             var rango = valorBuscar;
//             window.open("extensiones/tcpdf/pdf/"+rutaArchivoPdf+"-pdf.php?&rango="+rango);
//         }

    
//     });
// }

//** ------------------------------------*/
//    FUNCION PRODUCTO MINIMO
// --------------------------------------*/ 
function minimo() {

    $(document).on('blur', '#nuevoProductoMinimo', function () {
        
        $('.alert').remove();

        let valProdMinimo = parseInt($(this).val());
        let prodMinimo = "ADMIN_PROD_MINIMO";
        // console.log(typeof(valProdMinimo))

        let datos = new FormData();
        datos.append("parametroProducto", prodMinimo);

        let padre = $('#nuevoProductoMinimo').closest('.form-row');
        
        $.ajax({
    
            url:"ajax/parametro.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,  
            dataType: "json",
            success: function(respuesta) {
                // console.log(typeof(respuesta['valor']));
                
                if(valProdMinimo < parseInt(respuesta['valor'])){
                    // console.log('mayor el valor del parametro');

                    padre.before('<div class="alert alert-danger fade show mt-2" role="alert"><i class="icon fas fa-ban"></i>Producto minimo supera al establecido. El producto minimo aceptado es ' + parseInt(respuesta['valor']) + '</div>');
                    setTimeout(function () {
                        $('.alert').remove();
                    }, 5000)

                    $('#nuevoProductoMinimo').focus();
                    $('#nuevoProductoMinimo').val(parseInt(respuesta['valor']));
                   
                } else {
                    // console.log('menor el valor del parametro');
                    $('.alert').remove();
                }
            }
    
        });
    });

}
minimo();

//** ------------------------------------*/
//    FUNCION PRODUCTO MAXIMO
// --------------------------------------*/ 
function maximo(selector) {

    $(document).on('blur', selector, function () {
        
        $('.alert').remove();

        let valProdMinimo = parseInt($(this).val());
        let prodMinimo = "ADMIN_PROD_MAXIMO";
        // console.log(typeof(valProdMinimo))

        let datos = new FormData();
        datos.append("parametroProducto", prodMinimo);

        let padre = $(selector).closest('.form-row');
        
        $.ajax({
    
            url:"ajax/parametro.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,  
            dataType: "json",
            success: function(respuesta) {
                // console.log(typeof(respuesta['valor']));
                
                if(valProdMinimo > parseInt(respuesta['valor'])){
                    // console.log('mayor el valor del parametro');

                    padre.before('<div class="alert alert-danger fade show mt-2" role="alert"><i class="icon fas fa-ban"></i>Producto maximo supera al establecido. El producto maximo aceptado es ' + parseInt(respuesta['valor']) + '</div>');
                    setTimeout(function () {
                        $('.alert').remove();
                    }, 5000)

                    $(selector).focus();
                    $(selector).val(parseInt(respuesta['valor']));
                   
                } else {
                    // console.log('menor el valor del parametro');
                    $('.alert').remove();
                }
            }
    
        });
    });

}
maximo('#nuevoProductoMaximo');