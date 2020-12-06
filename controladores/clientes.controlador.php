<?php
date_default_timezone_set("America/Tegucigalpa");

class ControladorClientes{

	static public function ctrCrearCliente($datos){
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

			$tabla = "tbl_clientes";
			
			if ($datos['tipo_cliente'] == "Gimnasio"){
				$datos = array("id_persona" => $datos['id_persona'],
			                "tipo_cliente" => $datos["tipo_cliente"],		
							"id_matricula" =>  $datos["id_matricula"],
							"id_descuento" =>  $datos["id_descuento"]);
			} else {
				$datos = array("id_persona" => $datos['id_persona'],
			                  "tipo_cliente" => $datos["tipo_cliente"]);
			}

							
			

            $respuestaCrearCliente = ModeloClientes::mdlCrearCliente($tabla, $datos);
			// return $respuestaCrearCliente;

            if($respuestaCrearCliente = true){			

				// GUARDAR EN LA TABLA CLIENTE INSCRIPCION

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

				$inscripcion = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

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

					
				// GUARDAR EN LA TABLA PAGOS
				// 
				// 
							
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
			
				$descripcionEvento = "Nuevo cliente";
				$accion = "Nuevo";
				$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 3,$accion, $descripcionEvento);


				
				

				

				return true;

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
				EDITAR CLIENTE
	=============================================*/
	static public function ctrEditarCliente($datos){
		// // echo "<pre>";
		// // var_dump
		// // echo "</pre>";
		// return ($datos);

        if(isset($datos['id_persona'])){

			$pago_matricula = $datos['pagos_matricula'];
			$pago_descuento = $datos['pagos_descuento'];
			$pago_inscripcion = $datos['pagos_inscripcion'];
			$pago_total = $datos['pagos_total'];

			$tabla = "tbl_clientes";
			
			if ($datos['tipo_cliente'] == "Gimnasio"){
				$datos = array("id_persona" => $datos['id_persona'],
			                "tipo_cliente" => $datos["tipo_cliente"],
							"id_inscripcion" =>  $datos["id_inscripcion"],
							"id_matricula" =>  $datos["id_matricula"],
							"id_descuento" =>  $datos["id_descuento"]);
			} else {
				$datos = array("id_persona" => $datos['id_persona'],
			                  "tipo_cliente" => $datos["tipo_cliente"]);
			}
			// echo "<pre>";
			// var_dump($datos);
			// echo "</pre>";
			// return;
			

			$respuestaEditarClientes = ModeloClientes::mdlEditarCliente($tabla, $datos);
			// echo "<pre>";
			// var_dump($respuestaEditarClientes);
			// echo "</pre>";
			// return;

            if($respuestaEditarClientes = true){
				
				$tabla = "tbl_personas";
				$tabla2 = "tbl_clientes";
				$item = "id_persona";
				$valor = $datos["id_persona"];

				$personaTotal = ModeloClientes::mdlMostrarClientes($tabla, $tabla2, $item, $valor);
				// var_dump($personaTotal);
				// return;
				$idCliente = $personaTotal["id_cliente"];

					$editar = $_POST["editarInscripcion"];

					// echo $vigencias;
					// return;

					if ($editarVigencias == 1) {
						$editarValorVigencia = 'VIGENCIA_CLIENTE_MES';
						
						// var_dump("Mes",$valorVigencia);
						
					} else if ($editarVigencias == 2){
						$editarValorVigencia = 'VIGENCIA_CLIENTE_QUINCENAL';
						
						// var_dump("Quincenal",$valorVigencia);
						
					} else {
						$editarValorVigencia = 'VIGENCIA_CLIENTE_DIA';
						
						// var_dump("Diaria",$valorVigencia);
						
					}

				$item = 'parametro';
				// $valor = 'VIGENCIA_CLIENTE_QUINCENAL';
				$parametros = ControladorUsuarios::ctrMostrarParametros($item, $editarValorVigencia);
				// echo "<pre>";
				// var_dump($vigencias);
				// echo "</pre>";
				// return;
		
				$vigenciaCliente = $parametros['valor'];
				
				date_default_timezone_set("America/Tegucigalpa");
				$fechaVencimiento = date("Y-m-d", strtotime('+'.$vigenciaCliente.' days'));

				$datos = array("id_cliente" =>$idCliente,
				"pago_matricula" => $pago_matricula,
				"pago_descuento" => $pago_descuento,
				"pago_inscripcion" => $pago_inscripcion,
				"pago_total" => $pago_total,
				"fecha_vencimiento" => $fechaVencimiento);

				$tabla = "tbl_pagos_cliente";

				$respuestaEditarPago = ModeloClientes::mdlEditarPago($tabla, $datos);

				// echo "<pre>";
				// var_dump($respuestaEditarPago);
				// echo "</pre>";
				// return;
                if ($respuestaEditarPago == true) {
					
					$descripcionEvento = "Actualizo cliente";
					$accion = "Actualizo";

					$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 3,$accion, $descripcionEvento);

				
			   
					
					return true;
				} else {
					return false;
				}       

            } else {
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
	static public function ctrMostrarClientesInscripcionPagos($tabla, $item, $valor, $max){
		$tabla1 = "tbl_personas";
		$tabla2 = $tabla;

		$respuesta = ModeloClientes::mdlMostrarClientesInscripcionPagos($tabla1, $tabla2, $item, $valor, $max);

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
	**** ACTUALIZAR PAGO POR CLIENTE MANTENIENDO INSCRIPCION ****
	=============================================*/
	static public function ctrActualizarPagoCliente($idClientePago){

		if(isset($idClientePago)){

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
			return $respuesta;	
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
			
			$inscripciones = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);  

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
					echo "<script>
							Swal.fire({
								title: 'El cambio y pago de inscripcion, se realizo exitosamente!',
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



		}
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
		RANGO PAGOS CLIENTES
    =============================================*/
	static public function ctrRangoPagosCliente($rango){

		$tabla = 'tbl_clientes';
		
		$respuesta = ModeloClientes::mdlRangoPagosCliente($tabla, $rango);
		
		return $respuesta;
	}
}

