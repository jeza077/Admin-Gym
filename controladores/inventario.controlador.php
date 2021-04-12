<?php

class ControladorInventario{

    /*=============================================
    MOSTRAR INVENTARIO
    =============================================*/

    static public function ctrMostrarInventario($tabla, $item, $valor,$order){
            $tabla1 = $tabla;
            $tabla2 = "tbl_tipo_producto";
            $respuesta = ModeloInventario::mdlMostrarInventario($tabla1, $tabla2, $item, $valor,$order);
            return $respuesta;
    }

    /*=============================================
    MOSTRAR COMPRAS
    =============================================*/
    static public function ctrMostrarCompras($tabla, $item, $valor){
            $tabla1 = $tabla;
            $respuesta = ModeloInventario::mdlMostrarCompras($tabla1,$item, $valor);
            return $respuesta;
    }

    /*=============================================
    MOSTRAR TIPOS DE PRODUCTOS
    =============================================*/
    static public function ctrMostrarTipoProducto($tabla, $item, $valor){
            $respuesta = ModeloInventario::mdlMostrarTipoProducto($tabla, $item, $valor);
            return $respuesta;
    }

    /*=============================================
    MOSTRAR PRODUCTOS
    =============================================*/
    static public function ctrMostrarProducto($tabla, $item, $valor){
            $respuesta = ModeloInventario::mdlMostrarProducto($tabla, $item, $valor);
            return $respuesta;
    }

    /*=============================================
    MOSTRAR PROVEEDORES
    =============================================*/
    static public function ctrMostrarProveedores($tabla, $item, $valor){
            $respuesta = ModeloInventario::mdlMostrarProveedores($tabla, $item, $valor);
            return $respuesta;
    }




    /*=============================================
    CREAR PRODUCTOS
    =============================================*/

    static public function ctrCrearStock($tipostock, $pantalla){
        // var_dump($_POST);
        // echo $tipostock;
        // return;
        if(isset($_POST["nuevoNombreProducto"])){

            if(preg_match('/^[A-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreProducto"])){
    
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

                // echo $ruta;
                // return;
                $tabla = "tbl_inventario";

                if($tipostock == 'Productos'){
                    $datos = array("id_tipo_producto" => $_POST["nuevoTipoProducto"],
                    "codigo" => $_POST["nuevoCodigo"],
                    "nombre_producto" => $_POST["nuevoNombreProducto"],
                    // "stock" => $_POST["nuevoStock"],
                    "precio_venta" => $_POST["nuevoPrecio"],
                    // "precio_compra" => $_POST["nuevoPrecioCompra"],
                    // "proveedor" => $_POST["nuevoProveedor"],                        
                    "producto_minimo" => $_POST["nuevoProductoMinimo"],
                    "producto_maximo" => $_POST["nuevoProductoMaximo"],
                    "foto" => $ruta);

                    // var_dump($datos);
                    // return;

                    $crearInventario = ModeloInventario::mdlCrearStock($tabla, $datos);
                    // var_dump($datos);
                    // return;

                    if($crearInventario == true){
                        
                        $descripcionEvento = " Nuevo Producto";
                        $accion = "Nuevo";

                        $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 4,$accion, $descripcionEvento);

                        echo '<script>
                                Swal.fire({
                                    title: "Producto creado exitosamente!",
                                    icon: "success",
                                    heightAuto: false,
                                    allowOutsideClick: false
                                }).then((result)=>{
                                    if(result.value){
                                        window.location = "'.$pantalla.'";
                                    }
                                });                       
                            </script>';
                    } else {
                        echo '<script>
                                Swal.fire({
                                    title: "Opps, algo salio mal, intenta de nuevo!",
                                    icon: "error",
                                    heightAuto: false,
                                    allowOutsideClick: false,
                                    timer: 4000
                                });					
                            </script>';
                    }

                } 
            
            } 
            else {
                echo '<script>
                        Swal.fire({
                            title: "Llenar los datos correctamente. Intenta de nuevo!",
                            icon: "error",
                            heightAuto: false,
                            allowOutsideClick: false,
                            timer: 4000
                        });					
                    </script>';
            }
        }
    }



    /*=============================================
    CREAR BODEGA-EQUIPO
    =============================================*/

