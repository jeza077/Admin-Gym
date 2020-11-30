<?php 

$item = 'tipo_producto';
$valor = 'Productos';
$order = 'venta';
$tabla = 'tbl_inventario';
$productos = ControladorInventario::ctrMostrarTotalInventario($tabla, $item, $valor,$order);

$colores = array("red","green","yellow","lightblue","purple","blue","cyan","magenta","orange","gold");

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
var order = 'venta';
var datos = new FormData();
datos.append('order', order);   

$.ajax({

    url:"ajax/inventario.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,  
    dataType: "json",
    success: function (respuesta) {

        var nombreProducto = [];
        var ventas = [];
        for (let i = 0; i < respuesta.length; i++) {
            // console.log(respuesta[i]['nombre_producto']);
            nombreProducto.push(respuesta[i]['nombre_producto']);
            ventas.push(respuesta[i]['venta']);
        }

        var contenedor = '#pieChart';
        var tipoChart = 'pie';
        var colores = [];

        crearGrafico(contenedor, nombreProducto, ventas, tipoChart, colores)
    }
});


 
</script>