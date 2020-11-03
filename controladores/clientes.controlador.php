<?php

class ControladorClientes{

    static public function ctrCrearCliente($datos){
		// echo "<pre>";
		// var_dump($datos);
		// echo "</pre>";
		// return;


        if(isset($datos['id_persona'])){

            $tabla = "tbl_clientes";
							
			$datos = array("id_persona" => $datos['id_persona'],
							"id_inscripcion" =>  $datos["id_inscripcion"],
							"id_matricula" =>  $datos["id_matricula"],
							"id_descuentos_promociones" =>  $datos["id_descuentos_promociones"]);

            $respuestaCliente = ModeloClientes::mdlCrearCliente($tabla, $datos);

            if($respuestaCliente = true){
				
				$totalId = array();
				$tabla = "tbl_personas";
				$tabla2 = "tbl_clientes";
				$item = null;
				$valor = null;

				$personaTotal = ModeloClientes::mdlMostrarClientes($tabla, $tabla2, $item, $valor);
				
				foreach($personaTotal as $keyCliente => $valuePersona){
				array_push($totalId, $valuePersona["id_cliente"]);

				
				}

				$idCliente = end($totalId);

				// $datos = array("id_clientes" =>$idCliente,
				// "id_inscripcion" =>  $datos["id_inscripcion"]);
                        
                return true;

            } else {
                return false;
            }
        }

    }
    
   /*=============================================
				MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($tabla, $item, $valor){
		$tabla1 = "tbl_personas";
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
}

