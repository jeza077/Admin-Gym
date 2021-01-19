
  <div class="content-wrapper">
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
      </div>
    </section>

     <?php

      include 'inicio/alertas.php';

        //**Bitacora
        $descripcionEvento = " Consulto Inicio";
        $accion = "consulta";

        $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 1,$accion, $descripcionEvento);
    
     ?>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php 
            include "inicio/cajas-superiores.php";
          ?>    
        </div>

        <div class="row mb-3">
          <div class="col-md-12 col-xs-12">
            <?php 
              // include "reportes/grafico-pago-clientes.php";
            ?>    
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 col-xs-12">
            <?php 
              include "reportes/grafico-venta.php";
            ?>    
          </div>
          <div class="col-md-6 col-xs-12">
            <?php 
              include "reportes/productos-mas-vendidos.php";
            ?>    
          </div>
        </div>
      </div>

          <?php
            // $user_os        =   ControladorGlobales::ctrGetOS();
            // $user_browser   =   ControladorGlobales::ctrGetBrowser();
            // $device_details =   "<strong>Browser: </strong>" . $user_browser . 
            //                     "<br /><strong>Operating System: </strong>" . $user_os;
            // print_r($device_details);
            
          ?>

    </section>

  </div>

