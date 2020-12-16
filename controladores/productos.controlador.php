<?php

class ControladorProductos {
    //Mostramos la venta 
    static public function ctrMostrarProductos($item, $valor, $all){
    
        $tabla = "tbl_inventario";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $all);
        return $respuesta;    
    }
}

