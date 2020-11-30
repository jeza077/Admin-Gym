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
                <?php
                   $descripcionEvento = " Consulto la pantalla de mantenimiento";
                   $accion = "consulta";

                   $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);
    
                ?>


                  <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">

                      <a class="nav-link active" id="datosRoles" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Roles</a>

                    </li>

                   

                    <li class="nav-item" role="presentation">

                      <a class="nav-link" id="datosInsmatri" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Inscripciones</a>

                    </li>

                      <li class="nav-item" role="presentation">

                      <a class="nav-link" id="datosmatricula" data-toggle="tab" href="#fourt" role="tab" aria-controls="fourt" aria-selected="false">Matriculas</a>

                    </li>

                        

                    <li class="nav-item" role="presentation">

                      <a class="nav-link" id="datosParam" data-toggle="tab" href="#thirty" role="tab" aria-controls="thirty" aria-selected="false">Parametros</a>

                    </li>

                    <li class="nav-item" role="presentation">

                      <a class="nav-link" id="datosdescuento" data-toggle="tab" href="#fithy" role="tab" aria-controls="fithy" aria-selected="false">Descuento</a>

                    </li>


                  </ul>

                 <!--========================================================
                              ROL
                    ==========================================================-->  
                  <!-- Tab panes -->
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Rol">
                      <div class="card-header">
                      <!-- <button class="btn btn-orange float-center"  data-toggle="modal" data-target="#modalExportar">
                         Exportar PDF      
                        </button> -->
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
                                    </td>
                                  </tr>';
                                                    
                              }

                              
                              
                            ?>

                        </tbody>

                      </table> 

                    </div>

                  
                     <!--========================================================
                              INSCRIPCIONES 
                    ==========================================================-->  
                    <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="Inscripciones">

                                
                      <div class="form-group">

                      </div>

                      <div class="card-body">

                        <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevainscripcion">
                          Nuevo       
                        </button>

                      </div>

                      <table class="table table-striped table-bordered tablas text-center">
                        
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo de inscripcion</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Estado</th>
                          </tr>
                        </thead>
                        <tbody>             
                          <?php
                                // $tabla = "tbl_inscripcion";
                                $item = null;
                                $valor = null;
                                
                                $inscripcion = ControladorMantenimientos:: ctrMostrarInscripcion($item,$valor);
                                // var_dump($inscripcion);

                                foreach ($inscripcion as $key => $value){
                                  echo '
                                    <tr>
                                  
                                      <td>'.($key + 1).'</td>
                                      <td>'.$value["tipo_inscripcion"].'</td>
                                      <td>'.$value["precio_inscripcion"].'</td>';
                                      if($value['estado'] != 0){
                                        echo '<td><button class="btn btn-success btn-md btnActivar" idInscripcion="'.$value["id_inscripcion"].'" estadoInscripcion="0">Activado</button></td>';
                                      }else{
                                        echo '<td><button class="btn btn-danger btn-md btnActivar" idInscripcion="'.$value["id_inscripcion"].'" estadoInscripcion="1">Desactivado</button></td>';
                                      } 
                                      echo' 
                                    </tr> ';
                                }       
                          ?>     
                        </tbody>
                      </table>
                        
                    </div>


                     <!--========================================================
                               MATRICULA
                    ==========================================================-->  
                    <div class="tab-pane fade" id="fourt" role="tabpanel" aria-labelledby=" Matricula">

                                
                      <div class="form-group">

                      </div>

                      <div class="card-body">

                        <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevaMatricula">
                          Nuevo       
                        </button>

                      </div>

                      <table class="table table-striped table-bordered tablas text-center">
                        
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo de matricula</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Estado</th>
                          </tr>
                        </thead>
                        <tbody>  
                            <?php
                                    // $tabla = "tbl_matricula";
                                    $item = null;
                                    $valor = null;
                                    
                                    $matricula = ControladorMantenimientos::ctrMostrarMatricula($item,$valor);
                                    // var_dump($rol);

                                    foreach ($matricula as $key => $value){
                                      echo '
                                        <tr>
                                      
                                          <td>'.($key + 1).'</td>
                                          <td>'.$value["tipo_matricula"].'</td>
                                          <td>'.$value["precio_matricula"].'</td>
                                          </tr>';
                                          if($value['estado'] != 0){
                                            echo '<td><button class="btn btn-success btn-md btnActivar" idMatricula="'.$value["id_Matricula"].'" estadoMatricula="0">Activado</button></td>';
                                          }else{
                                            echo '<td><button class="btn btn-danger btn-md btnActivar" idMatricula="'.$value["id_Matricula"].'" estadoMatricula="1">Desactivado</button></td>';
                                          } 
                                          echo'
                                        </tr> ';
                                          
                                          
                                    }       
                              ?>                
                         
                        </tbody>
                      </table>
                        
                    </div>











                     <!--========================================================
                           DESCUENTO
                    ==========================================================-->  
                    <div class="tab-pane fade" id="fithy" role="tabpanel" aria-labelledby=" Descuento">

                                
                      <div class="form-group">

                      </div>

                      <div class="card-body">

                        <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoDescuento">
                          Nuevo       
                        </button>

                      </div>

                      <table class="table table-striped table-bordered tablas text-center">
                        
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo descuento</th>
                            <th scope="col">Precio</th>
                          </tr>
                        </thead>
                        <tbody>  
                            <?php
                                    // $tabla = "tbl_descuento";
                                    $item = null;
                                    $valor = null;
                                    
                                    $matricula = ControladorMantenimientos::ctrMostrarDescuento($item,$valor);
                                    // var_dump($rol);

                                    foreach ($matricula as $key => $value){
                                      echo '
                                        <tr>
                                      
                                          <td>'.($key + 1).'</td>
                                          <td>'.$value["tipo_descuento"].'</td>
                                          <td>'.$value["valor_descuento"].'</td>
                                          </tr>';
                                        }       
                              ?>                
                         
                        </tbody>
                      </table>
                        
                    </div>

                       <!--========================================================
                              Parametros
                       ==========================================================-->  
                    <div class="tab-pane fade" id="thirty" role="tabpanel" aria-labelledby="Parametros">

                                
                      <div class="form-group">
                                <div class="card-header">
                                  <!-- 
                                  <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoParametro">
                                    Nuevo parametro     
                                  </button> -->

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
                               //var_dump($parametros);

                              foreach ($parametros as $key => $value){
                                echo '
                                <tr>
                                
                                <td>'.($key + 1).'</td>
                                <td>'.$value["parametro"].'</td>
                                <td>'.$value["valor"].'</td>
                                <td>
                                  <div class="btn-group">
                                    <button class="btn btn-warning  btnEditarParametro" idParametro="'.$value["id_parametro"].'" ><i class="fas fa-pencil-alt" style="color:#fff" data-toggle="modal" data-target="#modalParametros"></i></button>
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
            <div class="form-group col-md-12">
              <label for="Rol"> Rol</label>
              <input type="text" class="form-control id" name="nuevoRol" value="" required>
            </div>

            <div class="form-group col-md-12">
              <label for="Descripcion">Descripcion</label>
              <input type="textarea" class="form-control nombre" name="nuevaDescripcion" value="" required>
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
               <input type="text" class="form-control mayus" id="editarRol" name="editarRol" value=""requiered>
              </div>
              <div class= "form-group col-md-12">
               <label for="Descripcion">Descripción</label>
               <input type="text" class="form-control mayus" id="editarDescripcionRol" name="editarDescripcionRol" value=""requiered>
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



<!--=======================================================
MODIFIRCAR PARAMETROS
=========================================================-->
<div class="modal fade" id="modalParametros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog  " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Parametro</h5>
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
               <label for="parametro">Parametro</label>
               <input type="text" class="form-control mayus" id="editarParametro" name="editarParametro" value="" readonly >
              </div>
          
           

              <div class= "form-group col-md-12">
               <label for="Valor">Valor</label>
               <input type="text" class="form-control mayus" id="editarValorParametro" name="editarValorParametro" placeholder="Escriba el nuevo valor del parametro"requiered>
              </div>

              <input type="hidden" id="editarIdParametro" name="editarIdParametro">
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

          $EditarParametro = new ControladorGlobales();
          $EditarParametro->ctrEditarParametro();

        ?>




      </form>


    

    </div>

  </div>
        

</div>



<!--=====================================
MODAL AGREGAR NUEVA INSCRIPCION
======================================-->

<div class="modal fade" id="modalNuevainscripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nueva Inscripcion</h5>
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
              <label for="Rol">Inscripcion</label>
              <input type="text" class="form-control nombre" name="nuevoInscripcion" value="" required>
            </div>

            <div class="form-group col-md-12">
              <label for="Descripcion">Precio</label>
              <input type="text" class="form-control id" name="nuevoPrecio" value="" required>
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

          $crearInscripcion = new ControladorMantenimientos();
          $crearInscripcion -> ctrInscripcionInsertar();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<!--=====================================
MODAL AGREGAR NUEVA MATRICULA
======================================-->

<div class="modal fade" id="modalNuevaMatricula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nueva Matricula</h5>
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
              <label for="Rol">Matricula</label>
              <input type="text" class="form-control nombre" name="nuevoMatricula" value="" required>
            </div>

            <div class="form-group col-md-12">
              <label for="Descripcion">Precio</label>
              <input type="textarea" class="form-control id" name="nuevoPrecio" value="" required>
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

          $crearMatricula = new ControladorMantenimientos();
          $crearMatricula-> ctrMatriculaInsertar();

        ?>




      </form>

    

    </div>

  </div>
        

</div>



<!--=====================================
MODAL AGREGAR NUEVA MATRICULA
======================================-->

<div class="modal fade" id="modalNuevoDescuento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nueva Descuento</h5>
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
              <label for="Rol">Descuento</label>
              <input type="text" class="form-control nombre" name="nuevoDescuento" value="" required>
            </div>

            <div class="form-group col-md-12">
              <label for="Descripcion">Valor</label>
              <input type="textarea" class="form-control id" name="nuevoValor" value="" required>
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

           $crearDescuento = new ControladorMantenimientos();
           $crearDescuento-> ctrDescuentoInsertar();

        ?>




      </form>

    

    </div>

  </div>
        

</div>






