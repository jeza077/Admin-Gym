<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Documentos</h1>
          </div>
          <div class="col-sm-6">
                <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoDocumento">
                  Nuevo Documento      
                </button>
                <button class="btn btn-danger btnExportarDocumento float-right mr-3 ">
                Exportar PDF      
               </button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>  

  <?php
            $descripcionEvento = "".$_SESSION["usuario"]." Consultó la pantalla de documentos";
            $accion = "Consulta";

            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 24,$accion, $descripcionEvento);

          ?>

  <section class="content">

    <div class="card">

      <div class="card-body">

        <?php
           
        ?>

        <!--========================================================
                    DOCUMENTOS
        ==========================================================-->  
        <table class="table table-bordered table-striped tablas text-center">
            
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tipo Documento</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>

              </tr>
            </thead>
            
            <tbody>  
                <?php
                  $tabla = "tbl_documento";
                  $item = null;
                  $valor = null;
                  $all = null;
                  
                  $documentos = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);
                  // var_dump($documentos);

                  foreach ($documentos as $key => $value){
                    echo '
                      <tr>  
                          <td>'.($key + 1).'</td>
                          <td>'.$value["tipo_documento"].'</td>';
                          if($value['estado'] != 0){
                            echo '<td><button class="btn btn-success btn-md btnActivarDocumento" idDocumento="'.$value["id_documento"].'" estadoDocumento="0">Activado</button></td>';
                          }else{
                            echo '<td><button class="btn btn-danger btn-md btnActivarDocumento" idDocumento="'.$value["id_documento"].'" estadoDocumento="1">Desactivado</button></td>';
                          } 
                          echo '
                          <td>
                              <button class="btn btn-warning btnEditarDocumento" idDocumento="'.$value["id_documento"].'" data-toggle="modal" data-target="#modalEditarDocumento" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>

                              <button class="btn btn-danger btnEliminarDocumento" idEliminarDocumento="'.$value["id_documento"].'" data-toggle="tooltip" data-placement="left" title="Borrar"><i class="fas fa-trash-alt"></i></button></td>
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
MODAL AGREGAR NUEVA MATRICULA
======================================-->

<div class="modal fade" id="modalNuevoDocumento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo Documento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="Rol">Tipo Documento</label>
            <input type="text" class="form-control nombre mayus" name="nuevoDocumento" value="" placeholder="Ingresa Documento" required>
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
          <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
        </div>

        <?php

          $crearDocumento = new ControladorMantenimientos();
          $crearDocumento-> ctrDocumentoInsertar();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<!--=====================================
MODAL EDITAR MATRICULA
======================================-->

<div class="modal fade" id="modalEditarDocumento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Documento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="Rol">Tipo Documento</label>
            <input type="text" class="form-control nombre mayus" id="editarDocumento" name="editarDocumento" value="" required>
          </div>

          <!-- <div class="form-group col-md-12">
            <label for="Descripcion">Precio Matricula</label>
            <input type="textarea" class="form-control preciom" id="editarPrecioMatricula" name="editarPrecioMatricula" value="" required>
          </div> -->
          <input type="hidden" id="editarIdDocumento" name="editarIdDocumento">
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
        </div>

        <?php

          $editarDocumento = new ControladorMantenimientos();
          $editarDocumento->ctrEditarDocumento();

        ?>




      </form>

    

    </div>

  </div>
        

</div>


<?php

 $borrarDocumento = new ControladorMantenimientos();
 $borrarDocumento->ctrBorrarDocumento();

?>

