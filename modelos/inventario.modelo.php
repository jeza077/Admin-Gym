<?php

require_once "conexion.php";
class ModeloInventario
{

    /*=============================================
		MOSTRAR INVENTARIO/BODEGA
	=============================================*/

    static public function mdlMostrarInventario($tabla1, $tabla2, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT i.id_inventario, t.tipo_producto, i.nombre_producto,i.stock,i.precio,i.producto_maximo from tbl_inventario as I\n"
			. "INNER JOIN tbl_tipo_producto as t ON id_tiipo_producto = id_tiipo_producto"
			. " WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT i.id_inventario, t.tipo_producto, i.nombre_producto,i.stock,i.precio,i.producto_maximo from tbl_inventario as I
			INNER JOIN tbl_tipo_producto as t ON id_tiipo_producto = id_tiipo_producto
			");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;	
	}
}