<?php
  
  class ControladorMantenimientos {
   /*===========================================================
   BITACORA
   =============================================================*/
    static public function ctrBitacoraInsertar($usuario, $objeto,$accion,$descripcion){

     $tabla = "tbl_bitacora";
     date_default_timezone_set('America/Tegucigalpa');

      $fecha = date('Y-m-d');
     $hora = date('H:i:s'); 

   
     $fechaActual = $fecha.' '.$hora;
   


     $respuesta = ModeloUsuarios::mdlInsertarBitacora($tabla, $fechaActual, $usuario, $objeto, $accion, $descripcion);
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
          
          // var_dump($respuesta);
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
  
                window.location = "mantenimiento";
  
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
  
                window.location = "mantenimiento";
  
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


    // /*======================================================
    //  Inscripciones Insertar
    // =============================================================================================*/
    static public function ctrInscripcionInsertar(){


      if(isset($_POST["nuevoInscripcion"])){

       



        if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoInscripcion"]) && 
           preg_match('/^[0-9]+$/', $_POST["nuevoPrecio"])){
         
          
          $tabla = "tbl_inscripcion";
          
  
          $datos = array("inscripcion" => $_POST["nuevoInscripcion"], 
                          "precio" => $_POST["nuevoPrecio"]);

            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
            // return;
  
          $respuesta = ModeloMantenimiento::mdlInsertarInscripcion($tabla, $datos);
          
          // var_dump($respuesta);
          if($respuesta == true){
  
            echo '<script>
  
            Swal.fire({
  
              icon: "success",
              title: "¡La inscripcion ha sido creado exitosamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "mantenimiento";
  
              }
  
            });
  
  
            </script>';
  
  
          }
  
  
        }else{
  
          echo '<script>
  
            Swal.fire({
  
              icon: "error",
              title: "¡La inscrpcion no puede ir vacío o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "mantenimiento";
  
              }
  
            });
  
  
          </script>';
  
        }
  
  
      }
  
    }

     
      /*=============================================
        MOSTRAR INSCRIPCION
    =============================================*/

    static public function ctrMostrarInscripcion($item, $valor){

      $tabla = "tbl_inscripcion";
      
      $respuesta = ModeloMantenimiento::mdlMostrarInscripcion($tabla, $item, $valor);
  
      return $respuesta;
  
    }





     /*======================================================
     MATRICULA INSERTAR
    =========================================================*/
   
    static public function ctrMatriculaInsertar(){


      if(isset($_POST["nuevoMatricula"])){

        if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/', $_POST["nuevoMatricula"])){
         
          
          $tabla = "tbl_matricula";
          
  
          $datos = array("matricula" => $_POST["nuevoMatricula"], 
                          "precio" => $_POST["nuevoPrecio"]);

            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
  
          $respuesta = ModeloMantenimiento::mdlInsertarMatricula($tabla, $datos);
          
          // var_dump($respuesta);
          if($respuesta == true){
  
            echo '<script>
  
            Swal.fire({
  
              icon: "success",
              title: "¡La matricula ha sido creado exitosamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "mantenimiento";
  
              }
  
            });
  
  
            </script>';
  
  
          }
  
  
        }else{
  
          echo '<script>
  
            Swal.fire({
  
              icon: "error",
              title: "¡La matricula no puede ir vacío o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "mantenimiento";
  
              }
  
            });
  
  
          </script>';
  
        }
  
  
      }
  
    }

      /*=============================================
        MOSTRAR MATRICULA
    =============================================*/

    static public function ctrMostrarMatricula($item, $valor){

    $tabla = "tbl_matricula";
    
    $respuesta = ModeloMantenimiento::mdlMostrarMatricula($tabla, $item, $valor);

    return $respuesta;

    }




    
     /*======================================================
     DESCUENTO INSERTAR
    =======================================================*/
   
    static public function ctrDescuentoInsertar(){


      if(isset($_POST["nuevoDescuento"])){

        if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$/', $_POST["nuevoDescuento"])){
         
          
          $tabla = "tbl_descuento";
          
  
          $datos = array("descuento" => $_POST["nuevoDescuento"], 
                          "valor" => $_POST["nuevoValor"]);

            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
  
          $respuesta = ModeloMantenimiento::mdlInsertarDescuento($tabla, $datos);
          
          // var_dump($respuesta);
          if($respuesta == true){
  
            echo '<script>
  
            Swal.fire({
  
              icon: "success",
              title: "¡El descuento ha sido creado exitosamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "mantenimiento";
  
              }
  
            });
  
  
            </script>';
  
  
          }
  
  
        }else{
  
          echo '<script>
  
            Swal.fire({
  
              icon: "error",
              title: "¡EL descuento no puede ir vacío o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "mantenimiento";
  
              }
  
            });
  
  
          </script>';
  
        }
  
  
      }
  
    }

      /*=============================================
        MOSTRAR DESCUENTO
    =============================================*/

    static public function ctrMostrarDescuento($item, $valor){

    $tabla = "tbl_descuento";
    
    $respuesta = ModeloMantenimiento::mdlMostrarDescuento($tabla, $item, $valor);

    return $respuesta;

    }



	/*=============================================
			RANGO DE FECHAS BITACORA
	=============================================*/

	static public function ctrRangoFechasBitacora($fechaInicial, $fechaFinal) {

		$tabla1 = "tbl_bitacora";
		
		$respuesta = ModeloMantenimiento::mdlRangoFechasBitacora($tabla1, $fechaInicial, $fechaFinal);

		return $respuesta;

  }



}



  


  





