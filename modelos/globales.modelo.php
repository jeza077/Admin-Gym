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
			RANGO DINAMICO INSCRIPCION
	=============================================*/
	static public function mdlRangoInscripcion($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla  where inscripcion LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
    }
    

    /*=============================================
			RANGO DINAMICO MATRICULA
	=============================================*/
	static public function mdlRangoMatricula($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla  where matricula LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
    }
    
    /*=============================================
			RANGO DINAMICO DESCUENTO
	=============================================*/
	static public function mdlRangoDescuento($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla  where descuento LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
    }
    
    /*=============================================
			RANGO DINAMICO ROL
	=============================================*/
	static public function mdlRangoRol($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla  where roles LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
    }
    

     /*=============================================
			RANGO DINAMICO PARAMETRO
	=============================================*/
	static public function mdlRangoParametro($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla  where parametross LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
    }
    
    /*=============================================
			RANGO DINAMICO ADMINISTRAR
	=============================================*/
	static public function mdlRangoAdministrar($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla  where administrarrol LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
	}











}