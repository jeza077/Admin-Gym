<?php

require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class TablaProductos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaProductos(){

        $tabla = "tbl_inventario";
        $item = "tipo_producto";
        $valor = "Productos";
        $order = null;
        $productos = ControladorInventario::ctrMostrarInventario($tabla, $item, $valor,$order);
        
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($productos); $i++){

            if($productos[$i]["foto"] != ""){
                $foto = "<div><img src='".$productos[$i]["foto"]."' class='img-thumbnail' width='40px'></div>";
            } else {
                $foto = "<div><img src='vistas/img/productos/default/product.png' class='img-thumbnail' width='40px'></div>";
            }

            $boton = "<button class='btn btn-warning btnEditarInventario' idInventario='".$productos[$i]["id_inventario"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fas fa-pencil-alt' style='color:#fff'></i></button>";

            $datosJson .='[
			      "'.($i+1).'",
			      "'.$productos[$i]["codigo"].'",
			      "'.$foto.'",
                  "'.$productos[$i]["nombre_producto"].'",
                  "L. '.number_format($productos[$i]["precio_venta"], 2).'",
                  "'.$productos[$i]["producto_minimo"].'",
                  "'.$productos[$i]["producto_maximo"].'",
			      "'.$boton.'"
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
$mostrarProductos = new TablaProductos();
$mostrarProductos -> mostrarTablaProductos();
    