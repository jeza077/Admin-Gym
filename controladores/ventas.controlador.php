<?php

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

			// $item1 = "ultima_compra";

			// date_default_timezone_set('America/Tegucigalpa');

			// $fecha = date('Y-m-d');
			// $hora = date('H:i:s');
			// $valor1 = $fecha.' '.$hora;

			// $item2 = "id_cliente";
			// $valor2 = $valor;

            // $fechaCliente = ModeloClientes::mdlActualizarCliente($tabla2, $item1, $valor1, $item2, $valor2);

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

}