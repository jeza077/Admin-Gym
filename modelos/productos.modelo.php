<?php
require_once "conexion.php";

class ModeloProductos{
	
    static public function mdlMostrarProductos($tabla, $item, $valor, $all){
        if($item != null && $all != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();

		} else if($item != null && $all == null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			
			$stmt -> execute();
			return $stmt -> fetchAll();

		}

		$stmt -> close();
		$stmt = null;	

	}
	

	/*=============================================
	ACTUALIZAR LOS PRODUCTOS a la venta 
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE  $item2= :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_INT);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_INT);

		if($stmt -> execute()){

			return true;
		
		}else{

			return false;	

		}

		$stmt -> close();

		$stmt = null;

	}

}