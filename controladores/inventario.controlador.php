<?php

class ControladorInventario
{
        static public function ctrMostrarInventario($tabla, $item, $valor)
        {
                $tabla1 = "tbl_tipo_producto";
                $tabla2 = $tabla;

                $respuesta = ModeloInventario::mdlMostrarInventario($tabla1, $tabla2, $item, $valor);

                return $respuesta;
        }
}