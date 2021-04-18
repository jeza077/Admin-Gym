<?php

require_once "../controladores/mantenimiento.controlador.php";
require_once "../modelos/mantenimiento.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxMantenimiento{

    /*=============================================
                ACTIVAR GENERO
    =============================================*/

    public $estadoGenero;
    public $idGeneroActivar; 

    public function ajaxActivarDinamico(){

        $tabla = "tbl_sexo";

        $estado = "estado";
        $valorEstado = $this->estadoGenero;

        $idItem2 = "id_sexo";
        $valorItem2 = $this->idGeneroActivar;

        $pantalla = "género";

        $idPantalla = 35;
      
        $respuesta = ControladorMantenimientos::ctrActivar($tabla, $estado, $valorEstado, $idItem2, $valorItem2, $pantalla, $idPantalla);

        echo json_encode($respuesta);

    }


    /*========================================
        MOSTRAR-EDITAR DOCUMENTO
    ==========================================*/ 
    public $idGenero;

    public function ajaxEditarGenero(){

        $tabla = "tbl_sexo";
        $item = "id_sexo";
        $valor = $this->idGenero;
        $all = null;

        $respuesta = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

        echo json_encode($respuesta);
    
    }

    /*========================================
        MOSTRAR-EDITAR DOCUMENTO
    ==========================================*/ 
    public $idDocumento;

    public function ajaxEditarDocumento(){

        $item = "id_documento";

        $valor = $this->idDocumento;

        $respuesta = ControladorMantenimientos::ctrMostrarDocumento($item,$valor);

        echo json_encode($respuesta);
    
    }

    
    /*========================================
        MOSTRAR-EDITAR PREGUNTA
    ==========================================*/ 
    public $idPregunta;

    public function ajaxEditarPregunta(){

        $tabla = "tbl_preguntas";
        $item = "id_preguntas";
        $valor = $this->idPregunta;
        $all = null;

        $respuesta = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

        echo json_encode($respuesta);
    
    }
    
    
    /*=============================================
            ACTIVAR DOCUMENTO
    ==============================================*/
    public $idDocumentoActivar;
    public $estadoDocumento;
    
    public function ajaxActivarDocumento(){ 

        $tabla = "tbl_documento";

        $item1 = "estado";
        $valor1 = $this->estadoDocumento;

        $item2 = "id_documento";
        $valor2 = $this->idDocumentoActivar;

        $item3 = null;
        $valor3 = null;

        $item4 = null;
        $valor4 = null;

        $respuesta = ModeloMantenimiento::mdlActualizarMantenimiento($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
        echo json_encode($respuesta);

        // $respuesta = ModeloMantenimiento::mdlActualizarRol($tabla,$item1,$valor1,$item2,$valor2);
        // echo json_encode($respuesta);


    }    

    /*=============================================
            ACTIVAR PREGUNTA
    ==============================================*/
    public $idPreguntaActivar;
    public $estadoPregunta;
    
    public function ajaxActivarPregunta(){ 

        $tabla = "tbl_preguntas";

        $item1 = "estado";
        $valor1 = $this->estadoPregunta;

        $item2 = "id_preguntas";
        $valor2 = $this->idPreguntaActivar;

        $item3 = null;
        $valor3 = null;

        $item4 = null;
        $valor4 = null;

        $respuesta = ModeloMantenimiento::mdlActualizarMantenimiento($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
        echo json_encode($respuesta);

        // $respuesta = ModeloMantenimiento::mdlActualizarRol($tabla,$item1,$valor1,$item2,$valor2);
        // echo json_encode($respuesta);


    }    



    /*========================================
        GUARDAR PROVEEDOR
    ==========================================*/ 
    public $nombre;
    public $correo;
    public $telefono;

    public function ajaxNuevoProveedor(){
        // $nombreProv = $this->nombre;
        // $correoProv = $this->correo;
        // $telefonoProv = $this->telefono;
        $datos = array(
            'nombre' => $this->nombre,
            'correo' => $this->correo,
            'telefono' => $this->telefono
        );

        $respuesta = ControladorMantenimientos::ctrNuevoProveedor($datos);

        echo json_encode($respuesta);
    
    }
    
    /*========================================
        MOSTRAR-EDITAR PROVEEDOR
    ==========================================*/ 
    public $idProveedor;

    public function ajaxMostrarProveedor(){

        $tabla = "tbl_proveedores";
        $item = "id_proveedor";
        $valor = $this->idProveedor;
        $all = null;

        $respuesta = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

        echo json_encode($respuesta);
    
    }

    /*========================================
        MOSTRAR PARAMETRO (DINAMICO)
    ==========================================*/ 
    public $parametro;

    public function ajaxMostrarParametro(){

        $tabla = "tbl_parametros";
        $item = "parametro";
        $valor = $this->parametro;
        $all = null;

        $respuesta = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

        echo json_encode($respuesta);
    
    }

    /*========================================
        GUARDAR BACKUP EN BD
    ==========================================*/ 
    public $nombreBackup;
    // public $correo;
    // public $telefono;

    public function ajaxNuevoBackup(){
        $nombre = $this->nombreBackup;

        $respuesta = ControladorMantenimientos::ctrBackupInsertar($nombre);

        echo json_encode($respuesta);
    
    }

}

/*========================================
    MOSTRAR-EDITAR GENERO
==========================================*/ 
if(isset($_POST["idGenero"])){ 
    $editarGenero = new AjaxMantenimiento();
    $editarGenero->idGenero = $_POST["idGenero"];
    $editarGenero-> ajaxEditarGenero();
}  

/*========================================
    MOSTRAR-EDITAR DOCUMENTO
==========================================*/ 
if(isset($_POST["idDocumento"])){ 
    $editar = new AjaxMantenimiento();
    $editar->idDocumento = $_POST["idDocumento"];
    $editar-> ajaxEditarDocumento();
}  

/*========================================
    MOSTRAR-EDITAR PREGUNTA
==========================================*/ 
if(isset($_POST["idPregunta"])){ 
    $editarPregunta = new AjaxMantenimiento();
    $editarPregunta->idPregunta = $_POST["idPregunta"];
    $editarPregunta-> ajaxEditarPregunta();
}  

/*========================================
        ACTIVAR DOCUMENTO
==========================================*/ 
if(isset($_POST["idDocumentoActivar"])){ 
    $activarDocumento = new AjaxMantenimiento();
    $activarDocumento->estadoDocumento = $_POST["estadoDocumento"];
    $activarDocumento->idDocumentoActivar = $_POST["idDocumentoActivar"];
    $activarDocumento->ajaxActivarDocumento();
}  

/*========================================
        ACTIVAR GENERO
==========================================*/ 
if(isset($_POST["idGeneroActivar"])){ 
    $activarDinamico = new AjaxMantenimiento();
    $activarDinamico->estadoGenero = $_POST["estadoGenero"];
    $activarDinamico->idGeneroActivar = $_POST["idGeneroActivar"];
    $activarDinamico->ajaxActivarDinamico();
}  

/*========================================
        ACTIVAR PREGUNTA
==========================================*/ 
if(isset($_POST["idPreguntaActivar"])){ 
    $activarPregunta = new AjaxMantenimiento();
    $activarPregunta->estadoPregunta = $_POST["estadoPregunta"];
    $activarPregunta->idPreguntaActivar = $_POST["idPreguntaActivar"];
    $activarPregunta->ajaxActivarPregunta();
}  

/*========================================
        NUEVO PROVEEDOR
==========================================*/ 
if(isset($_POST["nombre"])){ 
    $nuevoProveedor = new AjaxMantenimiento();
    $nuevoProveedor->nombre = $_POST["nombre"];
    $nuevoProveedor->correo = $_POST["correo"];
    $nuevoProveedor->telefono = $_POST["telefono"];
    $nuevoProveedor->ajaxNuevoProveedor();
}  
/*========================================
    MOSTRAR-EDITAR PROVEEDOR
==========================================*/ 
if(isset($_POST["idProveedor"])){ 
    $mostrarProveedor = new AjaxMantenimiento();
    $mostrarProveedor->idProveedor = $_POST["idProveedor"];
    $mostrarProveedor->ajaxMostrarProveedor();
}  

/*========================================
    MOSTRAR PARAMETROS (DINAMICO)
==========================================*/ 
if(isset($_POST["parametro"])){ 
    $mostrarParametro = new AjaxMantenimiento();
    $mostrarParametro->parametro = $_POST["parametro"];
    $mostrarParametro->ajaxMostrarParametro();
}  


/*========================================
    INSERTAR BACKUP
==========================================*/ 
if(isset($_POST["nombreBackup"])){ 
    $backup = new AjaxMantenimiento();
    $backup->nombreBackup = $_POST["nombreBackup"];
    $backup-> ajaxNuevoBackup();
}




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
            ACTIVAR ROL
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


    /*=============================================
            ACTIVAR PERMISOS ROL
    ==============================================*/
    public $idPermiso;
    public $estadoPermiso;
    public $tipoPermiso;

    
    public function ajaxActivarPermisos(){ 

        $tabla = "tbl_permisos";

        $item1 = $this->tipoPermiso;
        $valor1 = $this->estadoPermiso;

        $item2 = "id_permiso";
        $valor2 = $this->idPermiso;
        
        $item3 = null;
        $valor3 = null;

        $item4 = null;
        $valor4 = null;

        $respuesta = ModeloMantenimiento::mdlActualizarMantenimiento($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
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
        ACTIVAR ROL
==========================================*/ 
if(isset($_POST["activarRol"])){ 
    $activarRol = new ajaxRol();
    $activarRol->activarRol = $_POST["activarRol"];
    $activarRol->activarid = $_POST["activarid"];
    $activarRol->ajaxActivarRol();
}  


/*=============================================
        ACTIVAR PERMISOS ROL
==============================================*/
if(isset($_POST["idPermiso"])){ 
    $activarPermisos = new ajaxRol();
    $activarPermisos->idPermiso = $_POST["idPermiso"];
    $activarPermisos->estadoPermiso = $_POST["estadoPermiso"];
    $activarPermisos->tipoPermiso = $_POST["tipoPermiso"];
    $activarPermisos->ajaxActivarPermisos();
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
        ACTIVAR INSCRIPCION
==========================================*/ 

if(isset($_POST["activarInscripcion"])){ 

    $activarInscripcion = new ajaxInscripcion();
    $activarInscripcion->activarInscripcion = $_POST["activarInscripcion"];
    $activarInscripcion->activarid = $_POST["activarid"];
    $activarInscripcion->ajaxActivarInscripcion();


}  



class AjaxMatricula{

    /*=============================================
            ACTIVAR MATRICULA
    ==============================================*/
    public $idMatricula;
    public $estadoMatricula;
    
    public function ajaxActivarMatricula(){ 

        $tabla = "tbl_matricula";

        $item1 = "estado";
        $valor1 = $this->estadoMatricula;

        $item2 = "id_matricula";
        $valor2 = $this->idMatricula;

        $item3 = null;
        $valor3 = null;

        $item4 = null;
        $valor4 = null;

        $respuesta = ModeloMantenimiento::mdlActualizarMantenimiento($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
        echo json_encode($respuesta);

    }    


}    

/*========================================
    ACTIVAR MATRICULA
==========================================*/ 

if(isset($_POST["idMatricula"])){ 

    $activarMatricula = new AjaxMatricula();
    $activarMatricula->idMatricula = $_POST["idMatricula"];
    $activarMatricula->estadoMatricula = $_POST["estadoMatricula"];
    $activarMatricula->ajaxActivarMatricula();
}  


class AjaxDescuento{

    /*=============================================
            ACTIVAR DESCUENTO
    ==============================================*/
    public $idDescuento;
    public $estadoDescuento;
    
    public function ajaxActivarDescuento(){ 

        $tabla = "tbl_descuento";

        $item1 = "estado";
        $valor1 = $this->estadoDescuento;

        $item2 = "id_descuento";
        $valor2 = $this->idDescuento;

        $item3 = null;
        $valor3 = null;

        $item4 = null;
        $valor4 = null;

        $respuesta = ModeloMantenimiento::mdlActualizarMantenimiento($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
        echo json_encode($respuesta);


        // $respuesta = ModeloMantenimiento::mdlActualizarDescuento($tabla,$item1,$valor1,$item2,$valor2);
        // echo json_encode($respuesta);


    }    

}    

/*========================================
    ACTIVAR DESCUENTO
==========================================*/ 

if(isset($_POST["idDescuento"])){ 

    $activarDescuento = new AjaxDescuento();
    $activarDescuento->idDescuento = $_POST["idDescuento"];
    $activarDescuento->estadoDescuento = $_POST["estadoDescuento"];
    $activarDescuento->ajaxActivarDescuento();
}  

