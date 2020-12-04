<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nueva venta</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>  
      <!--=====================================
                 FORMULARIO 
      ======================================-->
    <section class="content">  

      <div class="row">
        <div class="col-md-5">
          <form role="form" method="post" class="formularioVenta">

            <div class="card">

                <?php
                  $item="id_venta";
                  $valor= $_GET["idVenta"];
                  $venta= ControladorVentas::ctrMostrarVentas($item, $valor);
                  // var_dump($venta);

                  $tabla="tbl_usuarios";
                  $itemUsuario ="id_usuario" ;
                  $valorUsuario = $venta["id_usuario"];
                  $vendedor = ControladorUsuarios::ctrMostrarUsuarios($tabla, $itemUsuario, $valorUsuario);
                  // var_dump($vendedor);

                  $porcentajeImpuesto = $venta["impuesto"] * 100 / $venta["neto"];
                    
                ?>
              <div class="card-body"> 
                <div class="form-group"  class="formularioVenta"> 

                   
                 <!--=====================================
                  ENTRADA VENDEDOR/USUARIO
                 ======================================-->  
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["usuario"];  ?>" readonly>
                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id_usuario"]; ?>">
                </div>       
              
                
                  <!--=====================================
                   ENTRADA DEL CÓDIGO y editar venta
                  ======================================-->  
                <div class="form-group">     
                  <label for="cod_factura">Codigo de Factura</label>  
                  <input type="text" class="form-control" id="nuevaVenta" 
                    name="editarVenta" value="<?php echo $venta["numero_factura"]; ?>" readonly>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-9">
                    <!--=====================================
                    ENTRADA DEL CLIENTE
                    ======================================--> 

                    <label for="cliente">Cliente</label>
                    <input type ="text" class="form-control" id="seleccionarCliente" name="seleccionarCliente" 
                     value="<?php echo $venta["nombre"];  ?><?php echo $venta["apellidos"];  ?>" readonly>


                    <!-- <select class="form-control select2-dropdown select2-search-dropdown"  required>
                        <option value="<?php echo $venta["id_cliente"];  ?>"><?php echo $venta["nombre"];  ?>  </option>
                        <?php
                          $item= null;
                          $valor= null;
                          $tabla= "tbl_clientes";

                          $clientes= ControladorClientes::ctrMostrarClientes($tabla, $item, $valor);
                          // echo "<pre>";
                          //  var_dump($clientes);
                          //  echo "</pre>";
                            foreach ($clientes as $key => $value)
                            {
                              echo '<option value="'.$value["id_cliente"].'">' .$value["nombre"]. ' '.$value["apellidos"]. '</option>';
                            }
                        ?>      
                    </select> -->
                  </div>    

                  <!-- <div class="form-group col-md-3 mt-4">
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span> 
                  </div> -->
                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 
                <div class="form-row nuevoProducto">
                <?php
                  error_reporting(0);
                  $listaProducto = json_decode($venta["productos"], true);
                  // var_dump($listaProducto);

                  foreach ($listaProducto as $key => $value) {
                    $item = "id_inventario";
                    $valor = $value["id"];

                    $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
                    // var_dump($respuesta);

                    $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
                    
                    echo '<div class="row" style="padding:5px 6px">
                            <div class="col-md-6">
                              <div class="input-group">
                                <span class="input-group-prepend"><button type="button" class="btn btn-danger btn-md quitarProducto" idProducto="'.$value["id_inventario"].'"><i class="fa fa-times"></i></button></span>
                                <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id_inventario"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>
                              </div>
                            </div>
    
                            <div class="col-md-3">
                
                              <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto"  min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>
                
                            </div>

                            <div class="col-md-3 ingresoPrecio">
                              <div class="input-group" style="padding-left:0px">
                                <span class="input-group-prepend btn btn-default"><i class="fas fa-dollar-sign"></i></span>
                                <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
                              </div>
                            </div>
                      </div>';

                  }  
                ?>


                </div>
                <!-- IMPUESTO Y TOTAL-->
                <div class="form-row">
                  <div class="form-group-float-right col-md-2" style="padding-left:0px">
                    <label>Impuesto </label>
                    <input type="number" class="form-control nuevoImpuestoVenta" name="nuevoImpuestoVenta"  id="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto; ?>" readonly required> 
                    <!-- <span class="input-group-addon"><i class="fa fa-percent"></i></span> -->
                   <!-- <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuesto"]; ?>" required>  -->
                  </div>
                    

                  <!-- <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>  -->
                
                  <div class="form-group float-right col-md-3" style="padding-left:0px">
                    <label for="total_producto"> Sub Total </label>
                    <input type="number" min="1" class="form-control input-lg" total="<?php echo $venta["neto"]; ?>" id="nuevoPrecioNeto" name="nuevoTotalNeto"  value="<?php echo $venta["neto"]; ?>"  readonly required>
                    <input type="hidden"  name="nuevoPrecioNeto" id="precioNeto" value="<?php echo $venta["neto"]; ?>" required> 

                  </div>  

                  <div class="form-group-float-right col-md-4" style="padding-left:0px">
                    <label for="total_producto"> Total </label>
                    <input type="number" min="1" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta"  value="<?php echo $venta["total"]; ?>" total="<?php echo $venta["neto"]; ?>" readonly required>
                    <input type="hidden" name="totalVenta" id="totalVenta" value="<?php echo $venta["total"]; ?>">

                  </div>  

                </div>

              </div>

              <input type="hidden" id="listaProductos" name="listaProductos">
              <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary pull-right btnAgregarProducto">Guardar venta</button>
              </div>  

            </div>
          </form>
          <?php
           $editarVenta = new ControladorVentas();
           $editarVenta->ctrEditarVenta();

          ?>
        </div>

           <!--TABLA DE PRODUCTOS  -->
        <div class="card col-md-7">
          <div class="card-body">
              <table class="table table-striped table-bordered tablaVentas text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Imagen</th>
                    <!-- <th scope="col">Código</th> -->
                    <th scope="col">Descripción</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Acciones</th> 
                  </tr>
                </thead>
                <?php
                // $item = "tipo_producto";
                // $valor = "Productos";
                // $tabla = "tbl_inventario";
            
                //       $productos = ControladorInventario::ctrMostrarInventario($tabla, $item, $valor);	
                //       echo "<pre>";
                //       var_dump($productos[1]["stock"]);
                //       echo "</pre>";
                //       return;

                ?>
            </table>
          </div>
        </div>

      </div>  
      
    </section>

    
</div>

<!--===========================================
       Modal cliente 
=====================================-->

<!-- <div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <form role="form" method="post" class="formulario">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="datosPersona" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos personales</a>
              </li>
            </ul>
            
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="datoscliente">
                <div class="container-fluid mt-4">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control nombre" name="nuevoNombre" placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="apellido">Apellido</label>
                      <input type="text" class="form-control apellidos" name="nuevoApellido" placeholder="Ingrese Apellidos" required>
                    </div>
                  </div>
      
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="email">Email</label>
                      <input type="email" class="form-control email" name="nuevoEmail" placeholder="Ingrese Email" required>
                      <input type="hidden" name="tipoCliente" value="ventas">
                    </div>

                    <div class="form-group mt-8 float-right">
                  
                      <span class="input-group-addon"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Guardar</button></span>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                    </div>
                          
                  </div>     

                </div>

              </div>     

            </div>

          </form>     

        </div>

      </div> 

    </div>
    
</div> -->


