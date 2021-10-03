<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class TablaVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaVentas(){

        // if(isset($_GET["fechaInicial"])){

        //     $fechaInicial = $_GET["fechaInicial"];
        //     $fechaFinal = $_GET["fechaFinal"];

        // } else {

            $fechaInicial = null;
            $fechaFinal = null;

        // }

        $ventas = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

  		if(count($ventas) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($ventas); $i++){

            // $prod = "<div>";
            
                $decod = json_decode($ventas[$i]['productos']);
                error_reporting(0);
                foreach ($decod as $key => $val) {
                    $contador = count($val->descripcion);
                    // echo ($contador);
                    if($contador == 11){
                        // echo 'mas de uno';
                        // echo  $val->descripcion.',';
                        "<div>'".$val->descripcion.",'</div>"
                    } else {
                        "<div>'".$val->descripcion.", '</div>"
                        // echo  $val->descripcion.', ';
                        // echo 'solo uno';
                        // echo  $val->descripcion;
                    }
                }
                // "</div>";
                // var_dump($decod); 
                $listaProductos = 'Proteina'; 

                // $listaProductos = "<div>'".$decod."'</div>"; 

            // $botones = "<button class='btn btn-info btnImprimirFactura' codigoVenta='".$ventas[$i]["numero_factura"]."'><i class='fa fa-print' style='color:#fff'></i></button>  

            // <button class='btn btn-warning btnEditarVenta' idVenta='".$ventas[$i]["id_venta"]."'><i class='fas fa-pencil-alt' style='color:#fff'></i></button>   

            // <button class='btn btn-danger btnEliminarVenta' idVenta='".$ventas[$i]["id_venta"]."'><i class='fas fa-trash-alt'></i></button>";

            $botones = 'boton';

            $datosJson .='[
			      "'.($i+1).'",
			      "'.$ventas[$i]["numero_factura"].'",
                  "'.$ventas[$i]["nombre"].' '.$ventas[$i]["apellidos"].'",
                  "'.$listaProductos.'",
                  "'.number_format($ventas[$i]["total"],2).'",
                  "'.$ventas[$i]["fecha"].'",
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
$mostrarVentas = new TablaVentas();
$mostrarVentas -> mostrarTablaVentas();
    