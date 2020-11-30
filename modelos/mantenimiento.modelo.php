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

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tipo_inscripcion, precio_inscripcion) VALUES (:tipo_inscripcion, :precio_inscripcion)");
       
        $stmt->bindParam(":tipo_inscripcion", $datos["inscripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_inscripcion", $datos["precio"], PDO::PARAM_STR);
        

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


    

    


		
}    
