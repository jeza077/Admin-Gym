<div class="content-wrapper">

  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Respaldo de la base de datos</h1>
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

              <!-- <div class="card"> -->

                <!-- <div class="card-body"> -->


                  <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">

                      <a class="nav-link active" id="datosRespaldo" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Respaldo</a>

                    </li>

                   

                    <li class="nav-item" role="presentation">

                      <a class="nav-link" id="datosRestauracion" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Restauracion</a>

                    </li>
            

                  </ul>

                 <!--========================================================
                              ROL
                    ==========================================================-->  
                  <!-- Tab panes -->
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="Rol">

                      <br>

                      <form role="form" method="post" autocomplete="off">
                            <div class="form-group ">
                                  <label>Servidor</label>
                                <div class="input-group col-md-6">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class=" fas fa-server"></i></span>
                                  </div>
                                      <input type="text-center" minlength="1" maxlength="30" value="localhost" readonly class="form-control" id="servidor" name="servidor" placeholder="Ejemplo: 'localhost'" required>
                                </div>
                            </div>

                            <div class="form-group ">
                                  <label>Usuario</label>
                                <div class="input-group col-md-6">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  </div>
                                      <input type="text-center" class="form-control" value="root" readonly minlength="1" maxlength="30" id="usuario" name="usuario" placeholder="Ejemplo: 'root'" required>
                                </div>
                            </div>

                            <div class="form-group ">
                                  <label>Contraseña</label>
                                <div class="input-group col-md-6">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                                  </div>
                                      <input type="text-center" class="form-control" id="contrasenia" name="contrasenia" placeholder="db password" readonly>
                                </div>
                            </div>
                            <div class="form-group ">
                                  <label>Base de datos</label>
                                <div class="input-group col-md-6">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-database"></i></span>
                                  </div>
                                      <input type="text-center" class="form-control" minlength="1" maxlength="30" id="nombrebd" name="nombrebd" value="gym_lr" readonly placeholder="Nombre de la base de datos a respaldar" required>
                                </div>
                            </div>

                            <button type="button" class="btn btn-success float-center" id="btn_respaldar" name="btn_respaldar" >Respaldar</button>
                            

                      </form>
                     

                    </div>

                  
                     <!--========================================================
                           RESTAURAR
                    ==========================================================-->  
                    <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="Inscripciones  y   Matricula">

                    <br>
                            <div class="form-group ">
                                  <label>Servidor</label>
                                <div class="input-group col-md-6">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class=" fas fa-server"></i></span>
                                  </div>
                                      <input type="text-center" minlength="1" maxlength="30" value="localhost" readonly class="form-control" id="servidor2" name="servidor2" placeholder="Ejemplo: 'localhost'" required>
                                </div>
                            </div>

                            <div class="form-group ">
                                  <label>Usuario</label>
                                <div class="input-group col-md-6">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  </div>
                                      <input type="text-center" class="form-control" value="root" readonly minlength="1" maxlength="30" id="usuario2" name="usuario2" placeholder="Ejemplo: 'root'" required>
                                </div>
                            </div>

                            <div class="form-group ">
                                  <label>Contraseña</label>
                                <div class="input-group col-md-6">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                                  </div>
                                      <input type="text-center" class="form-control" id="contrasenia2" name="contrasenia2" placeholder="db password" readonly>
                                </div>
                            </div>

                            <div class="form-group ">
                                  <label>Base de datos</label>
                                <div class="input-group col-md-6">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-database"></i></span>
                                  </div>
                                      <input type="text-center" class="form-control" minlength="1" maxlength="30" id="nombrebd2" name="nombrebd2" value="gym_lr" readonly placeholder="Nombre de la base de datos a respaldar" required>
                                </div>
                            </div>

                            <div class="form-group ">
                                    <label>Seleccion de la restauracion </label>
                                  <div class="input-group col-md-6">   
                                    <span class="input-group-text"><i class="fas fa-database"></i></span>
                                     <select class="form-control input-lg" name="restorePoint" id="restorePoint" required>

                                  
                                  <option value="" disabled="" selected="">Selecciona un punto de restauración</option>


                                <?php
                                  
                                  include 'vistas/modulos/connet2.php';
               
                                  $options='';
               
                                  $ruta=BACKUP_PATH;
              
                                  if(is_dir($ruta)){
            
                                    if($aux=opendir($ruta)){
        
                                      while(($archivo = readdir($aux)) !== false){
          
                                        if($archivo!="."&&$archivo!=".."){
            
                                          $nombrearchivo=str_replace(".sql", "", $archivo);
            
                                          $nombrearchivo=str_replace("-", ":", $nombrearchivo);
            
                                          $ruta_completa=$ruta.$archivo;
            
                                          if(is_dir($ruta_completa)){
            
                                          }else{

              
                                            echo'<option value="'."../.".$ruta_completa.'">'.$nombrearchivo.'</option>';

                                          }

                                        }

                                      }

                                      closedir($aux);

                                    }

                                  }else{
                                    
                                    echo $ruta."No es válida";
                                  }


                                ?>
       

                                </select>
                                        
                                  </div>
                                     
                               
                            </div>
                        

                            <button type="button" class="btn btn-success float-center" id="btn_restaurar">Restaurar</button>
                            
                    
                    </div>


                  </div>

                <!-- </div> -->

              <!-- </div>  -->

            </div>

        </div>

      </div>

    </div>

  </section>

</div>