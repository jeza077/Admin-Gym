<?php
error_reporting(E_ALL & ~E_NOTICE);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ControladorUsuarios{

	/*=============================================
	MOSTRAR SOLO USUARIOS
	=============================================*/

	static public function ctrMostrarSoloUsuarios($tabla, $item, $valor){
		$tabla1 = "tbl_personas";
		$tabla2 = $tabla;

		$respuesta = ModeloUsuarios::mdlMostrarSoloUsuarios($tabla1, $tabla2, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function ctrMostrarUsuarios($tabla, $item, $valor){
		$tabla1 = "tbl_personas";
		$tabla2 = $tabla;

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR (DINAMICO)
	=============================================*/

	static public function ctrMostrar($tabla, $item, $valor, $all) {

		$tabla1 = $tabla;
		$respuesta = ModeloUsuarios::mdlMostrar($tabla1, $item, $valor, $all);

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
				preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%*-,_+?¡¿=&.])\S{8,16}$/', $_POST["ingPassword"])){

					$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					
					// echo $encriptar;

					$tabla1 = "tbl_personas";
					$tabla2 = "tbl_usuarios";
					
					$item = "usuario";
					$valor = $_POST["ingUsuario"];

					$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

				   	// echo "<pre>";
                    // 	var_dump($respuesta);
                  	// echo "</pre>";
					// return;

					$item1 = "usuario";
					$valor1 = $_POST["ingUsuario"];
					$item2 = "rol";
					$valor2 = $respuesta["rol"];
	
					$modulos = ControladorUsuarios::ctrMostrarUsuarioModulo($item1, $item2, $valor1, $valor2);
	
					  // echo "<pre>";
					  //   var_dump($modulos);
					  // echo "</pre>";
	
	
					$grupo_modulo = array();
					$permisos_objetos = array();
					foreach($modulos as $modulo) {
					  $modulo_padre = $modulo['objeto'];
					  $icono_objeto = $modulo['icono'];
					  $link_objeto = $modulo['link_objeto'];
	
					  $permisos = array(
						'link' => $link_objeto,
						'agregar' => $modulo['agregar'],
						'eliminar' => $modulo['eliminar'],
						'actualizar' => $modulo['actualizar'],
						'consulta' => $modulo['consulta']
					  );
	
					  // $sub_modulos = array(
					  //   'sub_modulo' => $modulo['sub_modulo'],
					  //   'link_sub_modulo' => $modulo['link_sub_modulo']
					  // );
					  
					  $grupo_modulo[$link_objeto][$icono_objeto][] = $modulo_padre;
					  $permisos_objetos[$modulo_padre] = $permisos;
			 
					}
	
					//   echo "<pre>";
					// 	var_dump($permisos_objetos);
					//   echo "</pre>";
					
					//   return;
					

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
							
								#AUTO-REGISTRO
							if($respuesta["estado"] == 0 && $respuesta["primera_vez"] == 1 && $respuesta["rol"] == "DEFAULT" || $respuesta["estado"] == 1 && $respuesta["primera_vez"] == 1 && $respuesta["rol"] == "DEFAULT"){

								echo '<script>			
										Swal.fire({
											title: "Su usuario no tiene permisos, comuniquese con el administrador.",
											icon: "error",
											heightAuto: false,
											allowOutsideClick: false
										});
									</script>';
									
								#PRIMERA VEZ
							} else if($respuesta["estado"] == 0 && $respuesta["primera_vez"] == 1 || $respuesta["estado"] == 1 && $respuesta["primera_vez"] == 1) {

								$_SESSION["iniciarSesion"] = "ok";
								$_SESSION["id_usuario"] = $respuesta["id_usuario"];
								$_SESSION["id_persona"] = $respuesta["id_personas"];
								$_SESSION["usuario"] = $respuesta["usuario"];
								$_SESSION["nombre"] = $respuesta["nombre"];
								$_SESSION["apellidos"] = $respuesta["apellidos"];
								$_SESSION["primerIngreso"] = $respuesta["primera_vez"];
			
								$descripcionEvento = "".$_SESSION['usuario']." ingreso al sistema por primera vez";
								$accion = "Ingreso";
								$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION['id_usuario'], 31, $accion, $descripcionEvento);						

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

														
								#SI ESTA ACTIVO Y NO ES PRIMER INGRESO
							} else if($respuesta["estado"] == 1 && $respuesta["primera_vez"] == 0 && $fechaHoy < $fechaVencimiento || $respuesta["estado"] == 1 && $respuesta["primera_vez"] == 0 && $fechaHoy > $fechaVencimiento && $_POST['ingUsuario'] == 'SUPERADMIN') {

								$_SESSION["iniciarSesion"] = "ok";
								$_SESSION["id_usuario"] = $respuesta["id_usuario"];
								$_SESSION["id_persona"] = $respuesta["id_personas"];
								$_SESSION["usuario"] = $respuesta["usuario"];
								$_SESSION["nombre"] = $respuesta["nombre"];
								$_SESSION["apellidos"] = $respuesta["apellidos"];
								$_SESSION["foto"] = $respuesta["foto"];
								$_SESSION["rol"] = $respuesta["rol"];
								$_SESSION["agregar"] = $respuesta["agregar"];
								$_SESSION["eliminar"] = $respuesta["eliminar"];
								$_SESSION["actualizar"] = $respuesta["actualizar"];
								$_SESSION["consulta"] = $respuesta["consulta"];
								$_SESSION["primerIngreso"] = $respuesta["primera_vez"];
								$_SESSION['permisos'] = $permisos_objetos;

								//* =====REGISTRAR FECHA Y HORA PARA SABER EL ULTIMO LOGIN ====== */

								$fecha = date('Y-m-d');
								$hora = date('H:i:s');

								$fechaActual = $fecha." ".$hora;

								$item1 = "ultimo_login";
								$valor1 = $fechaActual;

								$item2 = "id_usuario";
								$valor2 = $respuesta["id_usuario"];

								$item3 = null;
								$valor3 = null;

								$item4 = null;
								$valor4 = null;

								$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

								if($ultimoLogin == true){

									$descripcionEvento = "".$_SESSION['usuario']." ingreso al sistema";
									$accion = "Ingreso";
									$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION['id_usuario'], 1, $accion, $descripcionEvento);						

									echo '<script>
										Swal.fire({
											title: "Bienvenid@ '.$_SESSION['nombre'] . " " . $_SESSION["apellidos"] . '",
											icon: "success",
											heightAuto: false,
											allowOutsideClick: false,
											confirmButtonColor: "#ff8303"
										}).then((result)=>{
											if(result.value){
												window.location = "dashboard";
											}
										});
										</script>';

								}

								#SI ESTA VENCIDO SU USUARIO Y NO ES SUPERADMIN
							} else if($respuesta["estado"] == 1 && $fechaHoy > $fechaVencimiento && $_POST['ingUsuario'] != 'SUPERADMIN'){
								
								echo '<script>			
										Swal.fire({
											title: "Su usuario ha vencido, comuniquese con el administrador.",
											icon: "error",
											heightAuto: false,
											allowOutsideClick: false
										});
									</script>';
								session_destroy();

								#USUARIO DESACTIVADO
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

								if($_SESSION['contadorLogin'] >= $intentos) {
									$tabla1 = "tbl_personas";
									$tabla2 = "tbl_usuarios";
									
									$item = "usuario";
									$valor = $_POST["ingUsuario"];

									$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

									$idUser = $respuesta['id_usuario'];
									$user = $respuesta['usuario'];
									// var_dump($respuesta);
									// return;

									if($respuesta["usuario"] == $_POST["ingUsuario"]){
										$tabla = "tbl_usuarios";
										$item1 = "estado";
										$valor1 = 0;

										$item2 = "usuario";
										$valor2 = $_POST["ingUsuario"];
																	
										$item3 = null;
										$valor3 = null;

										$item4 = null;
										$valor4 = null;

										$respuestaEstado = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

										if($respuestaEstado == true){
											
											$descripcionEvento = "".$user." intento ingresar al sistema y fue bloqueado por intentos invalidos";
											$accion = "Ingreso";
											$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($idUser, 30, $accion, $descripcionEvento);

											// var_dump($bitacoraConsulta);
											// return;

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
									echo '<script>			
											Swal.fire({
												title: "¡Usuario y contraseña invalidos. Intento '. $_SESSION['contadorLogin'].' le queda '. ($intentos - $_SESSION['contadorLogin']).' intentos.",
												icon: "error",
												toast: true,
												position: "top",
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
	REGISTRO DE USUARIOS
	=============================================*/
	static public function ctrCrearUsuario($datos){

		// return var_dump($datos);
		// return;
		if(isset($datos["usuario"])){

			if(preg_match('/^[A-Z]+$/', $datos["usuario"]) &&
			   preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%*-,_+?¡¿=&.])\S{8,16}$/', $datos["password"])){

				$emailUsuario = $datos["email"];
				// $contraSinEncriptar = ControladorUsuarios::password_seguro_random();
				$contraSinEncriptar = $datos["password"];
				$nombre = $datos["nombre"];
				$tipoPersona = $datos["tipo_persona"];
				// echo $emailUsuario;
				// echo $contraSinEncriptar;
				// echo $nombre;

				// return;

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

						$tabla = "tbl_usuarios";
						$datos = array("id_persona" => $datos["id_persona"],
									   "usuario" => $datos["usuario"],
									   "password" => $encriptar,
									   "rol" => $datos["rol"],
									   "foto" => $ruta,
									   "fecha_vencimiento" => $fechaVencimiento);

						$respuestaEmpleado = ModeloUsuarios::mdlIngresarUsuarioEmpleado($tabla, $datos);

						// return var_dump($respuestaEmpleado);

						if($respuestaEmpleado == true){

							//INSERTAR EL NUEVO PASSWORD EN LA TABLA tbl_historial_pass 
							$tabla1 = "tbl_usuarios";
							$usuario=$datos["id_persona"];

							$respuestaContraseñas = ModeloUsuarios::mdlMostrarUser($tabla1,$usuario);

							//INSERTAR UN PASSWORD NUEVO
				            $tabla="tbl_historial_pass";
							$idUsuario=$respuestaContraseñas['id_usuario'];
							//$id_usuario=$datos['usuario'];

							$password = crypt($datos["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

							$respuestaPass = ModeloUsuarios::mdlHistorialPassword($tabla,$idUsuario, $password);
							//////////////////////////////////////////////////////////////////////////////////

							$email = $emailUsuario;
							$nombreUsuario = $datos["usuario"];
							$contraseña =  $contraSinEncriptar;
							$asunto = 'Envio de Usuario y Contraseña';
							$require = false;

							if($tipoPersona == 'default'){

								// return true;
								$template = 'Hola '.$nombre.'! <br><br> Tu usuario es: '.$nombreUsuario.' <br> Tu contraseña es: '.$contraseña.'<br><br><br> El administrador pronto te dará permisos para entrar al sistema. <br><br> Saludos!'; 

							} else {


								$template = 'Hola '.$nombre.'! <br><br> Tu usuario es: '.$nombreUsuario.' <br> Tu contraseña es: '.$contraseña; 
								
							}
							
							$respuestaCorreo = ControladorUsuarios::ctrGenerarCorreo($email, $nombreUsuario, $asunto, $template, $require);

							if($respuestaCorreo = true){
								
								$descripcionEvento = "".$_SESSION["usuario"]." Creó un nuevo usuario llamado ".$nombreUsuario."";
								$accion = "Nuevo";
								$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 2,$accion, $descripcionEvento);
			
								return true;

							} else {

								return false;
							}

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
	REGISTRO DE USUARIOS YA REGISTRADO
	=============================================*/
	static public function ctrCrearUsuarioYaRegistrado(){

		// var_dump($_POST);
		// var_dump($_FILES);
		// return;

		if(isset($_POST["nuevoIdPersona"])){

			if(preg_match('/^[A-Z]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%*-,_+?¡¿=&.])\S{8,16}$/', $_POST["nuevoPassword"])){

				$contraSinEncriptar = $_POST["nuevoPassword"];

				$item = 'id_personas';
				$valor = $_POST["nuevoIdPersona"];
				$all = null;

				$personas = ControladorPersonas::ctrMostrarPersonas($item, $valor, $all);

				$nombre = $personas["nombre"];
				$emailUsuario = $personas["correo"];
				
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
					
				//**================= ENCRIPTAMOS LA CONTRASEÑA ===================*/
				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');


				//** =============== CREAMOS LA FECHA VENCIMIENTO DEL USUARIO =================*/
				$item = 'parametro';
				$valor = 'ADMIN_DIAS_VIGENCIA';
				$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
		
				$vigenciaUsuario = $parametros['valor'];
				
				date_default_timezone_set("America/Tegucigalpa");
				$fechaVencimiento = date("Y-m-d H:i:s", strtotime('+'.$vigenciaUsuario.' days'));

				$tabla = "tbl_usuarios";
				$datos = array("id_persona" => $_POST["nuevoIdPersona"],
								"usuario" => $_POST["nuevoUsuario"],
								"password" => $encriptar,
								"rol" => $_POST["nuevoRol"],
								"foto" => $ruta,
								"fecha_vencimiento" => $fechaVencimiento);

				// var_dump($datos);
				// return;

				$respuestaUsuario = ModeloUsuarios::mdlIngresarUsuarioEmpleado($tabla, $datos);

				// return var_dump($respuestaUsuario);

				if($respuestaUsuario == true){
					

					//PARA ESTA PARTE SOLO SE NECESITA EL INSERT A LA TABLA tbl_historial_pass
					$tabla1 = "tbl_usuarios";
					$usuario=$_POST["nuevoIdPersona"];

					$respuestaContraseñas = ModeloUsuarios::mdlMostrarUser($tabla1,$usuario);

					//INSERTAR UN PASSWORD NUEVO
					$tabla="tbl_historial_pass";
					$idUsuario=$respuestaContraseñas['id_usuario'];
					//$id_usuario=$_POST['nuevoUsuario'];

					$password = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$respuestaPass = ModeloUsuarios::mdlHistorialPassword($tabla,$idUsuario, $password);
					//////////////////////////////////////////////////////////////////////////////////
			
					$tabla = "tbl_personas";

					$item1 = "tipo_persona";
					$valor1 = "ambos";
			
					$item2 = 'id_personas';
					$valor2 = $_POST["nuevoIdPersona"];

					$item3 = null;
					$valor3 = null;

					$item4 = null;
					$valor4 = null;

					$respuestaAct = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

					$email = $emailUsuario;
					$nombreUsuario = $datos["usuario"];
					$contraseña =  $contraSinEncriptar;
					$asunto = 'Envio de Usuario y Contraseña';
					$require = false;

					$template = 'Hola '.$nombre.'! <br><br> Tu usuario es: '.$nombreUsuario.' <br> Tu contraseña es: '.$contraseña; 
					
					$respuestaCorreo = ControladorUsuarios::ctrGenerarCorreo($email, $nombreUsuario, $asunto, $template, $require);

					if($respuestaCorreo = true){

						$descripcionEvento = "Nuevo Usuario";
						$accion = "Nuevo";
						$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 2,$accion, $descripcionEvento);
	
						echo '<script>
							Swal.fire({
								title: "Usuario creado correctamente!",
								icon: "success",
								heightAuto: false,
								allowOutsideClick: false
							}).then((result)=>{
								if(result.value){
									window.location = "usuarios";
								}
							});                       
						</script>';
					
						
					} else {

						echo '<script>
							Swal.fire({
								title: "Opps, algo salio mal, intenta de nuevo!",
								icon: "error",
								heightAuto: false,
								allowOutsideClick: false
							}).then((result)=>{
								if(result.value){
									window.location = "usuarios";
								}
							});                       
						</script>';

					}

				} else {
					
					echo '<script>
						Swal.fire({
							title: "Opps, algo salio mal, intenta de nuevo!",
							icon: "error",
							heightAuto: false,
							allowOutsideClick: false
						}).then((result)=>{
							if(result.value){
								window.location = "usuarios";
							}
						});                       
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

						

		} 

	}

	/*=============================================
	EDITAR USUARIOS
	=============================================*/
	
	static public function ctrEditarUsuario($datos){

		// return var_dump($datos);
		// return;

		
		if(isset($datos["usuario"])){
			

			if(preg_match('/^[A-Z]+$/', $datos["usuario"]) && preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%.])\S{8,16}$/', $datos["password_nueva"])){

				$emailUsuario = $datos["email"];
				$contraSinEncriptar = $datos["password_nueva"];
				$nombre = $datos["nombre"];


				//AQUI INICIA LA PARTE DE HISTORIAL DE PASSWORD--------------------------------------------------
				$tabla='tbl_historial_pass';
				$item= 'pass';
				$valor=$datos["password_nueva"];

				$tabla1 = "tbl_usuarios";
				$usuario=$datos['id_persona'];

				$respuestaContraseñas = ModeloUsuarios::mdlMostrarUser($tabla1,$usuario);

				$idUsuario=$respuestaContraseñas['id_usuario'];

				
				$respuestaMostrar = ModeloUsuarios::mdlMostrarHistorialPassword($tabla,$item,$idUsuario);

				$mostrarPass1= $respuestaMostrar[0]['pass'];
				$mostrarPass2= $respuestaMostrar[1]['pass'];
				$mostrarPass3= $respuestaMostrar[2]['pass'];
				$mostrarPass4= $respuestaMostrar[3]['pass'];
				$mostrarPass5= $respuestaMostrar[4]['pass'];
				$mostrarPass6= $respuestaMostrar[5]['pass'];
				$mostrarPass7= $respuestaMostrar[6]['pass'];
				$mostrarPass8= $respuestaMostrar[7]['pass'];
				$mostrarPass9= $respuestaMostrar[8]['pass'];
				$mostrarPass10= $respuestaMostrar[9]['pass'];

				 //echo "</br>";
				
				//-------------------------------MOSTRAR LAS FECHAS DE LOS PASSWORD
				$tabla='tbl_historial_pass';
				$item= 'fecha_creacion';
				$idUsuario=$respuestaContraseñas['id_usuario'];

				$respuestaFechas = ModeloUsuarios::mdlFechasHistorialPassword($tabla,$idUsuario);        
				$fecha1= $respuestaFechas[0]['fecha_creacion'];
				$fecha2= $respuestaFechas[1]['fecha_creacion'];
				$fecha3= $respuestaFechas[2]['fecha_creacion'];
				$fecha4= $respuestaFechas[3]['fecha_creacion'];
				$fecha5= $respuestaFechas[4]['fecha_creacion'];
				$fecha6= $respuestaFechas[5]['fecha_creacion'];
				$fecha7= $respuestaFechas[6]['fecha_creacion'];
				$fecha8= $respuestaFechas[7]['fecha_creacion'];
				$fecha9= $respuestaFechas[8]['fecha_creacion'];
				$fecha10= $respuestaFechas[9]['fecha_creacion'];
				
				$longitud = count($respuestaMostrar); // Devuelve 2, pero nosotros queremos 6
				$longitudRecursiva = count($respuestaMostrar, COUNT_RECURSIVE); // Devuelve 6
				//echo 'elnumero de elementos del arreglo es:--> '.$longitud;
				//echo "<br>";
		   

				$encriptarPassIngresado = crypt($datos['password_nueva'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');			 

				if ($encriptarPassIngresado==$mostrarPass1 || 
					$encriptarPassIngresado==$mostrarPass2 || 
					$encriptarPassIngresado==$mostrarPass3 || 
					$encriptarPassIngresado==$mostrarPass4 || 
					$encriptarPassIngresado==$mostrarPass5 ||
					$encriptarPassIngresado==$mostrarPass6 || 
					$encriptarPassIngresado==$mostrarPass7 || 
					$encriptarPassIngresado==$mostrarPass8 || 
					$encriptarPassIngresado==$mostrarPass9 || 
					$encriptarPassIngresado==$mostrarPass10) {
					echo '<script>			
									Swal.fire({
										title: "Este password ha sido utilizado recientemente",
										icon: "error",
										showConfirmButton: true,
										timer: 3000,
									});
								</script>';
				}
//--------------------------------------------------------------------------------------------------------


					/*=============================================
							VALIDAR IMAGEN
					=============================================*/

					$ruta = $datos['foto_actual'];

					if(isset($datos["foto_nueva"]["tmp_name"]) && !empty($datos["foto_nueva"]["tmp_name"])){

						list($ancho, $alto) = getimagesize($datos["foto_nueva"]["tmp_name"]);

						$nuevoAncho = 500;
						$nuevoAlto = 500;

						/*==============================================================
						CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
						===============================================================*/

						$directorio = "vistas/img/usuarios/".$datos["usuario"];

						// PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BASE DE DATOS 
						if(!empty($datos['foto_actual'])){
				
							unlink($datos['foto_actual']); 
		
						} else {

							mkdir($directorio, 0755); 
						}


						/*=====================================================================
						DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
						======================================================================*/

						if($datos["foto_nueva"]["type"] == "image/jpeg"){

							/*=============================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
							=============================================*/

							$aleatorio = mt_rand(100,999);

							$ruta = "vistas/img/usuarios/".$datos["usuario"]."/".$aleatorio.".jpg";

							$origen = imagecreatefromjpeg($datos["foto_nueva"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagejpeg($destino, $ruta);

						}

						if($datos["foto_nueva"]["type"] == "image/png"){

							/*=============================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
							=============================================*/

							$aleatorio = mt_rand(100,999);

							$ruta = "vistas/img/usuarios/".$datos["usuario"]."/".$aleatorio.".png";

							$origen = imagecreatefrompng($datos["foto_nueva"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagepng($destino, $ruta);

						}

					}
					
					if($datos['password_nueva'] != ""){
						if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%*-,_+?¡¿=&.])\S{8,16}$/', $datos["password_nueva"])){

							//**================= ENCRIPTAMOS LA CONTRASEÑA ===================*/
							$encriptar = crypt($datos["password_nueva"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
						} 

					} else {
						$encriptar = $datos['password_actual'];
					}


					//** =============== CREAMOS LA FECHA VENCIMIENTO DEL USUARIO =================*/
					$item = 'parametro';
					$valor = 'ADMIN_DIAS_VIGENCIA';
					$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
			
					$vigenciaUsuario = $parametros['valor'];
					
					date_default_timezone_set("America/Tegucigalpa");
					$fechaVencimiento = date("Y-m-d H:i:s", strtotime('+'.$vigenciaUsuario.' days'));

					$tabla = "tbl_usuarios";
					$datos = array("id_persona" => $datos["id_persona"],
									"usuario" => $datos["usuario"],
									"password" => $encriptar,
									"rol" => $datos["rol"],
									"foto" => $ruta);

					// return var_dump($datos);

					$respuestaEmpleado = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

					// return var_dump($respuestaEmpleado);

					if($respuestaEmpleado == true){

						if($longitudRecursiva>10){

							if ($fecha1<$fecha2 and $fecha1<$fecha3 and $fecha1<$fecha4 
								and $fecha1<$fecha5 and $fecha1<$fecha6 and $fecha1<$fecha7 
								and $fecha1<$fecha8 and $fecha1<$fecha9 and $fecha1<$fecha10) {

								$passwordMenor=$fecha1;

							}else if ($fecha2<$fecha1 and $fecha2<$fecha3 and $fecha2<$fecha4 
								and $fecha2<$fecha5 and $fecha2<$fecha6 and $fecha2<$fecha7 
								and $fecha2<$fecha8 and $fecha2<$fecha9 and $fecha2<$fecha10) {
								
								$passwordMenor=$fecha2;

							}else if ($fecha3<$fecha1 and $fecha3<$fecha2 and $fecha3<$fecha4 
								and $fecha3<$fecha5 and $fecha3<$fecha6 and $fecha3<$fecha7 
								and $fecha3<$fecha8 and $fecha3<$fecha9 and $fecha3<$fecha10) {
								
								$passwordMenor=$fecha3;

							}else if ($fecha4<$fecha1 and $fecha4<$fecha2 and $fecha4<$fecha3 
								and $fecha4<$fecha5 and $fecha4<$fecha6 and $fecha4<$fecha7 
								and $fecha4<$fecha8 and $fecha4<$fecha9 and $fecha4<$fecha10) {
								
								$passwordMenor=$fecha4;

							}else if ($fecha5<$fecha1 and $fecha5<$fecha2 and $fecha5<$fecha3 
								and $fecha5<$fecha4 and $fecha5<$fecha6 and $fecha5<$fecha7 
								and $fecha5<$fecha8 and $fecha5<$fecha9 and $fecha5<$fecha10){

								$passwordMenor=$fecha5;

							}else if ($fecha6<$fecha1 and $fecha6<$fecha2 and $fecha6<$fecha3 
								and $fecha6<$fecha4 and $fecha6<$fecha5 and $fecha6<$fecha7 
								and $fecha6<$fecha8 and $fecha6<$fecha9 and $fecha6<$fecha10){

								$passwordMenor=$fecha6;
							
							}else if ($fecha7<$fecha1 and $fecha7<$fecha2 and $fecha7<$fecha3 
								and $fecha7<$fecha4 and $fecha7<$fecha5 and $fecha7<$fecha6 
								and $fecha7<$fecha8 and $fecha7<$fecha9 and $fecha7<$fecha10){

								$passwordMenor=$fecha7;
							
							}else if ($fecha8<$fecha1 and $fecha8<$fecha2 and $fecha8<$fecha3 
								and $fecha8<$fecha4 and $fecha8<$fecha5 and $fecha8<$fecha6 
								and $fecha8<$fecha7 and $fecha8<$fecha9 and $fecha8<$fecha10){

								$passwordMenor=$fecha8;

							}else if ($fecha9<$fecha1 and $fecha9<$fecha2 and $fecha9<$fecha3 
								and $fecha9<$fecha4 and $fecha9<$fecha5 and $fecha9<$fecha6 
								and $fecha9<$fecha7 and $fecha9<$fecha8 and $fecha9<$fecha10){

								$passwordMenor=$fecha9;
							}else{
								$passwordMenor=$fecha10;
							}


							$tabla='tbl_historial_pass';
							$item= 'fecha_creacion';
							$fechaAntigua=$passwordMenor;
							$idUsuario=$respuestaContraseñas['id_usuario'];
						
							$respuestaEliminar = ModeloUsuarios::mdlEliminarHistorialPassword($tabla,$item,$fechaAntigua);
						
						}

						//INSERTAR UN PASSWORD NUEVO

						$tabla1 = "tbl_usuarios";
						$usuario=$datos['id_persona'];
						$respuestaContraseñas = ModeloUsuarios::mdlMostrarUser($tabla1,$usuario);


						$tabla="tbl_historial_pass";
						$idUsuario=$respuestaContraseñas["id_usuario"];
						$password = crypt($datos['password_nueva'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

						$respuestaPass = ModeloUsuarios::mdlHistorialPassword($tabla,$idUsuario, $password);

					
						$descripcionEvento = "".$_SESSION["usuario"]." Actualizó el registro del usuario ".$datos["usuario"]."";
						$accion = "Actualizar";
			
						$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 2,$accion, $descripcionEvento);
			
					

						// return true;

						if($contraSinEncriptar != ""){

							$nombreUsuario = $datos["usuario"];
							$email = $emailUsuario;
							$contraseña =  $contraSinEncriptar;
							$asunto = 'Envio de Contraseña Nueva';
							$require = false;

							$template = 'Hola '.$nombreUsuario.'! <br><br> Tu contraseña es: '.$contraseña; 
							
							$respuestaCorreo = ControladorUsuarios::ctrGenerarCorreo($email, $nombreUsuario, $asunto, $template, $require);
						
							if($respuestaCorreo = true){

								return true;

							} else {

								return false;
							}

						} else {

							return true;
						}

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

		// var_dump($_POST);
		// return;

		if(isset($_POST["editarPassword"])){
			
			// if($_POST["nuevaPregunta"][0] !== 'Seleccionar...' && $_POST["nuevaPregunta"][1] !== 'Seleccionar...' && $_POST["nuevaPregunta"][2] !== 'Seleccionar...'){

				if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%*-,_+?¡¿=&.])\S{8,16}$/', $_POST["editarPassword"]) && preg_grep('/^(?=.*[A-ZñÑáéíóúÁÉÍÓÚ])\S{1,50}$/', $_POST["respuestaPregunta"])){
					// echo '<br><div class="alert alert-danger">bien.</div>';
					// return;		

					$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				
					$tabla1 = "tbl_personas";
					$tabla2 = "tbl_usuarios";

					$item = 'usuario';
					$valor = $usuario;

					$respuestaContraseñas = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

					// var_dump($respuestaContraseñas);
					// return;


					if($respuestaContraseñas['password'] == $encriptar){
						// echo '<br><div class="alert alert-danger">Contraseña igual a la anterior, intente de nuevo.</div>';
						echo '<script>			
							Swal.fire({
								title: "La contraseña no puede ser igual a la anterior. Por favor, intente de nuevo.",
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
				
						$item2 = 'id_usuario';
						$valor2 = $id;

						$item3 = null;
						$valor3 = null;

						$item4 = null;
						$valor4 = null;

						$respuestaContraseña = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

						if($respuestaContraseña == true) {

							$descripcionEvento = "".$usuario." cambio su contraseña por primera vez";
							$accion = "Primer ingreso";
							$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($id, 31, $accion, $descripcionEvento);						
							$tabla = "tbl_preguntas_usuarios";
							
							//INSERTAR UN PASSWORD NUEVO
							$tabla="tbl_historial_pass";
							$idUsuario=$id;
							$password = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

							$respuestapass = ModeloUsuarios::mdlHistorialPassword($tabla,$idUsuario, $password);

							$datos = array("idUsuario" => $id,
											"idPregunta" => $_POST["nuevaPregunta"],
											"respuesta" => $_POST["respuestaPregunta"]);
				
											
							$respuestaPreguntas = ModeloUsuarios::mdlIngresarPreguntaUsuario($tabla, $datos);
				
							if($respuestaPreguntas == true){

								$descripcionEvento = "".$usuario." agrego sus preguntas de seguridad por primera vez";
								$accion = "Primer ingreso";
								$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($id, 31, $accion, $descripcionEvento);	

								$tabla = "tbl_usuarios";

								$item1 = 'estado';
								$valor1 = 1;

								$item2 = "primera_vez";
								$valor2 = 0;
				
								$item3 = 'id_usuario';
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
										window.location = "salir";				
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

			
			// } else {
			// 		echo '<script>			
			// 				Swal.fire({
			// 					title: "Por favor, llena los campos corectamente. Intente de nuevo.",
			// 					icon: "error",
			// 					toast: true,
			// 					position: "top",
			// 					showConfirmButton: false,
			// 					timer: 3000,
			// 				});
			// 			</script>';
			// }
		}
	}
	

	/*=============================================
	CAMBIAR CONTRASEÑA POR PREGUNTAS DE SEGURIDAD
	=============================================*/	
	static public function ctrCambiarContraseña($item, $valor, $itemUsuario, $valorUsuario, $post){

		$tabla1 = "tbl_personas";
		$tabla2 = "tbl_usuarios";

		// return $post;
		$tabla='tbl_historial_pass';
		//$item= 'pass';
		$id_usuario=$valor;     
			
		if(isset($post)){
			
			if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%*-,_+?¡¿=&.])\S{8,16}$/', $post)){
				
				$encriptar = crypt($post, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$respuestaContraseñas = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $itemUsuario, $valorUsuario);

				// return $respuestaContraseñas;


				$itemNuevo = '*';
				$respuestamostrar = ModeloUsuarios::mdlMostrarHistorialPassword($tabla,$itemNuevo,$id_usuario);

				// return $respuestamostrar;
				// if($respuestamostrar[] == 10){
					
				// } else {
					
				// }

				
			    $mostrarpass1= $respuestamostrar[0]['pass'];
				$mostrarpass2= $respuestamostrar[1]['pass'];
				$mostrarpass3= $respuestamostrar[2]['pass'];
				$mostrarpass4= $respuestamostrar[3]['pass'];
				$mostrarpass5= $respuestamostrar[4]['pass'];
				$mostrarpass6= $respuestamostrar[5]['pass'];
				$mostrarpass7= $respuestamostrar[6]['pass'];
				$mostrarpass8= $respuestamostrar[7]['pass'];
				$mostrarpass9= $respuestamostrar[8]['pass'];
				$mostrarpass10= $respuestamostrar[9]['pass'];

			     //-------------------------------MOSTRAR LAS FECHAS DE LOS PASSWORD
				$tabla='tbl_historial_pass';
				$item= 'fecha_creacion';
				$id_usuario=$valor;

				$respuestafechas = ModeloUsuarios::mdlFechasHistorialPassword($tabla,$id_usuario);  

				$fecha1= $respuestafechas[0]['fecha_creacion'];
				$fecha2= $respuestafechas[1]['fecha_creacion'];
				$fecha3= $respuestafechas[2]['fecha_creacion'];
				$fecha4= $respuestafechas[3]['fecha_creacion'];
				$fecha5= $respuestafechas[4]['fecha_creacion'];
				$fecha6= $respuestafechas[5]['fecha_creacion'];
				$fecha7= $respuestafechas[6]['fecha_creacion'];
				$fecha8= $respuestafechas[7]['fecha_creacion'];
				$fecha9= $respuestafechas[8]['fecha_creacion'];
				$fecha10= $respuestafechas[9]['fecha_creacion'];
			                
				$longitud = count($respuestamostrar); // Devuelve 2, pero nosotros queremos 6
			     $longitudRecursiva = count($respuestamostrar, COUNT_RECURSIVE); // Devuelve 6
			    //echo 'elnumero de elementos del arreglo es:--> '.$longitud;
			    //echo "<br>";
				

				if($respuestaContraseñas['password'] == $encriptar){

					return false;

				} else if($valorUsuario == $post) {

					return false;
					
				} else {

					
					if ($longitudRecursiva>10) {
						if ($fecha1<$fecha2 and $fecha1<$fecha3 and $fecha1<$fecha4 
							and $fecha1<$fecha5 and $fecha1<$fecha6 and $fecha1<$fecha7 
							and $fecha1<$fecha8 and $fecha1<$fecha9 and $fecha1<$fecha10) {

							$passwordmenor=$fecha1;

						}else if ($fecha2<$fecha1 and $fecha2<$fecha3 and $fecha2<$fecha4 
							and $fecha2<$fecha5 and $fecha2<$fecha6 and $fecha2<$fecha7 
							and $fecha2<$fecha8 and $fecha2<$fecha9 and $fecha2<$fecha10) {
											
						$passwordmenor=$fecha2;

						}else if ($fecha3<$fecha1 and $fecha3<$fecha2 and $fecha3<$fecha4 
							and $fecha3<$fecha5 and $fecha3<$fecha6 and $fecha3<$fecha7 
							and $fecha3<$fecha8 and $fecha3<$fecha9 and $fecha3<$fecha10) {
											
							$passwordmenor=$fecha3;

						}else if ($fecha4<$fecha1 and $fecha4<$fecha2 and $fecha4<$fecha3 
							and $fecha4<$fecha5 and $fecha4<$fecha6 and $fecha4<$fecha7 
							and $fecha4<$fecha8 and $fecha4<$fecha9 and $fecha4<$fecha10) {
											
							$passwordmenor=$fecha4;

						}else if ($fecha5<$fecha1 and $fecha5<$fecha2 and $fecha5<$fecha3 
							and $fecha5<$fecha4 and $fecha5<$fecha6 and $fecha5<$fecha7 
							and $fecha5<$fecha8 and $fecha5<$fecha9 and $fecha5<$fecha10){

							$passwordmenor=$fecha5;

						}else if ($fecha6<$fecha1 and $fecha6<$fecha2 and $fecha6<$fecha3 
							and $fecha6<$fecha4 and $fecha6<$fecha5 and $fecha6<$fecha7 
							and $fecha6<$fecha8 and $fecha6<$fecha9 and $fecha6<$fecha10){

							$passwordmenor=$fecha6;
										
						}else if ($fecha7<$fecha1 and $fecha7<$fecha2 and $fecha7<$fecha3 
							and $fecha7<$fecha4 and $fecha7<$fecha5 and $fecha7<$fecha6 
							and $fecha7<$fecha8 and $fecha7<$fecha9 and $fecha7<$fecha10){

							$passwordmenor=$fecha7;
										
						}else if ($fecha8<$fecha1 and $fecha8<$fecha2 and $fecha8<$fecha3 
							and $fecha8<$fecha4 and $fecha8<$fecha5 and $fecha8<$fecha6 
							and $fecha8<$fecha7 and $fecha8<$fecha9 and $fecha8<$fecha10){

							$passwordmenor=$fecha8;

						}else if ($fecha9<$fecha1 and $fecha9<$fecha2 and $fecha9<$fecha3 
							and $fecha9<$fecha4 and $fecha9<$fecha5 and $fecha9<$fecha6 
							and $fecha9<$fecha7 and $fecha9<$fecha8 and $fecha9<$fecha10){

							$passwordmenor=$fecha9;
						}else{
							$passwordmenor=$fecha10;
						}


					
						// echo $passwordmenor;

						$tabla='tbl_historial_pass';
						$item= 'fecha_creacion';
						$fecha_antigua=$passwordmenor;
						//$id_usuario=$respuestaContraseñas['id_usuario'];
					
						$respuestaEliminar = ModeloUsuarios::mdlEliminarHistorialPassword($tabla, $item, $fecha_antigua);
					}
					
					//INSERTAR UN PASSWORD NUEVO
					$tabla="tbl_historial_pass";
					$id_usuario=$respuestaContraseñas["id_usuario"];
					$password = crypt($post, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					$respuestapass = ModeloUsuarios::mdlHistorialPassword($tabla,$id_usuario, $password);

				
					//** =============== CREAMOS LA FECHA VENCIMIENTO DEL USUARIO =================*/
					$itemParam = 'parametro';
					$valorParam = 'ADMIN_DIAS_VIGENCIA';
					$parametros = ControladorUsuarios::ctrMostrarParametros($itemParam, $valorParam);
			
					$vigenciaUsuario = $parametros['valor'];

					date_default_timezone_set("America/Tegucigalpa");
					$fechaVencimiento = date("Y-m-d H:i:s", strtotime('+'.$vigenciaUsuario.' days'));

					$item1 = "password";
					$valor1 = $encriptar;

					$item2 = 'estado';
					$valor2 = 1;

					$item3 = "fecha_vencimiento";
					$valor3 = $fechaVencimiento;
					
					$item4 = $item;
					$valor4 = $valor;
	
					$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
					return $respuesta;
					
				}
				
				
			} else {

				$respuesta = 'false';
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

		$tabla1 = "tbl_personas";
		$tabla2 = "tbl_usuarios";
		$item = "token";
		$valor = $_GET['codigo'];

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

		// var_dump($respuesta['usuario']);
		// return;
		
		$idUsuario = $respuesta['id_usuario'];
		$usuario = $respuesta['usuario'];
		$passwordAnterior = $respuesta['contraseña'];

		//AQUI INICIA LA PARTE DE HISTORISLDE PASSWORD--------------------------------------------------
		$tabla='tbl_historial_pass';
		$item= 'pass';
		$valor=$_POST['editarPassword'];
		$idUsuario;

		$respuestaMostrar = ModeloUsuarios::mdlMostrarHistorialPassword($tabla,$item,$idUsuario);

		$mostrarPass1= $respuestaMostrar[0]['pass'];
		$mostrarPass2= $respuestaMostrar[1]['pass'];
		$mostrarPass3= $respuestaMostrar[2]['pass'];
		$mostrarPass4= $respuestaMostrar[3]['pass'];
		$mostrarPass5= $respuestaMostrar[4]['pass'];
		$mostrarPass6= $respuestaMostrar[5]['pass'];
		$mostrarPass7= $respuestaMostrar[6]['pass'];
		$mostrarPass8= $respuestaMostrar[7]['pass'];
		$mostrarPass9= $respuestaMostrar[8]['pass'];
		$mostrarPass10= $respuestaMostrar[9]['pass'];

		//-------------------------------MOSTRAR LAS FECHAS DE LOS PASSWORD
		$tabla='tbl_historial_pass';
		$item= 'fecha_creacion';
		$idUsuario;

		$respuestaFechas = ModeloUsuarios::mdlFechasHistorialPassword($tabla,$idUsuario);        
		$fecha1= $respuestaFechas[0]['fecha_creacion'];
		$fecha2= $respuestaFechas[1]['fecha_creacion'];
		$fecha3= $respuestaFechas[2]['fecha_creacion'];
		$fecha4= $respuestaFechas[3]['fecha_creacion'];
		$fecha5= $respuestaFechas[4]['fecha_creacion'];
		$fecha6= $respuestaFechas[5]['fecha_creacion'];
		$fecha7= $respuestaFechas[6]['fecha_creacion'];
		$fecha8= $respuestaFechas[7]['fecha_creacion'];
		$fecha9= $respuestaFechas[8]['fecha_creacion'];
		$fecha10= $respuestaFechas[9]['fecha_creacion'];
		
		$longitud = count($respuestaMostrar); // Devuelve 2, pero nosotros queremos 6
		$longitudRecursiva = count($respuestaMostrar, COUNT_RECURSIVE); // Devuelve 6
		//echo 'elnumero de elementos del arreglo es:--> '.$longitud;
		//echo "<br>";

				 

	 	

		
		if(isset($_POST['editarPassword'])){
			
			if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%*-,_+?¡¿=&.])\S{8,16}$/', $_POST['editarPassword'])){
				
				$encriptar = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$encriptarPassIngresado = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');	
			
				if ($encriptarPassIngresado==$mostrarPass1 || $encriptarPassIngresado==$mostrarPass2 ||
					$encriptarPassIngresado==$mostrarPass3 || $encriptarPassIngresado==$mostrarPass4 || 
					$encriptarPassIngresado==$mostrarPass5 ||$encriptarPassIngresado==$mostrarpPss6 || 
					$encriptarPassIngresado==$mostrarPass7 || $encriptarPassIngresado==$mostrarPass8 || 
					$encriptarPassIngresado==$mostrarPass9 || $encriptarPassIngresado==$mostrarPass10) {
						echo '<script>			
								Swal.fire({
								title: "Este password ha sido utilizado recientemente",
								icon: "error",
								showConfirmButton: true,
								timer: 3000,
								});
							</script>';

				} else if($passwordAnterior === $encriptar){

					echo '<script>
							Swal.fire({
								title: "La contraseña no puede ser igual a la anterior. Por favor, intente de nuevo.",
								icon: "error",
								heightAuto: false,
								showConfirmButton: false,
								timer: 4000,
							});					
						</script>';

				} else if($usuario == $_POST['editarPassword']) {

					echo '<script>
							Swal.fire({
								title: "Contraseña ingresada no puede ser igual a usuario, intente de nuevo.",
								icon: "error",
								heightAuto: false,
								showConfirmButton: false,
								timer: 4000,
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

					$tabla = "tbl_usuarios";
	
					$item1 = "password";
					$valor1 = $encriptar;

					$item2 = "estado";
					$valor2 = 1;

					$item3 = "fecha_vencimiento";
					$valor3 = $fechaVencimiento;

					$item4 = "id_usuario";
					$valor4 = $idUsuario;
	
					$respuesta = ModeloUsuarios::mdlActualizarUsuarioPorCodigo($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
	
					if($respuesta == true){

						//HISTORIAL PARA EL PASSWORD ELIMINACION E INSERCION//------------------

						//ELIMINAR EL PASSWORD MAS ANTIGUO ANTES DE INGRESAR UNO NUEVO
									if($longitudRecursiva>10){

										if ($fecha1<$fecha2 and $fecha1<$fecha3 and $fecha1<$fecha4 
											and $fecha1<$fecha5 and $fecha1<$fecha6 and $fecha1<$fecha7 
											and $fecha1<$fecha8 and $fecha1<$fecha9 and $fecha1<$fecha10) {

											$passwordMenor=$fecha1;

										}else if ($fecha2<$fecha1 and $fecha2<$fecha3 and $fecha2<$fecha4 
											and $fecha2<$fecha5 and $fecha2<$fecha6 and $fecha2<$fecha7 
											and $fecha2<$fecha8 and $fecha2<$fecha9 and $fecha2<$fecha10) {
											
											$passwordMenor=$fecha2;

										}else if ($fecha3<$fecha1 and $fecha3<$fecha2 and $fecha3<$fecha4 
											and $fecha3<$fecha5 and $fecha3<$fecha6 and $fecha3<$fecha7 
											and $fecha3<$fecha8 and $fecha3<$fecha9 and $fecha3<$fecha10) {
											
											$passwordMenor=$fecha3;

										}else if ($fecha4<$fecha1 and $fecha4<$fecha2 and $fecha4<$fecha3 
											and $fecha4<$fecha5 and $fecha4<$fecha6 and $fecha4<$fecha7 
											and $fecha4<$fecha8 and $fecha4<$fecha9 and $fecha4<$fecha10) {
											
											$passwordMenor=$fecha4;

										}else if ($fecha5<$fecha1 and $fecha5<$fecha2 and $fecha5<$fecha3 
											and $fecha5<$fecha4 and $fecha5<$fecha6 and $fecha5<$fecha7 
											and $fecha5<$fecha8 and $fecha5<$fecha9 and $fecha5<$fecha10){

											$passwordMenor=$fecha5;

										}else if ($fecha6<$fecha1 and $fecha6<$fecha2 and $fecha6<$fecha3 
											and $fecha6<$fecha4 and $fecha6<$fecha5 and $fecha6<$fecha7 
											and $fecha6<$fecha8 and $fecha6<$fecha9 and $fecha6<$fecha10){

											$passwordMenor=$fecha6;
										
										}else if ($fecha7<$fecha1 and $fecha7<$fecha2 and $fecha7<$fecha3 
											and $fecha7<$fecha4 and $fecha7<$fecha5 and $fecha7<$fecha6 
											and $fecha7<$fecha8 and $fecha7<$fecha9 and $fecha7<$fecha10){

											$passwordMenor=$fecha7;
										
										}else if ($fecha8<$fecha1 and $fecha8<$fecha2 and $fecha8<$fecha3 
											and $fecha8<$fecha4 and $fecha8<$fecha5 and $fecha8<$fecha6 
											and $fecha8<$fecha7 and $fecha8<$fecha9 and $fecha8<$fecha10){

											$passwordMenor=$fecha8;

										}else if ($fecha9<$fecha1 and $fecha9<$fecha2 and $fecha9<$fecha3 
											and $fecha9<$fecha4 and $fecha9<$fecha5 and $fecha9<$fecha6 
											and $fecha9<$fecha7 and $fecha9<$fecha8 and $fecha9<$fecha10){

											$passwordMenor=$fecha9;
										}else{
											$passwordMenor=$fecha10;
										}


										$tabla='tbl_historial_pass';
										$item= 'fecha_creacion';
										$fechaAntigua=$passwordMenor;
										//$id_usuario=$idUsuario;
						            
						            	$respuestaMostrar = ModeloUsuarios::mdlEliminarHistorialPassword($tabla,$item,$fechaAntigua);
									}

						//INSERTAR UN PASSWORD NUEVO

						$tabla="tbl_historial_pass";
						$idUsuario;
						$password = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

						$respuestaPass = ModeloUsuarios::mdlHistorialPassword($tabla,$idUsuario, $password);
						
						//ELIMINAR EL ID QUE SE ESTA INGRESANDO EN "0"
						$tabla="tbl_historial_pass";
						$item="id_usuario";
						$eliminarPassRepetido = ModeloUsuarios::mdlEliminarPasswordRepetido($tabla,$item);

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

			$tabla = "tbl_usuarios";

			$item1 = "token";
			$valor1 = $codigo;

			$item2 = "fecha_recuperacion";
			$valor2 = $fechaRecuperacion;

			$item3 = "id_usuario";
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
		$asunto = 'Recuperación de Contraseña';
		$require = true;
		
		// $parametros = ControladorGlobales::ctrMostrarParametros();

		$item = 'parametro';
		$valor = 'ADMIN_RUTA_URL';
		$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);

		$ruta = $parametros['valor'];

		// $correoEmpresa = $parametros[1]['valor'];
		// $passwordEmpresa = $parametros[0]['valor'];
		// return $correoEmpresa . '--' . $passwordEmpresa;

        $template = file_get_contents('../extensiones/plantillas/template.php');
        $template = str_replace("{{name}}", $nombre, $template);
        $template = str_replace("{{action_url_1}}", $ruta.'index.php?ruta=recuperar-password&codigo='.$codigo, $template);
        $template = str_replace("{{action_url_2}}", '<b>'.$ruta.'index.php?ruta=recuperar-password&codigo='.$codigo.'</b>', $template);
        $template = str_replace("{{year}}", date('Y'), $template);
        // $template = str_replace("{{operating_system}}", $user_os, $template);
		// $template = str_replace("{{browser_name}}", $user_browser, $template);


		$respuestaCorreo = ControladorUsuarios::ctrGenerarCorreo($correoDestinatario, $nombreDestinatario, $asunto, $template, $require);

		return $respuestaCorreo;

	}


	/*=============================================
	REVISAR CODIGO Y FECHA PARA CAMBIAR CONTRASEÑA
	=============================================*/	
    static public function ctrRevisarCodigoFecha(){

		if(isset($_GET['codigo'])){

			// $_SESSION['codigo'] = $_GET['codigo'];
			$tabla1 = "tbl_personas";
			$tabla2 = "tbl_usuarios";
			$item = "token";
			$valor = $_GET['codigo'];

			$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

			// var_dump($respuesta);
			// var_dump($respuesta['codigo'] . " " . $_GET['codigo']);
			// $respuesta["codigo"] != null && $_GET["codigo"] != $respuesta["codigo"]
			// return;

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
    static public function ctrGenerarCorreo($correoDestinatario, $nombreDestinatario, $asunto, $template, $require){

		if($require != false){
			
			require '../extensiones/PHPMailer/PHPMailer/src/Exception.php';
			require '../extensiones/PHPMailer/PHPMailer/src/PHPMailer.php';
			require '../extensiones/PHPMailer/PHPMailer/src/SMTP.php';

		} else {
			
			require 'extensiones/PHPMailer/PHPMailer/src/Exception.php';
			require 'extensiones/PHPMailer/PHPMailer/src/PHPMailer.php';
			require 'extensiones/PHPMailer/PHPMailer/src/SMTP.php';
		}

		
		$item = null;
		$valor = null;
		$parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);

		$correoEmpresa = $parametros[1]['valor'];
		$passwordEmpresa = $parametros[0]['valor'];
		$puerto = $parametros[5]['valor'];
		$host = $parametros[6]['valor'];
		$smtp = $parametros[7]['valor'];
		


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
            $mail->Subject = $asunto.' - Gimnasio';
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
	CAMBIAR CONTRASEÑA POR DESDE PERFIL/AJUSTES DEL USUARIO
	=============================================*/	
	static public function ctrCambiarContraseñaUsuario($idPersona){
		$tabla1 = "tbl_personas";
		$tabla2 = "tbl_usuarios";
			
		if(isset($_POST['passwordActual'])){
			
			$encriptar = crypt($_POST['passwordActual'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$item = 'id_personas';
			$valor = $idPersona;
			$respuestaContraseña = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);

			// echo '<pre>';
			// var_dump($respuestaContraseña);
			// echo '</pre>';
			// return;

			//AQUI INICIA LA PARTE DE HISTORISLDE PASSWORD--------------------------------------------------
			$tabla='tbl_historial_pass';
			$item= 'pass';
			$valor=$_POST['editarPassword'];
			$idUsuario=$respuestaContraseña['id_usuario'];

			$respuestaMostrar = ModeloUsuarios::mdlMostrarHistorialPassword($tabla,$item,$idUsuario);

			$mostrarPass1= $respuestaMostrar[0]['pass'];
			$mostrarPass2= $respuestaMostrar[1]['pass'];
			$mostrarPass3= $respuestaMostrar[2]['pass'];
			$mostrarPass4= $respuestaMostrar[3]['pass'];
			$mostrarPass5= $respuestaMostrar[4]['pass'];
			$mostrarPass6= $respuestaMostrar[5]['pass'];
			$mostrarPass7= $respuestaMostrar[6]['pass'];
			$mostrarPass8= $respuestaMostrar[7]['pass'];
			$mostrarPass9= $respuestaMostrar[8]['pass'];
			$mostrarPass10= $respuestaMostrar[9]['pass'];

			//echo "</br>";
			
			//-------------------------------MOSTRAR LAS FECHAS DE LOS PASSWORD
			$tabla='tbl_historial_pass';
			$item= 'fecha_creacion';
			$idUsuario=$respuestaContraseña['id_usuario'];

			$respuestaFechas = ModeloUsuarios::mdlFechasHistorialPassword($tabla,$idUsuario);        
			$fecha1= $respuestaFechas[0]['fecha_creacion'];
			$fecha2= $respuestaFechas[1]['fecha_creacion'];
			$fecha3= $respuestaFechas[2]['fecha_creacion'];
			$fecha4= $respuestaFechas[3]['fecha_creacion'];
			$fecha5= $respuestaFechas[4]['fecha_creacion'];
			$fecha6= $respuestaFechas[5]['fecha_creacion'];
			$fecha7= $respuestaFechas[6]['fecha_creacion'];
			$fecha8= $respuestaFechas[7]['fecha_creacion'];
			$fecha9= $respuestaFechas[8]['fecha_creacion'];
			$fecha10= $respuestaFechas[9]['fecha_creacion'];
			
			$longitud = count($respuestaMostrar); // Devuelve 2, pero nosotros queremos 6
			$longitudRecursiva = count($respuestaMostrar, COUNT_RECURSIVE); // Devuelve 6
			//echo 'elnumero de elementos del arreglo es:--> '.$longitud;
			//echo "<br>";

			$encriptarPassIngresado = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');			 

			if ($encriptarPassIngresado==$mostrarPass1 || $encriptarPassIngresado==$mostrarPass2 ||
				$encriptarPassIngresado==$mostrarPass3 || $encriptarPassIngresado==$mostrarPass4 || 
				$encriptarPassIngresado==$mostrarPass5 || $encriptarPassIngresado==$mostrarPass6 || 
				$encriptarPassIngresado==$mostrarPass7 || $encriptarPassIngresado==$mostrarPass8 || 
				$encriptarPassIngresado==$mostrarPass9 || $encriptarPassIngresado==$mostrarPass10) {
				echo '<script>			
				Swal.fire({
					title: "Este password ha sido utilizado recientemente",
					icon: "error",
					showConfirmButton: true,
					timer: 3000,
					});
				</script>';
				//---------------------------------------------------------------------------------------------

			}else if($respuestaContraseña['password'] == $encriptar){

				if(preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%*-,_+?¡¿=&.])\S{8,16}$/', $_POST['editarPassword'])){
					
					$encriptar = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
							
					$item = 'id_personas';
					$valor = $idPersona;
					$respuestaContraseñas = ModeloUsuarios::mdlMostrarUsuarios($tabla1, $tabla2, $item, $valor);
		
					// echo '<pre>';
					// var_dump($respuestaContraseñas);
					// echo '</pre>';
					// return;
					
					if($respuestaContraseñas['password'] == $encriptar){

						echo '<script>			
								Swal.fire({
									title: "Contraseña nueva no puede ser igual a la actual. Intente de nuevo.",
									icon: "error",
									showConfirmButton: true,
									timer: 3000,
								});
							</script>';

					} else if($respuestaContraseñas['usuario'] == $_POST['editarPassword']) {

						echo '<script>			
								Swal.fire({
									title: "Contraseña nueva no puede ser igual al nombre de usuario. Intente de nuevo.",
									icon: "error",
									showConfirmButton: true,
									timer: 3000,
								});
							</script>';
						
					} else {
						
						//** =============== CREAMOS LA FECHA VENCIMIENTO DEL USUARIO =================*/
						$itemParam = 'parametro';
						$valorParam = 'ADMIN_DIAS_VIGENCIA';
						$parametros = ControladorUsuarios::ctrMostrarParametros($itemParam, $valorParam);

						// echo '<pre>';
						// var_dump($parametros);
						// echo '</pre>';
						// return;
						$vigenciaUsuario = $parametros['valor'];

						date_default_timezone_set("America/Tegucigalpa");
						$fechaVencimiento = date("Y-m-d H:i:s", strtotime('+'.$vigenciaUsuario.' days'));

						$item1 = "password";
						$valor1 = $encriptar;

						$item2 = 'estado';
						$valor2 = 1;

						$item3 = "fecha_vencimiento";
						$valor3 = $fechaVencimiento;
						
						$item4 = 'id_persona';
						$valor4 = $idPersona;
		
						$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);

						// var_dump($respuesta);
						// return;
						if($respuesta == true ){

							//HISTORIAL PARA EL PASSWORD ELIMINACION E INSERCION//------------------

							//ELIMINAR EL PASSWORD MAS ANTIGUO ANTES DE INGRESAR UNO NUEVO

							if($longitudRecursiva>10){

								if ($fecha1<$fecha2 and $fecha1<$fecha3 and $fecha1<$fecha4 
				                	and $fecha1<$fecha5 and $fecha1<$fecha6 and $fecha1<$fecha7 
				                	and $fecha1<$fecha8 and $fecha1<$fecha9 and $fecha1<$fecha10) {

				                	$passwordMenor=$fecha1;

				                }else if ($fecha2<$fecha1 and $fecha2<$fecha3 and $fecha2<$fecha4 
									and $fecha2<$fecha5 and $fecha2<$fecha6 and $fecha2<$fecha7 
									and $fecha2<$fecha8 and $fecha2<$fecha9 and $fecha2<$fecha10) {
				                	
				                	$passwordMenor=$fecha2;

				                }else if ($fecha3<$fecha1 and $fecha3<$fecha2 and $fecha3<$fecha4 
									and $fecha3<$fecha5 and $fecha3<$fecha6 and $fecha3<$fecha7 
									and $fecha3<$fecha8 and $fecha3<$fecha9 and $fecha3<$fecha10) {
				                	
				                	$passwordMenor=$fecha3;

				                }else if ($fecha4<$fecha1 and $fecha4<$fecha2 and $fecha4<$fecha3 
									and $fecha4<$fecha5 and $fecha4<$fecha6 and $fecha4<$fecha7 
									and $fecha4<$fecha8 and $fecha4<$fecha9 and $fecha4<$fecha10) {
				                	
				                	$passwordMenor=$fecha4;

				                }else if ($fecha5<$fecha1 and $fecha5<$fecha2 and $fecha5<$fecha3 
									and $fecha5<$fecha4 and $fecha5<$fecha6 and $fecha5<$fecha7 
									and $fecha5<$fecha8 and $fecha5<$fecha9 and $fecha5<$fecha10){

				                	$passwordMenor=$fecha5;

				            	}else if ($fecha6<$fecha1 and $fecha6<$fecha2 and $fecha6<$fecha3 
									and $fecha6<$fecha4 and $fecha6<$fecha5 and $fecha6<$fecha7 
									and $fecha6<$fecha8 and $fecha6<$fecha9 and $fecha6<$fecha10){

				                	$passwordMenor=$fecha6;
								
								}else if ($fecha7<$fecha1 and $fecha7<$fecha2 and $fecha7<$fecha3 
									and $fecha7<$fecha4 and $fecha7<$fecha5 and $fecha7<$fecha6 
									and $fecha7<$fecha8 and $fecha7<$fecha9 and $fecha7<$fecha10){

				                	$passwordMenor=$fecha7;
								
								}else if ($fecha8<$fecha1 and $fecha8<$fecha2 and $fecha8<$fecha3 
									and $fecha8<$fecha4 and $fecha8<$fecha5 and $fecha8<$fecha6 
									and $fecha8<$fecha7 and $fecha8<$fecha9 and $fecha8<$fecha10){

				                	$passwordMenor=$fecha8;

								}else if ($fecha9<$fecha1 and $fecha9<$fecha2 and $fecha9<$fecha3 
									and $fecha9<$fecha4 and $fecha9<$fecha5 and $fecha9<$fecha6 
									and $fecha9<$fecha7 and $fecha9<$fecha8 and $fecha9<$fecha10){

				                	$passwordMenor=$fecha9;
								}else{
									$passwordMenor=$fecha10;
								}

								$tabla='tbl_historial_pass';
								$item= 'fecha_creacion';
								$fechaAntigua=$passwordMenor;
								$idUsuario=$respuestaContraseña['id_usuario'];
								
									
								$respuestaEliminar = ModeloUsuarios::mdlEliminarHistorialPassword($tabla,$item,$fechaAntigua);
							}

							//INSERTAR UN PASSWORD NUEVO
				            $tabla="tbl_historial_pass";
							$idUsuario=$respuestaContraseña['id_usuario'];

							$password = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

							$respuestaPass = ModeloUsuarios::mdlHistorialPassword($tabla,$idUsuario, $password);

							echo '<script>
                                    Swal.fire({
                                        title: "Contraseña cambiada correctamente!",
                                        icon: "success",
                                        heightAuto: false
                                    }).then((result)=>{
                                        if(result.value){
                                            window.location = "perfil";
                                        }
                                    });                                      
                                </script>';
						}
					
					}
					
				
				} else {

					echo '<script>			
							Swal.fire({
								title: "Llenar los campos correctamente. Intente de nuevo.",
								icon: "error",
								showConfirmButton: true,
								timer: 3000,
							});
						</script>';
				}

			} else {
				echo '<script>			
						Swal.fire({
							title: "Contraseña actual no coincide. Intente de nuevo.",
							icon: "error",
							showConfirmButton: true,
							timer: 3000,
						});
					</script>';
			}	
		} 
	
	}

	
	/*====================================================
	ACTUALIZAR PREGUNTAS/RESPUESTAS POR DESDE PERFIL/AJUSTES DEL USUARIO
	====================================================*/	
	static public function ctrActualizarPreguntasRespuestas($idUsuario){
		
		// echo '<pre>';
		// var_dump($_POST);
		// echo '</pre>';
		// return;
		if(isset($_POST['editarRespuestaPregunta'])){

			if(preg_grep('/^(?=.*[a-zA-ZñÑáéíóúÁÉÍÓÚ])\S{1,50}$/', $_POST["editarRespuestaPregunta"])){
				
				$tabla = "tbl_preguntas_usuarios";

				// $array = array("idUno" => 7,
				// "idDos" => 8,
				// "idTres" => 9);
							
				$datos = array("idUsuario" => $idUsuario,
								"idPregunta" => $_POST["editarPregunta"],
								"respuesta" => $_POST["editarRespuestaPregunta"],
								"id_preguntas_usuarios" => $_POST["idPreguntaUsuario"]);
	
								
				$respuestaPreguntas = ModeloUsuarios::mdlActualizarPreguntaUsuario($tabla, $datos);
	
				// var_dump($respuestaPreguntas);
				// return;

				if($respuestaPreguntas == true){
					echo '<script>
							Swal.fire({
								title: "Preguntas/respuestas actualizadas correctamente.",
								icon: "success"
							}).then((result)=>{
								if(result.value){
									window.location = "perfil";
								}
							});					
						</script>';
				}
			}
		}
	}


	/*====================================================
	ACTUALIZAR FOTO DESDE PERFIL/AJUSTES DEL USUARIO
	====================================================*/	
	static public function ctrEditarFoto($idUsuario, $usuario){
		// echo $usuario;
		// var_dump($_FILES);
		// if($_FILES['editarFoto']['name'] == ""){
		// 	echo 'si';
		// } else {
		// 	echo 'no';

		// }
		// var_dump($_POST);
		// return;

		if(isset($_FILES['editarFoto'])){

			if($_FILES['editarFoto']['name'] != ""){

				/*=============================================
						VALIDAR IMAGEN
				=============================================*/
	
				$ruta = $_POST['fotoActual'];
	
				if(isset($_FILES['editarFoto']["tmp_name"]) && !empty($_FILES['editarFoto']["tmp_name"])){
	
					list($ancho, $alto) = getimagesize($_FILES['editarFoto']["tmp_name"]);
	
					$nuevoAncho = 500;
					$nuevoAlto = 500;
	
					/*==============================================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					===============================================================*/
	
					$directorio = "vistas/img/usuarios/".$usuario;
	
					// PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BASE DE DATOS 
					if(!empty($_POST['fotoActual'])){
			
						unlink($_POST['fotoActual']); 
	
					} else {
	
						mkdir($directorio, 0755); 
					}
	
					// echo $directorio;
					// return;
	
					/*=====================================================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					======================================================================*/
	
					if($_FILES['editarFoto']["type"] == "image/jpeg"){
	
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
	
						$aleatorio = mt_rand(100,999);
	
						$ruta = "vistas/img/usuarios/".$usuario."/".$aleatorio.".jpg";
	
						$origen = imagecreatefromjpeg($_FILES['editarFoto']["tmp_name"]);
	
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
	
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
	
						imagejpeg($destino, $ruta);
	
					}
	
					if($_FILES['editarFoto']["type"] == "image/png"){
	
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
	
						$aleatorio = mt_rand(100,999);
	
						$ruta = "vistas/img/usuarios/".$usuario."/".$aleatorio.".png";
	
						$origen = imagecreatefrompng($_FILES['editarFoto']["tmp_name"]);
	
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
	
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
	
						imagepng($destino, $ruta);
	
					}
	
				} 
	
				$tabla = 'tbl_usuarios';
				$item1 = "foto";
				$valor1 = $ruta;
	
				$item2 = 'id_usuario';
				$valor2 = $idUsuario;
	
				$item3 = null;
				$valor3 = null;
				
				$item4 = null;
				$valor4 = null;
	
				$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3, $item4, $valor4);
	
				// var_dump($respuesta);
				if($respuesta == true){
					echo '<script>
						Swal.fire({
							title: "Tu foto se cambio exitosamente!",
							icon: "success",
							heightAuto: false
						}).then((result)=>{
							if(result.value){
								window.location = "perfil";
							}
						});                                      
					</script>';
				}

			} else {
				echo '<script>
						Swal.fire({
							title: "Elija un archivo.",
							icon: "error",
							heightAuto: false
						}).then((result)=>{
							if(result.value){
								window.location = "perfil";
							}
						});                                      
					</script>';
			}


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

	}
	
	
    /*=============================================
	MOSTRAR PARAMETROS
    =============================================*/
    static public function ctrMostrarParametros($item, $valor){
        $tabla = 'tbl_parametros';
		$respuesta = ModeloUsuarios::mdlMostrarParametros($tabla, $item, $valor);

		return $respuesta;
	}
	

	/*=============================================
	RANGO DINAMICO
	=============================================*/
	static public function ctrRangoUsuarios($rango){

		$tabla = 'tbl_usuarios';
		
		$respuesta = ModeloUsuarios::mdlRango($tabla, $rango);
		
		return $respuesta;
	}



    /*=============================================
	GENERAR CONTRASEÑAS ALEATORIAS
    =============================================*/
	static public function password_seguro_random(){
 
		//palabras y caracteres que se utilizarán para crear la contraseña
		$words = 'azote,velocirap,mantis,friend,srcodigo,fuente,kobold,troll,rings,murloc,testement,homaho,jaloja,helohe,haheg';
		$words2 = '!,@,#,$,%,.';
		$words3 = 'X,Y,Z,H,H,M,N,Q,O,P';
		
		// partimos las cadenas por las comas:
		$array_words = explode( ',', $words);
		$array_words2 = explode( ',', $words2);
		$array_words3 = explode( ',', $words3);
		
		// Añade una palabra de cada grupo
		$pwd = '';
		$pwd .= $array_words[mt_rand(0, sizeof( $array_words )-1)];
		$pwd .= $array_words2[mt_rand(0, sizeof( $array_words2 )-1)];
		$pwd .= $array_words3[mt_rand(0, sizeof( $array_words3 )-1)];
		
		// añade un número al principio si el password
		$num = mt_rand(1, 99);
		$pwd = $num . $pwd;
		
		//para mayor seguridad modifico un caracter aleatorio de la cadena por un número
		$num = mt_rand(1, 99);
		$pos_random = mt_rand(0, strlen($pwd) - 1 );
		$pwd[$pos_random] = $num;
	
		return $pwd;
	 
	}

}

