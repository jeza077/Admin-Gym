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





class AjaxInscripcion{



    /*=============================================
                   Activar INSCRIPCIONES
    ==============================================*/
    public $activarInscripcion;
    public $activarid;
    
    public function ajaxActivarInscripcion(){ 

        $tabla = "tbl_Inscripcion";

        $item1 = "estado";
        $valor1 = $this->activarInscripcion;

        $item2 = "id_inscripcion";
        $valor2 = $this->activarid;


        $respuesta = ModeloMantenimiento::mdlActualizarInscripcion($tabla,$item1,$valor1,$item2,$valor2);
        echo json_encode($respuesta);


    }    


}    

/*========================================
Activar INSCRIPCION
==========================================*/ 

if(isset($_POST["activarInscripcion"])){ 

    $activarInscripcion = new ajaxInscripcion();
    $activarInscripcion->activarInscripcion = $_POST["activarInscripcion"];
    $activarInscripcion->activarid = $_POST["activarid"];
    $activarInscripcion->ajaxActivarInscripcion();


}  



class AjaxMatricula{



    /*=============================================
                   Activar Matricula
    ==============================================*/
    public $activarMatricula;
    public $activarid;
    
    public function ajaxActivarMatricula(){ 

        $tabla = "tbl_matricula";

        $item1 = "estado";
        $valor1 = $this->activarMatricula;

        $item2 = "id_matricula";
        $valor2 = $this->activarid;


        $respuesta = ModeloMantenimiento::mdlActualizarMatricula($tabla,$item1,$valor1,$item2,$valor2);
        echo json_encode($respuesta);


    }    


}    

/*========================================
Activar MATRICULA
==========================================*/ 

if(isset($_POST["activarMatricula"])){ 

    $activarMatricula = new ajaxMatricula();
    $activarMatricula->activarMatricula = $_POST["activarMatricula"];
    $activarMatricula->activarid = $_POST["activarid"];
    $activarMatricula->ajaxActivarMatricula();


}  

