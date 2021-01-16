<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administracion de Permisos</h1>
          </div>
          <div class="col-sm-6">
              <!-- <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoRol">
                Nuevo Rol        
              </button> -->
              <button class="btn btn-danger btnExportarPermisosRol float-right mr-3 ">
                Exportar PDF      
              </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>  

  <section class="content">

    <div class="card">

      <div class="card-body">

        <?php
            $descripcionEvento = " Consulto la pantalla de mantenimiento";
            $accion = "consulta";

            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

        ?>

          <!--========================================================
                      ROL
            ==========================================================-->   

        <table class="table table-striped table-bordered tablas text-center">

          <thead>
                          
            <tr>                    
                <th scope="col">#</th>   
                <th scope="col">Rol</th> 
                <th scope="col">Pantalla</th> 
                <th scope="col">Consulta</th>  
                <th scope="col">Agregar</th>
                <th scope="col">Actualizar</th>
                <th scope="col">Eliminar</th>
            </tr>

          </thead>

          <tbody>

            <?php
                // $tabla = "tbl_roles";
                $item1 = null;
                $valor1 = null;
                $item2 = null;
                $valor2 = null;
                
                $permisosRol = ControladorMantenimientos::ctrMostrarPermisosRoles($item1, $valor1, $item2, $valor2);
                // var_dump($permisosRol);

                foreach ($permisosRol as $key => $value){
                  echo '
                    <tr>
                    
                        <td>'.($key + 1).'</td>
                        <td>'.$value["rol"].'</td>';

                        if($value["objeto"] != null){
                            echo' <td>'.$value["objeto"].'</td>';
                        
                        }else{
                            echo' <td>**No tiene pantallas asiganadas aun**</td>';                           
                        }
                        
                        // <td>'.$value["objeto"].'</td>';

                        if($value["consulta"] == null){
                            echo' <td>**No tiene permiso aun**</td>';                           

                        
                        }else if($value["consulta"] == 0){
                            echo' <td><button class="btn btn-danger btn-md btnActivarPermisos" idPermiso="'.$value["id_permiso"].'" estadoPermiso="1" tipoPermiso="consulta">No</button></td>';                           
                        
                        } else {
 
                            echo' <td><button class="btn btn-success btn-md btnActivarPermisos" idPermiso="'.$value["id_permiso"].'" estadoPermiso="0" tipoPermiso="consulta">Si</button></td>';                    
                        }

                        if($value["agregar"] == null){
                            echo' <td>**No tiene permiso aun**</td>';                           
                        
                        }else if($value["agregar"] == 0){
                            echo' <td><button class="btn btn-danger btn-md btnActivarPermisos" idPermiso="'.$value["id_permiso"].'" estadoPermiso="1" tipoPermiso="agregar">No</button></td>';                           
                        
                        } else {
                            echo' <td><button class="btn btn-success btn-md btnActivarPermisos" idPermiso="'.$value["id_permiso"].'" estadoPermiso="0" tipoPermiso="agregar">Si</button></td>';

                        }

                        if($value["actualizar"] == null){
                            echo' <td>**No tiene permiso aun**</td>';                           
                        
                        }else if($value["actualizar"] == 0){
                            echo' <td><button class="btn btn-danger btn-md btnActivarPermisos" idPermiso="'.$value["id_permiso"].'" estadoPermiso="1" tipoPermiso="actualizar">No</button></td>';                           
                        
                        } else {
                            echo' <td><button class="btn btn-success btn-md btnActivarPermisos" idPermiso="'.$value["id_permiso"].'" estadoPermiso="0" tipoPermiso="actualizar">Si</button></td>';

                        }

                        if($value["eliminar"] == null){
                            echo' <td>**No tiene permiso aun**</td>';                           
                        
                        }else if($value["eliminar"] == 0){
                            echo' <td><button class="btn btn-danger btn-md btnActivarPermisos" idPermiso="'.$value["id_permiso"].'" estadoPermiso="1" tipoPermiso="eliminar">No</button></td>';                           
                        
                        } else {
                            echo' <td><button class="btn btn-success btn-md btnActivarPermisos" idPermiso="'.$value["id_permiso"].'" estadoPermiso="0" tipoPermiso="eliminar">Si</button></td>';
                        }
                     
                }

                
                
            ?>

          </tbody>

        </table> 

      </div>

    </div>

  </section>

</div>
