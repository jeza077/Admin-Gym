
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Historial Pagos Clientes</h1>
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
                  <th scope="col">Nombre</th>
                  <th scope="col">Tipo Inscripcion</th>
                  <th scope="col">Ultimo Pago</th>
                  <th scope="col">Fecha Ultimo Pago</th>
                  <th scope="col">Fecha Vencimiento</th>
                  <!-- <th scope="col">Estado</th>
                  <th scope="col">Acciones</th> -->
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
                $max = null;
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
                      <td>'.$value["fecha_ultimo_pago"].'</td>
                      <td>'.$value["fecha_vencimiento"].'</td>';
                }
              ?>
              </tbody>
            </table>
          </div>
      </div>
    </section>
  </div>