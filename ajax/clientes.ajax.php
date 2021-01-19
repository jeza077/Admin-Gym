<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxClientes{

    /*=============================================
           MOSTRAR CLIENTE
    =============================================*/
    public $idCliente;

    public function ajaxMostrarClientes(){

        $tabla = "tbl_clientes";
        $item = "id_cliente";
        $valor = $this->idCliente;
        
        $respuesta = ControladorClientes::ctrMostrarClientesSinPago($tabla, $item, $valor);
        // echo "<pre>";
        // var_dump($respuesta);
        // echo "</pre>";

        echo json_encode($respuesta);
    }



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
           EDITAR CLIENTE VENTA
    =============================================*/
    
    
    public $idEditarClienteVenta;

    public function ajaxEditarClienteVenta(){

        $tabla = "tbl_clientes";
        $item = "id_personas";
        $valor = $this->idEditarClienteVenta;
        
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
        $item = "id_cliente";
        $valor = $this->idClientePago;
        $max = true;
        
        $respuesta = ControladorClientes::ctrMostrarPagoPorCliente($tabla, $item, $valor);

        echo json_encode($respuesta);
    }



    /*=============================================
        ACTUALIZAR ESTADO INSCRIPCION CLIENTE
    =============================================*/
    public $estadoClienteInscripcion;
    public $idClienteInscripcion;
    public $inscrito;


    public function ajaxActualizarEstadoInscripcionCliente(){

        $tabla1 = "tbl_cliente_inscripcion";
        $item1 = "estado";
        $valor1 = $this->estadoClienteInscripcion;

        // $item2 = "id_cliente_inscripcion";
        // $valor2 = $this->idClienteInscripcion;

        $item2 = 'inscrito';
        $valor2 = $this->inscrito;

        $item3 = 'id_cliente_inscripcion';
        $valor3 = $this->idClienteInscripcion;
        
        // $respuesta = ModeloClientes::mdlActualizarCliente($tabla1, $item1, $valor1, $item2, $valor2);

        $respuesta = ModeloClientes::mdlActualizarClienteVarios($tabla1, $item1, $valor1, $item2, $valor2, $item3, $valor3);

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

    /*=============================================
    MOATRAR CLIENTE 
    =============================================*/
    // public $verificarDocumento;

    // public function ajaxVerificarDocumento(){

    //     $tabla = "tbl_clientes";
    //     $item = "num_documento";
    //     $valor = $this->verificarDocumento;
        
    //     $respuesta = ControladorClientes::ctrMostrarClientes($tabla, $item, $valor);
    //     // echo "<pre>";
    //     // var_dump($respuesta);
    //     // echo "</pre>";
    //     // return;

    //     echo json_encode($respuesta);
    // }
}

/*=============================================
    MOATRAR CLIENTE 
=============================================*/
if(isset($_POST["idCliente"])){
    $cliente = new AjaxClientes();
    $cliente->idCliente = $_POST["idCliente"];
    $cliente->ajaxMostrarClientes();
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
    EDITAR CLIENTE GIMNASIO
=============================================*/
if(isset($_POST["idEditarCliente"])){
    $cliente = new AjaxClientes();
    $cliente->idEditarCliente = $_POST["idEditarCliente"];
    $cliente->ajaxEditarCliente();
}
/*=============================================
    EDITAR CLIENTE VENTA
=============================================*/
if(isset($_POST["idEditarClienteVenta"])){
    $clienteVenta = new AjaxClientes();
    $clienteVenta->idEditarClienteVenta = $_POST["idEditarClienteVenta"];
    $clienteVenta->ajaxEditarClienteVenta();
}

/*=============================================
    ACTUALIZAR ESTADO INSCRIPCION CLIENTE
=============================================*/
if(isset($_POST["tabla"])){
    $mostrar = new AjaxClientes();
    $mostrar->tabla = $_POST["tabla"];
    $mostrar->valor = $_POST["valor"];
    $mostrar->item = $_POST["item"];
    $mostrar->ajaxMostrar();
}


/*=============================================
    MOSTRAR DINAMICO
=============================================*/
if(isset($_POST['idClienteInscripcion'])){
    $estadoInscripcion = new AjaxClientes();
    $estadoInscripcion->idClienteInscripcion = $_POST['idClienteInscripcion'];
    $estadoInscripcion->estadoClienteInscripcion = $_POST['estadoClienteInscripcion'];
    $estadoInscripcion->inscrito = $_POST["inscrito"];
    $estadoInscripcion->ajaxActualizarEstadoInscripcionCliente();
}

/*=============================================
    VERIFICAR DOCUMENTO
=============================================*/
if(isset($_POST["verificarDocumento"])){
    $verificarNumDocumento = new AjaxClientes();
    $verificarNumDocumento->verificarDocumento = $_POST["verificarDocumento"];
    $verificarNumDocumento->ajaxVerificarDocumento();
}