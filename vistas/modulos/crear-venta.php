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
      <?php
        $descripcionEvento = "".$_SESSION["usuario"]." Consultó la pantalla de crear ventas";
        $accion = "Consulta";

        $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 15,$accion, $descripcionEvento);

      ?>
                    
      <div class="row">
        <div class="col-md-5">
          <form role="form" method="post" class="formularioVenta">

            <div class="card">
              <div class="card-body"> 
                <div class="form-row">
                  <div class="form-group col-md-8"  class="formularioVenta"> 
                  <!--=====================================
                    ENTRADA VENDEDOR/USUARIO
                  ======================================-->  
                      <label for="usuario">Usuario</label>
                      <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["usuario"]  ?>" readonly>
                      <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id_usuario"]; ?>">
                  </div>       

                  <div class="form-group col-md-4">     
                    <!--=====================================
                    ENTRADA DEL CÓDIGO
                    ======================================-->  
                    <label for="cod_factura">Número de recibo</label>
                      <?php
                        $item= null;
                        $valor= null;

                        $ventas= ControladorVentas::ctrMostrarVentas($item, $valor);
                        // echo "<pre>";
                        // var_dump($ventas);
                        // echo "</pre>";
                        if (!$ventas){
                          echo '<input type="text" class="form-control" id="nuevaVenta" 
                          name="nuevaVenta" value="1001" readonly>';

                        } else {

                          foreach ($ventas as $key =>$value) {
                          
                          }
                          $codigo = $value["numero_factura"] + 1;
                          echo '<input type="text" class="form-control" id="nuevaVenta" 
                          name="nuevaVenta" value= '. $codigo.' readonly>';
                        }
                      ?>    
                  </div>

                </div>
              

                <div class="form-row">
                  <div class="form-group col-md-9">
                    <!--=====================================
                    ENTRADA DEL CLIENTE
                    ======================================--> 
                    <label for="cliente">Cliente</label>
                      
                    <select class="form-control select2" id="seleccionarCliente" name="seleccionarCliente" required>
                        <option value="">Seleccionar cliente</option>
                        <?php
                          $tabla = "tbl_clientes";
                          $item = null;
                          $valor = null;
                          $clientes = ControladorClientes::ctrMostrarClientesSinPago($tabla, $item, $valor);

                            foreach ($clientes as $key => $value)
                            {
                              echo '<option value="'.$value["id_personas"].'">'.$value["nombre"]. ' '.$value["apellidos"]. '</option>';
                            }
                        ?>       
                    </select>
                    <!-- <input type="hidden" value="<?php echo $value["id_personas"]?>" name="idPersona"> -->
                  </div>    
                  <div class="form-group col-md-3 mt-4">
                    <span class="input-group-addon"><button type="button" class="btn btn-outline-orange btn-xs p-2 px-3 mt-2" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span> 
                  </div>
                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 
                <div class="form-row nuevoProducto">

                </div>
                <!-- IMPUESTO Y TOTAL-->
                <div class="form-row mt-2">
                  <div class="form-group float-right col-md-2" style="padding-left:0px">
                    <?php
                    $item="parametro";
                    $valor="ADMIN_IMPUESTO";
                    $parametro= ControladorUsuarios::ctrMostrarParametros($item, $valor);
                    // var_dump($parametro);

                    ?>
                    <label>Impuesto </label>
                    <input type="number" class="form-control nuevoImpuestoVenta" name="nuevoImpuestoVenta"  id="nuevoImpuestoVenta" value="<?php echo $parametro["valor"]; ?>" readonly required> 
                    <!-- <span class="input-group-addon"><i class="fa fa-percent"></i></span> -->
                  </div>
                    
                  <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required> 


                  <div class="form-group float-right col-md-3" style="padding-left:0px">
                    <label for="total_producto"> Subtotal </label>
                    <input type="number" min="1" class="form-control input-lg" id="nuevoPrecioNeto" name="nuevoPrecioNeto" total="" placeholder="0.00" readonly required>
                    <input type="hidden" name="nuevoPrecioNeto" id="precioNeto" required> 

                  </div>  

                  <div class="form-group float-right col-md-3" style="padding-left:0px">
                    <label for="total_producto"> Total </label>
                    <input type="number" min="1" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0.00" readonly required>
                    <input type="hidden" name="totalVenta" id="totalVenta">

                  </div>  

                </div>

                <div class="form-check float-right">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="enviarFactura">
                    <label class="form-check-label" for="exampleCheck1">ENVIAR RECIBO DE PAGO</label>
                </div>

              </div>

              <input type="hidden" id="listaProductos" name="listaProductos">
              <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->
              <div class="card-footer">
                <a href="administrar-ventas" class="btn btn-danger ml-2 float-right">Salir</a>
                <button type="submit" class="btn btn-primary float-right btnAgregarProducto">Guardar venta</button>
              </div>  

            </div>
          </form>
          <?php
           $guardarVenta = new ControladorVentas();
           $guardarVenta -> ctrCrearVenta();

          ?>
        </div>

           <!--TABLA DE PRODUCTOS  -->
        <div class="card col-md-7">
          <div class="card-body">
              <table class="table table-striped table-bordered tablaProductosVenta text-center">
                <thead>
                  <tr>
                    <th scope="col">N.°</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acciones</th> 
                  </tr>
                </thead>
            </table>
          </div>
        </div>

      </div>  
      
    </section>

    
</div>

<!--===========================================
       Modal cliente 
=====================================-->


<div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
      
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" class="formulario">
              
            <div class="form-group col-md-12">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control nombre mayus" name="nuevoNombre" placeholder="Ingrese nombre" required>
            </div>
            <div class="form-group col-md-12">
              <label for="apellido">Apellido</label>
              <input type="text" class="form-control apellidos mayus" name="nuevoApellido" placeholder="Ingrese apellidos" required>
            </div>
            <div class="form-group col-md-12">
            <label>Teléfono</label>
              <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  name="nuevoTelefono" placeholder="Ingrese teléfono" required>
            </div>

            <div class="form-group col-md-12">
              <label for="email">Correo</label>
              <input type="email" class="form-control email" name="nuevoEmail" placeholder="Ingrese correo" required>
            </div>

            <input type="hidden" name="tipoCliente" value="Ventas">

            <div class="form-group mt-4 float-right">        
              <button type="" class="btn btn-primary">Guardar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
            </div>
        
            <?php
              $tipoPersona = 'clientes';
              $pantalla = 'crear-venta';
              $ingresarPersona = new ControladorPersonas();
              $ingresarPersona->ctrCrearPersona($tipoPersona, $pantalla);
            ?>
            
          </form>
        </div>
      </div>
    </div>
</div>


