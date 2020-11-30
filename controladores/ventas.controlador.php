<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ControladorVentas {
    /*=============================================
	MOSTRAR LA VENTA
	=============================================*/
    static public function ctrMostrarVentas($item, $valor){
    
        $tabla = "tbl_venta";
        $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
        return $respuesta;   
    }

    /*=============================================
	CREAR VENTA
    =============================================*/
    static public function ctrCrearVenta(){
    
		// echo '<pre>';
		// var_dump($_POST);
		// echo '</pre>';
		// return;

        if(isset($_POST["nuevaVenta"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK 
			Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

            $listaProductos = json_decode($_POST["listaProductos"], true);
            // var_dump($listaProductos);
  
            $totalProductosComprados = array();

			foreach($listaProductos as $key => $value) {
				// 	echo $value["id"];
				// 	return;

			   array_push($totalProductosComprados, $value["cantidad"]);

			   $item = "id_inventario";
			   $valor = $value["id"];
				
			    $tablaProductos = "tbl_inventario"; 
				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);
                // var_dump($traerProducto["ventas"]);

				$item1 = "ventas";
				$valor1 = $value["cantidad"] + $traerProducto["ventas"];
				$item2 = $item;
			    $valor2 = $valor;

                $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor1, $item2, $valor2);               

				$item1 = "stock";
				$valor1 = $value["stock"];
				$item2 = $item;
			    $valor2 = $valor;


				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor1, $item2, $valor2);

            }
			
            $tabla1 = "tbl_personas";
            $tabla2 = "tbl_clientes";
			$item = "id_cliente";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);
			// var_dump($traerCliente); 
			// // return; 
			// echo $valor;
			// return;

			$item1 = "compras";
			$valor1 = 2 + $traerCliente["compras"];
			// echo $valor1;
			// return;

			$item2 = "id_cliente";
			$valor2 = $valor;
			$comprasCliente = ModeloClientes::mdlActualizarCliente($tabla2, $item1, $valor1, $item2, $valor2);
			
			// var_dump($comprasCliente); 
			// return; 
			// echo $valor;
			// return;

			// $item1 = "ultima_compra";

			// date_default_timezone_set('America/Tegucigalpa');

			// $fecha = date('Y-m-d');
			// $hora = date('H:i:s');
			// $valor1 = $fecha.' '.$hora;

			// $item2 = "id_cliente";
			// $valor2 = $valor;

            // $fechaCliente = ModeloClientes::mdlActualizarCliente($tabla2, $item1, $valor1, $item2, $valor2);

            /*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "tbl_venta";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "numero_factura"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"]);
			
			// echo '<pre>';
			// var_dump($datos);
			// echo '</pre>';
			// return;			   

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			// var_dump($respuesta);
			// return;


			if ($respuesta == true){

				if($_POST['idPersona'] != ""){

					$tabla1 = "tbl_personas";
					$tabla2 = "tbl_clientes";
					$item = "id_personas";
					$valor = $_POST["idPersona"];
	
					$traerCliente = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);
					// echo($valor);
					// var_dump($traerCliente);
					// return;
	
					$correoDestinatario = $traerCliente['correo'];
					$nombreDestinatario = $traerCliente['nombre'] .' '. $traerCliente['apellidos'];
					$asunto = 'Envio de factura';
					$require = false;
	

					$template = file_get_contents('extensiones/plantillas/factura.php');
					$template = str_replace("{{nombre}}", $nombreDestinatario, $template);
					$template = str_replace("{{numero_factura}}", $_POST['nuevaVenta'], $template);
					$template = str_replace("{{total}}", $_POST['totalVenta'], $template);
					$template = str_replace("{{fecha}}", date('Y-m-d'), $template);

					// $decodificar_productos = json_decode($_POST["listaProductos"]);
					// var_dump($decodificar_productos);
					// return;
            
					// foreach ($decodificar_productos as $productos ) {
				
						// echo $productos->total;
						// return;
						$template = str_replace("{{descripcion_producto}}", $productos->descripcion, $template);
						$template = str_replace("{{total_productos}}",$productos->total, $template);
					// }
					$template = str_replace("{{neto}}", $_POST['nuevoPrecioNeto'], $template);
					$template = str_replace("{{impuesto}}", $_POST['nuevoPrecioImpuesto'], $template);
					$template = str_replace("{{total_final}}", $_POST['totalVenta'], $template);
					$template = str_replace("{{anio}}", date('Y'), $template);
					// $template = str_replace("{{direccion_empresa}}", date('Y-m-d'), $template);

				
	
	
					$respuestaCorreo = ControladorUsuarios::ctrGenerarCorreo($correoDestinatario, $nombreDestinatario, $asunto, $template, $require);

					// var_dump($respuestaCorreo);
					// return;
					if($respuestaCorreo){
				echo'<script>

				localStorage.removeItem("rango");

				Swal.fire({
					  icon: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "administrar-venta";

								}
							})

				</script>';
					}
				
				} else {

					
					echo'<script>
					
					localStorage.removeItem("rango");
					
					Swal.fire({
						icon: "success",
						title: "La venta ha sido guardada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then((result) => {
						if (result.value) {
							
							window.location = "administrar-venta";
							
						}
					})
					
					</script>';
				}
				
			}else{
				
				echo'<script>

				Swal.fire({
					  icon: "error",
					  title: "Error",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "administrar-venta";

								}
							})

				</script>';

			}

        }
    
	}
	

	/*=============================================
			SUMA TOTAL VENTAS
    =============================================*/
	static public function ctrSumaTotalVentas(){

		$tabla = 'tbl_venta';
		
		$respuesta = ModeloVentas::mdlSumarTotalVentas($tabla);
		
		return $respuesta;
	}

	/*=============================================
			RANGO DE FECHAS
    =============================================*/
	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = 'tbl_venta';
		
		$respuesta = ModeloVentas::mdlRangoFechaVentas($tabla, $fechaInicial, $fechaFinal);
		
		return $respuesta;
	}


	  /*=============================================
	====================EDITAR VENTA
    =============================================*/
    static public function ctrEditarVenta(){
    
		// echo '<pre>';
		// var_dump($_POST);
		// echo '</pre>';
		// return;

        if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "tbl_venta";
			$item = "numero_factura";
			$valor = $_POST["editarVenta"];
			 
			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
			// echo '<pre>';
			// var_dump($traerVenta);
			// echo '</pre>';
			// return;

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			$productos =  json_decode($traerVenta["productos"], true);
			$totalProductosComprados = array();
			// echo '<pre>';
			// var_dump($productos);
			// echo '</pre>';
			// return;
			
			if($cambioProducto){

				$productos =  json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();
				foreach($productos as $key => $value) {
					// echo '<pre>';
					// var_dump($value);
					// echo '</pre>';
					// return;
			
					array_push($totalProductosComprados, $value["cantidad"]);

					$item = "id_inventario";
					$valor = $value["id"];
					
					$tablaProductos = "tbl_inventario"; 
					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);
					// echo '<pre>';
					// var_dump($traerProducto);
					// echo '</pre>';
					// return;

					$item1A = "stock";
					$valor1A = $value["cantidad"]+ $traerProducto["stock"];
					$item2 = $item;
					$valor2 = $valor;

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1A, $valor1A, $item2, $valor2);

					$item1B = "venta";
					$valor1B = $traerProducto["venta"] - $value["cantidad"];
					$item2 = $item;
					$valor2 = $valor;

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1B, $valor1B, $item2, $valor2);    

					// echo '<pre>';
					// var_dump($nuevoStock);
					// var_dump($nuevasVentas);
					// echo '</pre>';
					// return;
					

				}
				// return; 

				$tabla1 = "tbl_personas";
				$tabla2 = "tbl_clientes";
				$item = "id_cliente";
				$valor = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);

				$item1 = "compras";
				$valor1 = $traerCliente["compras"] - array_sum($totalProductosComprados);
				// echo $valor1;
				// return;

				$item2 = "id_cliente";
				$valor2 = $valor;
				$comprasCliente = ModeloClientes::mdlActualizarCliente($tabla2, $item1, $valor1, $item2, $valor2);

				// var_dump($comprasCliente);
				// return;

				

			// 	/*=============================================
	 		// 	ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK 
	 		// 	Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
	 		// 	=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);
				// var_dump($listaProductos);
	
				$totalProductosComprados_2 = array();

				foreach($listaProductos_2 as $key => $value) {
					// 	echo $value["id"];
					// 	return;

					array_push($totalProductosComprados_2, $value["cantidad"]);

					$item_2 = "id_inventario";
					$valor_2 = $value["id"];
					
					$tablaProductos_2 = "tbl_inventario"; 
					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2);
					// var_dump($traerProducto_2["venta"]);

					$item1_2 = "venta";
					$valor1_2 = $traerProducto["venta"]+ $value["cantidad"];
					$item2_2 = $item_2;
					$valor2_2 = $valor_2;

					// echo $value["cantidad"];
					// echo $valor1_2;

					// return;

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1_2, $valor1_2, $item2_2, $valor2_2);               

					$item1_2 = "stock";
					$valor1_2 = $traerProducto_2["stock"] - $value["cantidad"];
					$item2_2 = $item_2;
					$valor2_2 = $valor_2;


					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1_2, $valor1_2, $item2_2, $valor2_2);

					// echo '<pre>';
					// var_dump($nuevoStock_2);
					// var_dump($nuevasVentas_2);
					// echo '</pre>';
					// return;

				}
				// return;
				
				$tabla1_2 = "tbl_personas";
				$tabla2_2 = "tbl_clientes";
				$item_2 = "id_cliente";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tabla1_2, $tabla2_2, $item_2, $valor_2);
				// var_dump($traerCliente); 
				// return; 
				// echo $valor;
				// return;

				$item1_2 = "compras";
				$valor1_2 =array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];
				// echo $valor1;
				// return;

				$item2_2 = "id_cliente";
				$valor2_2 = $valor_2;
				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tabla2_2, $item1_2, $valor1_2, $item2_2, $valor2_2);
				
				// var_dump($comprasCliente); 
				// return; 
				// echo $valor;
				// return;

				$item1_2 = "ultima_compra";

				date_default_timezone_set('America/Tegucigalpa');

				$fecha_2 = date('Y-m-d');
				$hora_2 = date('H:i:s');
				$valor1_2 = $fecha_2.' '.$hora_2;

				$item2_2 = "id_cliente";
				$valor2_2 = $valor_2;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tabla2_2, $item1_2, $valor1_2, $item2_2, $valor2_2);

				// echo '<pre>';
				// 	var_dump($nuevoStock);
				// 	var_dump($nuevasVentas);
				// 	echo '</pre>';
				// 	return;
			
			}
             /*=============================================
	 		GUARDAR CAMBIOS DE LA COMPRA
	 		=============================================*/	

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "numero_factura"=>$_POST["editarVenta"],
						   "productos"=>$listaProductos,
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"]);
			
			// echo '<pre>';
			// var_dump($datos);
			// echo '</pre>';
			// return;		
			
			$tabla="tbl_venta";

			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == true ){

				echo'<script>

				localStorage.removeItem("rango");

				Swal.fire({
					  icon: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "administrar-venta";

								}
							})

				</script>';

			}

		}
	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){
		if(isset($_GET["idVenta"])){
			$tabla = "tbl_venta";
			$item = "id_venta";
			$valor = $_GET["idVenta"];
				
			$traerVenta =ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
			// var_dump($traerVenta);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "tbl_clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);
			
			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){
					// var_dump($value["fecha"]);
					array_push($guardarFechas, $value["fecha"]);
				}

				if (count($guardarFechas) > 1){
					if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

						$item = "ultima_compra";
						$valor = $guardarFechas[count($guardarFechas)-2];
						$valorIdCliente = $traerVenta["id_cliente"];

						$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

					
					}else{

						$item = "ultima_compra";
						$valor = $guardarFechas[count($guardarFechas)-1];
						$valorIdCliente = $traerVenta["id_cliente"];

						$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

					}

				}else{

					$item1 = "compras";
					$valor1 = "0000-00-00 00:00:00";
					$item2 = "id_cliente";
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1, $valor1, $item2, $valorIdCliente);
					// var_dump($comprasCliente);
				}
				

			}

			/*=============================================
	 		FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
	   		=============================================*/
			$productos =  json_decode($traerVenta["id_inventario"], true);

			$totalProductosComprados = array();

			foreach($listaProductos as $key => $value) {
				array_push($totalProductosComprados, $value["cantidad"]);

				$item = "id_inventario";
				$valor = $value["id"];
				
				$tablaProductos = "tbl_inventario"; 
				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

				$item1 = "stock";
				$valor1 = $value["cantidad"]+ $traerProducto["stock"];
				$item2 = $item;
				$valor2 = $valor;

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor1, $item2, $valor2);

				$item1 = "ventas";
				$valor1 = $traerProducto["ventas"] - $value["cantidad"];
				$item2 = $item;
				$valor2 = $valor;

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor1, $item2, $valor2);    

			}
			
			$tabla1 = "tbl_personas";
			$tabla2 = "tbl_clientes";
			$item = "id_cliente";
			$valor = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);

			$item1 = "compras";
			$valor1 = 2 + $traerCliente["compras"] - array_sum($totalProductosComprados);
			// // echo $valor1;
			// // return;

			$item2 = "id_cliente";
			$valor2 = $valor;
			$comprasCliente = ModeloClientes::mdlActualizarCliente($tabla2, $item1, $valor1, $item2, $valor2);

			/*=============================================
	  			ELIMINAR VENTA
	 		=============================================*/

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "administrar-venta";

								}
							})

				</script>';

			}		


		}

	}

}