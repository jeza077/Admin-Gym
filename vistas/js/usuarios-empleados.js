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
