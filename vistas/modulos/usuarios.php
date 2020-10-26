
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
          <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalAgregarUsuario">
            Agregar Usuario          
          </button>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  

 <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <!-- <div class="card-header">
          <button class="btn btn-orange float-right">Agregar Usuario</button>
        </div> -->
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered table-striped tablas text-center">

            <thead>
              <tr>
                <th width="15px">#</th>
                <th>Nombre</th>
                <th width="100px">Usuario</th>
                <th width="100px">Foto</th>
                <th width="100px">Estado</th>
                <th width="100px">Acciones</th>
              </tr>
            </thead>

            <tbody>
            <?php 
              $tabla = "tbl_usuarios";
              $item = null;
              $valor = null;
              $usuarios = ControladorUsuarios::ctrMostrarUsuarios($tabla, $item, $valor);

              var_dump($usuarios);

              foreach ($usuarios as $key => $value) {
                echo '
                    <tr>
                      <td>'.$key.'</td>
                      <td>'.$value["nombre"].'</td>
                      <td>'.$value["usuario"].'</td>';

                      if($value['foto'] != ""){
                        echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                      } else {
                        echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                      }
                      
                      echo '
                      <td><button class="btn btn-success btn-md">Activo</button></td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning" style="color:white;"><i class="fas fa-pen"></i></button>
                          <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                    </tr>
                ';
              }
            ?>
              <!-- <tr>
                <td>01</td>
                <td>Jesús Zuniga</td>
                <td>JEZA</td>
                <td>foto.jpg</td>
                <td><button class="btn btn-success btn-md">Activo</button></td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning" style="color:white;"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </td>
              </tr> -->
            </tbody>
            
          </table>
          
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- =======================================
           MODAL AGREGAR USUARIO
  ======================================----->

  <div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" class="formulario" enctype="multipart/form-data">
            <!-- <div class="card">
              <div class="card-body"> -->
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="">Tipo de documento <?php echo $i?></label>
                    <select class="form-control select2" name="nuevoTipoDocumento">
                        <option selected="selected">Seleccionar...</option>
                        <?php 
                            $tabla = "tbl_documento";
                            $item = null;
                            $valor = null;

                            $preguntas = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                            foreach ($preguntas as $key => $value) { ?>
                                <option value="<?php echo $value['id_documento']?>"><?php echo $value['tipo_documento']?></option>        
                            <?php 
                            }
                        ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="identidad">Identidad</label>
                    <input type="text" class="form-control" name="nuevoNumeroDocumento" placeholder="Ingrese Identidad" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingrese Nombre" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" name="nuevoApellido" placeholder="Ingrese Apellidos" required>
                  </div>
                </div>
    
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control email" id="inputEmail4" name="nuevoEmail" placeholder="Ingrese Email" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Teléfono</label>
                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  name="nuevoTelefono" placeholder="Ingrese Telefono" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Fecha de nacimiento</label>
                      <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask  name="nuevaFechaNacimiento" placeholder="Ingrese Fecha de Nacimiento" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-9">
                    <label for="inputAddress">Dirección</label>
                    <input type="text" class="form-control" id="inputAddress" name="nuevaDireccion" placeholder="Col. Alameda, calle #2..." required>
                  </div>
                
                  <div class="form-group col-md-3">
                    <label>Sexo</label>
                    <select class="form-control select2" name="nuevoSexo" style="width: 100%;" required>
                      <option selected="selected">Seleccionar...</option>
                      <option value="M">Masculino</option>
                      <option value="F">Femenino</option>
                    </select>
                  </div>
                  <!-- <div class="form-group col-md-4">
                    <label>Tipo de persona</label>
                    <select class="form-control select2" style="width: 100%;" id="tipoPersona" name="nuevoTipoPersona" required>
                      <option selected="selected">Seleccionar...</option>
                      <option value="empleado">Empleado</option>
                      <option value="cliente">Cliente</option>
                    </select>
                  </div> -->
                </div>

              <!-- </div>
            </div> -->

            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="">Usuario</label>
                <input type="text" class="form-control nuevoUsuario" onKeyUp="this.value=this.value.toUpperCase();" name="nuevoUsuario" placeholder="Ingrese Usuario">
              </div>
              <div class="form-group col-md-3">
                <label>Rol</label>
                <select class="form-control select2" style="width: 100%;" name="nuevoRol">
                  <!-- <option value="2">Default</option> -->
                    <?php 
                        $tabla = "tbl_roles";
                        $item = null;
                        $valor = null;

                        $roles = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                        foreach ($roles as $key => $value) {
                          if($value["rol"] == 'Default'){
                            echo '<option selected="selected" value="'.$value["id_rol"].'">'.$value["rol"].'</option>';
                          } else {
                            echo '<option value="'.$value["id_rol"].'">'.$value["rol"].'</option>';
                          }
                        }
                    ?>
                </select>
              </div>

              <div class="form-group col-md-3">
                <label for="inputPassword4">Contraseña Generada</label>
                <input type="text" class="form-control passwordGenerado" id="inputPassword4" name="nuevoPassword" disabled>
              </div>
              <div class="col-md-3">
                <a href="javascript:void(0);"  class="btn btn-block btn-orange" id="generarPassword" style="margin-top:2em">Generar contraseña</a>
              </div>
            </div>

            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="exampleInputFile">Foto</label>
                <div class="input-group">
                <img class="img-thumbnail previsualizar mr-2" src="vistas/img/usuarios/default/anonymous.png" alt="imagen-del-usuario" width="100px">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input nuevaFoto" id="exampleInputFile" name="nuevaFoto">
                    <label class="custom-file-label" for="exampleInputFile">Escoger foto</label>
                  </div>

                </div>
                    <p class="p-foto help-block ml-4">Peso máximo de la foto 2 MB</p>
              </div>
              <div class="form-group col-md-3">
                <label>Estado</label>
                <input type="text" class="form-control" value="Desactivado" style="color:red;" disabled>
              </div>

              <div class="form-group col-md-3">
                <?php 
                  $itemParam = 'parametro';
                  $valorParam = 'ADMIN_DIAS_VIGENCIA';
                  $parametros = ControladorUsuarios::ctrMostrarParametros($itemParam, $valorParam);
              
                  $vigenciaUsuario = $parametros['valor'];
        
                  date_default_timezone_set("America/Tegucigalpa");
                  $fechaVencimiento = date("Y-m-d", strtotime('+'.$vigenciaUsuario.' days'));
                ?>
                <label>Fecha de vencimiento</label>
                <input type="text" class="form-control" value="<?php echo $fechaVencimiento?>" disabled>
              </div>
            </div>
            
     

            <div class="modal-footer">
            <!-- <div class="form-group mt-4 float-right"> -->
              <button type="" class="btn btn-primary" data-toggle="modal" data-target="#modalAddUsuario">Guardar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
            </div>
            
        <?php
          $tipoPersona = 'usuarios';
          $pantalla = 'usuarios';
          $ingresarPersona = new ControladorPersonas();
          $ingresarPersona->ctrCrearPersona($tipoPersona, $pantalla);
        ?>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- =======================================
           MODAL EDITAR USUARIO
  ======================================----->

  <div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" class="formulario" enctype="multipart/form-data">
            <!-- <div class="card">
              <div class="card-body"> -->
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="">Tipo de documento <?php echo $i?></label>
                    <select class="form-control select2" name="nuevoTipoDocumento">
                        <option selected="selected">Seleccionar...</option>
                        <?php 
                            $tabla = "tbl_documento";
                            $item = null;
                            $valor = null;

                            $preguntas = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                            foreach ($preguntas as $key => $value) { ?>
                                <option value="<?php echo $value['id_documento']?>"><?php echo $value['tipo_documento']?></option>        
                            <?php 
                            }
                        ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="identidad">Identidad</label>
                    <input type="text" class="form-control" name="nuevoNumeroDocumento" placeholder="Ingrese Identidad" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingrese Nombre" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" name="nuevoApellido" placeholder="Ingrese Apellidos" required>
                  </div>
                </div>
    
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control email" id="inputEmail4" name="nuevoEmail" placeholder="Ingrese Email" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Teléfono</label>
                    <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  name="nuevoTelefono" placeholder="Ingrese Telefono" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Fecha de nacimiento</label>
                      <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask  name="nuevaFechaNacimiento" placeholder="Ingrese Fecha de Nacimiento" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-9">
                    <label for="inputAddress">Dirección</label>
                    <input type="text" class="form-control" id="inputAddress" name="nuevaDireccion" placeholder="Col. Alameda, calle #2..." required>
                  </div>
                
                  <div class="form-group col-md-3">
                    <label>Sexo</label>
                    <select class="form-control select2" name="nuevoSexo" style="width: 100%;" required>
                      <option selected="selected">Seleccionar...</option>
                      <option value="M">Masculino</option>
                      <option value="F">Femenino</option>
                    </select>
                  </div>
                  <!-- <div class="form-group col-md-4">
                    <label>Tipo de persona</label>
                    <select class="form-control select2" style="width: 100%;" id="tipoPersona" name="nuevoTipoPersona" required>
                      <option selected="selected">Seleccionar...</option>
                      <option value="empleado">Empleado</option>
                      <option value="cliente">Cliente</option>
                    </select>
                  </div> -->
                </div>

              <!-- </div>
            </div> -->

            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="">Usuario</label>
                <input type="text" class="form-control nuevoUsuario" onKeyUp="this.value=this.value.toUpperCase();" name="nuevoUsuario" placeholder="Ingrese Usuario">
              </div>
              <div class="form-group col-md-3">
                <label>Rol</label>
                <select class="form-control select2" style="width: 100%;" name="nuevoRol">
                  <!-- <option value="2">Default</option> -->
                    <?php 
                        $tabla = "tbl_roles";
                        $item = null;
                        $valor = null;

                        $roles = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                        foreach ($roles as $key => $value) {
                          if($value["rol"] == 'Default'){
                            echo '<option selected="selected" value="'.$value["id_rol"].'">'.$value["rol"].'</option>';
                          } else {
                            echo '<option value="'.$value["id_rol"].'">'.$value["rol"].'</option>';
                          }
                        }
                    ?>
                </select>
              </div>

              <div class="form-group col-md-3">
                <label for="inputPassword4">Contraseña Generada</label>
                <input type="text" class="form-control passwordGenerado" id="inputPassword4" name="nuevoPassword" disabled>
              </div>
              <div class="col-md-3">
                <a href="javascript:void(0);"  class="btn btn-block btn-orange" id="generarPassword" style="margin-top:2em">Generar contraseña</a>
              </div>
            </div>

            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="exampleInputFile">Foto</label>
                <div class="input-group">
                <img class="img-thumbnail previsualizar mr-2" src="vistas/img/usuarios/default/anonymous.png" alt="imagen-del-usuario" width="100px">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input nuevaFoto" id="exampleInputFile" name="nuevaFoto">
                    <label class="custom-file-label" for="exampleInputFile">Escoger foto</label>
                  </div>

                </div>
                    <p class="p-foto help-block ml-4">Peso máximo de la foto 2 MB</p>
              </div>
              <div class="form-group col-md-3">
                <label>Estado</label>
                <input type="text" class="form-control" value="Desactivado" style="color:red;" disabled>
              </div>

              <div class="form-group col-md-3">
                <?php 
                  $itemParam = 'parametro';
                  $valorParam = 'ADMIN_DIAS_VIGENCIA';
                  $parametros = ControladorUsuarios::ctrMostrarParametros($itemParam, $valorParam);
              
                  $vigenciaUsuario = $parametros['valor'];
        
                  date_default_timezone_set("America/Tegucigalpa");
                  $fechaVencimiento = date("Y-m-d", strtotime('+'.$vigenciaUsuario.' days'));
                ?>
                <label>Fecha de vencimiento</label>
                <input type="text" class="form-control" value="<?php echo $fechaVencimiento?>" disabled>
              </div>
            </div>
            
     

            <div class="modal-footer">
            <!-- <div class="form-group mt-4 float-right"> -->
              <button type="" class="btn btn-primary" data-toggle="modal" data-target="#modalAddUsuario">Guardar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
            </div>
            
        <?php
          $tipoPersona = 'usuarios';
          $pantalla = 'usuarios';
          $ingresarPersona = new ControladorPersonas();
          $ingresarPersona->ctrCrearPersona($tipoPersona, $pantalla);
        ?>
          </form>
        </div>

      </div>
    </div>
  </div>
    


