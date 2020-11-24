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

   /*======================================================
     Roles
    =============================================================================================*/
   
    static public function ctrRolesInsertar(){


      if(isset($_POST["nuevoRol"])){

        if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/', $_POST["nuevoRol"])){
         
          
          $tabla = "tbl_roles";
          
  
          $datos = array("rol" => $_POST["nuevoRol"], 
                          "descripcion" => $_POST["nuevaDescripcion"]);

            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
  
          $respuesta = ModeloMantenimiento::mdlInsertarRoles($tabla, $datos);
          
          
          if($respuesta == true){
  
            echo '<script>
  
            Swal.fire({
  
              icon: "success",
              title: "¡El rol ha sido creado exitosamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "roles";
  
              }
  
            });
  
  
            </script>';
  
  
          }
  
  
        }else{
  
          echo '<script>
  
            Swal.fire({
  
              icon: "error",
              title: "¡El rol no puede ir vacío o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "roles";
  
              }
  
            });
  
  
          </script>';
  
        }
  
  
      }
  
     }

      /*=============================================
        MOSTRAR ROLES
    =============================================*/

    static public function ctrMostrarRoles($item, $valor){

    $tabla = "tbl_roles";
    
    $respuesta = ModeloMantenimiento::mdlMostrarRoles($tabla, $item, $valor);

    return $respuesta;

    }



}



  


  





