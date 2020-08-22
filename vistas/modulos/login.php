<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="login-logo">
      <a href="login"><b>Gym</b>La Roca</a>
    </div>

    <!-- CONTENEDOR LOGIN -->
    <div class="card-body login-card-body iniciarSesion">
      <p class="login-box-msg">Inicio de Sesión</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="ingUsuario" placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="ingPassword" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-12">
            <button type="submit" class="btn btn-orange btn-block">Login</button>
          </div>
        </div>
      </form>

      <p class="mb-1">
        <a href="#" onclick="toggelForm();">¿Olvidaste tu contraseña</a>
      </p>
      <p class="mb-0">
        ¿No tienes una cuenta? <a href="#" class="text-center">Registrate</a>
      </p>
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
            <button type="submit" class="btn btn-orange btn-block verificarCorreo" onclick="toggelQuestions();">Verificar</button>
          </div>
          <p class="link">Regresar al <a href="#" onclick="toggelForm();">Login</a></p>
        </div>

      </form>

    </div>
    
    <!-- CONTENEDOR PREGUNTAS DE SEGURIDAD -->
    <div class="card-body login-card-body questionsBx">
  
      <p class="login-box-msg">Preguntas de Seguridad</p>
      <form method="post">
        <div class="form-group has-feedback" id="preguntaSeguridad">
  
        </div>
  
        <div class="row mb-2">    
          <div class="col-12">
            <button type="submit" class="btn btn-orange btn-block btn-flat verificarPreguntas" id="verificarPreguntas" onclick="toggelPassword();">Verificar</button>       
          </div>
          <p class="link">Regresar al <a href="#" onclick="toggelForm(); toggelQuestions();">Login</a></p>
        </div>
      </form>
  
    </div>

    <!-- CONTENEDOR CAMBIAR CONTRASEÑA -->
    <div class="card-body login-card-body cambiarPassword" >
      <p class="login-box-msg">Cambia tu contraseña</p>
      <form method="post" id="cambiarPassword">

        <div class='form-group has-feedback' id="passwords">
          
        </div>
        <div class="con_info">
          <h4>La contraseña debe cumplir con los siguientes requerimientos:</h4>
          <ul>
            <li class="letter">Al menos debe tener <strong>una letra</strong></li>
            <li class="capital">Al menos debe tener <strong>una letra en mayuscula</strong></li>
            <li class="number">Al menos debe tener <strong>un numero</strong></li>
            <li class="special">Al menos debe tener <strong>un caracter especial</strong></li>
            <li class="length">Al menos debe tener <strong>8 caracteres como minimo y 16 maximo</strong></li>
          </ul>
        </div>
        
        <div class="row mb-2" id="linkLogin">    
            <div class="col-12" id="btnCambiarPass">

            </div>  
        </div>

      </form>
    </div>
  </div>
</div>
<!-- /.login-box -->

