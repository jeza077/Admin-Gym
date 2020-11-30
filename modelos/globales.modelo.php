<?php

require_once "conexion.php";

class ModeloGlobales{
    
	  /*=============================================
		  MOSTRAR PARAMETROS
    =============================================*/
    
    static public function mdlMostrarParametros($tabla, $item, $valor){
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
		  EDITAR PARAMETROS
    =============================================*/
    
    static public function mdlEditarParametro($tabla,$datos){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET valor = :valor WHERE id_parametro = :id_parametro");

        $stmt -> bindParam(":valor", $datos["valor"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_parametro", $datos["id_parametro"], PDO::PARAM_INT);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        
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




}