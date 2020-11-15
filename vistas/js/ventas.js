/*=============================================
		  Datos de la tabla dinamica
    =============================================*/
    
    $('.tablaVentas').DataTable( {
      "ajax": "ajax/datatable-ventas.ajax.php",
      "deferRender": true,
    "retrieve": true,
    "processing": true,
     "language": {
  
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
  
    }
  
  } );

// // -------------------------------------------
// // ACTIVAR LOS BOTONES CON LOS ID CORRESPONDIENTES
// $(".tablaVenta tbody").on( 'click', 'button.agregarProducto', function ()
//  {
// 	var data = table2.row( $(this).parents('tr') ).data();
// 	$(this).attr("idProducto",data[5]);
// })
// // ----------------------------------------------------------
// // FUNCIÓN PARA CARGAR LAS IMÁGENES CON EL PAGINADOR Y EL FILTRO
// function cargarImagenesProductos(){
//   var imgTabla = $(".imgTablaVenta");
//   var limiteStock = $(".limiteStock");
//   for(var i = 0; i < imgTabla.length; i ++)
//   {
//     var data = table2.row( $(imgTabla[i]).parents('tr') ).data();   
//     $(imgTabla[i]).attr("src",data[1]);
//     if(data[4] <= 10)
//     {
//       $(limiteStock[i]).addClass("btn-danger");
//       $(limiteStock[i]).html(data[4]);
//     }else if(data[4] > 11 && data[4] <= 15)
//     {
//       $(limiteStock[i]).addClass("btn-warning");
//       $(limiteStock[i]).html(data[4]);
//     }else{
//       $(limiteStock[i]).addClass("btn-success");
//       $(limiteStock[i]).html(data[4]);
//     }
//   }
// }

// setTimeout(function()
// {
//   cargarImagenesProductos()
// }, 300);

// //*************************************** 
// // CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL PAGINADOR*/
// $(".dataTables_paginate").click(function()
// {
// 	cargarImagenesProductos()
// })
// /*****************************************************
// CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL BUSCADOR*/
// $("input[aria-controls='DataTables_Table_0']").focus(function()
// {
// 	$(document).keyup(function(event){
// 		event.preventDefault();
// 		cargarImagenesProductos()
// 	})
// })
// // ********************************************
// // CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL FILTRO DE CANTIDAD
// $("select[name='DataTables_Table_0_length']").change(function()
// {
// 	cargarImagenesProductos()
// })
// //***************************************************************
// // CARGAMOS LAS IMÁGENES CUANDO INTERACTUAMOS CON EL FILTRO DE ORDENAR
// $(".sorting").click(function()
// {
// 	cargarImagenesProductos()
// })

// //***************************************************************
// // AGREGAR PRODUCTOS A LA VENTA DESDE TABLA DINAMICA
// $(".tablaVentas tbody").on("click", "button.agregarProducto", function(){
// 	var idProducto = $(this).attr("idProducto");
// 	$(this).removeClass("btn-primary agregarProducto");
// 	$(this).addClass("btn-default");
//   var datos = new FormData();
//   datos.append("idProducto", idProducto);
//     $.ajax({
//     url:"ajax/productos.ajax.php",
//     method: "Admin-Gym",
//     data: datos,
//     cache: false,
//     contentType: false,
//     processData: false,
//     dataType:"json",
//     success:function(respuesta){ 
//       var descripcion = respuesta["descripcion"];
//       var stock = respuesta["stock"];
//       var precio = respuesta["precio_venta"];

