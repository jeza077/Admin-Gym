<?php
error_reporting(E_ALL & ~E_NOTICE);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

	static public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

			if($_POST["ingUsuario"] === "" && $_POST["ingPassword"] === ""){
				echo '<script>			
					Swal.fire({
						title: "No dejar los campos vacios.",
						icon: "error",
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
				</script>';
		
			} else {

				if(preg_match('/^[A-Z]+$/', $_POST["ingUsuario"]) &&
				preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $_POST["ingPassword"])){

					$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$tabla1 = "personas";
					$tabla2 = "empleados";
					
					$item = "usuario";
					$valor = $_POST["ingUsuario"];

					$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);
					// var_dump($respuesta['fecha_vencimiento']);
					
					$fechaVencimiento = date('Y-m-d', strtotime($respuesta['fecha_vencimiento']));
					// echo $fechaVencimiento;
					
					date_default_timezone_set('America/Tegucigalpa');
					$fechaHoy = date('Y-m-d');
					// echo $fechaHoy;
					// if($fechaHoy > $fechaVencimiento){
					// 	echo 'si, hoy es mayor';
					// } else if($fechaHoy < $fechaVencimiento){
					// 	echo 'no, hoy es menor';
					// } else {
					// 	echo 'son iguales';
					// }
					// return;

						if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

							$_SESSION["iniciarSesion"] = "ok";
							$_SESSION["id_usuario"] = $respuesta["id_usuario"];
							$_SESSION["id"] = $respuesta["id"];
							$_SESSION["usuario"] = $respuesta["usuario"];
							$_SESSION["nombre"] = $respuesta["nombre"];
							$_SESSION["apellidos"] = $respuesta["apellidos"];
							$_SESSION["foto"] = $respuesta["foto"];
							$_SESSION["rol"] = $respuesta["rol"];
							$_SESSION["primerIngreso"] = $respuesta["primera_vez"];

							
							if($respuesta["estado"] == 0 && $respuesta["bloqueado"] == 0 && $respuesta["primera_vez"] == 1 && $fechaHoy < $fechaVencimiento) {
			
								echo '<script>
								Swal.fire({
									title: "Bienvenid@ '.$_SESSION['nombre'] . " " . $_SESSION["apellidos"] . '",
									icon: "success",
									heightAuto: false,
									allowOutsideClick: false
								}).then((result)=>{
									if(result.value){
										window.location = "primer-ingreso";
									}
								});
								</script>';

							} else if($respuesta["estado"] == 1 && $respuesta["bloqueado"] == 0 && $respuesta["primera_vez"] == 0 && $fechaHoy < $fechaVencimiento || $respuesta["estado"] == 1 && $respuesta["bloqueado"] == 0 && $respuesta["primera_vez"] == 0 && $fechaHoy > $fechaVencimiento && $_POST['ingUsuario'] == 'SUPERADMIN') {

								//* =====REGISTRAR FECHA Y HORA PARA SABER EL ULTIMO LOGIN ====== */

								$fecha = date('Y-m-d');
								$hora = date('H:i:s');

								$fechaActual = $fecha." ".$hora;

								$item1 = "ultimo_login";
								$valor1 = $fechaActual;

								$item2 = "id_persona";
								$valor2 = $respuesta["id"];

								$item3 = null;
								$valor3 = null;

								$item4 = null;
								$valor4 = null;

								$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

								if($ultimoLogin == true){

									echo '<script>
										Swal.fire({
											title: "Bienvenid@ '.$_SESSION['nombre'] . " " . $_SESSION["apellidos"] . '",
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


							} else if($respuesta["estado"] == 1 && $respuesta["bloqueado"] == 1 || $respuesta["estado"] == 0 && $respuesta["bloqueado"] == 1) {

								echo '<script>			
										Swal.fire({
											title: "Usuario bloqueado, comuniquese con el administrador.",
											icon: "error",
											heightAuto: false,
											allowOutsideClick: false
										});
									</script>';
								
								session_destroy();

							} else if($respuesta["estado"] == 1 && $respuesta["bloqueado"] == 0 && $fechaHoy > $fechaVencimiento && $_POST['ingUsuario'] != 'SUPERADMIN'){
								
								echo '<script>			
										Swal.fire({
											title: "Su usuario ha vencido, comuniquese con el administrador.",
											icon: "error",
											heightAuto: false,
											allowOutsideClick: false
										});
									</script>';
								session_destroy();

							} else {

								echo '<script>			
										Swal.fire({
											title: "Usuario desactivado, comuniquese con el administrador.",
											icon: "error",
											heightAuto: false,
											allowOutsideClick: false
										});
									</script>';
							}

						} else {
				
							if($_POST["ingUsuario"] != 'SUPERADMIN') {
								//INTENTOS DE LOGUEARSE PERMITIDOS SOLO 3 AL REBASARLOS SE DESACTIVARA EL USUARIO INGRESADO AUTOMATICAMENTE.
								$item = 'parametro';
								$valor = 'ADMIN_INTENTOS';
								$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
								// var_dump($parametros);

								// return;
								$intentos = $parametros['valor'];
								$_SESSION['contadorLogin']++; 
								// $intentosRestantes = $intentos - $_SESSION['contadorLogin'];

								// $intentos = $intentos - $_SESSION['contadorLogin'];

								// echo $_SESSION['contadorLogin'];
								// echo $intentosRestantes;
								// session_destroy();

								if($_SESSION['contadorLogin'] == $intentos) {
									$tabla1 = "personas";
									$tabla2 = "empleados";
									
									$item = "usuario";
									$valor = $_POST["ingUsuario"];

									$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

									if($respuesta["usuario"] == $_POST["ingUsuario"]){
										$tabla = "empleados";
										$item1 = "bloqueado";
										$valor1 = 1;

										$item2 = "usuario";
										$valor2 = $_POST["ingUsuario"];
																	
										$item3 = null;
										$valor3 = null;

										$item4 = null;
										$valor4 = null;

										$respuestaEstado = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

										if($respuestaEstado == true){
											
											echo '<script>			
													Swal.fire({
														title: "¡Lo sentimos! Su usuario ha sido bloqueado, comuniquese con el Administrador.",
														icon: "error",
														heightAuto: false,
														allowOutsideClick: false
													}).then((result)=>{
														if(result.value){
															window.location = "login";
														}
													});
												</script>';

											session_destroy();
										}
										
									}									

								} else {
									
									// echo '<br><div class="alert alert-danger">¡Usuario y contraseña invalidos! Intento: '.$_SESSION['contadorLogin'] .', tiene '.$intentos.' intento mas </div>';
									echo '<script>			
											Swal.fire({
												title: "¡Usuario y contraseña invalidos!",
												icon: "error",
												toast: true,
												position: "top-end",
												showConfirmButton: false,
												timer: 3000,
											});
										</script>';
								}

							} else {
								echo '<script>			
										Swal.fire({
											title: "¡Usuario y contraseña invalidos!",
											icon: "error",
											toast: true,
											position: "top-end",
											showConfirmButton: false,
											timer: 3000,
										});
									</script>';
							}
							
						}
						
				} else {			
					
					echo '<script>			
						Swal.fire({
							title: "Usuario/contraseña incorrectos! Intente de nuevo.",
							icon: "error",
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
					</script>';
				
					
				}
			
			}
		
		
		}
	


	}

	/*=============================================
			REGISTRO DE PERSONAS
	=============================================*/
	static public function ctrCrearUsuario($datos){

		if(isset($datos["usuario"])){

			if(preg_match('/^[A-Z0-9]+$/', $datos["usuario"]) &&
			   preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $datos["password"])){

					/*=============================================
							VALIDAR IMAGEN
					=============================================*/

					$ruta = "";

					if(isset($datos["foto"]["tmp_name"])){

						list($ancho, $alto) = getimagesize($datos["foto"]["tmp_name"]);

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

						if($datos["foto"]["type"] == "image/jpeg"){

							/*=============================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
							=============================================*/

							$aleatorio = mt_rand(100,999);

							$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

							$origen = imagecreatefromjpeg($datos["foto"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagejpeg($destino, $ruta);

						}

						if($datos["foto"]["type"] == "image/png"){

							/*=============================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
							=============================================*/

							$aleatorio = mt_rand(100,999);

							$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

							$origen = imagecreatefrompng($datos["foto"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagepng($destino, $ruta);

						}

					}
								
						//**================= ENCRIPTAMOS LA CONTRASEÑA ===================*/
						$encriptar = crypt($datos["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');


						//** =============== CREAMOS LA FECHA VENCIMIENTO DEL USUARIO =================*/
						$item = 'parametro';
						$valor = 'ADMIN_DIAS_VIGENCIA';
						$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
				
						$vigenciaUsuario = $parametros['valor'];
						
						date_default_timezone_set("America/Tegucigalpa");
						$fechaVencimiento = date("Y-m-d H:i:s", strtotime('+'.$vigenciaUsuario.' days'));

						$tabla = "empleados";
						$datos = array("id_persona" => $datos["id_persona"],
									   "usuario" => $datos["usuario"],
									   "password" => $encriptar,
									   "rol" => $datos["rol"],
									   "foto" => $ruta,
									   "fecha_vencimiento" => $fechaVencimiento);

						$respuestaEmpleado = ModeloUsuarios::mdlIngresarUsuarioEmpleado($tabla, $datos);

						if($respuestaEmpleado = true){

							return true;

						} else {
							return false;
						}


				} else {

					echo "<script>
						Swal.fire({
								icon: 'error',
								title: '¡Llenar campos correctamente!',
							})
						</script>";

				}

						

		} else{

				echo "<script>
						Swal.fire({
							icon: 'error',
							title: '¡Llenar campos correctamente!',
						})
					</script>";

		}


	}


	/*=============================================
                MOSTRAR PREGUNTAS
	=============================================*/	
	static public function ctrMostrarPreguntas($item1, $valor1, $item2, $valor2, $item3, $valor3) {

		$respuesta = ModeloUsuarios::mdlMostrarPreguntas($item1, $valor1, $item2, $valor2, $item3, $valor3);

		return $respuesta;

	}


	/*=============================================
	CAMBIAR CONTRASEÑA POR PRIMERA VEZ Y AGREGAR PREGUNTAS
	=============================================*/	
	static public function ctrNuevaContraseñaPreguntasSeguridad($id, $usuario){

		if(isset($_POST["editarPassword"])){
			
			if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $_POST["editarPassword"]) && preg_grep('/^(?=.*[a-zñÑáéíóúÁÉÍÓÚ])\S{1,50}$/', $_POST["respuestaPregunta"])){
				// echo '<br><div class="alert alert-danger">bien.</div>';

				// return;
				
				
				$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			
				$tabla1 = "personas";
				$tabla2 = "empleados";

				$item = 'usuario';
				$valor = $usuario;

				$respuestaContraseñas = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

				// var_dump($respuestaContraseñas['password'] . ' ' . $encriptar);

				if($respuestaContraseñas['password'] == $encriptar){
					// echo '<br><div class="alert alert-danger">Contraseña igual a la anterior, intente de nuevo.</div>';
					echo '<script>			
						Swal.fire({
							title: "Contraseña no puede ser igual a la anterior. Por favor, intente de nuevo.",
							icon: "error",
							toast: true,
							position: "top",
							showConfirmButton: false,
							timer: 3000,
						});
					</script>';

				} else if($usuario == $_POST["editarPassword"]) {

					echo '<script>			
						Swal.fire({
							title: "Contraseña ingresada no puede ser igual al usuario. Por favor, intente de nuevo.",
							icon: "error",
							toast: true,
							position: "top",
							showConfirmButton: false,
							timer: 3000,
						});
					</script>';

				} else {
					$item1 = "password";
					$valor1 = $encriptar;
			
					$item2 = 'id';
					$valor2 = $id;

					$item3 = null;
					$valor3 = null;

					$item4 = null;
					$valor4 = null;

					$respuestaContraseña = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

					if($respuestaContraseña == true) {
						$tabla = "usuario_pregunta";
						
						$datos = array("idUsuario" => $id,
										"idPregunta" => $_POST["nuevaPregunta"],
										"respuesta" => $_POST["respuestaPregunta"]);
			
										
						$respuestaPreguntas = ModeloUsuarios::mdlIngresarPreguntaUsuario($tabla, $datos);
			
						if($respuestaPreguntas == true){

							$tabla = "empleados";

							$item1 = 'estado';
							$valor1 = 1;

							$item2 = "primera_vez";
							$valor2 = 0;
			
							$item3 = 'id';
							$valor3 = $id;

							$item4 = null;
							$valor4 = null;
			
							$respuestaEstadoPrimeraVez = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

							if($respuestaEstadoPrimeraVez == true) {
								echo '<script>
									Swal.fire({
										title: "Contraseña y preguntas guardadas correctamente.",
										icon: "success"
									}).then((result)=>{
										if(result.value){
											window.location = "salir";
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
							title: "Por favor, llena los campos corectamente. Intente de nuevo.",
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
	CAMBIAR CONTRASEÑA POR PREGUNTAS DE SEGURIDAD
	=============================================*/	
	static public function ctrCambiarContraseña($item, $valor, $itemUsuario, $valorUsuario, $post){

		$tabla1 = "personas";
		$tabla2 = "empleados";
			
		if(isset($post)){
			
			if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $post)){
				
				$encriptar = crypt($post, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$respuestaContraseñas = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $itemUsuario, $valorUsuario);

				// return $respuestaContraseñas;

				if($respuestaContraseñas['password'] == $encriptar){

					return false;

				} else if($valorUsuario == $post) {

					return false;
					
				} else {
					
					//** =============== CREAMOS LA FECHA VENCIMIENTO DEL USUARIO =================*/
					$itemParam = 'parametro';
					$valorParam = 'ADMIN_DIAS_VIGENCIA';
					$parametros = ControladorUsuarios::ctrMostrarParametros($itemParam, $valorParam);
			
					$vigenciaUsuario = $parametros['valor'];

					date_default_timezone_set("America/Tegucigalpa");
					$fechaVencimiento = date("Y-m-d H:i:s", strtotime('+'.$vigenciaUsuario.' days'));

					$item1 = "password";
					$valor1 = $encriptar;

					$item2 = 'bloqueado';
					$valor2 = 0;

					$item3 = "fecha_vencimiento";
					$valor3 = $fechaVencimiento;
					
					$item4 = $item;
					$valor4 = $valor;
	
					$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
					return $respuesta;
				
				}
				
			
			} else {

				$respuesta = false;
				return $respuesta;

			}
					
		} 
	
	}

	
	/*=============================================
		ACTUALIZAR USUARIO
	=============================================*/	
	static public function ctrActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){
		
		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
		return $respuesta;
	
	}

	/*=============================================
		CAMBIAR CONTRASEÑA POR CODIGO-CORREO
	=============================================*/	
	static public function ctrCambiarContraseñaPorCodigo(){

		$tabla1 = "personas";
		$tabla2 = "empleados";
		$item = "codigo";
		$valor = $_GET['codigo'];

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

		// var_dump($respuesta['usuario']);
		// return;
		
		$idUsuario = $respuesta['id_usuario'];
		$usuario = $respuesta['usuario'];
		$passwordAnterior = $respuesta['password'];
		
		if(isset($_POST['editarPassword'])){
			
			if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $_POST['editarPassword'])){
				
				$encriptar = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			
				if($passwordAnterior === $encriptar){
					echo '<script>
							Swal.fire({
								title: "Contraseña ingresada no cumple con los requisitos, intente de nuevo.",
								icon: "error",
								toast: true,
								position: "top",
								showConfirmButton: false,
								timer: 3000,
							});					
						</script>';
				} else if($usuario == $_POST['editarPassword']) {
					echo '<script>
							Swal.fire({
								title: "Contraseña ingresada no puede ser igual a usuario, intente de nuevo.",
								icon: "error",
								toast: true,
								position: "top",
								showConfirmButton: false,
								timer: 3000,
							});					
						</script>';
				} else {

					//** =============== CREAMOS LA FECHA VENCIMIENTO DEL USUARIO =================*/
					$item = 'parametro';
					$valor = 'ADMIN_DIAS_VIGENCIA';
					$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
			
					$vigenciaUsuario = $parametros['valor'];

					date_default_timezone_set("America/Tegucigalpa");
					$fechaVencimiento = date("Y-m-d H:i:s", strtotime('+'.$vigenciaUsuario.' days'));

					$tabla = "empleados";
	
					$item1 = "password";
					$valor1 = $encriptar;

					$item2 = "bloqueado";
					$valor2 = 0;

					$item3 = "fecha_vencimiento";
					$valor3 = $fechaVencimiento;

					$item4 = "id";
					$valor4 = $idUsuario;
	
					$respuesta = ModeloUsuarios::mdlActualizarUsuarioPorCodigo($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
	
					if($respuesta == true){
		
						echo '<script>
								Swal.fire({
									title: "Contraseña cambiada correctamente.",
									icon: "success",
									heightAuto: false,
									showConfirmButton: true,
									confirmButtonText: "Cerrar",
									allowOutsideClick: false
								}).then((result)=>{
				
									if(result.value){
				
										window.location = "login";
				
									}
				
								});
						
							</script>';
	
					}
				}
				// return $respuesta;
			
			
			} 
			else {
				echo '<script>
						Swal.fire({
							title: "Contraseña ingresada no cumple con los requisitos, intente de nuevo.",
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
		ENVIAR CODIGO DE RECUPERAR CONTRASEÑA
	=============================================*/	
    static public function ctrEnviarCodigo($id, $nombre, $correo){
        if(isset($correo)) {
            $correoElectronico = $correo;
			$codigo = ControladorUsuarios::ctrCreateRandomCode();

			$item = 'parametro';
			$valor = 'ADMIN_VIGENCIA_CORREO';
			$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
	
			$vigenciaCorreo = $parametros['valor'];

			date_default_timezone_set("America/Tegucigalpa");
			$fechaRecuperacion = date("Y-m-d H:i:s", strtotime('+'.$vigenciaCorreo.' hours'));

			$tabla = "empleados";

			$item1 = "codigo";
			$valor1 = $codigo;

			$item2 = "fecha_recuperacion";
			$valor2 = $fechaRecuperacion;

			$item3 = "id";
			$valor3 = $id;

			$item4 = null;
			$valor4 = null;
			
			$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

			if($respuesta == true) {
				$nombreRecibido = $nombre;

				$respuestaCorreo = ControladorUsuarios::ctrEnviarCorreoRecuperacion($correoElectronico, $nombreRecibido, $codigo);

				return $respuestaCorreo;	
			} 
			
		} 
    }

	/*=============================================
		ENVIAR CORREO DE RECUPERAR CONTRASEÑA
	=============================================*/	
    static public function ctrEnviarCorreoRecuperacion($correoElectronico, $nombre, $codigo){
		// $user_os        =   ControladorGlobales::ctrGetOS();
		// $user_browser   =   ControladorGlobales::ctrGetBrowser();

		// return $user_os;

		// var_dump($user_os ." ". $user_browser);

		// return;
		// echo $user_os . " " . $user_browser;

		$correoDestinatario = $correoElectronico;
		$nombreDestinatario = $nombre;
		
		// $parametros = ControladorGlobales::ctrMostrarParametros();

		// $item = null;
		// $valor = null;
		// $parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);

		// $correoEmpresa = $parametros[1]['valor'];
		// $passwordEmpresa = $parametros[0]['valor'];
		// return $correoEmpresa . '--' . $passwordEmpresa;

        $template = file_get_contents('../extensiones/plantillas/template.php');
        $template = str_replace("{{name}}", $nombre, $template);
        $template = str_replace("{{action_url_1}}", 'localhost/gym/index.php?ruta=recuperar-password&codigo='.$codigo, $template);
        $template = str_replace("{{action_url_2}}", '<b>localhost/gym/index.php?ruta=recuperar-password&codigo='.$codigo.'</b>', $template);
        $template = str_replace("{{year}}", date('Y'), $template);
        // $template = str_replace("{{operating_system}}", $user_os, $template);
		// $template = str_replace("{{browser_name}}", $user_browser, $template);


		$respuestaCorreo = ControladorUsuarios::ctrGenerarCorreo($correoDestinatario, $nombreDestinatario, $template);

		return $respuestaCorreo;

	}

	/*=============================================
	REVISAR CODIGO Y FECHA PARA CAMBIAR CONTRASEÑA
	=============================================*/	
    static public function ctrRevisarCodigoFecha(){

		if(isset($_GET['codigo'])){

			// $_SESSION['codigo'] = $_GET['codigo'];
			$tabla1 = "personas";
			$tabla2 = "empleados";
			$item = "codigo";
			$valor = $_GET['codigo'];

			$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

			// var_dump($respuesta);
			// var_dump($respuesta['codigo'] . " " . $_GET['codigo']);
			// $respuesta["codigo"] != null && $_GET["codigo"] != $respuesta["codigo"]

			if($respuesta == false){
				echo '<script>
						Swal.fire({
							title: "El código de recuperación de contraseña no es valido. Por favor intenta de nuevo.",
							icon: "error",
							heightAuto: false,
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							allowOutsideClick: false
						}).then((result)=>{
    
							if(result.value){

								window.location = "login";
	
							}
	
						});
				
					</script>';
					
			} else {

				$fechaAhora = date("Y-m-d H:i:s");

				if($fechaAhora > $respuesta['fecha_recuperacion']) {
					echo '<script>
							Swal.fire({
								title: "El código de recuperación de contraseña ha expirado. Por favor intenta de nuevo.",
								icon: "error",
								heightAuto: false,
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								allowOutsideClick: false
							}).then((result)=>{

								if(result.value){

									window.location = "login";

								}

							});
					
						</script>';
				} 
				
			}

		} else {
			header("location:login");
		}

	}
	
	/*=============================================
			GENERAR CORREO
	=============================================*/	
    static public function ctrGenerarCorreo($correoDestinatario, $nombreDestinatario, $template){

		
		$item = null;
		$valor = null;
		$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);

		$correoEmpresa = $parametros[1]['valor'];
		$passwordEmpresa = $parametros[0]['valor'];
		$puerto = $parametros[5]['valor'];
		$host = $parametros[6]['valor'];
		$smtp = $parametros[7]['valor'];
		

		require '../extensiones/PHPMailer/PHPMailer/src/Exception.php';
		require '../extensiones/PHPMailer/PHPMailer/src/PHPMailer.php';
		require '../extensiones/PHPMailer/PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
		$mail->CharSet = "UTF-8";

        try {
			$mail->SMTPOptions = array(
				'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
				)
			);
			$mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $host;  //gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = $correoEmpresa;   //username
            $mail->Password = $passwordEmpresa;   //password
			// $mail->SMTPSecure = 'tls';
            // $mail->Port = 587;     
			$mail->SMTPSecure = $smtp;
            $mail->Port = $puerto;                    //smtp port

            $mail->setFrom($correoEmpresa, 'Gimnasio');
            $mail->addAddress($correoDestinatario, $nombreDestinatario);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña - Gimnasio';
            $mail->Body = $template;
		
			if (!$mail->send()) {

				return false;		
			} else {
				return true;
			}

        } catch (Exception $e) {
            return false;
		}
		
	}
	
	/*=============================================
		CREAR CODIGO RANDOM PARA EL PASSWORD
	=============================================*/	
    static public function ctrCreateRandomCode(){

		$length = "15";
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;

        // $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz0123456789";
        // srand((double)microtime()*1000000);
        // $i = 0;
        // $pass = '' ;
    
        // while ($i <= 7) {
        //     $num = rand() % 33;
        //     $tmp = substr($chars, $num, 1);
        //     $pass = $pass . $tmp;
        //     $i++;
        // }
    
        // return time().$pass;
	}
	
	
    /*=============================================
			MOSTRAR PARAMETROS
    =============================================*/
    static public function ctrMostrarParametros($item, $valor){
        $tabla = 'parametros';
		$respuesta = ModeloUsuarios::mdlMostrarParametros($tabla, $item, $valor);

		return $respuesta;
    }
}

