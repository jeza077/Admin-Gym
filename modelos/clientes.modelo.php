<?php 

class ModeloClientes{
    
    /*=============================================
			CREAR CLIENTES	
	=============================================*/
	 
	static public function mdlCrearCliente($tabla, $datos){

		if ($datos['tipo_cliente'] == "Gimnasio"){
	
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_persona, tipo_cliente, id_inscripcion, id_matricula, id_descuentos_promociones) VALUES (:id_persona, :tipo_cliente, :id_inscripcion, :id_matricula, :id_descuentos_promociones)");
	
			$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
			$stmt->bindParam(":tipo_cliente", $datos["tipo_cliente"], PDO::PARAM_STR);
			$stmt->bindParam(":id_inscripcion", $datos["id_inscripcion"], PDO::PARAM_INT);
			$stmt->bindParam(":id_matricula", $datos["id_matricula"], PDO::PARAM_INT);
			$stmt->bindParam(":id_descuentos_promociones", $datos["id_descuentos_promociones"], PDO::PARAM_INT);
	
			if($stmt->execute()){
	
				return true;	
	
			}else{
	
				return false;
			
			}

		} else {

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_persona, tipo_cliente) VALUES (:id_persona, :tipo_cliente)");
	
			$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
			$stmt->bindParam(":tipo_cliente", $datos["tipo_cliente"], PDO::PARAM_STR);
			
	
			if($stmt->execute()){
	
				return true;	
	
			}else{
	
				return false;
			
			}
		}

		$stmt->close();
		
		$stmt = null;

	}

    /*=============================================
		MOSTRAR CLIENTES
	=============================================*/
	
	static public function mdlMostrarClientes($tabla1, $tabla2, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT p.*, c.*, m.tipo_matricula, m.precio_matricula, pd.tipo_descuento, pd.valor_descuento, i.tipo_inscripcion, i.precio_inscripcion, i.fecha_creacion FROM $tabla1 as p\n"
			. "LEFT JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
			. "LEFT JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
			. "LEFT JOIN tbl_inscripcion as i ON c.id_inscripcion = i.id_inscripcion\n"
			. "LEFT JOIN tbl_descuento as pd ON c.id_descuento = pd.id_descuento\n"
			. " WHERE $item = :$item"); 

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

		} else {

			$stmt = Conexion::conectar()->prepare( "SELECT p.*, c.*, i.fecha_creacion, i.tipo_inscripcion FROM $tabla1 as p\n"
            . "LEFT JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
            . "LEFT JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
            . "LEFT JOIN tbl_inscripcion as i ON c.id_inscripcion = i.id_inscripcion\n"
			. "LEFT JOIN tbl_descuento as pd ON c.id_descuento = pd.id_descuento\n"
		    . "WHERE p.tipo_persona = 'clientes' ");
			
			$stmt -> execute();
			return $stmt -> fetchAll();

		}

		$stmt -> close();
		$stmt = null;	

	}

	/*=============================================
			MOSTRAR (DINAMICO)
	=============================================*/

	static public function mdlMostrar($tabla, $item, $valor){

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
				ELIMINAR CLIENTES
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_personas = :id_personas");

		$stmt -> bindParam(":id_personas", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	// static public function mdlMostrarClientes($tabla1, $tabla2, $item, $valor){

	// 	if($item != null){

	// 		$stmt = Conexion::conectar()->prepare("SELECT p.*, c.* FROM $tabla1 AS p\n"
	// 		. " INNER JOIN $tabla2 AS c ON p.id_personas = c.id_persona\n"
	// 		. " WHERE $item = :$item");
	// 		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
	// 		$stmt -> execute();
	// 		return $stmt -> fetch();

	// 	} else {

	// 		$stmt = Conexion::conectar()->prepare("SELECT p.*, c.* FROM $tabla1 AS p\n"
	// 		. " INNER JOIN $tabla2 AS c ON p.id_personas = c.id_persona\n");
	// 		$stmt -> execute();
	// 		return $stmt -> fetchAll();

	// 	}
	// 	$stmt -> close();
	// 	$stmt = null;	

	// }

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla1, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla1 SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return true;
		
		}else{

			return false;	

		}

		$stmt -> close();

		$stmt = null;

	}
}