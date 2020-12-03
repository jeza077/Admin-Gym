
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pagos Clientes</h1>
          </div>
          <div class="col-sm-6">
          <!-- <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalAgregarCliente">
            Nuevo Cliente       
          </button> -->
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
            
              <table class="table table-striped table-bordered tablas text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo Inscripcion</th>
                    <th scope="col">Ultimo Pago</th>
                    <th scope="col">Fecha Ultimo Pago</th>
                    <th scope="col">Fecha Vencimiento</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                  // echo  $_SESSION['id_usuario'];
                
                // $tabla = "tbl_clientes";
                // $item = 'id_personas';
                // $valor = 37;
                // $cli = ControladorClientes::ctrMostrarClientesPagos($tabla, $item, $valor, $max);
                // var_dump($cli);

                  $tabla = "tbl_clientes";
                  $item = 'tipo_cliente';
                  $valor = 'Gimnasio';
                  $max = true;
                  $clientes = ControladorClientes::ctrMostrarClientesPagos($tabla, $item, $valor, $max);

                  // echo "<pre>";
                  // var_dump($clientes);
                  // echo "</pre>";
                  // return;
                  foreach ($clientes as $key => $value) {
                    echo '
                        <tr>
                        <th scope="row">'.($key+1).'</th>
                        <td>'.$value["nombre"].' '.$value["apellidos"].'</td>
                        <td>'.$value["tipo_inscripcion"].'</td>
                        <td>'.$value["pago_total"].'</td>
                        <td>'.$value["fecha_ultimo_pago"].'</td>';

                        $fechaVencimientoPago = $value['fecha_vencimiento'];
                        $fechaHoy = date('Y-m-d');
                        $date1 = new DateTime($fechaHoy);
                        $date2 = new DateTime($fechaVencimientoPago);
                        $diff = $date1->diff($date2);

                        // var_dump($date1);
                        // echo $diff->days;                          
                        if($diff->days >= 10 && $diff->days <= 30){  
                            echo '<td class="badge badge-success mt-2" data-toggle="tooltip" data-placement="left" title="Suscrito">'.$value["fecha_vencimiento"].'</td>';
                        } else if($diff->days >= 1 && $diff->days <= 10) {
                            echo '<td class="badge badge-warning mt-2" data-toggle="tooltip" data-placement="left" title="Suscripcion por Vencer">'.$value["fecha_vencimiento"].'</td>';
                        } else {
                            echo '<td class="badge badge-danger mt-2" data-toggle="tooltip" data-placement="left" title="Suscripcion vencida">'.$value["fecha_vencimiento"].'</td>';
                        }
 
                          if($value['estado'] != 0){
                            echo '<td><span class="badge badge-success p-2" idCliente="'.$value["id_cliente"].'" estadoUsuario="0">Activado</span></td>';
                          } else {
                            echo '<td><span class="badge badge-danger p-2" idCliente="'.$value["id_cliente"].'" estadoUsuario="1">Desactivado</span></td>';
                          }
                    

                      echo
                          '<td>
                            <button class="btn btn-success btnEditarPago" data-toggle="tooltip" data-placement="left" title="Actualizar Pago" idCliente="'.$value["id_personas"].'"><i class="fas fa-dollar-sign p-1"></i></button>

                            <button class="btn btn-warning btnEditarCliente" id="btnEditar" data-toggle="modal" data-target="#modalEditarCliente" idEditarCliente="'.$value["id_personas"].'"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>
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
           MODAL ACTUALIZAR PAGO CLIENTE
  ======================================----->

  <div class="modal fade" id="modalEditarPagos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pago Cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
            <form role="form" method="post" class="formulario">
              <div class="container-fluid mt-4">
                <div class="form-row">
                  <div class="form-group col-md-6"> 
                    <label>Tipo inscripcion</label>
                    <select class="form-control select2 actualizarInscripcion" style="width: 100%;" name="actualizarInscripcion">
                        <option value="" id="actualizarInscripcion"></option>
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
                      <input type="text" class="form-control text-right actualizarPagoInscripcion totalInscripcion" name="actualizarPagoInscripcion" value="" readonly>    
                      <!-- <input type="hidden" id="actualizarPrecioInscripcion" name="actualizarPrecioInscripcion">                     -->
                    </div>
                  </div>
                </div>

                <div class="container-fluid">

                  <div class="form-row">
                          
                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Enero
                        </label>
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Febrero
                        </label>
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Marzo
                        </label>
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Abril
                        </label>
                      </div>
                    </div>
 
                  </div>
                  <div class="form-row">
                          
                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Mayo
                        </label>
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Junio
                        </label>
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Julio
                        </label>
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Agosto
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                            
                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Septiembre
                        </label>
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Octubre
                        </label>
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Noviembre
                        </label>
                      </div>
                    </div>

                    <div class="form-group col-md-3">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="gridCheck">
                          Diciembre
                        </label>
                      </div>
                    </div>
  
                  </div>
                </div>


                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Promociones</label>
                    <select class="form-control select2 descuentoNuevo" style="width: 100%;" name="actualizarDescuento">
                        <option value="" id="actualizarDescuento"></option>
                        <?php 
                            $tabla = "tbl_descuento";
                            $item = null;
                            $valor = null;

                            $matriculas = ControladorClientes::ctrMostrar($tabla, $item, $valor);

                            foreach ($matriculas as $key => $value) { ?>
                              <option value="<?php echo $value['id_descuento']?>"><?php echo $value['tipo_descuento']?></option>        
                            <?php 
                            }
                          
                        ?>
                    </select> 
                  </div>
                  <div class="form-group col-md-6">
                      <label for="">Porcentaje Promocion</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">%</span>  
                          </div>
                        <input type="text" class="form-control text-right actualizarTotalDescuento totalDescuento" name="actualizarTotalDescuento" value="" readonly>
                        <!-- <input type="hidden" id="precioDescuentoActualizado" name="precioDescuentoActualizado">   -->
                      </div>
                  </div>
                  
                  <div class="form-row">
                      <button type="" class="btn btn-success btn-block col-md-6 mt-4 mb-3 verTotalPago"><i class="fas fa-dollar-sign"></i>Calcular </button>       
                      <div class="form-group col-md-6">
                        <label for="">Total a pagar:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">$</span>  
                          </div>
                          <input type="text" class="form-control float-right text-right totalPagar" name="nuevoTotalPago" value="" readonly>  
                         </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="form-group mt-4 float-right">
                <button type="" class="btn btn-primary">Actualiazar pago</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
              </div> 
              <?php
                  // $ajustes = null;
                  // $tipoPersona = 'clientes';
                  // $pantalla = 'clientes';
                  // $editarPersona = new ControladorPersonas();
                  // $editarPersona->ctrActualizarPagoCliente($tipoPersona, $pantalla);

                  // echo "<pre>";
                  // var_dump($editarPersona);
                  // echo "</pre>";
                  // return;
                ?>
            </form>
          </div>
      </div>
    </div>
  </div> 


<!-- =======================================
           ELIMINAR CLIENTE
  ======================================----->
  <?php
    // $tipoPersona = 'cliente';
    // $pantalla = 'clientes';
    
    // $eliminarCliente = new ControladorPersonas();
    // $eliminarCliente->ctrBorrarPersona($tipoPersona, $pantalla);
  ?>