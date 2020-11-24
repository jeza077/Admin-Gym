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
            
            <div class="form-group col-md-12  mb-4 passwords">
                <label class='mt-2'>Contraseña actual</label>
                <input type='password' class='form-control password-actual' placeholder='Ingrese nueva contraseña' name='passwordActual' required>
                <i class="far fa-eye show-pass" action="hide"></i>
                <label class='mt-4'>Nueva contraseña</label>
                <input type='password' class='form-control nueva-password' placeholder='Ingrese nueva contraseña' name='editarPassword' required>
                <label class='mt-4'>Confirmar contraseña</label>
                <input type='password' class='form-control confirmar-password' placeholder='Confirmar contraseña'>
                <i class="far fa-eye show-nueva-pass primero" action="hide"></i>
                <i class="far fa-eye show-confir-pass segundo" action="hide"></i>
                <span class="resultado-password help-block float-right"></span>
            </div>

            <!-- <div class="modal-footer"> -->
            <div class="form-group final mt-3 float-right">
                <button type="" class="btn btn-primary" id="cambiarPassAjustes">Guardar</button>
                <button type="button" class="btn btn-danger salirPerfil" data-dismiss="modal">Salir</button>
            </div>

        </form>
    </div>
</div>
<script>
    
    requisitosPassword("center-start");
    longitudString($('input[type=password]'),16); //Longitud maxima Input tipo Password Global.
    $('input[type=password]').keydown(impedirEspacios); //Evitar espacios en Input de tipo Password, Global.
    $('#cambiarPassAjustes').attr('disabled', true);
    $(".nueva-password").on('change', function(){
        cambiarPass = $(this).val();
    });

    $(".confirmar-password").on('input', function(){
        var confirPass = $(this).val();
        var btnCambiarPass = $('#cambiarPassAjustes');

        confirmarContraseña(cambiarPass, confirPass, btnCambiarPass);
    })

    $('.show-pass').on('click', function () { 
        var action = $(this).attr('action');
        var mostrarPass = $('.show-pass');
        var nuevaPass = $('input[name="passwordActual"]');
        mostrarContraseña(nuevaPass, mostrarPass, action);
    });

    $('.show-nueva-pass').on('click', function () { 
        var action = $(this).attr('action');
        var mostrarPass = $('.show-nueva-pass');
        console.log(mostrarPass.val());
        var nuevaPass = $('.nueva-password');
        mostrarContraseña(nuevaPass, mostrarPass, action);
    });

    $('.show-confir-pass').on('click', function () { 
        var action = $(this).attr('action');
        var mostrarPass = $('.show-confir-pass');
        var confirmarPass = $('.confirmar-password');
        mostrarContraseña(confirmarPass, mostrarPass, action);
    });
</script>