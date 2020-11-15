<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear venta</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  
      <!--=====================================
                 FORMULARIO 
      ======================================-->
    <section class="content">  

      <div class="row">

        <div class="card col-md-5">
          <div class="card-body"> 
            <div class="form-group"  class="formularioVenta"> 
              <!-- Entrada vendedor/usuario -->    
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="<?php echo $_SESSION["nombre"]  ?>" readonly>
                <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id_usuario"]; ?>">
            </div>       
          
            <div class="form-group">     
              <!-- entrada codigo factura vendedor -->   
              <label for="cod_factura">Codigo de Factura</label>
                <?php
                  $item= null;
                  $valor= null;

                  $ventas= controladorVentas:: ctrMostrarVentas($item, $valor);
                  // echo "<pre>";
                  // var_dump($ventas);
                  // echo "</pre>";
                  if (!$ventas){
                    echo '<input type="text" class="form-control" id="nuevaVenta" 
                    name="nuevaVenta" value="1001" readonly>';

                  } else {

                    foreach ($ventas as $key =>$value) {
                    
                    }
                    $codigo = $value["codigo"] + 1;
                    echo '<input type="text" class="form-control" id="nuevaVenta" 
                    name="nuevaVenta" value= '. $codigo.'" readonly>';
                  }
                ?>    
            </div>

            <div class="form-row">
              <div class="form-group col-md-9">
                <!-- Entrada de cliente-->
                <label for="cliente">Cliente</label>
                  
                <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                    <option value="">Seleccionar cliente</option>
                    <!-- metodo para mostrar clientes se BORRA cuando descomento -->
                    <?php
                      // $item= null;
                      // $valor= null;

                      // $categorias= ControladorClientes:: ctrMostrarClientes($item, $valor);
                      // echo "<pre>";
                      //  var_dump($categorias);
                      //  echo "</pre>";
                      //   foreach ($categorias as $key => $value)
                      //   {
                      //     echo '<option value="'.$value["id"].'">' .$value["nombre"]. '</option>';
                      //   }
                    ?>       
                </select>
              </div>    
              <div class="form-group col-md-3 mt-4">
                <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span> 
              </div>
            </div>
            
            <div class="form-row">
              <!-- Entrada de producto-->
              <!-- ///////////////////////////////// -->
              <!-- Descripción del producto--------------------- -->
               <!-- Cantidad del producto-->
               <!-- Total de producto-->
            </div>
            <!-- IMPUESTO Y TOTAL-->
            <div class="form-row">
              <div class="form-group-float-right col-md-4" style="padding-left:0px">
                <label>Impuesto </label>
                <input type="number" min="1" class="form-control" id="" name="" readonly required> 
              </div>  

              <div class="form-group-float-right col-md-4" style="padding-left:0px">
                <label for="total_producto">Total </label>
                <input type="number" min="1" class="form-control" id="" name="" readonly required> 
              </div>  
            </div>

          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary pull-right btnAgregarProducto">Guardar venta</button>
          </div>  

        </div>

           <!--TABLA DE PRODUCTOS  -->
        <div class="card col-md-7">
          <div class="card-body">
              <table class="table table-striped table-bordered tablaVentas text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Código</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Acciones</th> 
                  </tr>
                </thead>
            </table>
          </div>
        </div>

      </div>  
      
    </section>

    
</div>

<!-- modal cliente -->
<!-- Modal -->
<div class="modal fade" id="modalAgregarCliente" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <div class="form-row"> -->
          <div class="form-group">
           <label for="">Nombre</label>
           <input type="text" class="form-control">
          </div>
          <div class="form-group">
           <label for="">Apellidos</label>
           <input type="text" class="form-control">
          </div>
          <div class="form-group">
           <label for="">Email</label>
           <input type="email" class="form-control email">
          </div>
        <!-- </div> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
