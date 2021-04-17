<?php
  
class ControladorMantenimientos {
    /*===========================================================
    BITACORA
    =============================================================*/
    static public function ctrBitacoraInsertar($usuario, $objeto, $accion, $descripcion){

      $tabla = "tbl_bitacora";
      date_default_timezone_set('America/Tegucigalpa');

      $fecha = date('Y-m-d');
      $hora = date('H:i:s'); 
   
      $fechaActual = $fecha.' '.$hora;

      $respuesta = ModeloUsuarios::mdlInsertarBitacora($tabla, $fechaActual, $usuario, $objeto, $accion, $descripcion);

      return $respuesta;
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
    INSERTAR ROLES
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
          // return $datos;
          
          $respuesta = ModeloMantenimiento::mdlInsertarRoles($tabla, $datos);
          
          // return $respuesta;
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

    static public function ctrMostrarPermisosRoles($item1, $valor1, $item2, $valor2){

      $respuesta = ModeloMantenimiento::mdlMostraPermisosrRoles($item1, $valor1, $item2, $valor2);

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

        $item1 = 'id_rol';
        $valor1 = $idRol;
        $item2 = 'id_objeto';
        $valor2 = $pant;
        
        $respuesta = ModeloMantenimiento::mdlMostraPermisosrRoles($item1, $valor1, $item2, $valor2);
        
        if($respuesta != false){

          return 'existe';
        } else {
          // return 'no existe';

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


    }


    /*======================================================
    INSCRIPCIONES INSERTAR
    =============================================================================================*/
    static public function ctrInscripcionInsertar(){

      if(isset($_POST["nuevoInscripcion"])){

        if(preg_match('/^[A-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoInscripcion"]) && 
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
              title: "¡Inscripcion creada exitosamente!",
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
    /*======================================================
    OBJETO INSERTAR
    =======================================================*/
    static public function ctrObjetoInsertar(){

      if(isset($_POST["nuevoObjeto"])){

        if(preg_match('/^[A-ZÑÁÉÍÓÚ ]+$/', $_POST["nuevoObjeto"]) && 
           preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoLink"])&& 
           preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoIcono"])){
         
          
          $tabla = "tbl_objetos";          
  
          $datos = array("objeto" => $_POST["nuevoObjeto"], 
                          "link" => $_POST["nuevoLink"],
                          "icono" => $_POST["nuevoIcono"]);

            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
            // return;
  
          $respuesta = ModeloMantenimiento::mdlObjetoInsertar($tabla, $datos);
          
          // var_dump($respuesta);
          if($respuesta == true){
  
           
            // $descripcionEvento = "Nueva Inscripcion del Gimnasio";
            // $accion = "Nuevo";
            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

         
       
            echo '<script>
  
            Swal.fire({
  
              icon: "success",
              title: "Objeto creado exitosamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "objetos";
  
              }
  
            });
  
  
            </script>';
  
  
          }
  
  
        }else{
  
          echo '<script>
  
            Swal.fire({
  
              icon: "error",
              title: "¡Los datos no pueden ir vacíos!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "objetos";
  
              }
  
            });
  
  
          </script>';
  
        }
  
  
      }
  
    }


    /*======================================================
    BACKUP INSERTAR
    =======================================================*/
    static public function ctrBackupInsertar($nombreBackup){

      if(isset($nombreBackup)){

        // if(preg_match('/^[A-ZÑÁÉÍÓÚ ]+$/', $nombreBackup)){
         
          
          $tabla = "tbl_backup";          
  
          session_start();
          $datos = array("nombre_backup" => $nombreBackup, 
                          "creado_por" => $_SESSION["id_usuario"]);
          
          // $datos = $nombreBackup;

            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
            // return;
  
          $respuesta = ModeloMantenimiento::mdlBackupInsertar($tabla, $datos);
          
          // var_dump($respuesta);
          if($respuesta == true){
  
           return true;
            // $descripcionEvento = "Nueva Inscripcion del Gimnasio";
            // $accion = "Nuevo";
            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

         
       
            // echo '<script>
  
            // Swal.fire({
  
            //   icon: "success",
            //   title: "Objeto creado exitosamente!",
            //   showConfirmButton: true,
            //   confirmButtonText: "Cerrar",
            //   closeOnConfirm: false
  
            // }).then((result)=>{
  
            //   if(result.value){
  
            //     window.location = "respaldo-restauracion";
  
            //   }
  
            // });
  
  
            // </script>';
  
  
          }
  
  
        // }else{
  

  
        
  
  
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
              title: "¡Matricula creada exitosamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "matricula";
  
              }
  
            });
  
            </script>';
  
  
          } else {
            echo'<script>
                Swal.fire({
                      icon: "error",
                      title: "Opps, algo salio mal, intenta de nuevo!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                      }).then((result) => {
                                if (result.value) {
        
                                window.location = "inscripcion";
        
                                }
                            })
        
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


    /*=============================================
    MOSTRAR DOCUMENTOS
    =============================================*/

    static public function ctrMostrarDocumento($item, $valor){

      $tabla = "tbl_documento";
      
      $respuesta = ModeloMantenimiento::mdlMostrarDocumento($tabla, $item, $valor);

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

  
          } else {
            echo'<script>
    
            Swal.fire({
                  icon: "error",
                  title: "Opps, algo salio mal, intenta de nuevo!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                            if (result.value) {
    
                            window.location = "descuento";
    
                            }
                        })
    
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
    AGREGAR NUEVO DOCUMENTO
    =============================================*/
    
    static public function ctrDocumentoInsertar(){

      // var_dump($_POST);
      // return;
      if(isset($_POST["nuevoDocumento"])){

        if(preg_match('/^[A-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDocumento"])){

          $tabla = "tbl_documento";

          $datos = array ("tipo_documento" => $_POST["nuevoDocumento"]);


          $respuesta =  ModeloMantenimiento::mdlDocumentoInsertar($tabla,$datos);

    
          if($respuesta == true){
              
              // $descripcionEvento = "Actualizo rol";
              // $accion = "Actualizo";
              // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

              echo'<script>
      
              Swal.fire({
                  icon: "success",
                    title: "Documento creado exitosamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                              if (result.value) {
      
                              window.location = "documentos";
      
                              }
                          })
      
              </script>';
      
          }else{

            echo'<script>
      
              Swal.fire({
                    icon: "warning",
                    title: "Error al editar rol",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                              if (result.value) {
      
                              window.location = "rol";
      
                              }
                          })
      
              </script>';
          }

        } else {
          echo '<script>
  
              Swal.fire({

                icon: "error",
                title: "¡No puede ir vacío, escrito en minusculas o llevar caracteres especiales!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false

              }).then((result)=>{

                if(result.value){

                  window.location = "documentos";

                }

              });


            </script>';

        }
      }

    }


    /*=============================================
    AGREGAR NUEVA PREGUNTA DE SEGURIDAD
    =============================================*/
    
    static public function ctrPreguntaSeguridadInsertar(){

      // var_dump($_POST);
      // return;
      if(isset($_POST["nuevaPregunta"])){

        if(preg_match('/^[A-ZÑÁÉÍÓÚ¿? ]+$/', $_POST["nuevaPregunta"])){

          $tabla = "tbl_preguntas";

          $datos = array ("pregunta" => $_POST["nuevaPregunta"]);


          $respuesta =  ModeloMantenimiento::mdlPreguntaSeguridadInsertar($tabla,$datos);

    
          if($respuesta == true){
              
              // $descripcionEvento = "Actualizo rol";
              // $accion = "Actualizo";
              // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

              echo'<script>
      
              Swal.fire({
                  icon: "success",
                    title: "Pregunta creada exitosamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                        if (result.value) {

                        window.location = "preguntas-seguridad";

                        }
                    })
      
              </script>';
      
          }else{

            echo'<script>
      
              Swal.fire({
                    icon: "error",
                    title: "Opps, ocurrio un problema. Intente de nuevo.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                              if (result.value) {
      
                              window.location = "preguntas-seguridad";
      
                              }
                          })
      
              </script>';
          }

        } else {
          echo '<script>
  
              Swal.fire({

                icon: "error",
                title: "¡El campo no puede ir vacío, escrito en minusculas o llevar caracteres especiales con excepción de los signos de interrogacion!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false

              }).then((result)=>{

                if(result.value){

                  window.location = "preguntas-seguridad";

                }

              });


            </script>';

        }
      }

    }


    /*=============================================
    AGREGAR NUEVO PROVEEDOR
    =============================================*/
    static public function ctrNuevoProveedor($datos){
      
      if(isset($datos["nombre"])){
        
        if(preg_match('/^[A-ZÑÁÉÍÓÚ ]+$/', $datos["nombre"])){
          // return $datos['telefono'];

          $tabla = "tbl_proveedores";

          $datos = array("nombre" => $datos["nombre"],
                         "correo" => $datos["correo"],
                         "telefono" => $datos["telefono"] 
                    );

          // return $datos;

          $respuesta =  ModeloMantenimiento::mdlNuevoProveedor($tabla,$datos);

    
          if($respuesta == true){
              
              // $descripcionEvento = "Actualizo rol";
              // $accion = "Actualizo";
              // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

              return true;
      
          }else{

            return false;
          }

        } else {

          return 'Mal';

        }
      }


    }


    /*=============================================
    EDITAR ROL
    =============================================*/
    
    static public function ctrEditarRol(){
      // var_dump($_POST);
      // return;
      
      if(isset($_POST["editarRol"])){
        
        $tabla = "tbl_roles";
        
        $datos = array ("rol"=> $_POST["editarRol"],
        "descripcion"=>$_POST["editarDescripcionRol"],
        "id_rol"=>$_POST["editarIdRol"]);
        
        // var_dump($datos);
        // return;
        
        $respuesta =  ModeloMantenimiento::mdlEditarRol($tabla,$datos);

    
        if($respuesta == true){
            
            $descripcionEvento = "Actualizo rol";
            $accion = "Actualizo";
            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

          

            echo'<script>
    
            Swal.fire({
                 icon: "success",
                  title: "Rol editado correctamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                            if (result.value) {
    
                            window.location = "rol";
    
                            }
                        })
    
            </script>';
    
        }else{

          echo'<script>
    
            Swal.fire({
                  icon: "error",
                  title: "Error al editar rol",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                            if (result.value) {
    
                            window.location = "rol";
    
                            }
                        })
    
            </script>';
        }

      }

    }


