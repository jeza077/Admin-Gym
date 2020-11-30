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
    
                            window.location = "mantenimiento";
    
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
    
                            window.location = "mantenimiento";
    
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
    
                            window.location = "mantenimiento";
    
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
    
                            window.location = "mantenimiento";
    
                            }
                        })
    
            </script>';
        }

      }

    }

}