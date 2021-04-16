<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perfil</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!--Bitacora cod.-->

      <?php
          $descripcionEvento = "Consulta a perfil";
          $accion = "Consulta";

          $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 7,$accion, $descripcionEvento);
      ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
          <div class="col-md-4">
            <div class="ajustes ajuste-cuenta" idUsuario="<?php echo $_SESSION["id_persona"]?>">
              <h3>Ajustes de cuenta</h3>
              <p>Detalles acerca de su información personal</p>
            </div>
            <div class="ajustes ajuste-password">
              <h3>Contraseña</h3>
              <p>Cambie la contraseña de su cuenta</p>
            </div>
            <div class="ajustes ajuste-preguntas" idUsuario="<?php echo $_SESSION["id_usuario"]?>">
              <h3>Preguntas de seguridad</h3>
              <p>Cambie las preguntas/respuestas asociadas a su cuenta</p>
            </div>
          </div>
            
          <div class="card col-8 ajustes-usuario">
          
            <div  id="datos-generales" class="card-body box-profile datos-generales">
              <div class="row mt-4 mb-5">                  
                <div class="col-md-3 contenedorFoto">
                  <div class="float-right">
                    <?php
                      $tabla = 'tbl_usuarios';
                      $item = 'id_personas';
                      $valor = $_SESSION['id_persona'];
                      $usuario = ControladorUsuarios::ctrMostrarUsuarios($tabla, $item, $valor);

                      // var_dump($usuario);

                      if($usuario["foto"] != ""){
                      echo '<img src="'.$usuario["foto"].'" class="profile-user-img img-fluid img-circle imgUsuario" alt="User Image">';
                      } else {
                      echo '<img src="vistas/img/usuarios/default/default2.jpg" class="profile-user-img img-fluid img-circle imgUsuario" alt="User Image">';
                      }
                    ?>
                  </div>
                </div>

                <div class="col-md-4 user">
                  <h3 class="profile-username"><?php echo $usuario["nombre"]." ". $usuario["apellidos"]?></h3>
                  <p class="text-muted"><?php echo $usuario["rol"]?></p>
                </div>
                
                <div class="col-md-4 mt-4 contenedorBtnEditarFoto">
                    <a href="javascript:void(0);" class="btn btn-outline-orange btn-block btnEditarFoto"><b>Cambie su foto</b></a>                  
                </div>

                <div class="col-md-8 mt-4 editarFotoUsuario">
                  <form role="form" method="post" class="formulario" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="col-6">
                        <div class="form-group">
                            <!-- <label for="inputFoto">Foto</label> -->
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input nuevaFoto" id="inputFoto" name="editarFoto">
                                <label class="custom-file-label" for="inputFoto">Escoger foto</label>
                                <input type="hidden" name="fotoActual" id="fotoActual" value="<?php echo $usuario["foto"]?>">
                              </div>
                            </div>
                                <p class="p-foto help-block ml-4">Peso máximo de la foto 2 MB</p>
                        </div>
                      </div>
                      <div class="col-6">
                        <button type="submit" class="btn btn-orange ml-3 btn-md guardar">Guardar</button>
                        <button class="btn btn-outline-danger btn-md ml-2 salirFoto">Atras</button>                   
                      </div>

                    </div>
                  </form>
                </div>
              </div>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Nombre usuario:</b> <a class="float-right text-muted"><?php echo $usuario["usuario"]?></a>
                </li>
                <li class="list-group-item">
                  <b>Correo:</b> <a class="float-right text-muted"><?php echo $usuario["correo"]?></a>
                </li>
                <li class="list-group-item">
                  <b>Fecha de vencimiento:</b> <a class="float-right text-muted"><?php echo $usuario["fecha_vencimiento"]?></a>
                </li>
              </ul>

            </div>
            
            <?php
                $ajustes = 'prueba';
                $tipoPersona = 'usuarios';
                $pantalla = 'perfil';
                $ingresarPersona = new ControladorPersonas();
                $ingresarPersona->ctrEditarPersona($ajustes, $tipoPersona, $pantalla);
            
                $idPersona = $_SESSION['id_persona'];
                $actualizarContraseña = new ControladorUsuarios();
                $actualizarContraseña->ctrCambiarContraseñaUsuario($idPersona);

                $idUsuario = $_SESSION['id_usuario'];
                $actualizarPreguntasRespuestas = new ControladorUsuarios();
                $actualizarPreguntasRespuestas->ctrActualizarPreguntasRespuestas($idUsuario);

                $usuario = $_SESSION['usuario'];
                $editarFoto = new ControladorUsuarios();
                $editarFoto->ctrEditarFoto($idUsuario, $usuario);
            ?>

          </div>
            
            <!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>