    /*=============================================
    EDITAR MATRICULA
    =============================================*/
    
    static public function ctrEditarMatricula(){

      if(isset($_POST["editarMatricula"])){

        $tabla = "tbl_matricula";

        $datos = array ("tipo_matricula"=> $_POST["editarMatricula"],
                        "precio_matricula"=>$_POST["editarPrecioMatricula"],
                        "id_matricula"=>$_POST["editarIdMatricula"]);


        $respuesta =  ModeloMantenimiento::mdlEditarMatricula($tabla,$datos);

    
        if($respuesta == true){
            
            $descripcionEvento = "Actualizo Matricula ";
            $accion = "Actualizo";
            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

          

            echo'<script>
    
            Swal.fire({
                 icon: "success",
                  title: "Matricula editada correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                            if (result.value) {
    
                            window.location = "matricula";
    
                            }
                        })
    
            </script>';
    
        } else{

          echo'<script>
    
            Swal.fire({
                  icon: "error",
                  title: "Opps, algo salio mal, intenta de nuevo!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                            if (result.value) {
    
                            window.location = "matricula";
    
                            }
                        })
    
            </script>';
        }

      }

    }


    /*=============================================
    EDITAR INSCRIPCION
    =============================================*/
    
    static public function ctrEditarInscripcion(){

      if(isset($_POST["editarInscripcion"])){

        $tabla = "tbl_inscripcion";

        $datos = array ("tipo_inscripcion"=> $_POST["editarInscripcion"],
                        "precio_inscripcion"=>$_POST["editarPrecioInscripcion"],
                        "cantidad_dias"=>$_POST["editarDiasInscripcion"],
                        "id_inscripcion"=>$_POST["editarIdInscripcion"]);


        $respuesta =  ModeloMantenimiento::mdlEditarInscripcion($tabla,$datos);

    
        if($respuesta == true){
            
            $descripcionEvento = "Actualizo Inscripcion";
            $accion = "Actualizo";
            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

          

            echo'<script>
    
            Swal.fire({
                 icon: "success",
                  title: "Inscripción editada correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                      if (result.value) {

                      window.location = "inscripcion";

                      }
                  })
    
            </script>';
    
        }else{

          echo'<script>
    
            Swal.fire({
                  icon: "error",
                  title: "Opps, algo salio mal, intenta de nuevo!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                            if (result.value) {
    
                            window.location = "inscripcion";
    
                            }
                        })
    
            </script>';
        }

      }

    }


    /*=============================================
    EDITAR DESCUENTO
    =============================================*/
    
    static public function ctrEditarDescuento(){

      if(isset($_POST["editarDescuento"])){

        $tabla = "tbl_descuento";

        $datos = array ("tipo_descuento"=> $_POST["editarDescuento"],
                        "valor_descuento"=>$_POST["editarValorDescuento"],
                        "id_descuento"=>$_POST["editarIdDescuento"]);


        $respuesta =  ModeloMantenimiento::mdlEditarDescuento($tabla,$datos);

        if($respuesta == true){
             
          $descripcionEvento = "Actualizo Descuento";
          $accion = "consulta";

          $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);
          
          echo'<script>
    
            Swal.fire({
                 icon: "success",
                  title: "Descuento editado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                      if (result.value) {

                      window.location = "descuento";

                      }
                  })
    
            </script>';
    
        }else{

          echo'<script>
    
            Swal.fire({
                  icon: "error",
                  title: "Opps, algo salio mal, intenta de nuevo!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                            if (result.value) {
    
                            window.location = "descuento";
    
                            }
                        })
    
            </script>';
        }

      }

    }


    /*=============================================
    EDITAR DOCUMENTO
    =============================================*/
    
    static public function ctrEditarDocumento(){
      // var_dump($_POST);
      // return;

      if(isset($_POST["editarIdDocumento"])){

        if(preg_match('/^[A-ZñÑÁÉÍÓÚ ]+$/', $_POST["editarDocumento"])){

          $tabla = "tbl_documento";

          $datos = array ("tipo_documento"=> $_POST["editarDocumento"],
                          "id_documento"=>$_POST["editarIdDocumento"]);


          $respuesta =  ModeloMantenimiento::mdlEditarDocumento($tabla,$datos);

      
          if($respuesta == true){
              
              // $descripcionEvento = "Actualizo rol";
              // $accion = "Actualizo";
              // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);            

              echo'<script>
      
              Swal.fire({
                    icon: "success",
                    title: "Documento editado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                              if (result.value) {
      
                              window.location = "documentos";
      
                              }
                          })
      
              </script>';
      
          }else{

            echo'<script>
      
              Swal.fire({
                    icon: "error",
                    title: "Opps, algo salio mal, intenta de nuevo!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                              if (result.value) {
      
                              window.location = "documentos";
      
                              }
                          })
      
              </script>';
          }
        
        } else {
          echo '<script>
  
            Swal.fire({
  
              icon: "error",
              title: "¡No puede ir vacío, escrito en minusculas o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "documentos";
  
              }
  
            });
  
  
          </script>';
  

        }

      }

    }

    /*=============================================
    EDITAR PREGUNTA
    =============================================*/
    
    static public function ctrEditarPregunta(){
      // var_dump($_POST);
      // return;

      if(isset($_POST["editarIdPregunta"])){

        if(preg_match('/^[A-ZÑÁÉÍÓÚ¿? ]+$/', $_POST["editarPregunta"])){

          $tabla = "tbl_preguntas";

          $datos = array ("pregunta"=> $_POST["editarPregunta"],
                          "id_pregunta"=>$_POST["editarIdPregunta"]);


          $respuesta =  ModeloMantenimiento::mdlEditarPregunta($tabla,$datos);

      
          if($respuesta == true){
              
              // $descripcionEvento = "Actualizo rol";
              // $accion = "Actualizo";
              // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);            

              echo'<script>
      
              Swal.fire({
                    icon: "success",
                    title: "Pregunta editada correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                              if (result.value) {
      
                              window.location = "preguntas-seguridad";
      
                              }
                          })
      
              </script>';
      
          }else{

            echo'<script>
      
              Swal.fire({
                    icon: "error",
                    title: "Opps, algo salio mal, intenta de nuevo!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                              if (result.value) {
      
                              window.location = "preguntas-seguridad";
      
                              }
                          })
      
              </script>';
          }
        
        } else {
          echo '<script>
  
            Swal.fire({
  
              icon: "error",
              title: "¡El campo no puede ir vacío, escrito en minusculas o llevar caracteres especiales con excepción de los signos de interrogacion!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }).then((result)=>{
  
              if(result.value){
  
                window.location = "preguntas-seguridad";
  
              }
  
            });
  
  
          </script>';
  

        }

      }

    }

    /*=============================================
    EDITAR PROVEEDOR
    =============================================*/
    
    static public function ctrEditarProveedor(){

      if(isset($_POST["editarIdProveedor"])){

        if(preg_match('/^[A-ZñÑÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

          $tabla = "tbl_proveedores";

          $datos = array ("nombre"=> $_POST["editarNombre"],
                          "correo"=>$_POST["editarCorreo"],
                          "telefono"=>$_POST["editarTelefono"],
                          "id_proveedor"=>$_POST["editarIdProveedor"]);


          $respuesta =  ModeloMantenimiento::mdlEditarProveedor($tabla,$datos);

      
          if($respuesta == true){
              
              // $descripcionEvento = "Actualizo rol";
              // $accion = "Actualizo";
              // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);          

              echo'<script>
      
              Swal.fire({
                  icon: "success",
                    title: "Proveedor editado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                        if (result.value) {

                        window.location = "proveedores";

                        }
                    })
      
              </script>';
      
          }else{

            echo'<script>
      
              Swal.fire({
                    icon: "error",
                    title: "Opps, algo salio mal, intenta de nuevo!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                        if (result.value) {

                        window.location = "proveedores";

                        }
                    })
      
              </script>';
          }
        
        } else {
          echo '<script>
  
            Swal.fire({
  
              icon: "error",
              title: "¡Los campos no pueden ir vacíos, escrito en minusculas o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
  
            }); 
  
          </script>';
  

        }
      
      }

    }


    
    /*=============================================
    BORRAR ROLES
    =============================================*/
    static public function ctrBorrarRoles(){
      // var_dump($_GET);
      // return;

      if(isset($_GET['idEliminarRoles'])){
          
          $tabla = 'tbl_roles';
          $item = 'id_rol';
          $valor = $_GET['idEliminarRoles'];

          $respuesta = ModeloMantenimiento::mdlBorrarDinamico($tabla, $item, $valor);
          
          // var_dump($respuesta);
          // return;

          if($respuesta[1] == 1451){

            // $descripcionEvento = "Elimino el Rol";
            // $accion = "Elimino";

            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

            echo '<script>
                Swal.fire({
                    title: "¡No se pudo borrar el rol!",
                    text: "No se puede borrar ya que esta asociado con otros datos",
                    icon: "error",
                    heightAuto: false
                }).then((result)=>{
                    if(result.value){
                        window.location = "rol";
                    }
                });                                      
            </script>';
            
            
          }else if($respuesta[1] == 1054) {

            echo'<script>

            Swal.fire({
            icon: "error",
            title: "Opps, algo salio mal, intenta de nuevo!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            }).then((result) => {
              if (result.value) {

                window.location = "rol";
                
              }
            })
            
            </script>';
            
          } else {
            
            echo'<script>

            Swal.fire({
                  icon: "success",
                  title: "Rol eliminado exitosamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                      if (result.value) {

                      window.location = "rol";

                      }
                  })

            </script>';
          } 
      }
    }

  	/*=============================================
    BORRAR MATRICULA
    =============================================*/
    static public function ctrBorrarMatricula(){
      // var_dump($_GET);
      //return;

      if(isset($_GET['idEliminarMatricula'])){
          
          $tabla = 'tbl_matricula';
          $item = 'id_matricula';
          $valor = $_GET['idEliminarMatricula'];

          $respuesta = ModeloMantenimiento::mdlBorrarDinamico($tabla, $item, $valor);

          // var_dump($respuesta);
          // return;
         
          if($respuesta[1] == 1451){

            // $descripcionEvento = "Elimino el Rol";
            // $accion = "Elimino";

            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

            echo '<script>
                Swal.fire({
                    title: "¡No se pudo borrar la matricula!",
                    text: "No se puede borrar ya que esta asociado con otros datos",
                    icon: "error",
                    heightAuto: false
                }).then((result)=>{
                    if(result.value){
                        window.location = "matricula";
                    }
                });                                      
            </script>';
            
            
          }else if($respuesta[1] == 1054) {

            echo'<script>

            Swal.fire({
            icon: "error",
            title: "Opps, algo salio mal, intenta de nuevo!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            }).then((result) => {
              if (result.value) {

                window.location = "matricula";
                
              }
            })
            
            </script>';
            
          } else {
            
            echo'<script>

            Swal.fire({
                  icon: "success",
                  title: "Matricula eliminada exitosamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                      if (result.value) {

                      window.location = "matricula";

                      }
                  })

            </script>';
          }           
      }
    }

    /*=============================================
    BORRAR INSCRIPCION
    =============================================*/
    static public function ctrBorrarInscripcion(){
      // var_dump($_GET);
      //return;

      if(isset($_GET['idEliminarInscripcion'])){
          $tabla = 'tbl_inscripcion';
          $item = 'id_inscripcion';
          $valor = $_GET['idEliminarInscripcion'];

          $respuesta = ModeloMantenimiento::mdlBorrarDinamico($tabla, $item, $valor);
          
          // var_dump($respuesta);
          // return;

          if($respuesta[1] == 1451){

            // $descripcionEvento = "Elimino el Rol";
            // $accion = "Elimino";

            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

            echo '<script>
                Swal.fire({
                    title: "¡No se pudo borrar la inscripción!",
                    text: "No se puede borrar ya que esta asociado con otros datos",
                    icon: "error",
                    heightAuto: false
                }).then((result)=>{
                    if(result.value){
                        window.location = "inscripcion";
                    }
                });                                      
            </script>';
            
            
          }else if($respuesta[1] == 1054) {

            echo'<script>

            Swal.fire({
            icon: "error",
            title: "Opps, algo salio mal, intenta de nuevo!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            }).then((result) => {
              if (result.value) {

                window.location = "inscripcion";
                
              }
            })
            
            </script>';
            
          } else {
            
            echo'<script>

            Swal.fire({
                  icon: "success",
                  title: "Inscripción eliminada exitosamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                      if (result.value) {

                      window.location = "inscripcion";

                      }
                  })

            </script>';
          } 
      }
    }

    /*=============================================
    BORRAR DESCUENTO
    =============================================*/
    static public function ctrBorrarDescuento(){
      // var_dump($_GET);
      //return;

      if(isset($_GET['idEliminarDescuento'])){
          $tabla = 'tbl_descuento';
          $item = 'id_descuento';
          $valor = $_GET['idEliminarDescuento'];

          $respuesta = ModeloMantenimiento::mdlBorrarDinamico($tabla, $item, $valor);

          // var_dump($respuesta);
          // return;
         
          if($respuesta[1] == 1451){

            // $descripcionEvento = "Elimino el Rol";
            // $accion = "Elimino";

            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

            echo '<script>
                Swal.fire({
                    title: "¡No se pudo borrar el descuento!",
                    text: "No se puede borrar ya que esta asociado con otros datos",
                    icon: "error",
                    heightAuto: false
                }).then((result)=>{
                    if(result.value){
                        window.location = "descuento";
                    }
                });                                      
            </script>';
            
            
          }else if($respuesta[1] == 1054) {

            echo'<script>

            Swal.fire({
            icon: "error",
            title: "Opps, algo salio mal, intenta de nuevo!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            }).then((result) => {
              if (result.value) {

                window.location = "descuento";
                
              }
            })
            
            </script>';
            
          } else {
            
            echo'<script>

            Swal.fire({
                  icon: "success",
                  title: "Descuento eliminado exitosamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                      if (result.value) {

                      window.location = "descuento";

                      }
                  })

            </script>';
          } 
      }
    }

    /*=============================================
    BORRAR DOCUMENTO
    =============================================*/
    static public function ctrBorrarDocumento(){
      // var_dump($_GET['idEliminarDocumento']);
      // return;

      if(isset($_GET['idEliminarDocumento'])){

          $tabla = 'tbl_documento';
          $item = 'id_documento';
          $valor = $_GET['idEliminarDocumento'];

          $respuesta = ModeloMantenimiento::mdlBorrarDinamico($tabla, $item, $valor);

          // var_dump($respuesta);
          // return;

          if($respuesta[1] == 1451){

            // $descripcionEvento = "Elimino el Rol";
            // $accion = "Elimino";

            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

            echo '<script>
                Swal.fire({
                    title: "¡No se pudo borrar el documento!",
                    text: "No se puede borrar ya que esta asociado con otros datos",
                    icon: "error",
                    heightAuto: false
                }).then((result)=>{
                    if(result.value){
                        window.location = "documentos";
                    }
                });                                      
            </script>';
            
            
          }else if($respuesta[1] == 1054) {

            echo'<script>

            Swal.fire({
            icon: "error",
            title: "Opps, algo salio mal, intenta de nuevo!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            }).then((result) => {
              if (result.value) {

                window.location = "documentos";
                
              }
            })
            
            </script>';
            
          } else {
            
            echo'<script>

            Swal.fire({
                  icon: "success",
                  title: "Documento eliminado exitosamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                      if (result.value) {

                      window.location = "documentos";

                      }
                  })

            </script>';
          } 
          
      }
    }

    /*=============================================
    BORRAR PREGUNTA
    =============================================*/
    static public function ctrBorrarPregunta(){
      // var_dump($_GET['idEliminarpregunta']);
      // return;

      if(isset($_GET['idEliminarPregunta'])){

          $tabla = 'tbl_preguntas';
          $item = 'id_preguntas';
          $valor = $_GET['idEliminarPregunta'];

          $respuesta = ModeloMantenimiento::mdlBorrarDinamico($tabla, $item, $valor);

          // var_dump($respuesta);
          // return;

          if($respuesta[1] == 1451){

            // $descripcionEvento = "Elimino el Rol";
            // $accion = "Elimino";

            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

            echo '<script>
                Swal.fire({
                    title: "¡No se pudo borrar la pregunta!",
                    text: "No se puede borrar ya que esta asociado con otros datos",
                    icon: "error",
                    heightAuto: false
                }).then((result)=>{
                    if(result.value){
                        window.location = "preguntas-seguridad";
                    }
                });                                      
            </script>';
            
            
          }else if($respuesta[1] == 1054) {

            echo'<script>

            Swal.fire({
            icon: "error",
            title: "Opps, algo salio mal, intenta de nuevo!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            }).then((result) => {
              if (result.value) {

                window.location = "preguntas-seguridad";
                
              }
            })
            
            </script>';
            
          } else {
            
            echo'<script>

            Swal.fire({
                  icon: "success",
                  title: "Pregunta eliminada exitosamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                      if (result.value) {

                      window.location = "preguntas-seguridad";

                      }
                  })

            </script>';
          } 
          
      }
    }

    /*=============================================
    BORRAR PROVEEDOR
    =============================================*/
    static public function ctrBorrarProveedor(){
      // var_dump($_GET['idEliminarProveedor']);
      // return;

      if(isset($_GET['idProveedor'])){

          $tabla = 'tbl_proveedores';
          $item = 'id_proveedor';
          $valor = $_GET['idProveedor'];

          $respuesta = ModeloMantenimiento::mdlBorrarDinamico($tabla, $item, $valor);
          
          // var_dump($respuesta[1]);
          // return;
          
          if($respuesta[1] == 1451){

            // $descripcionEvento = "Elimino el Rol";
            // $accion = "Elimino";

            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

            echo '<script>
                Swal.fire({
                    title: "¡No se pudo borrar el proveedor!",
                    text: "No se puede borrar ya que esta asociado con otros datos",
                    icon: "error",
                    heightAuto: false
                }).then((result)=>{
                    if(result.value){
                        window.location = "proveedores";
                    }
                });                                      
            </script>';
            
            
          }else if($respuesta[1] == 1054) {

            echo'<script>

            Swal.fire({
            icon: "error",
            title: "Opps, algo salio mal, intenta de nuevo!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
            }).then((result) => {
              if (result.value) {

                window.location = "proveedores";
                
              }
            })
            
            </script>';
            
          } else {
            
            echo'<script>

            Swal.fire({
                  icon: "success",
                  title: "Proveedor eliminado exitosamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                      if (result.value) {

                      window.location = "proveedores";

                      }
                  })

            </script>';
          } 
      }
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
    RANGO DE PREGUNTAS
    =============================================*/
    static public function ctrRangoPreguntas($rango) {

      $tabla = "tbl_preguntas";
      
      $respuesta = ModeloMantenimiento::mdlRangoPreguntas($tabla, $rango);

      return $respuesta;

    }


    /*=============================================
    RANGO DE RESPALDO
    =============================================*/
    static public function ctrRangoRespaldo($rango) {

      $tabla = "tbl_backup";
      
      $respuesta = ModeloMantenimiento::mdlRangoRespaldo($tabla, $rango);

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



  


  





