<?php
 
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{
    /*=============================================
                EDITAR USUARIO
    =============================================*/

    public $idPersonaUsuario;

    public function ajaxEditarUsuarios(){
        $tabla = "tbl_usuarios";
        $item = "id_personas";
        $valor = $this->idPersonaUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarSoloUsuarios($tabla, $item, $valor);

        echo json_encode($respuesta);

    }

    /*=============================================
                ACTIVAR USUARIO
    =============================================*/

    public $activarUsuario;
    public $activarId; 

    public function ajaxActivarUsuario(){

        $tabla = "tbl_usuarios";

        $item1 = "estado";
        $valor1 = $this->activarUsuario;

        $item2 = "id_usuario";
        $valor2 = $this->activarId;

        // $item3 = null;
        // $valor3 = null;
        
        // $item4 = null;
        // $valor4 = null;
      
        $respuesta = ControladorUsuarios::ctrActivarUsuario($tabla, $item1, $valor1, $item2, $valor2);

        // echo json_encode($respuesta);

    }

    /*=============================================
    REVISAR QUE EL USUARIO NO SE REPITA
    =============================================*/
    
    public $validarUsuario;

    public function ajaxValidarUsuario(){

        $tabla = "tbl_usuarios";
        $item = "Usuario";
        $valor = $this->validarUsuario;
        
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($tabla, $item, $valor);

        echo json_encode($respuesta);
    }
    
    /*=============================================
    REVISAR QUE LA CONTRASEÑA SEA IGUAL A LA ANTERIOR
    =============================================*/
    
    public $passAnterior;

    public function ajaxPassAnterior(){
        
        $tabla = "tbl_usuarios";
        $item = "password";
        $valor = $this->passAnterior;
        
        $encriptar = crypt($valor, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($tabla, $item, $encriptar);

        echo json_encode($respuesta);
    }


    /*=============================================
            REVISAR CORREO
    =============================================*/ 
    public $verificarEmail;

    public function ajaxVerificarEmail(){

        $tabla = "tbl_usuarios";
        $item = "correo";
        $valor = $this->verificarEmail;
        
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($tabla, $item, $valor);
        // echo "<pre>";
        // var_dump($respuesta);
        // echo "</pre>";
        // return;

        echo json_encode($respuesta);
    }

    /*=============================================
            REVISAR CORREO PROVEEDOR
    =============================================*/
    
    public $verificarEmailProv;

    public function ajaxVerificarEmailProv(){

        $tabla = "tbl_proveedores";
        $item = "correo";
        $valor = $this->verificarEmailProv;
        $all = null;
        
        $respuesta = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);
        // echo "<pre>";
        // var_dump($respuesta);
        // echo "</pre>";
        // return;

        echo json_encode($respuesta);
    }

    /*=============================================
    MOSTRAR PREGUNTAS DE SEGURIDAD DEL USUARIO
    =============================================*/
    
    public $usuario;
    public $idPregunta;
    public $respuestaPregunta;

    public function ajaxMostrarUsuarioPreguntas(){

        $item1 = "usuario";
        $valor1 = $this->usuario;
        
        $item2 = "id_preguntas";
        $valor2 = $this->idPregunta;
        
        $item3 = "respuesta";
        $valor3 = $this->respuestaPregunta;

        $respuesta = ControladorUsuarios::ctrMostrarPreguntas($item1, $valor1, $item2, $valor2, $item3, $valor3);

        echo json_encode($respuesta);
    }
    
    /*=============================================
    MOSTRAR PREGUNTAS DE SEGURIDAD
    =============================================*/
    
    public $idUsuarioPersona;

    public function ajaxMostrarPreguntas(){

        $item1 = "id_usuario";
        $valor1 = $this->idUsuarioPersona;
        
        $item2 = null;
        $valor2 = null;
        
        $item3 = null;
        $valor3 = null;

        $respuesta = ControladorUsuarios::ctrMostrarPreguntas($item1, $valor1, $item2, $valor2, $item3, $valor3);

        echo json_encode($respuesta);
    }

    /*=============================================
    ENVIAR USUARIO PARA ENVIAR CORREO DE RECUPERAR PASSWORD
    =============================================*/
    
    public $idUsua;
    public $correoUsuario;
    public $nombreUsuario;

    public function ajaxEnviarCorreoRecuperacion(){

        // $item = "Usuario";
        $id = $this->idUsua;
        $correo = $this->correoUsuario;
        $nombre = $this->nombreUsuario;

        $respuesta = ControladorUsuarios::ctrEnviarCodigo($id, $nombre, $correo);

        echo json_encode($respuesta);
    }

    /*=============================================
    CAMBIAR CONTRASEÑA POR PREGUNTAS DE SEGURIDAD
    =============================================*/
    public $usuarioId;
    public $cambiarPass;
    public $usuarioIngresado;

    public function ajaxCambiarContraseña(){

        $post = $this->cambiarPass;

        $item = "id_usuario";
        $valor = $this->usuarioId;

        $itemUsuario = "usuario";
        $valorUsuario = $this->usuarioIngresado;
      
        $respuesta = ControladorUsuarios::ctrCambiarContraseña($item, $valor, $itemUsuario, $valorUsuario, $post);

        echo json_encode($respuesta);

    }

    /*=============================================
            ACTUALIZAR USUARIO
    =============================================*/
    public $usua;
    
    public function ajaxActualizarUsuario(){

        $tabla = "tbl_usuarios";

        $item1 = "estado";
        $valor1 = 0;

        $item2 = "usuario";
        $valor2 = $this->usua;

        $item3 = null;
        $valor3 = null;
      
        $respuesta = ControladorUsuarios::ctrActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);

        echo json_encode($respuesta);

    }
    

}

