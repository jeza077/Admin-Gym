
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar Clientes</h1>
          </div>
          <div class="col-sm-6">
          <button class="btn btn-orange float-right" id="clienteNuevo">
            Nuevo Cliente       
          </button>
          <button class="btn btn-danger btnExportarClientes float-right mr-3">
              Exportar PDF          
          </button>
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
        
        $descripcionEvento = " Consulto la pantalla de cliente";
        $accion = "consulta";

        $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 3,$accion, $descripcionEvento);

      ?>

        <div class="card">

            <div class="card-body">
            
              <table class="table table-striped table-bordered tablaClientes text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">No. Documento</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo Cliente</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <!-- <th scope="col">Fecha Creacion</th> -->
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>

                <?php 
                
                // $tabla = "tbl_clientes";
                // $item = null;
                // $valor = null;
                // $clientes = ControladorClientes::ctrMostrarClientesSinPago($tabla, $item, $valor);
        
                //   echo "<pre>";
                //   var_dump($clientes);
                //   echo "</pre>";
                  // return;
                ?>
              
              </table>
            </div>
        </div>
    </section>
  </div>


  <!-- =======================================
  MODAL AGREGAR  CLIENTE
  ======================================----->

  <div class="modal fade" id="modalAgregarClienteNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <select class="form-control select2 tipoDocumentoCliente" name="nuevoTipoDocumento" style="width: 100%;">
                          <option selected="selected">Seleccionar...</option>
                          <?php 
                              $tabla = "tbl_documento";
                              $item = 'estado';
                              $valor = 1;
                              $all = true;

                              $documento = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

                              foreach ($documento as $key => $value) { ?>
                                  <option value="<?php echo $value['id_documento']?>"><?php echo $value['tipo_documento']?></option>        
                              <?php 
                              }
                          ?>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="identidad">Numero de documento</label>
                      <input type="text" class="form-control numeroDocumento longitudDocumento sinEspacioDoc" name="nuevoNumeroDocumento" placeholder="Ingrese Identidad" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control nombre mayus longitudNombre" name="nuevoNombre" placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="apellido">Apellido</label>
                      <input type="text" class="form-control apellidos mayus longitudNombre" name="nuevoApellido" placeholder="Ingrese Apellidos" required>
                    </div>
                  </div>

                  <div class="alertaDocumento"></div>
      
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="email">Email</label>
                      <input type="email" class="form-control email" name="nuevoEmail" placeholder="Ingrese Email" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Teléfono</label>
                      <input type="text" class="form-control" data-inputmask='"mask": "(504) 9999-9999"' data-mask  name="nuevoTelefono" placeholder="Ingrese Telefono" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Fecha de nacimiento</label>
                        <input type="text" class="form-control fecha" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask  name="nuevaFechaNacimiento" placeholder="Ingrese Fecha de Nacimiento" required>
                    </div>
                  </div>
                  
                  <div class="alertaEmail"></div>

                  <div class="form-row">
                    <div class="form-group col-md-9">
                      <label for="">Dirección</label>
                      <input type="text" class="form-control mayus nuevaDireccion longitudDireccion soloUnEspacio" name="nuevaDireccion" placeholder="Col. Alameda, calle #2..." required>
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
                      <div class="form-group col-md-6">
                        <label>Tipo Cliente</label>
                        <select class="form-control select2 tipoCliente" name="tipoCliente" style="width: 100%;" required>
                          <option selected="selected">Seleccionar...</option>
                          <option value="Gimnasio">Clientes del gimnasio</option>
                          <option value="Ventas">Cliente de ventas</option>
                        </select>
                      </div>
                    </div>
                    
                  <div class="datosClientes">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                          <label>Tipo matricula</label>
                          <select class="form-control select2 nuevaMatricula" style="width: 100%;" name="nuevaMatricula">
                          <option selected="selected">Seleccionar...</option>
                            <?php 
                                $tabla = "tbl_matricula";
                                $item = null;
                                $valor = null;

                                $matriculasClienteVenta = ControladorClientes::ctrMostrar($tabla, $item, $valor);
                              
                                foreach ($matriculasClienteVenta as $key => $value) { ?>
                                  <option value="<?php echo $value['id_matricula']?>"><?php echo $value['tipo_matricula']?></option>        
                                <?php 
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
                            <input type="text" class="form-control text-right nuevoPrecioMatricula totalMatricula" name="nuevoPrecioMatricula" value="" readonly>
                            <!-- <input type="hidden" id="pagoMatricula" name="pagoMatricula">   -->
                         </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Promociones</label>
                        <select class="form-control select2 nuevaPromocion" style="width: 100%;" name="nuevaPromocion">
                          <option selected="selected">Seleccionar...</option>
                          
                            <?php 
                                $tabla = "tbl_descuento";
                                $item = null;
                                $valor = null;

                                $descuentos = ControladorClientes::ctrMostrar($tabla, $item, $valor);

                                foreach ($descuentos as $key => $value) { ?>
                                  <option value="<?php echo $value['id_descuento']?>"><?php echo $value['tipo_descuento']?></option>        
                                <?php 
                                }
                            ?>
                        </select> 
                      </div>
                      <div class="form-group col-md-6">
                         <label for="">Precio promocion</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>  
                              </div>
                            <input type="text" class="form-control text-right nuevoPrecioPromocion totalDescuento" name="" value="" readonly>
                            <input type="hidden" name="nuevoPrecioDescuento">  
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
                                  $item = 'estado';
                                  $valor = 1;
                                  $all = true;
    
                                  $inscripciones = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

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
                            <input type="text" class="form-control text-right nuevoPrecioInscripcion totalInscripcion" name="nuevoPrecioInscripcion" value="" readonly>    
                            <!-- <input type="hidden" id="pagoInscripcion" name="pagoInscripcion">-->
                         </div>
                      </div>
                    </div>
                    
                    <div class="form-row">
                      <button type="" class="btn btn-success btn-block col-md-6 mt-4 mb-3 verTotalPago"><i class="fas fa-dollar-sign"></i> Calcular</button>       

                      <div class="form-group col-md-6">
                        <label for="">Total a pagar:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">$</span>  
                          </div>
                          <input type="text" class="form-control float-right text-right totalPagar" name="nuevoTotalCliente" value="" readonly>  
                         </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="form-group mt-4 float-right">
                  <button type="" class="btn btn-primary btnConfirmarPago">Guardar</button>
                  <!-- <button type="" class="btn btn-primary btnConfirmarPagoNuevo">Guardar</button> -->
                  <button type="" class="btn btn-primary btnNuevoClienteGym">Guardar</button>
                  <button type="" class="btn btn-primary btnNuevoClienteVentas">Guardar</button>
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
  MODAL EDITAR CLIENTE GIMNASIO
  ======================================----->

  <div class="modal fade" id="modalEditarClienteGimnasio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Cliente Gimnasio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" class="formulario">
                <div class="container-fluid mt-4">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="">Tipo de documento <?php echo $i?></label>
                      <select class="form-control" name="editarTipoDocumento" style="width: 100%;">
                          <option value="" id="editarTipoDocumento"></option>
                          <?php 
                              $tabla = "tbl_documento";
                              $item = 'estado';
                              $valor = 1;
                              $all = true;

                              $documentoEditar = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

                              foreach ($documentoEditar as $key => $value) { ?>
                                  <option value="<?php echo $value['id_documento']?>"><?php echo $value['tipo_documento']?></option>        
                              <?php 
                              }
                          ?>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="identidad">Numero de documento</label>
                      <input type="text" class="form-control editarNumeroDocumento longitudNombre" name="editarNumeroDocumento" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control editarNombre mayus longitudNombre" name="editarNombre" required>
                      <input type="hidden" id="EditarTipoClienteGimnasio" name="EditarTipoClienteGimnasio">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="apellido">Apellido</label>
                      <input type="text" class="form-control editarApellido mayus longitudNombre" name="editarApellido" required>
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
                        <input type="text" class="form-control fechaEditar editarFechaNacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask  name="editarFechaNacimiento" required>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-9">
                      <label for="">Dirección</label>
                      <input type="text" class="form-control editarDireccion mayus longitudDireccion soloUnEspacio" name="editarDireccion" required>
                    </div>
                  
                    <div class="form-group col-md-3">
                      <label>Sexo</label>
                      <select class="form-control" name="editarSexo" style="width: 100%;" required>
                        <option value="" id="editarSexo"></option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                    </div>       
                  </div>
                </div>
              
                <div class="form-group mt-4 float-right">
                 <input type="hidden" id="idEditarCliente" name="idEditarCliente">
                <!-- <input type="hidden" id="editarTipoCliente" name="editarTipoCliente"> -->
                  <button type="" class="btn btn-primary">Guardar Cambios</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>
                <?php
                  $ajustes = null;
                  $tipoPersona = 'clientes';
                  $pantalla = 'clientes';
                  $editarPersona = new ControladorPersonas();
                  $editarPersona->ctrEditarPersona($ajustes, $tipoPersona, $pantalla);
                ?>
         
          </form>

        </div>

      </div>
    </div>
  </div>

  <!-- =======================================
    MODAL DATOS DE CLIENTE VENTAS A DETALLE
  ======================================----->
  <div class="modal fade" id="modalVerClienteVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">      
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Datos cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          
        <form role="form" method="post" class="formulario" enctype="multipart/form-data">

          <div class="alertaClienteVenta"></div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Dirección</label>
              <input type="text" class="form-control" value="" id=detalleDireccionClienteVenta disabled>
            </div>
          </div>

          <!-- <div class="form-row">
            <div class="form-group col-md-12">
              <label>Sexo</label>
              <input type="text" class="form-control" value="" id=detalleSexoClienteVenta disabled>
            </div>
          </div> -->
          
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Fecha nacimiento</label>
              <input type="text" class="form-control" value="" id=detalleFechaNacClienteVenta disabled>
            </div>
            <div class="form-group col-md-6">
              <label>Sexo</label>
              <input type="text" class="form-control" value="" id=detalleSexoClienteVenta disabled>
            </div>
          </div>
      
          <!-- <div class="modal-footer"> -->
          <div class="form-group final mt-4 float-right">
            <button type="button" class="btn btn-danger" id="salirCliVenta" data-dismiss="modal">Salir</button>
          </div>
      
        </form>


        </div>

      </div>
    </div>
  </div>

  <!-- =======================================
  MODAL EDITAR CLIENTE VENTA
  ======================================----->

  <div class="modal fade" id="modalEditarClienteVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Cliente Ventas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form role="form" method="post" class="formulario">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="datosEditarPersonaVenta" data-toggle="tab" href="#editarPersonaVenta" role="tab" aria-controls="home" aria-selected="true">Datos personales</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="datosEditarClienteVenta" data-toggle="tab" href="#editarClienteVenta" role="tab" aria-controls="profile" aria-selected="false">Datos Cliente</a>
              </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="editarPersonaVenta" role="tabpanel" aria-labelledby="datoseditarclienteventa">
                <div class="container-fluid mt-4">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="">Tipo de documento <?php echo $i?></label>
                      <select class="form-control" name="tipoDocumentoClienteVentas" style="width: 100%;">
                          <option value="" id="tipoDocumentoClienteVentas"></option>
                          <?php 
                              $tabla = "tbl_documento";
                              $item = 'estado';
                              $valor = 1;
                              $all = true;

                              $documento = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

                              foreach ($documento as $key => $value) { ?>
                                  <option value="<?php echo $value['id_documento']?>"><?php echo $value['tipo_documento']?></option>        
                              <?php 
                              }
                          ?>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="identidad">Numero de documento</label>
                      <input type="text" class="form-control numeroDocumentoClienteVentas longitudNombre" name="numeroDocumentoClienteVentas" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control nombreClienteVentas mayus longitudNombre" name="nombreClienteVentas" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="apellido">Apellido</label>
                      <input type="text" class="form-control apellidoClienteVentas mayus longitudNombre" name="apellidoClienteVentas" required>
                    </div>
                  </div>
      
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="email">Email</label>
                      <input type="email" class="form-control editarEmailVentas" name= "editarEmailVentas" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Teléfono</label>
                      <input type="text" class="form-control telefonoClienteVentas" data-inputmask='"mask": "(504) 9999-9999"' data-mask  name="telefonoClienteVentas" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Fecha de nacimiento</label>
                        <input type="text" class="form-control fecha fechaNacimientoClienteVentas" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask  name="fechaNacimientoClienteVentas" required>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-9">
                      <label for="">Dirección</label>
                      <input type="text" class="form-control direccionClienteVentas mayus longitudDireccion soloUnEspacio" name="direccionClienteVentas" required>
                    </div>
                  
                    <div class="form-group col-md-3">
                      <label>Sexo</label>
                      <select class="form-control" name="editarSexoClienteVentas" style="width: 100%;" required>
                        <option value="" id="editarSexoClienteVentas"></option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                    </div>  
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="editarClienteVenta" role="tabpanel" aria-labelledby="datoseditarCLiente">
                <div class="container-fluid mt-4">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label>Tipo Cliente</label>
                      <select class="form-control tipoClienteVenta" name="editarTipoClienteVenta" style="width: 100%;" required>
                        <option value="tipoCl" id="editarTipoClienteVenta"></option>
                        <!-- <option selected="selected">Seleccionar...</option> -->
                        <option value="Gimnasio">Clientes del gimnasio</option>
                        <option value="Ventas">Cliente de ventas</option>
                      </select>
                    </div>
                  </div>
                  <div id="datosClienteVenta">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                          <label>Tipo matricula</label>
                          <select class="form-control nuevaMatriculaClienteVenta" style="width: 100%;" name="tipoMatriculaClienteVenta">
                            <option value="" id="tipoMatriculaClienteVenta" ></option>
                            <option selected="selected">Seleccionar...</option>
                            <?php 
                                $tabla = "tbl_matricula";
                                $item = null;
                                $valor = null;

                                $matriculas = ControladorClientes::ctrMostrar($tabla, $item, $valor);

                              
                                  foreach ($matriculas as $key => $value) { ?>
                                    <option value="<?php echo $value['id_matricula']?>"><?php echo $value['tipo_matricula']?></option>        
                                  <?php 
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
                            <input type="text" class="form-control text-right precioMatriculaClienteVentas totalMatricula" name="precioMatriculaClienteVentas" readonly>
                            <!-- <input type="hidden" id="nuevoMatriculaClienteVentas" name="nuevoMatriculaClienteVentas"> -->
                         </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label>Promociones</label>
                        <select class="form-control nuevoDescuentoClienteVenta" style="width: 100%;" name="editarPromocionClienteVenta">
                            <option value="" id="editarPromocionClienteVenta"></option> 
                            <option selected="selected">Seleccionar...</option>
                          
                            <?php 
                                $tabla = "tbl_descuento";
                                $item = null;
                                $valor = null;

                                $descuentos = ControladorClientes::ctrMostrar($tabla, $item, $valor);

                                foreach ($descuentos as $key => $value) { ?>
                                  <option value="<?php echo $value['id_descuento']?>"><?php echo $value['tipo_descuento']?></option>        
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
                            <input type="text" class="form-control text-right valorDescuentoClienteVenta totalDescuento" value="" name="" readonly>
                            <input type="hidden" id="editarPrecioDescuento" name="editarPrecioDescuento">  
                         </div>
                      </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6"> 
                          <label>Tipo inscripcion</label>
                          <select class="form-control nuevaInscripcionClienteVenta" style="width: 100%;" name="inscripcionClienteVenta">
                              <option value="" id="inscripcionClienteVenta"></option>
                              <option selected="selected">Seleccionar...</option>
                              <?php 
                                  $tabla = "tbl_inscripcion";
                                  $item = 'estado';
                                  $valor = 1;
                                  $all = true;
    
                                  $inscripciones = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

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
                            <input type="text" class="form-control text-right precioInscripcionClienteVenta totalInscripcion" name="precioInscripcionClienteVenta" readonly>
                            <!-- <input type="hidden" id="nuevaInscripcionClienteVenta" name="nuevaInscripcionClienteVenta"> -->
                         </div>
                      </div>
                    </div>
                    <!-- <div class="form-row">
                      <div class="form-group col-md-6 float-right">
                         <label for="">Total a pagar:</label>
                         <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>  
                            </div>
                            <input type="text" class="form-control text-right totalPagarClienteVenta totalPagar" value="" name="totalPagarClienteVenta" readonly>
                            <button type="" class="btn btn-success verTotalPago">Ver Total<i class="fas fa-dollar-sign"></i></button>
                         </div>
                      </div>
                    </div> -->
                    <div class="form-row">
                      <button type="" class="btn btn-success btn-block col-md-6 mt-4 mb-3 verTotalPagoCliente"><i class="fas fa-dollar-sign"></i> Calcular</button>       

                      <div class="form-group col-md-6">
                        <label for="">Total a pagar:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">$</span>  
                          </div>
                          <input type="text" class="form-control float-right text-right totalPagarClienteVenta" name="totalPagarClienteVenta" value="" readonly>  
                         </div>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="form-group mt-4 float-right">
                  <input type="hidden" id="idEditarClienteVenta" name="idEditarClienteVenta">
                  <button type="" class="btn btn-primary">Guardar Cambios</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                </div>
                <?php
                  
                  $tipoCliente = 'clientes';
                  $pantalla = 'clientes';
                  $editarPersona = new ControladorPersonas();
                  $editarPersona->ctrEditarClienteVentas($tipoCliente, $pantalla);
                ?>

              </div>
            </div>
          </form>

        </div>

      </div>
    </div>
  </div>


  <!-- =======================================
  MODAL AGREGAR  CLIENTE YA REGISTRADO
  ======================================----->

  <div class="modal fade" id="modalAgregarClienteYaRegistrado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

            <div class="container-fluid mt-4">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Persona</label>
                    <select class="form-control select2 nuevoIdPersona" style="width: 100%;" name="nuevoIdPersona">
                      <option selected="selected">Seleccionar...</option>
                        <?php 
                          $item = 'tipo_persona';
                          $valor = 'usuarios';
                          $all = true;

                          $personas = ControladorPersonas::ctrMostrarPersonas($item, $valor, $all);

                          
                          foreach ($personas as $key => $value) {
                              if($value['nombre'] !== 'SUPER' && $value['apellidos'] !== 'ADMIN'){
                                echo '<option value="'.$value["id_personas"].'">'.$value["nombre"]. ' ' .$value["apellidos"].'</option>';
                              } 

                          }
                        ?>
                    </select>
                  </div>


                  <div class="form-group col-md-6">
                    <label>Tipo Cliente</label>
                    <select class="form-control select2 tipoClienteRegistrado" name="tipoClienteRegistrado" style="width: 100%;" required>
                      <option selected="selected">Seleccionar...</option>
                      <option value="Gimnasio">Clientes del gimnasio</option>
                      <option value="Ventas">Cliente de ventas</option>
                    </select>
                  </div>
                </div>
                
              <div class="datosClientes">
                <div class="form-row">
                  <div class="form-group col-md-6">
                      <label>Tipo matricula</label>
                      <select class="form-control select2 nuevaMatriculaRegistrado" style="width: 100%;" name="nuevaMatriculaRegistrado">
                      <option selected="selected">Seleccionar...</option>
                        <?php 
                            $tabla = "tbl_matricula";
                            $item = null;
                            $valor = null;

                            $matriculasClienteVenta = ControladorClientes::ctrMostrar($tabla, $item, $valor);
                          
                            foreach ($matriculasClienteVenta as $key => $value) { ?>
                              <option value="<?php echo $value['id_matricula']?>"><?php echo $value['tipo_matricula']?></option>        
                            <?php 
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
                        <input type="text" class="form-control text-right nuevoPrecioMatriculaRegistrado totalMatriculaRegistrado" name="nuevoPrecioMatriculaRegistrado" value="" readonly>
                        <!-- <input type="hidden" id="pagoMatricula" name="pagoMatricula">   -->
                      </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Promociones</label>
                    <select class="form-control select2 nuevaPromocionRegistrado" style="width: 100%;" name="nuevaPromocionRegistrado">
                      <option selected="selected">Seleccionar...</option>
                      
                        <?php 
                            $tabla = "tbl_descuento";
                            $item = null;
                            $valor = null;

                            $descuentos = ControladorClientes::ctrMostrar($tabla, $item, $valor);

                            foreach ($descuentos as $key => $value) { ?>
                              <option value="<?php echo $value['id_descuento']?>"><?php echo $value['tipo_descuento']?></option>        
                            <?php 
                            }
                        ?>
                    </select> 
                  </div>
                  <div class="form-group col-md-6">
                      <label for="">Precio promocion</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">%</span>  
                          </div>
                        <input type="text" class="form-control text-right nuevoPrecioPromocionRegistrado totalDescuentoRegistrado" name="" value="" readonly>
                        <input type="hidden" id="nuevoPrecioDescuento" name="nuevoPrecioDescuentoRegistrado">  
                      </div>
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6"> 
                      <label>Tipo inscripcion</label>
                      <select class="form-control select2 nuevaInscripcionRegistrado" style="width: 100%;" name="nuevaInscripcionRegistrado">
                          <option selected="selected">Seleccionar...</option>
                          <?php 
                              $tabla = "tbl_inscripcion";
                              $item = 'estado';
                              $valor = 1;
                              $all = true;                            

                              $inscripciones = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);

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
                        <input type="text" class="form-control text-right nuevoPrecioInscripcionRegistrado totalInscripcionRegistrado" name="nuevoPrecioInscripcionRegistrado" value="" readonly>    
                        <!-- <input type="hidden" id="pagoInscripcion" name="pagoInscripcion">-->
                      </div>
                  </div>
                </div>
                
                <div class="form-row">
                  <button type="" class="btn btn-success btn-block col-md-6 mt-4 mb-3 verTotalPagoRegistrado"><i class="fas fa-dollar-sign"></i> Calcular</button>       

                  <div class="form-group col-md-6">
                    <label for="">Total a pagar:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text">$</span>  
                      </div>
                      <input type="text" class="form-control float-right text-right totalPagarRegistrado" name="nuevoTotalClienteRegistrado" value="" readonly>  
                      </div>
                  </div>

                </div>

              </div>
            </div>

            <div class="form-group mt-4 float-right">
              <button type="" class="btn btn-primary btnConfirmarPago">Guardar</button>
              <button type="" class="btn btn-primary btnNuevoClienteGymRegistrado">Guardar</button>
              <button type="" class="btn btn-primary btnNuevoClienteVentas">Guardar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
            </div>
        
            <?php
              $ingresarCliente = new ControladorClientes();
              $ingresarCliente->ctrCrearClienteYaRegistrado();
            ?>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- =======================================
      MODAL DATOS DE CLIENTE GYM A DETALLE
  ======================================----->
  <div class="modal fade" id="modalVerClienteGym" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">      
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Datos cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          
        <form role="form" method="post" class="formulario" enctype="multipart/form-data">

          <div class="form-row">
            <div class="form-group col-md-12">
              <label>Dirección</label>
              <input type="text" class="form-control" value="" id=detalleDireccionClienteGym disabled>
            </div>
          </div>

          <!-- <div class="form-row">
            <div class="form-group col-md-12">
              <label>Sexo</label>
              <input type="text" class="form-control" value="" id=detalleSexoClienteGym disabled>
            </div>
          </div> -->
          
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Fecha nacimiento</label>
              <input type="text" class="form-control" value="" id=detalleFechaNacClienteGym disabled>
            </div>
            <div class="form-group col-md-6">
              <label>Sexo</label>
              <input type="text" class="form-control" value="" id=detalleSexoClienteGym disabled>
            </div>
          </div>
      
          <!-- <div class="modal-footer"> -->
          <div class="form-group final mt-4 float-right">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
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
    $tipoPersona = 'cliente';
    $pantalla = 'clientes';
    
    $eliminarCliente = new ControladorPersonas();
    $eliminarCliente->ctrBorrarPersona($tipoPersona, $pantalla);
  ?>