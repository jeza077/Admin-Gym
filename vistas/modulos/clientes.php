
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clientes</h1>
          </div>
          <div class="col-sm-6">
          <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalAgregarUsuario">
            Agregar cliente       
          </button>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  

 <!-- Main content -->
    <section class="content">
    <?php 
      $permisoAgregar = $_SESSION['permisos']['Clientes']['agregar'];
      $permisoEliminar = $_SESSION['permisos']['Clientes']['eliminar'];
      $permisoActualizar = $_SESSION['permisos']['Clientes']['actualizar'];
      $permisoConsulta = $_SESSION['permisos']['Clientes']['consulta'];

      // var_dump($_SESSION['perm']);

      // foreach ($permisos_pantalla as $key => $value) {
      //   echo $key;
      // }
    ?>

        <div class="card">

            <div class="card-body">
            
              <table class="table table-striped table-bordered tablas text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Fecha inscripcion</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  $tabla = "tbl_clientes";
                  $item = null;
                  $valor = null;
                  $clientes = ControladorClientes::ctrMostrarClientes($tabla, $item, $valor);

                  // echo "<pre>";
                  // var_dump($clientes);
                  // echo "</pre>";

                  foreach ($clientes as $key => $value) {
                    echo '
                          <tr>
                          <th scope="row">1</th>
                          <td>'.$value["nombre"].'</td>
                          <td>'.$value["correo"].'</td>
                          <td>'.$value["telefono"].'</td>';

                     echo '     
                          <td>'.$value["fecha_creacion"].'</td>
                          <td><button class="btn btn-success btn-md">Activado</button></td>
                          <td>
                            <button class="btn btn-warning"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            <button class="btn btn-success" id="pago">Actualizar pago <i class="fas fa-sync"></i></button>
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
          <h5 class="modal-title" id="exampleModalLabel">Nuevo cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" class="formulario">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="datosPersona" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos personales</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="datosUsuario" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Datos Cliente</a>
              </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="datoscliente">
                <div class="container-fluid mt-4">
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
                      <label for="identidad">Numero de documento</label>
                      <input type="text" class="form-control id" name="nuevoNumeroDocumento" placeholder="Ingrese Identidad" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control nombre" name="nuevoNombre" placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="apellido">Apellido</label>
                      <input type="text" class="form-control apellidos" name="nuevoApellido" placeholder="Ingrese Apellidos" required>
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

                  </div>
                </div>
              </div>
             


              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="datosCLiente">
                <div class="container-fluid mt-4">
                    <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Tipo matricula</label>
                        <select class="form-control select2" style="width: 100%;" name="nuevaMatricula">
                          <option selected="selected" value="1">normal</option>
                           
                        </select> 
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label>Promociones</label>
                        <select class="form-control select2" style="width: 100%;" name="nuevaPromocion">
                          <option selected="selected">Seleccionar...</option>
                          
                            <?php 
                                $tabla = "tbl_promociones_descuentos";
                                $item = null;
                                $valor = null;

                                $matriculas = ControladorClientes::ctrMostrar($tabla, $item, $valor);

                                foreach ($matriculas as $key => $value) { ?>
                                  <option value="<?php echo $value['id_promociones_descuentos']?>"><?php echo $value['tipo_promociones_descuentos']?></option>        
                                <?php 
                                }
                            ?>
                        </select> 
                      </div>
                      <!-- <div class="form-group col-md-4">
                        <label>Valor: </label>
                        <input type="text" class="form-control" placeholder="50 "  required>
                      </div> -->
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3"> 
                          <label>Tipo inscripcion</label>
                          <select class="form-control select2" style="width: 100%;" name="nuevaInscripcion">
                              <option selected="selected">Seleccionar...</option>
                              <?php 
                                  $tabla = "tbl_inscripcion";
                                  $item = null;
                                  $valor = null;

                                  $inscripciones = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                                  foreach ($inscripciones as $key => $value) { ?>
                                    <option value="<?php echo $value['id_inscripcion']?>"><?php echo $value['tipo_inscripcion']?></option>        
                                  <?php 
                                  }

                              ?>
                          </select>
                        </div>
                    </div>

                </div>
            
                <!-- <div class="modal-footer"> -->
                <div class="form-group mt-4 float-right">
                  <button type="" class="btn btn-primary">Guardar</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>
            
                <?php
                  $tipoPersona = 'clientes';
                  $pantalla = 'clientes';
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

  <div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" class="formulario">
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
                    <label for="identidad">Numero de documento</label>
                    <input type="text" class="form-control id" name="nuevoNumeroDocumento" placeholder="Ingrese Identidad" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control nombre" name="nuevoNombre" placeholder="Ingrese Nombre" required>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control apellidos" name="nuevoApellido" placeholder="Ingrese Apellidos" required>
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
                <label>Tipo Inscripcion</label>
                <select class="form-control select2" style="width: 100%;" name="nuevaIncripcion">
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
                <label>Descuento o
                       Promocion</label>
                <select class="form-control select2" style="width: 100%;" name="nuevoDescuento">
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
            </div>
            <div class="modal-footer">
            <!-- <div class="form-group mt-4 float-right"> -->
              <button type="" class="btn btn-primary" data-toggle="modal" data-target="#modalAddCLiente">Guardar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
            </div>
            
          </form>
        </div>

      </div>
    </div>
  </div>
    

