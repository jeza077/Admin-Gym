/*--=====================================
        VARIABLE LOCAL STORAGE
======================================--*/
var pathname = window.location.href;

if(localStorage.getItem("capturarRangoVentas") != null && pathname == 'http://localhost/Admin-Gym/administrar-venta'){

  $("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha');
  localStorage.removeItem("capturarRangoVentas");
  localStorage.clear();
  
} else if(localStorage.getItem("capturarRangoVentas") != null) {
  $("#daterange-btn span").html(localStorage.getItem("capturarRangoVentas"));

} else {
  $("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}


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

// //***************************************************************
// // AGREGAR PRODUCTOS A LA VENTA DESDE TABLA DINAMICA
$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){

  var idProducto = $(this).attr("idProducto");
  // console.log(idProducto);
	$(this).removeClass("btn-primary agregarProducto");
  $(this).addClass("btn-default");
  
  var datos = new FormData();
  datos.append("idProducto", idProducto);

    $.ajax({
    url:"ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){ 
      // console.log(respuesta);

      var descripcion = respuesta["nombre_producto"];
      var stock = respuesta["stock"];
      var precio = respuesta["precio"];

      /*=============================================
      EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
      =============================================*/

      if(stock == 0){

      Swal.fire({
          title: "No hay stock disponible",
          icon: "error",
          confirmButtonText: "¡Cerrar!"
      });
      
        $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

        return;

      }

      $(".nuevoProducto").append(
      '<div class="row" style="padding:5px 6px">'+
      '<!-- Descripcion del producto-->'+
        '<div class="col-md-6">'+
          '<div class="input-group">'+
            '<span class="input-group-prepend"><button type="button" class="btn btn-danger btn-md quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+
            '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" id="agregarProducto" value="'+descripcion+'" readonly required>'+     
          '</div>'+

        '</div>'+

        '<!-- Cantidad del producto-->'+
        '<div class="col-md-3">'+

            '<input type="number" class="form-control nuevaCantidadProducto"  min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

        '</div>'+

        '<!-- Precio de producto-->'+
        '<div class="col-md-3 ingresoPrecio">'+
          '<div class="input-group" style="padding-left:0px">'+
            '<span class="input-group-prepend btn btn-default"><i class="fas fa-dollar-sign"></i></span>'+ 
            '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
          '</div>'+
        '</div>'+   

      '</div> ')

      //suma el total de precios
      sumarTotalPrecios()

      // AGREGAR IMPUESTO
      agregarImpuesto()

       // AGRUPAR PRODUCTOS EN FORMATO JSON
       listarProductos()

    }
  })      
});    


/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarProducto") != null){

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for(var i = 0; i < listaIdProductos.length; i++){

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');
		}

	}

})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

  var idProducto = $(this).attr("idProducto");
  // console.log(idProducto);


	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);


  }
   else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPrecios()

    	// AGREGAR IMPUESTO
	        
        agregarImpuesto()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos()

	}

})


/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
  // console.log(precio.val())
	var precioFinal = $(this).val() * precio.attr("precioReal");
	// console.log($(this).val())
  precio.val(precioFinal);
  


	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(1);

		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

		sumarTotalPrecios();

		Swal.fire({
      title: "La cantidad supera el Stock",
      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
      icon: "error",
      confirmButtonText: "¡Cerrar!"
	    });

    return;

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	// AGREGAR IMPUESTO
	        
    agregarImpuesto()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()

})

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
  
  $("#nuevoPrecioNeto").val(sumaTotalPrecio);
  $("#precioNeto").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}

/*=============================================
  FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto(){

  var impuesto = $("#nuevoImpuestoVenta").val();
  // console.log(impuesto)
	var precioTotal = $("#nuevoTotalVenta").attr("total");

	var precioImpuesto = Number(precioTotal * impuesto/100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
	
	$("#nuevoTotalVenta").val(totalConImpuesto);

	$("#totalVenta").val(totalConImpuesto);

	$("#nuevoPrecioImpuesto").val(precioImpuesto);

	$("#nuevoPrecioNeto").val(precioTotal);

}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function(){

	agregarImpuesto();

});

// /*=============================================
// FORMATO AL PRECIO FINAL
// =============================================*/

