<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Matricula</h1>
          </div>
          <div class="col-sm-6">
       
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>  

     <section class="content">

        <div class="card">

            <div class="card-body">

                <div class="row">

                    <div class=" col-sm-12">

              
                            <?php
                            $descripcionEvento = " Consulto la pantalla de mantenimiento";
                            $accion = "consulta";

                            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);
                
                            ?>

                        <!--========================================================
                               MATRICULA
                            ==========================================================-->   
                            <div class="card-header">
                                 
                                        <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevaMatricula">
                                        Nuevo       
                                        </button>
                                    <table class="table table-striped table-bordered tablas text-center">
                                        
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
                                                            echo '<td><button class="btn btn-success btn-md btnActivar" idMatricula="'.$value["id_Matricula"].'" estadoMatricula="0">Activado</button></td>';
                                                        }else{
                                                            echo '<td><button class="btn btn-danger btn-md btnActivar" idMatricula="'.$value["id_Matricula"].'" estadoMatricula="1">Desactivado</button></td>';
                                                        } 
                                                        echo'
                                                        <td>
                                                        <button class="btn btn-warning btnEditarMatricula"><i class="fas fa-pencil-alt" style="color:#fff" data-toggle="modal" data-target="#modal"></i></button>
                                                        <button class="btn btn-danger btnEliminarUsuario"><i class="fas fa-trash-alt"></i></button></td>
                                                        </tr>  '; 
                                                    }       
                                            ?>                
                                        
                                        </tbody>
                                    </table>
                                        
                                </div>
                                                        

                                        
                           

                            </div>
                        </div>

                    </div>

                </div>

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
          <div class="card-body">
            <div class="form-group col-md-12">
              <label for="Rol">Matricula</label>
              <input type="text" class="form-control nombre mayus" name="nuevoMatricula" value="" required>
            </div>

            <div class="form-group col-md-12">
              <label for="Descripcion">Precio</label>
              <input type="textarea" class="form-control preciom" name="nuevoPrecio" value="" required>
            </div>

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
