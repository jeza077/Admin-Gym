<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administración de permisos</h1>
          </div>
          <div class="col-sm-6">
              <!-- <button class="btn btn-orange float-right"  data-toggle="modal" data-target="#modalNuevoRol">
                Nuevo Rol        
              </button> -->
              <button class="btn btn-danger btnExportarPermisosRol float-right mr-3 ">
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
            $descripcionEvento = " Consultó la pantalla de mantenimiento";
            $accion = "Consulta";

            $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);

        ?>

          <!--========================================================
                      ROL
            ==========================================================-->   

        <table class="table table-striped table-bordered tablaPermisosRol text-center">

          <thead>
                          
            <tr>                    
                <th scope="col">N.°</th>   
                <th scope="col">Rol</th> 
                <th scope="col">Pantalla</th> 
                <th scope="col">Consulta</th>  
                <th scope="col">Agregar</th>
                <th scope="col">Actualizar</th>
                <th scope="col">Eliminar</th>
            </tr>

          </thead>

        </table> 

      </div>

    </div>

  </section>

</div>
