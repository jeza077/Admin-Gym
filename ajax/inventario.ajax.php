<?php
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class AjaxInventario{

    //** ----------------- MOSTRAR PROVEEDORES EN COMPRAS --------------------------*/
    public $tabla;
    public function ajaxMostrarProveedores(){
        $tabla = "tbl_proveedores";
        $item = null;
        $valor = null;
        $respuesta = ControladorInventario::ctrMostrarProveedores($tabla, $item, $valor);
        echo json_encode($respuesta);
    }

    //** ----------------- editar INVENTARIO --------------------------*/
    public $idInventario;
    public function ajaxEditarInventario(){
        $order = "DESC";
        $tabla = "tbl_inventario";
        $item = "id_inventario";
        $valor = $this->idInventario;
        $respuesta = ControladorInventario::ctrMostrarInventario($tabla,$item,$valor,$order);
        echo json_encode($respuesta);
    }

    //** ----------------- editar Equipo --------------------------*/
    public $idEquipo;
    public function ajaxEditarEquipo(){
        $order = "DESC";
        $tabla = "tbl_inventario";
        $item = "id_inventario";
        $valor = $this->idEquipo;
        $respuesta = ControladorInventario::ctrMostrarInventario($tabla,$item,$valor,$order);
        echo json_encode($respuesta);
    }

    //** ----------------- GENERAR CODIGO --------------------------*/
    public $idCategoria;
    public function ajaxCradorCodigoProducto(){
        $order = "DESC";
        $tabla = "tbl_inventario";
        $item = "id_tipo_producto";
        $valor = $this->idCategoria;
        $respuesta = ControladorInventario::ctrMostrarInventario($tabla,$item,$valor,$order);
        echo json_encode($respuesta);
    }


    //*** GRAFICOS PRODUCTOS ***//
    public $order;
    public function ajaxDatosGraficoProductos(){
        $item = 'tipo_producto';
        $valor = 'Productos';
        $order = $this->order;
        $tabla = 'tbl_inventario';
        $productos = ControladorInventario::ctrMostrarTotalInventario($tabla, $item, $valor,$order);
        echo json_encode($productos);

}
}

//** ----------------- MOSTRAR PROVEEDORES DINAMICAMENTE --------------------------*/
if (isset($_POST["tabla"])){
    $mostrarProveedores = new AjaxInventario();
    $mostrarProveedores->tabla = $_POST["tabla"];
    $mostrarProveedores->ajaxMostrarProveedores();
} 
//** ----------------- editar INVENTARIO --------------------------*/
if (isset($_POST["idInventario"])){
    $editar = new AjaxInventario();
    $editar->idInventario = $_POST["idInventario"];
    $editar->ajaxEditarInventario();
} 

//** ----------------- editar Equipo --------------------------*/
if (isset($_POST["idEquipo"])){
    $editar = new AjaxInventario();
    $editar->idEquipo = $_POST["idEquipo"];
    $editar->ajaxEditarEquipo();
} 


//** ----------------- CODIGO --------------------------*/
if (isset($_POST["idCategoria"])){
    $editar = new AjaxInventario();
    $editar->idCategoria = $_POST["idCategoria"];
    $editar->ajaxCradorCodigoProducto();
}


//*** GRAFICOS PRODUCTOS ***/
if (isset($_POST["order"])){
    $productos = new AjaxInventario();
    $productos->order = $_POST["order"];
    $productos->ajaxDatosGraficoProductos();
} 


