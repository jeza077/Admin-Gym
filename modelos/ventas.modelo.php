<?php

require_once "conexion.php";

class ModeloVentas
{
  /*=============================================
		MOSTRAR ventas
	=============================================*/
    static public function mdlMostrarVentas ($tabla, $item, $valor)
    {
        if ($item != null){

            $stmt= Conexion::conectar() ->prepare("SELECT * FROM $tabla where $item= :$item ORDER BY fecha DESC");
            $stmt -> bindParam(":" .$item, $valor, PDO:: PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetch();

        } else {
            $stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
            $stmt-> execute();
            return $stmt ->fetchAll();
        }
        $stmt -> close();
        $stmt= null;
    }
}