/*=============================================
            EDITAR USUARIO
=============================================*/
if(isset($_POST["idPersonaUsuario"])){
    $editar = new AjaxUsuarios();
    $editar->idPersonaUsuario = $_POST["idPersonaUsuario"];
    $editar->ajaxEditarUsuarios();
}

/*=============================================
            ACTIVAR USUARIO
=============================================*/
if(isset($_POST["activarUsuario"])){
    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario = $_POST["activarUsuario"];
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->ajaxActivarUsuario();
}

/*=============================================
    REVISAR QUE EL USUARIO NO SE REPITA
=============================================*/
if(isset($_POST["validarUsuario"])){
    $valUsuario = new AjaxUsuarios();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();
}

/*=============================================
REVISAR QUE LA CONTRASEÑA SEA IGUAL A LA ANTERIOR
=============================================*/
if(isset($_POST["passAnterior"])){
    $valUsuario = new AjaxUsuarios();
    $valUsuario->passAnterior = $_POST["passAnterior"];
    $valUsuario->ajaxPassAnterior();
}

/*=============================================
    REVISAR CORREO PROVEEDORES
=============================================*/
if(isset($_POST["verificarEmailProv"])){
    $valProv = new AjaxUsuarios();
    $valProv->verificarEmailProv = $_POST["verificarEmailProv"];
    $valProv->ajaxverificarEmailProv();
}

/*=============================================
    REVISAR CORREO
=============================================*/
if(isset($_POST["verificarEmail"])){
    $valUsuario = new AjaxUsuarios();
    $valUsuario->verificarEmail = $_POST["verificarEmail"];
    $valUsuario->ajaxVerificarEmail();
}

/*=============================================
 MOSTRAR PREGUNTAS DE SEGURIDAD DEL USUARIO
=============================================*/
if(isset($_POST["usuario"])){
    $valUsuario = new AjaxUsuarios();
    $valUsuario->usuario = $_POST["usuario"];
    $valUsuario->idPregunta = $_POST["idPregunta"];
    $valUsuario->respuestaPregunta = $_POST["respuestaPregunta"];
    $valUsuario->ajaxMostrarUsuarioPreguntas();
}

/*=============================================
 MOSTRAR PREGUNTAS DE SEGURIDAD
=============================================*/
if(isset($_POST["idUsuarioPersona"])){
    $usuarioPreguntas = new AjaxUsuarios();
    $usuarioPreguntas->idUsuarioPersona = $_POST["idUsuarioPersona"];
    $usuarioPreguntas->ajaxMostrarPreguntas();
}

/*=============================================
ENVIAR USUARIO PARA ENVIAR CORREO DE RECUPERAR PASSWORD
=============================================*/
if(isset($_POST["correoUsuario"])){
    $enviarCorreo = new AjaxUsuarios();
    $enviarCorreo->correoUsuario = $_POST["correoUsuario"];   
    $enviarCorreo->idUsua = $_POST["idUsua"];
    $enviarCorreo->nombreUsuario = $_POST["nombreUsuario"];
    $enviarCorreo->ajaxEnviarCorreoRecuperacion();
}
/*=============================================
CAMBIAR CONTRASEÑA POR PREGUNTAS DE SEGURIDAD
=============================================*/
if(isset($_POST["usuarioId"])){
    $cambiarContraseña = new AjaxUsuarios();
    $cambiarContraseña->usuarioId = $_POST["usuarioId"];
    $cambiarContraseña->usuarioIngresado = $_POST["usuarioIngresado"];
    $cambiarContraseña->cambiarPass = $_POST["cambiarPass"];
    $cambiarContraseña->ajaxCambiarContraseña();
}
/*=============================================
        ACTUALIZAR USUARIO
=============================================*/
if(isset($_POST["usua"])){
    $actualizarUsuario = new AjaxUsuarios();
    $actualizarUsuario->usua = $_POST["usua"];
    $actualizarUsuario->ajaxActualizarUsuario();
}