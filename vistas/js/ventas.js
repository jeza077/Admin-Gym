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
	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


}

/*=============================================
  FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto(){

  var impuesto = $("#nuevoImpuestoVenta").val();
  console.log(impuesto)
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
=============================================*/
$('#daterange-btn').daterangepicker({
  ranges   : {
  'Hoy'       : [moment(), moment()],
  'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
  'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
  'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
  'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
  'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  },
  startDate: moment().subtract(29, 'days'),
  endDate  : moment()
  },
  function (start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    
      var fechaInicial = start.format('YYYY-MM-DD');

      var fechaFinal = end.format('YYYY-MM-DD');

      // var capturarRango = $("#daterange-btn span").html();
      // console.log(capturarRango)
      // localStorage.setItem("capturarRango", capturarRango);

      // window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  }
)