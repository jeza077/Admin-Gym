//** VERIFICAR QUE USUARIO NO SE REPITA */
$('.nuevoUsuario').blur(function (){

    $('.alert').remove();
    
    var usuarioIngresado = $(this).val();

    var datos = new FormData();
    datos.append("validarUsuario", usuarioIngresado);

    $.ajax({

        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {
            // console.log(respuesta);

            if(respuesta){
                $('.alertaUsuario').append('<div class="alert alert-danger fade show mt-2" role="alert"><i class="icon fas fa-ban"></i>Usuario ya existente, ingrese uno diferente.</div>');
                setTimeout(function () {
                    $('.alert').remove();
                }, 3000)
                
                $('.nuevoUsuario').css('border', '1px solid red');
                $('.nuevoUsuario').focus();
            } else {
                $('.alert').remove();
                $('.nuevoUsuario').css('border', '1px solid green');
            }
        }

    });

})


//** SUBIR FOTO DEL USUARIO-EMPLEADO *//
$(".nuevaFoto").change(function () { 
    var imagen = this.files[0];
    // console.log(imagen)

    /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
        $(".nuevaFoto").val("");
            Swal.fire({
                title: "Error al subir imagen",
                text: "¡La imagen debe estar en formato JPG o PNG!",
                icon: "error",
                confirmButtonText: "Cerrar",
            });

    } else if(imagen["size"] > 2000000) {
         $(".nuevaFoto").val("");
            Swal.fire({
                title: "Error al subir imagen",
                text: "¡La imagen no debe pesar mas de 2MB!",
                icon: "error",
                confirmButtonText: "Cerrar",
            });
            
    } else {
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function (event) {
            var rutaImagen = event.target.result;

            $(".previsualizar").attr("src", rutaImagen);
        });
    }
});


//** ------------------------------------*/
//         EDITAR USUARIO 
// --------------------------------------*/ 
$(document).on('click', '.btnEditarUsuario', function () {
    // e.preventDefault();
    var idPersonaUsuario = $(this).attr('idUsuario');
    // console.log(idPersonaUsuario);

    var datos = new FormData();
    datos.append('idPersonaUsuario', idPersonaUsuario);

    $.ajax({

        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {
            // console.log(respuesta);

            $('.idPersona').val(respuesta['id_personas']);
            $('#editarTipoDocumento').html(respuesta['tipo_documento']);
            $('#editarTipoDocumento').val(respuesta['id_documento']);
            $('input[name=editarNumeroDocumento]').val(respuesta['num_documento']);
            $('input[name=editarNombre]').val(respuesta['nombre']);
            $('input[name=editarApellido]').val(respuesta['apellidos']);
            $('input[name=editarEmail]').val(respuesta['correo']);
            $('input[name=editarTelefono]').val(respuesta['telefono']);
            $('input[name=editarFechaNacimiento]').val(respuesta['fecha_nacimiento']);
            $('input[name=editarDireccion]').val(respuesta['direccion']);
            $('#editarSexo').html(respuesta['sexo']);
            $('#editarSexo').val(respuesta['sexo']); 
            $('input[name=editarUsuario]').val(respuesta['usuario']);
            $('#editarRol').html(respuesta['rol']);
            $('#editarRol').val(respuesta['id_rol']);
            $('#passwordActual').val(respuesta['password']);
            $('#fotoActual').val(respuesta['foto']);
            if(respuesta['foto'] != ""){
                $('.previsualizar').attr('src', respuesta['foto']);
            } else {
                $('.previsualizar').attr('src', 'vistas/img/usuarios/default/default2.jpg');
            }
        }

    });

});
//** ------------------------------------*/
//   VER DATOS DE USUARIO A DETALLES
// --------------------------------------*/ 
$(document).on('click', '.btnVerUsuario', function () {
    // e.preventDefault();
    let idPersonaUsuario = $(this).attr('idUsuario');
    // console.log(idPersonaUsuario);

    let datos = new FormData();
    datos.append('idPersonaUsuario', idPersonaUsuario);

    $.ajax({

        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,  
        dataType: "json",
        success: function(respuesta) {
            console.log(respuesta);

            $('#detalleCorreoUsuario').val(respuesta['correo']);
            $('#detalleTelefonoUsuario').val(respuesta['telefono']);
            $('#detalleDireccionUsuario').val(respuesta['direccion']);
            $('#detalleSexoUsuario').val(respuesta['sexo']);
            $('#detalleFechaNacUsuario').val(respuesta['fecha_nacimiento']);
            
        }

    });

});



//** ------------------------------------*/
//         ACTIVAR USUARIO 
// --------------------------------------*/ 
$(document).on('click', '.btnActivar', function () {
    // e.preventDefault();
    var idUsuario = $(this).attr('idUsuario');
    var estadoUsuario = $(this).attr('estadoUsuario');

    var datos = new FormData();
    datos.append('activarId', idUsuario);
    datos.append('activarUsuario', estadoUsuario);

    $.ajax({

        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            // console.log(respuesta);


        }

    });

    if(estadoUsuario == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario',1);

    } else {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        $(this).html('Activado');
        $(this).attr('estadoUsuario',0);
        
    }
});

