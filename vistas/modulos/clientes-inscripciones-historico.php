
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
          <button class="btn btn-danger btnExportarClientesInscripcionesHistorico float-right mr-3">
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
        
        $descripcionEvento = "".$_SESSION["usuario"]." Consulto la pantalla de cliente inscripciones histórico";
        $accion = "Consulta";

        $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

      ?>

      <div class="card">

          <div class="card-body">
          
            <table class="table table-striped table-bordered tablaClientesInscripcionesHistorico text-center">
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

            </table>
          </div>
      </div>
    </section>
  </div>