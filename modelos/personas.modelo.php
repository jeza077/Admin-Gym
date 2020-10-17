<?php

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
}