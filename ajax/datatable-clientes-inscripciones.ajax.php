<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";


class TablaClientesInscripciones{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaClientesInscripciones(){

        $tabla = "tbl_clientes";
        $item1 = 'tipo_cliente';
        $valor1 = 'Gimnasio';
        $item2 = 'estado';
        $valor2 = 1;
        $max = null;
        $clientes = ControladorClientes::ctrMostrarClientesInscripcionPagos($tabla, $item1, $valor1, $item2, $valor2, $max);

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
                    

                $fecha_actual = strtotime(date("Y-m-d"));
                $fecha_entrada = strtotime($clientes[$i]['fecha_proximo_pago']);

                if($fecha_actual < $fecha_entrada){  
                    $fechaProximoPago = "<div class='badge badge-success mt-2' data-toggle='tooltip' data-placement='left' title='Inscrito'>".$clientes[$i]["fecha_proximo_pago"]."</div>";
                    // $fechaProximoPago = 'hoy';
                } else {
                    $fechaProximoPago = "<div class='badge badge-danger mt-2' data-toggle='tooltip' data-placement='left' title='Inscripcion vencida'>".$clientes[$i]["fecha_proximo_pago"]."</div>";
                    
                    // $fechaProximoPago = 'mañana';

                }

                  if($fecha_actual > $fecha_entrada){
                  
                    $diasInscripcion = $clientes[$i]['cantidad_dias'];
                    $segundos = $fecha_entrada - $fecha_actual;
                    $dias = $segundos / 86400;
                    $diasFinal = ceil($dias / $diasInscripcion);
                    // echo $diasFinal;

                    $deuda = abs($clientes[$i]['precio_inscripcion'] * $diasFinal);

                    $deudaFinal = "<div>L.$deuda</div>";

                    // $deudaFinal = 'L.'.$deuda.'';
                  
                  } else {

                    $deudaFinal = "<div data-toggle='tooltip' data-placement='left' title='No debe'>L.00.00</div>";

                    // $deudaFinal = 'L.00.00';

                  }
              
                  if($clientes[$i]['estado'] != 0){
                    $estado = "<div><span class='badge badge-success p-3'>A</span></div>";
                    // $estado = 'Activado';
                  } else {
                    $estado = "<div><span class='badge badge-danger p-3'>D</span></div>";
                    // $estado = 'Deactivado';
                    
                  }
            
            
                /*=============================================
                TRAEMOS LAS ACCIONES
                =============================================*/ 

                $botones = "<button class='btn btn-success btnEditarPago' data-toggle='tooltip' data-placement='left' title='Pagar' idCliente='".$clientes[$i]["id_cliente"]."'><i class='fas fa-dollar-sign p-1'></i></button> <button class='btn btn-danger btnCancelarInscripcion' data-toggle='tooltip' data-placement='left' title='Cancelar Inscripcion' idClienteInscripcion='".$clientes[$i]["id_cliente_inscripcion"]."' idClientePagoInscripcion='".$clientes[$i]["id_cliente"]."'><i class='fas fa-strikethrough'></i></button>";

                $datosJson .='[
                    "'.($i+1).'",
                    "'.$clientes[$i]["num_documento"].'",
                    "'.$clientes[$i]["nombre"].' '.$clientes[$i]["apellidos"].'",
                    "'.$clientes[$i]["tipo_inscripcion"].'",
                    "'.$clientes[$i]["fecha_inscripcion"].'",
                    "'.$clientes[$i]["fecha_pago"].'",
                    "'.$fechaProximoPago.'",
                    "'.$deudaFinal.'",
                    "'.$estado.'",
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
$mostrarClientesInscripciones = new TablaClientesInscripciones();
$mostrarClientesInscripciones -> mostrarTablaClientesInscripciones();
    