<?php
require_once "../controladores/mantenimiento.controlador.php";
require_once "../modelos/mantenimiento.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";


class TablaBitacora{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaBitacora(){

        $fechaInicial = null;
        $fechaFinal = null;

        $bitac = ControladorMantenimientos::ctrRangoFechasBitacora($fechaInicial, $fechaFinal);
        //   echo "<pre>";
        //   var_dump($productos);
        //   echo "</pre>";
        //   return;
		
  		if(count($bitac) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($bitac); $i++){

			$botones = "<button class='btn btn-danger btnEliminarBitacora' idBitacora='".$bitac[$i]["id_bitacora"]."'><i class='fas fa-trash-alt'></i></button>";

		  	$datosJson .='[
			      "'.($i+1).'",
                  "'.$bitac[$i]["usuario"].'",
			      "'.$bitac[$i]["objeto"].'",
                  "'.$bitac[$i]["accion"].'",
			      "'.$bitac[$i]["descripcion"].'",
			      "'.$bitac[$i]["fecha"].'",
				  "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$mostrarBitacora = new TablaBitacora();
$mostrarBitacora -> mostrarTablaBitacora();
    