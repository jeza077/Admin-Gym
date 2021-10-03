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

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla WHERE tipo_inscripcion LIKE '%$rango%' OR precio_inscripcion LIKE '%$rango%' OR cantidad_dias LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
    }

    /*=============================================
			RANGO DINAMICO PROVEEDOR
	=============================================*/
	static public function mdlRangoObjetos($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla WHERE objeto LIKE '%$rango%' OR link_objeto LIKE '%$rango%' OR icono LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
    }
    
    /*=============================================
			RANGO DINAMICO PROVEEDOR
	=============================================*/
	static public function mdlRangoProveedor($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla WHERE nombre LIKE '%$rango%' OR correo LIKE '%$rango%' OR telefono LIKE '%$rango%'");

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

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla WHERE tipo_matricula LIKE '%$rango%' OR precio_matricula LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
    }

    /*=============================================
			RANGO DINAMICO DOCUMENTO
	=============================================*/
	static public function mdlRangoDocumento($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla WHERE tipo_documento LIKE '%$rango%'");

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

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla  WHERE tipo_descuento LIKE '%$rango%' OR valor_descuento LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
    }

		/*=============================================
			RANGO DINAMICO DOCUMENTO
	=============================================*/
	static public function mdlRangoGenero($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla WHERE sexo LIKE '%$rango%'");

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

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla  WHERE rol LIKE '%$rango%' OR descripcion LIKE '%$rango%'");

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

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla WHERE parametro LIKE '%$rango%' OR valor LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
    }
    
    /*=============================================
			RANGO DINAMICO ADMINISTRAR
	=============================================*/
	static public function mdlRangoPermisosRol($tabla, $rango){
	
		if($rango == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla AS pr\n"
			. " LEFT JOIN tbl_roles AS r ON pr.id_rol = r.id_rol\n"
			. " LEFT JOIN tbl_objetos AS o ON pr.id_objeto = o.id_objeto");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else {

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla AS pr\n"
			. " LEFT JOIN tbl_roles AS r ON pr.id_rol = r.id_rol\n" 
			. " LEFT JOIN tbl_objetos AS o ON pr.id_objeto = o.id_objeto\n"
			. " WHERE rol LIKE '%$rango%' OR objeto LIKE '%$rango%'");

            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} 	
	}











}