<?php

require_once "../controladores/mantenimiento.controlador.php";
require_once "../modelos/mantenimiento.modelo.php";

class AjaxRol{

    

    /*=============================================
                GUARDAR ROL
    ==============================================*/
    public $nuevoRol;
    public $nuevoRolDescripcion;
    
    public function ajaxGuardarRol(){ 

        $rol = $this->nuevoRol;
        $descripcion = $this->nuevoRolDescripcion;

        $respuesta = ControladorMantenimientos::ctrRolesInsertar($rol, $descripcion);
        echo json_encode($respuesta);


    }    


    /*=============================================
            GUARDAR PERMISOS DE ROL
    ==============================================*/
    public $idRol;
    public $pantalla;
    public $consulta;
    public $agregar;
    public $actualizar;
    public $eliminar;
    
    public function ajaxGuardarPermisosRol(){ 

        $id = $this->idRol;
        $pant = $this->pantalla;
        $cons = $this->consulta;
        $agre = $this->agregar;
        $actua = $this->actualizar;
        $elim = $this->eliminar;


        $respuesta = ControladorMantenimientos::ctrInsertarPermisosRoles($id, $pant, $cons, $agre, $actua, $elim);
        echo json_encode($respuesta);


    }    



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
        GUARDAR ROL
==========================================*/ 

if(isset($_POST["nuevoRol"])){ 
    $guardarRol = new ajaxRol();
    $guardarRol->nuevoRol = $_POST["nuevoRol"];
    $guardarRol->nuevoRolDescripcion = $_POST["nuevoRolDescripcion"];
    $guardarRol->ajaxGuardarRol();
} 


/*========================================
        GUARDAR PERMISOS DE ROL
==========================================*/ 

if(isset($_POST["pantalla"])){ 
    $guardarPermisosRol = new ajaxRol();
    $guardarPermisosRol->idRol = $_POST["idRol"];
    $guardarPermisosRol->pantalla = $_POST["pantalla"];
    $guardarPermisosRol->consulta = $_POST["consulta"];
    $guardarPermisosRol->agregar = $_POST["agregar"];
    $guardarPermisosRol->actualizar = $_POST["actualizar"];
    $guardarPermisosRol->eliminar = $_POST["eliminar"];
    $guardarPermisosRol->ajaxGuardarPermisosRol();
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


class AjaxDescuento{



    /*=============================================
                   Activar DESCUENTO
    ==============================================*/
    public $activarDescuento;
    public $activarid;
    
    public function ajaxActivarDescuento(){ 

        $tabla = "tbl_Descuento";

        $item1 = "estado";
        $valor1 = $this->activarDescuento;

        $item2 = "id_matricula";
        $valor2 = $this->activarid;


        $respuesta = ModeloMantenimiento::mdlActualizarDescuento($tabla,$item1,$valor1,$item2,$valor2);
        echo json_encode($respuesta);


    }    


}    

/*========================================
Activar DESCUENTO
==========================================*/ 

if(isset($_POST["activarDescuento"])){ 

    $activarDescuento = new ajaxDescuento();
    $activarDescuento->activarMatricula = $_POST["activarDescuento"];
    $activarDescuento->activarid = $_POST["activarid"];
    $activarDescuento->ajaxActivarDescuento();


}  

