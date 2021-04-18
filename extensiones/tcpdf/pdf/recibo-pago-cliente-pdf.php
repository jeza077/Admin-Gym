<?php

require_once("../../../controladores/usuarios.controlador.php");
// require_once('../../../controladores/ventas.controlador.php');
require_once('../../../controladores/clientes.controlador.php');
// require_once('../../../controladores/productos.controlador.php');
// require_once "../../../modelos/productos.modelo.php";
require_once "../../../modelos/clientes.modelo.php";
// require_once "../../../modelos/ventas.modelo.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once('../examples/tcpdf_include.php');

// echo $_GET["codigo"];


class imprimirReciboPagoCliente{

	

	public $codigo;

	
	public function traerImpresionFactura(){
		date_default_timezone_set("America/Tegucigalpa");

		$fechaHoy = date('Y-m-d H:i:s');

		$item="parametro";
		$valor="ADMIN_NOMBRE_EMPRESA";

		$nombreEmpresa = ControladorUsuarios::ctrMostrarParametros($item, $valor);
		// var_dump($nombreEmpresa ['valor']);
		$nombre = $nombreEmpresa ['valor'];

		$item="parametro";
		$valor="ADMIN_DIRECCION_EMPRESA";

		$direccionEmpresa = ControladorUsuarios::ctrMostrarParametros($item, $valor);
		// var_dump($direccionEmpresa ['valor']);
		$direccion = $direccionEmpresa ['valor'];

		$item="parametro";
		$valor="ADMIN_CORREO";

		$correoEmpresa = ControladorUsuarios::ctrMostrarParametros($item, $valor);
		// var_dump($correoEmpresa ['valor']);
		$correo = $correoEmpresa ['valor'];
		

		//TRAEMOS LA INFORMACIÓN DE LA VENTA

		$item = "id_pagos_cliente";
		$valor = $this->codigo;
		
		$clientes = ControladorClientes::ctrMostrarPagosClientes($item, $valor);
		// var_dump($clientes);

		if($clientes['pago_matricula'] == null){
			$pago_matricula = 0;
		} else {
			$pago_matricula = $clientes['pago_matricula'];
		}
		
		if($clientes['pago_descuento'] == null){
			$pago_descuento = 0;
		} else {
			$pago_descuento = $clientes['pago_descuento'];
		}

		if($clientes['pago_inscripcion'] == null){
			$pago_inscripcion = 0;
		} else {
			$pago_inscripcion = $clientes['pago_inscripcion'];
		}


		if(!empty($clientes)){			
			
		## 07/12/2020

		ob_start();
		error_reporting(E_ALL & ~E_NOTICE);
		ini_set('display_errors', 0);
		ini_set('log_errors', 1);
		set_time_limit(0);


		## FIN 07/12/2020



		// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new TCPDF('p', 'mm', 'A5', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Gym La Roca');
		$pdf->SetTitle('Recibo de Pago Inscripcion Cliente');
		$pdf->SetSubject('');
		$pdf->SetKeywords('');

		$pdf->startPageGroup();

		$pdf->AddPage();

		

$bloque1 = <<<EOF

	<table>
		
		<tr>

		<td style="width:46px;"><img src="images/logo_gym.png"></td>

		<td style="background-color:white; width:200px">
			
			<div style="font-size:13px; text-align:right; line-height:15px;">

				<br>
				    $nombre
				

			</div>

		</td>

		<td style="font-size:12.5px; background-color:white; width:110px; text-align:rigth; color:red"><br><br>No. Recibo: $valor</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


$bloque2 = <<<EOF

	<table>
		
		<tr>

			<td style="background-color:white; width:370px">

				<div style="font-size:8.5px; text-align:center; line-height:15px;">
					
					<br>
					Teléfono: 2275-1354
					
					<br>
					$direccion
					<br>

					$correo

				</div>
				
			</td>

			<td style="color:#333; background-color:white; height:80px; width:370px; text-align:center"></td>


		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');


//--------------------------------------------------------------
// // ---------------------------------------------------------
$bloque3 = <<<EOF
	<table>
		<tr>
		
			<td style="background-color:white; border-bottom: 1px solid black; width:370px;">
			
			</td>
			
		</tr>

</table>
EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');



// -------------------------------------------------------------
$bloque4 = <<<EOF

<table style="font-size:10px; padding:15px 5px;">

	<tr>
		
		<td style="font-size:11.5px; background-color:white; width:158px">

			
			<strong> Nombre Cliente: </strong> 
			<br>
			 $clientes[nombre] $clientes[apellidos]

		</td>

		<td style="font-size:11.5px; background-color:white; width:125px;">
		
			<strong> Fecha Emisión: </strong>
			<br>
			 $fechaHoy

		</td>

		<td style="font-size:11.5px; background-color:white; width:100px;">
		
			<strong> Fecha Pago: </strong>
			<br>
			 $clientes[fecha_de_pago]

		</td>


	</tr>

</table>

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

// // ---------------------------------------------------------
$bloque5 = <<<EOF
<table>
	<tr>
	
		<td style="background-color:white; border-top: 2.8px solid #343434; width:370px;"></td>
		
	</tr>

</table>
EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');




// ---------------------------------------------------------

$bloque6 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">

	<tr>
		
		<td style="font-size:11.5px; text-align:left; background-color:white; width:250px">

			<strong> Descripción:</strong>
			<br>
			 Pago de matricula
			<br>
			 Valor de descuento
			<br>
			 Pago de inscripcion

		</td>

		<td style="font-size:11.5px; background-color:white; width:120px; text-align:right">
		
			<strong></strong>
			<br>
			  $pago_matricula
			<br>
			 $pago_descuento
			<br>
			 $pago_inscripcion 

		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, ''); 
		

//--------------------------------------------------------------------------------

$bloque7 = <<<EOF

<table style="font-size:10px; padding:1px 10px;">

	<tr>
		
		<td style="font-size:11.5px; text-align:left; background-color:white; width:310px">
			<strong> Total:</strong>
		</td>

		<td style="font-size:11.5px; background-color:white; border-top: 2.8px solid #343434; width:60px; text-align:right">

			$clientes[pago_total] 


		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque7, false, false, false, false, ''); 
		



		## 07/12/2020
		/* Limpiamos la salida del búfer y lo desactivamos */
		ob_end_clean();
		/* Finalmente generamos el PDF */
		## FIN 07/12/2020
		$pdf->lastPage();

		$pdf->Output('recibo-pdf.pdf', 'I');

		}else{

			echo "No hay datos, algo salió mal";
		}

	}
	
	
	
	
}

$factura = new imprimirReciboPagoCliente();
$factura->codigo = $_GET["codigo"];
$factura->traerImpresionFactura();


    
	


?>