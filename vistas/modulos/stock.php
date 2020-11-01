
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>STOCK</h1>
          </div>
          <div class="col-sm-6">
          <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalAgregarInventario">
            Agregar         
          </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  

 <!-- Main content -->
    <section class="content">
    <?php 
      $permisoAgregar = $_SESSION['permisos']['Stock']['agregar'];
      $permisoEliminar = $_SESSION['permisos']['Stock']['eliminar'];
      $permisoActualizar = $_SESSION['permisos']['Stock']['actualizar'];
      $permisoConsulta = $_SESSION['permisos']['Stock']['consulta'];

      // var_dump($_SESSION['perm']);

      // foreach ($permisos_pantalla as $key => $value) {
      //   echo $key;
      // }
    ?>



<!-- TAB PRINCIPAL -->
<div class="card">
    <div class="card-header">  
        <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="inventario" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Inventario</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="bodega" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Bodega</a>
        </li>
        </ul>
    </div>
              <!-- TAB INVENTARIO -->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="inventario">
        <div class="container-fluid mt-4">
            <div class="card-body">
            <!-- CUERPPO INVENTARIO -->
                <table class="table table-striped table-bordered tablas text-center">
                    <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">id inventario</th>
                    <th scope="col">tipo producto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">stock</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Product min</th>
                    <th scope="col">Produc max</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $tabla = "tbl_inventario";
                    $item = null;
                    $valor = null;
                    $inventarios=ControladorInventario::ctrMostrarInventario($tabla, $item, $valor);
                    foreach ($inventarios as $key => $value) {
                    echo '
                            <tr>
                            <th scope="row">1</th>
                            <td>'.$value["id_inventario"].'</td>
                            <td>'.$value["tipo_producto"].'</td>
                            <td>'.$value["nombre_producto"].'</td>
                            <td>'.$value["stock"].'</td>
                            <td>'.$value["precio"].'</td>
                            <td>'.$value["producto_minimo"].'</td>
                            <td>'.$value["producto_maximo"].'</td>';
                        echo '     
                            <td>
                            <button class="btn btn-warning"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    ';
                    }
                ?>
                </tbody>
            </table>
            <!-- -------------------------- -->
            </div>   <!-- CARD BODY --> 
        </div>
        </div><!-- FIN TAB INVENTARIO -->

            <!-- TAB BODEGA -->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="bodega">
            <div class="container-fluid mt-3">
                <div class="card-body">
                    <table class="table table-striped table-bordered tablas text-center">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">id inventario</th>
                            <th scope="col">tipo producto</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">stock</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Product min</th>
                            <th scope="col">Produc max</th>
                            <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $tabla = "tbl_inventario";
                            $item = null;
                            $valor = null;
                            $inventarios=ControladorInventario::ctrMostrarInventario($tabla, $item, $valor);
                            foreach ($inventarios as $key => $value) {
                            echo '
                                    <tr>
                                    <th scope="row">1</th>
                                    <td>'.$value["id_inventario"].'</td>
                                    <td>'.$value["tipo_producto"].'</td>
                                    <td>'.$value["nombre_producto"].'</td>
                                    <td>'.$value["stock"].'</td>
                                    <td>'.$value["precio"].'</td>
                                    <td>'.$value["producto_minimo"].'</td>
                                    <td>'.$value["producto_maximo"].'</td>';
                                echo '     
                                    <td>
                                    <button class="btn btn-warning"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>
                                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            ';
                            }
                        ?>
                        </tbody>
                    </table>
                <!-- -------------------------- -->
                </div> 
            </div>
        </div> 
           </div>  
      </div>    
 </div> <!-- Fin del TAB -->


