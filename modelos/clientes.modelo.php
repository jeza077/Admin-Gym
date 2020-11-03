<?php 

class ModeloClientes{
    
    /*=============================================
			CREAR CLIENTES	
	=============================================*/
	 
	static public function mdlCrearCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_persona, id_inscripcion, id_matricula, id_descuentos_promociones) VALUES (:id_persona, :id_inscripcion, :id_matricula, :id_descuentos_promociones)");

		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":id_inscripcion", $datos["id_inscripcion"], PDO::PARAM_INT);
		$stmt->bindParam(":id_matricula", $datos["id_matricula"], PDO::PARAM_INT);
		$stmt->bindParam(":id_descuentos_promociones", $datos["id_descuentos_promociones"], PDO::PARAM_INT);

		if($stmt->execute()){

			return true;	

		}else{

			return false;
		
		}

		$stmt->close();
		
		$stmt = null;

	}

    /*=============================================
		MOSTRAR CLIENTES
	=============================================*/
	
	static public function mdlMostrarClientes($tabla1, $tabla2, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT p.nombre, p.telefono, p.correo, m.tipo_matricula, m.precio_matricula, pd.tipo_promociones_descuentos, pd.valor_promociones_descuentos, i.tipo_inscripcion,i.precio_inscripcion, i.fecha_creacion  FROM $tabla1 as p\n"
			. "INNER JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
			. "INNER JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
			. "INNER JOIN tbl_inscripcion as i ON c.id_inscripcion = i.id_inscripcion\n"
			. "INNER JOIN tbl_promociones_descuentos as pd ON c.id_descuentos_promociones = pd.id_promociones_descuentos\n"
			. " WHERE $item = :$item");

			// $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

		} else {

			$stmt = Conexion::conectar()->prepare( "SELECT p.nombre,  p.correo, p.telefono, i.fecha_creacion FROM $tabla1 as p\n"
            . "INNER JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
            . "INNER JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
            . "INNER JOIN tbl_inscripcion as i ON c.id_inscripcion = i.id_inscripcion\n"
			. "INNER JOIN tbl_promociones_descuentos as pd ON c.id_descuentos_promociones = pd.id_promociones_descuentos");
			
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
}