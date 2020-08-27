<?php
error_reporting(E_ALL & ~E_NOTICE);
class ControladorUsuarios{

	/*=============================================
				MOSTRAR USUARIOS
	=============================================*/

	static public function ctrMostrarUsuarios($tabla, $item, $valor) {

		$tabla1 = "personas";
		$tabla2 = $tabla;
		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

		return $respuesta;

	}

	/*=============================================
				MOSTRAR (DINAMICO)
	=============================================*/

	static public function ctrMostrar($tabla, $item, $valor) {

		$tabla1 = $tabla;
		$respuesta = ModeloUsuarios::mdlMostrar($tabla1, $item, $valor);

		return $respuesta;

	}

	
	/*=============================================
			MOSTRAR MODULOS POR ROL-USUARIO
	=============================================*/

	static public function ctrMostrarUsuarioModulo($item1, $item2, $valor1, $valor2){

		$respuesta = ModeloUsuarios::mdlMostrarUsuarioModulo($item1, $item2, $valor1, $valor2);

		return $respuesta;
	}

	/*=============================================
			INGRESO DE USUARIO
	=============================================*/

	public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[A-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/', $_POST["ingPassword"])){

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$_SESSION['contadorLogin'] = 0;

				$tabla1 = "personas";
				$tabla2 = "empleados";
				
				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){
					
					if($respuesta["estado"] == 1) {

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["apellidos"] = $respuesta["apellidos"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["rol"] = $respuesta["rol"];

						/* =====REGISTRAR FECHA Y HORA PARA SABER EL ULTIMO LOGIN ====== */

						date_default_timezone_set('America/Tegucigalpa');

						$fecha = date('Y-m-d');
						$hora = date('H:i:s');

						$fechaActual = $fecha." ".$hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id_persona";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2);

						if($ultimoLogin == "ok"){

							echo '<script>
							
								Swal.fire({
									title: "Bienvenido",
									icon: "success",
									heightAuto: false,
									allowOutsideClick: false
								}).then((result)=>{
									if(result.value){
										window.location = "dashboard";
									}
								});
								</script>';

						}


					} else {
						echo '<script>			
								Swal.fire({
									title: "Usuario desactivado, comuniquese con el administrador.",
									icon: "error",
									heightAuto: false,
									allowOutsideClick: false
								});
							</script>';
						// echo '<br><div class="alert alert-danger">El usuario no esta activado, comuniquese con el administrador</div>';
					}

				} else {
					echo '<br><div class="alert alert-danger">¡Usuario y contraseña incorrectos! Vuelve a intentar.</div>';
				}
				
			} else {

				echo '<script>			
						Swal.fire({
							title: "Usuario y contraseña incorrectos! Intente de nuevo.",
							icon: "error",
							heightAuto: false,
							allowOutsideClick: false
						});
					</script>';
			}
			// else {
			// 	//INTENTOS DE LOGUEARSE PERMITIDOS SOLO 3 AL REBASARLOS SE DESACTIVARA EL USUARIO INGRESADO AUTOMATICAMENTE.
			// 	$intentos = 3;
			// 	$_SESSION['contadorLogin'] = $_SESSION['contadorLogin'] + 1; 

			// 	$intentos = $intentos - ($_SESSION['contadorLogin']);


			// 	if($_SESSION['contadorLogin'] === 3) {
			// 		$tabla = "usuarios";
				
			// 		$item = "usuario";
			// 		$valor = $_POST["ingUsuario"];	

			// 		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

			// 		if($respuesta["usuario"] == $_POST["ingUsuario"]){
			// 			$tabla = "usuarios";
			// 			$item1 = "estado";
			// 			$valor1 = 0;

			// 			$item2 = "usuario";
			// 			$valor2 = $_POST["ingUsuario"];

			// 			$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

			// 			if($respuesta == "ok"){
			// 				// echo '<br><div class="alert alert-danger">¡Lo sentimos! Su usuario ha sido desactivado, comuniquese con el Administrador</div>';
							
			// 				echo '<script>
			// 						swal({
			// 							type: "warning",
			// 							title: "¡Lo sentimos! Su usuario ha sido desactivado, comuniquese con el Administrador",
			// 							showConfirmButton: true,
			// 							confirmButtonText: "Cerrar",
			// 							closeOnConfirm: false
			// 						})
			// 						</script>';
			// 				session_destroy();
			// 			}
						
			// 		}
							
			
			// 	} else {
					
			// 		echo '<br><div class="alert alert-danger">¡Usuario y contraseña invalidos! Intento: '.$_SESSION['contadorLogin'] .', tiene '.$intentos.' intento mas </div>';
					
			// 	}
				
