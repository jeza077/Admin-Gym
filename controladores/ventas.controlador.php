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

			foreach ($listaProductos as $key => $value) {
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
            
            // $tablaClientes = "tbl_clientes";

			// $item = "id";
			// $valor = $_POST["seleccionarCliente"];

			// $traerCliente = ModeloClientes::mdlMostrar($tablaClientes, $item, $valor);

			// $item1a = "compras";
			// $valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

			// $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			// $item1b = "ultima_compra";

			// date_default_timezone_set('America/Tegucigalpa');

			// $fecha = date('Y-m-d');
			// $hora = date('H:i:s');
			// $valor1b = $fecha.' '.$hora;

            // $fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

            /*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "tbl_venta";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
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


			if (!$respuesta){
				// echo'<script>

				// Swal.fire({
				// 	  icon: "error",
				// 	  title: "Error",
				// 	  showConfirmButton: true,
				// 	  confirmButtonText: "Cerrar"
				// 	  }).then((result) => {
				// 				if (result.value) {

				// 				window.location = "ventas";

				// 				}
				// 			})

				// </script>';

				echo $respuesta;

				
			}else{
				echo'<script>

				localStorage.removeItem("rango");

				Swal.fire({
					  icon: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';
				


				

			}

        }
    
    }

}