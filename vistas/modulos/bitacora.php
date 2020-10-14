<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bitacora</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
     
        <div class="card-body">

        <table class="table table-bordered table-striped tablas text-center">
                  <thead>
                    <tr>
                    <!-- Esto es un comentario cambiar arriba  -->
                      <th width="15px">Id</th>
                 
                      <th width="100px">Usuario</th>
                      <th width="100px">Objeto</th>
                      <th width="100px">Accion</th>
                      <th width="100px">Descripcion</th>
                      <th width="100px">Fecha</th>
                     
                    </tr>
                  </thead>

                  <tbody>
                  <?php
                  $item=null;
                  $valor=null;
                  $Bitacora=ControladorMantenimientos::ctrMostrarBitacora( $item, $valor);

                  // var_dump($Bitacora);
                
                  foreach ($Bitacora as $key => $value){
                    echo ' <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["usuario"].'</td>
                    <td>'.$value["nombre_modulo"].'</td>
                    <td>'.$value["accion"].'</td>
                    <td>'.$value["descripcion"].'</td>
                    <td>'.$value["fecha"].'</td>
                   
                  </tr>';
                  
                  }
                  
                  
                  
                  ?>
                   

                   
                   
                  </tbody>

                  <tfoot>
                    <tr>
                    <th width="15px">Id</th>
                 
                 <th width="100px">Usuario</th>
                 <th width="100px">Objeto</th>
                 <th width="100px">Accion</th>
                 <th width="100px">Descripcion</th>
                 <th width="100px">Fecha</th>
                    </tr>
                  </tfoot>
                </table>
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

            
          ?>

        </div>
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->