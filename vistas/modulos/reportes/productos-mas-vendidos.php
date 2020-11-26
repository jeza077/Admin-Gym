<?php 

$item = 'tipo_producto';
$valor = 'Productos';
$order = 'venta';
$tabla = 'tbl_inventario';
$productos = ControladorInventario::ctrMostrarTotalInventario($tabla, $item, $valor,$order);

$colores = array("red","green","yellow","aqua","purple","blue","cyan","magenta","orange","gold");

$totalVentas = ControladorInventario::ctrMostrarSumaVentas($tabla);
// echo "<pre>";
// var_dump($productos[0]['venta']);
// echo "</pre>";
// $producto = array();
//     $cantidad = array();
//     $count = count($productos);

//     for ($i=0; $i < $count; $i++) { 
//         array_push($producto, $productos[$i]['nombre_producto']);
//         echo "<pre>";
//         var_dump($producto);
//         echo "</pre>";
//     }

?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Productos más vendidos</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="chart-responsive">
                    <canvas id="pieChart" height="150"></canvas>
                </div>
            <!-- ./chart-responsive -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
                <ul class="chart-legend clearfix">

                    <?php

                        for ($i=0; $i < 5; $i++) { 
                            echo '<li><i class="far fa-circle text-'.$colores[$i].'"></i>'.$productos[$i]["nombre_producto"].'</li>';
                        }

                    ?>

                </ul>
            </div>
            <!-- /.col -->
        </div>
    <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer bg-light p-0">
        <ul class="nav nav-pills flex-column">
            <?php

                for ($i=0; $i < 5; $i++) { 
                    echo '<li class="nav-item">
                            <a href="#" class="nav-link">
                               '.$productos[$i]["nombre_producto"].'
                                <span class="float-right text-'.$colores[$i].'">
                                <i class="fas fa-arrow-down text-sm"></i>
                                '.ceil($productos[$i]["venta"]*100/$totalVentas["total"]).'%</span>
                            </a>
                        </li>';
                }
                    
            ?>
        </ul>
    </div>
    <!-- /.footer -->
</div>
<!-- /.card -->

<script src="vistas/plugins/jquery/jquery.min.js"></script>
<script src="vistas/plugins/chart.js/Chart.min.js"></script>

<script>
  //-------------
  // - PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieData = {

    <?php 
        $producto = array();
        $cantidad = array();
        $count = count($productos);

        for ($i=0; $i < $count; $i++) { 
            array_push($producto, $productos[$i]['nombre_producto']);
        }
        // echo "<pre>";
        var_dump($producto);
        // echo "</pre>";
    ?>
    labels: [
      'Chrome',
      'IE',
      'FireFox',
      'Safari',
      'Opera',
      'Navigator'
    ],
    datasets: [
      {
        data: [700, 500, 400, 600, 300, 100],
        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de']
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: false
    }
  }
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  // eslint-disable-next-line no-unused-vars
  var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions
  })

  //-----------------
  // - END PIE CHART -
  //-----------------
 
</script>