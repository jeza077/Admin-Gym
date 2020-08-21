<?php

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	public function ctrIngresoUsuario(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

				$tabla = "usuarios";

				$item = "usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $_POST["ingPassword"]){

					$_SESSION["iniciarSesion"] = "ok";

					echo '<script>

						window.location = "inicio";

					</script>';

				}else{

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

				}

			}	

		}

	}

	    /*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario(){

		if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[A-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			//    preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])
			   preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/', $_POST["nuevoPassword"])){

			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				// $ruta = "";

				// if(isset($_FILES["nuevaFoto"]["tmp_name"])){

				// 	list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

				// 	$nuevoAncho = 500;
				// 	$nuevoAlto = 500;

				// 	/*=============================================
				// 	CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
				// 	=============================================*/

				// 	$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

				// 	mkdir($directorio, 0755); 

				// 	/*=============================================
				// 	DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				// 	=============================================*/

				// 	if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

				// 		/*=============================================
				// 		GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				// 		=============================================*/

				// 		$aleatorio = mt_rand(100,999);

				// 		$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

				// 		$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

				// 		$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// 		imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				// 		imagejpeg($destino, $ruta);

				// 	}

				// 	if($_FILES["nuevaFoto"]["type"] == "image/png"){

				// 		/*=============================================
				// 		GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				// 		=============================================*/

				// 		$aleatorio = mt_rand(100,999);

				// 		$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

				// 		$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

				// 		$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// 		imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				// 		imagepng($destino, $ruta);

				// 	}

				// }

				$tabla = "usuarios";

    			/*================== ENCRIPTAMOS LA CONTRASEÑA ===================*/
				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');


				$datos = array("identidad" => $_POST["nuevaIdentidad"],
							   "nombre" => $_POST["nuevoNombre"],
							   "apellido" => $_POST["nuevoApellido"],
							   "nombre" => $_POST["nuevoEmail"],
							   "nombre" => $_POST["nuevoTelefono"],
							   "nombre" => $_POST["nuevaFechaNacimiento"],
							   "nombre" => $_POST["nuevaDireccion"],
							   "nombre" => $_POST["nuevoSexo"],
							   "nombre" => $_POST["nuevaFoto"],
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $encriptar,
					           "perfil" => $_POST["nuevoPerfil"],
					           "foto"=>$ruta);

				// $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
		
				if($respuesta == "ok"){

					echo '<script>
					swal({
						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "usuarios";
						}
					});
					</script>';
					
					
										// Swal.fire(
										// 	"Good job!",
										// 	"You clicked the button!",
										// 	"success"
										//   )

				}


			}else{

				echo '<script>
					swal({
						type: "error",
						title: "¡Llenar campos correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					}).then((result)=>{
						if(result.value){
							window.location = "usuarios";
						}
					});
				</script>';

			}


		}


	}

}
	


