<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

/*
class TablaProductos{

    // MOSTRAR LA TABLA DE 
    //    PRODUCTO 
    public function mostrarTabla(){
        $item= null;
        $valor= null;
        $productos= ControladorProductos::ctrMostrarProductos($item, $valor);
        
        echo '{
            "data": [';

                for ($i=0; $i < count($productos)-1; $i++) { 

                    echo '[
                            "'.($i+1).'",
                            "'.$productos[$i]["imagen"].'",
                            "'.$productos[$i]["codigo"].'",
                            "'.$productos[$i]["descripcion"].'",
                            "'.$productos[$i]["stock"].'",
                            "'.$productos[$i]["id"].'"
                        ],';

                }
                
                echo '[
                            "'.count($productos).'",
                            "'.$productos[count($productos)-1]["imagen"].'", 
                            "'.$productos[count($productos)-1]["codigo"].'",
                            "'.$productos[count($productos)-1]["descripcion"].'",
                            "'.$productos[count($productos)-1]["stock"].'",
                            "'.$productos[count($productos)-1]["id"].'" 
                        ]
            ] 
      }';
    }
}
// ACTIVAR LA TABLA DE 
//    PRODUCTO 

$activar= new TablaProductos();
$activar-> mostrarTabla();
*/

class TablaProductosVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductosVentas(){

		$item = null;
    	$valor = null;

          $productos = ControladorProductos::ctrMostrarProductos($item, $valor);	
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

  			if($productos[$i]["stock"] <= 10){

  				$stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

  			}else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15){

  				$stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id_inventario"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$productos[$i]["nombre_producto"].'",
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
    