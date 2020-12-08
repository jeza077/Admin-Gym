
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Compras</h1>
          </div>
          <div class="col-sm-6">
          <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalAgregarCompra">
              Comprar Producto       
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
                    <th scope="col">Nombre producto</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Fecha</th>
                  
                    </tr>
                </thead>
                <tbody>
                <?php
                    $tabla = "tbl_compras";
                    $item = null;
                    $valor = null;
                    $compras=ControladorInventario::ctrMostrarCompras($tabla, $item, $valor);
                    // echo"<pre>";
                    // var_dump($compras);
                    // echo"</pre>";
                    foreach ($compras as $key => $value) {
                      echo '
                          <tr>
                              <td scope="row">'.($key+1).'</td>
                              <td>'.$value["nombre_producto"].'</td>
                              <td>'.$value["nombre"].'</td>                                                                           
                              <td>'.$value["cantidad"].'</td>
                              <td>'.$value["precio"].'</td>  
                              <td>'.$value["fecha"].'</td>    
                            
                          </tr>
                      ';
                      }
                ?>
                </tbody>
            </table>
            <!-- -------------------------- -->
      </div> 



<!-- =======================================
           MODAL AGREGAR COMPRA
  ======================================----->
  <div class="modal fade" id="modalAgregarCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Compra</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body">
            <form role="form" method="post" class="formulario" enctype="multipart/form-data">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="datosPersona" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Inventario</a>
                </li>
              </ul>
              
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="datosPersona">
                  <div class="container-fluid mt-4">
                  <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="">Producto<?php echo $i?></label>
                        <select class="form-control select2 "  id="nuevoProducto" style="width: 100%;" name="nuevoProducto">                           
                            <option selected="selected">Seleccionar...</option>
                            <?php 
                                $tabla = "tbl_inventario";
                                $item = null;
                                $valor = null;
                                $preguntas = ControladorInventario::ctrMostrarTipoProducto($tabla, $item, $valor);
                                foreach ($preguntas as $key => $value) { ?>
                                    <option value="<?php echo $value['id_inventario']?>"><?php echo $value['nombre_producto']?></option>        
                                <?php 
                                }
                            ?>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                      <label for="">proveedor<?php echo $i?></label>
                        <select class="form-control select2 "  id="nuevoProveedor" style="width: 100%;" name="nuevoProveedor">                           
                            <option selected="selected">Seleccionar...</option>
                            <?php 
                                $tabla = "tbl_proveedores";
                                $item = null;
                                $valor = null;
                                $preguntas = ControladorInventario::ctrMostrarProveedores($tabla, $item, $valor);
                                foreach ($preguntas as $key => $value) { ?>
                                    <option value="<?php echo $value['id_proveedor']?>"><?php echo $value['nombre']?></option>        
                                <?php 
                                }
                            ?>
                        </select>
                      </div>
                    </div>
        
                  <div class="form-row">

                      <div class="form-group col-md-4">
                        <label for="stock">Cantidad</label>
                        <input type="number" class="form-control stock" id="nuevoCantidad" name="nuevoCantidad" placeholder="Cantidad en stock" min="0" required class="fa fa-arrow-up"></i></span>
                      </div>
     
                      <div class="form-group col-md-3">
                        <label for="stock">Precio</label>
                        <input type="number" class="form-control stock" id="nuevoPrecio" name="nuevoPrecio" placeholder="Cantidad en stock" min="0" required class="fa fa-arrow-up"></i></span>
                      </div>
                  </div>

                    <div class="form-group mt-4 float-right">
                      <button type="" class="btn btn-primary">Guardar</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                      </div>
                  

                      <?php
                      // $tipostock = 'productos';
                      $pantalla = 'compras';
                      $AgregarInventario = new ControladorInventario();
                      $AgregarInventario->ctrCrearCompra($pantalla);
                      ?>
                    </div>
                  </div>

                  
                </div>
                    <!-- 2tab --> 
              </div>

            </form>
          </div>
      </div>
    </div>
  </div>


 <!-- =======================================
           MODAL EDITAR
  ======================================----->

  <div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" class="formulario" enctype="multipart/form-data">
            
           
                  <div class="form-row">
                    
                    <div class="form-group col-md-3">
                      <label for="nombreproducto">Codigo</label>
                      <input type="text" value="" class="form-control" readonly id="editarCodigo" name="editarCodigo"  required>
                      <input type="hidden" name="editarTipoProducto" id="editarTipoProducto">
                    </div>
                    
                    <div class="form-group col-md-3">
                      <label for="nombreproducto">Nombre Producto</label>
                      <html>
                      <input type="text" value="" class="form-control mayus editar_Nombre_Producto"  name="editarNombreProducto" id="editarNombreProducto" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="nombreproducto">Proveedor</label>
                        <html>
                        <input type="text" class="form-control mayus proveedor" name="editarProveedor" id="editarProveedor" placeholder="Nuevo Proveedor" required>
                      </div>
                    <div class="form-group col-md-3">
                      <label for="stock">Cantidad en stock</label>
                      <input type="number" value="" class="form-control" name="editarStock" id="editarStock"  min="0" required class="fa fa-arrow-up"></i></span>
                    </div>
                  </div>
      
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="precio">Precio Venta</label>
                        <input type="text" value="" class="form-control editar_Precio" name="editarPrecio" id="editarPrecio" required>
                        </div>
                        <div class="form-group col-md-4">
                        <label for="precio">Precio compra</label>
                        <input type="text" value="" class="form-control editar_Precio" name="editarPrecioCompra" id="editarPrecioCompra" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="productominimo">Producto Minimo</label>
                          <input type="number" value="" class="form-control" name="editarProductoMinimo" id="editarProductoMinimo" min="0" required class="fa fa-arrow-up"></i></span>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="productomaximo">Producto Maximo</label>
                          <input type="number" value="" class="form-control" name="editarProductoMaximo" id="editarProductoMaximo" min="0" required class="fa fa-arrow-up"></i></span>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-5">
                            <label for="exampleInputFile">Foto</label>
                            <div class="input-group">
                            <img class="img-thumbnail previsualizar mr-2" src="vistas/img/usuarios/default/anonymous.png" alt="imagen-del-usuario" width="100px">
                            <input type="hidden" name="imagenActual" id=imagenActual>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input nuevaFotoProducto" id="exampleInputFile" name="editarFotoProducto">
                                <label class="custom-file-label" for="exampleInputFile">Escoger foto</label>
                            </div>
                            </div>
                                <p class="p-foto help-block ml-4">Peso máximo de la foto 2 MB</p>
                        </div>
                    </div>

                    <div class="form-group mt-4 float-right">
                        <button type="" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                    </div>
                
                    <?php
                    $tipostock = 'producto';
                    $pantalla = 'compras';
                    $EditarInventario = new ControladorInventario();
                    $EditarInventario->ctrEditarStock($tipostock, $pantalla);
                    ?>
                  <!-- 2tab --> 
          </form>
        </div>
      </div>
    </div>
  </div>



  </div>