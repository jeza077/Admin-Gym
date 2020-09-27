<?php

require_once "conexion.php";

class ModeloGlobales{
    
	  /*=============================================
		  MOSTRAR PARAMETROS
    =============================================*/
    
    static public function mdlMostrarParametros($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt -> execute();
        return $stmt -> fetchAll();
        
		$stmt -> close();
		$stmt = null;	
    }
}