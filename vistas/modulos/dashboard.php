
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
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol> -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <!-- FUNCION INSERTAR BITACORA -->
     <?php

        //** ALERTA POR FECHA DE VENCIMIENTO */
        $tabla = "tbl_usuarios";
        $item = "id_usuario";
        $valor = $_SESSION["id_usuario"];

        $usuario = ControladorUsuarios::ctrMostrarUsuarios($tabla, $item, $valor);

        $fechaUsuario = $usuario['fecha_vencimiento'];
        $fechaHoy = date('Y-m-d');
        $date1 = new DateTime($fechaHoy);
        $date2 = new DateTime($fechaUsuario);
        $diff = $date1->diff($date2);

        if($diff->days <= 7){

          $mensaje = "Tu usuario vencera en $diff->days dias! Cambia tu contraseña para resetear la fecha de vencimiento.";
          $icono = "info";
        //   $modulo = "dashboard";
          $alerta = ControladorGlobales::ctrAlertas($mensaje, $icono);
          
        }
        
        //**Bitacora
        $descripcionEvento = " Consulto Inicio";
        $accion = "consulta";

        $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 1,$accion, $descripcionEvento);
    
     ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>44</h3>

                <p>Clientes Nuevos</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>    
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gray-dark">
              <div class="inner">
                <h3>65</h3>

                <p>Clientes Sin Pagar</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>    
        </div>
      </div>

      <!-- Default box -->
      <div class="card">
        <div class="card-body">
          <?php
            // $user_os        =   ControladorGlobales::ctrGetOS();
            // $user_browser   =   ControladorGlobales::ctrGetBrowser();
            // $device_details =   "<strong>Browser: </strong>" . $user_browser . 
            //                     "<br /><strong>Operating System: </strong>" . $user_os;
            // print_r($device_details);
            
          ?>
        </div>
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- <script type="text/javascript">
  window.onload = hola();
</script> -->

