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
			$stmt = Conexion::conectar()->prepare("SELECT i.*,t.* FROM tbl_inventario AS i\n"
			. "INNER JOIN tbl_tipo_producto AS t ON i.id_tipo_producto = t.id_tipo_producto");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;	
	}


/*=============================================
		MOSTRAR COMPRAS
	=============================================*/






	static public function mdlMostrarCompras($tabla1,$item, $valor){
		if ($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT c.*,i.*,p.nombre FROM $tabla1 AS c\n"
			. " LEFT JOIN tbl_inventario AS i ON c.id_inventario = i.id_inventario\n"
			. " LEFT JOIN tbl_proveedores AS p ON c.id_proveedor = p.id_proveedor\n");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		
	
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT c.*,i.*,p.nombre FROM $tabla1 AS c\n"
			. " LEFT JOIN tbl_inventario AS i ON c.id_inventario = i.id_inventario"
			. " LEFT JOIN tbl_proveedores AS p ON c.id_proveedor = p.id_proveedor");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;	
	}




	/*=============================================
			MOSTRAR TIPOPRODUCTO (DINAMICO)
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
			MOSTRAR PRODUCTO (DINAMICO)
	=============================================*/

	static public function mdlMostrarProducto($tabla, $item, $valor){

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
			MOSTRAR PROveedores (DINAMICO)
	=============================================*/

	static public function mdlMostrarProveedores($tabla, $item, $valor){

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

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tipo_producto, nombre_producto,precio_venta, precio_compra,producto_minimo, producto_maximo, foto, codigo) VALUES (:id_tipo_producto, :nombre_producto,:precio_venta, :precio_compra,:producto_minimo, :producto_maximo, :foto ,:codigo)");

		$stmt->bindParam(":id_tipo_producto", $datos["id_tipo_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		// $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		// $stmt->bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":producto_minimo", $datos["producto_minimo"], PDO::PARAM_INT);
		$stmt->bindParam(":producto_maximo", $datos["producto_maximo"], PDO::PARAM_INT);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		if($stmt->execute()){
			return true;
		}else{
			return $stmt -> errorInfo();
		}

		$stmt->close();
		
		$stmt = null;

	}
	


	/*=============================================
				CREAR bodega
	=============================================*/	 
	static public function mdlCrearBodega($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tipo_producto, nombre_producto,stock, foto, codigo) VALUES (:id_tipo_producto, :nombre_producto,:stock, :foto ,:codigo)");

		$stmt->bindParam(":id_tipo_producto", $datos["id_tipo_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		// $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		// $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		// $stmt->bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);
		// $stmt->bindParam(":producto_minimo", $datos["producto_minimo"], PDO::PARAM_INT);
		// $stmt->bindParam(":producto_maximo", $datos["producto_maximo"], PDO::PARAM_INT);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		if($stmt->execute()){
			return true;
		}else{
			return $stmt -> errorInfo();
		}

		$stmt->close();
		
		$stmt = null;

    }
		

/*=============================================
				CREAR COMPRA
	=============================================*/	 
	static public function mdlCrearCompra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_proveedor,id_inventario,cantidad,precio) VALUES (:id_proveedor, :id_inventario, :cantidad, :precio)");

		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
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

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_producto = :nombre_producto, stock = :stock, precio_venta = :precio_venta, precio_compra = :precio_compra ,producto_minimo =:producto_minimo, producto_maximo = :producto_maximo, foto = :foto, codigo =:codigo WHERE id_inventario = :id_inventario");

		$stmt->bindParam(":id_inventario", $datos["id_inventario"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		// $stmt->bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);
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



	/*=============================================
			RANGO DINAMICO
	=============================================*/
	static public function mdlRangoC($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla AS i\n"
			// . "INNER JOIN tbl_inventario AS t ON i.id_tipo_producto = t.id_tipo_producto\n"
			. "INNER JOIN tbl_tipo_producto AS p ON i.id_tipo_producto = p.id_tipo_producto\n"
			." WHERE tipo_producto ='Productos'"
			. "ORDER BY id_inventario ASC");	
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla AS i\n"
			// . " INNER JOIN tbl_inventario AS t ON i.id_tipo_producto = t.id_tipo_producto\n"
			. "INNER JOIN tbl_tipo_producto AS p ON i.id_tipo_producto = p.id_tipo_producto\n"
			. "WHERE tipo_producto ='Productos' AND nombre_producto LIKE '%$rango%' OR codigo LIKE '%$rango%' OR proveedor LIKE '%$rango%'");
			$stmt->bindParam(":nombre_producto", $rango, PDO::PARAM_STR);
			$stmt->bindParam(":codigo", $rango, PDO::PARAM_STR);
			$stmt->bindParam(":proveedor", $rango, PDO::PARAM_STR);
			

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
	}
}


