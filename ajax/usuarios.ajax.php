<?php
 
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{
    /*=============================================
                EDITAR USUARIO
    =============================================*/

    // public $idUsuario;

    // public function ajaxEditarUsuarios(){
    //     $item = "id";
    //     $valor = $this->idUsuario;
    //     $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

    //     echo json_encode($respuesta);

    // }

    /*=============================================
                ACTIVAR USUARIO
    =============================================*/

    // public $activarUsuario;
    // public $activarId; 

    // public function ajaxActivarUsuario(){

    //     $tabla = "usuarios";

    //     $item1 = "estado";
    //     $valor1 = $this->activarUsuario;

    //     $item2 = "id";
    //     $valor2 = $this->activarId;
      
    //     $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

    // }

    /*=============================================
    REVISAR QUE EL USUARIO NO SE REPITA
    =============================================*/
    
    public $validarUsuario;

    public function ajaxValidarUsuario(){

        $tabla = "empleados";
        $item = "usuario";
        $valor = $this->validarUsuario;
        
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($tabla, $item, $valor);

        echo json_encode($respuesta);
    }
    /*=============================================
            REVISAR CORREO
    =============================================*/
    
    public $verificarEmail;

    public function ajaxVerificarEmail(){

        $tabla = "empleados";
        $item = "correo";
        $valor = $this->verificarEmail;
        
        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($tabla, $item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
    MOSTRAR PREGUNTAS DE SEGURIDAD DEL USUARIO
    =============================================*/
    
    public $usuario;
    public $idPregunta;
    public $respuestaPregunta;

    public function ajaxMostrarPreguntas(){

        $item1 = "usuario";
        $valor1 = $this->usuario;
        
        $item2 = "id_pregunta";
        $valor2 = $this->idPregunta;
        
        $item3 = "respuesta";
        $valor3 = $this->respuestaPregunta;

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

        // $item = "usuario";
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

        $item = "id";
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

        $tabla = "empleados";

        $item1 = "bloqueado";
        $valor1 = 1;

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
// if(isset($_POST["idUsuario"])){
//     $editar = new AjaxUsuarios();
//     $editar->idUsuario = $_POST["idUsuario"];
//     $editar->ajaxEditarUsuarios();
// }

/*=============================================
            ACTIVAR USUARIO
=============================================*/
// if(isset($_POST["activarUsuario"])){
//     $activarUsuario = new AjaxUsuarios();
//     $activarUsuario->activarUsuario = $_POST["activarUsuario"];
//     $activarUsuario->activarId = $_POST["activarId"];
//     $activarUsuario->ajaxActivarUsuario();
// }

/*=============================================
    REVISAR QUE EL USUARIO NO SE REPITA
=============================================*/
if(isset($_POST["validarUsuario"])){
    $valUsuario = new AjaxUsuarios();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();
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
    $valUsuario->ajaxMostrarPreguntas();
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