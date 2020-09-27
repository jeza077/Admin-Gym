<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*=============================================
		MOSTRAR USUARIOS
	=============================================*/
	
	static public function mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor){

		// if($tabla2 == "empleados"){
	
			if($item != null){
	
				$stmt = Conexion::conectar()->prepare("SELECT p.*, e.usuario, e.password, e.foto, e.codigo, e.fecha_recuperacion, e.estado, e.primera_vez, e.id AS id_usuario, r.rol FROM $tabla1 AS p\n"
						. " INNER JOIN $tabla2 AS e ON p.id = e.id_persona\n"
						. " INNER JOIN roles AS r ON e.id_rol = r.id\n"
						. " WHERE $item = :$item");
						
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
	
			} else {
	
				$stmt = Conexion::conectar()->prepare("SELECT p.*, e.usuario, e.password, e.foto, e.primera_vez, e.id AS id_usuario, r.rol FROM $tabla1 AS p\n"
						. " INNER JOIN $tabla2 AS e ON p.id = e.id_persona\n"
						. " INNER JOIN roles AS r ON e.id_rol = r.id");
				$stmt -> execute();
				return $stmt -> fetchAll();
	
			}

		// } else if ($tabla2 == null) {

		// 	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla1");
		// 	$stmt -> execute();
		// 	return $stmt -> fetchAll();

		// }

		$stmt -> close();
		$stmt = null;	

	}

	/*=============================================
		MOSTRAR USUARIOS-ROLES-MODULO
	=============================================*/
	
	static public function mdlMostrarUsuarioModulo($item1, $item2, $valor1, $valor2){

		$stmt = Conexion::conectar()->prepare("SELECT e.usuario, r.rol, m.nombre_modulo, m.link_modulo, m.icono, sm.sub_modulo, sm.link_sub_modulo FROM empleados AS e\n"
				. " INNER JOIN roles AS r ON e.id_rol = r.id\n"
				. " INNER JOIN rol_modulos AS rm ON r.id=rm.rol_id_fk\n"
				. " INNER JOIN modulos AS m ON rm.modulo_id_fk=m.id\n"
				. " INNER JOIN rol_sub_modulo AS rsm ON r.id=rsm.id_rol_fk\n"
				. " INNER JOIN sub_modulos AS sm ON rsm.id_sub_modulo_fk=sm.id AND sm.modulo_id_fk=m.id\n"
				. " WHERE e.$item1 = :$item1 AND r.$item2 = :$item2\n"
				. " ORDER BY m.id");
				
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();

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

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
			$stmt -> execute();
			return $stmt -> fetchAll();

		}

		$stmt -> close();
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

			return true;	

		}else{

			return false;
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	INGRESAR PREGUNTAS DE SEGURIDAD USUARIO-EMPLEADO	
	=============================================*/
	 
	static public function mdlIngresarPreguntaUsuario($tabla, $datos){

		$preguntas = $datos['idPregunta'];
		$respuestas = $datos['respuesta'];

		while(true) {

			$fin = false;
			
			$pregunta = current($preguntas);
			$respuesta = current($respuestas);

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_usuario, id_pregunta, respuesta) 
												   VALUES (:id_usuario, :id_pregunta, :respuesta)");
	
			$stmt->bindParam(":id_usuario", $datos["idUsuario"], PDO::PARAM_INT);
			$stmt->bindParam(":id_pregunta", $pregunta, PDO::PARAM_INT);
			$stmt->bindParam(":respuesta", $respuesta, PDO::PARAM_STR);
			
			$stmt->execute();

			$pregunta = next($preguntas);
			$respuesta = next($respuestas);
			

			if($pregunta === false && $respuesta === false){
				$fin = true;
				break;
			}
		}

		if($fin == true){

			return true;	

		}else{

			return false;
		
		}

		$stmt->close();
		
		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR USUARIOS	(tambien contraseña por preguntas)
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){

		if($item3 != null) {
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1, $item2 = :$item2 WHERE $item3 = :$item3");
	
			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
			$stmt->bindParam(":".$item3, $valor3, PDO::PARAM_STR);
			if($stmt->execute()){
		
					return true;	
		
				}else{
		
					return false;
				
				}
		} else {
			
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
	
			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
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
		CAMBIAR CONTRASEÑA POR CODIGO-CORREO
	=============================================*/

	static public function mdlActualizarUsuarioPorCodigo($tabla, $item1, $valor1, $item2, $valor2){

	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1, codigo = NULL, fecha_recuperacion = NULL WHERE $item2 = :$item2");

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_INT);
		if($stmt->execute()){

			return true;	

		}else{

			return false;
		
		}
		


		$stmt->close();
		
		$stmt = null;
	}

	/*=============================================
                MOSTRAR PREGUNTAS
	=============================================*/	

	static public function mdlMostrarPreguntas($item, $valor){

		$stmt = Conexion::conectar()->prepare(
	
			"SELECT e.usuario, pr.pregunta, up.respuesta FROM empleados AS e "
			. " INNER JOIN usuario_pregunta AS up ON e.id = up.id_usuario\n"
			. " INNER JOIN preguntas AS pr ON up.id_pregunta = pr.id\n"
			. "	WHERE $item = :$item");
			
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
	}	

	    
	/*=============================================
		MOSTRAR USUARIOS
    =============================================*/
    
    static public function mdlMostrarParametros($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt -> fetchAll();
        
		$stmt -> close();
		$stmt = null;	
    }
}