<?php

require_once "../controladores/mantenimiento.controlador.php";
require_once "../modelos/mantenimiento.modelo.php";

class AjaxRol{



    /*=============================================
                   Activar Rol
    ==============================================*/
    public $activarRol;
    public $activarid;
    
    public function ajaxActivarRol(){ 

        $tabla = "tbl_roles";

        $item1 = "estado";
        $valor1 = $this->activarRol;

        $item2 = "id_rol";
        $valor2 = $this->activarid;


        $respuesta = ModeloMantenimiento::mdlActualizarRol($tabla,$item1,$valor1,$item2,$valor2);
        echo json_encode($respuesta);


    }    


}    

/*========================================
Activar Rol
==========================================*/ 

if(isset($_POST["activarRol"])){ 

    $activarRol = new ajaxRol();
    $activarRol->activarRol = $_POST["activarRol"];
    $activarRol->activarid = $_POST["activarid"];
    $activarRol->ajaxActivarRol();


}  
