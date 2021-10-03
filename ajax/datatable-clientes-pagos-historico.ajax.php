<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";


class TablaClientesPagosHistorico{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaClientesPagosHistorico(){

        $item = null;
        $valor = null;
        $clientes = ControladorClientes::ctrMostrarPagosClientes($item, $valor);

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
                    
                if($clientes[$i]["pago_matricula"] == null){
                    $pagoMatricula = "<div>L. 0.00</div>";
                    // $pagoMatricula = "50";
                } else {
                    $pagoMatricula = "<div>L. ".number_format($clientes[$i]["pago_matricula"],2)."</div>";
                    // $pagoMatricula = "100";
                }
                
                if($clientes[$i]["pago_descuento"] == null){
                    $pagoDescuento = "<div>L. 0.00</div>";
                    // $pagoDescuento = "400";
                } else {
                    $pagoDescuento = "<div>L. ".number_format($clientes[$i]["pago_descuento"],2)."</div>";
                    // $pagoDescuento = "200";
                }
                
            
                /*=============================================
                TRAEMOS LAS ACCIONES
                =============================================*/ 

                $botones = "<button class='btn btn-info btnReciboPagoCliente' idClientePago='".$clientes[$i]["id_pagos_cliente"]."' data-toggle='tooltip' data-placement='left' title='Imprimir recibo pago'><i class='fa fa-print'></i></button>";
                // $botones = 'hola';

                $datosJson .='[
                    "'.($i+1).'",
                    "'.$clientes[$i]["num_documento"].'",
                    "'.$clientes[$i]["nombre"].' '.$clientes[$i]["apellidos"].'",
                    "'.$pagoMatricula.'",
                    "'.$pagoDescuento.'",
                    "L. '.number_format($clientes[$i]["pago_inscripcion"],2).'",
                    "L. '.number_format($clientes[$i]["pago_total"],2).'",
                    "'.$clientes[$i]["fecha_de_pago"].'",
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
$mostrarClientesPagosHistorico = new TablaClientesPagosHistorico();
$mostrarClientesPagosHistorico -> mostrarTablaClientesPagosHistorico();
    