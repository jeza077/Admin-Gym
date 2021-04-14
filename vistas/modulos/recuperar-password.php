<?php

$password = new ControladorUsuarios();
$password->ctrRevisarCodigoFecha();

?>

<div class="login-box recu-password">
  <!-- /.login-logo -->
  <div class="card">
    <div class="login-logo">
      <a href="login"><b>Gym</b>La Roca</a>
    </div>
<!--Bitacora cod.-->

<?php
	         $accion = "Ingreso";
		       $descripcionEvento = " Ingresó a recuperar contraseña ";
  
	         $bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION["id_usuario"], 1,$accion, $descripcionEvento);
           ?>
    <!-- CONTENEDOR CAMBIAR CONTRASEÑA -->
    <div class="card-body login-card-body">
      <p class="login-box-msg">Cambia tu contraseña</p>
      <form method="post" id="cambiarPassword">
      <div class="form-row">
        <div class="form-group col-md-12 passwords">
          <label class='mt-2'>Nueva contraseña</label>
          <input type='password' class='form-control nueva-password' placeholder='Ingrese nueva contraseña' name='editarPassword' required>
          <label class='mt-2'>Confirmar contraseña</label>
          <input type='password' class='form-control confirmar-password' placeholder='Confirmar contraseña'>
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
            <div class="col-12">
              <button type='submit' class='btn btn-orange btn-block btn-flat' id='cambiarContraseñaPorCorreo'>Cambiar contraseña</button>
            </div>  
        </div>
        
        <?php 
          $recuperarPasswordCodigo = new ControladorUsuarios();
          $recuperarPasswordCodigo->ctrCambiarContraseñaPorCodigo();
        ?>
      </form>
    </div>
  </div>

</div>
<!-- /.login-box -->
<?php 
  $recuperarPasswordCodigo = new ControladorUsuarios();
  $recuperarPasswordCodigo->ctrCambiarContraseñaPorCodigo();
?>

