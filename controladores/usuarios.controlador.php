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

				if(preg_match('/^[A-Z0-9]+$/', $_POST["ingUsuario"]) &&
				preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $_POST["ingPassword"])){

					$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$tabla1 = "personas";
					$tabla2 = "empleados";
					
					$item = "usuario";
					$valor = $_POST["ingUsuario"];

					$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);
					// var_dump($respuesta);
					
					// return;

						if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){
							
							if($respuesta["estado"] == 1 && $respuesta["primera_vez"] == 1) {

								$_SESSION["iniciarSesion"] = "ok";
								$_SESSION["id_usuario"] = $respuesta["id_usuario"];
								$_SESSION["usuario"] = $respuesta["usuario"];
								$_SESSION["primerIngreso"] = $respuesta["primera_vez"];

								echo '<script>
								Swal.fire({
									title: "Bienvenido '.$_SESSION['nombre'] . " " . $_SESSION["apellidos"] . '",
									icon: "success",
									heightAuto: false,
									allowOutsideClick: false
								}).then((result)=>{
									if(result.value){
										window.location = "primer-ingreso";
									}
								});
								</script>';

							}

							else if($respuesta["estado"] == 1) {

								$_SESSION["iniciarSesion"] = "ok";
								$_SESSION["id"] = $respuesta["id"];
								$_SESSION["nombre"] = $respuesta["nombre"];
								$_SESSION["apellidos"] = $respuesta["apellidos"];
								$_SESSION["usuario"] = $respuesta["usuario"];
								$_SESSION["foto"] = $respuesta["foto"];
								$_SESSION["rol"] = $respuesta["rol"];
								$_SESSION["primerIngreso"] = $respuesta["primera_vez"];

								/* =====REGISTRAR FECHA Y HORA PARA SABER EL ULTIMO LOGIN ====== */

								date_default_timezone_set('America/Tegucigalpa');

								$fecha = date('Y-m-d');
								$hora = date('H:i:s');

								$fechaActual = $fecha." ".$hora;

								$item1 = "ultimo_login";
								$valor1 = $fechaActual;

								$item2 = "id_persona";
								$valor2 = $respuesta["id"];

								$item3 = null;
								$valor3 = null;

								$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2, $item3, $valor3);

								if($ultimoLogin == true){

									echo '<script>
										Swal.fire({
											title: "Bienvenido '.$_SESSION['nombre'] . " " . $_SESSION["apellidos"] . '",
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
							}

						} else {
				
								//INTENTOS DE LOGUEARSE PERMITIDOS SOLO 3 AL REBASARLOS SE DESACTIVARA EL USUARIO INGRESADO AUTOMATICAMENTE.
								$intentos = 3;
								$_SESSION['contadorLogin']++; 

								$intentos = $intentos - $_SESSION['contadorLogin'];
								
								// echo $_SESSION['contadorLogin'];

								if($_SESSION['contadorLogin'] === 3) {
									$tabla1 = "personas";
									$tabla2 = "empleados";
									
									$item = "usuario";
									$valor = $_POST["ingUsuario"];
					
									$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);
							
									if($respuesta["usuario"] == $_POST["ingUsuario"]){
										$tabla = "empleados";
										$item1 = "estado";
										$valor1 = 0;

										$item2 = "usuario";
										$valor2 = $_POST["ingUsuario"];
																	
										$item3 = null;
										$valor3 = null;
						
										$respuestaEstado = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);

										if($respuestaEstado == true){
											
											echo '<script>			
													Swal.fire({
														title: "¡Lo sentimos! Su usuario ha sido desactivado, comuniquese con el Administrador.",
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
												title: "¡Usuario y contraseña invalidos! Intento: '.$_SESSION['contadorLogin'] .', tiene '.$intentos.' intento mas.",
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
								
						/*================== ENCRIPTAMOS LA CONTRASEÑA ===================*/
						$encriptar = crypt($datos["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

						$tabla = "empleados";
						$datos = array("id_persona" => $datos["id_persona"],
									   "usuario" => $datos["usuario"],
									   "password" => $encriptar,
									   "rol" => $datos["rol"],
									   "foto" => $ruta);

						$respuestaEmpleado = ModeloUsuarios::mdlIngresarUsuarioEmpleado($tabla, $datos);

						if($respuestaEmpleado = true){

							return true;
								
							// $totalIdUsuarios = array();

							// $tabla1 = "empleados";
							// $tabla2 = null;
							// $item = null;
							// $valor = null;

							// $usuariosTotal = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

							// foreach($usuariosTotal as $keyUsuarios => $valueUsuarios){
							// 	array_push($totalIdUsuarios, $valueUsuarios["id"]);
							// }

							// $idUsuario = end($totalIdUsuarios);

							// $tabla3 = "usuario_pregunta";
							
							// $datos = array("idUsuario" => $idUsuario,
							// 				"idPregunta" => $_POST["nuevaPregunta"],
							// 				"respuesta" => $_POST["respuestaPregunta"]);

											
							// $respuestaPreguntas = ModeloUsuarios::mdlIngresarPreguntaUsuario($tabla3, $datos);

							// if($respuestaPreguntas == true){
							// 	echo '<script>
							// 		Swal.fire({
							// 			title: "Empleado guardado correctamente!",
							// 			icon: "success"
							// 		})							
							// 	</script>';
							// }
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


	static public function ctrMostrarPreguntas($item, $valor) {

		// $tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlMostrarPreguntas($item, $valor);

		return $respuesta;

	}


	/*=============================================
	CAMBIAR CONTRASEÑA POR PRIMERA VEZ Y AGREGAR PREGUNTAS
	=============================================*/	

	static public function ctrNuevaContraseñaPreguntasSeguridad($id, $usuario){

		if(isset($_POST["editarPassword"])){
			
			if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $_POST["editarPassword"])){
				
				$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			
				$tabla1 = "personas";
				$tabla2 = "empleados";

				$item = 'usuario';
				$valor = $usuario;

				$respuestaContraseñas = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

				// var_dump($respuestaContraseñas['password'] . ' ' . $encriptar);

				if($respuestaContraseñas['password'] == $encriptar){
					echo '<br><div class="alert alert-danger">Contraseña igual a la anterior, intente de nuevo.</div>';
				} else {
					$item1 = "password";
					$valor1 = $encriptar;
			
					$item2 = 'id';
					$valor2 = $id;

					$item3 = null;
					$valor3 = null;

					$respuestaContraseña = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2, $item3, $valor3);

					if($respuestaContraseña == true) {
						$tabla = "usuario_pregunta";
						
						$datos = array("idUsuario" => $id,
										"idPregunta" => $_POST["nuevaPregunta"],
										"respuesta" => $_POST["respuestaPregunta"]);
			
										
						$respuestaPreguntas = ModeloUsuarios::mdlIngresarPreguntaUsuario($tabla, $datos);
			
						if($respuestaPreguntas == true){

							$tabla = "empleados";

							$item1 = "primera_vez";
							$valor1 = 0;
					
							$item2 = 'id';
							$valor2 = $id;
			
							$item3 = null;
							$valor3 = null;
			
							$respuestaPrimeraVez = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);

							if($respuestaPrimeraVez == true) {
								echo '<script>
									Swal.fire({
										title: "Contraseña y preguntas guardadas correctamente",
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
							title: "La contraseña no cumple con los requerimientos!",
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

				// return $respuestaContraseñas['password'] . ' ' . $encriptar;

				if($respuestaContraseñas['password'] == $encriptar){
					return false;
				} else {

					$item1 = "password";
					$valor1 = $encriptar;
					
					$item2 = $item;
					$valor2 = $valor;

					$item3 = null;
					$valor3 = null;
	
					$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2, $item3, $valor3);
					return $respuesta;
				
				}
				
			
			} else {

				$respuesta = false;
				return $respuesta;

			}
					
		} 
	
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

		// var_dump($respuesta['id_usuario']);
		
		$idUsuario = $respuesta['id_usuario'];
		
		if(isset($_POST['editarPassword'])){
			
			if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $_POST['editarPassword'])){
				
				$encriptar = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			
				$tabla = "empleados";

				$item1 = "password";
				$valor1 = $encriptar;
		
				$item2 = "id";
				$valor2 = $idUsuario;

				$respuesta = ModeloUsuarios::mdlActualizarUsuarioPorCodigo($tabla, $item1, $valor1, $item2, $valor2);

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
				// return $respuesta;
			
			
			} 
			// else {

			// 	$respuesta = false;
			// 	return $respuesta;

			// }
					
		} 
	
	}


	/*=============================================
		ENVIAR CODIGO DE RECUPERAR CONTRASEÑA
	=============================================*/	
    static public function ctrEnviarCodigo($id, $nombre, $correo){
        if(isset($correo)) {
            $correoElectronico = $correo;
			$codigo = ControladorUsuarios::ctrCreateRandomCode();

			date_default_timezone_set("America/Tegucigalpa");
			$fechaRecuperacion = date("Y-m-d H:i:s", strtotime('+24 hours'));

			$tabla = "empleados";

			$item1 = "codigo";
			$valor1 = $codigo;

			$item2 = "fecha_recuperacion";
			$valor2 = $fechaRecuperacion;

			$item3 = "id";
			$valor3 = $id;

			$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);

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

		// var_dump($user_os ." ". $user_browser);

		// return;
		// echo $user_os . " " . $user_browser;

        $template = file_get_contents('../extensiones/plantillas/template.php');
        $template = str_replace("{{name}}", $nombre, $template);
        $template = str_replace("{{action_url_1}}", 'localhost/gym/index.php?ruta=recuperar-password&codigo='.$codigo, $template);
        $template = str_replace("{{action_url_2}}", '<b>localhost/gym/index.php?ruta=recuperar-password&codigo='.$codigo.'</b>', $template);
        $template = str_replace("{{year}}", date('Y'), $template);
        $template = str_replace("{{operating_system}}", $user_os, $template);
        $template = str_replace("{{browser_name}}", $user_browser, $template);

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
            $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'jesus.zuniga077@gmail.com';   //username
            $mail->Password = 'Locoporcristo057.';   //password
			$mail->SMTPSecure = 'tls';
            $mail->Port = 587;     
			// $mail->SMTPSecure = 'ssl';
            // $mail->Port = 465;                    //smtp port

            $mail->setFrom('jesus.zuniga077@gmail.com', 'Gimnasio');
            $mail->addAddress($correoElectronico, $nombre);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña - Gimnasio';
			// $mail->Body    = $template;
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
}

