<?php

require_once "../controladores/globales.controlador.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/globales.modelo.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/mantenimiento.controlador.php";
require_once "../modelos/mantenimiento.modelo.php";

class AjaxParametro{



    /*=============================================
                   EditarParametro
    ==============================================*/
    public $idParametro;
    public $idRol;
    public $idMatricula;

    public function ajaxEditarParametro(){

        $item = "id_parametro";

        $valor = $this->idParametro;

        $respuesta = ControladorGlobales::ctrMostrarParametros($item,$valor);

        echo json_encode($respuesta);
    
    }   

    public function ajaxEditarRol(){

        $item = "id_rol";

        $valor = $this->idRol;

        $respuesta = ControladorMantenimientos::ctrMostrarRoles($item,$valor);

        echo json_encode($respuesta);
    
    }  

    public function ajaxEditarMatricula(){

        $item = "id_matricula";

        $valor = $this->idMatricula;

        $respuesta = ControladorMantenimientos::ctrMostrarMatricula($item,$valor);

        echo json_encode($respuesta);
    
    }  



    
}    

    /*========================================
        Editar Parametro
    ==========================================*/ 

    if(isset($_POST["idParametro"])){ 

        $editar = new AjaxParametro();
        $editar-> idParametro = $_POST["idParametro"];
        $editar-> ajaxEditarParametro();
    }   

    /*========================================
        Editar Roles
    ==========================================*/ 

    if(isset($_POST["idRol"])){ 

        $editar = new AjaxParametro();
        $editar-> idRol = $_POST["idRol"];
        $editar-> ajaxEditarRol();
    }    
    
       /*========================================
        Editar Matricula
    ==========================================*/ 

    if(isset($_POST["idMatricula"])){ 

        $editar = new AjaxParametro();
        $editar-> idMatricula = $_POST["idMatricula"];
        $editar-> ajaxEditarMatricula();
    }     
    
    

 