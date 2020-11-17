<?php

require_once "conexion.php";

class ModeloPersonas{

    /*=============================================
				CREAR PERSONAS	
	=============================================*/	 
	static public function mdlCrearPersona($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, apellidos, id_documento, num_documento, tipo_persona, fecha_nacimiento, sexo, telefono, direccion, correo) VALUES (:nombre, :apellidos, :id_documento, :num_documento, :tipo_persona, :fecha_nacimiento, :sexo, :telefono, :direccion, :correo)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":id_documento", $datos["id_documento"], PDO::PARAM_INT);
		$stmt->bindParam(":num_documento", $datos["numero_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_persona", $datos["tipo_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["email"], PDO::PARAM_STR);

		if($stmt->execute()){

			return true;

		}else{

			return false;
		
		}

		$stmt->close();
		
		$stmt = null;

    }
	
	
    /*=============================================
				MOSTRAR PERSONAS	
	=============================================*/
    static public function mdlMostrarPersonas($tabla){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt -> fetchAll();

        $stmt -> close();
		$stmt = null;	
	}


	/*=============================================
				MOSTRAR 	
	=============================================*/
    static public function mdlMostrarPersona($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT num_documento FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();

        $stmt -> close();
		$stmt = null;	
	}


	/*=============================================
				EDITAR PERSONAS	
	=============================================*/	 
	static public function mdlEditarPersona($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellidos = :apellidos, id_documento = :id_documento, num_documento = :num_documento, tipo_persona = :tipo_persona, fecha_nacimiento = :fecha_nacimiento, sexo = :sexo, telefono = :telefono, direccion = :direccion, correo = :correo WHERE id_personas = :id_personas");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":id_documento", $datos["id_documento"], PDO::PARAM_INT);
		$stmt->bindParam(":num_documento", $datos["numero_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_persona", $datos["tipo_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id_personas", $datos["id_persona"], PDO::PARAM_INT);

		if($stmt->execute()){

			return true;

		}else{

			return false;
		
		}

		$stmt->close();
		
		$stmt = null;

	}
	

	/*=============================================
            BORRAR PERSONAS (USUARIO/CLIENTE)
	=============================================*/
	static public function mdlBorrarPersona($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_personas = :id_personas");

		$stmt->bindParam(":id_personas", $datos, PDO::PARAM_INT);

		if($stmt->execute()){

			return true;

		} else {
		
			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;
	}
}