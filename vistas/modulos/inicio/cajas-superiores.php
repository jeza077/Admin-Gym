<?php 
    
    $ventas = ControladorVentas::ctrSumaTotalVentas();
    
    $item = 'tipo_producto';
    $valor = 'Productos';
    $order = null;
    $tabla = 'tbl_inventario';
    $productos = ControladorInventario::ctrMostrarInventario($tabla, $item, $valor,$order);
    $totalProductos = count($productos);

    $valor = 'Bodega';
    $equipo = ControladorInventario::ctrMostrarInventario($tabla, $item, $valor,$order);
    $totalEquipo = count($equipo);

    $tabla = 'tbl_clientes';
    $item = null;
    $valor = null;
    $clientes = ControladorClientes::ctrMostrarClientes($tabla, $item, $valor);
    $totalClientes = count($clientes);

    // echo '<pre>';
    // var_dump($totalEquipo);
    // echo '</pre>';

?>

<div class="col-lg-3 col-md-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-orange">
        <div class="inner">
        <h3>L<?php echo number_format($ventas[0]["total"],2);?><sup style="font-size: 20px"></sup></h3>

        <p>Ventas totales</p>
        </div>
        <div class="icon">
        <i class="fas fa-dollar-sign"></i>
        </div>
        <a href="administrar-venta" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
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
        <a href="clientes" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>    

<div class="col-lg-3 col-md-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-purple">
        <div class="inner">
        <h3><?php echo number_format($totalProductos);?></h3>

        <p>Total de productos</p>
        </div>
        <div class="icon">
        <i class="ion ion-bag"></i>
        </div>
        <a href="productos" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-md-6 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-gray-dark">
        <div class="inner">
        <h3><?php echo number_format($totalEquipo);?></h3>

        <p>Total de equipo</p>
        </div>
        <div class="icon">
        <i class="fas fa-dumbbell"></i>
        </div>
        <a href="equipo" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>