<?php

class ControladorClientes{

    static public function ctrCrearCliente($datos){
		// echo "<pre>";
		// var_dump($datos);
		// echo "</pre>";
		// return;


        if(isset($datos['id_persona'])){

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
							
			

            $respuestaCrearCliente = ModeloClientes::mdlCrearCliente($tabla, $datos);
            // echo "<pre>";
			// var_dump($respuestaCrearCliente);
			// echo "</pre>";
			// return;
            if($respuestaCrearCliente = true){
				
				$totalId = array();
				$tabla = "tbl_personas";
				$tabla2 = "tbl_clientes";
				$item = null;
				$valor = null;

				$personaTotal = ModeloClientes::mdlMostrarClientes($tabla, $tabla2, $item, $valor);
				
				foreach($personaTotal as $keyCliente => $valueCliente){
				array_push($totalId, $valueCliente["id_cliente"]);

				
				}

				$idCliente = end($totalId);
				
				$tabla3 = "tbl_pagos_cliente";

				$datos = array("id_cliente" =>$idCliente,
							   "pago_matricula" => $_POST["pagoMatricula"],
							   "pago_descuento" => $_POST["nuevoPrecioDescuento"],
							   "pago_inscripcion" => $_POST["pagoInscripcion"],
							   "pago_total" => $_POST["nuevoTotalCliente"]);

				$respuestaPago = ModeloClientes::mdlCrearPago($tabla3, $datos);
				// echo "<pre>";
				// var_dump($respuestaPago);
				// echo "</pre>";
				// return;

                return true;

            } else {
                return false;
            }
        }

	}
	/*=============================================
				EDITAR CLIENTE
	=============================================*/
	static public function ctrEditarCliente($datos){
		// echo "<pre>";
		// var_dump
		// echo "</pre>";
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

					// $vigencias = $_POST["nuevaInscripcion"];

					// if ($vigencias == 0) {
					// 	$valorVigencia = 'VIGENCIA_CLIENTE_MES';
						
					// 	var_dump("Mes",$valorVigencia);
						
					// } else if ($vigencias == 1){
					// 	$valorVigencia = 'VIGENCIA_CLIENTE_QUINCENAL';
						
					// 	var_dump("Quincenal",$valorVigencia);
						
					// } else if ($vigencias == 2) {
					// 	$valorVigencia = 'VIGENCIA_CLIENTE_DIA';
						
					// 	var_dump("Diaria",$valorVigencia);
						
					// }

				$item = 'parametro';
				$valor = 'VIGENCIA_CLIENTE_QUINCENAL';
				$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
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

                if ($respuestaEditarPago == true) {
					
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

