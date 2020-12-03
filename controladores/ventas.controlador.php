<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ControladorVentas {
    /*=============================================
	MOSTRAR LA VENTA
	=============================================*/
    static public function ctrMostrarVentas($item, $valor){
    
        $tabla = "tbl_venta";
        $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
        return $respuesta;   
    }

    /*=============================================
	CREAR VENTA
    =============================================*/
    static public function ctrCrearVenta(){
    
		// echo '<pre>';
		// var_dump($_POST);
		// echo '</pre>';
		// return;

        if(isset($_POST["nuevaVenta"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK 
			Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

            $listaProductos = json_decode($_POST["listaProductos"], true);
            // var_dump($listaProductos);
  
            $totalProductosComprados = array();

			foreach($listaProductos as $key => $value) {
				// 	echo $value["id"];
				// 	return;

			   array_push($totalProductosComprados, $value["cantidad"]);

			   $item = "id_inventario";
			   $valor = $value["id"];
				
			    $tablaProductos = "tbl_inventario"; 
				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);
                // var_dump($traerProducto["ventas"]);

				$item1 = "ventas";
				$valor1 = $value["cantidad"] + $traerProducto["ventas"];
				$item2 = $item;
			    $valor2 = $valor;

                $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor1, $item2, $valor2);               

				$item1 = "stock";
				$valor1 = $value["stock"];
				$item2 = $item;
			    $valor2 = $valor;


				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor1, $item2, $valor2);

            }
			
            $tabla1 = "tbl_personas";
            $tabla2 = "tbl_clientes";
			$item = "id_cliente";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);
			// var_dump($traerCliente); 
			// // return; 
			// echo $valor;
			// return;

			$item1 = "compras";
			$valor1 = 2 + $traerCliente["compras"];
			// echo $valor1;
			// return;

			$item2 = "id_cliente";
			$valor2 = $valor;
			$comprasCliente = ModeloClientes::mdlActualizarCliente($tabla2, $item1, $valor1, $item2, $valor2);
			
			// var_dump($comprasCliente); 
			// return; 
			// echo $valor;
			// return;

			$item1 = "ultima_compra";

			date_default_timezone_set('America/Tegucigalpa');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1 = $fecha.' '.$hora;

			$item2 = "id_cliente";
			$valor2 = $valor;

            $fechaCliente = ModeloClientes::mdlActualizarCliente($tabla2, $item1, $valor1, $item2, $valor2);

            /*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "tbl_venta";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "numero_factura"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"]);
			
			// echo '<pre>';
			// var_dump($datos);
			// echo '</pre>';
			// return;			   

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

			// var_dump($respuesta);
			// return;


			if ($respuesta == true){

				
				$descripcionEvento = "Nueva venta ";
				$accion = "Nueva";
                $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 5,$accion, $descripcionEvento);

				if($_POST['idPersona'] != ""){

					$tabla1 = "tbl_personas";
					$tabla2 = "tbl_clientes";
					$item = "id_personas";
					$valor = $_POST["idPersona"];
	
					$traerCliente = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);
					// echo($valor);
					// var_dump($traerCliente);
					// return;
	
					$correoDestinatario = $traerCliente['correo'];
					$nombreDestinatario = $traerCliente['nombre'] .' '. $traerCliente['apellidos'];
					$numeroFactura= $_POST["nuevaVenta"];
					$impuesto= $_POST["nuevaPrecioImpuesto"];
					$neto= $_POST["nuevoPrecioNeto"];
					$total= $_POST["totalVenta"];
					$asunto = 'RECIBO DE PAGO, GIMNASIO LA ROCA.';
					$require = false;
	

					// $template = file_get_contents('extensiones/plantillas/factura.php');
					// $template = str_replace("{{nombre}}", $nombreDestinatario, $template);
					// $template = str_replace("{{numero_factura}}", $_POST['nuevaVenta'], $template);
					// $template = str_replace("{{total}}", $_POST['totalVenta'], $template);
					// $template = str_replace("{{fecha}}", date('Y-m-d'), $template);

					// $decodificar_productos = json_decode($_POST["listaProductos"]);
					// var_dump($decodificar_productos);
					// return;
            
					// foreach ($decodificar_productos as $productos ) {
				
						// echo $productos->total;
						// // return;
						// $template = str_replace("{{descripcion_producto}}", $productos->descripcion, $template);
						// $template = str_replace("{{total_productos}}",$productos->total, $template);
					// }
					// $template = str_replace("{{neto}}", $_POST['nuevoPrecioNeto'], $template);
					// $template = str_replace("{{impuesto}}", $_POST['nuevoPrecioImpuesto'], $template);
					// $template = str_replace("{{total_final}}", $_POST['totalVenta'], $template);
					// $template = str_replace("{{anio}}", date('Y'), $template);
					// $template = str_replace("{{direccion_empresa}}", date('Y-m-d'), $template);

					$template = ' 
					<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		  <head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
			<meta name="x-apple-disable-message-reformatting" />
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="color-scheme" content="light dark" />
			<meta name="supported-color-schemes" content="light dark" />
			<title></title>
			<style type="text/css" rel="stylesheet" media="all">
			/* Base ------------------------------ */
			
			@import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");
			body {
			  width: 100% !important;
			  height: 100%;
			  margin: 0;
			  -webkit-text-size-adjust: none;
			}
			
			a {
			  color: #3869D4;
			}
			
			a img {
			  border: none;
			}
			
			td {
			  word-break: break-word;
			}
			
			.preheader {
			  display: none !important;
			  visibility: hidden;
			  mso-hide: all;
			  font-size: 1px;
			  line-height: 1px;
			  max-height: 0;
			  max-width: 0;
			  opacity: 0;
			  overflow: hidden;
			}
			/* Type ------------------------------ */
			
			body,
			td,
			th {
			  font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
			}
			
			h1 {
			  margin-top: 0;
			  color: #333333;
			  font-size: 22px;
			  font-weight: bold;
			  text-align: left;
			}
			
			h2 {
			  margin-top: 0;
			  color: #333333;
			  font-size: 16px;
			  font-weight: bold;
			  text-align: left;
			}
			
			h3 {
			  margin-top: 0;
			  color: #333333;
			  font-size: 14px;
			  font-weight: bold;
			  text-align: left;
			}
			
			td,
			th {
			  font-size: 16px;
			}
			
			p,
			ul,
			ol,
			blockquote {
			  margin: .4em 0 1.1875em;
			  font-size: 16px;
			  line-height: 1.625;
			}
			
			p.sub {
			  font-size: 13px;
			}
			/* Utilities ------------------------------ */
			
			.align-right {
			  text-align: right;
			}
			
			.align-left {
			  text-align: left;
			}
			
			.align-center {
			  text-align: center;
			}
			/* Buttons ------------------------------ */
			
			.button {
			  background-color: #3869D4;
			  border-top: 10px solid #3869D4;
			  border-right: 18px solid #3869D4;
			  border-bottom: 10px solid #3869D4;
			  border-left: 18px solid #3869D4;
			  display: inline-block;
			  color: #FFF;
			  text-decoration: none;
			  border-radius: 3px;
			  box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
			  -webkit-text-size-adjust: none;
			  box-sizing: border-box;
			}
			
			.button--green {
			  background-color: #22BC66;
			  border-top: 10px solid #22BC66;
			  border-right: 18px solid #22BC66;
			  border-bottom: 10px solid #22BC66;
			  border-left: 18px solid #22BC66;
			}
			
			.button--red {
			  background-color: #FF6136;
			  border-top: 10px solid #FF6136;
			  border-right: 18px solid #FF6136;
			  border-bottom: 10px solid #FF6136;
			  border-left: 18px solid #FF6136;
			}
			
			@media only screen and (max-width: 500px) {
			  .button {
				width: 100% !important;
				text-align: center !important;
			  }
			}
			/* Attribute list ------------------------------ */
			
			.attributes {
			  margin: 0 0 21px;
			}
			
			.attributes_content {
			  background-color: #F4F4F7;
			  padding: 16px;
			}
			
			.attributes_item {
			  padding: 0;
			}
			/* Related Items ------------------------------ */
			
			.related {
			  width: 100%;
			  margin: 0;
			  padding: 25px 0 0 0;
			  -premailer-width: 100%;
			  -premailer-cellpadding: 0;
			  -premailer-cellspacing: 0;
			}
			
			.related_item {
			  padding: 10px 0;
			  color: #CBCCCF;
			  font-size: 15px;
			  line-height: 18px;
			}
			
			.related_item-title {
			  display: block;
			  margin: .5em 0 0;
			}
			
			.related_item-thumb {
			  display: block;
			  padding-bottom: 10px;
			}
			
			.related_heading {
			  border-top: 1px solid #CBCCCF;
			  text-align: center;
			  padding: 25px 0 10px;
			}
			/* Discount Code ------------------------------ */
			
			.discount {
			  width: 100%;
			  margin: 0;
			  padding: 24px;
			  -premailer-width: 100%;
			  -premailer-cellpadding: 0;
			  -premailer-cellspacing: 0;
			  background-color: #F4F4F7;
			  border: 2px dashed #CBCCCF;
			}
			
			.discount_heading {
			  text-align: center;
			}
			
			.discount_body {
			  text-align: center;
			  font-size: 15px;
			}
			/* Social Icons ------------------------------ */
			
			.social {
			  width: auto;
			}
			
			.social td {
			  padding: 0;
			  width: auto;
			}
			
			.social_icon {
			  height: 20px;
			  margin: 0 8px 10px 8px;
			  padding: 0;
			}
			/* Data table ------------------------------ */
			
			.purchase {
			  width: 100%;
			  margin: 0;
			  padding: 35px 0;
			  -premailer-width: 100%;
			  -premailer-cellpadding: 0;
			  -premailer-cellspacing: 0;
			}
			
			.purchase_content {
			  width: 100%;
			  margin: 0;
			  padding: 25px 0 0 0;
			  -premailer-width: 100%;
			  -premailer-cellpadding: 0;
			  -premailer-cellspacing: 0;
			}
			
			.purchase_item {
			  padding: 10px 0;
			  color: #51545E;
			  font-size: 15px;
			  line-height: 18px;
			}
			
			.purchase_heading {
			  padding-bottom: 8px;
			  border-bottom: 1px solid #EAEAEC;
			}
			
			.purchase_heading p {
			  margin: 0;
			  color: #85878E;
			  font-size: 12px;
			}
			
			.purchase_footer {
			  padding-top: 15px;
			  border-top: 1px solid #EAEAEC;
			}
			
			.purchase_total {
			  margin: 0;
			  text-align: right;
			  font-weight: bold;
			  color: #333333;
			}
			
			.purchase_total--label {
			  padding: 0 15px 0 0;
			}
			
			body {
			  background-color: #F4F4F7;
			  color: #51545E;
			}
			
			p {
			  color: #51545E;
			}
			
			p.sub {
			  color: #6B6E76;
			}
			
			.email-wrapper {
			  width: 100%;
			  margin: 0;
			  padding: 0;
			  -premailer-width: 100%;
			  -premailer-cellpadding: 0;
			  -premailer-cellspacing: 0;
			  background-color: #F4F4F7;
			}
			
			.email-content {
			  width: 100%;
			  margin: 0;
			  padding: 0;
			  -premailer-width: 100%;
			  -premailer-cellpadding: 0;
			  -premailer-cellspacing: 0;
			}
			/* Masthead ----------------------- */
			
			.email-masthead {
			  padding: 25px 0;
			  text-align: center;
			}
			
			.email-masthead_logo {
			  width: 94px;
			}
			
			.email-masthead_name {
			  font-size: 16px;
			  font-weight: bold;
			  color: #A8AAAF;
			  text-decoration: none;
			  text-shadow: 0 1px 0 white;
			}
			/* Body ------------------------------ */
			
			.email-body {
			  width: 100%;
			  margin: 0;
			  padding: 0;
			  -premailer-width: 100%;
			  -premailer-cellpadding: 0;
			  -premailer-cellspacing: 0;
			  background-color: #FFFFFF;
			}
			
			.email-body_inner {
			  width: 570px;
			  margin: 0 auto;
			  padding: 0;
			  -premailer-width: 570px;
			  -premailer-cellpadding: 0;
			  -premailer-cellspacing: 0;
			  background-color: #FFFFFF;
			}
			
			.email-footer {
			  width: 570px;
			  margin: 0 auto;
			  padding: 0;
			  -premailer-width: 570px;
			  -premailer-cellpadding: 0;
			  -premailer-cellspacing: 0;
			  text-align: center;
			}
			
			.email-footer p {
			  color: #6B6E76;
			}
			
			.body-action {
			  width: 100%;
			  margin: 30px auto;
			  padding: 0;
			  -premailer-width: 100%;
			  -premailer-cellpadding: 0;
			  -premailer-cellspacing: 0;
			  text-align: center;
			}
			
			.body-sub {
			  margin-top: 25px;
			  padding-top: 25px;
			  border-top: 1px solid #EAEAEC;
			}
			
			.content-cell {
			  padding: 35px;
			}
			/*Media Queries ------------------------------ */
			
			@media only screen and (max-width: 600px) {
			  .email-body_inner,
			  .email-footer {
				width: 100% !important;
			  }
			}
			
			@media (prefers-color-scheme: dark) {
			  body,
			  .email-body,
			  .email-body_inner,
			  .email-content,
			  .email-wrapper,
			  .email-masthead,
			  .email-footer {
				background-color: #333333 !important;
				color: #FFF !important;
			  }
			  p,
			  ul,
			  ol,
			  blockquote,
			  h1,
			  h2,
			  h3,
			  span,
			  .purchase_item {
				color: #FFF !important;
			  }
			  .attributes_content,
			  .discount {
				background-color: #222 !important;
			  }
			  .email-masthead_name {
				text-shadow: none !important;
			  }
			}
			
			:root {
			  color-scheme: light dark;
			  supported-color-schemes: light dark;
			}
			</style>
			<!--[if mso]>
			<style type="text/css">
			  .f-fallback  {
				font-family: Arial, sans-serif;
			  }
			</style>
		  <![endif]-->
		  </head>
		  <body>
			<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
			  <tr>
				<td align="center">
				  <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
					<!-- Email Body -->
					<tr>
					  <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
						<table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
						  <!-- Body content -->
						  <tr>
							<td class="content-cell">
							  <div class="f-fallback">
								<h1>Hola '.$nombreDestinatario.',</h1>
								
								<table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
								  <tr>
									<td class="attributes_content">
									  <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
										<tr>
										  <td class="attributes_item">
											<span class="f-fallback">
					 						 <strong>Monto:</strong> L.'.$total.'
											</span>
										  </td>
										</tr>
										<tr>
										  <td class="attributes_item">
											<span class="f-fallback">
					 					 <strong>Fecha:</strong> '.date("Y-m-d").'
											</span>
										  </td>
										</tr>
									  </table>
									</td>
								  </tr>
								</table>
								<!-- Action -->
								<table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
								  <tr>
									<td align="center">
									  <!-- Border based button
				   https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design -->
									  <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
										<tr>
										  <td align="center">
											<h2><a href="{{action_url}}" class="f-fallback button button--green" target="_blank">Recibo de Pago</a></h2>
										  </td>
										</tr>
									  </table>
									</td>
								  </tr>
								</table>
								<table class="purchase" width="100%" cellpadding="0" cellspacing="0">
								  <tr>
									<td>
									  <h3>N° Factura: '.$numeroFactura.'</h3>
									</td>
									<td>
									  <h3 class="align-right">Fecha de envío: '.date("Y-m-d H:i:s").'</h3>
									</td>
								  </tr>
								  <tr>
									<td colspan="2">
									  <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
										<tr>
										  <th class="purchase_heading" align="left">
											<p class="f-fallback">Producto</p>
										  </th>
										  <th class="purchase_heading" align="right">
											<p class="f-fallback">Costo</p>
										  </th>
										</tr>
										';
		
										$decodificar_productos = json_decode($_POST["listaProductos"]);
					
										foreach ($decodificar_productos as $productos ) {
										   $template= $template.'<tr>
										  <td width="100%" class="purchase_item"><span class="f-fallback">'.$productos->descripcion.'</span></td>
										  <td class="align-right" width="20%" class="purchase_item"><span class="f-fallback">L.'.$productos->total.'</span></td>
										</tr>';
		
										}
		
		
		
									   $template = $template.'
									   <tr><td><hr></td></tr>
										<tr>
										  <td width="20%" class="purchase_footer" valign="middle">
											<p class="f-fallback purchase_total purchase_total--label">SubTotal</p>
										  </td>
										  <td width="20%" class="purchase_footer" valign="middle">
											<p class="f-fallback purchase_total">L.'.$neto.'</p>
										  </td>
										</tr>
										<tr>
										  <td width="80%" class="purchase_footer" valign="middle">
											<p class="f-fallback purchase_total purchase_total--label">ISV</p>
										  </td>
										  <td width="20%" class="purchase_footer" valign="middle">
											<p class="f-fallback purchase_total">L.'.$impuesto.'</p>
										  </td>
										</tr>
										<tr>
										  <td width="80%" class="purchase_footer" valign="middle">
											<strong><p class="f-fallback purchase_total purchase_total--label">Total</p></strong>
										  </td>
										  <td width="20%" class="purchase_footer" valign="middle">
											<strong><p class="f-fallback purchase_total">L.'.$total.'</p></strong>
										  </td>
										</tr>
									  </table>
									</td>
								  </tr>
								</table>
							
								<p>Saludos,
								  <br>Del Equipo Gimnasio La Roca.</p>
								<!-- Sub copy -->
								<table class="body-sub" role="presentation">
								  <tr>
									<td>
									  
									</td>
								  </tr>
								</table>
							  </div>
							</td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr>
					  <td>
						<table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
						  <tr>
							<td class="content-cell" align="center">
							  <p class="f-fallback sub align-center">&copy; '.date("Y").' DERECHOS RESERVADOS</p>
							  <p class="f-fallback sub align-center">
								GIMNASIO LA ROCA
								<br>HONDURAS
							  </p>
							</td>
						  </tr>
						</table>
					  </td>
					</tr>
				  </table>
				</td>
			  </tr>
			</table>
		  </body>
		</html> 
					';
					// echo $correoDestinatario;
					// echo $nombreDestinatario;
					// return;
				
	
	
					$respuestaCorreo = ControladorUsuarios::ctrGenerarCorreo($correoDestinatario, $nombreDestinatario, $asunto, $template, $require);



					// var_dump($respuestaCorreo);
					// return;
					if($respuestaCorreo){
				echo'<script>

				localStorage.removeItem("rango");

				Swal.fire({
					  icon: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "administrar-venta";

								}
							})

				</script>';
					}
				
				} else {

					
					echo'<script>
					
					localStorage.removeItem("rango");
					
					Swal.fire({
						icon: "success",
						title: "La venta ha sido guardada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then((result) => {
						if (result.value) {
							
							window.location = "administrar-venta";
							
						}
					})
					
					</script>';
				}
				
			}else{
				
				echo'<script>

				Swal.fire({
					  icon: "error",
					  title: "Error",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "administrar-venta";

								}
							})

				</script>';

			}

        }
    
	}
	

	/*=============================================
			SUMA TOTAL VENTAS
    =============================================*/
	static public function ctrSumaTotalVentas(){

		$tabla = 'tbl_venta';
		
		$respuesta = ModeloVentas::mdlSumarTotalVentas($tabla);
		
		return $respuesta;
	}

	/*=============================================
			RANGO DE FECHAS
    =============================================*/
	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = 'tbl_venta';
		
		$respuesta = ModeloVentas::mdlRangoFechaVentas($tabla, $fechaInicial, $fechaFinal);
		
		return $respuesta;
	}


	  /*=============================================
		====================EDITAR VENTA
    =============================================*/
    static public function ctrEditarVenta(){
    
		// echo '<pre>';
		// var_dump($_POST);
		// echo '</pre>';
		// return;

        if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "tbl_venta";
			$item = "numero_factura";
			$valor = $_POST["editarVenta"];
			 
			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
			// echo '<pre>';
			// var_dump($traerVenta);
			// echo '</pre>';
			// return;

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			$productos =  json_decode($traerVenta["productos"], true);
			$totalProductosComprados = array();
			// echo '<pre>';
			// var_dump($productos);
			// echo '</pre>';
			// return;
			
			if($cambioProducto){

				$productos =  json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();
				foreach($productos as $key => $value) {
					// echo '<pre>';
					// var_dump($value);
					// echo '</pre>';
					// return;
			
					array_push($totalProductosComprados, $value["cantidad"]);

					$item = "id_inventario";
					$valor = $value["id"];
					
					$tablaProductos = "tbl_inventario"; 
					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);
					// echo '<pre>';
					// var_dump($traerProducto);
					// echo '</pre>';
					// return;

					$item1A = "stock";
					$valor1A = $value["cantidad"]+ $traerProducto["stock"];
					$item2 = $item;
					$valor2 = $valor;

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1A, $valor1A, $item2, $valor2);

					$item1B = "venta";
					$valor1B = $traerProducto["venta"] - $value["cantidad"];
					$item2 = $item;
					$valor2 = $valor;

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1B, $valor1B, $item2, $valor2);    

					// echo '<pre>';
					// var_dump($nuevoStock);
					// var_dump($nuevasVentas);
					// echo '</pre>';
					// return;
					

				}
				// return; 

				$tabla1 = "tbl_personas";
				$tabla2 = "tbl_clientes";
				$item = "id_cliente";
				$valor = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);

				$item1 = "compras";
				$valor1 = $traerCliente["compras"] - array_sum($totalProductosComprados);
				// echo $valor1;
				// return;

				$item2 = "id_cliente";
				$valor2 = $valor;
				$comprasCliente = ModeloClientes::mdlActualizarCliente($tabla2, $item1, $valor1, $item2, $valor2);

				// var_dump($comprasCliente);
				// return;

				

			// 	/*=============================================
	 		// 	ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK 
	 		// 	Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
	 		// 	=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);
				// var_dump($listaProductos);
	
				$totalProductosComprados_2 = array();

				foreach($listaProductos_2 as $key => $value) {
					// 	echo $value["id"];
					// 	return;

					array_push($totalProductosComprados_2, $value["cantidad"]);

					$item_2 = "id_inventario";
					$valor_2 = $value["id"];
					
					$tablaProductos_2 = "tbl_inventario"; 
					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2);
					// var_dump($traerProducto_2["venta"]);

					$item1_2 = "venta";
					$valor1_2 = $traerProducto["venta"]+ $value["cantidad"];
					$item2_2 = $item_2;
					$valor2_2 = $valor_2;

					// echo $value["cantidad"];
					// echo $valor1_2;

					// return;

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1_2, $valor1_2, $item2_2, $valor2_2);               

					$item1_2 = "stock";
					$valor1_2 = $traerProducto_2["stock"] - $value["cantidad"];
					$item2_2 = $item_2;
					$valor2_2 = $valor_2;


					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1_2, $valor1_2, $item2_2, $valor2_2);

					// echo '<pre>';
					// var_dump($nuevoStock_2);
					// var_dump($nuevasVentas_2);
					// echo '</pre>';
					// return;

				}
				// return;
				
				$tabla1_2 = "tbl_personas";
				$tabla2_2 = "tbl_clientes";
				$item_2 = "id_cliente";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tabla1_2, $tabla2_2, $item_2, $valor_2);
				// var_dump($traerCliente); 
				// return; 
				// echo $valor;
				// return;

				$item1_2 = "compras";
				$valor1_2 =array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];
				// echo $valor1;
				// return;

				$item2_2 = "id_cliente";
				$valor2_2 = $valor_2;
				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tabla2_2, $item1_2, $valor1_2, $item2_2, $valor2_2);
				
				// var_dump($comprasCliente); 
				// return; 
				// echo $valor;
				// return;

				$item1_2 = "ultima_compra";

				date_default_timezone_set('America/Tegucigalpa');

				$fecha_2 = date('Y-m-d');
				$hora_2 = date('H:i:s');
				$valor1_2 = $fecha_2.' '.$hora_2;

				$item2_2 = "id_cliente";
				$valor2_2 = $valor_2;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tabla2_2, $item1_2, $valor1_2, $item2_2, $valor2_2);

				// echo '<pre>';
				// 	var_dump($nuevoStock);
				// 	var_dump($nuevasVentas);
				// 	echo '</pre>';
				// 	return;
			
			}
             /*=============================================
	 		GUARDAR CAMBIOS DE LA COMPRA
	 		=============================================*/	

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "numero_factura"=>$_POST["editarVenta"],
						   "productos"=>$listaProductos,
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"]);
			
			// echo '<pre>';
			// var_dump($datos);
			// echo '</pre>';
			// return;		
			
			$tabla="tbl_venta";

			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == true ){
				
				$descripcionEvento = "Actualizo una venta";
				$accion = "Actualizo";

				$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 5,$accion, $descripcionEvento);

			  
		   

				echo'<script>

				localStorage.removeItem("rango");

				Swal.fire({
					  icon: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "administrar-venta";

								}
							})

				</script>';

			}

		}
	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){
		if(isset($_GET["idVenta"])){
			$tabla = "tbl_venta";
			$item = "id_venta";
			$valor = $_GET["idVenta"];
				
			$traerVenta =ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
			// var_dump($traerVenta);
			// return;

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "tbl_clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);
			
			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){
					// var_dump($value["fecha"]);
					
					array_push($guardarFechas, $value["fecha"]);
				}

				// var_dump($guardarFechas);

				if (count($guardarFechas) > 1){
					if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

						$item1 = "ultima_compra";
						$valor1 = $guardarFechas[count($guardarFechas)-2];
						$item2 = "id_cliente";

						$valor2 = $traerVenta["id_cliente"];

						$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1, $valor1, $item2, $valor2);

					
					}
					else{

						$item1 = "ultima_compra";
						$item2 = "id_cliente";
						$valor1 = $guardarFechas[count($guardarFechas)-1];
						$valorIdCliente = $traerVenta["id_cliente"];

						$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1, $valor1, $item2, $valorIdCliente);

					}

				}else{

					$item1 = "ultima_compra";
					$valor1 = "0000-00-00 00:00:00";
					$item2 = "id_cliente";
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1, $valor1, $item2, $valorIdCliente);
					// var_dump($comprasCliente);
				}
				

			}

			/*=============================================
	 		FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
	   		=============================================*/
			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach($productos as $key => $value) {
				array_push($totalProductosComprados, $value["cantidad"]);

				$item = "id_inventario";
				$valor = $value["id"];
				
				$tablaProductos = "tbl_inventario"; 
				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

				$item1 = "devolucion";
				// $item1 = "devolucion";
				$valor1 = $value["cantidad"] + $traerProducto["stock"];
				// $valor1 = $value"cantidad";  editar, sera agregar la cant a campo de devolucion.
				$item2 = $item;
				$valor2 = $valor;
				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor1, $item2, $valor2);

				$item1 = "venta";
				$valor1 = $traerProducto["venta"] - $value["cantidad"];
				$item2 = $item;
				$valor2 = $valor;

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1, $valor1, $item2, $valor2);    

			}
			
			$tabla1 = "tbl_personas";
			$tabla2 = "tbl_clientes";
			$item = "id_cliente";
			$valor = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);

			$item1 = "compras";
			$valor1 = $traerCliente["compras"] - array_sum($totalProductosComprados);
			// // echo $valor1;
			// // return;

			$item2 = "id_cliente";
			$valor2 = $valor;
			$comprasCliente = ModeloClientes::mdlActualizarCliente($tabla2, $item1, $valor1, $item2, $valor2);

	// 		/*=============================================
	//   			ELIMINAR VENTA
	//  		=============================================*/
			$idVenta= $_GET["idVenta"];
			// echo $idVenta;
			// return;
			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $idVenta);
			// var_dump($respuesta);
		

			if($respuesta == true){

				echo'<script>

				Swal.fire({
					  icons: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "administrar-venta";

								}
							})

				</script>';

			}		


		}

	}

}
