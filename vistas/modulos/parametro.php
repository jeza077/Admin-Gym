<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parametros</h1>
          </div>
          <div class="col-sm-6">
              <button class="btn btn-danger btnExportarParametro float-right mr-3 ">
                Exportar PDF      
              </button>
       
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>  

  <section class="content">

    <div class="card">

      <div class="card-body">

        <!-- <div class="row"> -->

        <!-- <div class=" col-sm-12"> -->
      
        <?php
        $descripcionEvento = "".$_SESSION["usuario"]." Consultó la pantalla de parametros";
        $accion = "Consulta";

        $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 20,$accion, $descripcionEvento);

        ?>

        <!--========================================================
            PARAMETROS
        ==========================================================-->   

        <table class="table table-striped table-bordered tablas text-center">
            <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Parametros</th>
                  <th scope="col">Valor</th>
                  <th scope="col">Editar</th>
              
              
              </tr>
            </thead>
            <tbody>
              <?php
              // $tabla = "tbl_roles";
              $item = null;
              $valor = null;
              
              $parametros = ControladorUsuarios::ctrMostrarParametros($item, $valor);
              //var_dump($parametros);

              foreach ($parametros as $key => $value){
                  echo '
                  <tr>
                  
                  <td>'.($key + 1).'</td>
                  <td>'.$value["parametro"].'</td>
                  <td>'.$value["valor"].'</td>
                  <td>
                    <button class="btn btn-warning  btnEditarParametro" idParametro="'.$value["id_parametro"].'" data-toggle="modal" data-target="#modalParametros"><i class="fas fa-pencil-alt" style="color:#fff"></i></button>
                  </td>
                </tr>
                ';
              }

              
              
              ?>                
            </tbody>
        </table>

        <!-- </div> -->

        <!-- </div> -->

      </div>

    </div>

  </section>

</div>



<!--==================================================================
MODIFIRCAR PARAMETROS
======================================================================-->
<div class="modal fade" id="modalParametros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog  " role="document">

    <div class="modal-content">

      <form role="form" method="post" autocomplete="off">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Parametro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

           <div class="card-body">
              <div class= "form-group col-md-12">
               <label for="parametro">Parametro</label>
               <input type="text" class="form-control nombre mayus" id="editarParametro" name="editarParametro" value="" readonly >
              </div>
          
           

              <div class= "form-group col-md-12">
               <label for="Valor">Valor</label>
               <input type="text" class="form-control " id="editarValorParametro" name="editarValorParametro" placeholder="Escriba el nuevo valor del parametro"requiered>
              </div>

              <input type="hidden" id="editarIdParametro" name="editarIdParametro">
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

          $EditarParametro = new ControladorGlobales();
          $EditarParametro->ctrEditarParametro();

        ?>




      </form>


    

    </div>

  </div>
        

</div>
