<?php 

class ControladorPersonas{
    /*=============================================
    MOSTRAR PERSONAS
	=============================================*/
	static public function ctrMostrarPersonas($item, $valor, $all) {

		$tabla = "tbl_personas";
        $respuesta = ModeloPersonas::mdlMostrarPersonas($tabla, $item, $valor, $all);
		// $respuesta = ModeloPersonas::mdlMostrarPersona($tabla, $item, $valor);    

		return $respuesta;

    }
    


    /*=============================================
    REGISTRAR PERSONAS
	=============================================*/
    static public function ctrCrearPersona($tipoPersona, $pantalla){

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        // var_dump($_FILES);

        // return;   
        // return;

        if(isset($_POST["nuevoNombre"])){

            if(preg_match('/^[A-ZñÑÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) && 
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
                            
                            // /*------------------------------------------ Crear usuario -----------------------------------------------*/
                            $totalId = array();
                            $tabla = "tbl_personas";
                            // $tabla2 = null;
                            $item = null;
                            $valor = null;
                            $all = null;
    
                            $personaTotal = ModeloPersonas::mdlMostrarPersonas($tabla, $item, $valor, $all);
                            
                            foreach($personaTotal as $keyPersona => $valuePersona){
                            array_push($totalId, $valuePersona["id_personas"]);
                            }
    
                            $idPersona = end($totalId);

                            //------------------------Roles--------------------------------------
                            $tabla = "tbl_roles";
                            $item = "rol";
                            $valor = "Default";
                            $all = null;

                            $roles  = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);
                            // var_dump($roles);

                            $idRol = $roles["id_rol"];

                            // //-------------------------------------------------------------------
           
                            $datos = array("id_persona" => $idPersona,
                                        "nombre" => $_POST["nuevoNombre"],
                                        "usuario" => $_POST["nuevoUsuario"],
                                        "tipo_persona" => $tipoPersona,
                                        "password" => $_POST["nuevoPassword"],
                                        "rol" => $idRol,
                                        "foto" => "vistas/img/usuarios/default/anonymous.png",
                                        "email" => $_POST["nuevoEmail"]);
                                    

                            $crearUsuario = ControladorUsuarios::ctrCrearUsuario($datos);                        


                            if($crearUsuario == true){

                                $tabla1 = "tbl_personas";
                                $tabla2 = "tbl_usuarios";
                                
                                $item = "usuario";
                                $valor = $datos["usuario"];

                                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);
                                
                                $descripcionEvento = "Se envio correo con usuario y contraseña a ".$datos['usuario']."";
                                $accion = "Auto-registro";
                                $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($respuesta['id_usuario'], 30, $accion, $descripcionEvento);

                                $descripcionEvento = "".$datos['nombre']." se auto-registro";
                                $accion = "Auto-registro";
                                $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($respuesta['id_usuario'], 30, $accion, $descripcionEvento);						
                                
                                echo '<script>
                                        Swal.fire({
                                            title: "¡Sus datos han sido guardados correctamente!",
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
                                        title: "¡No se pudo guardar sus datos, intente de nuevo!",
                                        icon: "error",
                                        heightAuto: false,
                                        allowOutsideClick: false,
                                        timer: 4000
                                    });					
                                </script>';
                        }

                } else if($tipoPersona == 'usuarios') {                    

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
                    
                    // var_dump($respuestaPersona);
                    // return;

                    if($respuestaPersona == true){
                        
                        $totalId = array();
                        $tabla = "tbl_personas";
                        // $tabla2 = null;
                        $item = null;
                        $valor = null;
                        $all = null;

                        $personaTotal = ModeloPersonas::mdlMostrarPersonas($tabla, $item, $valor, $all);
                        
                        foreach($personaTotal as $keyPersona => $valuePersona){
                        array_push($totalId, $valuePersona["id_personas"]);
                        }

                        $idPersona = end($totalId);

                        // echo $idPersona;
                        // return;
                            // if($tipoPersona == "usuarios"){
                            
                            $datos = array("id_persona" => $idPersona,
                                        "nombre" => $_POST["nuevoNombre"],
                                        "usuario" => $_POST["nuevoUsuario"],
                                        "password" => $_POST["nuevoPassword"],
                                        "rol" => $_POST["nuevoRol"],
                                        "foto" => $_FILES["nuevaFoto"],
                                        "email" => $_POST["nuevoEmail"]);

                            $crearUsuario = ControladorUsuarios::ctrCrearUsuario($datos);
                            
                            // var_dump($crearUsuario);
                            // return;

                            if($crearUsuario == true){
                                echo '<script>
                                        Swal.fire({
                                            title: "¡Usuario creado correctamente!",
                                            icon: "success",
                                            heightAuto: false
                                        }).then((result)=>{
                                            if(result.value){
                                                window.location = "'.$pantalla.'";
                                            }
                                        });                                      
                                    </script>';

                            } else {

                                $tabla = 'tbl_personas';
                                $borrarPersona = ModeloPersonas::mdlBorrarPersona($tabla, $idPersona);

                                if($borrarPersona == true) {

                                    echo '<script>
                                            Swal.fire({
                                                title: "¡Llenar los campos correctamente e intente de nuevo!",
                                                icon: "error",
                                                heightAuto: false
                                            }).then((result)=>{
                                                if(result.value){
                                                    window.location = "'.$pantalla.'";
                                                }
                                            });                                      
                                        </script>';

                                } 
                            }

                    } else {
                        echo '<script>
                                Swal.fire({
                                    title: "Llene los campos correctamente.",
                                    icon: "error",									
                                    heightAuto: false,
                                    showConfirmButton: true,
                                });					
                            </script>';
                    }


                } else {
                    // echo "<pre>";
                    // var_dump($_POST);
                    // echo "</pre>";
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
                        // echo "<pre>";
                        // var_dump($respuestaPersona);
                        // echo "</pre>";
                        // return;
                         
                        
                        if($respuestaPersona == true){
                            
                         
                            $totalId = array();
                            $tabla = "tbl_personas";
                            // $tabla2 = "tbl_clientes";
                            $item = null;
                            $valor = null;
                            $all = null;

                            $personaTotal = ModeloPersonas::mdlMostrarPersonas($tabla, $item, $valor, $all);
                            
                            foreach($personaTotal as $keyPersona => $valuePersona){
                            array_push($totalId, $valuePersona["id_personas"]);
                            }

                            $idPersona = end($totalId);
                            

                            if ($_POST['tipoCliente'] == "Gimnasio"){

                                if($_POST["nuevoPrecioDescuento"] == 0){
                                    $id_descuento = null;
                                    $pago_descuento = 0;
                                    // return 'si, cero';
                                } else {
                                    $id_descuento = $_POST["nuevaPromocion"];
                                    $pago_descuento = $_POST["nuevoPrecioDescuento"];
                                    // return 'no, no es cero';
                                }

                                $datos = array("id_persona" => $idPersona,
                                "tipo_cliente" => $_POST["tipoCliente"],
                                "id_inscripcion" => $_POST["nuevaInscripcion"],
                                "id_matricula" => $_POST["nuevaMatricula"],
                                "id_descuento" => $id_descuento,
                                "pago_matricula" => $_POST["nuevoPrecioMatricula"],
                                "pago_descuento" => $pago_descuento,
                                "pago_inscripcion" => $_POST["nuevoPrecioInscripcion"],
                                "pago_total" => $_POST["nuevoTotalCliente"]);
                            } else {
                                $datos = array("id_persona" => $idPersona,
                                "tipo_cliente" => $_POST["tipoCliente"]);
                            }

                            
                            $crearCliente = ControladorClientes::ctrCrearCliente($datos);
                            // echo "<pre>";
                            // var_dump($crearCliente);
                            // echo "</pre>";
                            // return;                            
                            

                            
                            if($crearCliente == true){
                                echo '<script>
                                        Swal.fire({
                                            title: "¡Cliente creado correctamente!",
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


    /*=============================================
    EDITAR PERSONAS
    =============================================*/ 
    static public function ctrEditarPersona($ajustes, $tipoPersona, $pantalla){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
   
        // return;
        if(isset($_POST["editarNombre"])){
        
            if($ajustes != null) {
                
                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) && 
                preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/', $_POST["editarEmail"])){

                    $tabla = "tbl_personas";
                    
                    if($tipoPersona == 'usuarios') {                    

                        // echo "<pre>";
                        // var_dump($_POST);
                        // echo "</pre>";
                        // // return;
                        // var_dump($_FILES);
                        // echo $tipoPersona;
                        // return;

                        $datos = array("nombre" => $_POST["editarNombre"],
                                    "apellido" => $_POST["editarApellido"],
                                    "id_documento" => $_POST["editarTipoDocumento"],
                                    "numero_documento" => $_POST["editarNumeroDocumento"],
                                    "tipo_persona" => $tipoPersona,
                                    "fecha_nacimiento" => $_POST["editarFechaNacimiento"],
                                    "sexo" => $_POST["editarSexo"],
                                    "telefono" => $_POST["editarTelefono"],
                                    "direccion" => $_POST["editarDireccion"],
                                    "email" => $_POST["editarEmail"],
                                    "id_persona" => $_POST["idPersona"]);

                        $respuestaPersona = ModeloPersonas::mdlEditarPersona($tabla, $datos);
                        if($respuestaPersona == true){
                            echo '<script>
                                    Swal.fire({
                                        title: "¡Datos guardados correctamente!",
                                        icon: "success",
                                        heightAuto: false
                                    }).then((result)=>{
                                        if(result.value){
                                            window.location = "'.$pantalla.'";
                                        }
                                    });                                      
                                </script>';
                        }
                    }
                }
            } else {

                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) && 
                preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/', $_POST["editarEmail"])){

                
                $tabla = "tbl_personas";
                
                if($tipoPersona == 'usuarios') {                    

                    // echo "<pre>";
                    // var_dump($_POST);
                    // echo "</pre>";
                    // return;
                    // var_dump($_FILES);
                    // echo $tipoPersona;
                    // return;

                    $datos = array("nombre" => $_POST["editarNombre"],
                                "apellido" => $_POST["editarApellido"],
                                "id_documento" => $_POST["editarTipoDocumento"],
                                "numero_documento" => $_POST["editarNumeroDocumento"],
                                "tipo_persona" => $tipoPersona,
                                "fecha_nacimiento" => $_POST["editarFechaNacimiento"],
                                "sexo" => $_POST["editarSexo"],
                                "telefono" => $_POST["editarTelefono"],
                                "direccion" => $_POST["editarDireccion"],
                                "email" => $_POST["editarEmail"],
                                "id_persona" => $_POST["idPersona"]);

                    $respuestaPersona = ModeloPersonas::mdlEditarPersona($tabla, $datos);
                    
                    // if($tipoPersona == 'usuarios') {                    

                    //     // echo "<pre>";
                    //     // var_dump($_POST);
                    //     // echo "</pre>";
                    //     // // return;
                    //     // var_dump($_FILES);
                    //     // echo $tipoPersona;
                    //     // return;

                    //     $datos = array("nombre" => $_POST["editarNombre"],
                    //                 "apellido" => $_POST["editarApellido"],
                    //                 "id_documento" => $_POST["editarTipoDocumento"],
                    //                 "numero_documento" => $_POST["editarNumeroDocumento"],
                    //                 "tipo_persona" => $tipoPersona,
                    //                 "fecha_nacimiento" => $_POST["editarFechaNacimiento"],
                    //                 "sexo" => $_POST["editarSexo"],
                    //                 "telefono" => $_POST["editarTelefono"],
                    //                 "direccion" => $_POST["editarDireccion"],
                    //                 "email" => $_POST["editarEmail"],
                    //                 "id_persona" => $_POST["idPersona"]);

                    //     $respuestaPersona = ModeloPersonas::mdlEditarPersona($tabla, $datos);
                        // var_dump($respuestaPersona);
                        // return;

                        if($respuestaPersona == true){
                            // echo '<script>
                            //         Swal.fire({
                            //             title: "Editada correctamente!",
                            //             icon: "success",
                            //             heightAuto: false
                            //         }).then((result)=>{
                            //             if(result.value){
                            //                 window.location = "'.$pantalla.'";
                            //             }
                            //         });                                      
                            //     </script>';
                            
                            //     return;
                            
                            $datos = array("id_persona" => $_POST["idPersona"],
                                        "nombre" => $_POST["editarNombre"],
                                        "usuario" => $_POST["editarUsuario"],
                                        "password_nueva" => $_POST["editarPassword"],
                                        "password_actual" => $_POST["passwordActual"],
                                        "rol" => $_POST["editarRol"],
                                        "foto_nueva" => $_FILES["editarFoto"],
                                        "foto_actual" => $_POST["fotoActual"],
                                        "email" => $_POST["editarEmail"]);

                            $editarUsuario = ControladorUsuarios::ctrEditarUsuario($datos);
                            // var_dump($editarUsuario);
                            // return;
                            
                            if($editarUsuario == true){
                                // return;
                                echo '<script>
                                        Swal.fire({
                                            title: "¡Usuario editado correctamente!",
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
                            echo '<script>
                                    Swal.fire({
                                        title: "Error al editar",
                                        icon: "error",
                                        heightAuto: false
                                    }).then((result)=>{
                                        if(result.value){
                                            window.location = "'.$pantalla.'";
                                        }
                                    });                                      
                                </script>';
                            
                                return;
                        }

                        // } else {
                        //     echo '<script>
                        //             Swal.fire({
                        //                 title: "Error al editar",
                        //                 icon: "error",
                        //                 heightAuto: false
                        //             }).then((result)=>{
                        //                 if(result.value){
                        //                     window.location = "'.$pantalla.'";
                        //                 }
                        //             });                                      
                        //         </script>';
                            
                        //         return;
                    // }

                } else {
                    // echo "<pre>";
                    // var_dump($_POST);
                    // echo "</pre>";
                    // return;
                    // if ($_POST["idEditarCliente"] == "Gimnasio") {

                    // EDITAR CLIENTE GIMNASIO
                        
                    $datos = array("nombre" => $_POST["editarNombre"],
                    "apellido" => $_POST["editarApellido"],
                    "id_documento" => $_POST["editarTipoDocumento"],
                    "numero_documento" => $_POST["editarNumeroDocumento"],
                    "tipo_persona" => $tipoPersona,
                    "fecha_nacimiento" => $_POST["editarFechaNacimiento"],
                    "sexo" => $_POST["editarSexo"],
                    "telefono" => $_POST["editarTelefono"],
                    "direccion" => $_POST["editarDireccion"],
                    "email" => $_POST["editarEmail"],
                    "id_persona" => $_POST['idEditarCliente']);
                    // }
                    
                    

                    $respuestaDeEditarPersona = ModeloPersonas::mdlEditarPersona($tabla, $datos);
                    // echo "<pre>";
                    // var_dump($respuestaDeEditarPersona);
                    // echo "</pre>";
                    // return;        
    
                    if($respuestaDeEditarPersona == true){

                        $descripcionEvento = "".$_SESSION['usuario']." Actualizó el cliente de gimnasio llamado ".$_POST["editarNombre"]."";
					    $accion = "Actualizar";
					    $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION['id_usuario'], 4, $accion, $descripcionEvento);
					    
                        
                        echo '<script>
                                Swal.fire({
                                    title: "¡Cliente fue editado correctamente!",
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
                    // }
                }

            } else {
                if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) && 
                    preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/', $_POST["editarEmail"])){

                            $tabla = "tbl_personas";
                            
                            if($tipoPersona == 'usuarios') {                    

                                // echo "<pre>";
                                // var_dump($_POST);
                                // echo "</pre>";
                                // // return;
                                // var_dump($_FILES);
                                // echo $tipoPersona;
                                // return;

                                $datos = array("nombre" => $_POST["editarNombre"],
                                            "apellido" => $_POST["editarApellido"],
                                            "id_documento" => $_POST["editarTipoDocumento"],
                                            "numero_documento" => $_POST["editarNumeroDocumento"],
                                            "tipo_persona" => $tipoPersona,
                                            "fecha_nacimiento" => $_POST["editarFechaNacimiento"],
                                            "sexo" => $_POST["editarSexo"],
                                            "telefono" => $_POST["editarTelefono"],
                                            "direccion" => $_POST["editarDireccion"],
                                            "email" => $_POST["editarEmail"],
                                            "id_persona" => $_POST["idPersona"]);

                                $respuestaPersona = ModeloPersonas::mdlEditarPersona($tabla, $datos);
                                if($respuestaPersona == true){
                                    echo '<script>
                                            Swal.fire({
                                                title: "¡Datos guardados correctamente!",
                                                icon: "success",
                                                heightAuto: false
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
            }
        }
    }

    /*=============================================
    EDITAR CLIENTE VENTAS
    =============================================*/
    
    static public function ctrEditarClienteVentas($tipoCliente, $pantalla) {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        // return;

        if (isset($_POST["nombreClienteVentas"])) {
           

            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreClienteVentas"]) && 
            preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/', $_POST["editarEmailVentas"])){

                if($tipoCliente == 'clientes') {

                    $tabla = "tbl_personas";

    
                    $datos = array("nombre" => $_POST["nombreClienteVentas"],
                    "apellido" => $_POST["apellidoClienteVentas"],
                    "id_documento" => $_POST["tipoDocumentoClienteVentas"],
                    "numero_documento" => $_POST["numeroDocumentoClienteVentas"],
                    "tipo_persona" => $tipoCliente,
                    "fecha_nacimiento" => $_POST["fechaNacimientoClienteVentas"],
                    "sexo" => $_POST["editarSexoClienteVentas"],
                    "telefono" => $_POST["telefonoClienteVentas"],
                    "direccion" => $_POST["direccionClienteVentas"],
                    "email" => $_POST["editarEmailVentas"],
                    "id_persona" => $_POST['idEditarClienteVenta']);
                 
                    $respuestaClienteVenta = ModeloPersonas::mdlEditarPersona($tabla, $datos);
                    // echo "<pre>";
                    // var_dump($respuestaClienteVenta);
                    // echo "</pre>";
                    // return;

                    
                    if($respuestaClienteVenta == true){
                        
                        // $idPersona = end($totalId);
                        // echo "<pre>";
                        // var_dump($idPersona);
                        // echo "</pre>";
                        // return;
            
                        if ($_POST['editarTipoClienteVenta'] == "Gimnasio"){

                            if($_POST["editarPrecioDescuento"] == 0){
                                $id_descuento = null;
                                $pago_descuento = 0;
                                // return 'si, cero';
                            } else {
                                $id_descuento = $_POST["editarPromocionClienteVenta"];
                                $pago_descuento = $_POST["editarPrecioDescuento"];
                                // return 'no, no es cero';
                            }

            
                            $datos = array("id_persona" => $_POST["idEditarClienteVenta"],
                            "tipo_cliente" => $_POST["editarTipoClienteVenta"],
                            "id_inscripcion" => $_POST["inscripcionClienteVenta"],
                            "id_matricula" => $_POST["tipoMatriculaClienteVenta"],
                            "id_descuento" => $id_descuento,
                            "pago_matricula" => $_POST["precioMatriculaClienteVentas"],
                            "pago_descuento" => $pago_descuento,
                            "pago_inscripcion" => $_POST["precioInscripcionClienteVenta"],
                            "pago_total" => $_POST["totalPagarClienteVenta"]);
                        } else {
                            $datos = array("id_persona" => $_POST["idEditarClienteVenta"],
                            "tipo_cliente" => $_POST["editarTipoClienteVenta"]);
                        }
            
                        
                        $crearClienteVenta = ControladorClientes::ctrEditarCliente($datos);
                        // echo "<pre>";
                        // var_dump($crearClienteVenta);
                        // echo "</pre>";
                        // return;     
                                               
                        if($crearClienteVenta == true){
                            echo '<script>
                                    Swal.fire({
                                        title: "¡Cliente editado correctamente!",
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
    /*=============================================
    ACTUALIZAR PAGO CLIENTE
    =============================================*/
    static public function ctrActualizarPagoCliente($tipoPersona, $pantalla){
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        // return;

        if (isset($_POST["actualizarInscripcion"])){
    
            $datos = array("id_persona" => $_POST["idPago"],
            "tipo_cliente" => $tipoPersona,
            "id_inscripcion" => $_POST["actualizarInscripcion"],
            "id_descuento" => $_POST["actualizarDescuento"],
            "pagos_descuento" => $_POST["precioDescuentoActualizado"],
            "pagos_inscripcion" => $_POST["precioInscripcionActualizado"],
            "pagos_total" => $_POST["nuevoTotalPago"]);
        } 
        // echo "<pre>";
        // var_dump($datos);
        // echo "</pre>";
        // return;
        

        $respuestaEditarPagoCliente = ControladorClientes::ctrEditarCliente($datos);

        // echo "<pre>";
        // var_dump($datos);
        // echo "</pre>";
        // return;

        if($respuestaEditarPagoCliente == true){

            $descripcionEvento = "Actualizó pago cliente";
            $accion = "Actualizó";
  
            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 3,$accion, $descripcionEvento);
  
            
            echo '<script>
                    Swal.fire({
                        title: "¡Pago fue editado correctamente!",
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
    
	/*=============================================
    BORRAR PERSONAS (USUARIO/CLIENTE)
	=============================================*/
    static public function ctrBorrarPersona($tipoPersona, $pantalla){
        // var_dump($_GET);
        // return;

        if(isset($_GET['idPersona'])){
            $tabla = 'tbl_personas';
            $datos = $_GET['idPersona'];


            $respuesta = ModeloPersonas::mdlBorrarPersona($tabla, $datos);
            
            // var_dump($respuesta);
            // return;
            
            if($respuesta[1] == 1451){
      
                echo '<script>
                    Swal.fire({
                        title: "¡No se pudo borrar el '.$tipoPersona.'!",
                        text: "¡No se puede borrar ya que está asociado con otros datos!",
                        icon: "error",
                        heightAuto: false
                    }).then((result)=>{
                        if(result.value){
                            window.location = "'.$pantalla.'";
                        }
                    });                                      
                </script>';

            } else if($tipoPersona == 'usuario') {
                $descripcionEvento = "".$_SESSION["usuario"]." Eliminó el usuario ".$_GET['usuario']."";
                $accion = "Eliminar";
    
                $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 2,$accion, $descripcionEvento);
    
                          
                if($_GET['fotoUsuario'] != ""){
                    unlink($_GET['fotoUsuario']);
                    rmdir('vistas/img/usuarios/'.$_GET['usuario']);
                }
                echo '<script>
                        Swal.fire({
                            title: "¡El usuario ha sido eliminado correctamente!",
                            icon: "success",
                            heightAuto: false
                        }).then((result)=>{
                            if(result.value){
                                window.location = "'.$pantalla.'";
                            }
                        });                                      
                    </script>';
                    
            } else {
                
                $descripcionEvento = " Eliminó un cliente.";
                $accion = "Elimino";
    
                $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 3,$accion, $descripcionEvento);
    
              
                echo '<script>
                        Swal.fire({
                            title: "¡El cliente ha sido eliminado correctamente!",
                            icon: "success",
                            heightAuto: false
                        }).then((result)=>{
                            if(result.value){
                                window.location = "'.$pantalla.'";
                            }
                        });                                      
                    </script>';
            }
        }
    }

    /*=============================================
    BORRAR BITACORA
    =============================================*/
    static public function ctrBorrarBitacora($pantalla){
        // var_dump($_GET);
        // return;

        if(isset($_GET['idBitacora'])){
            $tabla = 'tbl_bitacora';
            $datos = $_GET['idBitacora'];


            $respuesta = ModeloPersonas::mdlBorrarBitacora($tabla, $datos);
            
            // var_dump($respuesta);
            // return;
            

            if ($respuesta==true) {

                $tablaLog='tbl_bitacora_log';
                $item=$_GET['idBitacora'];
                $usuario=$_SESSION['usuario'];
                
                $respuestaLog = ModeloPersonas::mdlIngresarLog($tablaLog,$usuario,$item);

                echo '<script>
                        Swal.fire({
                            title: "El registro ha sido borrado correctamente!",
                            icon: "success",
                            heightAuto: false
                        }).then((result)=>{
                            if(result.value){
                                window.location = "'.$pantalla.'";
                            }
                        });                                      
                    </script>';
            }else{
                echo '<script>
                    Swal.fire({
                        title: "No se pudo borrar el registro!",
                        text: "No se puede borrar",
                        icon: "error",
                        heightAuto: false
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