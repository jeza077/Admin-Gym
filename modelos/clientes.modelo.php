<?php 

class ModeloClientes{
    
    /*=============================================
			CREAR CLIENTES	
	=============================================*/
	 
	static public function mdlCrearCliente($tabla, $datos){

		if ($datos['tipo_cliente'] == "Gimnasio"){
	
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_persona, tipo_cliente, id_matricula) VALUES (:id_persona, :tipo_cliente, :id_matricula)");
	
			$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
			$stmt->bindParam(":tipo_cliente", $datos["tipo_cliente"], PDO::PARAM_STR);
			$stmt->bindParam(":id_matricula", $datos["id_matricula"], PDO::PARAM_INT);
			// $stmt->bindParam(":id_inscripcion", $datos["id_inscripcion"], PDO::PARAM_INT);
			// $stmt->bindParam(":id_descuento", $datos["id_descuento"], PDO::PARAM_INT);
	
			if($stmt->execute()){
	
				return true;	
	
			}else{
	
				return false;
			
			}

		} else {

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_persona, tipo_cliente) VALUES (:id_persona, :tipo_cliente)");
	
			$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
			$stmt->bindParam(":tipo_cliente", $datos["tipo_cliente"], PDO::PARAM_STR);
			
	
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
		MOSTRAR CLIENTES
	=============================================*/
	
