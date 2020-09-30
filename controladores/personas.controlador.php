<?php 

class ControladorPersonas{

    static public function ctrCrearPersona(){

        if(isset($_POST["nuevoNombre"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) && 
               preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/', $_POST["nuevoEmail"])){

				$tabla = "personas";

				$datos = array("nombre" => $_POST["nuevoNombre"],
							   "apellido" => $_POST["nuevoApellido"],
							   "identidad" => $_POST["nuevaIdentidad"],
							   "fecha_nacimiento" => $_POST["nuevaFechaNacimiento"],
							   "sexo" => $_POST["nuevoSexo"],
							   "telefono" => $_POST["nuevoTelefono"],
							   "direccion" => $_POST["nuevaDireccion"],
							   "email" => $_POST["nuevoEmail"]);

				$respuestaPersona = ModeloPersonas::mdlCrearPersona($tabla, $datos);
				
					if($respuestaPersona == true){

                        $totalId = array();

                        $tabla = "personas";
						// $tabla2 = null;
						// $item = null;
						// $valor = null;

						$personasTotal = ModeloPersonas::mdlMostrarPersonas($tabla);

						foreach($personasTotal as $keyPersonas => $valuePersonas){
							array_push($totalId, $valuePersonas["id"]);
						}

                        $idPersona = end($totalId);

                        if(isset($_POST["nuevoTipoPersona"]) && $_POST["nuevoTipoPersona"]  == "empleado"){
                            
                            $datos = array("id_persona" => $idPersona,
                                           "usuario" => $_POST["nuevoUsuario"],
                                           "password" => $_POST["nuevoPassword"],
                                           "rol" => $_POST["nuevoRol"],
                                           "foto" => $_FILES["nuevaFoto"]);

                            $crearUsuario = ControladorUsuarios::ctrCrearUsuario($datos);

                            if($crearUsuario == true){
                                echo '<script>
                                        Swal.fire({
                                            title: "Empleado guardado correctamente!",
                                            icon: "success"
                                        })
                                
                                    </script>';
                            }

                        } else {

                            $datos = array("id_persona" => $idPersona);

                            $crearCliente = ControladorClientes::ctrCrearCliente($datos);

                            if($crearCliente == true){
                                echo '<script>
                                        Swal.fire({
                                            title: "Cliente guardado correctamente!",
                                            icon: "success"
                                        })
                                
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
}