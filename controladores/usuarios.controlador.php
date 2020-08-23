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
				MOSTRAR ROLES
	=============================================*/

	static public function ctrMostrarRoles($item, $valor) {

		$tabla = "roles";
		$respuesta = ModeloUsuarios::mdlMostrarRoles($tabla, $item, $valor);

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
									icon: "success"
								}).then((result)=>{
									if(result.value){
										window.location = "inicio";
									}
								});
								</script>';

						}


					} else {

						echo '<br><div class="alert alert-danger">El usuario no esta activado, comuniquese con el administrador</div>';
					}

				} else {
					echo '<br><div class="alert alert-danger">¡Usuario y contraseña incorrectos! Vuelve a intentar.</div>';
				}
				
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

				$respuesta = ModeloUsuarios::mdlIngresarPersona($tabla1, $datos);
				
					if($respuesta == "ok"){

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

								$respuesta2 = ModeloUsuarios::mdlIngresarUsuarioEmpleado($tabla2, $datos);

								if($respuesta2 = "ok"){
										
									echo '<script>
										Swal.fire(
											"Empleado guardado correctamente!",
											"You clicked the button!",
											"success"
										)
								
									</script>';

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
							$tabla3 = "clientes";
							
							$datos = array("id_persona" => $idPersona);

							$respuesta3 = ModeloUsuarios::mdlIngresarCliente($tabla3, $datos);

							if($respuesta3 = "ok"){
										
								echo '<script>
									Swal.fire(
										title: "Cliente guardado correctamente!",
										icon: "success"
									)
							
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

}
	


