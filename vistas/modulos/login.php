<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="login-logo">
      <a href="login"><b>Gym </b>La Roca</a>
    </div>

    <!-- CONTENEDOR LOGIN -->
    <div class="card-body login-card-body iniciarSesion">
      <p class="login-box-msg">Inicio de Sesión</p>

      <form method="post">
        <div class="form-group mb-3">
          <input type="text" class="form-control usuario" name="ingUsuario" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Usuario" required>
        </div>
        <div class="form-group mb-3">
          <input type="password" class="form-control password" name="ingPassword" placeholder="Contraseña" required> 
          <i class="far fa-eye show-pass" action="hide"></i>
        </div>
        <div class="row mb-2">
          <div class="col-12">
            <button type="submit" class="btn btn-orange login btn-block">Login</button>
          </div>
        </div>
      </form>

      <p class="mb-1">
        <a href="javascript:void(0);" onclick="toggleForm();">¿Olvidaste tu contraseña</a>
      </p>
      <p class="mb-0">
        ¿No tienes una cuenta? <a href="javascript:void(0);" onclick="toggleRegistrar()" class="text-center">Registrate</a>
      </p>
      
        <?php 
          $login = new ControladorUsuarios();
          $login->ctrIngresoUsuario();

          // $user_os        =   ControladorGlobales::ctrGetOS();
          // $user_browser   =   ControladorGlobales::ctrGetBrowser();
          // $device_details =   "<strong>Browser: </strong>" . $user_browser . 
          //                     "<br /><strong>Operating System: </strong>" . $user_os;
          // echo($device_details);
          
        ?>
    </div>

    <!-- CONTENEDOR VERIFICAR EL EMAIL -->
    <div class="card-body login-card-body verificarEmail">
      <p class="login-box-msg">Verifica tu correo</p>
      <form method="post">
        <div class="form-group has-feedback">
          <input type="email" class="form-control"  id="verificarEmail" placeholder="Email" name="" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <div class="row mb-2">
          <div class="col-12">
            <button type="submit" class="btn btn-orange btn-block verificarCorreo">Recuperar por correo</button>
            <button type="submit" class="btn btn-orange btn-block verificarCorreoPreguntas">Recuperar por preguntas</button>
          </div>
          <p class="link mt-3 ml-2">Regresar al <a href="javascript:void(0);" onclick="toggleForm();">Login</a></p>
        </div>

      </form>

    </div>
    
    <!-- CONTENEDOR PREGUNTAS DE SEGURIDAD -->
    <div class="card-body login-card-body questionsBx">
  
      <form method="post">
        <div class="form-row">
          <div class="form-group col-md-12" id="preguntaSeguridad">
          <div class="form-row">
            <?php 
              // for ($i=1; $i <=3 ; $i++) { ?>
              <div class="form-group col-md-12">
                <label for="inputPassword4">Pregunta <?php echo $i?></label>
                <select class="form-control select2" id="preguntaSeleccionada">
                <option value="" selected="selected">Seleccionar...</option>
                <?php 
                        $tabla = "tbl_preguntas";
                        $item = null;
                        $valor = null;

                        $preguntas = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                        foreach ($preguntas as $key => $value) { ?>
                          <option value="<?php echo $value['id_preguntas']?>"><?php echo $value['pregunta']?></option>        
                        <?php 
                        }
                    ?>
                </select>
              </div>
            <?php
              // }            
            ?>
            </div>
          </div>
        </div>
  
        <div class="row mb-2">    
          <div class="col-12">
            <button type="submit" class="btn btn-orange btn-block btn-flat verificarPreguntas" id="verificarPreguntas">Verificar</button>       
          </div>
          <p class="link mt-3 ml-2">Regresar al <a href="javascript:void(0);" onclick="toggleForm(); toggleQuestions();">Login</a></p>
        </div>
      </form>
  
    </div>

    <!-- CONTENEDOR CAMBIAR CONTRASEÑA -->
    <div class="card-body login-card-body cambiarPassword" >
      <p class="login-box-msg">Cambia tu contraseña</p>
      <form method="post" id="cambiarPassword">

      <div class="form-row">
        <div class="form-group col-md-12 passwords" id="passwords">
          <i class="far fa-eye show-nueva-pass primero" action="hide"></i>
          <i class="far fa-eye show-confir-pass segundo" action="hide"></i>
          <span class="resultado-password help-block mt-2 float-right"></span>
        </div>
      </div>
        <!-- <div class="requisito-password">
          <h4>La contraseña debe cumplir con los siguientes requerimientos:</h4>
          <ul>
            <li class="letter">Al menos debe tener <strong>una letra</strong></li>
            <li class="capital">Al menos debe tener <strong>una letra en mayuscula</strong></li>
            <li class="number">Al menos debe tener <strong>un numero</strong></li>
            <li class="special">Al menos debe tener <strong>un caracter especial</strong></li>
            <li class="length">Al menos debe tener <strong>8 caracteres como minimo y 16 maximo</strong></li>
          </ul>
        </div> -->
        
        <div class="row mb-2" id="linkLogin">    
            <div class="col-12" id="btnCambiarPass">
    
            </div>  
        </div>

      </form>
    </div>

    <!-- CONTENEDOR REGISTRAR PERSONA -->
    <div class="card-body login-card-body registrar" >
      <p class="login-box-msg">Registra tus datos personales</p>
      <form method="post" id="">
        <div class="form-row">
          <div class="form-group col-md-3">
                <label for="">Tipo de documento <?php echo $i?></label>
            <select class="form-control select2" name="nuevoTipoDocumento">
                <option selected="selected">Seleccionar...</option>
                <?php 
                    $tabla = "tbl_documento";
                    $item = null;
                    $valor = null;

                    $preguntas = ControladorUsuarios::ctrMostrar($tabla, $item, $valor);

                    foreach ($preguntas as $key => $value) { ?>
                        <option value="<?php echo $value['id_documento']?>"><?php echo $value['tipo_documento']?></option>        
                    <?php 
                    }
                ?>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="identidad">Identidad</label>
            <input type="text" class="form-control" name="nuevoNumeroDocumento" placeholder="Ingrese Identidad" required>
          </div>
          <div class="form-group col-md-3">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingrese Nombre" required>
          </div>
          <div class="form-group col-md-3">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" name="nuevoApellido" placeholder="Ingrese Apellidos" required>
          </div>
        </div>

  
        <div class="form-row">

        <div class="form-group col-md-3">
            <label for="">Usuario</label>
            <input type="text" class="form-control personas" name="nuevoUsuario" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Usuario" required>
          </div>

          <div class="form-group col-md-3">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control email" id="inputEmail4" name="nuevoEmail" placeholder="Ingrese Email" required>
          </div>
          <div class="form-group col-md-3">
            <label>Teléfono</label>
            <input type="text" class="form-control" data-inputmask='"mask": "(999) 9999-9999"' data-mask  name="nuevoTelefono" placeholder="Ingrese Telefono" required>
          </div>
          <div class="form-group col-md-3">
            <label>Fecha de nacimiento</label>
              <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask  name="nuevaFechaNacimiento" placeholder="Ingrese Fecha de Nacimiento" required>
          </div>
        </div>
        <!-- <div class="form-group">
          <label for="inputAddress">Dirección</label>
          <input type="text" class="form-control" id="inputAddress" name="nuevaDireccion" placeholder="Col. Alameda, calle #2..." required>
        </div> -->

        <div class="form-row">
          <div class="form-group col-md-9">
            <label for="inputAddress">Dirección</label>
            <input type="text" class="form-control" id="inputAddress" name="nuevaDireccion" placeholder="Col. Alameda, calle #2..." required>
          </div>
          <div class="form-group col-md-3">
            <label>Sexo</label>
            <select class="form-control select2" name="nuevoSexo" style="width: 100%;" required>
              <option selected="selected">Seleccionar...</option>
              <option value="M">Masculino</option>
              <option value="F">Femenino</option>
            </select>
        </div>
        <div class="form-group col-md-12">
              <label for="exampleInputFile">Foto</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input nuevaFoto" id="exampleInputFile" name="nuevaFoto">
                  <label class="custom-file-label" for="exampleInputFile">Escoger foto</label>
                </div>
                  <img class="img-thumbnail previsualizar ml-2" src="vistas/img/usuarios/default/anonymous.png" alt="imagen-del-usuario" width="100px">
              </div>
                  <p class="p-foto help-block">Peso máximo de la foto 2 MB</p>
            </div>

        <div class="form-row col-md-12">
          <div class="form-group col-md-6">
              <p class="link mt-3 ml-2">Regresar al <a href="javascript:void(0);" onclick="toggleRegistrar();">Login</a></p>
          </div>
          <div class="form-group col-md-6">
            <button type="submit" class="btn btn-primary btnGuardar mt-3 float-right">Guardar</button>
          </div>
        </div>

        <?php
          $tipoPersona = 'default';
          $ingresaPersona = new ControladorPersonas();
          $ingresaPersona->ctrCrearPersona($tipoPersona);
        ?>
      </form>
    </div>
  </div>
</div>
 <!--Bitacora cod.-->

    <?php
        //  $descripcionEvento = " Ingreso a Login";
        //  $accion = "Ingreso";

        //  $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 6,$accion, $descripcionEvento);
  
    ?>
<!-- /.login-box -->

