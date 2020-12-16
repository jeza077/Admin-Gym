<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class TablaProductosVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductosVentas(){

		// $item = null;
    	// $valor = null;


		$item = 'id_tipo_producto';
		$valor = 1;
		$all = true;

		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $all);	
        //   echo "<pre>";
        //   var_dump($productos);
        //   echo "</pre>";
        //   return;
		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

              // $imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";
		  	$imagen = "<img src='vistas/img/usuarios/default/anonymous.png' width='40px'>";
              

		  	/*=============================================
 	 		STOCK
  			=============================================*/ 
			$stockTotal = $productos[$i]["stock"]  + $productos[$i]["devolucion"];

  			if($productos[$i]["stock"] <= 10){

  				$stock = "<button class='btn btn-danger'>".$stockTotal."</button>";

  			}else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15){

  				$stock = "<button class='btn btn-warning'>".$stockTotal."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$stockTotal."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id_inventario"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			     
			      "'.$productos[$i]["nombre_producto"].'",
			      "'.$stock.'",
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
$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas -> mostrarTablaProductosVentas();
    