<?php 
    
    $ventas = ControladorVentas::ctrSumaTotalVentas();
    
    $item = 'tipo_producto';
    $valor = 'Productos';
    $order = null;
    $tabla = 'tbl_inventario';
    $productos = ControladorInventario::ctrMostrarInventario($tabla, $item, $valor,$order);
    $totalProductos = count($productos);

    $tabla = 'tbl_clientes';
    $item = null;
    $valor = null;
    $clientes = ControladorClientes::ctrMostrarClientes($tabla, $item, $valor);
    $totalClientes = count($clientes);

    // echo '<pre>';
    // var_dump($clientes);
    // echo '</pre>';

?>

<div class="col-lg-3 col-md-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-purple">
        <div class="inner">
        <h3>150</h3>

        <p>New Orders</p>
        </div>
        <div class="icon">
        <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-md-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
        <h3><?php echo number_format($totalClientes);?></h3>

        <p>Clientes</p>
        </div>
        <div class="icon">
        <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>    

<div class="col-lg-3 col-md-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-orange">
        <div class="inner">
        <h3>L<?php echo number_format($ventas[0]["total"],2);?><sup style="font-size: 20px"></sup></h3>

        <p>Ventas</p>
        </div>
        <div class="icon">
        <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-md-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-gray-dark">
        <div class="inner">
        <h3><?php echo number_format($totalProductos);?></h3>

        <p>Total de Productos</p>
        </div>
        <div class="icon">
        <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>