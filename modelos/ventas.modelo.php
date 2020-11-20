<?php

require_once "conexion.php";

class ModeloVentas
{
  /*=============================================
		MOSTRAR ventas
	=============================================*/
    static public function mdlMostrarVentas($tabla, $item, $valor)
    {
        if ($item != null){

            $stmt= Conexion::conectar() ->prepare("SELECT * FROM $tabla WHERE $item= :$item ORDER BY fecha DESC");
            $stmt -> bindParam(":" .$item, $valor, PDO:: PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetch();

        } else {
            $stmt = Conexion::conectar() ->prepare("SELECT * FROM $tabla");
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

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_usuario, productos, impuesto, neto, total) VALUES (:codigo, :id_cliente, :id_usuario, :productos, :impuesto, :neto, :total)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_vendedor"], PDO::PARAM_INT);
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

}