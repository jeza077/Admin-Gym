<?php
session_start();
// require_once "../controladores/usuarios.controlador.php";
// require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class TablaCompras{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaCompras(){

        // $var = $_SESSION['permisos']['Usuarios']['agregar'];
        // var_dump($var);

        // $permisosSesion = ControladorInventario::ctrPermisosSesion();
        // var_dump($permisosSesion);

        $tabla = "tbl_compras";
        $item = null;
        $valor = null;
        $compras = ControladorInventario::ctrMostrarCompras($tabla, $item, $valor);
        
        //   echo "<pre>";
        //   var_dump($compras);
        //   echo "</pre>";
        //   return;
		
  		if(count($compras) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($compras); $i++){

		  	$datosJson .='[
			      "'.($i+1).'",
                  "'.$compras[$i]["nombre_producto"].'",
			      "'.$compras[$i]["nombre"].'",
                  "'.$compras[$i]["cantidad"].'",
			      "'.$compras[$i]["precio"].'",
			      "'.$compras[$i]["fecha"].'"
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
$mostrarCompras = new TablaCompras();
$mostrarCompras -> mostrarTablaCompras();
    