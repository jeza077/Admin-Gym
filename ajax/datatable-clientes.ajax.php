<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";


class TablaClientes{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaClientes(){

        $tabla = "tbl_clientes";
        $item = null;
        $valor = null;
        $clientes = ControladorClientes::ctrMostrarClientesSinPago($tabla, $item, $valor);

        //   echo "<pre>";
        //   var_dump($clientes);
        //   echo "</pre>";
        //   return;
		
  		if(count($clientes) == 0){

  			echo '{"data": []}';

		  	return;
  		}
        
          
  		$datosJson = '{
              "data": [';
                       
            for($i = 0; $i < count($clientes); $i++){
                    
                /*=============================================
                TRAEMOS LAS ACCIONES
                =============================================*/ 

                if($clientes[$i]['tipo_cliente'] == "Gimnasio"){
                    // $botones = 'Gym';
                    
                    $botones = "<button class='btn btn-warning btnEditarClienteGimnasio' tipoClienteGimnasio='".$clientes[$i]["tipo_cliente"]."' id='btnEditarClienteGimnasio' data-toggle='modal' data-target='#modalEditarClienteGimnasio' idEditarClienteGimnasio='".$clientes[$i]["id_personas"]."'><i class='fas fa-pencil-alt' style='color:#fff'></i></button> <button class='btn btn-danger btnEliminarCliente' idPersona='".$clientes[$i]["id_personas"]."'><i class='fas fa-trash-alt'></i></button>";

                } else {
                    // $botones = 'Ventas';

                    $botones = "<button class='btn btn-warning btnEditarClienteVenta' tipoClienteVenta='".$clientes[$i]["tipo_cliente"]."' id='btnEditarClienteVenta' data-toggle='modal' data-target='#modalEditarClienteVenta' idEditarClienteVenta='".$clientes[$i]["id_personas"]."'><i class='fas fa-pencil-alt' style='color:#fff'></i></button> <button class='btn btn-danger btnEliminarCliente' idPersona='".$clientes[$i]["id_personas"]."'><i class='fas fa-trash-alt'></i></button>";
                }

                $datosJson .='[
                    "'.($i+1).'",
                    "'.$clientes[$i]["num_documento"].'",
                    "'.$clientes[$i]["nombre"].' '.$clientes[$i]["apellidos"].'",
                    "'.$clientes[$i]["tipo_cliente"].'",
                    "'.$clientes[$i]["correo"].'",
                    "'.$clientes[$i]["telefono"].'",
                    "'.$clientes[$i]["fecha_creacion"].'",
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
$mostrarClientes = new TablaClientes();
$mostrarClientes -> mostrarTablaClientes();
    