			// }
			
		
		
		}
	


	}

	/*=============================================
			REGISTRO DE PERSONAS
	=============================================*/

	static public function ctrCrearUsuario(){

		if(isset($_POST["nuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])){

				$tabla1 = "personas";

				$datos = array("nombre" => $_POST["nuevoNombre"],
							   "apellido" => $_POST["nuevoApellido"],
							   "identidad" => $_POST["nuevaIdentidad"],
							   "fecha_nacimiento" => $_POST["nuevaFechaNacimiento"],
							   "sexo" => $_POST["nuevoSexo"],
							   "telefono" => $_POST["nuevoTelefono"],
							   "direccion" => $_POST["nuevaDireccion"],
							   "email" => $_POST["nuevoEmail"]);

				$respuestaPersona = ModeloUsuarios::mdlIngresarPersona($tabla1, $datos);
				
					if($respuestaPersona == true){

						$totalId = array();

						$tabla2 = null;
						$item = null;
						$valor = null;

						$personasTotal = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

						foreach($personasTotal as $keyPersonas => $valuePersonas){
							array_push($totalId, $valuePersonas["id"]);
						}

						$idPersona = end($totalId);

						if(isset($_POST["nuevoTipoPersona"]) && $_POST["nuevoTipoPersona"]  == "empleado"){

							$tabla2 = "empleados";

							if(preg_match('/^[A-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
								preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/', $_POST["nuevoPassword"])){

							/*=============================================
									VALIDAR IMAGEN
							=============================================*/

								$ruta = "";

								if(isset($_FILES["nuevaFoto"]["tmp_name"])){

									list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

									$nuevoAncho = 500;
									$nuevoAlto = 500;

									/*==============================================================
									CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
									===============================================================*/

									$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

									mkdir($directorio, 0755); 

									/*=====================================================================
									DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
									======================================================================*/

									if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

										/*=============================================
										GUARDAMOS LA IMAGEN EN EL DIRECTORIO
										=============================================*/

										$aleatorio = mt_rand(100,999);

										$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

										$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

										$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

										imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

										imagejpeg($destino, $ruta);

									}

									if($_FILES["nuevaFoto"]["type"] == "image/png"){

										/*=============================================
										GUARDAMOS LA IMAGEN EN EL DIRECTORIO
										=============================================*/

										$aleatorio = mt_rand(100,999);

										$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

										$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

										$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

										imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

										imagepng($destino, $ruta);

									}

								}
							

								/*================== ENCRIPTAMOS LA CONTRASEÑA ===================*/
								$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

								$datos = array("id_persona" => $idPersona,
											"usuario" => $_POST["nuevoUsuario"],
											"password" => $encriptar,
											"rol" => $_POST["nuevoRol"],
											"foto" => $ruta);

								$respuestaEmpleado = ModeloUsuarios::mdlIngresarUsuarioEmpleado($tabla2, $datos);

								if($respuestaEmpleado = true){
										
									$totalIdUsuarios = array();

									$tabla1 = "empleados";
									$tabla2 = null;
									$item = null;
									$valor = null;

									$usuariosTotal = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

									foreach($usuariosTotal as $keyUsuarios => $valueUsuarios){
										array_push($totalIdUsuarios, $valueUsuarios["id"]);
									}

									$idUsuario = end($totalIdUsuarios);

									$tabla3 = "usuario_pregunta";
									
									$datos = array("idUsuario" => $idUsuario,
												   "idPregunta" => $_POST["nuevaPregunta"],
												   "respuesta" => $_POST["respuestaPregunta"]);

												   
									$respuestaPreguntas = ModeloUsuarios::mdlIngresarPreguntaUsuario($tabla3, $datos);

									if($respuestaPreguntas == true){
										echo '<script>
											Swal.fire({
												title: "Empleado guardado correctamente!",
												icon: "success"
											})
									
										</script>';
									}


								}
							} else {

								echo "<script>
								Swal.fire({
										icon: 'error',
										title: '¡Llenar campos correctamente!',
									})
								</script>";

							}

						} else {
							$tabla4 = "clientes";
							
							$datos = array("id_persona" => $idPersona);

							$respuestaCliente = ModeloUsuarios::mdlIngresarCliente($tabla4, $datos);

							if($respuestaCliente = true){
										
								echo '<script>
									Swal.fire({
										title: "Cliente guardado correctamente!",
										icon: "success"
									})
							
								</script>';

							}

						}

					} else {
						echo '<script>
						Swal.fire(
							"Error!",
							"error"
						)
				
					</script>';
					}


			}else{

				echo "<script>
					Swal.fire({
						icon: 'error',
						title: '¡Llenar campos correctamente!',
					})
				</script>";

						// swal({
						// 	type: "error",
						// 	title: "¡Llenar campos correctamente!",
						// 	showConfirmButton: true,
						// 	confirmButtonText: "Cerrar",
						// 	closeOnConfirm: false
						// }).then((result)=>{
						// 	if(result.value){
						// 		window.location = "inicio";
						// 	}
						// });

			}


		}


	}

	/*=============================================
                MOSTRAR PREGUNTAS
	=============================================*/	


	static public function ctrMostrarPreguntas($item, $valor) {

		// $tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlMostrarPreguntas($item, $valor);

		return $respuesta;

	}

	/*=============================================
                CAMBIAR CONTRASEÑA
	=============================================*/	
	
	static public function ctrCambiarContraseña($item, $valor, $post){

		$tabla = "empleados";
		
		// var_dump($_POST["editarPassword"]);		
		if(isset($post)){
			
			if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/', $post)){
				
				$encriptar = crypt($post, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				
				$item1 = "password";
				$valor1 = $encriptar;
		
				$item2 = $item;
				$valor2 = $valor;

				// $respuesta = ModeloUsuarios::mdlCambiarContraseña($tabla, $valor);
				$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
				return $respuesta;
			
				// if($respuesta == "ok"){
				// 	echo '<script>

				// 	swal({
						
				// 		type: "success",
				// 		title: "¡Contraseña cambiada!",
				// 		showConfirmButton: true,
				// 		confirmButtonText: "Cerrar",
				// 		closeOnConfirm: false
				// 		})


				// 		</script>';
				// } else {
				// 	echo '<script>

				// 	swal({
						
				// 		type: "error",
				// 		title: "¡Error!",
				// 		showConfirmButton: true,
				// 		confirmButtonText: "Cerrar",
				// 		closeOnConfirm: false
				// 		})


				// 		</script>';
				// }

			} else {

				echo '<script>
						swal({
							type: "error",
							title: "¡La contraseña no puede ir vacia!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						})
					</script>';

			}
					
		} 
		// else {
		// 	//Si no hay cambios en la contraseña, que guarde la que ya tiene.
		// 	$encriptar = $_POST["passwordActual"];
		// }
	}

}
	


