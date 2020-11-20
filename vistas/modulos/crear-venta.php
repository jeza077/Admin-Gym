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
        <div class="col-md-5">
          <form role="form" method="post" class="formularioVenta">

            <div class="card">
              <div class="card-body"> 
                <div class="form-group"  class="formularioVenta"> 
                 <!--=====================================
                  ENTRADA VENDEDOR/USUARIO
                ======================================-->  
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["usuario"]  ?>" readonly>
                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id_usuario"]; ?>">
                </div>       
              
                <div class="form-group">     
                  <!--=====================================
                   ENTRADA DEL CÓDIGO
                  ======================================-->  
                  <label for="cod_factura">Codigo de Factura</label>
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
                        $codigo = $value["codigo"] + 1;
                        echo '<input type="text" class="form-control" id="nuevaVenta" 
                        name="nuevaVenta" value= '. $codigo.' readonly>';
                      }
                    ?>    
                </div>

                <div class="form-row">
                  <div class="form-group col-md-9">
                    <!--=====================================
                    ENTRADA DEL CLIENTE
                    ======================================--> 

                    <label for="cliente">Cliente</label>
                      
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                        <option value="">Seleccionar cliente</option>
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
                    </select>
                  </div>    
                  <div class="form-group col-md-3 mt-4">
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span> 
                  </div>
                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 
                <div class="form-row nuevoProducto">

                </div>
                <!-- IMPUESTO Y TOTAL-->
                <div class="form-row">
                  <div class="form-group-float-right col-md-2" style="padding-left:0px">
                    <label>Impuesto </label>
                    <input type="number" class="form-control nuevoImpuestoVenta" name="nuevoImpuestoVenta"  id="nuevoImpuestoVenta"  placeholder="0"  required> 
                    <!-- <span class="input-group-addon"><i class="fa fa-percent"></i></span> -->
                  </div>
                    
                  <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required> 

                  <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required> 

                  <div class="form-group-float-right col-md-4" style="padding-left:0px">
                    <label for="total_producto"> Total </label>
                    <input type="number" min="1" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0.00" readonly required>
                    <input type="hidden" name="totalVenta" id="totalVenta">

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
           $guardarVenta = new ControladorVentas();
           $guardarVenta -> ctrCrearVenta();

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
                    <th scope="col">Código</th>
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

<div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="form-group col-md-3">
                      <label for="">Tipo de documento <?php echo $i?></label>
                      <select class="form-control select2 tipoDocumentoCliente" name="nuevoTipoDocumento">
                          <option selected="selected">Seleccionar...</option>
                          <?php 
                              $tabla = "tbl_documento";
                              $item = null;
                              $valor = null;

                              $preguntas = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                              foreach ($preguntas as $key => $value) { ?>
                                  <option value="<?php echo $value['id_documento']?>"><?php echo $value['tipo_documento']?></option>        
                              <?php 
                              }
                          ?>
                      </select>
                    </div>

                    <div class="form-group col-md-3">
                      <label for="identidad">Numero de documento</label>
                      <input type="text" class="form-control idCliente" name="nuevoNumeroDocumento" placeholder="Ingrese Identidad" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control nombre" name="nuevoNombre" placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group col-md-3">
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

                    <div class="form-group col-md-4">
                      <label>Teléfono</label>
                      <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  name="nuevoTelefono" placeholder="Ingrese Telefono" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Fecha de nacimiento</label>
                        <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask  name="nuevaFechaNacimiento" placeholder="Ingrese Fecha de Nacimiento" required>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-9">
                      <label for="">Dirección</label>
                      <input type="text" class="form-control" name="nuevaDireccion" placeholder="Col. Alameda, calle #2..." required>
                    </div>
                  
                    <div class="form-group col-md-3">
                      <label>Sexo</label>
                      <select class="form-control select2" name="nuevoSexo" style="width: 100%;" required>
                        <option selected="selected">Seleccionar...</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <select class="form-control select2 tipoCliente" name="editarTipoCliente" style="width: 100%;" required>
                          <option selected="selected">Seleccionar...</option>
                          <option value="Ventas">Cliente de ventas</option>
                          
                        </select>
                      </div>
                    </div>
                   
                  </div>
                </div>
              </div>

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

      </div>
     
    </div>
  </div>
</div>


