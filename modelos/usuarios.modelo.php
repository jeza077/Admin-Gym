<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*=============================================
		MOSTRAR USUARIOS
	=============================================*/
	
	static public function mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor){

		// if($tabla2 == "empleados"){
	
			if($item != null){
	
				$stmt = Conexion::conectar()->prepare("SELECT p.*, u.Usuario, u.Contraseña, u.Foto_Usuario, u.Codigo, u.Fecha_Recuperacion, u.Estado, u.Primera_Vez, u.Fecha_Vencimiento, u.ID_Usuario AS id_usuario, r.Rol FROM $tabla1 AS p\n"
				. " INNER JOIN $tabla2 AS u ON p.id = u.ID_Persona\n"
				. " INNER JOIN tbl_roles AS r ON u.id_rol = r.id\n"
				. " WHERE $item = :$item");
				
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
	
			} else {
	
				$stmt = Conexion::conectar()->prepare("SELECT p.*, u.Usuario, u.Contraseña, u.Foto_Usuario, u.Primera_Vez, u.ID_Usuario AS id_usuario, r.Rol FROM $tabla1 AS p\n"
						. " INNER JOIN $tabla2 AS u ON p.id = u.ID_Persona\n"
						. " INNER JOIN tbl_roles AS r ON u.id_rol = r.id");
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

		$stmt = Conexion::conectar()->prepare("SELECT u.Usuario, r.Rol, m.nombre_modulo, m.link_modulo, m.icono, sm.sub_modulo, sm.link_sub_modulo FROM usuarios AS u\n"
				. " INNER JOIN tbl_roles AS r ON u.id_rol = r.id\n"
				. " INNER JOIN rol_modulos AS rm ON r.id=rm.rol_id_fk\n"
				. " INNER JOIN modulos AS m ON rm.modulo_id_fk=m.id\n"
				. " INNER JOIN rol_sub_modulo AS rsm ON r.id=rsm.id_rol_fk\n"
				. " INNER JOIN sub_modulos AS sm ON rsm.id_sub_modulo_fk=sm.id AND sm.modulo_id_fk=m.id\n"
				. " WHERE u.$item1 = :$item1 AND r.$item2 = :$item2\n"
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

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
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

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(Id_Persona, Usuario, Contraseña, Foto, Fecha_Vencimiento, ID_Rol) VALUES (:Id_Persona, :Usuario, :Contraseña, :Foto, :Fecha_Vencimiento, :ID_Rol)");

		$stmt->bindParam(":ID_Persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":Usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":Contraseña", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":Foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_Vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":ID_Rol", $datos["rol"], PDO::PARAM_INT);

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

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ID_Usuario, ID_Pregunta, Respuesta) 
												   VALUES (:ID_Usuario, :ID_Pregunta, :Respuesta)");
	
			$stmt->bindParam(":ID_Usuario", $datos["idUsuario"], PDO::PARAM_INT);
			$stmt->bindParam(":ID_Pregunta", $pregunta, PDO::PARAM_INT);
			$stmt->bindParam(":Respuesta", $respuesta, PDO::PARAM_STR);
			
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

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4){

		if($item4 != null) {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1, $item2 = :$item2, $item3 = :$item3 WHERE $item4 = :$item4");
	
			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
			$stmt->bindParam(":".$item3, $valor3, PDO::PARAM_STR);
			$stmt->bindParam(":".$item4, $valor4, PDO::PARAM_STR);

			if($stmt->execute()){
		
					return true;	
		
				}else{
		
					return false;
				
				}

		} else if($item3 != null && $item4 == null) {

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

	static public function mdlActualizarUsuarioPorCodigo($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1, $item2 = :$item2, Token = NULL, Fecha_Recuperacion = NULL, $item3 = :$item3 WHERE $item4 = :$item4");

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_INT);
		$stmt->bindParam(":".$item3, $valor3, PDO::PARAM_STR);
		$stmt->bindParam(":".$item4, $valor4, PDO::PARAM_INT);
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

	static public function mdlMostrarPreguntas($item1, $valor1, $item2, $valor2, $item3, $valor3){

		$stmt = Conexion::conectar()->prepare("SELECT u.Usuario, pr.Pregunta, pu.ID_Pregunta, pu.Respuesta FROM tbl_usuarios AS u "
			. " INNER JOIN tbl_preguntas_usuarios AS pu ON u.ID_Usuario = pu.ID_Usuario\n"
			. " INNER JOIN Preguntas AS pr ON pu.ID_Pregunta = pr.ID_Pregunta\n"
			. "	WHERE $item1 = :$item1 AND $item2 = :$item2 AND $item3 = :$item3");
			
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_INT);
		$stmt -> bindParam(":".$item3, $valor3, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
	}	

	    
	/*=============================================
		MOSTRAR PARAMETROS
    =============================================*/
    
    static public function mdlMostrarParametros($tabla, $item, $valor){
		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT Parametro, Valor FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
		}
        
		$stmt -> close();
		$stmt = null;	
	}
	
	/*============================================
		INSERTAR BITACORA
	==============================================*/
	static public function mdlInsertarBitacora($tabla, $fecha, $usuario, $modulo, $accion, $descripcion){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(Fecha,ID_Usuario, ID_Modulos, accion, descripcion) VALUES ('$fecha', $usuario, $modulo, '$accion', '$descripcion')");

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
	}
		
	/*=============================================
		MOSTRAR BITACORA
	=============================================*/
		
	static public function mdlMostrarBitacora($tabla1, $item, $valor){
	
			if($item != null){
	
				$stmt = Conexion::conectar()->prepare("SELECT * from $tabla1 where $item = :$item");		
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
	
			} else {
	
				$stmt = Conexion::conectar()->prepare("SELECT b.id_bita, u.Usuario, m.nombre_modulo, b.accion, b.descripcion, b.fecha FROM tbl_bitacora as b\n"
				. "INNER JOIN usuarios as u ON b.id_usuario = u.id\n"
				. "INNER JOIN modulos as m ON b.Id_Modulos = m.id order by b.fecha desc");
				$stmt -> execute();
				return $stmt -> fetchAll();
	
			}

		$stmt -> close();
		$stmt = null;	

	}

}