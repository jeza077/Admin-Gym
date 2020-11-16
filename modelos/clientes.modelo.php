<?php 

class ModeloClientes{
    
    /*=============================================
			CREAR CLIENTES	
	=============================================*/
	 
	static public function mdlCrearCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_persona) VALUES (:id_persona)");

		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);

		if($stmt->execute()){

			return true;	

		}else{

			return false;
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	static public function mdlMostrarClientes($tabla1, $tabla2, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT p.*, c.* FROM $tabla1 AS p\n"
			. " INNER JOIN $tabla2 AS c ON p.id_personas = c.id_persona\n"
			. " WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT p.*, c.* FROM $tabla1 AS p\n"
			. " INNER JOIN $tabla2 AS c ON p.id_personas = c.id_persona\n");
			$stmt -> execute();
			return $stmt -> fetchAll();

		}
		$stmt -> close();
		$stmt = null;	

	}
}