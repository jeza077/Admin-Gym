<?php

class ControladorClientes{

    static public function ctrCrearCliente($datos){

        if(isset($datos['id_persona'])){

            $tabla = "clientes";
							
            $datos = array("id_persona" => $datos['id_persona']);

            $respuestaCliente = ModeloClientes::mdlCrearCliente($tabla, $datos);

            if($respuestaCliente = true){
                        
                return true;

            } else {
                return false;
            }
        }

    }
}

