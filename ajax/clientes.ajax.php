<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxClientes{

    /*=============================================
           EDITAR CLIENTE
    =============================================*/
    
    
    public $idEditarCliente;

    public function ajaxEditarCliente(){

        $tabla = "tbl_clientes";
        $item = "id_personas";
        $valor = $this->idEditarCliente;
        
        $respuesta = ControladorClientes::ctrMostrarClientes($tabla, $item, $valor);
        // echo "<pre>";
        // var_dump($respuesta);
        // echo "</pre>";

        echo json_encode($respuesta);
    }

     /*=============================================
           EDITAR CLIENTE
    =============================================*/
    
    
    public $idPago;

    public function ajaxEditarPagoCliente(){

        $tabla = "tbl_clientes";
        $item = "id_personas";
        $valor = $this->idPago;
        
        $respuesta = ControladorClientes::ctrMostrarClientes($tabla, $item, $valor);
        // echo "<pre>";
        // var_dump($respuesta);
        // echo "</pre>";

        echo json_encode($respuesta);
    }

    /*=============================================
           MOSTRAR DINAMICO
    =============================================*/
    
    
    public $tabla;
    public $valor;
    public $item;

    public function ajaxMostrar(){

        $tabla = $this->tabla;
        $item = $this->item;
        $valor = $this->valor;
        
        $respuesta = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);
        // echo "<pre>";
        // var_dump($respuesta);
        // echo "</pre>";

        echo json_encode($respuesta);
    }
}

/*=============================================
    EDITAR CLIENTE
=============================================*/
if(isset($_POST["idEditarCliente"])){
    $cliente = new AjaxClientes();
    $cliente->idEditarCliente = $_POST["idEditarCliente"];
    $cliente->ajaxEditarCliente();
}
/*=============================================
    EDITAR PAGO CLIENTE
=============================================*/
if(isset($_POST["idPago"])){
    $cliente = new AjaxClientes();
    $cliente->idPago = $_POST["idPago"];
    $cliente->ajaxEditarPagoCliente();
}
/*=============================================
    MOSTRAR DINAMICO
=============================================*/
if(isset($_POST["tabla"])){
    $mostrar = new AjaxClientes();
    $mostrar->tabla = $_POST["tabla"];
    $mostrar->valor = $_POST["valor"];
    $mostrar->item = $_POST["item"];
    $mostrar->ajaxMostrar();
}
