<?php

class ControladorGlobales{

    /*=============================================
			OBTENER SISTEMA OPERATIVO
	=============================================*/

    static public function ctrGetOS(){ 
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $os_platform  = "Unknown OS Platform";

        $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }

        return $os_platform;
    }
  

    /*=============================================
			OBTENER NAVEGADOR
	=============================================*/

    static public function ctrGetBrowser(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
        $browser        = "Unknown Browser";

        $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser = $value;
            }
        }

        return $browser;
    }        

    /*=============================================
			MOSTRAR PARAMETROS
    =============================================*/
    
    static public function ctrMostrarParametros($item,$valor){
      $tabla = 'tbl_parametros';
		  $respuesta = ModeloGlobales::mdlMostrarParametros($tabla, $item, $valor);

		  return $respuesta;
    }

    /*=============================================
			FUNCION ALERTAS
    =============================================*/
    static public function ctrAlertas($mensaje, $icono){

        $host= $_SERVER["HTTP_HOST"];
        $url= $_SERVER["REQUEST_URI"];
        $urlF = "http://" . $host . $url;
        if($urlF == 'http://localhost/gym/dashboard'){
            echo '<script>			
                function alertas() {
                         Swal.fire({
                            title: "'.$mensaje.'",
                            icon: "'.$icono.'",
                            toast: true,
                            position: "top",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            width: 600
                        });
                    }
                alertas();
                
            </script>';
        }
  
    }

    /*=============================================
			EDITAR PARAMETROS
    =============================================*/
    
    public function ctrEditarParametro(){

      if(isset($_POST["editarParametro"])){

        $tabla = "tbl_parametros";

        $datos = array ("valor"=> $_POST["editarValorParametro"],
                        "id_parametro"=>$_POST["editarIdParametro"]);


        $respuesta =  ModeloGlobales::mdlEditarParametro($tabla,$datos);
    
        if($respuesta == true){
            
            $descripcionEvento = "Actualizo parametro";
            $accion = "Actualizo";
            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

          
       
    
            echo'<script>
    
            Swal.fire({
                  icon: "success",
                  title: "El parametro ha sido editado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                            if (result.value) {
    
                            window.location = "parametro";
    
                            }
                        })
    
            </script>';
    
        }else{

          echo'<script>
    
            Swal.fire({
                  icon: "error",
                  title: "Error al editar parametro",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                  }).then((result) => {
                            if (result.value) {
    
                            window.location = "parametro";
    
                            }
                        })
    
            </script>';
        }

      }

    }

    /*=============================================
      EDITAR ROL
    =============================================*/
    
    public function ctrEditarRol(){

      if(isset($_POST["editarRol"])){

        $tabla = "tbl_roles";

        $datos = array ("rol"=> $_POST["editarRol"],
                        "descripcion"=>$_POST["editarDescripcionRol"],
                        "id_rol"=>$_POST["editarIdRol"]);


        $respuesta =  ModeloGlobales::mdlEditarRol($tabla,$datos);

    
        if($respuesta == true){
            
            $descripcionEvento = "Actualizo rol";
            $accion = "Actualizo";
            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 2,$accion, $descripcionEvento);

          

            echo'<script>
    
            Swal.fire({
                 icon: "success",
                  title: "El rol ha sido editado correctamente",
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
                        "id_inscripcion"=>$_POST["editarIdInscripcion"]);


        $respuesta =  ModeloGlobales::mdlEditarInscripcion($tabla,$datos);

    
        if($respuesta == true){
            
            $descripcionEvento = "Actualizo rol";
            $accion = "Actualizo";
            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 2,$accion, $descripcionEvento);

          

            echo'<script>
    
            Swal.fire({
                 icon: "success",
                  title: "La inscripcion ha sido editado correctamente",
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
                  icon: "warning",
                  title: "Error al editar inscripcion",
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
      EDITAR MATRICULA
    =============================================*/
    
    public function ctrEditarMatricula(){

        if(isset($_POST["editarMatricula"])){
  
          $tabla = "tbl_matricula";
  
          $datos = array ("tipo_matricula"=> $_POST["editarMatricula"],
                          "precio_matricula"=>$_POST["editarPrecioMatricula"],
                          "id_matricula"=>$_POST["editarIdMatricula"]);
  
  
          $respuesta =  ModeloGlobales::mdlEditarMatricula($tabla,$datos);
  
      
          if($respuesta == true){
              
              $descripcionEvento = "Actualizo ";
              $accion = "Actualizo";
              $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 2,$accion, $descripcionEvento);
  
            
  
              echo'<script>
      
              Swal.fire({
                   icon: "success",
                    title: "La matricula ha sido editado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                              if (result.value) {
      
                              window.location = "matricula";
      
                              }
                          })
      
              </script>';
      
          }else{
  
            echo'<script>
      
              Swal.fire({
                    icon: "warning",
                    title: "Error al editar matricula",
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
      EDITAR DESCUENTO
    =============================================*/
    
    public function ctrEditarDescuento(){

      if(isset($_POST["editarDescuento"])){

        $tabla = "tbl_descuento";

        $datos = array ("tipo_descuento"=> $_POST["editarDescuento"],
                        "valor_descuento"=>$_POST["editarValorDescuento"],
                        "id_descuento"=>$_POST["editarIdDescuento"]);


        $respuesta =  ModeloGlobales::mdlEditarDescuento($tabla,$datos);

    
        if($respuesta == true){
          
            echo'<script>
    
            Swal.fire({
                 icon: "success",
                  title: "El descuento ha sido editado correctamente",
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
                  icon: "warning",
                  title: "Error al editar descuento",
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
            BORRAR INSCRIPCION
	=============================================*/
  static public function ctrBorrarInscripcion(){
    // var_dump($_GET);
     //return;

    if(isset($_GET['idEliminarInscripcion'])){
        $tabla = 'tbl_inscripcion';
        $datos = $_GET['idEliminarInscripcion'];


        $respuesta = ModeloGlobales::mdlBorrarInscripcion($tabla, $datos);
        
        // var_dump($respuesta);
        // return;
        
        if($respuesta == true){
          
          echo'<script>
  
          Swal.fire({
               icon: "success",
                title: "Se a eliminado correctamente",
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
                icon: "warning",
                title: "Error al borrar inscripcion",
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
            BORRAR INSCRIPCION
	=============================================*/
  static public function ctrBorrarMatricula(){
    // var_dump($_GET);
     //return;

    if(isset($_GET['idEliminarMatricula'])){
        $tabla = 'tbl_matricula';
        $datos = $_GET['idEliminarMatricula'];


        $respuesta = ModeloGlobales::mdlBorrarMatricula($tabla, $datos);
        
        // var_dump($respuesta);
        // return;
        
        if($respuesta == true){
          
          echo'<script>
  
          Swal.fire({
               icon: "success",
                title: "Se a eliminado correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
                }).then((result) => {
                          if (result.value) {
  
                          window.location = "matricula";
  
                          }
                      })
  
          </script>';
  
      }else{

        echo'<script>
  
          Swal.fire({
                icon: "warning",
                title: "Error al borrar matricula",
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
            BORRAR Descuento
	=============================================*/
  static public function ctrBorrarDescuento(){
    // var_dump($_GET);
     //return;

    if(isset($_GET['idEliminarDescuento'])){
        $tabla = 'tbl_descuento';
        $datos = $_GET['idEliminarDescuento'];


        $respuesta = ModeloGlobales::mdlBorrarDescuento($tabla, $datos);
        
        // var_dump($respuesta);
        // return;
        
        if($respuesta == true){
          
          echo'<script>
  
          Swal.fire({
               icon: "success",
                title: "Se a eliminado correctamente",
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
                icon: "warning",
                title: "Error al borrar descuento",
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
            BORRAR ROLES
	=============================================*/
  static public function ctrBorrarRoles(){
    // var_dump($_GET);
    // return;

    if(isset($_GET['idEliminarRoles'])){
        $tabla = 'tbl_roles';
        $datos = $_GET['idEliminarRoles'];


        $respuesta = ModeloGlobales::mdlBorrarRoles($tabla, $datos);
        
        // var_dump($respuesta);
        // return;
        
        if($respuesta == true){
          
          echo'<script>
  
          Swal.fire({
               icon: "success",
                title: "Se a eliminado correctamente",
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
                icon: "warning",
                title: "Error al borrar rol",
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
			RANGO DINAMICO INSCRIPCION
    =============================================*/
	static public function ctrRangoInscripcion($rango){

		$tabla = 'tbl_inscripcion';
		
		$respuesta = ModeloGlobales::mdlRangoInscripcion($tabla, $rango);
		
		return $respuesta;
  }
  
  /*=============================================
			RANGO DINAMICO MATRICULA
    =============================================*/
	static public function ctrRangoMatricula($rango){

		$tabla = 'tbl_matricula';
		
		$respuesta = ModeloGlobales::mdlRangoMatricula($tabla, $rango);
		
		return $respuesta;
	}

  /*=============================================
			RANGO DINAMICO DESCUENTO
    =============================================*/
	static public function ctrRangoDescuento($rango){

		$tabla = 'tbl_descuento';
		
		$respuesta = ModeloGlobales::mdlRangoDescuento($tabla, $rango);
		
		return $respuesta;
  }
  
  /*=============================================
			RANGO DINAMICO ROL
    =============================================*/
	static public function ctrRangoRol($rango){

		$tabla = 'tbl_roles';
		
		$respuesta = ModeloGlobales::mdlRangoRol($tabla, $rango);
		
		return $respuesta;
  }
  
   /*=============================================
			RANGO DINAMICO PARAMETRO
    =============================================*/
	static public function ctrRangoParametro($rango){

		$tabla = 'tbl_parametros';
		
		$respuesta = ModeloGlobales::mdlRangoParametro($tabla, $rango);
		
		return $respuesta;
  }
  
  /*=============================================
			RANGO DINAMICO ADMINISTRAR
    =============================================*/
	static public function ctrRangoAdministrar($rango){

		$tabla = 'tbl_roles';
		
		$respuesta = ModeloGlobales::mdlRangoAdministrar($tabla, $rango);
		
		return $respuesta;
	}




  

}