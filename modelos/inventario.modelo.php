<?php

require_once "conexion.php";
class ModeloInventario
{

	
    /*=============================================
		MOSTRAR INVENTARIO/BODEGA
	=============================================*/

    static public function mdlMostrarInventario($tabla1, $tabla2, $item, $valor,$order){
		if ($order != null && $item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT i.*, t.tipo_producto FROM $tabla1 AS i\n"
			. " INNER JOIN $tabla2 AS t ON i.id_tipo_producto = t.id_tipo_producto\n"
			. " WHERE  i.$item = :$item ORDER BY id_inventario DESC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}
		else if($order == null && $item != null){
			$stmt = Conexion::conectar()->prepare("SELECT i.*, t.tipo_producto FROM $tabla1 AS i\n"
			. " INNER JOIN $tabla2 AS t ON i.id_tipo_producto = t.id_tipo_producto\n"
			. " WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT i.id_inventario, t.tipo_producto, i.nombre_producto, i.stock, i.precio, i.producto_minimo, i.producto_maximo, i.codigo FROM tbl_inventario AS i\n"
			. "INNER JOIN tbl_tipo_producto AS t ON id_tipo_producto = id_tipo_producto");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;	
	}


	/*=============================================
			MOSTRAR (DINAMICO)
	=============================================*/

	static public function mdlMostrarTipoProducto($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
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
				CREAR stock
	=============================================*/	 
	static public function mdlCrearStock($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tipo_producto, nombre_producto, stock, precio, producto_minimo, producto_maximo, foto, codigo) VALUES (:id_tipo_producto, :nombre_producto, :stock, :precio, :producto_minimo, :producto_maximo, :foto ,:codigo)");

		$stmt->bindParam(":id_tipo_producto", $datos["id_tipo_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":producto_minimo", $datos["producto_minimo"], PDO::PARAM_INT);
		$stmt->bindParam(":producto_maximo", $datos["producto_maximo"], PDO::PARAM_INT);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}

		$stmt->close();
		
		$stmt = null;

    }
		

	/*=============================================
				editar producto
	=============================================*/	 
	static public function mdlEditarStock($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_producto = :nombre_producto, stock = :stock, precio = :precio, producto_minimo =:producto_minimo, producto_maximo = :producto_maximo, foto = :foto, codigo =:codigo WHERE id_inventario = :id_inventario");

		$stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":producto_minimo", $datos["producto_minimo"], PDO::PARAM_INT);
		$stmt->bindParam(":producto_maximo", $datos["producto_maximo"], PDO::PARAM_INT);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		if($stmt->execute()){
			return true;
		}else{
			return $stmt->errorInfo();
		}

		$stmt->close();
		$stmt = null;

    }



	/*=============================================
				editar Equipo
	=============================================*/	 
	static public function mdlEditarEquipo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_producto = :nombre_producto, stock = :stock, foto = :foto, codigo =:codigo WHERE id_inventario = :id_inventario");

		$stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		if($stmt->execute()){
			return true;
		}else{
			return $stmt->errorInfo();
		}

		$stmt->close();
		$stmt = null;

	}
	
	/*============================================
			MOSTRAR SUMA INVENTARIO
	=============================================*/
	static public function mdlMostrarTotalInventario($tabla1, $tabla2, $item, $valor,$order){
		// if ($order != null && $item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT i.*, t.tipo_producto FROM $tabla1 AS i\n"
			. " INNER JOIN $tabla2 AS t ON i.id_tipo_producto = t.id_tipo_producto\n"
			. " WHERE $item = :$item ORDER BY $order DESC");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt->close();
			$stmt = null;
		// }
	}

	/*=============================================
			MOSTRAR SUMA INVENTARIO
	=============================================*/
	static public function mdlMostrarSumaVentas($tabla){
		// if ($order != null && $item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT SUM(venta) as total FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt->close();
			$stmt = null;
		// }
	}

}


