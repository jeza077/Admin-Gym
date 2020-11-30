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
              Nueva Venta     
          </a> 
          
          <button class="btn btn-danger btnExportarVentas float-right mr-3">
            Exportar PDF          
          </button>

          <button type="button" class="btn btn-default float-right mr-3" id="daterange-btn">
            <span>
              <i class="far fa-calendar-alt"></i> Rango de fechas
            </span>
            <i class="fas fa-caret-down"></i>
          </button>

        </div>

      </div>
      
    </div><!-- /.container-fluid -->
    
  </section>  
  <section class="content">
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

              if(isset($_GET["fechaInicial"])){

                $fechaInicial = $_GET["fechaInicial"];
                $fechaFinal = $_GET["fechaFinal"];

              } else {

                $fechaInicial = null;
                $fechaFinal = null;

              }
      
              $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
              // echo "<pre>";
              // var_dump($respuesta);
              // echo "</pre>";

              foreach ($respuesta as $key => $value) {
                echo  '<tr>
                        <td>'.($key+1).'</td>
                        
                        <td>'.$value["numero_factura"].'</td>';

                        echo '<td>'.$value["nombre"].'</td>';

                        echo '<td>'.$value["nombre"].' '.$value['apellidos'].'</td>
                     
                        <td>$ '.number_format($value["total"],2).'</td>

                        <td>'.$value["fecha"].'</td>

                        <td>
                          <div class="btn-group">
                                
                             
                              <button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id_venta"].'"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>   

                              <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id_venta"].'"><i class="fas fa-trash-alt"></i></button>

                          </div>  
                        </td>

                      </tr>';
                }
            ?>

          </tbody>

        </table>

      <?php

        $eliminarVenta = new ControladorVentas();
        $eliminarVenta -> ctrEliminarVenta();

      ?>

      </div>

    </div>

  </section>

</div>
   
 

