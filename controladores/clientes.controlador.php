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
							"id_descuentos_promociones" =>  $datos["id_descuentos_promociones"]);
			} else {
				$datos = array("id_persona" => $datos['id_persona'],
			                  "tipo_cliente" => $datos["tipo_cliente"]);
			}
							
			

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
				ELIMINAR CLIENTES
	=============================================*/

	static public function ctrEliminarCliente(){

		if(isset($_GET["idCliente"])){

			
			
			$tabla = "tbl_personas";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta = true){
				
				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

				

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