	static public function mdlMostrarClientes($tabla1, $tabla2, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT p.*, c.*, d.tipo_documento, m.tipo_matricula, m.precio_matricula, pd.tipo_descuento, pd.valor_descuento, i.tipo_inscripcion,i.precio_inscripcion, pc.* FROM $tabla1 as p\n"
			. "LEFT JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
			. "LEFT JOIN tbl_documento as d ON p.id_documento = d.id_documento\n"
			. "LEFT JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
			. "LEFT JOIN tbl_pagos_cliente as pc ON c.id_cliente = pc.id_cliente\n"
			. "LEFT JOIN tbl_inscripcion as i ON pc.id_inscripcion = i.id_inscripcion\n"
			. "LEFT JOIN tbl_descuento as pd ON pc.id_descuento = pd.id_descuento\n"
			. "WHERE $item = :$item"); 

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT p.*, c.*, i.fecha_creacion, i.tipo_inscripcion, pd.tipo_descuento, valor_descuento, pc.* FROM $tabla1 as p\n"
            . "LEFT JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
            . "LEFT JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
			. "LEFT JOIN tbl_pagos_cliente as pc ON c.id_cliente = pc.id_cliente\n"
            . "LEFT JOIN tbl_inscripcion as i ON pc.id_inscripcion = i.id_inscripcion\n"
			. "LEFT JOIN tbl_descuento as pd ON pc.id_descuento = pd.id_descuento\n"
		    . "WHERE p.tipo_persona = 'clientes'");
			
			$stmt -> execute();
			return $stmt -> fetchAll();

		}

		$stmt -> close();
		$stmt = null;	

	}

	/*=============================================
		MOSTRAR CLIENTES SIN PAGO
	=============================================*/
	
	static public function mdlMostrarClientesSinPago($tabla1, $tabla2, $item, $valor){

		// if($item != null){

		// 	$stmt = Conexion::conectar()->prepare("SELECT p.*, c.*, d.tipo_documento, m.tipo_matricula, m.precio_matricula, pd.tipo_descuento, pd.valor_descuento, i.tipo_inscripcion,i.precio_inscripcion, i.fecha_creacion, pc.* FROM $tabla1 as p\n"
		// 	. "LEFT JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
		// 	. "LEFT JOIN tbl_documento as d ON p.id_documento = d.id_documento\n"
		// 	. "LEFT JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
		// 	. "LEFT JOIN tbl_inscripcion as i ON c.id_inscripcion = i.id_inscripcion\n"
		// 	. "LEFT JOIN tbl_descuento as pd ON c.id_descuento = pd.id_descuento\n"
		// 	. "LEFT JOIN tbl_pagos_cliente as pc ON c.id_cliente = pc.id_cliente\n"
		// 	. " WHERE $item = :$item"); 

		// 	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		// 	$stmt -> execute();
		// 	return $stmt -> fetch();

		// } else {

			$stmt = Conexion::conectar()->prepare("SELECT p.*, c.*, m.* FROM $tabla1 as p\n"
            . "LEFT JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
            . "LEFT JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
            // . "LEFT JOIN tbl_inscripcion as i ON c.id_inscripcion = i.id_inscripcion\n"
			// . "LEFT JOIN tbl_descuento as pd ON c.id_descuento = pd.id_descuento\n"
			// . "LEFT JOIN tbl_pagos_cliente as pc ON c.id_cliente = pc.id_cliente\n"
		    . "WHERE p.tipo_persona = 'clientes'");
			
			$stmt -> execute();
			return $stmt -> fetchAll();

		// }

		$stmt -> close();
		$stmt = null;	

	}



	/*=============================================
		MOSTRAR CLIENTES PAGOS
	=============================================*/
	
	static public function mdlMostrarClientesPagos($tabla1, $tabla2, $item, $valor, $max){

		if($max != null){

			$stmt = Conexion::conectar()->prepare("SELECT p.*, c.*, d.tipo_documento, m.tipo_matricula, pd.tipo_descuento, MAX(i.tipo_inscripcion) as tipo_inscripcion, pc.pago_matricula, pc.pago_descuento, pc.pago_inscripcion, pc.pago_total, fecha_ultimo_pago, MAX(pc.fecha_vencimiento) as fecha_vencimiento FROM $tabla1 as p\n"
			. "LEFT JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
			. "LEFT JOIN tbl_documento as d ON p.id_documento = d.id_documento\n"
			. "LEFT JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
			. "LEFT JOIN tbl_pagos_cliente as pc ON c.id_cliente = pc.id_cliente\n"
			. "LEFT JOIN tbl_inscripcion as i ON pc.id_inscripcion = i.id_inscripcion\n"
			. "LEFT JOIN tbl_descuento as pd ON pc.id_descuento = pd.id_descuento\n"
			. "WHERE $item = :$item\n"
			. "GROUP BY c.id_cliente"); 

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();

		} else {

	
			$stmt = Conexion::conectar()->prepare("SELECT p.*, c.*, d.tipo_documento, m.tipo_matricula, pd.tipo_descuento, i.tipo_inscripcion, pc.* FROM $tabla1 as p\n"
			. "LEFT JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
			. "LEFT JOIN tbl_documento as d ON p.id_documento = d.id_documento\n"
			. "LEFT JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
			. "LEFT JOIN tbl_pagos_cliente as pc ON c.id_cliente = pc.id_cliente\n"
			. "LEFT JOIN tbl_inscripcion as i ON pc.id_inscripcion = i.id_inscripcion\n"
			. "LEFT JOIN tbl_descuento as pd ON pc.id_descuento = pd.id_descuento\n"
			. "WHERE $item = :$item"); 

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}

		$stmt -> close();
		$stmt = null;	

	}


	 /*=============================================
		MOSTRAR PAGOS POR CLIENTE
	=============================================*/
	
	static public function mdlMostrarPagoPorCliente($tabla1, $tabla2, $item, $valor){

		// if($max != null){

			$stmt = Conexion::conectar()->prepare("SELECT p.*, c.*, d.tipo_documento, m.tipo_matricula, pd.tipo_descuento, i.tipo_inscripcion, i.precio_inscripcion, pc.pago_matricula, pc.id_descuento, pc.pago_descuento, pc.id_inscripcion, pc.pago_inscripcion, pc.pago_total, pc.fecha_vencimiento FROM $tabla1 as p\n"
			. "LEFT JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
			. "LEFT JOIN tbl_documento as d ON p.id_documento = d.id_documento\n"
			. "LEFT JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
			. "LEFT JOIN tbl_pagos_cliente as pc ON c.id_cliente = pc.id_cliente\n"
			. "LEFT JOIN tbl_inscripcion as i ON pc.id_inscripcion = i.id_inscripcion\n"
			. "LEFT JOIN tbl_descuento as pd ON pc.id_descuento = pd.id_descuento\n"
			. "WHERE $item = :$item\n"
			. "ORDER BY fecha_vencimiento DESC LIMIT 1"); 

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

		// } 
		// else {

	
		// 	$stmt = Conexion::conectar()->prepare("SELECT p.*, c.*, d.tipo_documento, m.tipo_matricula, pd.tipo_descuento, i.tipo_inscripcion, pc.* FROM $tabla1 as p\n"
		// 	. "LEFT JOIN $tabla2 as c ON p.id_personas = c.id_persona\n"
		// 	. "LEFT JOIN tbl_documento as d ON p.id_documento = d.id_documento\n"
		// 	. "LEFT JOIN tbl_matricula as m ON c.id_matricula = m.id_matricula\n"
		// 	. "LEFT JOIN tbl_inscripcion as i ON c.id_inscripcion = i.id_inscripcion\n"
		// 	. "LEFT JOIN tbl_descuento as pd ON c.id_descuento = pd.id_descuento\n"
		// 	. "LEFT JOIN tbl_pagos_cliente as pc ON c.id_cliente = pc.id_cliente\n"
		// 	. "WHERE $item = :$item"); 

		// 	$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		// 	$stmt -> execute();
		// 	return $stmt -> fetchAll();
		// }

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
			EDITAR CLIENTE
	=============================================*/
	 
	static public function mdlEditarCliente($tabla, $datos){

		if ($datos['tipo_cliente'] == "Gimnasio"){
	
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_cliente = :tipo_cliente, id_inscripcion = :id_inscripcion, id_matricula = :id_matricula, id_descuento = :id_descuento WHERE id_persona = :id_persona");
	
			$stmt->bindParam(":tipo_cliente", $datos["tipo_cliente"], PDO::PARAM_STR);
			$stmt->bindParam(":id_inscripcion", $datos["id_inscripcion"], PDO::PARAM_INT);
			$stmt->bindParam(":id_matricula", $datos["id_matricula"], PDO::PARAM_INT);
			$stmt->bindParam(":id_descuento", $datos["id_descuento"], PDO::PARAM_INT);
			$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
	
			if($stmt->execute()){
	
				return true;	
	
			}else{
	
				return false;
			}
			
		} else {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_persona = :id_persona, tipo_cliente = :tipo_cliente WHERE id_persona = :id_persona");
	
			$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
			$stmt->bindParam(":tipo_cliente", $datos["tipo_cliente"], PDO::PARAM_STR);
			
	
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
				ELIMINAR CLIENTES
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_personas = :id_personas");

		$stmt -> bindParam(":id_personas", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return true;
		
		}else{

			return false;	

		}

		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
				REGISTRAR PAGO CLIENTE
	=============================================*/
	static public function mdlCrearPago($tabla3, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla3 (id_cliente, pago_matricula, id_descuento, pago_descuento, id_inscripcion, pago_inscripcion, pago_total, fecha_ultimo_pago, fecha_vencimiento) VALUES (:id_cliente, :pago_matricula, :id_descuento, :pago_descuento, :id_inscripcion, :pago_inscripcion, :pago_total, :fecha_ultimo_pago, :fecha_vencimiento)");

		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":pago_matricula", $datos["pago_matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":id_descuento", $datos["id_descuento"], PDO::PARAM_INT);		
		$stmt->bindParam(":pago_descuento", $datos["pago_descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":id_inscripcion", $datos["id_inscripcion"], PDO::PARAM_INT);
		$stmt->bindParam(":pago_inscripcion", $datos["pago_inscripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":pago_total", $datos["pago_total"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ultimo_pago", $datos["fecha_ultimo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);

		if($stmt->execute()){
			
			return true;	

		}else{

			return $stmt->errorInfo();
		
		}
	}
	/*=============================================
			EDITAR PAGO CLIENTE
	=============================================*/
	static public function mdlEditarPago($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pago_matricula = :pago_matricula, pago_descuento = :pago_descuento, pago_inscripcion = :pago_inscripcion, pago_total = :pago_total WHERE id_cliente = :id_cliente");

		$stmt->bindParam(":pago_matricula", $datos["pago_matricula"], PDO::PARAM_STR);
		$stmt->bindParam(":pago_descuento", $datos["pago_descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":pago_inscripcion", $datos["pago_inscripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":pago_total", $datos["pago_total"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);

		if($stmt->execute()){

			return true;	

		}else{

			return false;
		
		}
	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla1, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla1 SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return true;
		
		}else{

			return false;	

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR PAGO CLIENTE (MANTENIENDO INSCRIPCION)
	=============================================*/

	static public function mdlActualizarPagoCliente($tabla1, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla1(id_cliente, id_inscripcion, pago_inscripcion, pago_total, fecha_ultimo_pago, fecha_vencimiento, creado_por) VALUES(:id_cliente, :id_inscripcion, :pago_inscripcion, :pago_total, :fecha_ultimo_pago, :fecha_vencimiento, :creado_por)");

		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_inscripcion", $datos["id_inscripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":pago_inscripcion", $datos["pago_inscripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":pago_total", $datos["pago_total"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ultimo_pago", $datos["fecha_ultimo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":creado_por", $datos["creado_por"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return true;
		
		}else{

			return $stmt->errorInfo();	

		}

		$stmt -> close();

		$stmt = null;

	}
}