    static public function ctrCrearBodega($tipostock, $pantalla){
        // var_dump($_POST);
        // var_dump($_FILES);
        // // echo $tipostock;
        // return;
        if(isset($_POST["nuevoTipoProducto"])){

            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreProducto"])){

    
                /*=============================================
                        VALIDAR IMAGEN
                =============================================*/

                $ruta = "";

                if(isset($_FILES["nuevaFotoBodega"]["tmp_name"])){

                    list($ancho, $alto) = getimagesize($_FILES["nuevaFotoBodega"]["tmp_name"]);

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

                    if($_FILES["nuevaFotoBodega"]["type"] == "image/jpeg"){

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/img/productos/".$_POST["nuevoNombreProducto"]."/".$aleatorio.".jpg";

                        $origen = imagecreatefromjpeg($_FILES["nuevaFotoBodega"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }
                    

                    if($_FILES["nuevaFotoBodega"]["type"] == "image/png"){

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/img/productos/".$_POST["nuevoNombreProducto"]."/".$aleatorio.".png";

                        $origen = imagecreatefrompng($_FILES["nuevaFotoBodega"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);

                    }

                }

        

                $tabla = "tbl_inventario";
                if($tipostock == 'Bodega'){
                    $datos = array("id_tipo_producto" => $_POST["nuevoTipoProducto"],
                    "codigo" => $_POST["nuevoCodigo"],
                    "nombre_producto" => $_POST["nuevoNombreProducto"],
                    "stock" => $_POST["nuevoStock"],
                    // "precio_venta" => $_POST["nuevoPrecio"],
                    // "precio_compra" => $_POST["nuevoPrecioCompra"],
                    // "proveedor" => $_POST["nuevoProveedor"],                        
                    // "producto_minimo" => $_POST["nuevoProductoMinimo"],
                    // "producto_maximo" => $_POST["nuevoProductoMaximo"],
                    "foto" => $ruta);
                    // var_dump($datos);
                    // return;                    

                    $crearInventario = ModeloInventario::mdlCrearBodega($tabla, $datos);
                    // var_dump($datos);
                    // return;

                    if($crearInventario == true){
                        
                        // $descripcionEvento = "  Nuevo Producto";
                        // $accion = "Nuevo";

                        // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 4,$accion, $descripcionEvento);

                        echo '<script>
                                Swal.fire({
                                    title: "Equipo creado exitosamente!",
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
                                    title: "Opps, algo salio mal, intenta de nuevo!",
                                    icon: "error",
                                    heightAuto: false,
                                    allowOutsideClick: false,
                                    timer: 4000
                                });					
                            </script>';
                    }

                } 
            
            } 
            else {
                echo '<script>
                        Swal.fire({
                            title: "Llenar los datos correctamente. Intenta de nuevo!",
                            icon: "error",
                            heightAuto: false,
                            allowOutsideClick: false,
                            timer: 4000
                        });					
                    </script>';
            }
        }
    }


    /*=============================================
    CREAR COMPRA
    =============================================*/

    static public function ctrCrearCompra($pantalla){
        // var_dump($_POST);
        // return;
        if(isset($_POST["nuevoProducto"])){

            if(preg_match('/^[0-9]*$/', $_POST["nuevoProducto"])){
                

                // var_dump($producto);
                // echo $cantidadFinal;
                
                // return;


                $tabla = "tbl_compras";
                
                
                $datos = array("id_inventario" => $_POST["nuevoProducto"],
                                "id_proveedor" => $_POST["nuevoProveedor"],
                                "cantidad" => $_POST["nuevoCantidad"],
                                "precio" => $_POST["nuevoPrecio"]);
                    
                // var_dump($datos);
                // return;

                $crearInventario = ModeloInventario::mdlCrearCompra($tabla, $datos);

                if($crearInventario == true){

                    $tabla = "tbl_inventario";
                    $item = "id_inventario";
                    $valor = $_POST["nuevoProducto"];
                    $all = null;

                    $producto = ControladorUsuarios::ctrMostrar($tabla,$item,$valor, $all);
                    $stockActual = $producto["stock"];
                    $cantidadFinal = $stockActual + $_POST["nuevoCantidad"];

                    // var_dump($producto);
                    // return;

                    $item1="stock";
                    $valor1=$cantidadFinal;
                    $item2="id_inventario";
                    $valor2=$_POST["nuevoProducto"];
                    $item3 = null;
                    $item4 = null;
                    $valor3 = null;
                    $valor4 = null;
                    $respuesta= ModeloInventario::mdlActualizarProductos($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
                    if ($respuesta == true) {
                        
                        $descripcionEvento = $descripcionEvento = "".$_SESSION['usuario']." Realizó una nueva compra ";
                        $accion = "Nuevo";

                        $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 9,$accion, $descripcionEvento);

                        echo '<script>
                                Swal.fire({
                                    title: "Compra guardada correctamente!",
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

                } else {
                    echo '<script>
                            Swal.fire({
                                title: "No se pudo guardar la compra. Intenta de nuevo!",
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



    /*=============================================
    TOTAL DE PRODUCTOS
    =============================================*/
    static public function ctrMostrarTotalInventario($tabla, $item, $valor,$order) {
        $tabla1 = $tabla;
        $tabla2 = "tbl_tipo_producto";
        $respuesta = ModeloInventario::mdlMostrarTotalInventario($tabla1, $tabla2, $item, $valor,$order);
        return $respuesta;
    }


    /*=============================================
    EDITAR PRODUCTOS
    =============================================*/

    static public function ctrEditarStock($tipostock, $pantalla){
        // var_dump($_POST);
        // // return;
        // // var_dump($_POST);
        // var_dump($_FILES);
        // return;

        if(isset($_POST["editarNombreProducto"])){

            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreProducto"])){
        // var_dump($_POST);
        // return;

                /*=============================================
                        VALIDAR IMAGEN
                =============================================*/

                $ruta = $POST["imagenActual"];

                if(isset($_FILES["editarFotoProducto"]["tmp_name"])){

                    list($ancho, $alto) = getimagesize($_FILES["editarFotoProducto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*==============================================================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                    ===============================================================*/

                    $directorio = "vistas/img/productos/".$_POST["editarNombreProducto"];


                        
                    /*==============================================================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                    ===============================================================*/
                    
                    if (!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/usuarios/default/anonymous.png"
                    ){
                        unlink($_POST["imagenActual"]);
                    }else{
                        mkdir($directorio, 0755);
                    }
                    
                        

                    /*=====================================================================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                    ======================================================================*/

                    if($_FILES["editarFotoProducto"]["type"] == "image/jpeg"){

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/img/productos/".$_POST["editarNombreProducto"]."/".$aleatorio.".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarFotoProducto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }

                    if($_FILES["editarFotoProducto"]["type"] == "image/png"){

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/img/productos/".$_POST["nuevoNombreProducto"]."/".$aleatorio.".png";

                        $origen = imagecreatefrompng($_FILES["editarFotoProducto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                        

                    }

                }

                

                $tabla = "tbl_inventario";
            
                // AQUI CAMBIE A PRODUCTOS CON S

                if($tipostock == 'Productos'){
                    
                    $descripcionEvento = "Actualizo un Producto del Stock";
                    $accion = "Actualizo";
                    $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 4,$accion, $descripcionEvento);
                
                    $datos = array("nombre_producto" => $_POST["editarNombreProducto"],
                    "codigo" => $_POST["editarCodigo"],
                    "id_inventario" => $_POST["editarTipoProducto"],
                    // "stock" => $_POST["editarStock"],
                    "precio_venta" => $_POST["editarPrecio"],
                    // "precio_compra" => $_POST["editarPrecioCompra"],
                    // "proveedor" => $_POST["editarProveedor"],
                    "foto" => $ruta,
                    "producto_minimo" => $_POST["editarProductoMinimo"],
                    "producto_maximo" => $_POST["editarProductoMaximo"]);
                        // var_dump($datos);
                        // return;
                    $crearInventario = ModeloInventario::mdlEditarStock($tabla, $datos);
                    // var_dump($crearInventario);
                    // return;
                    if($crearInventario == true){
                            
                        echo '<script>
                                Swal.fire({
                                    title: "Producto editado correctamente!",
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


    /*=============================================
    EDITAR BODEGA-EQUIPO   
    =============================================*/

    static public function ctrEditarEquipo($tipostock, $pantalla){
        // var_dump($_POST);
        // return;
        // var_dump($_POST);
        // var_dump($_FILES);
        // return;

        if(isset($_POST["editarNombreEquipo"])){

            if(preg_match('/^[A-ZñÑÁÉÍÓÚ ]+$/', $_POST["editarNombreEquipo"])){


                /*=============================================
                        VALIDAR IMAGEN
                =============================================*/

                $ruta = $_POST["imagenActual"];

                if(isset($_FILES["editarFotoEquipo"]["tmp_name"]) && !empty($_FILES["editarFotoEquipo"]["tmp_name"])){

                    // var_dump($_FILES);
                    // return;
                    list($ancho, $alto) = getimagesize($_FILES["editarFotoEquipo"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /*==============================================================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                    ===============================================================*/

                    $directorio = "vistas/img/productos/".$_POST["editarNombreEquipo"];


                        
                    /*==============================================================
                    CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                    ===============================================================*/
                    
                    if (!empty($_POST["imagenActual"])){
                        unlink($_POST["imagenActual"]);
                    }else{
                        mkdir($directorio, 0755);
                    }
                    
                        

                    /*=====================================================================
                    DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                    ======================================================================*/

                    if($_FILES["editarFotoEquipo"]["type"] == "image/jpeg"){

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/img/productos/".$_POST["editarNombreEquipo"]."/".$aleatorio.".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarFotoEquipo"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }

                    if($_FILES["editarFotoEquipo"]["type"] == "image/png"){

                        /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                        $aleatorio = mt_rand(100,999);

                        $ruta = "vistas/img/productos/".$_POST["editarNombreEquipo"]."/".$aleatorio.".png";

                        $origen = imagecreatefrompng($_FILES["editarFotoEquipo"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                        

                    }

                }

                $tabla = "tbl_inventario";

                if($tipostock == 'Equipo'){
                    
                    $descripcionEvento = "Actualizo un Equipo del Stock";
                    $accion = "Actualizo";
                    $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 2,$accion, $descripcionEvento);
                
                    $datos = array("nombre_producto" => $_POST["editarNombreEquipo"],
                    "codigo" => $_POST["editarCodigoE"],
                    "id_inventario" => $_POST["editarTipoEquipo"],
                    "stock" => $_POST["editarStockEquipo"],
                    "foto" => $ruta);

                    // var_dump($datos);
                    // return;

                    $crearInventario = ModeloInventario::mdlEditarEquipo($tabla, $datos);
                    // var_dump($crearInventario);
                    // return;
                    if($crearInventario == true){
                            
                        echo '<script>
                                Swal.fire({
                                    title: "Equipo editado correctamente!",
                                    icon: "success",
                                    heightAuto: false,
                                    allowOutsideClick: false
                                }).then((result)=>{
                                    if(result.value){
                                        window.location = "'.$pantalla.'";
                                    }
                                });                       
                            </script>';
                    } else {
                        echo '<script>
                                Swal.fire({
                                    title: "Opps, algo salio mal, intenta de nuevo!",
                                    icon: "error",
                                    heightAuto: false,
                                    allowOutsideClick: false,
                                    timer: 4000
                                });					
                            </script>';
                    }

                } 

            } else {
                echo '<script>
                    Swal.fire({
                        title: "Por favor llene los campos correctamente. Intente de nuevo!",
                        icon: "error",
                        heightAuto: false,
                        allowOutsideClick: false,
                        timer: 4000
                    });					
                </script>';
            }
        }
    }


	/*=============================================
    BORRAR PERSONAS (USUARIO/CLIENTE)
	=============================================*/
    static public function ctrBorrarEquipo(){
        // var_dump($_GET);
        // return;

        if(isset($_GET['idEquipo'])){
            $tabla = 'tbl_inventario';
            $item = 'id_inventario';
            $valor = $_GET['idEquipo'];

            $respuesta = ModeloInventario::mdlBorrarEquipo($tabla, $item, $valor);
            
            // var_dump($respuesta);
            // return;
            
            if($respuesta == true){
        
                if($_GET['fotoEquipo'] != ""){
                    unlink($_GET['fotoEquipo']);
                    rmdir('vistas/img/productos/'.$_GET['equipo']);
                }

                echo '<script>
                    Swal.fire({
                        title: "Equipo borrado correctamente!",
                        icon: "success",
                        heightAuto: false
                    }).then((result)=>{
                        if(result.value){
                            window.location = "equipo";
                        }
                    });                                      
                </script>';
                    
            } else {
                
                // $descripcionEvento = " Elimino un cliente.";
                // $accion = "Elimino";
    
                // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 3,$accion, $descripcionEvento);
                  
                echo '<script>
                        Swal.fire({
                            title: "Opps, algo salio mal, intenta de nuevo!",
                            icon: "error",
                            heightAuto: false
                        }).then((result)=>{
                            if(result.value){
                                window.location = "equipo";
                            }
                        });                                      
                    </script>';
            }
        }
    }


    /*=============================================
    SUMA TOTAL VENTAS
    =============================================*/
	static public function ctrMostrarSumaVentas(){

		$tabla = 'tbl_inventario';
		
		$respuesta = ModeloInventario::mdlMostrarSumaVentas($tabla);
		
		return $respuesta;
	}
   
    
    /*=============================================
    RANGO DINAMICO
    =============================================*/
	static public function ctrRangoC($rango){
		$tabla = 'tbl_inventario';
		$respuesta = ModeloInventario::mdlRangoC($tabla, $rango);	
		return $respuesta;
    }
    
    /*=============================================
    RANGO DINAMICO
    =============================================*/
	static public function ctrRangoCompras($rango){
		$tabla = 'tbl_compras';
		$respuesta = ModeloInventario::mdlRangoCompras($tabla, $rango);	
		return $respuesta;
    }
    
    // static public function ctrPermisosSesion(){
    //     return $_SESSION['permisos'];
    // }

}


	