// $("#nuevoTotalVenta").number(true, 2);


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos(){

	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
                "total" : $(precio[i]).val()
              })

  }
  
  console.log("listaProductos",listaProductos);

	$("#listaProductos").val(JSON.stringify(listaProductos)); 

}


/*=============================================
    DATERANGE PICKER
  ===========================================*/
$('#daterange-btn').on('click', function () {  
  $('.daterangepicker').addClass('reporteVentas');
})
datarangeDinamico($('#daterange-btn'), $('#daterange-btn span'), 'capturarRangoVentas', 'administrar-venta');

// $('#daterange-btn').daterangepicker({
//   ranges   : {
//   'Hoy'       : [moment(), moment()],
//   'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//   'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
//   'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
//   'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
//   'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//   },
//   startDate: moment(),
//   endDate  : moment()
//   },
//   function (start, end) {
//       $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    
//       var fechaInicial = start.format('YYYY-MM-DD');

//       var fechaFinal = end.format('YYYY-MM-DD');

//       var capturarRango = $("#daterange-btn span").html();
//       console.log(capturarRango)
//       localStorage.setItem("capturarRango", capturarRango);

//       window.location = "index.php?ruta=administrar-venta&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
//   }
// )


/*=============================================
        CAPTURAR HOY
=============================================*/  
datarangeDinamicoHoy(".daterangepicker.reporteVentas .ranges li", 'capturarRangoVentas', 'Hoy', 'administrar-venta');

// $(".daterangepicker .ranges li").on("click", function(){

//   var textoHoy = $(this).attr("data-range-key");
//   console.log(textoHoy)
//   if(textoHoy == "Hoy"){

//     var d = new Date();

//     var dia = d.getDate();
//     var mes = d.getMonth()+1;
//     var año = d.getFullYear();

//     //   if(mes < 10){

//     //       var fechaInicial = año+"-0"+mes+"-"+dia;
//     //       var fechaFinal = año+"-0"+mes+"-"+dia;

//     //   }else if(dia < 10){

//     //       var fechaInicial = año+"-"+mes+"-0"+dia;
//     //       var fechaFinal = año+"-"+mes+"-0"+dia;

//     //   }else if(mes < 10 && dia < 10){

//     //       var fechaInicial = año+"-0"+mes+"-0"+dia;
//     //       var fechaFinal = año+"-0"+mes+"-0"+dia;

//     //   }else{

//     //       var fechaInicial = año+"-"+mes+"-"+dia;
//     //       var fechaFinal = año+"-"+mes+"-"+dia;

//     //   }	

//     // dia = ("0"+dia).slice(-2);
//     // mes = ("0"+mes).slice(-2);

//     var fechaInicial = año+"-"+mes+"-"+dia;
//     var fechaFinal = año+"-"+mes+"-"+dia;	

//     localStorage.setItem("capturarRango", "Hoy");

//     window.location = "index.php?ruta=administrar-venta&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

//   }

// })



//** ------------------------------------*/
//         IMPRIMIR PDF VENTAS
// --------------------------------------*/ 
$(document).on('click', '.btnExportarVentas', function (e) {
  // console.log("click");
  e.preventDefault();
  function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable) {
            return pair[1];
        }
    }
    return false;
  }
 
 // console.log(window.location.search.substring(15));
 // console.log(getQueryVariable('fechaFinal'));
 
  var fechaInicial = getQueryVariable('fechaInicial');
  var fechaFinal = getQueryVariable('fechaFinal')
  // console.log(fechaInicial)
  
  if(fechaInicial == false && fechaFinal == false) {
    // console.log('si')
    // window.open("extensiones/tcpdf/pdf/ventas-pdf.php?&fechaInicial="+null+"&fechaFinal="+null);
    window.open("extensiones/tcpdf/pdf/ventas-pdf.php", "_blank");
  } else {
    // console.log('no')
    window.open("extensiones/tcpdf/pdf/ventas-pdf.php?&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal);
  }

});


//** ------------------------------------*/
//         BOTON EDITAR VENTAS
// --------------------------------------*/ 
$(".tablas").on("click", ".btnEditarVenta", function(){

	var idVenta = $(this).attr("idVenta");

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;


})


/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");

  swal.fire({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {
          
          window.location = "index.php?ruta=administrar-venta&idVenta="+idVenta;
        }

  })
  
  
})
