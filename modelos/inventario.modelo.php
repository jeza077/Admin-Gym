<?php

require_once "conexion.php";
class Modeloinventario
{

    /*=============================================
		MOSTRAR INVENTARIO/BODEGA
	=============================================*/

    static public function mdlMostrarinventario($tabla1, $tabla2, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT i.* FROM $tabla1 AS p\n"
			. " INNER JOIN $tabla2 AS t ON t.id_tiipo_producto = i.id_tiipo_producto\n"
			. " WHERE $item = :$item");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

		} 

		$stmt -> close();
		$stmt = null;	

	}






}