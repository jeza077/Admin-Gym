<?php

class ControladorProductos {
    //Mostramos la venta 
    static public function ctrMostrarProductos($item, $valor){
    
        $tabla = "tbl_inventario";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
        return $respuesta;    
    }
}

