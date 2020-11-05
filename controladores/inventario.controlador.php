<?php

class ControladorInventario
{
        static public function ctrMostrarInventario($tabla, $item, $valor)
        {
                $tabla1 = "tbl_tipo_producto";
                $tabla2 = $tabla;

                $respuesta = ModeloInventario::mdlMostrarInventario($tabla1, $tabla2, $item, $valor);

                return $respuesta;
        }






        static public function ctrCrearstock($tipoPersona, $pantalla){

                if(isset($_POST["nuevoStock"])){
        
                    if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoStock"]) && 
                    preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/', $_POST["nuevoEmail"])){
        
                        $tabla = "tbl_inventario";
        
                        if($tipoPersona == 'default'){
                            
                            $datos = array("nombre_producto" => $_POST["Nnombre"],
                            "stock" => $_POST["Nstock"],
                            "id_tiipo_producto" => $_POST["Nidtipoproducto"],
                            "precio" => $_POST["Nprecio"],
                            "tipo_persona" => $tipoPersona,
                            "producto_minimo" => $_POST["Nproductominimo"],
                            "producto_maximo" => $_POST["Nproducto_maximo"];
        
                            $respuestaPersona = ModeloInventario::mdlCrearStock($tabla, $datos);
        
                                if($respuestaPersona == true){
                                    $totalId = array();
                                    $tabla = "tbl_inventario";
                                    // $tabla2 = null;
                                    // $item = null;
                                    // $valor = null;
            
                                    $personaTotal = ModeloInventario::mdlMostrarInventario($tabla);
                                    
                                    foreach($personaTotal as $keyPersona => $valuePersona){
                                    array_push($totalId, $valuePersona["id_inventario"]);
                                    }
            
                                    $idPersona = end($totalId);
                             





                                    
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