//** ------------------------------------*/
//         BORRAR USUARIO 
// --------------------------------------*/ 
$(document).on('click', '.btnEliminarUsuario', function () {
    var idPersona = $(this).attr('idPersona');
    var fotoUsuario = $(this).attr('fotoUsuario');
    var usuario = $(this).attr('usuario');

    Swal.fire({
        title: "¿Estas seguro de borrar el usuario?",
        text: "¡Si no lo estas, puedes cancelar la accion!",
        icon: "info",
        showCancelButton: true,
        cancelButtonColor: "#DC3545",
        heightAuto: false,
        allowOutsideClick: false
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=usuarios&idPersona="+idPersona+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
        }
    });
});


//** ------------------------------------*/
//         BORRAR BITACORA 
// --------------------------------------*/ 
$(document).on('click', '.btnEliminarBitacora', function () {
    var idBitacora = $(this).attr('idBitacora');
   

    Swal.fire({
        title: "¿Estas seguro de borrar el registro de bitacora?",
        text: "¡Si no lo estas, puedes cancelar la accion!",
        icon: "info",
        showCancelButton: true,
        cancelButtonColor: "#DC3545",
        heightAuto: false,
        allowOutsideClick: false
    }).then((result)=>{
        if(result.value){
            window.location = "index.php?ruta=bitacora&idBitacora="+idBitacora;
        }
    });
});




valorBuscar = "";
$(document).on('blur', '.ClaseBuscar', function () {
    // console.log($('.ClaseBuscar').val())
  valorBuscar = $('.ClaseBuscar').val();
});
//** ------------------------------------*/
//         IMPRIMIR USUARIOS 
// --------------------------------------*/ 
exportarPdf('.btnExportarUsuarios', 'usuarios');

// $(document).on('click', '.btnExportarUsuarios', function () {


//     if(!valorBuscar){
//         window.open("extensiones/tcpdf/pdf/usuarios-pdf.php");
//     } else {
//         var rango = valorBuscar;
//         window.open("extensiones/tcpdf/pdf/usuarios-pdf.php?&rango="+rango);
//     }

// });


//**------------ PERFIL ------------ **//
//** ------------------------------------*/
//        AJUSTES GENERALES USUARIO
// --------------------------------------*/
$(document).on('click', '.ajuste-cuenta', function (e) {
    e.preventDefault();
    var idPersonaUsuario = $(this).attr('idUsuario');
    // console.log(idPersonaUsuario);
    
    $.ajax({
        url: "vistas/modulos/ajustes-cuenta.php",
        success: function (response) {
            
            var clone = $('.datos-generales').clone();
            $('.datos-generales').remove();
            if(!$('.ajustes-usuario').hasClass('contenedor-datos')){
                $('.ajustes-usuario').addClass('contenedor-datos');
                $('.ajustes-usuario').append(response);
            }
            

            var datos = new FormData();
            datos.append('idPersonaUsuario', idPersonaUsuario);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,  
                dataType: "json",
                success: function(respuesta) {
                    // console.log(respuesta);

                    if(respuesta){
                        $('.idPersona').val(respuesta['id_personas']);
                        $('#editarTipoDocumento').html(respuesta['tipo_documento']);
                        $('#editarTipoDocumento').val(respuesta['id_documento']);
                        $('input[name=editarNumeroDocumento]').val(respuesta['num_documento']);
                        $('input[name=editarNombre]').val(respuesta['nombre']);
                        $('input[name=editarApellido]').val(respuesta['apellidos']);
                        $('input[name=editarEmail]').val(respuesta['correo']);
                        $('input[name=editarTelefono]').val(respuesta['telefono']);
                        $('input[name=editarFechaNacimiento]').val(respuesta['fecha_nacimiento']);
                        $('input[name=editarDireccion]').val(respuesta['direccion']);
                        $('#editarSexo').html(respuesta['sexo']);
                        $('#editarSexo').val(respuesta['sexo']); 
                        // $('input[name=editarUsuario]').val(respuesta['usuario']);
                        // $('#editarRol').html(respuesta['rol']);
                        // $('#editarRol').val(respuesta['id_rol']);
                        // $('#passwordActual').val(respuesta['password']);
                        // $('#fotoActual').val(respuesta['foto']);
                        // if(respuesta['foto'] != ""){
                        //     $('.previsualizar').attr('src', respuesta['foto']);
                        // } else {
                        //     $('.previsualizar').attr('src', 'vistas/img/usuarios/default/default2.jpg');
                        // }
                    }
                    
                }

            });

            $('.salirPerfil').click(function (e) { 
                e.preventDefault();
                $('.ajustes-cuenta').remove();
                $('.ajustes-usuario').removeClass('contenedor-datos');
                $('.ajustes-usuario').append(clone);
            });
        }
    });
});

