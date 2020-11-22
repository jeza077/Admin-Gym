<?php

class ControladorInventario
{
        static public function ctrMostrarInventario($tabla, $item, $valor,$order)
        {
                $tabla1 = $tabla;
                $tabla2 = "tbl_tipo_producto";
                $respuesta = ModeloInventario::mdlMostrarInventario($tabla1, $tabla2, $item, $valor,$order);
                return $respuesta;
        }

        static public function ctrMostrarTipoProducto($tabla, $item, $valor)

        {
                $respuesta = ModeloInventario::mdlMostrarTipoProducto($tabla, $item, $valor);
                return $respuesta;
        }


        /*=============================================
                CREAR STOCK
        =============================================*/

        static public function ctrCrearStock($tipostock, $pantalla){
            // var_dump($_POST);
            // return;
            if(isset($_POST["nuevoNombreProducto"])){
    
                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreProducto"])){


                    /*=============================================
							VALIDAR IMAGEN
					=============================================*/

					$ruta = "";

					if(isset($_FILES["nuevaFotoProducto"]["tmp_name"])){

						list($ancho, $alto) = getimagesize($_FILES["nuevaFotoProducto"]["tmp_name"]);

						$nuevoAncho = 500;
						$nuevoAlto = 500;

						/*==============================================================
						CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
						===============================================================*/

						$directorio = "vistas/img/productos/".$_POST["nuevoNombreProducto"];

						mkdir($directorio, 0755); 

						/*=====================================================================
						DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
						======================================================================*/

						if($_FILES["nuevaFotoProducto"]["type"] == "image/jpeg"){

							/*=============================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
							=============================================*/

							$aleatorio = mt_rand(100,999);

							$ruta = "vistas/img/productos/".$_POST["nuevoNombreProducto"]."/".$aleatorio.".jpg";

							$origen = imagecreatefromjpeg($_FILES["nuevaFotoProducto"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagejpeg($destino, $ruta);

						}

						if($_FILES["nuevaFotoProducto"]["type"] == "image/png"){

							/*=============================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
							=============================================*/

							$aleatorio = mt_rand(100,999);

							$ruta = "vistas/img/productos/".$_POST["nuevoNombreProducto"]."/".$aleatorio.".png";

							$origen = imagecreatefrompng($_FILES["nuevaFotoProducto"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagepng($destino, $ruta);

						}

					}



                    $tabla = "tbl_inventario";
                    if($tipostock == 'producto'){
                        $datos = array("nombre_producto" => $_POST["nuevoNombreProducto"],
                        "codigo" => $_POST["nuevoCodigo"],
                        "id_tipo_producto" => $_POST["nuevoTipoProducto"],
                        "stock" => $_POST["nuevoStock"],
                        "precio" => $_POST["nuevoPrecio"],
                        "foto" => $ruta,
                        "producto_minimo" => $_POST["nuevoProductoMinimo"],
                        "producto_maximo" => $_POST["nuevoProductoMaximo"]);

                        $crearInventario = ModeloInventario::mdlCrearStock($tabla, $datos);

                                if($crearInventario == true){
    
                                    echo '<script>
                                            Swal.fire({
                                                title: "Tus datos han sido guardados correctamente!",
                                                icon: "success",
                                                heightAuto: false,
                                                allowOutsideClick: false
                                            }).then((result)=>{
                                                if(result.value){
                                                    window.location = "'.$pantalla.'";
                                                }
                                            });                       
                                        </script>';
                                }
                                else {
                                    echo '<script>
                                            Swal.fire({
                                                title: "No se pudo guardar tus datos. Intenta de nuevo!",
                                                icon: "error",
                                                heightAuto: false,
                                                allowOutsideClick: false,
                                                timer: 4000
                                            });					
                                        </script>';
                                }
    
                    } 
              
                } 
            }
        }







        
}