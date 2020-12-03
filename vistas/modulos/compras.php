
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
          <button class="btn btn-danger btnExportarProductos float-right mr-3">
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


<div class="modal-body">
          <form role="form" method="post" class="formulario" enctype="multipart/form-data">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="datosPersona" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Inventario/Bodega</a>
              </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="datosPersona">
                <div class="container-fluid mt-3">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label for="">Tipo<?php echo $i?></label>
                      <select class="form-control select2 "  id="nuevoTipoProducto" style="width: 100%;" name="nuevoTipoProducto">
                          
                          
                          <option selected="selected">Seleccionar...</option>
                          <?php 
                              $tabla = "tbl_tipo_producto";
                              $item = null;
                              $valor = null;
                              $preguntas = ControladorInventario::ctrMostrarTipoProducto($tabla, $item, $valor);
                              foreach ($preguntas as $key => $value) { ?>
                                  <option value="<?php echo $value['id_tipo_producto']?>"><?php echo $value['tipo_producto']?></option>        
                              <?php 
                              }
                          ?>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="nombreproducto">Codigo</label>
                      <input type="text" readonly class="form-control nuevoCodigo" name="nuevoCodigo" placeholder="Codigo producto" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="nombreproducto">Nombre Producto</label>
                      <html>
                      <input type="text" class="form-control mayus nombre_producto" name="nuevoNombreProducto" placeholder="Ingrese Producto" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="stock">Cantidad en stock</label>
                      <input type="number" class="form-control stock" name="nuevoStock" placeholder="Cantidad en stock" min="0" required class="fa fa-arrow-up"></i></span>
                    </div>
                  </div>
      
            <div class="form-row">

                <div class="form-group col-md-4">
                      <label for="precio">Precio</label>
                      <input type="text" class="form-control precio" name="nuevoPrecio" placeholder="Ingrese Precio"  required>
                    
                    </div>
                        <div class="form-group col-md-4">
                          <label for="productominimo">Producto Minimo</label>
                          <input type="number" class="form-control precio" name="nuevoProductoMinimo" placeholder="Cantidad Minima" min="0" required class="fa fa-arrow-up"></i></span>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="productomaximo">Producto Maximo</label>
                          <input type="number" class="form-control precio" name="nuevoProductoMaximo" placeholder="Cantidad Maximo" min="0" required class="fa fa-arrow-up"></i></span>
                        </div>
                     </div>
                </div>
                <button type="" class="btn btn-primary float-right">Guardar</button>

             
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="exampleInputFile">Foto</label>
                        <div class="input-group">
                          <img class="img-thumbnail previsualizar mr-2" src="vistas/img/usuarios/default/anonymous.png" alt="imagen-del-usuario" width="100px">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input nuevaFotoProducto" id="exampleInputFile" name="nuevaFotoProducto">
                            <label class="custom-file-label" for="exampleInputFile">Escoger foto</label>
                          </div>
                        </div>
                            <p class="p-foto help-block ml-4">Peso máximo de la foto 2 MB</p>
                        </div>
                   
                        
                    </div>
                        <?php
                        $tipostock = 'producto';
                        $pantalla = 'productos';
                        $AgregarInventario = new ControladorInventario();
                        $AgregarInventario->ctrCrearStock($tipostock, $pantalla);
                        ?>
                    </div>

                 
                 
                      
                </div>

                <!-- <div class="form-group mt-8 float-right">
                        <button type="" class="btn btn-primary float-right">Guardar</button>
                </div> -->


            
                  
            

            </div>
                  <!-- 2tab --> 
          </form>
        

</div> <!-- FIN DEL CARDBODY -->
