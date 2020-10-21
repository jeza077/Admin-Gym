
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
                // $user_os        =   ControladorGlobales::ctrGetOS();
                // $user_browser   =   ControladorGlobales::ctrGetBrowser();
                // $device_details =   "<strong>Browser: </strong>" . $user_browser . 
                //                     "<br /><strong>Operating System: </strong>" . $user_os;
                // print_r($device_details);

                $item1 = "usuario";
                $valor1 = $_SESSION["usuario"];
                $item2 = "rol";
                $valor2 = $_SESSION["rol"];

                $modulos = ControladorUsuarios::ctrMostrarUsuarioModulo($item1, $item2, $valor1, $valor2);

                var_dump($modulos);

                // $grupo_modulo = array();
                // foreach($modulos as $modulo) {
                //   $modulo_padre = $modulo['objeto'];
                //   $icono_objeto = $modulo['icono'];
                //   $link_objeto = $modulo['link_objeto'];

                //   // $objetos = array(
                //   //   'link_objeto' => $modulo['link_objeto'],
                //   //   'icono_objeto' => $modulo['icono'];
                //   // );

                //   // $sub_modulos = array(
                //   //   'sub_modulo' => $modulo['sub_modulo'],
                //   //   'link_sub_modulo' => $modulo['link_sub_modulo']
                //   // );
                  
                //   $grupo_modulo[$link_objeto][$icono_objeto][] = $modulo_padre;
         
                // }

                //   echo "<pre>";
                //     var_dump($grupo_modulo);
                //   echo "</pre>";

                

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

