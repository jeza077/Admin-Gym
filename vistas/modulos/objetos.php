<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Objetos</h1>
          </div>
          <div class="col-sm-6">
                <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoObjeto">
                  Nuevo objeto      
                </button>
                <button class="btn btn-danger btnExportarObjetos float-right mr-3 ">
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
            // $descripcionEvento = " Consultó la pantalla de documentos";
            // $accion = "Consulta";

            // $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

        ?>
        <table class="table table-bordered table-striped tablas text-center">
            
            <thead>
              <tr>
                <th scope="col">N.°</th>
                <th scope="col">Objeto</th>
                <th scope="col">Link</th>
                <th scope="col">Icono</th>

              </tr>
            </thead>
            
            <tbody>  
                <?php
                  $tabla = "tbl_objetos";
                  $item = null;
                  $valor = null;
                  $all = null;
                  
                  $preguntas = ControladorUsuarios::ctrMostrar($tabla, $item, $valor, $all);
                  // var_dump($preguntas);

                  foreach ($preguntas as $key => $value){
                    echo '
                      <tr>  
                          <td>'.($key + 1).'</td>
                          <td>'.$value["objeto"].'</td>
                          <td>'.$value["link_objeto"].'</td>
                          <td>'.$value["icono"].'</td>
                          
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
MODAL AGREGAR NUEVO OBJETO
======================================-->

<div class="modal fade" id="modalNuevoObjeto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo objeto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
            <div class="form-group col-md-12">
                <label for="Rol">Objeto</label>
                <input type="text" class="form-control mayus sinCaracteres sinNumeros soloUnEspacio longitudNombre" name="nuevoObjeto" value="" placeholder="Ingrese objeto" required>
            </div>

            <div class="form-group col-md-12">
                <label for="Descripcion">Link</label>
                <input type="text" class="form-control sinNumeros longitudNombre sinEspacioDoc" name="nuevoLink" value="" placeholder="Ingrese el link" required>
            </div>

            <div class="form-group col-md-12">
                <label for="Descripcion">Icono</label>
                <input type="text" class="form-control sinNumeros longitudNombre soloUnEspacio" name="nuevoIcono" value="" placeholder="Ingrese el icono" required>
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

        $crearObjeto = new ControladorMantenimientos();
        $crearObjeto -> ctrObjetoInsertar();

        ?>
      </form>
    

    </div>

  </div>
        

</div>


