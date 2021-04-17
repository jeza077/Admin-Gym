<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Matricula</h1>
          </div>
          <div class="col-sm-6">
                <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevaMatricula">
                  Nueva Matricula      
                </button>
                <button class="btn btn-danger btnExportarMatricula float-right mr-3 ">
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
            $descripcionEvento = "".$_SESSION["usuario"]." Consultó la pantalla de matrícula";
            $accion = "Consulta";

            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 22,$accion, $descripcionEvento);

        ?>

        <!--========================================================
                    MATRICULA
        ==========================================================-->  
        <table class="table table-bordered table-striped tablas text-center">
            
            <thead>
              <tr>
                <th scope="col">#</th>

                <th scope="col">Tipo de matricula</th>

                <th scope="col">Precio</th>

                <th scope="col">Estado</th>

                <th scope="col">Acciones</th>

              </tr>
            </thead>
            
            <tbody>  
                <?php
                  // $tabla = "tbl_matricula";
                  $item = null;
                  $valor = null;
                  
                  $matricula = ControladorMantenimientos::ctrMostrarMatricula($item,$valor);
                  // var_dump($rol);

                  foreach ($matricula as $key => $value){
                    echo '
                      <tr>
                    
                      <td>'.($key + 1).'</td>
                      <td>'.$value["tipo_matricula"].'</td>
                      <td>'.$value["precio_matricula"].'</td>';
                      if($value['estado'] != 0){
                        echo '<td><button class="btn btn-success btn-md btnActivarMatricula" idMatricula="'.$value["id_matricula"].'" estadoMatricula="0">Activado</button></td>';
                      }else{
                        echo '<td><button class="btn btn-danger btn-md btnActivarMatricula" idMatricula="'.$value["id_matricula"].'" estadoMatricula="1">Desactivado</button></td>';
                      } 
                      echo'
                      <td>
                      <button class="btn btn-warning btnEditarMatricula" editarIdMatricula="'.$value["id_matricula"].'" data-toggle="modal" data-target="#modalEditarMatricula" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>

                      <button class="btn btn-danger btnEliminarMatricula" ideliminarMatricula="'.$value["id_matricula"].'" data-toggle="tooltip" data-placement="left" title="Borrar"><i class="fas fa-trash-alt"></i></button></td>
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
MODAL AGREGAR NUEVA MATRICULA
======================================-->

<div class="modal fade" id="modalNuevaMatricula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nueva Matricula</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="Rol">Tipo Matricula</label>
            <input type="text" class="form-control nombre mayus" name="nuevoMatricula" value="" placeholder="Ingresa Matricula" required>
          </div>

          <div class="form-group col-md-12">
            <label for="Descripcion">Precio Matricula</label>
            <input type="textarea" class="form-control preciom sinCaracteres" name="nuevoPrecio" value="" placeholder="Ingresa Precio Matricula" required>
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

          $crearMatricula = new ControladorMantenimientos();
          $crearMatricula-> ctrMatriculaInsertar();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<!--=====================================
MODAL EDITAR MATRICULA
======================================-->

<div class="modal fade" id="modalEditarMatricula" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Matricula</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="Rol">Tipo Matricula</label>
            <input type="text" class="form-control nombre mayus" id="editarMatricula" name="editarMatricula" value="" required>
          </div>

          <div class="form-group col-md-12">
            <label for="Descripcion">Precio Matricula</label>
            <input type="textarea" class="form-control preciom sinCaracteres" id="editarPrecioMatricula" name="editarPrecioMatricula" value="" required>
          </div>
          <input type="hidden" id="editarIdMatricula" name="editarIdMatricula">
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
        </div>

        <?php

          $editarMatricula = new ControladorMantenimientos();
          $editarMatricula->ctrEditarMatricula();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<?php

 $borrarMatricula = new ControladorMantenimientos();
 $borrarMatricula->ctrBorrarMatricula();

?>

