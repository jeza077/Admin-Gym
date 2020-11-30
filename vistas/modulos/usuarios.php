<?php

    $permisoAgregar = $_SESSION['permisos']['Usuarios']['agregar'];
    $permisoEliminar = $_SESSION['permisos']['Usuarios']['eliminar'];
    $permisoActualizar = $_SESSION['permisos']['Usuarios']['actualizar'];
    $permisoConsulta = $_SESSION['permisos']['Usuarios']['consulta'];

    // echo "<pre>";
    // var_dump($_SESSION['permisos']);
    // echo "</pre>";

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
         
          <div class="col-sm-6">
          <?php if($permisoAgregar == 1){ ?>
            <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalAgregarUsuario">
              Agregar Usuario          
            </button>
          <?php } ?>
            <button class="btn btn-danger btnExportarUsuarios float-right mr-3">
              Exportar PDF          
            </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  

 <!-- Main content -->
    <section class="content">

                      <?php
                        $descripcionEvento = " Consulto la pantalla de Usuario";
                        $accion = "consulta";

                        $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 2,$accion, $descripcionEvento);
    
                      ?>
                   

        <div class="card">

          <div class="card-body">
          
            <table class="table table-hover tablas text-center">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Foto</th>
                  <th scope="col">Rol</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $tabla = "tbl_usuarios";
                $item = null;
                $valor = null;
                $usuarios = ControladorUsuarios::ctrMostrarSoloUsuarios($tabla, $item, $valor);

                // echo "<pre>";
                // var_dump($usuarios);
                // echo "</pre>";

                foreach ($usuarios as $key => $value) {
                  echo '
                        <tr>
                        <td scope="row">'.($key+1).'</td>
                        <td>'.$value["nombre"] .' '.$value["apellidos"].'</td>
                        <td>'.$value["usuario"].'</td>';

                        if($value["foto"] != ""){
                          echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                        } else {
                          echo '<td><img src="vistas/img/usuarios/default/default2.jpg" class="img-thumbnail" width="40px"></td>';
                        }

                    echo '<td>'.$value["rol"].'</td>';

                        if($value['estado'] != 0){
                          echo '<td><button class="btn btn-success btn-md btnActivar" idUsuario="'.$value["id_usuario"].'" estadoUsuario="0">Activado</button></td>';
                        } else {
                          echo '<td><button class="btn btn-danger btn-md btnActivar" idUsuario="'.$value["id_usuario"].'" estadoUsuario="1">Desactivado</button></td>';
                        }
                        
                    
                    echo '<td>
                            <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id_personas"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>
                            <button class="btn btn-danger btnEliminarUsuario" idPersona="'.$value["id_personas"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fas fa-trash-alt"></i></button>
                          </td>
                        </tr>
                  ';
                }
              ?>
            

              
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
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="datosPersona" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos personales</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="datosUsuario" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Datos Usuario</a>
              </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="datosPersona">
                <div class="container-fluid mt-4">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="">Tipo de documento <?php echo $i?></label>
                      <select class="form-control select2 tipoDocumento" name="nuevoTipoDocumento">
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
                      <label for="identidad">Numero de documento</label>
                      <input type="text" class="form-control numeroDocumento" name="nuevoNumeroDocumento" placeholder="Ingrese Identidad" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control nombre mayus" name="nuevoNombre" placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="apellido">Apellido</label>
                      <input type="text" class="form-control apellidos mayus" name="nuevoApellido" placeholder="Ingrese Apellidos" required>
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
                      <input type="text" class="form-control mayus" id="inputAddress" name="nuevaDireccion" placeholder="Col. Alameda, calle #2..." required>
                    </div>
                  
                    <div class="form-group col-md-3">
                      <label>Sexo</label>
                      <select class="form-control select2" name="nuevoSexo" style="width: 100%;" required>
                        <option selected="selected">Seleccionar...</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                    </div>
                
                  </div>
                </div>
              </div>
                  <!-- 2tab --> 
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="datosUsuario">
                <div class="container-fluid mt-4">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="">Usuario</label>
                      <input type="text" class="form-control mayus nuevoUsuario" name="nuevoUsuario" placeholder="Ingrese Usuario">
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
                      <input type="text" class="form-control passwordGenerado" id="inputPassword4" name="nuevoPassword">
                    </div>
                    <div class="col-md-3">
                      <a href="javascript:void(0);"  class="btn btn-block btn-orange generarPassword" style="margin-top:2em">Generar contraseña</a>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="exampleInputFile">Foto</label>
                      <div class="input-group">
                        <img class="img-thumbnail previsualizar mr-2" src="vistas/img/usuarios/default/default2.jpg" alt="imagen-del-usuario" width="100px">
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
                </div>
            
                <!-- <div class="modal-footer"> -->
                <div class="form-group final mt-4 float-right">
                  <button type="" class="btn btn-primary">Guardar</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>
            
                <?php
                  $tipoPersona = 'usuarios';
                  $pantalla = 'usuarios';
                  $ingresarPersona = new ControladorPersonas();
                  $ingresarPersona->ctrCrearPersona($tipoPersona, $pantalla);
                ?>
              </div>
            </div>

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
          <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form role="form" method="post" class="formulario" enctype="multipart/form-data">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="editarPersona" data-toggle="tab" href="#personas" role="tab" aria-controls="personas" aria-selected="true">Datos personales</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="editarUsuario" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="false">Datos Usuario</a>
              </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="personas" role="tabpanel" aria-labelledby="editarPersona">
                <div class="container-fluid mt-4">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="">Tipo de documento <?php echo $i?></label>
                      <select class="form-control select2 tipoDocumento" name="editarTipoDocumento">
                          <option value="" id="editarTipoDocumento"></option>
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
                      <label for="identidad">Numero de documento</label>
                      <input type="text" class="form-control numeroDocumento" name="editarNumeroDocumento" value="" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control nombre mayus" name="editarNombre" value="" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="apellido">Apellido</label>
                      <input type="text" class="form-control apellidos mayus" name="editarApellido" value="" required>
                    </div>
                  </div>
      
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="inputEmail">Email</label>
                      <input type="email" class="form-control email" id="inputEmail" name="editarEmail" value="" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Teléfono</label>
                      <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  name="editarTelefono" value="ono" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Fecha de nacimiento</label>
                        <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask  name="editarFechaNacimiento" value="" required>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-9">
                      <label for="direccion">Dirección</label>
                      <input type="text" class="form-control mayus" id="direccion" name="editarDireccion" value="" required>
                    </div>
                  
                    <div class="form-group col-md-3">
                      <label>Sexo</label>
                      <select class="form-control select2" name="editarSexo" style="width: 100%;" required>
                        <option value="" id="editarSexo"></option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                    </div>
                    <input type="hidden" class="idPersona" value="" name="idPersona">
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="usuarios" role="tabpanel" aria-labelledby="editarUsuario">
                <div class="container-fluid mt-4">

                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="">Usuario</label>
                      <input type="text" class="form-control nuevoUsuario" name="editarUsuario" value="" readonly>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Rol</label>
                      <select class="form-control select2" style="width: 100%;" name="editarRol">
                        <option value="" id="editarRol"></option>
                          <?php 
                              $tabla = "tbl_roles";
                              $item = null;
                              $valor = null;

                              $roles = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                              foreach ($roles as $key => $value) {
                                if($value["rol"] == 'Default'){
                                  echo '<option value="'.$value["id_rol"].'">'.$value["rol"].'</option>';
                                } else {
                                  echo '<option value="'.$value["id_rol"].'">'.$value["rol"].'</option>';
                                }
                              }
                          ?>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="inputPass">Contraseña Generada</label>
                      <input type="text" class="form-control passwordGenerado" id="inputPass" name="editarPassword">
                      <input type="hidden" class="form-control" id="passwordActual" name="passwordActual">
                    </div>
                    <div class="col-md-3">
                      <a href="javascript:void(0);"  class="btn btn-block btn-orange generarPassword" style="margin-top:2em">Generar contraseña</a>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputFoto">Foto</label>
                      <div class="input-group">
                        <img class="img-thumbnail previsualizar mr-2" src="" alt="imagen-del-usuario" width="100px">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input nuevaFoto" id="inputFoto" name="editarFoto">
                          <label class="custom-file-label" for="inputFoto">Escoger foto</label>
                          <input type="hidden" name="fotoActual" id="fotoActual">
                        </div>
                      </div>
                          <p class="p-foto help-block ml-4">Peso máximo de la foto 2 MB</p>
                    </div>
                    <!-- <div class="form-group col-md-3">
                      <input type="text" value="Desactivado" style="color:red;" readonly>
                    </div> -->

                    <!-- <div class="form-group col-md-3">
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
                    </div> -->
                  </div>
                </div>
            
                <!-- <div class="modal-footer"> -->
                <div class="form-group mt-2 float-right">
                  <button type="" class="btn btn-primary">Guardar cambios</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>
            
                <?php
                  $ajustes = null;
                  $tipoPersona = 'usuarios';
                  $pantalla = 'usuarios';
                  $ingresarPersona = new ControladorPersonas();
                  $ingresarPersona->ctrEditarPersona($ajustes, $tipoPersona, $pantalla);
                ?>
              </div>
            </div>

          </form>

        </div>

      </div>
    </div>
  </div>
    
      
<?php 
  $tipoPersona = 'usuario';
  $pantalla = 'usuarios';
  $borrarUsuario = new ControladorPersonas();
  $borrarUsuario->ctrBorrarPersona($tipoPersona, $pantalla);
?>