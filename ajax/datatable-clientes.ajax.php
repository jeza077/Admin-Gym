<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

// 
session_start();

class TablaClientes{
    
 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaClientes(){

        $tabla = "tbl_clientes";
        $item = null;
        $valor = null;
        $clientes = ControladorClientes::ctrMostrarClientesSinPago($tabla, $item, $valor);

        //   echo "<pre>";
        //   var_dump($clientes);
        //   echo "</pre>";
        //   return;
		
  		if(count($clientes) == 0){

  			echo '{"data": []}';

		  	return;
  		}
        
          
  		$datosJson = '{
              "data": [';

            // session_start();
            $permisoAgregar = $_SESSION['permisos']['Administrar Clientes']['agregar'];
            $permisoEliminar = $_SESSION['permisos']['Administrar Clientes']['eliminar'];
            $permisoActualizar = $_SESSION['permisos']['Administrar Clientes']['actualizar'];
            $permisoConsulta = $_SESSION['permisos']['Administrar Clientes']['consulta'];

                       
            for($i = 0; $i < count($clientes); $i++){
                    
                /*=============================================
                TRAEMOS LAS ACCIONES
                =============================================*/ 

                if($clientes[$i]['tipo_cliente'] == "Gimnasio"){
                    // $botones = 'Gym';

                    if($permisoActualizar == 1 && $permisoEliminar == 0  && $permisoConsulta == 1){
  
                        $botones = "<button class='btn btn-info btnVerClienteGimnasio' tipoClienteGimnasio='".$clientes[$i]["tipo_cliente"]."' idEditarClienteGimnasio='".$clientes[$i]["id_personas"]."' data-toggle='modal' data-target='#modalVerClienteGym' data-toggle='tooltip' data-placement='left' title='Ver más'><i class='fas fa-eye' style='color:#fff'></i></button> <button class='btn btn-warning btnEditarClienteGimnasio' tipoClienteGimnasio='".$clientes[$i]["tipo_cliente"]."' id='btnEditarClienteGimnasio' data-toggle='modal' data-target='#modalEditarClienteGimnasio' idEditarClienteGimnasio='".$clientes[$i]["id_personas"]."'><i class='fas fa-pencil-alt' style='color:#fff'></i></button>";

                      } else if($permisoActualizar == 0 && $permisoEliminar == 1  && $permisoConsulta == 1){

                        $botones = "<button class='btn btn-info btnVerClienteGimnasio' tipoClienteGimnasio='".$clientes[$i]["tipo_cliente"]."' idEditarClienteGimnasio='".$clientes[$i]["id_personas"]."' data-toggle='modal' data-target='#modalVerClienteGym' data-toggle='tooltip' data-placement='left' title='Ver más'><i class='fas fa-eye' style='color:#fff'></i></button> <button class='btn btn-danger btnEliminarCliente' idPersona='".$clientes[$i]["id_personas"]."'><i class='fas fa-trash-alt'></i></button>";
                      
                      } else if($permisoActualizar == 0 && $permisoEliminar == 0  && $permisoConsulta == 1){
  
                        $botones = "<button class='btn btn-info btnVerClienteGimnasio' tipoClienteGimnasio='".$clientes[$i]["tipo_cliente"]."' idEditarClienteGimnasio='".$clientes[$i]["id_personas"]."' data-toggle='modal' data-target='#modalVerClienteGym' data-toggle='tooltip' data-placement='left' title='Ver más'><i class='fas fa-eye' style='color:#fff'></i></button>";
  
                      } else {
                        $botones = "<button class='btn btn-info btnVerClienteGimnasio' tipoClienteGimnasio='".$clientes[$i]["tipo_cliente"]."' idEditarClienteGimnasio='".$clientes[$i]["id_personas"]."' data-toggle='modal' data-target='#modalVerClienteGym' data-toggle='tooltip' data-placement='left' title='Ver más'><i class='fas fa-eye' style='color:#fff'></i></button> <button class='btn btn-warning btnEditarClienteGimnasio' tipoClienteGimnasio='".$clientes[$i]["tipo_cliente"]."' id='btnEditarClienteGimnasio' data-toggle='modal' data-target='#modalEditarClienteGimnasio' idEditarClienteGimnasio='".$clientes[$i]["id_personas"]."'><i class='fas fa-pencil-alt' style='color:#fff'></i></button> <button class='btn btn-danger btnEliminarCliente' idPersona='".$clientes[$i]["id_personas"]."'><i class='fas fa-trash-alt'></i></button>";
                      }
                    
                    $botones = "<button class='btn btn-info btnVerClienteGimnasio' tipoClienteGimnasio='".$clientes[$i]["tipo_cliente"]."' idEditarClienteGimnasio='".$clientes[$i]["id_personas"]."' data-toggle='modal' data-target='#modalVerClienteGym' data-toggle='tooltip' data-placement='left' title='Ver más'><i class='fas fa-eye' style='color:#fff'></i></button> <button class='btn btn-warning btnEditarClienteGimnasio' tipoClienteGimnasio='".$clientes[$i]["tipo_cliente"]."' id='btnEditarClienteGimnasio' data-toggle='modal' data-target='#modalEditarClienteGimnasio' idEditarClienteGimnasio='".$clientes[$i]["id_personas"]."'><i class='fas fa-pencil-alt' style='color:#fff'></i></button> <button class='btn btn-danger btnEliminarCliente' idPersona='".$clientes[$i]["id_personas"]."'><i class='fas fa-trash-alt'></i></button>";

                } else {
                    // $botones = 'Ventas';

                    if($permisoActualizar == 1 && $permisoEliminar == 0  && $permisoConsulta == 1){
  
                        $botones = "<button class='btn btn-info btnVerClienteVenta' tipoClienteVenta='".$clientes[$i]["tipo_cliente"]."' idEditarClienteVenta='".$clientes[$i]["id_personas"]."' data-toggle='modal' data-target='#modalVerClienteVenta' data-toggle='tooltip' data-placement='left' title='Ver más'><i class='fas fa-eye' style='color:#fff'></i></button> <button class='btn btn-warning btnEditarClienteVenta' tipoClienteVenta='".$clientes[$i]["tipo_cliente"]."' id='btnEditarClienteVenta' data-toggle='modal' data-target='#modalEditarClienteVenta' idEditarClienteVenta='".$clientes[$i]["id_personas"]."'><i class='fas fa-pencil-alt' style='color:#fff'></i></button>";

                      } else if($permisoActualizar == 0 && $permisoEliminar == 1  && $permisoConsulta == 1){

                        $botones = "<button class='btn btn-info btnVerClienteVenta' tipoClienteVenta='".$clientes[$i]["tipo_cliente"]."' idEditarClienteVenta='".$clientes[$i]["id_personas"]."' data-toggle='modal' data-target='#modalVerClienteVenta' data-toggle='tooltip' data-placement='left' title='Ver más'><i class='fas fa-eye' style='color:#fff'></i></button>  <button class='btn btn-danger btnEliminarCliente' idPersona='".$clientes[$i]["id_personas"]."'><i class='fas fa-trash-alt'></i></button>";
                      
                      } else if($permisoActualizar == 0 && $permisoEliminar == 0  && $permisoConsulta == 1){

                        $botones = "<button class='btn btn-info btnVerClienteVenta' tipoClienteVenta='".$clientes[$i]["tipo_cliente"]."' idEditarClienteVenta='".$clientes[$i]["id_personas"]."' data-toggle='modal' data-target='#modalVerClienteVenta' data-toggle='tooltip' data-placement='left' title='Ver más'><i class='fas fa-eye' style='color:#fff'></i></button>";

                      } else {

                        $botones = "<button class='btn btn-info btnVerClienteVenta' tipoClienteVenta='".$clientes[$i]["tipo_cliente"]."' idEditarClienteVenta='".$clientes[$i]["id_personas"]."' data-toggle='modal' data-target='#modalVerClienteVenta' data-toggle='tooltip' data-placement='left' title='Ver más'><i class='fas fa-eye' style='color:#fff'></i></button> <button class='btn btn-warning btnEditarClienteVenta' tipoClienteVenta='".$clientes[$i]["tipo_cliente"]."' id='btnEditarClienteVenta' data-toggle='modal' data-target='#modalEditarClienteVenta' idEditarClienteVenta='".$clientes[$i]["id_personas"]."'><i class='fas fa-pencil-alt' style='color:#fff'></i></button> <button class='btn btn-danger btnEliminarCliente' idPersona='".$clientes[$i]["id_personas"]."'><i class='fas fa-trash-alt'></i></button>";

                      }

                    // $botones = "<button class='btn btn-info btnVerClienteVenta' tipoClienteVenta='".$clientes[$i]["tipo_cliente"]."' idEditarClienteVenta='".$clientes[$i]["id_personas"]."' data-toggle='modal' data-target='#modalVerClienteVenta' data-toggle='tooltip' data-placement='left' title='Ver más'><i class='fas fa-eye' style='color:#fff'></i></button> <button class='btn btn-warning btnEditarClienteVenta' tipoClienteVenta='".$clientes[$i]["tipo_cliente"]."' id='btnEditarClienteVenta' data-toggle='modal' data-target='#modalEditarClienteVenta' idEditarClienteVenta='".$clientes[$i]["id_personas"]."'><i class='fas fa-pencil-alt' style='color:#fff'></i></button> <button class='btn btn-danger btnEliminarCliente' idPersona='".$clientes[$i]["id_personas"]."'><i class='fas fa-trash-alt'></i></button>";
                }

                $datosJson .='[
                    "'.($i+1).'",
                    "'.$clientes[$i]["num_documento"].'",
                    "'.$clientes[$i]["nombre"].' '.$clientes[$i]["apellidos"].'",
                    "'.$clientes[$i]["tipo_cliente"].'",
                    "'.$clientes[$i]["correo"].'",
                    "'.$clientes[$i]["telefono"].'",
                    "'.$botones.'"
                ],';
                
            }
            // "'.$clientes[$i]["fecha_creacion"].'",

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$mostrarClientes = new TablaClientes();
$mostrarClientes -> mostrarTablaClientes();
    