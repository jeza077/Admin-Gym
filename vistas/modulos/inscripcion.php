<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                 <h1>Inscripciones</h1>
                </div>
                <div class="col-sm-6">                       
                    <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevainscripcion">
                        Nueva Inscripcion    
                    </button>
                    <button class="btn btn-danger btnExportarInscripcion float-right mr-3 ">
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
                    $descripcionEvento = " Consulto la pantalla de mantenimiento";
                    $accion = "consulta";

                    $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);
       
                ?>

                <!--========================================================
                        PARAMETROS
                    ==========================================================-->   

                <table class="table table-striped table-bordered tablas text-center">
                    
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Tipo de inscripcion</th>

                            <th scope="col">Precio</th>

                            <th scope="col">Dias</th>

                            <th scope="col">Estado</th>

                            <th scope="col">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>             
                        <?php
                                // $tabla = "tbl_inscripcion";
                                $item = null;
                                $valor = null;
                                
                                $inscripcion = ControladorMantenimientos::ctrMostrarInscripcion($item,$valor);
                                // var_dump($inscripcion);

                                foreach ($inscripcion as $key => $value){
                                echo '
                                    <tr>
                                
                                    <td>'.($key + 1).'</td>
                                    <td>'.$value["tipo_inscripcion"].'</td>
                                    <td>'.$value["precio_inscripcion"].'</td>
                                    <td>'.$value["cantidad_dias"].'</td>';
                                    if($value['estado'] != 0){
                                        echo '<td><button class="btn btn-success btn-md btnActivar" idInscripcion="'.$value["id_inscripcion"].'" estadoInscripcion="0">Activado</button></td>';
                                    }else{
                                        echo '<td><button class="btn btn-danger btn-md btnActivar" idInscripcion="'.$value["id_inscripcion"].'" estadoInscripcion="1">Desactivado</button></td>';
                                    } 
                                    echo'
                                        <td>
                                        <button class="btn btn-warning btnEditarInscripcion" editarIdInscripcion="'.$value["id_inscripcion"].'" data-toggle="modal" data-target="#modalEditarInscripcion"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>

                                        <button class="btn btn-danger btnEliminarInscripcion" ideliminarInscripcion="'.$value["id_inscripcion"].'"><i class="fas fa-trash-alt"></i></button></td>
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
MODAL AGREGAR NUEVA INSCRIPCION
======================================-->

<div class="modal fade" id="modalNuevainscripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
    <div class="modal-dialog " role="document">

         <div class="modal-content">

                <form role="form" method="post" autocomplete="off">

                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva Inscripcion</h5>
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
                        <label for="Rol">Inscripcion</label>
                        <input type="text" class="form-control nombre mayus" name="nuevoInscripcion" value="" required>
                        </div>

                        <div class="form-group col-md-12">
                        <label for="Descripcion">Precio</label>
                        <input type="text" class="form-control preciom " name="nuevoPrecio" value="" required>
                        </div>

                        <div class="form-group col-md-12">
                        <label for="Descripcion">Dias</label>
                        <input type="text" class="form-control preciom " name="nuevoDias" value="" required>
                        </div>

                    </div>

                    </div>

                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                    <div class="modal-footer">
                    <button type="button" class="btn btn-orange" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                    <?php

                    $crearInscripcion = new ControladorMantenimientos();
                    $crearInscripcion -> ctrInscripcionInsertar();

                    ?>




                </form>

                

        </div>

     </div>
                    

</div>

<!--=====================================
MODAL EDITAR MATRICULA
======================================-->

<div class="modal fade" id="modalEditarInscripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
    <div class="modal-dialog " role="document">

        <div class="modal-content">

            <form role="form" method="post" autocomplete="off">
            

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Inscripcion</h5>
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
                            <label for="Rol">Inscripcion</label>
                            <input type="text" class="form-control nombre mayus" id="editarInscripcion" name="editarInscripcion" value="" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="Descripcion">Precio</label>
                            <input type="textarea" class="form-control preciom" id="editarPrecioInscripcion" name="editarPrecioInscripcion" value="" required>
                        </div>
                        <input type="hidden" id="editarIdInscripcion" name="editarIdInscripcion">

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

                        $editarInscripcion = new ControladorGlobales();
                        $editarInscripcion->ctrEditarInscripcion();

                    ?>
            </form>        

        </div>

    </div>
        

</div>

                    <?php

                        $borrarInscripcion = new ControladorGlobales();
                        $borrarInscripcion->ctrBorrarInscripcion();

                    ?>




