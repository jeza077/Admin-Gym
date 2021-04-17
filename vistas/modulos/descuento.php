<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Descuentos</h1>
          </div>
          <div class="col-sm-6">
              <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoDescuento">
              Nuevo Descuento     
              </button>
              <button class="btn btn-danger btnExportarDescuento float-right mr-3 ">
                Exportar PDF      
              </button>

                  
       
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>  

         <?php
            $descripcionEvento = "".$_SESSION["usuario"]." Consultó la pantalla de descuento";
            $accion = "Consulta";

            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 23,$accion, $descripcionEvento);

          ?>
        

    <section class="content">

      <div class="card">

        <div class="card-body">
            <?php
            
            ?>

            <table class="table table-bordered table-striped tablas text-center">                
              <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipo descuento</th>
                    <th scope="col">Porcentaje</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                    
                </tr>
              </thead>
              <tbody>  
                <?php
                  // $tabla = "tbl_descuento";
                  $item = null;
                  $valor = null;
                  
                  $descuento = ControladorMantenimientos::ctrMostrarDescuento($item,$valor);
                  // var_dump($descuento);

                  foreach ($descuento as $key => $value){
                  echo '
                      <tr>
                  
                      <td>'.($key + 1).'</td>
                      <td>'.$value["tipo_descuento"].'</td>
                      <td>'.$value["valor_descuento"].'%</td>';
                      if($value['estado'] != 0){
                          echo '<td><button class="btn btn-success btn-md btnActivarDescuento" idDescuento="'.$value["id_descuento"].'" estadoDescuento="0">Activado</button></td>';
                      }else{
                          echo '<td><button class="btn btn-danger btn-md btnActivarDescuento" idDescuento="'.$value["id_descuento"].'" estadoDescuento="1">Desactivado</button></td>';
                      } 
                      echo'
                        <td>
                        <button class="btn btn-warning btnEditarDescuento" editarIdDescuento="'.$value["id_descuento"].'" data-toggle="modal" data-target="#modalEditarDescuento" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>

                        <button class="btn btn-danger btnEliminarDescuento" ideliminarDescuento="'.$value["id_descuento"].'" data-toggle="tooltip" data-placement="left" title="Borrar"><i class="fas fa-trash-alt"></i></button></td>
                      
                      </tr> ';
                      
                  }       
                ?>                
            
              </tbody>
            </table>
            
        </div>

      </div>

    </section>

</div>

<!--=====================================
MODAL NUEVO DESCUENTO
======================================-->

<div class="modal fade" id="modalNuevoDescuento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Descuento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="Rol">Tipo Descuento</label>
            <input type="text" class="form-control nombre mayus" name="nuevoDescuento" value="" placeholder="Ingresa Descuento" required>
          </div>

          <div class="form-group col-md-12">
            <label for="Descripcion">Porcentaje Descuento</label>
            <input type="textarea" class="form-control preciom" name="nuevoValor" value="" placeholder="Ingresa Porcentaje Descuento" required>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
        </div>

        <?php

           $crearDescuento = new ControladorMantenimientos();
           $crearDescuento-> ctrDescuentoInsertar();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<!--=====================================
MODAL EDITAR DESCUENTO
======================================-->

<div class="modal fade" id="modalEditarDescuento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Descuento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="form-group col-md-12">
              <label for="Rol">Tipo Descuento</label>
              <input type="text" class="form-control nombre mayus" id="editarDescuento" name="editarDescuento" value="" required>
            </div>

            <div class="form-group col-md-12">
              <label for="Descripcion">Porcentaje Descuento</label>
              <input type="textarea" class="form-control preciom" id="editarValorDescuento" name="editarValorDescuento" value="" required>
            </div>
            <input type="hidden" id="editarIdDescuento" name="editarIdDescuento">
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
        </div>

        <?php

           $editarDescuento = new ControladorMantenimientos();
           $editarDescuento->ctrEditarDescuento();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<?php

 $borrarDescuento = new ControladorMantenimientos();
 $borrarDescuento->ctrBorrarDescuento();

?>







