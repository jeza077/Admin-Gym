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
          $descripcionEvento = "Consulta a Perfil";
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
              <p>Detalles acerca de tu informacion personal</p>
            </div>
            <div class="ajustes ajuste-password">
              <h3>Contraseña</h3>
              <p>Cambia la contraseña de tu cuenta</p>
            </div>
            <div class="ajustes ajuste-preguntas" idUsuario="<?php echo $_SESSION["id_usuario"]?>">
              <h3>Preguntas de seguridad</h3>
              <p>Cambia las preguntas/respuestas asociadas a tu cuenta</p>
            </div>
          </div>
            
          <div class="card col-8 ajustes-usuario">
          
            <div class="card-body box-profile datos-generales">
              <div class="row mb-5">                  
                <div class="col-md-3">
                  <div class="float-right">
                    <?php
                      if($_SESSION["foto"] != ""){
                      echo '<img src="'.$_SESSION["foto"].'" class="profile-user-img img-fluid img-circle" alt="User Image">';
                      } else {
                      echo '<img src="vistas/img/usuarios/default/default2.png" class="profile-user-img img-fluid img-circle" alt="User Image">';
                      }
                    ?>
                  </div>
                </div>

                <div class="col-md-4 user">
                  <h3 class="profile-username"><?php echo $_SESSION["nombre"]." ". $_SESSION["apellidos"]?></h3>

                  <p class="text-muted"><?php echo $_SESSION["rol"]?></p>
                </div>
                
                <div class="col-md-4 mt-4">
                  <a href="javascript:void(0);" class="btn btn-outline-orange btn-block"><b>Cambia tu foto</b></a>                  
                </div>
              </div>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Nombre Usuario:</b> <a class="float-right text-muted">JEZA</a>
                </li>
                <li class="list-group-item">
                  <b>Correo:</b> <a class="float-right text-muted">jesus@correo.com</a>
                </li>
                <li class="list-group-item">
                  <b>Fecha de Vencimiento</b> <a class="float-right text-muted">2021/11/06</a>
                </li>
              </ul>

            </div>
            
            <?php
            // $item1 = "id_usuario";
            // $valor1 = 9;
            
            // $item2 = null;
            // $valor2 = null;
            
            // $item3 = null;
            // $valor3 = null;
    
            // $respuesta = ControladorUsuarios::ctrMostrarPreguntas($item1, $valor1, $item2, $valor2, $item3, $valor3);
            // var_dump($respuesta);

                $ajustes = 'prueba';
                $tipoPersona = 'usuarios';
                $pantalla = 'perfil';
                $ingresarPersona = new ControladorPersonas();
                $ingresarPersona->ctrEditarPersona($ajustes, $tipoPersona, $pantalla);
            
                $idPersona = $_SESSION['id_persona'];
                $ingresarPersona = new ControladorUsuarios();
                $ingresarPersona->ctrCambiarContraseñaUsuario($idPersona);
            ?>

          </div>
            
            <!-- /.card -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>