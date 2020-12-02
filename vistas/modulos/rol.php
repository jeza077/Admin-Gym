<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Roles</h1>
          </div>
          <div class="col-sm-6">
       
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>  

  <section class="content">

    <div class="card">

      <div class="card-body">

        <div class="row">

            <div class=" col-sm-12">

              <!-- <div class="card"> -->

                <!-- <div class="card-body"> -->
                <?php
                   $descripcionEvento = " Consulto la pantalla de mantenimiento";
                   $accion = "consulta";

                   $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);
    
                ?>

                 <!--========================================================
                              ROL
                    ==========================================================-->   
                    <div class="card-header">
                      <!-- <button class="btn btn-orange float-center"  data-toggle="modal" data-target="#modalExportar">
                         Exportar PDF      
                        </button> -->
                                <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoRol">
                                   Nuevo rol        
                                </button>
                      

                        <table class="table table-striped table-bordered tablas text-center">
         
                            <thead>
                                            
                                    <tr>
                                            
                                        <th scope="col">#</th>   
                                        <th scope="col">Rol</th> 
                                        <th scope="col">Descripcion</th>  
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>

                                    
                    
                                    </tr>

                                    </thead>

                                    <tbody>

                                    <?php
                                        // $tabla = "tbl_roles";
                                        $item = null;
                                        $valor = null;
                                        
                                        $rol = ControladorMantenimientos::ctrMostrarRoles($item,$valor);
                                        // var_dump($rol);

                                        foreach ($rol as $key => $value){
                                            echo '
                                            <tr>
                                            
                                                <td>'.($key + 1).'</td>
                                                <td>'.$value["rol"].'</td>
                                                <td>'.$value["descripcion"].'</td>';
                                            
                                            
                                                if($value["estado"] != 0){
                                                echo' <td><button class="btn btn-success btn-md btnActivar" idRol="'.$value["id_rol"].'" estadoRol="0" >Activado</button></td>';
                                                
                                                }else{
                                                echo' <td><button class="btn btn-danger btn-md btnActivar" idRol="'.$value["id_rol"].'" estadoRol="1" >Desactivado</button></td>';
                                                
                                                }
                                                echo'
                                                <td>
                                                <button class="btn btn-warning btnEditarRol" editarIdRol="'.$value["id_rol"].'"><i class="fas fa-pencil-alt" style="color:#fff" data-toggle="modal" data-target="#modalModificar"></i></button>
                                                <button class="btn btn-primary"><i class="fas fa-cog" style="color:#fff" data-toggle="modal" data-target="#modalEditarRol"></i></button>
                                                <button class="btn btn-danger btnEliminarUsuario"><i class="fas fa-trash-alt"></i></button>
                                                </td>

                                             </tr>';
                                                                
                                        }

                                        
                                        
                                    ?>

                            </tbody>

                        </table> 

                    </div>

            </div>

        </div>

      </div>

    </div>

  </section>

</div>


<!--==============================================================================
MODAL EDITAR ROL
==================================================================================-->

<div class="modal fade" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog  " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar  rol</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

           <div class="card-body">
              <div class= "form-group col-md-12">
               <label for="rol">Rol</label>
               <input type="text" class="form-control  nombre mayus" id="editarRol" name="editarRol" value=""requiered>
              </div>
              <div class= "form-group col-md-12">
               <label for="Descripcion">Descripción</label>
               <input type="text" class="form-control nombre mayus" id="editarDescripcionRol" name="editarDescripcionRol" value=""requiered>
              </div>
              <input type="hidden" id="editarIdRol" name="editarIdRol">
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
           <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
        </div>

        <?php

          $EditarRol = new ControladorGlobales();
          $EditarRol->ctrEditarRol();

        ?>




      </form>


    

    </div>

  </div>
        

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
          <div class="card-body">
            <div class="form-group col-md-12">
              <label for="Rol"> Rol</label>
              <input type="text" class="form-control nombre mayus" name="nuevoRol" value="" required>
            </div>

            <div class="form-group col-md-12">
              <label for="Descripcion">Descripcion</label>
              <input type="textarea" class="form-control nombre mayus" name="nuevaDescripcion" value="" required>
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
          
        </div>

        <?php

          $crearRol = new ControladorMantenimientos();
          $crearRol -> ctrRolesInsertar();

        ?>




      </form>

    

    </div>

  </div>
        

</div>

<!--==============================================================================
           MODAL PERMISOS ROL
======================================-->

<div class="modal fade" id="modalEditarRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
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

          <div class="card-body">
            
                      <table class="table table-striped table-bordered tablas text-center">
                        
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
                       

                                          foreach ($roles as $key => $value) {
                                          
                                            echo'
                                              <tr>
                                                  <td>'.($key + 1).'</td>';
                                                  if($value["objeto"] == 'Default'){
                                                  echo '
                                                  <td><option selected="selected" value="'.$value["id_objeto"].'">'.$value["objeto"].'</option></td>';
                                                  } else {
                                                  echo '
                                                  <td><option value="'.$value["id_objeto"].'">'.$value["objeto"].'</option></td>';
                                                  }
                                                  echo '
                                                  <td><div class="form-group">
                                                  <div class="custom-control custom-checkbox">
                                                    <input class="chkAutoriza" type="checkbox" id="chkAutoriza" value="option1">
                                                    <label for="customCheckbox1" ></label>
                                                  </div></td>
                                                  <td><div class="custom-control custom-checkbox">
                                                    <input class="chkAutoriza" type="checkbox" id="chkAutoriza" checked="">
                                                    <label for="customCheckbox2"></label>
                                                  </div></td>
                                                  <td><div class="custom-control custom-checkbox">
                                                    <input class="chkAutoriza" type="checkbox" id="chkAutoriza" checked="">
                                                    <label for="customCheckbox3"></label>
                                                  </div></td>
                                                  <td><div class="custom-control custom-checkbox">
                                                    <input class="chkAutoriza" type="checkbox" id="chkAutoriza" checked="">
                                                    <label for="customCheckbox4"></label>
                                                  </div></td>
                                               </tr>';

                                          }   
                          ?>            
                                     
                        </tbody>
                        
                      </table>
          

          
          </div>

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
