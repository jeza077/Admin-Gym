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
   
    static public function ctrRolesInsertar($rol, $descripcion){
      // return $rol.' '.$descripcion;

      if(isset($rol)){

        if(preg_match('/^[A-ZñÑáéíóúÁÉÍÓÚ ]+$/', $rol)){
         
          // return 'Bien';
          $tabla = "tbl_roles";
  
          $datos = array("rol" => $rol, 
                         "descripcion" => $descripcion);

            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
  
          $respuesta = ModeloMantenimiento::mdlInsertarRoles($tabla, $datos);
          
          // var_dump($respuesta);
          if($respuesta == true){
         
            // $descripcionEvento = "Nuevo rol";
            // $accion = "Nuevo";
            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

            $totalId = array();
            $item = null;
            $valor = null;
            
            $roles = ControladorMantenimientos::ctrMostrarRoles($item,$valor);
            
            foreach($roles as $keyRol => $valueRol){
            array_push($totalId, $valueRol["id_rol"]);
            }

            $idRol = end($totalId);
            // echo $idRol;
            $id = intval($idRol);

            return $id;

             // echo '<script>
    
              // Swal.fire({
    
              //   icon: "success",
              //   title: "¡El rol ha sido creado exitosamente!",
              //   showConfirmButton: true,
              //   confirmButtonText: "Cerrar",
              //   closeOnConfirm: false
    
              // }).then((result)=>{
    
              //   if(result.value){
    
              //     window.location = "mantenimiento";
    
              //   }
    
              // });
    
    
              // </script>';
    
  
          }
  
  
        }else{

          return 'Mal';

  
          echo '<script>
  
            Swal.fire({
  
              icon: "error",
              title: "¡El rol no puede ir vacío o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "rol";
  
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


    /*=============================================
        MOSTRAR PERMISOS ROLES
    =============================================*/

    static public function ctrMostrarPermisosRoles($item, $valor){

      $respuesta = ModeloMantenimiento::mdlMostraPermisosrRoles($item, $valor);

      return $respuesta;

    }



    
    /*=============================================
        GUARDAR PERMISOS DE ROLES
    =============================================*/

    static public function ctrInsertarPermisosRoles($id, $pant, $cons, $agre, $actua, $elim){

      // $datos = array('id' => $id,
      // 'pantalla' => $pant,
      // 'consu' => $cons,
      // 'agre' => $agre,
      // 'actua' => $actua,
      // 'elim' => $elim);
      $idRol = intval($id);
      // return $idRol;

      if(isset($pant)){
        // $consulta = 0;
        // $agregar = 0;
        // $actualizar = 0;
        // $eliminar = 0;

        if($cons != 'true'){
          $consulta = 0;
        } else {
          $consulta = 1;
        }

        if($agre != 'true'){
          $agregar = 0;
        } else {
          $agregar = 1;
        }

        if($actua != 'true'){
          $actualizar = 0;
        } else {
          $actualizar = 1;
        }

        if($elim != 'true'){
          $eliminar = 0;
        } else {
          $eliminar = 1;
        }

        // $datos = array('id' => $idRol,
        //               'pantalla' => $pant,
        //               'consu' => $consulta,
        //               'agre' => $agregar,
        //               'actua' => $actualizar,
        //               'elim' => $eliminar);
        // return $datos;
        $tabla = 'tbl_permisos';
        $respuesta = ModeloMantenimiento::mdlInsertarPermisosRoles($tabla, $idRol, $pant, $consulta, $agregar, $actualizar, $eliminar);
  
        return $respuesta;
      }


    }


    // /*======================================================
    //  Inscripciones Insertar
    // =============================================================================================*/
    static public function ctrInscripcionInsertar(){


      if(isset($_POST["nuevoInscripcion"])){

       



        if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoInscripcion"]) && 
           preg_match('/^[0-9]+$/', $_POST["nuevoPrecio"])&& 
           preg_match('/^[0-9]+$/', $_POST["nuevoDias"])){
         
          
          $tabla = "tbl_inscripcion";
          
  
          $datos = array("inscripcion" => $_POST["nuevoInscripcion"], 
                          "precio" => $_POST["nuevoPrecio"],
                          "dias" => $_POST["nuevoDias"]);

            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
            // return;
  
          $respuesta = ModeloMantenimiento::mdlInsertarInscripcion($tabla, $datos);
          
          // var_dump($respuesta);
          if($respuesta == true){
  
           
            $descripcionEvento = "Nueva Inscripcion del Gimnasio";
            $accion = "Nuevo";
            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

         
       
            echo '<script>
  
            Swal.fire({
  
              icon: "success",
              title: "¡La inscripcion ha sido creado exitosamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "inscripcion";
  
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
  
                window.location = "inscripcion";
  
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
            
            $descripcionEvento = "Nueva Matricula del Gimnasio";
            $accion = "Nuevo";

            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

     
       
  
            echo '<script>
  
            Swal.fire({
  
              icon: "success",
              title: "¡La matricula ha sido creado exitosamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "matricula";
  
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
  
                window.location = "matricula";
  
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
            
            $descripcionEvento = "Nuevo Descuento del Gimnasio";
            $accion = "Nuevo";

            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

        
       
  
            echo '<script>
  
            Swal.fire({
  
              icon: "success",
              title: "¡El descuento ha sido creado exitosamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "descuento";
  
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
  
                window.location = "descuento";
  
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

  /*=============================================
			RANGO DE INSCRIPCION
	=============================================*/

	static public function ctrRangoInscripcion($rango) {

		$tabla1 = "tbl_inscripcion";
		
		$respuesta = ModeloMantenimiento::mdlRangoInscripcion($tabla,$rango);

		return $respuesta;

  }




  /*=============================================
    RANGO DINAMICO
  =============================================*/
	static public function ctrRango($rango){

		$tabla = 'tbl_bitacora';
		
		$respuesta = ModeloMantenimiento::mdlRango($tabla, $rango);
		
		return $respuesta;
	}

}



  


  





