
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
          <button class="btn btn-orange float-right">Agregar Usuario</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php
		       $descripcionEvento = "Consulto Usuario";
	         $accion = "Consulta";
  
	         $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 2,$accion, $descripcionEvento);
	  
	      ?>

    <!-- Main content -->
    <section class="content">
    <?php 
      $permisoAgregar = $_SESSION['permisos']['Usuarios']['agregar'];
      $permisoEliminar = $_SESSION['permisos']['Usuarios']['eliminar'];
      $permisoActualizar = $_SESSION['permisos']['Usuarios']['actualizar'];
      $permisoConsulta = $_SESSION['permisos']['Usuarios']['consulta'];

      // var_dump($_SESSION['perm']);

      // foreach ($permisos_pantalla as $key => $value) {
      //   echo $key;
      // }
    ?>


      <!-- Default box -->
      <div class="card">
              <!-- <div class="card-header">
                <button class="btn btn-orange float-right">Agregar Usuario</button>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped tablas text-center">
                  <thead>
                    <tr>
                      <th width="15px">#</th>
                      <th>Nombre</th>
                      <th width="100px">Usuario</th>
                      <th width="100px">Foto</th>
                      <th width="100px">Estado</th>
                      <?php if($permisoActualizar == 1 && $permisoEliminar == 1){?>
                        <th width="100px">Acciones</th>
                      <?php }?>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td>01</td>
                      <td>Jesús Zuniga</td>
                      <td>JEZA</td>
                      <td>foto.jpg</td>
                      <td><button class="btn btn-success btn-md">Activo</button></td>

                      <?php if($permisoActualizar == 1 && $permisoEliminar == 1){?>
                      <td>
                        <div class="btn-group">
                        <?php if($permisoActualizar == 1){?>
                          <button class="btn btn-warning" style="color:white;"><i class="fas fa-pen"></i></button>
                        <?php }?>
                        <?php if($permisoEliminar == 1){?>
                          <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        <?php }?>
                        </div>
                      </td>
                      <?php }?>
                    </tr>

                  </tbody>

                  <!-- <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Usuario</th>
                      <th>Foto</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </tfoot> -->
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

