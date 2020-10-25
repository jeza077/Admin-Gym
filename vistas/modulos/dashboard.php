
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- FUNCION INSERTAR BITACORA -->
     <?php
  	  $descripcionEvento = " Consulto Inicio";
      $accion = "consulta";

      $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 1,$accion, $descripcionEvento);
    
     ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Dashboard</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <?php
                // $item1 = "usuario";
                // $valor1 = "JEZA";
                // $item2 = "rol";
                // $valor2 = "Administrador";

                // $modulos = ControladorUsuarios::ctrMostrarUsuarioModulo($item1, $item2, $valor1, $valor2);

                // $user_os        =   ControladorGlobales::ctrGetOS();
                // $user_browser   =   ControladorGlobales::ctrGetBrowser();
                // $device_details =   "<strong>Browser: </strong>" . $user_browser . 
                //                     "<br /><strong>Operating System: </strong>" . $user_os;
                // print_r($device_details);
                    
        // $item = "num_documento";
        // $valor = "3242234234";
        
        // $respuesta = ControladorPersonas::ctrMostrarDocumento($item, $valor);
        // var_dump($respuesta);
            
          ?>

        </div>
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


