<?php

require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class TablaInventario{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaInventario(){

        $tabla = "tbl_inventario";
        $item = null;
        $valor = null;
        $order = null;
        $inventario = ControladorInventario::ctrMostrarInventario($tabla, $item, $valor,$order);
        
  		if(count($inventario) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($inventario); $i++){

            $stocktotal = $inventario[$i]["stock"] + $inventario[$i]["devolucion"];

            if($stocktotal <= $inventario[$i]['producto_minimo']){

              $stock = "<button class='btn btn-danger'>".$stocktotal."</button>";
    
            }else{
    
              $stock = "<button class='btn btn-success'>".$stocktotal."</button>";
    
            }

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$inventario[$i]["codigo"].'",
                  "'.$inventario[$i]["nombre_producto"].'",
                  "'.$inventario[$i]["tipo_producto"].'",
			      "'.$stock.'"
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
$mostrarInventario = new TablaInventario();
$mostrarInventario -> mostrarTablaInventario();
    