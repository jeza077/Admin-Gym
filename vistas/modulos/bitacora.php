<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bitácora</h1>
          </div>

          <div class="col-sm-6">
            <button class="btn btn-danger btnExportarBitacora float-right mr-3">
                Exportar PDF          
            </button> 

            <!-- <button type="button" class="btn btn-default float-right mr-3" id="daterange-btn-bitacora">
              <span>
                <i class="far fa-calendar-alt"></i> Rango de fechas
              </span>
              <i class="fas fa-caret-down"></i>
          </button> -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php
      $descripcionEvento = "".$_SESSION["usuario"]." Consultó la pantalla de bitácora";
      $accion = "Consulta";

      $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 26,$accion, $descripcionEvento);

    ?>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
     
        <div class="card-body">

          <table class="table table-bordered table-striped tablaBitacora text-center">
            <thead>
              <tr>
                <th width="15px">N.°</th>
                <th width="100px">Usuario</th>
                <th width="100px">Objeto</th>
                <th width="100px">Acción</th>
                <th width="100px">Descripción</th>
                <th width="100px">Fecha</th>
                <th width="100px">Depurar</th> 
              </tr>
            </thead>
          </table>

        </div>
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- =======================================
  ELIMINAR BITACORA
  ======================================----->
  <?php 
    $pantalla = 'bitacora';
    $borrarUsuario = new ControladorPersonas();
    $borrarUsuario->ctrBorrarBitacora($pantalla);
  ?>