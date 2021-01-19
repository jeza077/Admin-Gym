<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Proveedores</h1>
          </div>
          <div class="col-sm-6">
                <button class="btn btn-orange float-right" data-toggle="modal" data-target="#modalNuevoProveedor">
                  Nuevo Proveedor      
                </button>
                <button class="btn btn-danger btnExportarProveedores float-right mr-3 ">
                Exportar PDF      
               </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>  

  <section class="content">

    <div class="card">

      <div class="card-body">

        <?php
            // $descripcionEvento = " Consulto la pantalla de Documentos";
            // $accion = "Consulta";

            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

        ?>

        <!--========================================================
                    MATRICULA
        ==========================================================-->  
        <table class="table table-bordered table-striped tablas text-center">
            
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Acciones</th>

              </tr>
            </thead>
            
            <tbody>  
                <?php
                  $tabla = "tbl_proveedores";
                  $item = null;
                  $valor = null;
                  
                  $proveedores = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);
                  // var_dump($proveedores);

                  foreach ($proveedores as $key => $value){
                    echo '
                      <tr>  
                          <td>'.($key + 1).'</td>
                          <td>'.$value["nombre"].'</td>
                          <td>'.$value["correo"].'</td>                         
                          <td>'.$value["telefono"].'</td>                         
                          <td>
                              <button class="btn btn-warning btnEditarProveedor" idProveedor="'.$value["id_proveedor"].'" data-toggle="modal" data-target="#modalEditarProveedor" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>

                              <button class="btn btn-danger btnEliminarProveedor" idEliminarProveedor="'.$value["id_proveedor"].'" data-toggle="tooltip" data-placement="left" title="Borrar"><i class="fas fa-trash-alt"></i></button></td>
                          </td>
                      </tr>  '; 
                  }       
                  ?>                
              
            </tbody>
        </table>       

      </div>

    </div>

  </section>

</div>


<!--=====================================
MODAL AGREGAR NUEVO PROVEEDOR
======================================-->
<div class="modal fade" id="modalNuevoProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Proveedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control nombre mayus" name="nuevoNombre" value="" placeholder="Ingresa Nombre" required>
          </div>

          <div class="form-group col-md-12">
            <label for="Descripcion">Correo</label>
            <input type="email" class="form-control email" name="nuevoCorreo" value="" placeholder="Ingresa correo" required>
          </div>

          <div class="form-group col-md-12">
            <label for="Descripcion">Teléfono</label>
            <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  name="nuevoTelefono" placeholder="Ingrese Teléfono" required>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btnGuardarProveedor">Guardar</button>
          <button type="button" class="btn btn-orange salirModal" data-dismiss="modal">Salir</button>
        </div>

      </form> 

    </div>

  </div>
        

</div>


<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->
<div class="modal fade" id="modalEditarProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
            <div class="form-group col-md-12">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control nombre mayus" id="editarNombre" name="editarNombre" value="" required>
            </div>

            <div class="form-group col-md-12">
                <label for="Descripcion">Correo</label>
                <input type="email" class="form-control email" id="editarCorreo" name="editarCorreo" value="" required>
            </div>

            <div class="form-group col-md-12">
                <label for="Descripcion">Teléfono</label>
                <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  id="editarTelefono" name="editarTelefono" value="" required>
            </div>
            <input type="hidden" id="editarIdProveedor" name="editarIdProveedor">
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
        </div>

        <?php

          $editarProveedor = new ControladorMantenimientos();
          $editarProveedor->ctrEditarProveedor();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<?php

 $borrarProveedor = new ControladorMantenimientos();
 $borrarProveedor->ctrBorrarProveedor();

?>

