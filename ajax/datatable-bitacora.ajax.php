<?php
require_once "../controladores/mantenimiento.controlador.php";
require_once "../modelos/mantenimiento.modelo.php";

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

		  	$datosJson .='[
			      "'.($i+1).'",
                  "'.$bitac[$i]["usuario"].'",
			      "'.$bitac[$i]["objeto"].'",
                  "'.$bitac[$i]["accion"].'",
			      "'.$bitac[$i]["descripcion"].'",
			      "'.$bitac[$i]["fecha"].'"
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
    