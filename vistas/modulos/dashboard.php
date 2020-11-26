
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
          <?php 
            include "inicio/cajas-superiores.php";
          ?>    
        </div>

        <div class="row">
          <div class="col-md-6 col-xs-12">
            <?php 
              include "reportes/productos-mas-vendidos.php";
            ?>    
          </div>
        </div>
      </div>

      <!-- Default box -->
      <!-- <div class="card">
        <div class="card-body">
          <?php
            // $user_os        =   ControladorGlobales::ctrGetOS();
            // $user_browser   =   ControladorGlobales::ctrGetBrowser();
            // $device_details =   "<strong>Browser: </strong>" . $user_browser . 
            //                     "<br /><strong>Operating System: </strong>" . $user_os;
            // print_r($device_details);
            
          ?>
        </div>
        
      </div> -->
      <!-- /.card -->

    </section>

  </div>

