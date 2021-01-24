
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inventario</h1>
          </div>
          <div class="col-sm-6">
          <button class="btn btn-danger btnExportarInventario float-right mr-3">
              Exportar PDF          
          </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  

    <!-- Main content -->
    <section class="content">
      <?php 
        $permisoAgregar = $_SESSION['permisos']['Usuarios']['agregar'];
        $permisoEliminar = $_SESSION['permisos']['Usuarios']['eliminar'];
        $permisoActualizar = $_SESSION['permisos']['Usuarios']['actualizar'];
        $permisoConsulta = $_SESSION['permisos']['Usuarios']['consulta'];
      ?>

      <div class="card">

        <div class="card-body">
                <!-- CUERPPO INVENTARIO -->
          <table class="table table-striped table-bordered tablaInventario text-center">
              <thead>
                  <tr>
                  <th scope="col">#</th>
                  <th scope="col">Codigo</th>
                  <th scope="col">Nombre producto</th>
                  <th scope="col">Tipo Producto</th>
                  <th scope="col">Stock</th>

                  </tr>
              </thead>

          </table>
          
          </div> 
      </div>
    </section>  
  </div>
