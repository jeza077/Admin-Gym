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
    public $idInscripcion;
    public $idMatricula;
    public $idDescuento;
    

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

    public function ajaxEditarInscripcion(){

        $item = "id_inscripcion";

        $valor = $this->idInscripcion;

        $respuesta = ControladorMantenimientos::ctrMostrarInscripcion($item,$valor);

        echo json_encode($respuesta);
    
    }  

    public function ajaxEditarMatricula(){

        $item = "id_matricula";

        $valor = $this->idMatricula;

        $respuesta = ControladorMantenimientos::ctrMostrarMatricula($item,$valor);

        echo json_encode($respuesta);
    
    }  

    
    public function ajaxEditarDescuento(){

        $item = "id_descuento";

        $valor = $this->idDescuento;

        $respuesta = ControladorMantenimientos::ctrMostrarDescuento($item,$valor);

        echo json_encode($respuesta);
    
    }  


    //** ------------------------------------*/
    //  SELECT A PARAMETRO PRODUCTO MINIMO
    // --------------------------------------*/ 
    public $parametroProducto;

    public function ajaxparametroProducto(){

        // $tabla = "tbl_parametros";
        $item = "parametro";
        $valor = $this->parametroProducto;
        
        $respuesta = ControladorUsuarios::ctrMostrarParametros($item, $valor);

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
        Editar Inscripcion
    ==========================================*/ 

    if(isset($_POST["idInscripcion"])){ 

        $editar = new AjaxParametro();
        $editar-> idInscripcion = $_POST["idInscripcion"];
        $editar-> ajaxEditarInscripcion();
    }    
    
    /*========================================
        Editar Matricula
    ==========================================*/ 

    if(isset($_POST["idMatricula"])){ 

        $editar = new AjaxParametro();
        $editar-> idMatricula = $_POST["idMatricula"];
        $editar-> ajaxEditarMatricula();
    }  
    
    /*========================================
        Editar DESCUENTO
    ==========================================*/ 

    if(isset($_POST["idDescuento"])){ 

        $editar = new AjaxParametro();
        $editar-> idDescuento = $_POST["idDescuento"];
        $editar-> ajaxEditarDescuento();
    }     

    /*========================================
        SELECT A PARAMETRO PRODUCTO MINIMO
    ==========================================*/ 

    if(isset($_POST["parametroProducto"])){ 

        $pMinimo = new AjaxParametro();
        $pMinimo->parametroProducto = $_POST["parametroProducto"];
        $pMinimo->ajaxParametroProducto();
    }     
    
    
    

 