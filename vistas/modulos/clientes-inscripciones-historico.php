
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clientes Inscripciones Historico</h1>
          </div>
          <div class="col-sm-6">
          <!-- <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalAgregarCliente">
            Nuevo Cliente       
          </button> -->
          <button class="btn btn-danger btnExportarHistorialPagosClientes float-right mr-3">
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
                  <th scope="col">No. Documento</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">T. Inscripcion</th>
                  <th scope="col">F. Inscripcion</th>
                  <th scope="col">F. Ultimo Pago</th>
                  <th scope="col">F. Proxim Pago</th>
                  <th scope="col">Deuda</th>
                  <th scope="col">Estado</th>
                  <!-- <th scope="col">Acciones</th> -->
                </tr>
              </thead>
              <tbody>
                <?php 

                  $tabla = "tbl_clientes";
                  $item1 = 'tipo_cliente';
                  $valor1 = 'Gimnasio';
                  $item2 = 'estado';
                  $valor2 = 0;
                  $max = null;
                  $clientes = ControladorClientes::ctrMostrarClientesInscripcionPagos($tabla, $item1, $valor1, $item2, $valor2, $max);

                  // echo "<pre>";
                  // var_dump($clientes);
                  // echo "</pre>";
                  // return;


                  foreach ($clientes as $key => $value) {

                    echo '
                        <tr>
                        <th scope="row">'.($key+1).'</th>
                        <td>'.$value["num_documento"].'</td>
                        <td>'.$value["nombre"].' '.$value["apellidos"].'</td>
                        <td>'.$value["tipo_inscripcion"].'</td>
                        <td>'.$value["fecha_inscripcion"].'</td>
                        <td>'.$value["fecha_pago"].'</td>';    
                        
                        $fecha_actual = strtotime(date("Y-m-d"));
                        $fecha_entrada = strtotime($value['fecha_proximo_pago']);

                        if($fecha_actual < $fecha_entrada){  
                            echo '<td class="badge badge-success mt-2" data-toggle="tooltip" data-placement="left" title="Inscrito">'.$value["fecha_proximo_pago"].'</td>';
                            
                        } else {
                            echo '<td class="badge badge-danger mt-2" data-toggle="tooltip" data-placement="left" title="Inscripcion Cancelada">'.$value["fecha_proximo_pago"].'</td>';
                        }

                         
                        if($fecha_actual > $fecha_entrada){
                          
                          $diasInscripcion = $value['cantidad_dias'];
                          $segundos = $fecha_entrada - $fecha_actual;
                          $dias = $segundos / 86400;
                          $diasFinal = ceil($dias / $diasInscripcion);
                          // echo $diasFinal;

                          $deuda = abs($value['precio_inscripcion'] * $diasFinal);
    
                          echo '<td>L.'.$deuda.'</td>';
                        
                        } else {
                          echo '<td data-toggle="tooltip" data-placement="left" title="No debe">L.0000.00</td>';

                        }
                    
                        if($value['estado'] != 0){
                          echo '<td><span class="badge badge-success p-3">A</span></td>';
                        } else {
                          echo '<td><span class="badge badge-danger p-3">D</span></td>';
                        }
                  }
                ?>
              </tbody>
            </table>
          </div>
      </div>
    </section>
  </div>