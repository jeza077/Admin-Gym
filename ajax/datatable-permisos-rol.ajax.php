<?php
session_start();
// require_once "../controladores/usuarios.controlador.php";
// require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/mantenimiento.controlador.php";
require_once "../modelos/mantenimiento.modelo.php";

class TablaPermisosRol{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaPermisosRol(){

        $item1 = null;
        $valor1 = null;
        $item2 = null;
        $valor2 = null;
        
        $permisosRol = ControladorMantenimientos::ctrMostrarPermisosRoles($item1, $valor1, $item2, $valor2);
		
  		if(count($permisosRol) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($permisosRol); $i++){

            if($permisosRol[$i]["objeto"] != null){
                $pantalla = "<div>".$permisosRol[$i]["objeto"]."</div>";
            
            }else{
                $pantalla = "<div>**No tiene pantallas asignadas aún**</div>";                           
            }
            
            // <div>'.$permisosRol[$i]["objeto"].'</div>';

            if($permisosRol[$i]["consulta"] == null){
                $consulta = "<div>**No tiene permiso aún**</div>";                           

            
            }else if($permisosRol[$i]["consulta"] == 0){
                $consulta = "<div><button class='btn btn-danger btn-md btnActivarPermisos' idPermiso='".$permisosRol[$i]["id_permiso"]."' estadoPermiso='1' tipoPermiso='consulta'>No</button></div>";                           
            
            } else {

                $consulta = "<div><button class='btn btn-success btn-md btnActivarPermisos' idPermiso='".$permisosRol[$i]["id_permiso"]."' estadoPermiso='0' tipoPermiso='consulta'>Si</button></div>";                    
            }

            if($permisosRol[$i]["agregar"] == null){
                $agregar = "<div>**No tiene permiso aún**</div>";                           
            
            }else if($permisosRol[$i]["agregar"] == 0){
                $agregar = "<div><button class='btn btn-danger btn-md btnActivarPermisos' idPermiso='".$permisosRol[$i]["id_permiso"]."' estadoPermiso='1' tipoPermiso='agregar'>No</button></div>";                           
            
            } else {
                $agregar = "<div><button class='btn btn-success btn-md btnActivarPermisos' idPermiso='".$permisosRol[$i]["id_permiso"]."' estadoPermiso='0' tipoPermiso='agregar'>Si</button></div>";

            }

            if($permisosRol[$i]["actualizar"] == null){
                $actualizar = "<div>**No tiene permiso aún**</div>";                           
            
            }else if($permisosRol[$i]["actualizar"] == 0){
                $actualizar = "<div><button class='btn btn-danger btn-md btnActivarPermisos' idPermiso='".$permisosRol[$i]["id_permiso"]."' estadoPermiso='1' tipoPermiso='actualizar'>No</button></div>";                           
            
            } else {
                $actualizar = "<div><button class='btn btn-success btn-md btnActivarPermisos' idPermiso='".$permisosRol[$i]["id_permiso"]."' estadoPermiso='0' tipoPermiso='actualizar'>Si</button></div>";

            }

            if($permisosRol[$i]["eliminar"] == null){
                $eliminar = "<div>**No tiene permiso aún**</div>";                           
            
            }else if($permisosRol[$i]["eliminar"] == 0){
                $eliminar = "<div><button class='btn btn-danger btn-md btnActivarPermisos' idPermiso='".$permisosRol[$i]["id_permiso"]."' estadoPermiso='1' tipoPermiso='eliminar'>No</button></div>";                           
            
            } else {
                $eliminar = "<div><button class='btn btn-success btn-md btnActivarPermisos' idPermiso='".$permisosRol[$i]["id_permiso"]."' estadoPermiso='0' tipoPermiso='eliminar'>Si</button></div>";
            }

		  	$datosJson .='[
			      "'.($i+1).'",
                  "'.$permisosRol[$i]["rol"].'",
			      "'.$pantalla.'",
                  "'.$consulta.'",
			      "'.$agregar.'",
			      "'.$actualizar.'",
			      "'.$eliminar.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$mostrarPermisosRol = new TablaPermisosRol();
$mostrarPermisosRol -> mostrarTablaPermisosRol();
    