//       $(".nuevoProducto").append(
//       '<div class="row" style="padding:5px 15px">'+
//         '<!-- Entrada de producto-->'+
//         '<!-- Descripción del producto--------------------- -->'+
//         '<div class="form-group col-md-6 nuevoProducto">'+
//           '<label for="des_producto">Descripcion del Producto</label>'+
//           '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i    class="fa fa-times"></i></button></span>'+
//           '<input type="text" class="form-control" id="agregarProducto" name="agregarProducto" value="'+descripcion+'" readonly required>'+     
//         '</div>'+
//         '<!-- Cantidad del producto-->'+
//         '<div class="form-group col-md-3">'+
//           '<label for="cant_producto">Cantidad</label>'+
//           '<input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" required>'+
//         '</div>'+
//         '<!-- Total de producto-->'+
//         '<div class="form-group col-md-3" style="padding-left:0px">'+ 
//           '<label for="total_producto">Total</label>'+
//           '<input type="number" min="1" class="form-control" id="nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
//         '</div> '+   
//       '</div> ')

//       //suma el total de precios
//       sumarTotalPrecios()
//     }
//   })      
// });    

// //***************************************************************
// // QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
// $(".formularioVenta").on("click", "button.quitarProducto", function(){
// 	$(this).parent().parent().parent().parent().remove();
// 	var idProducto = $(this).attr("idProducto");
// 	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
//   $("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');
//   if($(".nuevoProducto").children().length == 0){
//     $("#nuevoTotalVenta").val(0);
//     $("#nuevoTotalVenta").attr("total",0);

// 	}else{

//    //suma el total de precios
//   sumarTotalPrecios()
//   }
// })

// //***************************************************************
// // SELECCIONAR LOS PRODUCTOS
// $(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){
// 	var nombreProducto = $(this).val();
// 	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
// 	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
// 	var datos = new FormData();
//     datos.append("nombreProducto", nombreProducto);
// 	  $.ajax({
//      	url:"ajax/productos.ajax.php",
//       	method: "Admin-Gym",
//       	data: datos,
//       	cache: false,
//       	contentType: false,
//       	processData: false,
//       	dataType:"json",
//       	success:function(respuesta){ 
//       	    $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
//       	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
//       	    $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
//       	    $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);
//       	}
//       })
// })

// //***************************************************************
// // MODIFICAR LA CANTIDAD 
// $(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){
// 	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
// 	var precioFinal = $(this).val() * precio.attr("precioReal");
// 	precio.val(precioFinal);
// 	var nuevoStock = Number($(this).attr("stock")) - $(this).val();
// 	$(this).attr("nuevoStock", nuevoStock);
//   if(Number($(this).val()) > Number($(this).attr("stock")))
//   {
// 		$(this).val(1);
// 		swal({
// 	      title: "La cantidad supera el Stock",
// 	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
// 	      type: "error",
// 	      confirmButtonText: "¡Cerrar!"
// 	    });
//   }
  
//    //suma el total de precios
//    sumarTotalPrecios()
// })

// //***************************************************************
// // SUMAR TODOS LOS PRECIOS
// function sumarTotalPrecios(){
// 	var precioItem = $(".nuevoPrecioProducto");
// 	var arraySumaPrecio = [];  
// 	for(var i = 0; i < precioItem.length; i++){
// 		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
// 	}

// 	function sumaArrayPrecios(total, numero){
// 		return total + numero;
// 	}
// 	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
// 	$("#nuevoTotalVenta").val(sumaTotalPrecio);
// 	$("#totalVenta").val(sumaTotalPrecio);
// 	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);
// }

// //***************************************************************
// // AGREGAR IMPUESTO DE VENTA
// function agregarImpuesto(){
// 	var impuesto = $("#nuevoImpuestoVenta").val();
// 	var precioTotal = $("#nuevoTotalVenta").attr("total");
// 	var precioImpuesto = Number(precioTotal * impuesto/100);
//   var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
  
// 	$("#nuevoTotalVenta").val(totalConImpuesto);
// 	$("#totalVenta").val(totalConImpuesto);
// 	$("#nuevoPrecioImpuesto").val(precioImpuesto);
// 	$("#nuevoPrecioNeto").val(precioTotal);
// }


// //***************************************************************
// // AGREGAR IMPUESTO DE VENTA