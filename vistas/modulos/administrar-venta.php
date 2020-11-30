<!-- Content Wrapper. Contains page content venta -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-0">
      
        <div class="col-sm-6">
          <h1>Administrar Venta </h1>
        </div>
        
        <div class="col-sm-6">
          <a href="crear-venta" class="btn btn-orange float-right">
              Agregar venta     
          </a> 
        </div>

      </div>
      
    </div><!-- /.container-fluid -->
    
  </section>  
  <section class="content">

                      <?php
                        $descripcionEvento = " Consulto la pantalla de Administracion de Ventas";
                        $accion = "consulta";

                        $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 4,$accion, $descripcionEvento);
    
                      ?>
                   
    <div class="card">
      <div class="card-body">

        <table class="table table-striped table-bordered tablas text-center">

          <thead>

            <tr>

              <th scope="col">#</th>
              <th scope="col">Codigo factura</th>
              <th scope="col">Cliente</th>
              <th scope="col">Vendedor</th>
              <th scope="col">Total Neto</th>
              <th scope="col">Fecha</th>
              <th scope="col">Acciones</th>

            </tr>

          </thead>
          
          <tbody>
            <!-- Traer todo lo que encuentre en la lista -->
            <?php

              $item = null;
              $valor = null;

              $respuesta = ControladorVentas::ctrMostrarVentas($item, $valor);

              // var_dump($respuesta);

              foreach ($respuesta as $key => $value) {
                echo  '<tr>
                        <td>'.($key+1).'</td>
                        
                        <td>'.$value["codigo"].'</td>';

                        $itemCliente = "id_personas";
                        $valorCliente = $value["id_cliente"];
                        $tabla="tbl_clientes";
                        $respuestaCliente = ControladorClientes::ctrMostrarClientes($tabla, $itemCliente, $valorCliente);

                        echo '<td>'.$respuestaCliente["nombre"].'</td>';

                       
                        $itemUsuario = "usuario";
                        $valorUsuario = $value["id_usuario"];
                        $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($tabla, $itemUsuario, $valorUsuario);

                        echo '<td>'.$respuestaUsuario["nombre"].'</td>
                     
                        <td>$ '.number_format($value["total"],2).'</td>

                        <td>'.$value["fecha"].'</td>

                        <td>
                          <div class="btn-group">
                                
                              <button class="btn btn-warning btnEditarVenta"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>

                              <button class="btn btn-danger btnEliminarVenta"><i class="fas fa-trash-alt"></i></button>

                          </div>  
                        </td>

                      </tr>';
                }
            ?>

          </tbody>

        </table>

      <?php

        // $eliminarVenta = new ControladorVentas();
        // $eliminarVenta -> ctrEliminarVenta();

      ?>

      </div>

    </div>

  </section>

</div>
   
 

