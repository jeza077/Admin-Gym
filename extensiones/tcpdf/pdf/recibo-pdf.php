<?php

require_once("../../../controladores/usuarios.controlador.php");
require_once('../../../controladores/ventas.controlador.php');
require_once('../../../controladores/clientes.controlador.php');
require_once('../../../controladores/productos.controlador.php');
require_once "../../../modelos/productos.modelo.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../modelos/ventas.modelo.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once('../examples/tcpdf_include.php');

// echo $_GET["codigo"];


class imprimirFactura{

	

	public $codigo;

	
	public function traerImpresionFactura(){

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

		$itemVenta = "numero_factura";
		$valorVenta = $this->codigo;

		$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);
		// var_dump($respuestaVenta);-----------------------------------------------------------


		$decodificar_productos = json_decode($respuestaVenta["productos"]);


		$fecha = substr($respuestaVenta["fecha"],0,-8);
		$productos = json_decode($respuestaVenta["productos"], true);
		$neto = number_format($respuestaVenta["neto"],2);
		$impuesto = number_format($respuestaVenta["impuesto"],2);
		$total = number_format($respuestaVenta["total"],2);


		//TRAEMOS LA INFORMACIÓN DEL CLIENTE
		$tabla = "tbl_clientes";
		$itemCliente = "id_cliente";
		$valorCliente = $respuestaVenta["id_cliente"];


		$respuestaCliente = ControladorClientes::ctrMostrarClientesSinPago($tabla, $itemCliente, $valorCliente);
		if(!empty($respuestaCliente) and !empty($respuestaVenta)){

			
			
		## 07/12/2020

		ob_start();
		error_reporting(E_ALL & ~E_NOTICE);
		ini_set('display_errors', 0);
		ini_set('log_errors', 1);
		set_time_limit(0);


		## FIN 07/12/2020



		// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Poleth Solorzano');
		$pdf->SetTitle('Recibo de Venta');
		$pdf->SetSubject('');
		$pdf->SetKeywords('');

		$pdf->startPageGroup();

		$pdf->AddPage();

		
$bloque1 = <<<EOF

	<table>
		
		<tr>

		<td style="width:150px"><img src="images/logo_gym.png"></td>

		<td style="background-color:white; width:140px">
			
			<div style="font-size:12.5px; text-align:right; line-height:15px;">

				<br>
				$nombre
				

			</div>

		</td>

		<td style="background-color:white; width:140px">

			<div style="font-size:10.5px; text-align:right; line-height:15px;">
				
				<br>
				Teléfono: 2275-1354
				
				<br>
				$direccion
				$correo

			</div>
			
		</td>


			<td style="font-size:12.5px; background-color:white; width:110px; text-align:rigth; color:red"><br><br>Recibo N.<br>$valorVenta</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">

	<tr>
		
		<td style="font-size:11.5px; border: 1px solid #666; background-color:white; width:390px">

			Nombre del Cliente: $respuestaCliente[nombre] $respuestaCliente[apellidos]

		</td>

		<td style="font-size:11.5px; border: 1px solid #666; background-color:white; width:150px; text-align:right">
		
			Fecha: $fecha

		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------
$bloque = '
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
		<td style="font-size:10.5px; border: 1px solid #666; background-color:white; width:260px; text-align:center">Descripcion del Producto</td>
		<td style="font-size:10.5px; border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
		<td style="font-size:10.5px; border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
		<td style="font-size:10.5px; border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>
		</tr>';


foreach ($decodificar_productos as $productos ) {
	$bloque = $bloque.'<tr>
		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">'.$productos->descripcion.'</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">'.$productos->cantidad.'</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">'.$productos->precio.'</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">'.$productos->total.'</td>
		</tr> ';
	}

$bloque = $bloque . "
</table> 
";

$pdf->writeHTML($bloque, false, false, false, false, '');




// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Neto:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $neto
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>


	</table>

EOF;

		$pdf->writeHTML($bloque5, false, false, false, false, ''); 
		


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

$factura = new imprimirFactura();
$factura->codigo = $_GET["codigo"];
$factura->traerImpresionFactura();


    
	


?>