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
	****    FUNCION ALERTAS
    =============================================*/
    static public function ctrAlertas($titulo, $texto, $icono){

        $host= $_SERVER["HTTP_HOST"];
        $url= $_SERVER["REQUEST_URI"];
        $urlF = "http://" . $host . $url;
        if($urlF == 'http://localhost/admin/dashboard'){
            echo '<script>			
                function alertas() {
                         Swal.fire({
                            title: "'.$titulo.'",
                            text: "'.$texto.'",
                            icon: "'.$icono.'",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        });
                    }
                    alertas();
                    
                    </script>';
                    // width: 600
                    // toast: true,
                    // position: "top",
        }
  
    }


    /*=============================================
	****    FUNCION ALERTAS
    =============================================*/
    static public function ctrAlertaCliente($titulo, $texto, $icono){

        $host= $_SERVER["HTTP_HOST"];
        $url= $_SERVER["REQUEST_URI"];
        $urlF = "http://" . $host . $url;
        if($urlF == 'http://localhost/admin/dashboard'){
            echo '<script>			
                function alertas() {
                         Swal.fire({
                            title: "'.$titulo.'",
                            text: "'.$texto.'",
                            icon: "'.$icono.'",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        });
                    }
                    alertas();
                    
                    </script>';
                    // width: 600
                    // toast: true,
                    // position: "top",
        }
  
    }
 
 
    /*=============================================
    EDITAR PARAMETROS
    =============================================*/
    
    static public function ctrEditarParametro(){

      if(isset($_POST["editarParametro"])){

        $tabla = "tbl_parametros";

        $datos = array ("valor"=> $_POST["editarValorParametro"],
                        "id_parametro"=>$_POST["editarIdParametro"]);


        $respuesta =  ModeloGlobales::mdlEditarParametro($tabla,$datos);
    
        if($respuesta == true){
            
            $descripcionEvento = "".$_SESSION["usuario"]." Actualizó el valor del parametro ".$_POST["editarParametro"]."";
            $accion = "Actualizar";
            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 20,$accion, $descripcionEvento);

          
       
    
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
    RANGO DINAMICO INSCRIPCION
    =============================================*/
	static public function ctrRangoInscripcion($rango){

		$tabla = 'tbl_inscripcion';
		
		$respuesta = ModeloGlobales::mdlRangoInscripcion($tabla, $rango);
		
		return $respuesta;
    }

    /*=============================================
    RANGO DINAMICO PROVEEDOR
    =============================================*/
	static public function ctrRangoObjetos($rango){

		$tabla = 'tbl_objetos';
		
		$respuesta = ModeloGlobales::mdlRangoObjetos($tabla, $rango);
		
		return $respuesta;
    }

    /*=============================================
    RANGO DINAMICO PROVEEDOR
    =============================================*/
	static public function ctrRangoProveedor($rango){

		$tabla = 'tbl_proveedores';
		
		$respuesta = ModeloGlobales::mdlRangoProveedor($tabla, $rango);
		
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
    RANGO DINAMICO DOCUMENTOS
    =============================================*/
	static public function ctrRangoDocumento($rango){

		$tabla = 'tbl_documento';
		
		$respuesta = ModeloGlobales::mdlRangoDocumento($tabla, $rango);
		
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
	static public function ctrRangoPermisosRol($rango){

		$tabla = 'tbl_permisos';
		
		$respuesta = ModeloGlobales::mdlRangoPermisosRol($tabla, $rango);
		
		return $respuesta;
	}


}