<?php
 
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos{
    /*=============================================
                EDITAR Producto
    =============================================*/

    public $idProducto;

    public function ajaxEditarProducto(){
        $item = "id_inventario";
        $valor = $this->idProducto;
        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }

}

/*=============================================
            EDITAR USUARIO
=============================================*/
if(isset($_POST["idProducto"])){
    $editar = new AjaxProductos();
    $editar->idProducto = $_POST["idProducto"];
    $editar->ajaxEditarProducto();
}