//** ------------------------------------*/
//        AJUSTES PASSWORD USUARIO
// --------------------------------------*/
$(document).on('click', '.ajuste-password', function (e) {
    e.preventDefault();
    $.ajax({
        url: "vistas/modulos/ajustes-password.php",
        success: function (response) {
            var clone = $('.datos-generales').clone();
            $('.datos-generales').remove();
            if(!$('.ajustes-usuario').hasClass('contenedor-datos')){
                $('.ajustes-usuario').addClass('contenedor-datos');
                $('.ajustes-usuario').append(response);
            }
            
            $('.salirPerfil').click(function (e) { 
                e.preventDefault();
                $('.ajustes-password').remove();
                $('.ajustes-usuario').removeClass('contenedor-datos');
                $('.ajustes-usuario').append(clone);
            });
        }
    });
});

//** ------------------------------------*/
//        AJUSTES PREGUNTAS/RESPUESTAS USUARIO
// --------------------------------------*/
$(document).on('click', '.ajuste-preguntas', function (e) {
    e.preventDefault();
    var idUsuarioPersona = $(this).attr('idUsuario');
    // console.log(idUsuarioPersona);

    $.ajax({
        url: "vistas/modulos/ajustes-preguntas.php",
        success: function (response) {
            var clone = $('.datos-generales').clone();
            $('.datos-generales').remove();
            if(!$('.ajustes-usuario').hasClass('contenedor-datos')){
                $('.ajustes-usuario').addClass('contenedor-datos');
                $('.ajustes-usuario').append(response);
            }
            
            var datos = new FormData();
            datos.append('idUsuarioPersona', idUsuarioPersona);

            $.ajax({

                url:"ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,  
                dataType: "json",
                success: function(respuesta) {
                    // console.log(respuesta);
                    
                    if(respuesta){

                        for(let i in respuesta){
                            // console.log(respuesta[i]['pregunta'])
                            $('.preguntaUsuario'+i).html(respuesta[i]['pregunta']);
                            $('.preguntaUsuario'+i).val(respuesta[i]['id_preguntas']);
                            $('.respuestaPregunta'+i).val(respuesta[i]['respuesta']);
                            $('.idPreguntaUsuario'+i).val(respuesta[i]['id_preguntas_usuarios']);
                        }
                
                    }
                    
                }

            });


            $('.salirPerfil').click(function (e) { 
                e.preventDefault();
                $('.ajustes-preguntas').remove();
                $('.ajustes-usuario').removeClass('contenedor-datos');
                $('.ajustes-usuario').append(clone);
            });
        }
    });
});

//** ------------------------------------*/
//       AJUSTES CAMBIAR FOTO USUARIO
// --------------------------------------*/
function toggleCambiarFoto(){
    var container = document.querySelector('.datos-generales');
    container.classList.toggle('foto')
}

$('.btnEditarFoto').click(function () { 
    // console.log('clcik')
    toggleCambiarFoto();
    $('#datos-generales .user').hide();
    var preview = $('.contenedorFoto').children().children();
    preview.addClass('previsualizar');
    srcFotoActual = $('.imgUsuario').attr('src');   
    // console.log(srcFotoActual)
   
});

$('.salirFoto').click(function (e) { 
    e.preventDefault();  
    var preview = $('.contenedorFoto').children().children();
    preview.removeClass('previsualizar');
    $('.imgUsuario').attr('src', srcFotoActual);
    $('#datos-generales .user').show();
    toggleCambiarFoto();
});


//** ------------------------------------*/
//     ALERTA AL AGREGAR NUEVO USUARIO
// --------------------------------------*/
$(document).on('click', '#usuarioNuevo', function (e) {
    e.preventDefault();
    // console.log('click')
    Swal.fire({
        icon: 'info',
        title: '¿Crear usuario desde una persona ya registrada?',
        html: '<button type="submit" role="button" class="SwalBtnGuardarUsuarioYaRegistrado btn btn-success customSwalBtn px-5" data-toggle="modal" data-target="#modalAgregarUsuarioYaRegistrado" data-dismiss="modal">' + 'Si' + '</button>' +
            '<button type="button" role="button" class="SwalGuardarUsuarioNuevo btn btn-primary customSwalBtn" data-toggle="modal" data-target="#modalAgregarUsuarioNuevo" data-dismiss="modal">' + 'No, nuevo' + '</button>'+ 
            '<button type="button" role="button" class="SwalBtnCancelar btn btn-danger customSwalBtn">' + 'Cancelar' + '</button>',
        width: 550,
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false
    });
});


cancelarAlerta('.SwalBtnGuardarUsuarioYaRegistrado');
cancelarAlerta('.SwalGuardarUsuarioNuevo');
cancelarAlerta('.SwalBtnCancelar');
