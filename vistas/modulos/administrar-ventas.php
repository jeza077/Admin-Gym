<!-- Content Wrapper. Contains page content venta -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-0">
      
        <div class="col-sm-6">
          <h1>Administrar venta </h1>
        </div>
        
        <div class="col-sm-6">
          <a href="crear-venta" class="btn btn-orange float-right">
              Nueva venta     
          </a> 
          
          <button class="btn btn-danger btnExportarVentas float-right mr-3">
            Exportar PDF          
          </button>

          <!-- <button type="button" class="btn btn-default float-right mr-3" id="daterange-btn">
            <span>
              <i class="far fa-calendar-alt"></i> Rango de fechas
            </span>
            <i class="fas fa-caret-down"></i>
          </button> -->

        </div>

      </div>
      
    </div><!-- /.container-fluid -->
    
  </section>  
  <section class="content">

    <?php
      $descripcionEvento = "".$_SESSION["usuario"]." Consultó la pantalla de administrar ventas";
      $accion = "Consulta";

      $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 14,$accion, $descripcionEvento);

      // var_dump($_SESSION['permisos']);
    ?>
                   
    <div class="card">
      <div class="card-body">

        <table class="table table-striped table-bordered tablaVentas text-center">

          <thead>

            <tr>
              <th scope="col">N.°</th>
              <th scope="col">Código factura</th>
              <th scope="col">Cliente</th>
              <th scope="col" width="15px">Productos</th>
              <th scope="col">Impuesto</th>
              <th scope="col">Subtotal</th>
              <th scope="col">Total neto</th>
              <th scope="col">Fecha compra</th>
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
              // var_dump($respuesta[0]['productos']);
              // echo "</pre>";

              // $decod = json_decode($respuesta[0]['productos']);
              // foreach ($respuesta as $key => $value) {
              //   $decodif = json_decode($value['productos']);
              //   echo "<pre>";
              //   var_dump(($decodif));
              //   echo "</pre>";

              //   foreach ($decodif as $key => $val) {
              //     echo "<pre>";
              //     var_dump($val->descripcion);
              //     echo "</pre>";
                  
              //   }
              // }
              // echo "<pre>";
              // var_dump($decod);
              // echo "</pre>";

              // $decod = json_decode($value['productos']);
              // foreach ($decod as $value) {
              //   var_dump($value->descripcion);
              // //  echo  $value->descripcion;
              // }
              foreach ($respuesta as $key => $value) {

                // var_dump($value['productos']);
                echo  '<tr>
                        <td>'.($key+1).'</td>
                        
                        <td>'.$value["numero_factura"].'</td>';

                        // echo '<td>'.$value["nombre"].'</td>';

                        echo '<td>'.$value["nombre"].' '.$value['apellidos'].'</td>';

                        // echo '<td>'.$value['productos'].'</td>'; 
                        echo '<td>';
                          error_reporting(0);
                          
                          $decod = json_decode($value['productos']);
                          foreach ($decod as $key => $val) {
                            $contador = count($val->descripcion);
                            // echo ($contador);
                            if($contador == 11){
                              // echo 'mas de uno';
                               echo  $val->descripcion.',';
                            } else {
                              echo  $val->descripcion.'('.$val->cantidad.'), ';
                              // echo 'solo uno';

                              // echo  $val->descripcion;

                            }
                          }
                        echo '</td>'; 
                        
                        echo '<td>L. '.number_format($value["impuesto"],2).'</td>

                        <td>L. '.number_format($value["neto"],2).'</td>
                        
                        <td>L. '.number_format($value["total"],2,".","").'</td>

                        <td>'.$value["fecha"].'</td>

                        <td>
                          <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["numero_factura"].'"><i class="fa fa-print" style="color:#fff"></i></button>  

                          <button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id_venta"].'"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>   

                          <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id_venta"].'"><i class="fas fa-trash-alt"></i></button>
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
   
 

