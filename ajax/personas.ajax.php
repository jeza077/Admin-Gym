<?php

require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

class AjaxPersonas{

    /*=============================================
    REVISAR IDENTIDAD
    =============================================*/
    public $identidadIngresada;

    public function ajaxValidarIdentidad(){
    
        $item = "num_documento";
        $valor = $this->identidadIngresada;
        
        $respuestaDocumento = ControladorPersonas::ctrMostrarDocumento($item, $valor);

        echo json_encode($respuestaDocumento);
    }
    /*=============================================
    REVISAR IDENTIDAD
    =============================================*/
    if(isset($_POST["identidadIngresada"])){
        $valDocumento = new AjaxPersonas();
        $valDocumento->identidadIngresada = $_POST["identidadIngresada"];
        $valDocumento->ajaxValidarIdentidad();
    }
}