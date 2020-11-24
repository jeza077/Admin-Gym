<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mantenimientos</h1>
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


                  <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">

                      <a class="nav-link active" id="datosRoles" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Roles</a>

                    </li>

                   

                    <li class="nav-item" role="presentation">

                      <a class="nav-link" id="datosInsmatri" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Inscripciones y Matriculas</a>

                    </li>

                        

                    <li class="nav-item" role="presentation">

                      <a class="nav-link" id="datosParam" data-toggle="tab" href="#thirty" role="tab" aria-controls="thirty" aria-selected="false">Parametros</a>

                    </li>

                  </ul>

                 <!--========================================================
                              ROL
                    ==========================================================-->  
                  <!-- Tab panes -->
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Rol">
                      <div class="card-header">
                      <button class="btn btn-orange float-center"  data-toggle="modal" data-target="#modalExportar">
                         Exportar PDF      
                        </button>
                        <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoRol">
                          Nuevo rol        
                        </button>
                      </div>

                      <table class="table table-striped table-bordered tablas text-center">
         
                        <thead>
                                
                          <tr>
                                  
                            <th scope="col">#</th>
                                  
                            <th scope="col">Rol</th>
                                  
                            <th scope="col">Descripcion</th>
                                  
                            <th scope="col">Estado</th>

                            <th scope="col">Editar</th>

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
                                    <button class="btn btn-warning"><i class="fas fa-pencil-alt" style="color:#fff" data-toggle="modal" data-target="#modalModificar"></i></button>
                                    </td>

                                    <td>
                                    <button class="btn btn-primary"><i class="fas fa-cog" style="color:#fff" data-toggle="modal" data-target="#modalEditarRol"></i></button>
                                    </td>
                                  </tr>';
                                                    
                              }

                              
                              
                            ?>

                        </tbody>

                      </table> 

                    </div>

                  
                     <!--========================================================
                              INSCRIPCIONES Y MATRICULA
                    ==========================================================-->  
                    <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="Inscripciones  y   Matricula">

                                
                      <div class="form-group">

                      </div>

                      <div class="card-body">

                        <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoRol">
                          Nuevo       
                        </button>

                      </div>

                      <table class="table table-striped table-bordered tablas text-center">
                        
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Matricula</th>
                            <th scope="col">Inscripcion</th>
                            <th scope="col">Descuento</th>
                            <th scope="col">Promocion</th>
                            <th scope="col">Editar</th>
                  
                          </tr>
                        </thead>
                        <tbody>             
                          <tr>
                            <td>01</td>
                            <td>50</td>
                            <td><div class="form-group col-md-9">
                            <label></label>
                            <select class="form-control select2" name="nuevoSexo" style="width: 100%;" required>
                              <option selected="selected">Seleccionar...</option>
                              <option value="M">Mensual</option>
                              <option value="F">Quincenal</option>
                            </select>
                            <td>Tercera</td>
                            <td>Dos por uno</td>
                            <td>
                              <div class="btn-group">
                                <button class="btn btn-warning" style="color:white;"><i class="fas fa-pen"></i></button>
                                      
                                </div>
                                    </td>
                      
                          </tr>
                        </tbody>
                      </table>
                        
                    </div>

                       <!--========================================================
                              Parametros
                       ==========================================================-->  
                    <div class="tab-pane fade" id="thirty" role="tabpanel" aria-labelledby="Parametros">

                                
                      <div class="form-group">
                                <div class="card-header">

                                  <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoParametro">
                                    Nuevo parametro     
                                  </button>

                                </div>

                          <table class="table table-striped table-bordered tablas text-center">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Parametros</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Editar</th>
                              
                              
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                              // $tabla = "tbl_roles";
                              $item = null;
                              $valor = null;
                              
                              $parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
                              // var_dump($rol);

                              foreach ($parametros as $key => $value){
                                echo '
                                <tr>
                                
                                <td>'.($key + 1).'</td>
                                <td>'.$value["parametro"].'</td>
                                <td>'.$value["valor"].'</td>
                                <td>
                                  <button class="btn btn-warning"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>
                                 
                              </tr>
                              ';
                              }

                              
                              
                              ?>

                                         
                            </tbody>
                          </table>

                      </div>
                    </div>

                  </div>

                <!-- </div> -->

              <!-- </div>  -->


            </div>

        </div>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR ROL
======================================-->

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
            <div class="form-group col-md-9">
              <label for="Rol"> Rol</label>
              <input type="text" class="form-control id" name="nuevoRol" value="" required>
            </div>

            <div class="form-group col-md-9">
              <label for="Descripcion">Descripcion</label>
              <input type="textarea" class="form-control nombre" name="nuevaDescripcion" value="" required>
            </div>

            <div class="form-group col-md-9">
              <label>Estado</label>
              <select class="form-control select2" name="nuevoEstado" style="width: 100%;" required>
                <option selected="selected">Seleccionar...</option>
                <option value="1">Activo</option>
                <option value="0">Desactivado</option>
              </select>
            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
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
                                          $tabla = "tbl_roles";
                                          $item = null;
                                          $valor = null;

                                          $roles = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                                          foreach ($roles as $key => $value) {
                                            echo'
                                              <tr>
                                                  <td>'.($key + 1).'</td>';
                                                  if($value["rol"] == 'Default'){
                                                  echo '
                                                  <td><option selected="selected" value="'.$value["id_rol"].'">'.$value["rol"].'</option></td>';
                                                  } else {
                                                  echo '
                                                  <td><option value="'.$value["id_rol"].'">'.$value["rol"].'</option></td>';
                                                  }
                                                  echo '
                                                  <td><div class="form-group">
                                                  <div class="custom-control custom-checkbox">
                                                    <input class="chkAutoriza" type="checkbox" id="chkAutoriza" value="option1">
                                                    <label for="customCheckbox1" >Visualizar</label>
                                                  </div></td>
                                                  <td><div class="custom-control custom-checkbox">
                                                    <input class="chkAutoriza" type="checkbox" id="chkAutoriza" checked="">
                                                    <label for="customCheckbox2">Guardar</label>
                                                  </div></td>
                                                  <td><div class="custom-control custom-checkbox">
                                                    <input class="chkAutoriza" type="checkbox" id="chkAutoriza" checked="">
                                                    <label for="customCheckbox3">Actuzalizar</label>
                                                  </div></td>
                                                  <td><div class="custom-control custom-checkbox">
                                                    <input class="chkAutoriza" type="checkbox" id="chkAutoriza" checked="">
                                                    <label for="customCheckbox4">Eliminar</label>
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

<!--==============================================================================
MODAL Modificar ROL
======================================-->

<div class="modal fade" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog  " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

           <div class="card-body">
              <div class= "form-group col-md-6">
               <label for="rol">Nuevo nombre del rol</label>
               <input type="text" class="form-control mayus" name="editarRol" value=""requiered>
              </div>
              <div class= "form-group col-md-6">
               <label for="Descripcion">Nueva descripcion</label>
               <input type="text" class="form-control mayus" name="editarDescripcion" value=""requiered>
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

          // $crearRol = new ControladorMantenimientos();
          // $crearRol->ctrRolesInsertar();

        ?>




      </form>


    

    </div>

  </div>
        

</div>



