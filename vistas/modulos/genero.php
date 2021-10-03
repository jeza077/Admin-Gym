<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Géneros</h1>
          </div>
          <div class="col-sm-6">
                <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoGenero">
                  Nuevo Género      
                </button>
                <button class="btn btn-danger btnExportarGeneros float-right mr-3 ">
                Exportar PDF      
               </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>  

  <section class="content">

  <?php
    $descripcionEvento = "".$_SESSION["usuario"]." Consultó la pantalla de género";
    $accion = "Consulta";

    $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 35,$accion, $descripcionEvento);

  ?>

    <div class="card">

      <div class="card-body">

        <!--========================================================
                    GENERO
        ==========================================================-->  
        <table class="table table-bordered table-striped tablas text-center">
            
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Género</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>

              </tr>
            </thead>
            
            <tbody>  
                <?php
                  $tabla = "tbl_sexo";
                  $item = null;
                  $valor = null;
                  $all = null;
                  
                  $sexo = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);
                  // var_dump($sexo);

                  foreach ($sexo as $key => $value){
                    echo '
                      <tr>  
                          <td>'.($key + 1).'</td>
                          <td>'.$value["sexo"].'</td>';
                          if($value['estado'] != 0){
                            echo '<td><button class="btn btn-success btn-md btnActivarGenero" idGenero="'.$value["id_sexo"].'" estadoGenero="0">Activado</button></td>';
                          }else{
                            echo '<td><button class="btn btn-danger btn-md btnActivarGenero" idGenero="'.$value["id_sexo"].'" estadoGenero="1">Desactivado</button></td>';
                          } 
                          echo '
                          <td>
                              <button class="btn btn-warning btnEditarSexo" idGenero="'.$value["id_sexo"].'" data-toggle="modal" data-target="#modalEditarSexo" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>

                              <button class="btn btn-danger btnEliminarGenero" idEliminarGenero="'.$value["id_sexo"].'" data-toggle="tooltip" data-placement="left" title="Borrar"><i class="fas fa-trash-alt"></i></button></td>
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
MODAL AGREGAR NUEVO SEXO
======================================-->

<div class="modal fade" id="modalNuevoGenero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Genero</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

            <div class="form-group col-md-12">
                <label for="">Género</label>
                <input type="text" class="form-control sinCaracteres sinNumeros mayus" name="nuevoGenero" value="" placeholder="Ingresa Genero" required>
            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        </div>

        <?php

          $crearGenero = new ControladorMantenimientos();
          $crearGenero-> ctrGeneroInsertar();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<!--=====================================
MODAL EDITAR SEXO
======================================-->
<div class="modal fade" id="modalEditarSexo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Género</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="">Género</label>
            <input type="text" class="form-control sinCaracteres sinNumeros mayus" id="editarGenero" name="editarGenero" value="" required>
          </div>

          <!-- <div class="form-group col-md-12">
            <label for="Descripcion">Precio Matricula</label>
            <input type="textarea" class="form-control preciom" id="editarPrecioMatricula" name="editarPrecioMatricula" value="" required>
          </div> -->
          <input type="hidden" id="editarIdGenero" name="editarIdGenero">
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        </div>

        <?php

          $editarGenero = new ControladorMantenimientos();
          $editarGenero->ctrEditarGenero();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<?php

 $borrarGenero = new ControladorMantenimientos();
 $borrarGenero->ctrBorrarGenero();

?>

