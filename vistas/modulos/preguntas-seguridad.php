<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Preguntas de seguridad</h1>
          </div>
          <div class="col-sm-6">
                <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevaPregunta">
                  Nueva pregunta      
                </button>
                <button class="btn btn-danger btnExportarPreguntas float-right mr-3 ">
                Exportar PDF      
               </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>  
  <?php
            $descripcionEvento = "".$_SESSION["usuario"]." Consultó la pantalla de preguntas de seguridad";
            $accion = "Consulta";

            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 32,$accion, $descripcionEvento);

        ?>

  <section class="content">

    <div class="card">

      <div class="card-body">

        <?php
            // $descripcionEvento = " Consultó la pantalla de Documentos";
            // $accion = "Consulta";

            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

        ?>
        <table class="table table-bordered table-striped tablas text-center">
            
            <thead>
              <tr>
                <th scope="col">N.°</th>
                <th scope="col">Pregunta</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>

              </tr>
            </thead>
            
            <tbody>  
                <?php
                  $tabla = "tbl_preguntas";
                  $item = null;
                  $valor = null;
                  $all = null;
                  
                  $preguntas = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);
                  // var_dump($preguntas);

                  foreach ($preguntas as $key => $value){
                    echo '
                      <tr>  
                          <td>'.($key + 1).'</td>
                          <td>'.$value["pregunta"].'</td>';
                          if($value['estado'] != 0){
                            echo '<td><button class="btn btn-success btn-md btnActivarPregunta" idPregunta="'.$value["id_preguntas"].'" estadoPregunta="0">Activado</button></td>';
                          }else{
                            echo '<td><button class="btn btn-danger btn-md btnActivarPregunta" idPregunta="'.$value["id_preguntas"].'" estadoPregunta="1">Desactivado</button></td>';
                          } 
                          echo '
                          <td>
                              <button class="btn btn-warning btnEditarPregunta" idPregunta="'.$value["id_preguntas"].'" data-toggle="modal" data-target="#modalEditarPregunta" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>

                              <button class="btn btn-danger btnEliminarPregunta" idEliminarPregunta="'.$value["id_preguntas"].'" data-toggle="tooltip" data-placement="left" title="Borrar"><i class="fas fa-trash-alt"></i></button></td>
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
MODAL AGREGAR NUEVA PREGUNTA
======================================-->

<div class="modal fade" id="modalNuevaPregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nueva pregunta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="">Pregunta</label>
            <input type="text" class="form-control mayus" name="nuevaPregunta" value="" placeholder="Ingrese la pregunta" required>
          </div>

          <!-- <div class="form-group col-md-12">
            <label for="Descripcion">Precio Matricula</label>
            <input type="textarea" class="form-control preciom" name="nuevoPrecio" value="" placeholder="Ingresa Precio Matricula" required>
          </div> -->
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        </div>

        <?php

          $crearPregunta = new ControladorMantenimientos();
          $crearPregunta-> ctrPreguntaSeguridadInsertar();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<!--=====================================
MODAL EDITAR PREGUNTA
======================================-->

<div class="modal fade" id="modalEditarPregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar pregunta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="Rol">Pregunta</label>
            <input type="text" class="form-control mayus" id="editarPregunta" name="editarPregunta" value="" required>
          </div>

          <!-- <div class="form-group col-md-12">
            <label for="Descripcion">Precio Matricula</label>
            <input type="textarea" class="form-control preciom" id="editarPrecioMatricula" name="editarPrecioMatricula" value="" required>
          </div> -->
          <input type="hidden" id="editarIdPregunta" name="editarIdPregunta">
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        </div>

        <?php

          $editarPregunta = new ControladorMantenimientos();
          $editarPregunta->ctrEditarPregunta();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<?php

 $borrarPregunta = new ControladorMantenimientos();
 $borrarPregunta->ctrBorrarPregunta();

?>

