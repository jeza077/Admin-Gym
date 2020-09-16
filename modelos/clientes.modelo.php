<?php 

class ModeloClientes{
    
    /*=============================================
			CREAR CLIENTES	
	=============================================*/
	 
	static public function mdlCrearCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_persona) VALUES (:id_persona)");

		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);

		if($stmt->execute()){

			return true;	

		}else{

			return false;
		
		}

		$stmt->close();
		
		$stmt = null;

	}
}