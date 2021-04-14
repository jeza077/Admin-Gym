<?php
date_default_timezone_set("America/Tegucigalpa");

class ControladorClientes{

	static public function ctrCrearCliente($datos){
		// return $datos;

        if(isset($datos['id_persona'])){

			$idDeInscripcion = $datos["id_inscripcion"];
			$pago_matricula = $datos['pago_matricula'];
			$pago_descuento = $datos['pago_descuento'];
			$pago_inscripcion = $datos['pago_inscripcion'];
			$pago_total = $datos['pago_total'];

			// echo "<pre>";
			// var_dump($pago_descuento);
			// echo "</pre>";
			// return $pago_descuento;

			$tabla = "tbl_clientes";

			// return $datos;	
			

            $respuestaCrearCliente = ModeloClientes::mdlCrearCliente($tabla, $datos);
			// return $respuestaCrearCliente;

            if($respuestaCrearCliente == true){
				
				if ($datos['tipo_cliente'] == "Gimnasio") {
					
					$totalId = array();
					$tabla1 = "tbl_personas";
					$tabla2 = "tbl_clientes";
					$item = null;
					$valor = null;

					$clientesTotal = ModeloClientes::mdlMostrarClientesSinPago($tabla1, $tabla2, $item, $valor);
					// echo "<pre>";
					// var_dump($clientesTotal);
					// echo "</pre>";
					// return;
					
					foreach($clientesTotal as $keyCliente => $valueCliente){
					array_push($totalId, $valueCliente["id_cliente"]);
				
					}
				
					$idCliente = end($totalId);
					
					// return $idCliente;	
					
					$idInscripcion = $idDeInscripcion;
					
					
					$tabla = "tbl_inscripcion";
					$item = "id_inscripcion";
					$valor = $idInscripcion;
					$all = null;

					$inscripcion = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

					$cantidadDias = $inscripcion['cantidad_dias'];

					date_default_timezone_set("America/Tegucigalpa");
					$fechaHoy = date('Y-m-d');
					$fechaVencimientoCliente = date("Y-m-d", strtotime('+'.$cantidadDias.' days'));

					$datos = array("id_cliente" =>  $idCliente,
									"id_inscripcion" => $idDeInscripcion,
									"fecha_inscripcion" => $fechaHoy,
									"fecha_pago" => $fechaHoy,
									"fecha_proximo_pago" => $fechaVencimientoCliente,
									"fecha_vencimiento" => $fechaVencimientoCliente);

					// return $datos;
									
					$tabla = "tbl_cliente_inscripcion";
		
					$respuestaClienteInscripcion = ModeloClientes::mdlCrearClienteInscripcion($tabla, $datos);

					// echo "<pre>";
					// var_dump($datos);
					// echo "</pre>";
					// return $respuestaClienteInscripcion;

					if ($respuestaClienteInscripcion == true) {
						
						$totalId = array();
						$tabla = "tbl_cliente_inscripcion";
						// $tabla2 = "tbl_clientes";
						$item = null;
						$valor = null;
		
						$pagoClienteTotal = ModeloClientes::mdlMostrar($tabla, $item, $valor);
						// echo "<pre>";
						// var_dump($pagoClienteTotal[1]["id_cliente"]);
						// echo "</pre>";
						// return;
						
						foreach($pagoClienteTotal as $keyCliente => $valuePagoCliente){
						array_push($totalId, $valuePagoCliente["id_cliente_inscripcion"]);
					
						
						}
						
		
						$idPagoCliente = end($totalId);
		
						// var_dump($parametros);
						// return $idPagoCliente;
						
						$tabla3 = "tbl_pagos_cliente";
						
						$datos = array("id_cliente_inscripcion" => $idPagoCliente,
										"pago_matricula" => $pago_matricula,
										"pago_descuento" => $pago_descuento,
										"pago_inscripcion" => $pago_inscripcion,
										"pago_total" => $pago_total);
											
		
						$respuestaPago = ModeloClientes::mdlCrearPago($tabla3, $datos);
						// echo "<pre>";
						// var_dump($datos);
						// echo "</pre>";
						// return;
						if ($respuestaPago ==true) {
							$descripcionEvento = "".$_SESSION['usuario']." creó el nuevo cliente del gimnasio llamado ".$_POST['nuevoNombre']."";
							$accion = "Nuevo";
							$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION['id_usuario'], 4, $accion, $descripcionEvento);

							return true;
						}
					
						// $descripcionEvento = "Nuevo cliente";
						// $accion = "Nuevo";
						// $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 3,$accion, $descripcionEvento);
					}

				} else {
					$descripcionEvento = "".$_SESSION['usuario']." creó el nuevo cliente de ventas llamado ".$_POST['nuevoNombre']."";
					$accion = "Nuevo";
					$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION['id_usuario'], 4, $accion, $descripcionEvento);
					return true;
				}


            } else {
				// echo '<script>
				// Swal.fire({
				// 	title: "Llene los campos correctamente.",
				// 	icon: "error",
				// 	toast: true,
				// 	position: "top",
				// 	showConfirmButton: false,
				// 	timer: 3000,
				// 	});					
				// </script>';
                return false;
            }
        } 

	}


	static public function ctrCrearClienteYaRegistrado(){

		// var_dump($_POST);
		// return;

        if(isset($_POST['nuevoIdPersona'])){

			if ($_POST['tipoClienteRegistrado'] == "Gimnasio"){

				if($_POST["nuevoPrecioDescuentoRegistrado"] == 0){
					$id_descuento = null;
					$pago_descuento = 0;
					// return 'si, cero';
				} else {
					$id_descuento = $_POST["nuevaPromocionRegistrado"];
					$pago_descuento = $_POST["nuevoPrecioDescuentoRegistrado"];
					// return 'no, no es cero';
				}

				$datos = array("id_persona" => $_POST["nuevoIdPersona"],
				"tipo_cliente" => $_POST["tipoClienteRegistrado"],
				"id_matricula" => $_POST["nuevaMatriculaRegistrado"],
				"id_descuento" => $id_descuento);

			} else {
				$datos = array("id_persona" => $_POST["nuevoIdPersona"],
				"tipo_cliente" => $_POST["tipoClienteRegistrado"]);
			}

			$tabla = "tbl_clientes";

            $respuestaCrearCliente = ModeloClientes::mdlCrearCliente($tabla, $datos);
			// var_dump($respuestaCrearCliente);
			// return;

            if($respuestaCrearCliente == true){

				// var_dump($respuestaCrearCliente);
				
				if($_POST['tipoClienteRegistrado'] == "Gimnasio") {
					
					$tabla1 = "tbl_personas";
					$tabla2 = "tbl_clientes";
					$item = "id_persona";
					$valor = $_POST["nuevoIdPersona"];

					$clientesTotal = ModeloClientes::mdlMostrarClientesSinPago($tabla1, $tabla2, $item, $valor);
					// echo "<pre>";
					// var_dump($clientesTotal);
					// echo "</pre>";
					// return;
					
					// foreach($clientesTotal as $keyCliente => $valueCliente){
					// 	array_push($totalId, $valueCliente["id_cliente"]);			
					// }
				
					$idCliente = $clientesTotal["id_cliente"];
					// echo 'idUltimoCleinte: ' . $idCliente;
					// return;

					$idInscripcion = $_POST["nuevaInscripcionRegistrado"];				
					$tabla = "tbl_inscripcion";
					$item = "id_inscripcion";
					$valor = $idInscripcion;
					$all = null;

					$inscripcion = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

					$cantidadDias = $inscripcion['cantidad_dias'];

					date_default_timezone_set("America/Tegucigalpa");
					$fechaHoy = date('Y-m-d');
					$fechaVencimientoCliente = date("Y-m-d", strtotime('+'.$cantidadDias.' days'));

					$datos = array("id_cliente" =>  $idCliente,
									"id_inscripcion" => $idInscripcion,
									"fecha_inscripcion" => $fechaHoy,
									"fecha_pago" => $fechaHoy,
									"fecha_proximo_pago" => $fechaVencimientoCliente,
									"fecha_vencimiento" => $fechaVencimientoCliente);

					// var_dump($datos);
					// return;
									
					$tabla = "tbl_cliente_inscripcion";
		
					$respuestaClienteInscripcion = ModeloClientes::mdlCrearClienteInscripcion($tabla, $datos);

					if($respuestaClienteInscripcion == true) {
						
						$totalId = array();
						$tabla = "tbl_cliente_inscripcion";
						// $tabla2 = "tbl_clientes";
						$item = null;
						$valor = null;
		
						$pagoClienteTotal = ModeloClientes::mdlMostrar($tabla, $item, $valor);
						// echo "<pre>";
						// var_dump($pagoClienteTotal[1]["id_cliente"]);
						// echo "</pre>";
						// return;
						
						foreach($pagoClienteTotal as $keyCliente => $valuePagoCliente){
							array_push($totalId, $valuePagoCliente["id_cliente_inscripcion"]);						
						}
						
		
						$idPagoCliente = end($totalId);
		
						// var_dump($parametros);
						// return $idPagoCliente;
						
						$tabla3 = "tbl_pagos_cliente";
						
						$datos = array("id_cliente_inscripcion" => $idPagoCliente,
										"pago_matricula" => $_POST["nuevoPrecioMatriculaRegistrado"],
										"pago_descuento" => $_POST["nuevoPrecioDescuentoRegistrado"],
										"pago_inscripcion" => $_POST["nuevoPrecioInscripcionRegistrado"],
										"pago_total" => $_POST["nuevoTotalClienteRegistrado"]);
											
		
						$respuestaPago = ModeloClientes::mdlCrearPago($tabla3, $datos);
						// echo "<pre>";
						// var_dump($datos);
						// echo "</pre>";
						// return;
						if($respuestaPago == true) {

							$tabla1 = "tbl_personas";
				
							$item1 = "tipo_persona";
							$valor1 = "ambos";
				
							$item2 = "id_personas";
							$valor2 = $_POST["nuevoIdPersona"];
					
							$respuesta = ModeloClientes::mdlActualizarCliente($tabla1, $item1, $valor1, $item2, $valor2);

							echo '<script>
								Swal.fire({
									title: "Cliente creado correctamente!",
									icon: "success",
									heightAuto: false,
									allowOutsideClick: false
								}).then((result)=>{
									if(result.value){
										window.location = "clientes";
									}
								});                       
							</script>';
							// return true;
						}
					
						// $descripcionEvento = "Nuevo cliente";
						// $accion = "Nuevo";
						// $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 3,$accion, $descripcionEvento);
					}

				} else {
					$tabla1 = "tbl_personas";
				
					$item1 = "tipo_persona";
					$valor1 = "ambos";
		
					$item2 = "id_personas";
					$valor2 = $_POST["nuevoIdPersona"];
			
					$respuesta = ModeloClientes::mdlActualizarCliente($tabla1, $item1, $valor1, $item2, $valor2);

					echo '<script>
							Swal.fire({
								title: "Cliente creado correctamente!",
								icon: "success",
								heightAuto: false,
								allowOutsideClick: false
							}).then((result)=>{
								if(result.value){
									window.location = "clientes";
								}
							});                       
						</script>';
				}


            } else {
				echo '<script>
					Swal.fire({
						title: "Opps, algo salio mal, intenta de nuevo!",
						icon: "error",
						heightAuto: false,
						allowOutsideClick: false
					}).then((result)=>{
						if(result.value){
							window.location = "clientes";
						}
					});                       
				</script>';
            }
        } 

	}
	
	/*=============================================
	EDITAR CLIENTE VENTA
	=============================================*/
	
	static public function ctrEditarCliente($datos){
		// echo "<pre>";
		// var_dump($datos);
		// echo "</pre>";
		// return;

        if(isset($datos['id_persona'])){

			$idDeInscripcion = $datos["id_inscripcion"];
			$pago_matricula = $datos['pago_matricula'];
			$pago_descuento = $datos['pago_descuento'];
			$pago_inscripcion = $datos['pago_inscripcion'];
			$pago_total = $datos['pago_total'];
			$idDelCliente = $datos['id_persona'];
			
			// echo "<pre>";
			// var_dump();
			// echo "</pre>";

			$tabla = "tbl_clientes";
			$item = "id_persona";
			$valor = $idDelCliente;
			$all = null;

			$clientesCompras = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);
			// echo "<pre>";
			// var_dump($clientesCompras['compras']);
			// echo "</pre>";
			// return;
			$idClienteInscripcion = $clientesCompras['id_cliente'];
			$compra = $clientesCompras['compras'];

			$ultimaCompra = $clientesCompras['ultima_compra'];

			// echo "<pre>";
			// var_dump($compra);
			// echo "</pre>";
			// return;


			if ($datos['tipo_cliente'] == "Gimnasio"){

				$datos = array("id_persona" => $datos['id_persona'],
				"tipo_cliente" => $datos["tipo_cliente"],		
				"id_matricula" =>  $datos["id_matricula"],
				"id_descuento" =>  $datos["id_descuento"],
				"compras" => $compra,
				"ultima_compra" => $ultimaCompra);
			} else {
				$datos = array("id_persona" => $datos['id_persona'],
				"tipo_cliente" => $datos["tipo_cliente"]);
			}
			
			$tabla = "tbl_clientes";
			
			$respuestaEditarCliente = ModeloClientes::mdlEditarCliente($tabla, $datos);
			// echo "<pre>";
			// var_dump($datos);
			// echo "</pre>";
			// return $respuestaEditarCliente;			

            if($respuestaEditarCliente = true){	

				

				//$tabla = "tbl_personas";
				$item = "id_personas";
				$valor = $datos['id_persona'];
				$all = null;

				$mostrarNombreCliente= ControladorPersonas::ctrMostrarPersonas($item, $valor, $all);
				
				$descripcionEvento = "".$_SESSION['usuario']." Actualizó el cliente de ventas llamado ".$mostrarNombreCliente['nombre']."";
				$accion = "Actualizar";
				$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION['id_usuario'], 4, $accion, $descripcionEvento);
				

				// GUARDAR EN LA TABLA CLIENTE INSCRIPCION

				// $totalIdInscripcion = array();
				// $tabla1 = "tbl_personas";
				// $tabla2 = "tbl_clientes";
				// $item = null;
				// $valor = null;
		
				// $clientesInscripcionTotal = ModeloClientes::mdlMostrarClientesSinPago($tabla1, $tabla2, $item, $valor);
				// // echo "<pre>";
				// // var_dump($clientesInscripcionTotal);
				// // echo "</pre>";
				// // return;
		
				
				// foreach($clientesInscripcionTotal as $keyCliente => $valueClienteInscripcion){
				// 	array_push($totalIdInscripcion, $valueClienteInscripcion["id_cliente"]);
					
				// }
				
				// $idClienteInscripcion = end($totalIdInscripcion);
				// echo "<pre>";
				// var_dump($idClienteInscripcion);
				// echo "</pre>";
				// return $idClienteInscripcion;
				
				
				$idInscripcion = $idDeInscripcion;
				
				
				$tabla = "tbl_inscripcion";
				$item = "id_inscripcion";
				$valor = $idDeInscripcion;
				$all = null;

				$inscripcion = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

				$cantidadDias = $inscripcion['cantidad_dias'];

				date_default_timezone_set("America/Tegucigalpa");
				$fechaHoy = date('Y-m-d');
				$fechaVencimientoCliente = date("Y-m-d", strtotime('+'.$cantidadDias.' days'));

				$datos = array("id_cliente" =>  $idClienteInscripcion,
								"id_inscripcion" => $idDeInscripcion,
								"fecha_inscripcion" => $fechaHoy,
								"fecha_pago" => $fechaHoy,
								"fecha_proximo_pago" => $fechaVencimientoCliente,
								"fecha_vencimiento" => $fechaVencimientoCliente);

				// return $datos;
								
				$tabla = "tbl_cliente_inscripcion";
	
				$respuestaClienteInscripcion = ModeloClientes::mdlCrearClienteInscripcion($tabla, $datos);

				// echo "<pre>";
				// var_dump($datos);
				// echo "</pre>";
				// return;

				if ($respuestaClienteInscripcion ==true) {
					
					// GUARDAR EN LA TABLA PAGOS
					// 
					// 
								
					$totalIdPagoCliente = array();
					$tabla = "tbl_cliente_inscripcion";
					// $tabla2 = "tbl_clientes";
					$item = null;
					$valor = null;
	
					$pagoClienteTotal = ModeloClientes::mdlMostrar($tabla, $item, $valor);
					// echo "<pre>";
					// var_dump($pagoClienteTotal[1]["id_cliente"]);
					// echo "</pre>";
					// return;
					
					foreach($pagoClienteTotal as $keyPagoCliente => $valuePagoCliente){
					array_push($totalIdPagoCliente, $valuePagoCliente["id_cliente_inscripcion"]);
				
					
					}
					
	
					$idPagoCliente = end($totalIdPagoCliente);
	
					// var_dump($parametros);
					// return $idPagoCliente;
					
					$tabla3 = "tbl_pagos_cliente";
	
					$datos = array("id_cliente_inscripcion" => $idPagoCliente,
									"pago_matricula" => $pago_matricula,
									"pago_descuento" => $pago_descuento,
									"pago_inscripcion" => $pago_inscripcion,
									"pago_total" => $pago_total);
	
									// $datos = array("id_cliente_inscripcion" => $idCliente,
									// "pago_matricula" => $pago_matricula,
									// "pago_descuento" => $pago_descuento,
									// "pago_inscripcion" => $pago_inscripcion,
									// "pago_total" => $pago_total);
	
					$respuestaPago = ModeloClientes::mdlCrearPago($tabla3, $datos);
					// echo "<pre>";
					// var_dump($datos);
					// echo "</pre>";
					// return;
					if ($respuestaPago == true) {
						
						return true;
					}
				
					

				}	



            } else {
				// echo '<script>
				// Swal.fire({
				// 	title: "Llene los campos correctamente.",
				// 	icon: "error",
				// 	toast: true,
				// 	position: "top",
				// 	showConfirmButton: false,
				// 	timer: 3000,
				// 	});					
				// </script>';
                return false;
            }
        } 

	}

    /*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($tabla, $item, $valor){
		// echo "<pre>";
        // var_dump($respuesta);
        // echo "</pre>";
		$tabla1 = "tbl_personas";
		$tabla2 = $tabla;



		$respuesta = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);

		return $respuesta;
	}


    /*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientesSinPago($tabla, $item, $valor){
		// echo "<pre>";
        // var_dump($respuesta);
        // echo "</pre>";

		$tabla1 = "tbl_personas";
		$tabla2 = $tabla;

		$respuesta = ModeloClientes::mdlMostrarClientesSinPago($tabla1, $tabla2, $item, $valor);

		return $respuesta;
	}


	/*=============================================
	MOSTRAR TABLA DE PAGOS
	=============================================*/

	static public function ctrMostrarPagos($tabla, $item, $valor){
		// echo "<pre>";
        // var_dump($respuesta);
        // echo "</pre>";

		$tabla1 = "tbl_pagos_cliente";
		$tabla2 = $tabla;

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);

		return $respuesta;
	}
	
	/*=============================================
	MOSTRAR CLIENTES INSCRIPCIONES
	=============================================*/
	static public function ctrMostrarClientesInscripcionPagos($tabla, $item1, $valor1, $item2, $valor2, $max){
		$tabla1 = "tbl_personas";
		$tabla2 = $tabla;

		$respuesta = ModeloClientes::mdlMostrarClientesInscripcionPagos($tabla1, $tabla2, $item1, $valor1, $item2, $valor2, $max);

		return $respuesta;
	}


	/*=============================================
	MOSTRAR PAGOS POR CLIENTE
	=============================================*/
	static public function ctrMostrarPagoPorCliente($tabla, $item, $valor){
		$tabla1 = "tbl_personas";
		$tabla2 = $tabla;

		$respuesta = ModeloClientes::mdlMostrarPagoPorCliente($tabla1, $tabla2, $item, $valor);

		return $respuesta;
	}


	/*=============================================
	MOSTRAR TODOS LOS PAGOS DE LOS CLIENTES
	=============================================*/
	static public function ctrMostrarPagosClientes($item, $valor){

		$respuesta = ModeloClientes::mdlMostrarPagosClientes($item, $valor);
		return $respuesta;
	}
	
	/*=============================================
	**** ACTUALIZAR PAGO POR CLIENTE MANTENIENDO INSCRIPCION ****
	=============================================*/
	static public function ctrActualizarPagoCliente($idClientePago){

		if(isset($idClientePago)){

			
			// $respuestaFinal = array('true' => true,
			// 						'fecha_proximo_pago' => $fechaVencimientoCliente);
			// return $respuestaFinal;

			$tabla1 = "tbl_personas";
			$tabla2 = "tbl_clientes";
			$item = 'id_cliente';
			$valor = $idClientePago;

			$respuesta = ModeloClientes::mdlMostrarPagoPorCliente($tabla1, $tabla2, $item, $valor);
			// $respuesta = ModeloClientes::mdlMostrarPagoPorCliente($tabla1, $tabla2, $item, $valor);

			// return $respuesta;

			date_default_timezone_set("America/Tegucigalpa");
			
			$fechaHoy = date('Y-m-d 00:00:00');
			$fechaVencimiento = $respuesta['fecha_vencimiento'];
			$idInscripcion = $respuesta['id_inscripcion'];
			$tipoInscripcion = $respuesta['tipo_inscripcion'];
			$cantidadDias = $respuesta['cantidad_dias'];
			$precioInscripcion = $respuesta['precio_inscripcion'];
			$idCliente = $respuesta['id_cliente'];
			$idClienteInscripcion = $respuesta['id_cliente_inscripcion'];
			
			// var_dump($parametros);
			// return $fechaVencimiento;

			$vigenciaCliente = $parametros['valor'];

			// return $fechaVencimiento;
			if($fechaHoy > $fechaVencimiento || $fechaHoy == $fechaVencimiento){
				$fechaVencimientoCliente = date("Y-m-d 00:00:00", strtotime('+'.$cantidadDias.' days'));

				// return 'hoy es mayor:  '.$fechaVencimientoCliente;

			// } 
			// else if($fechaHoy == $fechaVencimiento) {
			// 	// $fechaVencimientoCliente = 
			// 	return 'igual';
			}else {

				$fechaVencimientoCliente = date("Y-m-d", strtotime($fechaVencimiento.'+'.$cantidadDias.' days'));
				// return 'hoy es menor:  '.$fechaVencimientoCliente;
			}

			$tabla = 'tbl_cliente_inscripcion';

			// $idU =  $_SESSION['id_usuario'];
			// return $idU;

			$datos = array('id_cliente' => $idCliente,
							'fecha_pago' => $fechaHoy,
							'fecha_proximo_pago' => $fechaVencimientoCliente,
							'fecha_vencimiento' => $fechaVencimientoCliente);

			$fecha = true;
			$respuesta = ModeloClientes::mdlActualizarPagoCliente($tabla, $datos, $fecha);

			if($respuesta == true){

				$tabla = 'tbl_pagos_cliente';
				$datos = array('id_cliente_inscripcion' => $idClienteInscripcion,
								'pago_inscripcion' => $precioInscripcion,
								'pago_total' => $precioInscripcion);

				$fecha = null;
				$respuesta = ModeloClientes::mdlActualizarPagoCliente($tabla, $datos, $fecha);
			}

			$respuestaFinal = array('true' => true,
									'fecha_proximo_pago' => $fechaVencimientoCliente);
			return $respuestaFinal;	
		}
	}


	/*=============================================
	**** ACTUALIZAR PAGO POR CLIENTE CAMBIANDO INSCRIPCION ****
	=============================================*/
	static public function ctrActualizarPagoClienteCambiandoInscripcion(){
		// var_dump($_POST);
		// return;
		if(isset($_POST['actualizarTipoInscripcion'])){
			$tabla1 = "tbl_personas";
			$tabla2 = "tbl_clientes";
			$item = 'id_cliente';
			$valor = $_POST['idClientePago'];
			$respuesta = ModeloClientes::mdlMostrarPagoPorCliente($tabla1, $tabla2, $item, $valor);
			
			// var_dump($respuesta);
			// return;

			$fechaHoy = date('Y-m-d');
			$fechaVencimiento = $respuesta['fecha_proximo_pago'];
			$idCliente = $respuesta['id_cliente'];
			$idClienteInscripcion = $respuesta['id_cliente_inscripcion'];

			$idInscripcion = $_POST['actualizarTipoInscripcion'];

			$tabla = "tbl_inscripcion";
			$item = "id_inscripcion";
			$valor = $idInscripcion;
			$all = null;
			
			$inscripciones = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);  

			// var_dump($inscripciones);
			// return;

			$tipoInscripcion = $inscripciones['tipo_inscripcion'];
			$precioInscripcion = $inscripciones['precio_inscripcion'];
			$cantidadDias = $inscripciones['cantidad_dias'];	

			if($fechaHoy > $fechaVencimiento || $fechaHoy == $fechaVencimiento){
				$fechaVencimientoCliente = date("Y-m-d 00:00:00", strtotime('+'.$cantidadDias.' days'));

				// echo'hoy es mayor:  '.$fechaVencimientoCliente;
				// return;

			// } 
			// else if($fechaHoy == $fechaVencimiento) {
			// 	// $fechaVencimientoCliente = 
			// 	return 'igual';
			}else {

				$fechaVencimientoCliente = date("Y-m-d", strtotime($fechaVencimiento.'+'.$cantidadDias.' days'));
				
				// echo 'hoy es menor:  '.$fechaVencimientoCliente;
				// return;
			}

			
			$tabla = 'tbl_cliente_inscripcion';

			// $idU =  $_SESSION['id_usuario'];
			// return $idU;
			$idUsuario =  $_SESSION['id_usuario'];

			$datos = array('id_cliente' => $idCliente,
							'id_inscripcion' => $idInscripcion,
							'fecha_pago' => $fechaHoy,
							'fecha_proximo_pago' => $fechaVencimientoCliente,
							'fecha_vencimiento' => $fechaVencimientoCliente,
							'creado_por' => $idUsuario);

			$fecha = true;
			$respuestaActualizarInscripcion = ModeloClientes::mdlActualizarInscripcionPagoCliente($tabla, $datos, $fecha);

			if($respuestaActualizarInscripcion == true){

				$tabla = 'tbl_pagos_cliente';
				$datos = array('id_cliente_inscripcion' => $idClienteInscripcion,
								'pago_inscripcion' => $precioInscripcion,
								'pago_total' => $precioInscripcion);

				$fecha = null;
				$respuestaPagoCliente = ModeloClientes::mdlActualizarInscripcionPagoCliente($tabla, $datos, $fecha);
	
				if($respuestaPagoCliente == true){

					//$tabla = "tbl_personas";
					$item = "id_personas";
					$valor = $respuesta['id_personas'];
					$all = null;

					$mostrarNombreCliente= ControladorPersonas::ctrMostrarPersonas($item, $valor, $all);
				

					$descripcionEvento = "".$_SESSION['usuario']." Cambió el pago de inscripción al usuario ".$mostrarNombreCliente['nombre']."";
					$accion = "Actualizar";
					$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION['id_usuario'], 21, $accion, $descripcionEvento);


					echo "<script>
							Swal.fire({
								title: 'El cambio y pago de inscripcion, se realizo exitosamente!',
								text: 'Fecha proximo pago actualizada al ".$fechaVencimientoCliente."',
								icon: 'success',
								width: 600,
								allowOutsideClick: false,
								showCancelButton: false,
								showConfirmButton: true,
								confirmButtonText: 'Cerrar'
							}).then((result)=>{
								if(result.value){
									window.location = 'clientes-inscripciones';
								}
							});;
						</script>";
				} else {
					echo "<script>
							Swal.fire({
								title: 'Oops, algo salio. Intenta de nuevo!',
								icon: 'error',
								allowOutsideClick: false,
								showCancelButton: false,
								showConfirmButton: true,
								confirmButtonText: 'Cerrar'
							}).then((result)=>{
								if(result.value){
									window.location = 'clientes-inscripciones';
								}
							});;
						</script>";
				}
			
			} else {
				echo "<script>
							Swal.fire({
								title: 'Oops, algo salio. Intenta de nuevo!',
								icon: 'error',
								allowOutsideClick: false,
								showCancelButton: false,
								showConfirmButton: true,
								confirmButtonText: 'Cerrar'
							}).then((result)=>{
								if(result.value){
									window.location = 'clientes-inscripciones';
								}
							});;
						</script>";
			}



		}
	}



	/*=============================================
	NUEVA INSCRIPCION LUEGO DE CANCELAR INSCRIPCION
	=============================================*/
	static public function ctrNuevaInscripcionCliente(){
		// var_dump($_POST);
		// return;
		if(isset($_POST['nuevoClienteInscripcion'])){
		
			$idCliente = $_POST['nuevoClienteInscripcion'];

			$idInscripcion = $_POST['nuevaTipoInscripcion'];
			$tabla = "tbl_inscripcion";
			$item = "id_inscripcion";
			$valor = $idInscripcion;
			$all = null;

			$inscripciones = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all); 

			if($inscripciones){

				$cantidadDias = $inscripciones['cantidad_dias'];

				$tabla = "tbl_cliente_inscripcion";
				$item = "id_cliente";
				$valor = $_POST['nuevoClienteInscripcion'];
				$all = null;
				
				$clienteInscripcion = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all); 

				
				$idClienteInscripcion = $clienteInscripcion['id_cliente_inscripcion'];
				// var_dump($idClienteInscripcion.' '. $idCliente);
				// return;

				// echo $cantidadDias;
				// return;
	
				date_default_timezone_set("America/Tegucigalpa");
				$fechaHoy = date('Y-m-d');
				$fechaVencimientoCliente = date("Y-m-d", strtotime('+'.$cantidadDias.' days'));
	
				$datos = array("id_cliente" =>  $idCliente,
								"id_inscripcion" => $idInscripcion,
								"fecha_inscripcion" => $fechaHoy,
								"fecha_pago" => $fechaHoy,
								"fecha_proximo_pago" => $fechaVencimientoCliente,
								"fecha_vencimiento" => $fechaVencimientoCliente);
	
				// var_dump($datos);
				// return;


				$tabla = "tbl_cliente_inscripcion";
	
				$respuestaClienteInscripcion = ModeloClientes::mdlCrearClienteInscripcion($tabla, $datos);
	
				// var_dump($respuestaClienteInscripcion);
				// return;
				if($respuestaClienteInscripcion == true){

					$item1 = 'inscrito';
					$valor1 = 1;
					$item2 = 'id_cliente_inscripcion';
					$valor2 = $idClienteInscripcion;
					
					$ultimaInscripcion = ModeloClientes::mdlActualizarCliente($tabla, $item1, $valor1, $item2, $valor2);


					$totalId = array();
					$tabla = "tbl_cliente_inscripcion";
					// $tabla2 = "tbl_clientes";
					$item = null;
					$valor = null;
	
					$pagoClienteTotal = ModeloClientes::mdlMostrar($tabla, $item, $valor);
					// echo "<pre>";
					// var_dump($pagoClienteTotal[1]["id_cliente"]);
					// echo "</pre>";
					// return;
					
					foreach($pagoClienteTotal as $keyCliente => $valuePagoCliente){
						array_push($totalId, $valuePagoCliente["id_cliente_inscripcion"]);					
					}
					
	
					$idPagoCliente = end($totalId);
	
					// var_dump($idPagoCliente);
					// return;
					
					$tabla3 = "tbl_pagos_cliente";
	
					$datos = array("id_cliente_inscripcion" => $idPagoCliente,
									"pago_matricula" => 0,
									"pago_descuento" => 0,
									"pago_inscripcion" => $_POST['nuevaPagoInscripcion'],
									"pago_total" => $_POST['nuevoPagoTotal']);
	
									// $datos = array("id_cliente_inscripcion" => $idCliente,
									// "pago_matricula" => $pago_matricula,
									// "pago_descuento" => $pago_descuento,
									// "pago_inscripcion" => $pago_inscripcion,
									// "pago_total" => $pago_total);
	
					$respuestaPago = ModeloClientes::mdlCrearPago($tabla3, $datos);
					// echo "<pre>";
					// var_dump($respuestaPago);
					// echo "</pre>";
					// return $respuestaPago;
				
				
		
					if($respuestaPago == true){
						echo "<script>
								Swal.fire({
									title: 'Inscripcion agregada exitosamente!',
									icon: 'success',
									allowOutsideClick: false,
									showCancelButton: false,
									showConfirmButton: true,
									confirmButtonText: 'Cerrar'
								}).then((result)=>{
									if(result.value){
										window.location = 'clientes-inscripciones';
									}
								});;
							</script>";
					} else {
						echo "<script>
								Swal.fire({
									title: 'Oops, algo salio. Intenta de nuevo!',
									icon: 'error',
									allowOutsideClick: false,
									showCancelButton: false,
									showConfirmButton: true,
									confirmButtonText: 'Cerrar'
								}).then((result)=>{
									if(result.value){
										window.location = 'clientes-inscripciones';
									}
								});;
							</script>";
					}
				
				} else {
					echo "<script>
								Swal.fire({
									title: 'Oops, algo salio. Intenta de nuevo!',
									icon: 'error',
									allowOutsideClick: false,
									showCancelButton: false,
									showConfirmButton: true,
									confirmButtonText: 'Cerrar'
								}).then((result)=>{
									if(result.value){
										window.location = 'clientes-inscripciones';
									}
								});;
							</script>";
				}
			} else {
				echo "<script>
						Swal.fire({
							title: 'Oops, algo salio. Intenta de nuevo!',
							icon: 'error',
							allowOutsideClick: false,
							showCancelButton: false,
							showConfirmButton: true,
							confirmButtonText: 'Cerrar'
						}).then((result)=>{
							if(result.value){
								window.location = 'clientes-inscripciones';
							}
						});;
					</script>";
			}




		}
	}
	

	/*=============================================
	NUEVA INSCRIPCION
	=============================================*/
	static public function ctrNuevaInscripcion(){
		// var_dump($_POST);
		// return;
		if(isset($_POST['nuevoClienteSinInscripcion'])){
		
			// $idCliente = $_POST['nuevoClienteSinInscripcion'];

			$idInscripcion = $_POST['nuevaTipoInscripcion2'];
			$tabla = "tbl_inscripcion";
			$item = "id_inscripcion";
			$valor = $idInscripcion;
			$all = null;
			
			$inscripciones = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all); 

			if($inscripciones){

				$cantidadDias = $inscripciones['cantidad_dias'];

				// echo $cantidadDias;
				// return;

				$tabla = "tbl_cliente_inscripcion";
				$item = "id_cliente_inscripcion";
				$valor = $_POST['nuevoClienteSinInscripcion'];
				$all = null;
				
				$clienteInscripcion = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all); 

				// var_dump($clienteInscripcion);
				// return;
	
				$idCliente = $clienteInscripcion['id_cliente'];

				date_default_timezone_set("America/Tegucigalpa");
				$fechaHoy = date('Y-m-d');
				$fechaVencimientoCliente = date("Y-m-d", strtotime('+'.$cantidadDias.' days'));
	
				// $idUsuaurio =$_SESSION['id_usuario'];

				$datos = array("id_cliente" =>  $idCliente,
								"id_inscripcion" => $idInscripcion,
								"fecha_inscripcion" => $fechaHoy,
								"fecha_pago" => $fechaHoy,
								"fecha_proximo_pago" => $fechaVencimientoCliente,
								"fecha_vencimiento" => $fechaVencimientoCliente);
	
				// var_dump($datos);
				// return;
								
				$tabla = "tbl_cliente_inscripcion";
	
				$respuestaClienteInscripcion = ModeloClientes::mdlCrearClienteInscripcion($tabla, $datos);
	
				// var_dump($respuestaClienteInscripcion);
				// return;

				if($respuestaClienteInscripcion == true){

					$item1 = 'inscrito';
					$valor1 = 1;
					$item2 = 'id_cliente_inscripcion';
					$valor2 = $_POST['nuevoClienteSinInscripcion'];
					
					$ultimaInscripcion = ModeloClientes::mdlActualizarCliente($tabla, $item1, $valor1, $item2, $valor2);

					// var_dump($ultimaInscripcion);
					// return;

					$totalId = array();
					$tabla = "tbl_cliente_inscripcion";
					// $tabla2 = "tbl_clientes";
					$item = null;
					$valor = null;
	
					$ultimaInscripcion = ModeloClientes::mdlMostrar($tabla, $item, $valor);
					// echo "<pre>";
					// var_dump($ultimaInscripcion[1]["id_cliente"]);
					// echo "</pre>";
					// return;
					
					foreach($ultimaInscripcion as $keyCliente => $valuePagoCliente){
						array_push($totalId, $valuePagoCliente["id_cliente_inscripcion"]);					
					}
					
	
					$idPagoCliente = end($totalId);
	
					// var_dump($idPagoCliente);
					// return;
					
					$tabla3 = "tbl_pagos_cliente";
	
					$datos = array("id_cliente_inscripcion" => $idPagoCliente,
									"pago_matricula" => 0,
									"pago_descuento" => 0,
									"pago_inscripcion" => $_POST['nuevaPagoInscripcion2'],
									"pago_total" => $_POST['nuevoTotalPago']);
	
					$respuestaPago = ModeloClientes::mdlCrearPago($tabla3, $datos);
					// echo "<pre>";
					// var_dump($respuestaPago);
					// echo "</pre>";
					// return $respuestaPago;
				
				
		
					if($respuestaPago == true){
						$descripcionEvento = "".$_SESSION['usuario']." Creó una nueva inscripción ";
						$accion = "Nuevo";
						$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION['id_usuario'], 21, $accion, $descripcionEvento);
						echo "<script>
								Swal.fire({
									title: 'Inscripcion agregada exitosamente!',
									icon: 'success',
									allowOutsideClick: false,
									showCancelButton: false,
									showConfirmButton: true,
									confirmButtonText: 'Cerrar'
								}).then((result)=>{
									if(result.value){
										window.location = 'clientes-inscripciones';
									}
								});;
							</script>";
					} else {
						echo "<script>
								Swal.fire({
									title: 'Oops, algo salio. Intenta de nuevo!',
									icon: 'error',
									allowOutsideClick: false,
									showCancelButton: false,
									showConfirmButton: true,
									confirmButtonText: 'Cerrar'
								}).then((result)=>{
									if(result.value){
										window.location = 'clientes-inscripciones';
									}
								});;
							</script>";
					}
				
				} else {
					echo "<script>
								Swal.fire({
									title: 'Oops, algo salio. Intenta de nuevo!',
									icon: 'error',
									allowOutsideClick: false,
									showCancelButton: false,
									showConfirmButton: true,
									confirmButtonText: 'Cerrar'
								}).then((result)=>{
									if(result.value){
										window.location = 'clientes-inscripciones';
									}
								});;
							</script>";
				}
			} else {
				echo "<script>
						Swal.fire({
							title: 'Oops, algo salio. Intenta de nuevo!',
							icon: 'error',
							allowOutsideClick: false,
							showCancelButton: false,
							showConfirmButton: true,
							confirmButtonText: 'Cerrar'
						}).then((result)=>{
							if(result.value){
								window.location = 'clientes-inscripciones';
							}
						});;
					</script>";
			}




		}
	}
	

	/*=============================================
	MOSTRAR TODOS LOS CLIENTES QUE NO TENGAN INSCRIPCION		
	=============================================*/
	static public function ctrMostrarClientesSinInscripcion(){

		$respuesta = ModeloClientes::mdlMostrarClientesSinInscripcion();
		return $respuesta;
	}

    /*=============================================
	MOSTRAR (DINAMICO)
	=============================================*/
	static public function ctrMostrar($tabla, $item, $valor) {

		$tabla1 = $tabla; 
		$respuesta = ModeloClientes::mdlMostrar($tabla1, $item, $valor);

		return $respuesta;

	}
	
    /*=============================================
	MOSTRAR INSCRIPCION
	=============================================*/
	static public function ctrMostrarInscripcion($tabla, $item, $valor) {

		$tabla1 = $tabla; 
		$respuesta = ModeloClientes::mdlMostrarInscripcion($tabla1, $item, $valor);

		return $respuesta;

	}
	
    /*=============================================
	MOSTRAR DESCUENTOS
	=============================================*/
	static public function ctrMostrarDescuentos($tabla, $item, $valor) {

		$tabla1 = $tabla; 
		$respuesta = ModeloClientes::mdlMostrarDescuentos($tabla1, $item, $valor);

		return $respuesta;

	}

    // static public function ctrMostrarClientes($tabla, $item, $valor){
    
    //     $tabla1 = "tbl_personas";
    //     $tabla2 = $tabla;
    //     $respuesta = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);
    //     return $respuesta;   
	// }
	
	/*=============================================
	ELIMINAR CLIENTES
	=============================================*/

	static public function ctrEliminarCliente($pantalla){

		if(isset($_GET["idCliente"])){

			
			
			$tabla = "tbl_personas";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == true){
				
				$descripcionEvento = "Elimino cliente";
				$accion = "Elimino";

				$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 3,$accion, $descripcionEvento);

			  
		   

				echo '<script>
						Swal.fire({
							title: "Cliente eliminado correctamente!",
							icon: "success",
							heightAuto: false,
							allowOutsideClick: false
						}).then((result)=>{
							if(result.value){
								window.location = "'.$pantalla.'";
							}
						});                                              
					</script>';
			}
		}
	}


	/*=============================================
	RANGO CLIENTES
    =============================================*/
	static public function ctrRangoCliente($rango){

		$tabla = 'tbl_clientes';
		
		$respuesta = ModeloClientes::mdlRangoCliente($tabla, $rango);
		
		return $respuesta;
	}


	/*=============================================
	RANGO HISTORIAL PAGOS CLIENTES
    =============================================*/
	static public function ctrRangoHistorialPagosCliente($rango){

		$tabla = 'tbl_clientes';
		
		$respuesta = ModeloClientes::mdlRangoHistorialPagosCliente($tabla, $rango);
		
		return $respuesta;
	}


	/*=============================================
	RANGO INSCRIPCIONES ACTIVAS DE CLIENTES
    =============================================*/
	static public function ctrRangoClienteInscripcionActiva($rango){

		$tabla = 'tbl_clientes';
		
		$respuesta = ModeloClientes::mdlRangoClienteInscripcionActiva($tabla, $rango);
		
		return $respuesta;
	}

	/*=============================================
	RANGO INSCRIPCIONES DESACTIVADAS DE CLIENTES
    =============================================*/
	static public function ctrRangoClienteInscripcionDesactivado($rango){

		$tabla = 'tbl_clientes';
		
		$respuesta = ModeloClientes::mdlRangoClienteInscripcionDesactivado($tabla, $rango);
		
		return $respuesta;
	}
	
}

