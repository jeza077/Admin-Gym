<?php 

class ControladorPersonas{
    /*=============================================
				MOSTRAR USUARIOS
	=============================================*/

	static public function ctrMostrarPersonas($item, $valor) {

		$tabla = "tbl_personas";
		$respuesta = ModeloPersonas::mdlMostrarPersona($tabla, $item, $valor);

		return $respuesta;

	}

    static public function ctrCrearPersona($tipoPersona, $pantalla){

        // var_dump($_POST);
        // return;

        // var_dump($_FILES);
        // return;
        if(isset($_POST["nuevoNombre"])){

            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) && 
            preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/', $_POST["nuevoEmail"])){

                $tabla = "tbl_personas";

                if($tipoPersona == 'default'){
                    
                    $datos = array("nombre" => $_POST["nuevoNombre"],
                    "apellido" => $_POST["nuevoApellido"],
                    "id_documento" => $_POST["nuevoTipoDocumento"],
                    "numero_documento" => $_POST["nuevoNumeroDocumento"],
                    "tipo_persona" => $tipoPersona,
                    "fecha_nacimiento" => $_POST["nuevaFechaNacimiento"],
                    "sexo" => $_POST["nuevoSexo"],
                    "telefono" => $_POST["nuevoTelefono"],
                    "direccion" => $_POST["nuevaDireccion"],
                    "email" => $_POST["nuevoEmail"]);

                    $respuestaPersona = ModeloPersonas::mdlCrearPersona($tabla, $datos);

                        if($respuestaPersona == true){
                            // echo '<script>
                            //         Swal.fire({
                            //             title: "Tus datos han sido guardados correctamente!",
                            //             icon: "success",
                            //             heightAuto: false,
                            //             allowOutsideClick: false
                            //         }).then((result)=>{
                            //             if(result.value){
                            //                 window.location = "'.$pantalla.'";
                            //             }
                            //         });                       
                            //     </script>';
                            
                        //     echo '<script>
                        //     Swal.fire({
                        //         title: "Bien!",
                        //         icon: "success",
                        //         heightAuto: false,
                        //         allowOutsideClick: false,
                        //         timer: 4000
                        //     });					
                        // </script>';
                            
                            // /*------------------------------------------ Crear usuario -----------------------------------------------*/
                            $totalId = array();
                            $tabla = "tbl_personas";
                            // $tabla2 = null;
                            // $item = null;
                            // $valor = null;
    
                            $personaTotal = ModeloPersonas::mdlMostrarPersonas($tabla);
                            
                            foreach($personaTotal as $keyPersona => $valuePersona){
                            array_push($totalId, $valuePersona["id_personas"]);
                            }
    
                            $idPersona = end($totalId);
                          
                            //-----------Generar contraseña aleatoria----------------------
                            // $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890#$.@";
                            // $contraseñaAleatoria = "";
                            // //Longitud
                            // for($i=0;$i<$_POST[10];$i++) 
                            // {
                            // //obtenemos un caracter aleatorio escogido de la cadena de caracteres
                            // $contraseñaAleatoria .= substr($str,rand(0,62),1);
                            // }
                            // echo 'Password generado: '.$contraseñaAleatoria;
                            //-------------------------------------------------------------
                            

                            //------------------------Roles--------------------------------------
                            $tabla = "tbl_roles";
                            $item = null;
                            $valor = null;

                            $roles  = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);
                            var_dump($roles);

                            $idRol = $roles[1]["id_rol"];

                            // //-------------------------------------------------------------------

                      
                     
                            $datos = array("id_persona" => $idPersona,
                                        "nombre" => $_POST["nuevoNombre"],
                                        "usuario" => $_POST["nuevoUsuario"],
                                        "password" => "Hola456.",
                                        "rol" => $idRol,
                                        "foto" => "vistas/img/usuarios/default/anonymous.png",
                                        "email" => $_POST["nuevoEmail"]);
                                    

                            $crearUsuario = ControladorUsuarios::ctrCrearUsuario($datos);                        


                            if($crearUsuario == true){

                                echo '<script>
                                        Swal.fire({
                                            title: "Tus datos han sido guardados correctamente!",
                                            icon: "success",
                                            heightAuto: false,
                                            allowOutsideClick: false
                                        }).then((result)=>{
                                            if(result.value){
                                                window.location = "login";
                                            }
                                        });                       
                                    </script>';
                            }
                            
                        } else {
                            echo '<script>
                                    Swal.fire({
                                        title: "No se pudo guardar tus datos. Intenta de nuevo!",
                                        icon: "error",
                                        heightAuto: false,
                                        allowOutsideClick: false,
                                        timer: 4000
                                    });					
                                </script>';
                        }

                } 
                else {                    

                // var_dump($_POST);
                // return;

                // var_dump($_FILES);
                // return;

                    $datos = array("nombre" => $_POST["nuevoNombre"],
                                "apellido" => $_POST["nuevoApellido"],
                                "id_documento" => $_POST["nuevoTipoDocumento"],
                                "numero_documento" => $_POST["nuevoNumeroDocumento"],
                                "tipo_persona" => $tipoPersona,
                                "fecha_nacimiento" => $_POST["nuevaFechaNacimiento"],
                                "sexo" => $_POST["nuevoSexo"],
                                "telefono" => $_POST["nuevoTelefono"],
                                "direccion" => $_POST["nuevaDireccion"],
                                "email" => $_POST["nuevoEmail"]);

                    $respuestaPersona = ModeloPersonas::mdlCrearPersona($tabla, $datos);
                    
                    if($respuestaPersona == true){
                        $totalId = array();
                        $tabla = "tbl_personas";
                        // $tabla2 = null;
                        // $item = null;
                        // $valor = null;

                        $personaTotal = ModeloPersonas::mdlMostrarPersonas($tabla);
                        
                        foreach($personaTotal as $keyPersona => $valuePersona){
                        array_push($totalId, $valuePersona["id_personas"]);
                        }

                        $idPersona = end($totalId);

                        if($tipoPersona == "usuarios"){
                            
                            $datos = array("id_persona" => $idPersona,
                                        "nombre" => $_POST["nuevoNombre"],
                                        "usuario" => $_POST["nuevoUsuario"],
                                        "password" => $_POST["nuevoPassword"],
                                        "rol" => $_POST["nuevoRol"],
                                        "foto" => $_FILES["nuevaFoto"],
                                        "email" => $_POST["nuevoEmail"]);

                            $crearUsuario = ControladorUsuarios::ctrCrearUsuario($datos);

                            if($crearUsuario == true){
                                echo '<script>
                                        Swal.fire({
                                            title: "Usuario guardado correctamente!",
                                            icon: "success",
                                            heightAuto: false
                                        }).then((result)=>{
                                            if(result.value){
                                                window.location = "'.$pantalla.'";
                                            }
                                        });                                      
                                    </script>';
                            } else {
                                echo '<script>
                                        Swal.fire({
                                            title: "Error al guardar.",
                                            icon: "error",
                                            heightAuto: false
                                        }).then((result)=>{
                                            if(result.value){
                                                window.location = "'.$pantalla.'";
                                            }
                                        });                                      
                                    </script>';
                            }

                        } else {

                            $datos = array("id_persona" => $idPersona);

                            $crearCliente = ControladorClientes::ctrCrearCliente($datos);

                            if($crearCliente == true){
                                echo '<script>
                                        Swal.fire({
                                            title: "Cliente guardado correctamente!",
                                            icon: "success",
                                            heightAuto: false,
                                            allowOutsideClick: false
                                        }).then((result)=>{
                                            if(result.value){
                                                window.location = "'.$pantalla.'";
                                            }
                                        });                                              
                                    </script>';
                            }
                        }
                        
            
                    }

                }

            } else {
                
                echo '<script>
                    Swal.fire({
                        title: "Llene los campos correctamente.",
                        icon: "error",
                        toast: true,
                        position: "top",
                        showConfirmButton: false,
                        timer: 3000,
                    });					
                </script>';
            }
        }
    }  

}