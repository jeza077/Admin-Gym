<?php
require_once "../../controladores/personas.controlador.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
?>
<div class="container-fluid ajustes-password">
    <div class="card-header mt-2">
        <h3>Contraseña</h3>
    </div>
    <div class="card-body">
        <form role="form" method="post" class="formulario" enctype="multipart/form-data">
            
            <div class="form-group col-md-12 passwords">
                <label class='mt-2'>Contraseña actual</label>
                <input type='password' class='form-control nueva-password' placeholder='Ingrese nueva contraseña' name='passwordActual' required>
                <label class='mt-4'>Nueva contraseña</label>
                <input type='password' class='form-control nueva-password' placeholder='Ingrese nueva contraseña' name='editarPassword' required>
                <label class='mt-4'>Confirmar contraseña</label>
                <input type='password' class='form-control confirmar-password' placeholder='Confirmar contraseña'>
                <i class="far fa-eye show-nueva-pass primero" action="hide"></i>
                <i class="far fa-eye show-confir-pass segundo" action="hide"></i>
                <span class="resultado-password help-block mt-2 float-right"></span>
            </div>

            <!-- <div class="modal-footer"> -->
            <div class="form-group final mt-4 float-right">
                <button type="" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger salirPerfil" data-dismiss="modal">Salir</button>
            </div>

        </form>
    </div>
</div>