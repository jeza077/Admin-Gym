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
        EDITAR PAGO CLIENTE MANTENIENDO INSCRIPCION
    =============================================*/
    
    public $idClientePagoMantener;

    public function ajaxEditarPagoClienteMantenerInscripcion(){

        // $tabla = "tbl_clientes";
        // $item = "id_personas";
        $idClientePago = $this->idClientePagoMantener;
        //$max = true;
        
        $respuesta = ControladorClientes::ctrActualizarPagoCliente($idClientePago);

        echo json_encode($respuesta);
    }




     /*=============================================
        EDITAR PAGO CLIENTE CAMBIANDO INSCRIPCION
    =============================================*/

    public $idClientePago;

    public function ajaxEditarPagoCliente(){

        $tabla = "tbl_clientes";
        $item = "id_personas";
        $valor = $this->idClientePago;
        $max = true;
        
        $respuesta = ControladorClientes::ctrMostrarPagoPorCliente($tabla, $item, $valor);

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
EDITAR PAGO CLIENTE MANTENIENDO INSCRIPCION
=============================================*/
if(isset($_POST["idClientePagoMantener"])){
    $pagoCliente = new AjaxClientes();
    $pagoCliente->idClientePagoMantener = $_POST["idClientePagoMantener"];
    $pagoCliente->ajaxEditarPagoClienteMantenerInscripcion();
}

/*=============================================
    EDITAR PAGO CLIENTE CAMBIANDO INSCRIPCION
=============================================*/
if(isset($_POST["idClientePago"])){
    $pagoCliente = new AjaxClientes();
    $pagoCliente->idClientePago = $_POST["idClientePago"];
    $pagoCliente->ajaxEditarPagoCliente();
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
    MOSTRAR DINAMICO
=============================================*/
if(isset($_POST["tabla"])){
    $mostrar = new AjaxClientes();
    $mostrar->tabla = $_POST["tabla"];
    $mostrar->valor = $_POST["valor"];
    $mostrar->item = $_POST["item"];
    $mostrar->ajaxMostrar();
}
