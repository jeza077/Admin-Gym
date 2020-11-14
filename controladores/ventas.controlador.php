<?php

class ControladorVentas {
    //Mostramos la venta 
    static public function ctrMostrarVentas($item, $valor){
    
        $tabla = "ventas";
        $respuesta = ModeloVentas::mdlMostrarVentas ($tabla, $item, $valor);
        return $respuesta;    
    }
}