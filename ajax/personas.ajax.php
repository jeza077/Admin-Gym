<?php

require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

class AjaxPersonas{

    /*=============================================
            REVISAR DOCUMENTO
    =============================================*/
    
    public $verificarDocumento;

    public function ajaxVerificarDocumento(){

        $item = "num_documento";
        $valor = $this->verificarDocumento;
        $all = null;
        
        $respuesta = ControladorPersonas::ctrMostrarPersonas($item, $valor, $all);

        echo json_encode($respuesta);
    }
}

/*=============================================
    REVISAR DOCUMENTO
=============================================*/
if(isset($_POST["verificarDocumento"])){
    $valDocumento = new AjaxPersonas();
    $valDocumento->verificarDocumento = $_POST["verificarDocumento"];
    $valDocumento->ajaxVerificarDocumento();
}
