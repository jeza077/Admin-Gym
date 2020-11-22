
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
          <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalAgregarCliente">
            Agregar cliente       
          </button>
          </div>
        </div>
      </div>
    </section>  

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
                    <th scope="col">Tipo Cliente</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Tipo Inscripcion</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Fecha Inscripcion</th>
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
                  // return;
                  foreach ($clientes as $key => $value) {
                    echo '
                          <tr>
                          <th scope="row">'.($key+1).'</th>
                          <td>'.$value["nombre"].'</td>
                          <td>'.$value["tipo_cliente"].'</td>
                          <td>'.$value["correo"].'</td>';

                          if ($value['tipo_inscripcion'] == null) {
                            echo  '<td>**Ninguna**</td>';
                          } else {
                            echo  '<td>'.$value["tipo_inscripcion"].'</td>';
                          }

                      echo  '<td>'.$value["telefono"].'</td>';
 
                          if ($value['fecha_creacion'] == null) {
                            echo  '<td>**Ninguna**</td>';
                          } else {
                            echo   '<td>'.$value["fecha_creacion"].'</td>';                          }
                          
                      echo
                          '<td><button class="btn btn-success btn-md">Activado</button></td>
                          <td>
                            <button class="btn btn-warning btnEditarCliente" id="btnEditar" data-toggle="modal" data-target="#modalEditarCliente" idEditarCliente="'.$value["id_personas"].'"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>
                            <button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id_personas"].'"><i class="fas fa-trash-alt"></i></button>
                          </td>
                        </tr>
                    ';
                   
                  }
                ?>
                </tbody>
              </table>
            </div>
        </div>
    </section>
  </div>


  <!-- =======================================
           MODAL AGREGAR  CLIENTE
  ======================================----->

  <div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a class="nav-link" id="datosCliente" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Datos Cliente</a>
              </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="datoscliente">
                <div class="container-fluid mt-4">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="">Tipo de documento <?php echo $i?></label>
                      <select class="form-control select2 tipoDocumentoCliente" name="nuevoTipoDocumento">
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
                      <input type="text" class="form-control idCliente" name="nuevoNumeroDocumento" placeholder="Ingrese Identidad" required>
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
                      <label for="email">Email</label>
                      <input type="email" class="form-control email" name="nuevoEmail" placeholder="Ingrese Email" required>
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
                      <label for="">Dirección</label>
                      <input type="text" class="form-control" name="nuevaDireccion" placeholder="Col. Alameda, calle #2..." required>
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
                        <label>Tipo Cliente</label>
                        <select class="form-control select2 tipoCliente" name="tipoCliente" style="width: 100%;" required>
                          <option selected="selected">Seleccionar...</option>
                          <option value="Gimnasio">Clientes del gimnasio</option>
                          <option value="Ventas">Cliente de ventas</option>
                        </select>
                      </div>
                    </div>
                    
                  <div id="datosClientes">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                          <label>Tipo matricula</label>
                          <select class="form-control select2 nuevaMatricula" style="width: 100%;" name="nuevaMatricula">
                            <?php 
                                $tabla = "tbl_matricula";
                                $item = null;
                                $valor = null;

                                $matriculas = ControladorClientes::ctrMostrar($tabla, $item, $valor);
                              
                                foreach ($matriculas as $key => $value) {
                                  if($value["tipo_matricula"] == 'Normal'){
                                    echo '<option selected="selected" value="'.$value["id_matricula"].'">'.$value["tipo_matricula"].'</option>';
                                  } else {
                                    echo '<option value="'.$value["id_matricula"].'">'.$value["tipo_matricula"].'</option>';
                                  }
                                }                             
                            ?>                           
                          </select> 
                      </div>
                      <div class="form-group col-md-6">
                         <label for="">Precio matricula</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>  
                              </div>
                            <input type="text" class="form-control text-right nuevoPrecioMatricula" value="<?php echo $value['precio_matricula']?>" readonly>
                         </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Promociones</label>
                        <select class="form-control select2 nuevaPromocion" style="width: 100%;" name="nuevaPromocion">
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
                      <div class="form-group col-md-6">
                         <label for="">Precio promocion</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>  
                              </div>
                            <input type="text" class="form-control text-right nuevoPrecioPromocion" value="" readonly>
                         </div>
                      </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6"> 
                          <label>Tipo inscripcion</label>
                          <select class="form-control select2 nuevaInscripcion" style="width: 100%;" name="nuevaInscripcion">
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
                        <div class="form-group col-md-6">
                         <label for="">Precio inscripcion</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>  
                              </div>
                            <input type="text" class="form-control text-right nuevoPrecioInscripcion" value="" readonly>                           
                         </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6 float-right">
                         <label for="">Total a pagar:</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>  
                            </div>
                            <input type="text" class="form-control text-right totalPagar" id="totalPagar" value="" readonly>                        
                         </div>
                      </div>
                    </div>
                  </div>
                </div>
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
           MODAL EDITAR CLIENTE
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
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="datosEditarPersona" data-toggle="tab" href="#editarPersona" role="tab" aria-controls="home" aria-selected="true">Datos personales</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="datosEditarCliente" data-toggle="tab" href="#editarCliente" role="tab" aria-controls="profile" aria-selected="false">Datos Cliente</a>
              </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="editarPersona" role="tabpanel" aria-labelledby="datoseditarcliente">
              
                <div class="container-fluid mt-4">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="">Tipo de documento <?php echo $i?></label>
                      <select class="form-control select2 editarTipoDocumento" name="editarTipoDocumento">
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
                      <input type="text" class="form-control editarNumeroDocumento" name="editarNumeroDocumento" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control editarNombre" name="editarNombre" required>
                      <input type="hidden" id="idEditarCliente" name="idEditarCliente">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="apellido">Apellido</label>
                      <input type="text" class="form-control editarApellido" name="editarApellido" required>
                    </div>
                  </div>
      
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="email">Email</label>
                      <input type="email" class="form-control editarEmail" name="editarEmail" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Teléfono</label>
                      <input type="text" class="form-control editarTelefono" data-inputmask='"mask": "(504) 9999-9999"' data-mask  name="editarTelefono" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Fecha de nacimiento</label>
                        <input type="text" class="form-control editarFechaNacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask  name="editarFechaNacimiento" required>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-9">
                      <label for="">Dirección</label>
                      <input type="text" class="form-control editarDireccion" name="editarDireccion" required>
                    </div>
                  
                    <div class="form-group col-md-3">
                      <label>Sexo</label>
                      <select class="form-control select2 editarSexo" name="editarSexo" style="width: 100%;" required>
                        <option selected="selected">Seleccionar...</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                    </div>
                   
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="editarCliente" role="tabpanel" aria-labelledby="datoseditarCLiente">
                <div class="container-fluid mt-4">
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label>Tipo Cliente</label>
                        <select class="form-control select2 editarTipoCliente" name="editarTipoCliente" style="width: 100%;" required>
                          <option selected="selected">Seleccionar...</option>
                          <option value="Gimnasio">Clientes del gimnasio</option>
                          <option value="Ventas">Cliente de ventas</option>
                        </select>
                      </div>
                    </div>
                    
                  <div id="datosCliente">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                          <label>Tipo matricula</label>
                          <select class="form-control select2 editarMatricula" style="width: 100%;" name="editarMatricula">
                            <?php 
                                $tabla = "tbl_matricula";
                                $item = null;
                                $valor = null;

                                $matriculas = ControladorClientes::ctrMostrar($tabla, $item, $valor);

                              
                                foreach ($matriculas as $key => $value) {
                                  if($value["tipo_matricula"] == 'Normal'){
                                    echo '<option selected="selected" value="'.$value["id_matricula"].'">'.$value["tipo_matricula"].'</option>';
                                  } else {
                                    echo '<option value="'.$value["id_matricula"].'">'.$value["tipo_matricula"].'</option>';
                                  }
                                }
                            ?>
                            
                          </select> 
                      </div>
                      <div class="form-group col-md-6">
                         <label for="">Precio matricula</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>  
                              </div>
                            <input type="text" class="form-control text-right editarPrecioMatricula" value="<?php echo $value['precio_matricula']?>" readonly>
                         </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Promociones</label>
                        <select class="form-control select2 editarPromocion" style="width: 100%;" name="editarPromocion">
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
                      <div class="form-group col-md-6">
                         <label for="">Precio promocion</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>  
                              </div>
                            <input type="text" class="form-control text-right editarPrecioPromocion precio" value="" readonly>
                         </div>
                      </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6"> 
                          <label>Tipo inscripcion</label>
                          <select class="form-control select2 editarInscripcion" style="width: 100%;" name="editarInscripcion">
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
                        <div class="form-group col-md-6">
                         <label for="">Precio inscripcion</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>  
                              </div>
                            <input type="text" class="form-control text-right editarPrecioInscripcion precio" value="" readonly>
                         </div>
                      </div>
                      
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6 float-right">
                         <label for="">Total a pagar:</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>  
                            </div>
                            <input type="text" class="form-control text-right editarTotalPagar" value="" readonly>
                         </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group mt-4 float-right">
                  
                  <button type="" class="btn btn-primary">Guardar Cambios</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>
                <?php
                  $tipoPersona = 'clientes';
                  $pantalla = 'clientes';
                  $editarPersona = new ControladorPersonas();
                  $editarPersona->ctrEditarPersona($tipoPersona, $pantalla);
                ?>

              </div>
            </div>
          </form>

        </div>

      </div>
    </div>
  </div>
<!-- =======================================
           ELIMINAR CLIENTE
  ======================================----->
  <?php

    $pantalla = 'clientes';
    
    $eliminarCliente = new ControladorClientes();
    $eliminarCliente->ctrEliminarCliente($tipoPersona, $pantalla);
  ?>