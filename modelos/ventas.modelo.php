<?php

require_once "conexion.php";

class ModeloVentas
{
  /*=============================================
		MOSTRAR ventas
	=============================================*/
    static public function mdlMostrarVentas($tabla, $item, $valor) {
        if ($item != null){

            $stmt= Conexion::conectar() ->prepare("SELECT v.*, p.nombre, p.apellidos FROM tbl_venta AS v\n"
			. "INNER JOIN tbl_clientes AS c ON v.id_cliente = c.id_cliente\n"
			. "INNER JOIN tbl_personas AS p ON c.id_persona = p.id_personas\n"
			. "WHERE $item=:$item");
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetch();

        } else {
            $stmt = Conexion::conectar() ->prepare("SELECT v.*, p.nombre, p.apellidos FROM tbl_venta AS v\n"
			. "INNER JOIN tbl_clientes AS c ON v.id_cliente = c.id_cliente\n"
			. "INNER JOIN tbl_personas AS p ON c.id_persona = p.id_personas\n"
			);
            $stmt-> execute();
            return $stmt ->fetchAll();
        }
        $stmt -> close();
        $stmt= null;
    }

    /*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cliente, id_usuario, numero_factura, productos, impuesto, neto, total) VALUES (:id_cliente, :id_usuario, :numero_factura, :productos, :impuesto, :neto, :total)");

		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":numero_factura", $datos["numero_factura"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

		if($stmt->execute()){

			return true;

		}else{

			// return false;
			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
			SUMA TOTAL VENTAS
    =============================================*/
	static public function mdlSumarTotalVentas($tabla){
		
		$stmt = Conexion::conectar() ->prepare("SELECT SUM(neto) as total FROM $tabla");
		$stmt-> execute();
		return $stmt ->fetchAll();
		
		$stmt -> close();
		$stmt= null;
	}


	/*=============================================
			RANGO DE FECHAS
	=============================================*/
	static public function mdlRangoFechaVentas($tabla, $fechaInicial, $fechaFinal){
	
		if($fechaInicial == null){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla AS v\n"
			. "INNER JOIN tbl_clientes AS c ON v.id_cliente = c.id_cliente\n"
			. "INNER JOIN tbl_personas AS p ON c.id_persona = p.id_personas\n"
			. "ORDER BY id_venta ASC");
            $stmt-> execute();
			return $stmt ->fetchAll();
			
		} else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla AS v\n"
			. "INNER JOIN tbl_clientes AS c ON v.id_cliente = c.id_cliente\n"
			. "INNER JOIN tbl_personas AS p ON c.id_persona = p.id_personas\n"
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

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla  AS v\n"
				. "INNER JOIN tbl_clientes AS c ON v.id_cliente = c.id_cliente\n"
				. "INNER JOIN tbl_personas AS p ON c.id_persona = p.id_personas\n"
				. "WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			} else {

				$stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla  AS v\n"
				. "INNER JOIN tbl_clientes AS c ON v.id_cliente = c.id_cliente\n"
				. "INNER JOIN tbl_personas AS p ON c.id_persona = p.id_personas\n"
				. "WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
			
			}
		

            $stmt-> execute();
			return $stmt ->fetchAll();
		}
	}

}