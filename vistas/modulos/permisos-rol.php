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
              <button class="btn btn-danger float-right mr-3"  data-toggle="modal" data-target="#modalExportar">
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
                $item = null;
                $valor = null;
                
                $permisosRol = ControladorMantenimientos::ctrMostrarPermisosRoles($item,$valor);
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
                            echo' <td><button class="btn btn-danger btn-md">No</button></td>';                           
                        
                        } else {
 
                            echo' <td><button class="btn btn-success btn-md">Si</button></td>';                    
                        }

                        if($value["agregar"] == null){
                            echo' <td>**No tiene permiso aun**</td>';                           
                        
                        }else if($value["agregar"] == 0){
                            echo' <td><button class="btn btn-danger btn-md">No</button></td>';                           
                        
                        } else {
                            echo' <td><button class="btn btn-success btn-md">Si</button></td>';

                        }

                        if($value["actualizar"] == null){
                            echo' <td>**No tiene permiso aun**</td>';                           
                        
                        }else if($value["actualizar"] == 0){
                            echo' <td><button class="btn btn-danger btn-md">No</button></td>';                           
                        
                        } else {
                            echo' <td><button class="btn btn-success btn-md">Si</button></td>';

                        }

                        if($value["eliminar"] == null){
                            echo' <td>**No tiene permiso aun**</td>';                           
                        
                        }else if($value["eliminar"] == 0){
                            echo' <td><button class="btn btn-danger btn-md">No</button></td>';                           
                        
                        } else {
                            echo' <td><button class="btn btn-success btn-md">Si</button></td>';
                        }
                     
                }

                
                
            ?>

          </tbody>

        </table> 

      </div>

    </div>

  </section>

</div>


<!--=======================================================================
                  MODAL AGREGAR ROL
=========================================================================-->

<div class="modal fade" id="modalNuevoRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo rol</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="form-group col-md-12">
              <label for="Rol"> Rol</label>
              <input type="text" class="form-control nombre mayus" name="nuevoRol" value="" required>
            </div>

            <div class="form-group col-md-12">
              <label for="Descripcion">Descripcion</label>
              <input type="textarea" class="form-control nombre mayus" name="nuevaDescripcionRol" value="" required>
            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btnGuardarRol">Guardar</button>
          <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
          
        </div>

        <?php

          // $crearRol = new ControladorMantenimientos();
          // $crearRol -> ctrRolesInsertar();

        ?>




      </form>

    

    </div>

  </div>
        

</div>



<!--==============================================================================
                     MODAL PERMISOS ROL
==============================================================-->

<div class="modal fade" id="modalEditarPermisos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog modal-lg  " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar permiso para pantallas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
            
          <table class="table table-striped table-bordered text-center">
            
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Pantallas</th>
                <th scope="col">Visualizar</th>
                <th scope="col">Guardar</th>
                <th scope="col">Actualizar</th>
                <th scope="col">Eliminar</th>
      
              </tr>
            </thead>
            <tbody>  
              <?php
                $tabla = "tbl_objetos";
                $item = null;
                $valor = null;

                $roles = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                // echo '<pre>';
                // var_dump($roles);
                // echo '</pre>';

                // foreach ($roles as $key => $value) {
                
                //   echo'
                //     <tr>
                //         <td>'.($key + 1).'</td>';
                //         if($value["objeto"] == 'Default'){
                //         echo '
                //         <td><option selected="selected" value="'.$value["id_objeto"].'">'.$value["objeto"].'</option></td>';
                //         } else {
                //         echo '
                //         <td><option value="'.$value["id_objeto"].'">'.$value["objeto"].'</option></td>';
                //         }
                //         echo '
                //         <td><div class="form-group">
                //         <div class="custom-control custom-checkbox">
                //           <input class="chkAutoriza" type="checkbox" id="chkAutoriza" value="option1">
                //           <label for="customCheckbox1" ></label>
                //         </div></td>
                //         <td><div class="custom-control custom-checkbox">
                //           <input class="chkAutoriza" type="checkbox" id="chkAutoriza" checked="">
                //           <label for="customCheckbox2"></label>
                //         </div></td>
                //         <td><div class="custom-control custom-checkbox">
                //           <input class="chkAutoriza" type="checkbox" id="chkAutoriza" checked="">
                //           <label for="customCheckbox3"></label>
                //         </div></td>
                //         <td><div class="custom-control custom-checkbox">
                //           <input class="chkAutoriza" type="checkbox" id="chkAutoriza" checked="">
                //           <label for="customCheckbox4"></label>
                //         </div></td>
                //       </tr>';

                // }   
              ?>            
                          
            </tbody>
            
          </table>
      
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
           <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
        </div>

        <?php

          // $crearRol = new ControladorMantenimientos();
          // $crearRol->ctrRolesInsertar();

        ?>




      </form>


    

    </div>

  </div>
        

</div>
