<?php

class ControladorClientes{

    static public function ctrCrearCliente($datos){
		// echo "<pre>";
		// var_dump($datos);
		// echo "</pre>";
		// return $datos;


        if(isset($datos['id_persona'])){

			$tabla = "tbl_clientes";
			
			// if ($datos['tipo_cliente'] == "Gimnasio"){
			// 	$datos = array("id_persona" => $datos['id_persona'],
			//                 "tipo_cliente" => $datos["tipo_cliente"],
			// 				"id_inscripcion" =>  $datos["id_inscripcion"],
			// 				"id_matricula" =>  $datos["id_matricula"],
			// 				"id_descuento" =>  $datos["id_descuento"]);
			// } else {
			// 	$datos = array("id_persona" => $datos['id_persona'],
			//                   "tipo_cliente" => $datos["tipo_cliente"]);
			// }
							
			
			// return $datos;
            $respuestaCrearCliente = ModeloClientes::mdlCrearCliente($tabla, $datos);
            // echo "<pre>";
			// var_dump($respuestaCrearCliente);
			// echo "</pre>";
			// return;
            if($respuestaCrearCliente = true){

				if($datos['tipo_cliente'] == 'Gimnasio'){

					$totalId = array();
					$tabla1 = "tbl_personas";
					$tabla2 = "tbl_clientes";
					$item = null;
					$valor = null;
	
					$clientesTotal = ModeloClientes::mdlMostrarClientesSinPago($tabla1, $tabla2, $item, $valor);
					// echo "<pre>";
					// var_dump($clientesTotal[1]["id_cliente"]);
					// echo "</pre>";
					// return;
					
					foreach($clientesTotal as $keyCliente => $valueCliente){
						array_push($totalId, $valueCliente["id_cliente"]);
					}
					
	
					$idCliente = end($totalId);
	
					// return $idCliente;
					$vigencias = $_POST["nuevaInscripcion"];
	
						// echo $vigencias;
						// return;
	
						if ($vigencias == 1) {
							$valorVigencia = 'VIGENCIA_CLIENTE_MES';
							
							// var_dump("Mes",$valorVigencia);
							
						} else if ($vigencias == 2){
							$valorVigencia = 'VIGENCIA_CLIENTE_QUINCENAL';
							
							// var_dump("Quincenal",$valorVigencia);
							
						} else {
							$valorVigencia = 'VIGENCIA_CLIENTE_DIA';
							
							// var_dump("Diaria",$valorVigencia);
							
						}
	
					$item = 'parametro';
					$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valorVigencia);
					// var_dump($parametros);
					// return;
	
					$vigenciaCliente = $parametros['valor'];
					
					date_default_timezone_set("America/Tegucigalpa");
					$fechaHoy = date('Y-m-d');
					$fechaVencimientoCliente = date("Y-m-d", strtotime('+'.$vigenciaCliente.' days'));
					
					$tabla3 = "tbl_pagos_cliente";
	
					$datos = array("id_cliente" => $idCliente,
								   "pago_matricula" => $datos["pago_matricula"],
								   "id_descuento" => $datos["id_descuento"],
								   "pago_descuento" => $datos["pago_descuento"],
								   "id_inscripcion" => $datos["id_inscripcion"],
								   "pago_inscripcion" => $datos["pago_inscripcion"],
								   "pago_total" => $datos["pago_total"],
								   "fecha_ultimo_pago" => $fechaHoy,
								   "fecha_vencimiento" => $fechaVencimientoCliente);
	
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
					return true;
				}
				

            } else {
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

					$editarVigencias = $_POST["editarInscripcion"];

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
		MOSTRAR CLIENTES PAGOS
	=============================================*/
	static public function ctrMostrarClientesPagos($tabla, $item, $valor, $max){
		$tabla1 = "tbl_personas";
		$tabla2 = $tabla;

		$respuesta = ModeloClientes::mdlMostrarClientesPagos($tabla1, $tabla2, $item, $valor, $max);

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
		**** ACTUALIZAR PAGO POR CLIENTE ****
	=============================================*/
	static public function ctrActualizarPagoCliente($idClientePago){

		if(isset($idClientePago)){

			$tabla1 = "tbl_personas";
			$tabla2 = "tbl_clientes";
			$item = 'id_personas';
			$valor = $idClientePago;
			$respuesta = ModeloClientes::mdlMostrarPagoPorCliente($tabla1, $tabla2, $item, $valor);

			// return $respuesta;

			date_default_timezone_set("America/Tegucigalpa");
			
			$fechaHoy = date('Y-m-d 00:00:00');
			$fechaVencimiento = $respuesta['fecha_vencimiento'];
			$idInscripcion = $respuesta['id_inscripcion'];
			$tipoInscripcion = $respuesta['tipo_inscripcion'];
			$precioInscripcion = $respuesta['precio_inscripcion'];
			$idCliente = $respuesta['id_cliente'];
			
			if ($tipoInscripcion == 'mensual') {
				$valorVigencia = 'VIGENCIA_CLIENTE_MES';
				
			} else if ($tipoInscripcion == 'quincenal'){
				$valorVigencia = 'VIGENCIA_CLIENTE_QUINCENAL';
				
			} else {
				$valorVigencia = 'VIGENCIA_CLIENTE_DIA';
								
			}

			$item = 'parametro';
			$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valorVigencia);
			// var_dump($parametros);
			// return $parametros;

			$vigenciaCliente = $parametros['valor'];

			// return $fechaVencimiento;
			if($fechaHoy > $fechaVencimiento || $fechaHoy == $fechaVencimiento){
				$fechaVencimientoCliente = date("Y-m-d 00:00:00", strtotime('+'.$vigenciaCliente.' days'));

				// return 'hoy es mayor:  '.$fechaVencimientoCliente;

			// } 
			// else if($fechaHoy == $fechaVencimiento) {
			// 	// $fechaVencimientoCliente = 
			// 	return 'igual';
			}else {

				$fechaVencimientoCliente = date("Y-m-d", strtotime($fechaVencimiento.'+'.$vigenciaCliente.' days'));
				// return 'hoy es menor:  '.$fechaVencimientoCliente;
			}

			$tabla = 'tbl_pagos_cliente';

			// $idU =  $_SESSION['id_usuario'];
			// return $idU;

			$datos = array('id_cliente' => $idCliente,
							'id_inscripcion' => $idInscripcion,
							'pago_inscripcion' => $precioInscripcion,
							'pago_total' => $precioInscripcion,
							'fecha_ultimo_pago' => $fechaHoy,
							'fecha_vencimiento' => $fechaVencimientoCliente,
							'creado_por' => 1);

			$respuesta = ModeloClientes::mdlActualizarPagoCliente($tabla, $datos);


			return $respuesta;	
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
}

