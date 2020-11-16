<?php

class ControladorClientes{

    static public function ctrCrearCliente($datos){

        if(isset($datos['id_persona'])){

            $tabla = "tbl_clientes";
							
            $datos = array("id_persona" => $datos['id_persona']);

            $respuestaCliente = ModeloClientes::mdlCrearCliente($tabla, $datos);

            if($respuestaCliente = true){
                        
                return true;

            } else {
                return false;
            }
        }

    }

    static public function ctrMostrarClientes($tabla, $item, $valor){
    
        $tabla1 = "tbl_personas";
        $tabla2 = $tabla;
        $respuesta = ModeloClientes::mdlMostrarClientes($tabla1, $tabla2, $item, $valor);
        return $respuesta;   
    }
}

