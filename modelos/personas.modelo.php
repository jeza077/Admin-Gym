<?php

class ModeloPersonas{

    /*=============================================
				CREAR PERSONAS	
	=============================================*/	 
	static public function mdlCrearPersona($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(Nombre, Apellidos, Num_Documento, Tipo_Persona, Fecha_Nacimiento, Sexo, Telefono, Direccion, Correo, ID_Documento) VALUES (:Nombre, :Apellidos, :Num_Documento, :Tipo_Persona, :Fecha_Nacimiento, :Sexo, :Telefono, :Direccion, :Correo, :ID_Documento)");

		$stmt->bindParam(":Nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":Apellidos", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":Num_Documento", $datos["numero_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":Tipo_Persona", $datos["tipo_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_Nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":Sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":Telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":Direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":Correo", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":ID_Documento", $datos["id_documento"], PDO::PARAM_STR);

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