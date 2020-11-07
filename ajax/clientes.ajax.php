<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

    /*=============================================
           EDITAR CLIENTE
    =============================================*/
    
    
    public $idCliente;

    public function ajaxEditarCliente(){

        $tabla = "tbl_clientes";
        $item = "id_personas";
        $valor = $this->idCliente;
        
        $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);
        // echo "<pre>";
        // var_dump($respuesta);
        // echo "</pre>";

        echo json_encode($respuesta);
    }
}

/*=============================================
    EDITAR CLIENTE
=============================================*/
if(isset($_POST["idCliente"])){
    $cliente = new AjaxClientes();
    $cliente->idCliente = $_POST["idCliente"];
    $cliente->ajaxEditarCliente();
}
