
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inventario</h1>
          </div>
          <div class="col-sm-6">
          <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalAgregarCompra">
              Nueva Compra         
          </button>
          <button class="btn btn-danger btnExportarCompras float-right mr-3">
              Exportar PDF          
          </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  

 <!-- Main content -->
    <section class="content">
    <?php 
      $permisoAgregar = $_SESSION['permisos']['Usuarios']['agregar'];
      $permisoEliminar = $_SESSION['permisos']['Usuarios']['eliminar'];
      $permisoActualizar = $_SESSION['permisos']['Usuarios']['actualizar'];
      $permisoConsulta = $_SESSION['permisos']['Usuarios']['consulta'];

      // var_dump($_SESSION['perm']);

      // foreach ($permisos_pantalla as $key => $value) {
      //   echo $key;
      // }
    ?>

<div class="card">

<div class="card-body">
            <!-- CUERPPO INVENTARIO -->
                <table class="table table-striped table-bordered tablas text-center">
                    <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre producto</th>
                    <th scope="col">Tipo Producto</th>
                    <th scope="col">Stock</th>

                    </tr>
                </thead>
                <tbody>
                <?php
                            $tabla = "tbl_inventario";
                            $item = null;
                            $valor = null;
                            $order = null;
                    $inventarios=ControladorInventario::ctrMostrarInventario($tabla, $item, $valor,$order);
                    // echo"<pre>";
                    // var_dump($inventarios);
                    // echo"</pre>";
                    foreach ($inventarios as $key => $value) {
                      echo '
                          <tr>
                              <td scope="row">'.($key+1).'</td>
                              <td>'.$value["codigo"].'</td>
                              <td>'.$value["nombre_producto"].'</td>
                              <td>'.$value["tipo_producto"].'</td>';   
                              $stocktotal = $value["stock"] + $value["devolucion"];
                              echo'  
                              <td>'.$stocktotal.'</td>
                                
                          
                            
                          </tr>
                      ';
                      }
                ?>
                </tbody>
            </table>
            <!-- -------------------------- -->
      </div> 






  </div>