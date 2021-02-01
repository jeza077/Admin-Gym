<?php
require_once "conexion.php";
 
class ModeloMantenimiento{

    /*============================================
    INSERTAR ROLES
	==============================================*/
	static public function mdlInsertarRoles($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(rol, descripcion) VALUES (:rol, :descripcion)");
       
        $stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        /*$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);*/

		if($stmt->execute()){
			return true;

		}else{
			return false;
		
		}

		$stmt->close();
		$stmt = null;
    }


    /*=============================================
    MOSTRAR ROlES
	=============================================*/
		
	static public function mdlMostrarRoles($tabla1, $item, $valor){
	
        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla1 where $item = :$item");		
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla1");		
            
            $stmt->execute();

            return $stmt -> fetchAll();

        }

        $stmt -> close();
        $stmt = null;	



    }

    /*=============================================
    MOSTRAR PERMISOS ROlES
	=============================================*/
		
	static public function mdlMostraPermisosrRoles($item1, $valor1, $item2, $valor2){
	
        if($item1 != null){

            $stmt = Conexion::conectar()->prepare("SELECT r.rol, pe.*, o.objeto FROM tbl_roles AS r \n"
            . "LEFT JOIN tbl_permisos AS pe ON r.id_rol = pe.id_rol\n"
            . "LEFT JOIN tbl_objetos AS o ON pe.id_objeto = o.id_objeto\n"
            . "WHERE pe.$item1 = :$item1 AND pe.$item2 = :$item2");	

            $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
            $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT r.rol, pe.*, o.objeto FROM tbl_roles AS r\n"
            . "LEFT JOIN tbl_permisos AS pe ON r.id_rol = pe.id_rol\n"
            . "LEFT JOIN tbl_objetos AS o ON pe.id_objeto = o.id_objeto");		
            
            $stmt->execute();

            return $stmt -> fetchAll();

        }

        $stmt -> close();
        $stmt = null;	



    }


    /*============================================
    GUARDAR PERMISOS DE ROLES
	==============================================*/
	static public function mdlInsertarPermisosRoles($tabla, $id, $pant, $consulta, $agregar, $actualizar, $eliminar){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_rol, id_objeto, agregar, eliminar, actualizar, consulta) VALUES (:id_rol, :id_objeto, :agregar, :eliminar, :actualizar, :consulta)");
       
        $stmt->bindParam(":id_rol", $id, PDO::PARAM_STR);
        $stmt->bindParam(":id_objeto", $pant, PDO::PARAM_STR);
        $stmt->bindParam(":agregar", $agregar, PDO::PARAM_STR);
        $stmt->bindParam(":eliminar", $eliminar, PDO::PARAM_STR);
        $stmt->bindParam(":actualizar", $actualizar, PDO::PARAM_STR);
        $stmt->bindParam(":consulta", $consulta, PDO::PARAM_STR);
        /*$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);*/

		if($stmt->execute()){
			return true;

		}else{
			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;
    }


    /*====================================================
    Actualizar Rol
    ======================================================*/

    static public function mdlActualizarRol($tabla,$item1,$valor1,$item2,$valor2){
      
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
        
        if($stmt->execute()){
           
            return true;
        
        }else{
           
            return false;
        }

        $stmt->close();
        $stmt = null;
        
    }     



    /*============================================
    INSERTAR INSCRIPCION
	==============================================*/
	static public function mdlInsertarInscripcion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_inscripcion, precio_inscripcion, cantidad_dias) VALUES (:tipo_inscripcion, :precio_inscripcion, :cantidad_dias)");
       
        $stmt->bindParam(":tipo_inscripcion", $datos["inscripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_inscripcion", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad_dias", $datos["dias"], PDO::PARAM_STR);
        

		if($stmt->execute()){
			return true;

		}else{
			return false;
		
		}

		$stmt->close();
		$stmt = null;
    }

    /*=============================================
    MOSTRAR INSCRIPCION
	=============================================*/
		
	static public function mdlMostrarInscripcion($tabla1, $item, $valor){
	
        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla1 where $item = :$item");		
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla1");		
            
            $stmt->execute();

            return $stmt -> fetchAll();

        }

        $stmt -> close();
        $stmt = null;	



    }



    /*====================================================
    Actualizar INSCRIPCION
    ======================================================*/

    static public function mdlActualizarInscripcion($tabla,$item1,$valor1,$item2,$valor2){
      
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
        
        if($stmt->execute()){
           
            return true;
        
        }else{
           
            return false;
        }

        $stmt->close();
        $stmt = null;
        
    }     




    /*============================================
    INSERTAR MATRICULA
	==============================================*/
	static public function mdlInsertarMatricula($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_matricula, precio_matricula) VALUES (:tipo_matricula, :precio_matricula)");
       
        $stmt->bindParam(":tipo_matricula", $datos["matricula"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_matricula", $datos["precio"], PDO::PARAM_STR);
        /*$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);*/

		if($stmt->execute()){
			return true;

		}else{
			return false;
		
		}

		$stmt->close();
		$stmt = null;
    }

    /*=============================================
    MOSTRAR MATRICULA
	=============================================*/
		
	static public function mdlMostrarMatricula($tabla1, $item, $valor){
	
        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla1 where $item = :$item");		
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla1");		
            
            $stmt->execute();

            return $stmt -> fetchAll();

        }

        $stmt -> close();
        $stmt = null;	



    }

    
    /*=============================================
    MOSTRAR MATRICULA
	=============================================*/
		
	static public function mdlMostrarDocumento($tabla, $item, $valor){
	
        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla where $item = :$item");		
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla");		
            
            $stmt->execute();

            return $stmt -> fetchAll();

        }

        $stmt -> close();
        $stmt = null;	



    }


    /*====================================================
    Actualizar MATRICULA
    ======================================================*/

    static public function mdlActualizarMatricula($tabla,$item1,$valor1,$item2,$valor2){
      
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
        
        if($stmt->execute()){
           
            return true;
        
        }else{
           
            return false;
        }

        $stmt->close();
        $stmt = null;
        
    }     



    /*============================================
    DESCUENTO INSERTAR
	==============================================*/
	static public function mdlInsertarDescuento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_descuento, valor_descuento) VALUES (:tipo_descuento, :valor_descuento)");
       
        $stmt->bindParam(":tipo_descuento", $datos["descuento"], PDO::PARAM_STR);
        $stmt->bindParam(":valor_descuento", $datos["valor"], PDO::PARAM_STR);
        /*$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);*/

		if($stmt->execute()){
			return true;

		}else{
			return false;
		
		}

		$stmt->close();
		$stmt = null;
    }

    /*=============================================
    MOSTRAR DESCUENTO
	=============================================*/
		
	static public function mdlMostrarDescuento($tabla1, $item, $valor){
	
        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla1 where $item = :$item");		
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * from $tabla1");		
            
            $stmt->execute();

            return $stmt -> fetchAll();

        }

        $stmt -> close();
        $stmt = null;	



    }


    /*============================================
    NUEVO PROVEEDOR
	==============================================*/
	static public function mdlNuevoProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, correo, telefono) VALUES (:nombre, :correo, :telefono)");
       
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);

		if($stmt->execute()){
			return true;

		}else{
			return false;
		
		}

		$stmt->close();
		$stmt = null;
    }



    /*=============================================
    EDITAR ROLES
    =============================================*/
    
    static public function mdlEditarRol($tabla,$datos){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET rol = :rol, descripcion = :descripcion WHERE id_rol = :id_rol");

        $stmt -> bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_INT);

        if($stmt->execute()){

            return true;

        }else{

            return false;
        
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    EDITAR MATRICULA
    =============================================*/
    
    static public function mdlEditarMatricula($tabla,$datos){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_matricula = :tipo_matricula, precio_matricula = :precio_matricula WHERE id_matricula = :id_matricula");

        $stmt -> bindParam(":tipo_matricula", $datos["tipo_matricula"], PDO::PARAM_STR);
        $stmt -> bindParam(":precio_matricula", $datos["precio_matricula"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_matricula", $datos["id_matricula"], PDO::PARAM_INT);

        if($stmt->execute()){

            return true;

        }else{

            return false;
        
        }

        $stmt->close();
        $stmt = null;
    }


    /*=============================================
    EDITAR INSCRIPCION
    =============================================*/
    
    static public function mdlEditarInscripcion($tabla,$datos){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_inscripcion = :tipo_inscripcion, precio_inscripcion = :precio_inscripcion, cantidad_dias = :cantidad_dias WHERE id_inscripcion = :id_inscripcion");

        $stmt -> bindParam(":tipo_inscripcion", $datos["tipo_inscripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":precio_inscripcion", $datos["precio_inscripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":cantidad_dias", $datos["cantidad_dias"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_inscripcion", $datos["id_inscripcion"], PDO::PARAM_INT);

        if($stmt->execute()){

            return true;

        }else{

            return false;
        
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    EDITAR DESCUENTO
    =============================================*/
    
    static public function mdlEditarDescuento($tabla,$datos){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_descuento = :tipo_descuento, valor_descuento = :valor_descuento WHERE id_descuento = :id_descuento");

        $stmt -> bindParam(":tipo_descuento", $datos["tipo_descuento"], PDO::PARAM_STR);
        $stmt -> bindParam(":valor_descuento", $datos["valor_descuento"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_descuento", $datos["id_descuento"], PDO::PARAM_INT);

        if($stmt->execute()){

            return true;

        }else{

            return false;
        
        }

        $stmt->close();
        $stmt = null;
    }


    /*=============================================
    EDITAR PROVEEDOR
    =============================================*/
    
    static public function mdlEditarProveedor($tabla,$datos){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, correo = :correo, telefono = :telefono WHERE id_proveedor = :id_proveedor");

        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);

        if($stmt->execute()){

            return true;

        }else{

            return false;
        
        }

        $stmt->close();
        $stmt = null;
    }


    /*============================================
    AGREGAR NUEVO DOCUMENTO
	==============================================*/
	static public function mdlDocumentoInsertar($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_documento) VALUES (:tipo_documento)");
       
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        // $stmt->bindParam(":valor_descuento", $datos["valor"], PDO::PARAM_STR);
        /*$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);*/

		if($stmt->execute()){
			return true;

		}else{
			return false;
		
		}

		$stmt->close();
		$stmt = null;
    }


    /*=============================================
    EDITAR DOCUMENTO
    =============================================*/
    
    static public function mdlEditarDocumento($tabla,$datos){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_documento = :tipo_documento WHERE id_documento = :id_documento");

        $stmt -> bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_documento", $datos["id_documento"], PDO::PARAM_INT);
        // $stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

        if($stmt->execute()){

            return true;

        }else{

            return false;
        
        }

        $stmt->close();
        $stmt = null;
    }


    /*=============================================
    BORRAR ROLES
	=============================================*/
	static public function mdlBorrarRoles($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_rol = :id_rol");

		$stmt->bindParam(":id_rol", $datos, PDO::PARAM_INT);

		if($stmt->execute()){

			return true;

		} else {
		
			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;
    }
    

    /*=============================================
    BORRAR MATRICULA
	=============================================*/
	static public function mdlBorrarMatricula($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_matricula = :id_matricula");

		$stmt->bindParam(":id_matricula", $datos, PDO::PARAM_INT);

		if($stmt->execute()){

			return true;

		} else {
		
			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;
    }


    /*=============================================
    BORRAR INSCRIPCION
	=============================================*/
	static public function mdlBorrarInscripcion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_inscripcion = :id_inscripcion");

		$stmt->bindParam(":id_inscripcion", $datos, PDO::PARAM_INT);

		if($stmt->execute()){

			return true;

		} else {
		
			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;
    }
    

    /*=============================================
    BORRAR DESCUENTO
	=============================================*/
	static public function mdlBorrarDescuento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_descuento = :id_descuento");

		$stmt->bindParam(":id_descuento", $datos, PDO::PARAM_INT);

		if($stmt->execute()){

			return true;

		} else {
		
			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;
    }
    

    /*=============================================
    BORRAR DOCUMENTO
	=============================================*/
	static public function mdlBorrarDocumento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_documento = :id_documento");

		$stmt->bindParam(":id_documento", $datos, PDO::PARAM_INT);

		if($stmt->execute()){

			return true;

		} else {
		
			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;
    }
    

    /*=============================================
            BORRAR DINAMICO
	=============================================*/
	static public function mdlBorrarDinamico($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

		if($stmt->execute()){

			return true;

		} else {
		
			return $stmt->errorInfo();

		}

		$stmt->close();

		$stmt = null;
    }
    


    /*=============================================
			RANGO DE FECHAS BITACORA
	=============================================*/
    static public function mdlRangoFechasBitacora($tabla, $fechaInicial, $fechaFinal){

        if($fechaInicial == null){

			$stmt = Conexion::conectar() ->prepare("SELECT b.id_bitacora, u.usuario, o.objeto,b.accion,b.descripcion,b.fecha FROM tbl_bitacora as b \n"
            . "inner join tbl_usuarios as u on b.id_usuario=u.id_usuario\n"
            . "inner join tbl_objetos as o on b.id_objeto =o.id_objeto\n"
			. "ORDER BY id_bitacora DESC");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar() ->prepare("SELECT b.id_bitacora, u.usuario, o.objeto,b.accion,b.descripcion,b.fecha FROM tbl_bitacora as b \n"
            . "inner join tbl_usuarios as u on b.id_usuario=u.id_usuario\n"
            . "inner join tbl_objetos as o on b.id_objeto =o.id_objeto\n"
			. "WHERE fecha LIKE '%$fechaFinal%'");
			$stmt->bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");
			
			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");
			// return $fechaFinalMasUno;

			if($fechaFinalMasUno == $fechaActualMasUno){

				// return 'fecha'.$fechaFinalMasUno;

				$stmt = Conexion::conectar() ->prepare("SELECT b.id_bitacora, u.usuario, o.objeto,b.accion,b.descripcion,b.fecha FROM tbl_bitacora as b \n"
                . "inner join tbl_usuarios as u on b.id_usuario=u.id_usuario\n"
                . "inner join tbl_objetos as o on b.id_objeto =o.id_objeto\n"
				. "WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			} else {

				// return $fechaFinal;

				$stmt = Conexion::conectar() ->prepare("SELECT b.id_bitacora, u.usuario, o.objeto,b.accion,b.descripcion,b.fecha FROM tbl_bitacora as b \n"
                . "inner join tbl_usuarios as u on b.id_usuario=u.id_usuario\n"
                . "inner join tbl_objetos as o on b.id_objeto =o.id_objeto\n"
				. "WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
			
			}
		

            $stmt-> execute();
			return $stmt ->fetchAll();
		}

    }


	/*=============================================
			RANGO DINAMICO
	=============================================*/
	static public function mdlRango($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT b.id_bitacora, u.usuario, o.objeto,b.accion,b.descripcion,b.fecha FROM $tabla AS b\n"
            . "inner join tbl_usuarios as u on b.id_usuario=u.id_usuario\n"
            . "inner join tbl_objetos as o on b.id_objeto =o.id_objeto\n"
			. "ORDER BY id_bitacora DESC");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT b.id_bitacora, u.usuario, o.objeto,b.accion,b.descripcion,b.fecha FROM $tabla AS b\n"
            . "inner join tbl_usuarios as u on b.id_usuario=u.id_usuario\n"
            . "inner join tbl_objetos as o on b.id_objeto =o.id_objeto\n"
			. "WHERE  usuario LIKE '%$rango%' OR fecha LIKE '%$rango%' OR objeto LIKE '%$rango%' OR accion LIKE '%$rango%'");
			$stmt->bindParam(":usuario", $rango, PDO::PARAM_STR);
			$stmt->bindParam(":fecha", $rango, PDO::PARAM_STR);
            $stmt->bindParam(":objeto", $rango, PDO::PARAM_STR);
			$stmt->bindParam(":accion", $rango, PDO::PARAM_STR);
        

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
	}



     /*====================================================
       Actualizar DESCUENTO
    ======================================================*/

    static public function mdlActualizarDescuento($tabla,$item1,$valor1,$item2,$valor2){
      
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
        
        if($stmt->execute()){
           
            return true;
        
        }else{
           
            return false;
        }

        $stmt->close();
        $stmt = null;
        
    }     

   
    
	/*=============================================
	    ACTUALIZAR UNICO O MULTIPLE DINAMICO
	=============================================*/
	static public function mdlActualizarMantenimiento($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4){

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

    
		
}    
