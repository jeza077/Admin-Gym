<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*=============================================
		MOSTRAR USUARIOS
	=============================================*/
	
	static public function mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor){

		if($tabla2 == "empleados"){
	
			if($item != null){
	
				$stmt = Conexion::conectar()->prepare("SELECT p.*, e.usuario, e.password, e.foto, e.id AS id_usuario, r.rol FROM $tabla1 AS p\n"
						. " INNER JOIN $tabla2 AS e ON p.id = e.id_persona\n"
						. " INNER JOIN roles AS r ON e.id_rol = r.id"
						. " WHERE $item = :$item");
						
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
	
			} else {
	
				$stmt = Conexion::conectar()->prepare("SELECT p.*, e.usuario, e.password, e.foto, e.id AS id_usuario, r.rol FROM $tabla1 AS p\n"
						. " INNER JOIN $tabla2 AS e ON p.id = e.id_persona\n"
						. " INNER JOIN roles AS r ON e.id_rol = r.id");
				$stmt -> execute();
				return $stmt -> fetchAll();
	
			}
		} else if ($tabla2 == null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla1");
			$stmt -> execute();
			return $stmt -> fetchAll();

		}

		$stmt -> close();
		$stmt = null;	

	}

	/*=============================================
		MOSTRAR USUARIOS-ROLES-MODULO
	=============================================*/
	
	static public function mdlMostrarUsuarioModulo($item1, $item2, $valor1, $valor2){

		$stmt = Conexion::conectar()->prepare("SELECT e.usuario, r.rol, m.nombre_modulo, m.link_modulo, m.icono FROM empleados AS e\n"
				. " INNER JOIN roles AS r ON e.id_rol = r.id\n"
				. " INNER JOIN rol_modulos AS rm ON r.id=rm.rol_id_fk\n"
				. " INNER JOIN modulos AS m ON rm.modulo_id_fk=m.id\n"
				. " WHERE e.$item1 = :$item1 AND r.$item2 = :$item2");
				
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();

		$stmt -> close();
		$stmt = null;	

	}

	/*=============================================
		MOSTRAR ROLES
	=============================================*/

	static public function mdlMostrarRoles($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
			$stmt -> execute();
			return $stmt -> fetchAll();

		}

		$stmt -> close();
		$stmt = null;
		
	} 

	
	/*=============================================
				INGRESAR PERSONAS	
	=============================================*/
	 
	static public function mdlIngresarPersona($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, apellidos, identidad, fecha_nacimiento, sexo, telefono, direccion, correo) VALUES (:nombre, :apellidos, :identidad, :fecha_nacimiento, :sexo, :telefono, :direccion, :correo)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $datos["apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":identidad", $datos["identidad"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["email"], PDO::PARAM_STR);
		// $stmt->bindParam(":tipo_persona", $datos["tipo_persona"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
			INGRESAR USUARIOS EMPLEADOS	
	=============================================*/
	 
	static public function mdlIngresarUsuarioEmpleado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_persona, usuario, password, foto, id_rol) VALUES (:id_persona, :usuario, :password, :foto, :id_rol)");

		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_rol", $datos["rol"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
			INGRESAR CLIENTES	
	=============================================*/
	 
	static public function mdlIngresarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_persona) VALUES (:id_persona)");

		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
				ACTUALIZAR USUARIOS	
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;
	}

}