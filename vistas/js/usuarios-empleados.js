//** VERIFICAR QUE USUARIO NO SE REPITA */
$('.nuevoUsuario').keyup(function (){

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
                $('.nuevoUsuario').after('<div class="alert alert-warning mt-2">Usuario ya existente, ingrese uno diferente.</div>');
                setTimeout(function () {
                    $('.alert').remove();
                }, 3000)
                
                //E inmeditamente Limpiamos el input
                $('.nuevoUsuario').val("");
                $('.nuevoUsuario').focus();
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
            } 
        }

    });

});



//** ------------------------------------*/
//         ACTIVAR USUARIO 
// --------------------------------------*/ 
$(document).on('click', '.btnActivar', function () {
    e.preventDefault();
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
// $(document).on('click', '.btnEliminarUsuario', function () {
//     var idPersona = $(this).attr('idPersona');
//     var fotoUsuario = $(this).attr('fotoUsuario');
//     var usuario = $(this).attr('usuario');

//     Swal.fire({
//         title: "¿Estas seguro de borrar el usuario?",
//         text= "¡Si no lo estas, puedes cancelar la accion!",
//         icon: "info",
//         heightAuto: false,
//         allowOutsideClick: false
//     }).then((result)=>{
//         if(result.value){
//             window.location = "index.php?ruta=usuarios&idPersona="+idPersona+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
//         }
//     });
// });
