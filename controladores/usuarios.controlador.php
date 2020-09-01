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

			if(preg_match('/^[A-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $_POST["ingPassword"])){

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

						$item3 = null;
						$valor3 = null;

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2, $item3, $valor3);

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
					}

				} else {
					// echo '<br><div class="alert alert-danger">¡Usuario y contraseña incorrectos! Vuelve a intentar.</div>';
					echo '<script>			
						Swal.fire({
							title: "Usuario/contraseña incorrectos! Intente de nuevo.",
							icon: "error",
							heightAuto: false,
							allowOutsideClick: false
						});
					</script>';
				}
				
			} else {

				echo '<script>			
						Swal.fire({
							title: "Usuario/contraseña incorrectos! Intente de nuevo.",
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
								preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $_POST["nuevoPassword"])){

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
	CAMBIAR CONTRASEÑA POR PREGUNTAS DE SEGURIDAD
	=============================================*/	
	
	static public function ctrCambiarContraseña($item, $valor, $post){

		$tabla = "empleados";
			
		if(isset($post)){
			
			if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $post)){
				
				$encriptar = crypt($post, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			
				$item1 = "password";
				$valor1 = $encriptar;
		
				$item2 = $item;
				$valor2 = $valor;

				$item3 = null;
				$valor3 = null;

				$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3);
				return $respuesta;
			
			
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

		// $respuesta = $_GET['codigo'];
		// // echo $valor2;
		// var_dump($respuesta);

		// return;

		$tabla1 = "personas";
		$tabla2 = "empleados";
		$item = "codigo";
		$valor = $_GET['codigo'];

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

		// var_dump($respuesta['id_usuario']);
		
		$idUsuario = $respuesta['id_usuario'];
		// return;
			
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
    static public function ctrEnviarCodigo($id, $correo){
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
				$nombre = 'Jesús';

				$respuestaCorreo = ControladorUsuarios::ctrEnviarCorreoRecuperacion($correoElectronico, $nombre, $codigo);

				return $respuestaCorreo;	
			} 
			
		} 
    }

	/*=============================================
		ENVIAR CORREO DE RECUPERAR CONTRASEÑA
	=============================================*/	
    static public function ctrEnviarCorreoRecuperacion($correoElectronico, $nombre, $codigo){
        $template = file_get_contents('../extensiones/plantillas/template.php');
        $template = str_replace("{{name}}", $nombre, $template);
        $template = str_replace("{{action_url_1}}", 'localhost/gym/index.php?ruta=recuperar-password&codigo='.$codigo, $template);
        $template = str_replace("{{action_url_2}}", '<b>localhost/gym/index.php?ruta=recuperar-password&codigo='.$codigo.'</b>', $template);
        $template = str_replace("{{year}}", date('Y'), $template);
        // $template = str_replace("{{operating_system}}", Helper::getOS(), $template);
        // $template = str_replace("{{browser_name}}", Helper::getBrowser(), $template);

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
            $mail->Password = 'J35us#077.';   //password
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
		ENVIAR CORREO DE RECUPERAR CONTRASEÑA
	=============================================*/	
    static public function ctrRevisarCodigoFecha(){

		if(isset($_GET['codigo'])){

			$_SESSION['codigo'] = $_GET['codigo'];
			$tabla1 = "personas";
			$tabla2 = "empleados";
			$item = "codigo";
			$valor = $_GET['codigo'];

			$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

			// var_dump($respuesta['codigo'] . " " . $_GET['codigo']);

			if($_GET["codigo"] != $respuesta["codigo"]){
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
				// var_dump($respuesta['fecha_recuperacion'] . " --- " . $fechaAhora);

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
				// else {

				// 	$item = null;
				// 	$valor = null;
				// 	$post = null;
				// 	$codigo = $_GET["codigo"];
				// 	$enviar = ControladorUsuarios::ctrCambiarContraseña($item, $valor, $post, $codigo)
				// }
			}

		} else {
			header("location:login");
			
		// 	echo '<script>
		// 	Swal.fire({
		// 		title: "mal!",
		// 		icon: "error",
		// 		heightAuto: false
		// 	})
	
		// </script>';
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

