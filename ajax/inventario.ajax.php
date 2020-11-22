<?php
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class AjaxInventario{
    //** ----------------- editar INVENTARIO --------------------------*/
    public $idInventario;
    public function ajaxEditarInventario(){
        $tabla = "tbl_inventario";
        $item = "id_inventario";
        $valor = $this->idInventario;
        $respuesta = ControladorInventario::ctrMostrarInventario($tabla,$item,$valor);
        echo json_encode($respuesta);
    }

    //** ----------------- GENERAR CODIGO --------------------------*/
    public $idCategoria;
    public function ajaxCradorCodigoProducto(){
        $tabla = "tbl_inventario";
        $item = "id_inventario";
        $valor = $this->idCategoria;
        $respuesta = ControladorInventario::ctrMostrarInventario($tabla,$item,$valor);
        echo json_encode($respuesta);
    }
}
//** ----------------- editar INVENTARIO --------------------------*/
if (isset($_POST["idInventario"])){
    $editar = new AjaxInventario();
    $editar -> idInventario = $_POST["idInventario"];
    $editar -> ajaxEditarInventario();
} 

//** ----------------- CODIGO --------------------------*/
if (isset($_POST["idCategoria"])){
    $editar = new AjaxInventario();
    $editar -> idCategoria = $_POST["idCategoria"];
    $editar -> ajaxCradorCodigoProducto();
} 
