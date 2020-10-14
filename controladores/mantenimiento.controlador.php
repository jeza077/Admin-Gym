<?php
  
  class ControladorMantenimientos {
   /*===========================================================
   BITACORA
   =============================================================*/
    static public function ctrBitacoraInsertar($usuario, $modulo,$accion,$descripcion){

     $tabla = "tbl_bitacora";
     date_default_timezone_set('America/Tegucigalpa');

      $fecha = date('Y-m-d');
     $hora = date('H:i:s'); 

   
     $fechaActual = $fecha.' '.$hora;
   


     $respuesta = ModeloUsuarios::mdlInsertarBitacora($tabla, $fechaActual, $usuario, $modulo, $accion, $descripcion);
    }
  	/*=============================================
				MOSTRAR BITACORA
	=============================================*/

	static public function ctrMostrarBitacora( $item, $valor) {

		$tabla1 = "tbl_bitacora";
		
		$respuesta = ModeloUsuarios::mdlMostrarBitacora($tabla1, $item, $valor);

		return $respuesta;

	}

}


