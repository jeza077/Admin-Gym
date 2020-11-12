<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxClientes{

    /*=============================================
           EDITAR CLIENTE
    =============================================*/
    
    
    public $idCliente;

    public function ajaxEditarCliente(){

      
        $item = "id_personas";
        $valor = $this->idCliente;
        
        $respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);
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
if(isset($_POST["idCliente"])){
    $cliente = new AjaxClientes();
    $cliente->idCliente = $_POST["idCliente"];
    $cliente->ajaxEditarCliente();
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
