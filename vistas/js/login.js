/*LOGIN PREVENIR RECARGAR */
$(".verificarPreguntas").on('click', function(event){
    event.preventDefault();
    // console.log("click")
})

//FUNCION PARA PASAR A VERIFICAR EL EMAIL
function toggleForm(){
    var container = document.querySelector('.login-box');
    container.classList.toggle('active')
}

//FUNCION PARA PASAR A LAS PREGUNTAS DE SEGURIDAD
function toggleQuestions(){
    var container = document.querySelector('.login-box');
    container.classList.toggle('quest')
}

//FUNCION PARA PASAR A CAMBIAR LA CONTRASEÑA
function togglePassword(){
    var container = document.querySelector('.login-box');
    container.classList.toggle('changePassword')
}


var letra = /[A-z]/;
var mayus = /[A-Z]/;
var minus = /[a-z]/;
var num = /\d/;
var caracEspe = /[!@#$&*?.,]/;
var long = /^.{8,16}$/;

function requisitosPassword(){  
    
    $(".nueva-password").keyup(function() { 
        var editPassword = $(this).val();
        
        //validar que tenga una letra
        if(editPassword.match(letra)){
            $(".letter").removeClass('invalid').addClass('valid');
        } else {
            $(".letter").removeClass('valid').addClass('invalid');
        }
    
        //validar que tenga una letra Mayuscula
        if(editPassword.match(mayus)){
            $(".capital").removeClass('invalid').addClass('valid');
        } else {
            $(".capital").removeClass('valid').addClass('invalid');
        }
    
        //validar que tenga un numero
        if(editPassword.match(num)){
            $(".number").removeClass('invalid').addClass('valid');
        } else {
            $(".number").removeClass('valid').addClass('invalid');
        }
    
        //validar que tenga un caracter especial
        if(editPassword.match(caracEspe)){
            $(".special").removeClass('invalid').addClass('valid');
        } else {
            $(".special").removeClass('valid').addClass('invalid');
        }

        //validar longitud
        if(editPassword.match(long)){
            $(".length").removeClass('invalid').addClass('valid');
        } else {
            $(".length").removeClass('valid').addClass('invalid');
        }
        
    }).focus(function() {  
        // $(".requisito-password").show();
        Swal.fire({
            // icon: "info",
            width: 350,
            html: 
            '<i class="rp-info fas fa-info-circle"></i> ' +
              '<div class="requisito-password"> ' +
              '<h4>La contraseña debe cumplir con los siguientes requerimientos:</h4> ' +
                '<ul> ' +
                '<li class="letter">Al menos debe tener <strong>una letra</strong></li> ' +
                '<li class="capital">Al menos debe tener <strong>una letra en mayuscula</strong></li> ' +
                '<li class="number">Al menos debe tener <strong>un numero</strong></li> ' +
                '<li class="special">Al menos debe tener <strong>un caracter especial</strong></li> ' +
                '<li class="length">Al menos debe tener <strong>8 caracteres como minimo y 16 maximo</strong></li> ' +
                '</ul> ' + 
              '</div>',
            toast: true,
            position: "center-end",
            showConfirmButton: false,
        })
        // $(".login-box").addClass('contenedor-rp');
    }).blur(function() { 
        // $(".requisito-password").hide();
        Swal.close();
        // $(".login-box").removeClass('contenedor-rp');
    });
}

//VERIFICAR CORREO Y TRAER PREGUNTAS DE SEGURIDAD PARA CAMBIAR PASSWORD
$(".verificarCorreoPreguntas").on('click', function(event){
    event.preventDefault();
    // console.log("click")    
        $(".alert").remove();
        
        var emailIngresado = $('#verificarEmail').val();
    
        // console.log(emailIngresado);
        
        var datos = new FormData();
        datos.append("verificarEmail", emailIngresado);
    
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
                
                idUsuario = respuesta.id_usuario; //<----- ID PARA CAMBIAR EL PASSWORD//
                usuario = respuesta.usuario;
     
    
                if(!respuesta) {//Si la Respuesta = FALSE entonces...
                    
                    //Mandamos una alerta diciendo que ya existe el usuario.
                    $("#verificarEmail").after('<div class="alert alert-danger mt-2">Correo inexistente</div>');
                    setTimeout(function () {
                        $('.alert').remove();
                    }, 2000)
                    
                    //E inmeditamente Limpiamos el input
                    $("#verificarEmail").val("");
                    
                } else { //SI LA RESPUESTA ES TRUE ENTONCES...
                    
                    // TRAEMOS LAS RESPUESTAS DE SEGURIDAD
                    $("#verificarEmail").val("");
                    toggleQuestions();
    
                    var datos = new FormData();
                    datos.append("usuario", usuario);
                    
                    $.ajax({
    
                        url:"ajax/usuarios.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,  
                        dataType: "json",
                        success: function(respuesta) {
                            $(".questionsBx").prepend("<p class='login-box-msg'>Hola <b>" + usuario + "</b>, contesta las siguientes preguntas de seguridad para poder cambiar la contraseña!</p>");
                            
                            for(var i in respuesta){
                                // console.log(respuesta[i][1]);
                                $("#preguntaSeguridad").append("<label class='mt-2'>" + respuesta[i]['pregunta'] + "</label>");
                                $("#preguntaSeguridad").append("<input type='text' class='form-control respuestaPregunta' placeholder='Agrega la respuesta' required>")
                            }
    
                            //CONVERTIMOS LAS RESPUESTAS DEL USUARIO QUE VIENEN DE LA BASE DE DATOS, EN UN ARRAY
                                var respuestasRegistradas = respuesta.map(function(respuestasRegistrada){
                                    return respuestasRegistrada.respuesta; 
                                })
                                
                                // console.log(respuestasRegistradas);
                            
    
                                // VERIFICAMOS SI LAS RESPUESTAS INGRESADAS CON LAS YA REGISTRADAS COINCIDEN
                                    $("#verificarPreguntas").on("click", function (event) {
                                        event.preventDefault();
                                    
                                        //CONVERTIMOS LAS RESPUESTAS QUE INGRESO EL USUARIO EN UN ARRAY
                                            var respuestasIngresadas = new Array();
                                            var respuestaPreguntaAgregada = $('.respuestaPregunta'), 
                                            namesValues = [].map.call(respuestaPreguntaAgregada, function(respuestaPregunta){  
                                                respuestasIngresadas.push(respuestaPregunta.value);
                                            });
    
                                            // var respuestas = $('.respuestaPregunta').val();
                                            // respuestasIngresadas.push(respuestas);
    
                                            // console.log(respuestasIngresadas);
    
                                            var preguntaString = respuestasIngresadas.toString();
                                            var respuestaString = respuestasRegistradas.toString();
    
                                            if(preguntaString == respuestaString){
                                                togglePassword();
    
                                                $("#passwords").append("<label class='mt-2'>Nueva contraseña</label>");
                                                $("#passwords").append("<input type='password' class='form-control password nueva-password' placeholder='Ingrese nueva contraseña' name='editarPassword' required>");
                                                $("#passwords").append("<label class='mt-2'>Confirmar contraseña</label>");
                                                $("#passwords").append("<input type='password' class='form-control password confirmar-password' placeholder='Confirmar contraseña'>");
    
                                                $("#btnCambiarPass").append("<button type='submit' class='btn btn-orange btn-block btn-flat' id='cambiarContraseña'>Cambiar Contraseña</button>")
    
                                                $("#linkLogin").append("<p class='link mt-3 ml-2'>Regresar al <a href='#' onclick='toggleForm(); toggleQuestions(); togglePassword();'>Login</a></p>")
    
                                                    //CAMBIAR CONTRASEÑA
                                                    requisitosPassword();
    
                                                    $('#cambiarContraseña').attr('disabled', true);
                                                    $(".nueva-password").on('change', function(){
                                                        cambiarPass = $(this).val();
                                                    });
                                                    $(".confirmar-password").on('input', function(){
                                                        // var password_nuevo = cambiarPass;
                                                        if($(this).val() == cambiarPass){
                                                            $('.resultado-password').text('Correcto');
                                                            $('.resultado-password').addClass('valid').removeClass('invalid');
                                                            $('input.nueva-password').addClass('valid border-valid').removeClass('invalid border-invalid');
                                                            $('input.confirmar-password').addClass('valid border-valid').removeClass('invalid border-invalid');
                                                            $('#cambiarContraseña').attr('disabled', false);                                              
                                                        } else {
                                                            $('.resultado-password').text('Contraseñas no coinciden');
                                                            $('.resultado-password').addClass('invalid').removeClass('valid');
                                                            $('input.nueva-password').addClass('invalid border-invalid').removeClass('valid border-valid');
                                                            $('input.confirmar-password').addClass('invalid border-invalid').removeClass('valid border-valid');
                                                            $('#cambiarContraseña').attr('disabled', true);
                                                        }
                                                    })
                                                    
                                                        $("#cambiarContraseña").on("click", function(event){  
                                                            event.preventDefault();
                                                            
                                                            var datos = new FormData();
                                                            datos.append("usuarioId", idUsuario);
                                                            datos.append("cambiarPass", cambiarPass);
    
                                                            $.ajax({
    
                                                                url:"ajax/usuarios.ajax.php",
                                                                method: "POST",
                                                                data: datos,
                                                                cache: false,
                                                                contentType: false,
                                                                processData: false,  
                                                                dataType: "json",
                                                                success: function(respuesta) {
                                                                    if(respuesta == true){
                                                                        Swal.fire({
                                                                            icon: "success",
                                                                            title: "¡Contraseña cambiada correctamente!",
                                                                            showConfirmButton: true,
                                                                            confirmButtonText: "Cerrar",
                                                                            allowOutsideClick: false,
                                                                            closeOnConfirm: false
                                                                        }).then((result)=>{
        
                                                                            if(result.value){
                                                    
                                                                                toggleForm(); 
                                                                                toggleQuestions();
                                                                                togglePassword();
    
                                                                                // window.location('login')
                                                    
                                                                            }
                                                    
                                                                        });
                                                                        
                                                                    } else {
                                                                        Swal.fire({
                                                                            icon: "error",
                                                                            title: "¡La contraseña no cumple con los requisitos!",
                                                                            showConfirmButton: true,
                                                                            confirmButtonText: "Cerrar",
                                                                            closeOnConfirm: false
                                                                        })
                                                                    }
                                                        
                                                                }
                                                        
                                                            })
                                                        })
    
                                            } else {
                                                Swal.fire({		
                                                    icon: 'error',
                                                    title: 'Respuestas no coinciden. Intente de nuevo.',
                                                    showConfirmButton: false,
                                                    heightAuto: false,  
                                                    timer: 1000
                                                    })
    
                                                $("#preguntaSeguridad input[type='text']").val("");
                                                console.log("MAL");
                                            }
                                                                        
                                    });
                            
                          
                            
    
                        }
                    })
    
                }
            }
            
        })
        
    
})

//VERIFICAR CORREO Y ENVIAR CORREO PARA CAMBIAR PASSWORD
$(".verificarCorreo").on('click', function(event){
    event.preventDefault();

    var emailIngresado = $('#verificarEmail').val();

    // console.log(emailIngresado);
    
    var datos = new FormData();
    datos.append("verificarEmail", emailIngresado);

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

            if(!respuesta) {//Si la Respuesta = FALSE entonces...
                //Mandamos una alerta diciendo que ya existe el usuario.
                $("#verificarEmail").after('<div class="alert alert-danger mt-2">Correo inexistente</div>');
                setTimeout(function () {
                    $('.alert').remove();
                }, 2000);
                
                //E inmeditamente Limpiamos el input
                $("#verificarEmail").val("");
                
            } else { //SI LA RESPUESTA ES TRUE ENTONCES...
                // console.log("bien")

                correoUsuario = respuesta.correo;
                idUsua = respuesta.id_usuario;
                nombreUsuario = respuesta.nombre;
            
                // console.log(correoUsuario, idUsua);

                var datos = new FormData();
                datos.append("correoUsuario", correoUsuario);
                datos.append("idUsua", idUsua);
                datos.append("nombreUsuario", nombreUsuario);

                Swal.fire({
                    title: "Espere por favor...",
                    heightAuto: false,
                    showConfirmButton: false,
                    allowOutsideClick: false
                })
                Swal.showLoading();

                $.ajax({

                    url:"ajax/usuarios.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,  
                    dataType: "json",
                    success: function(respuesta) {
                        // console.log(respuesta)

                        if(respuesta == true){                                             
                            Swal.fire({
								title: "Le enviamos un correo para recuperar su contraseña. Por favor revise.",
								icon: "info",
                                heightAuto: false,
                                showConfirmButton: true,
								confirmButtonText: "Cerrar",
								allowOutsideClick: false
							}).then((result)=>{
			
								if(result.value){
			
									window.location = "login";
			
								}
			
							});
                        }
                    }
                })
            }
           

        }
    })   
})

//VALIDACIONES PARA LUEGO CAMBIAR CONTRASEÑA CONTRASEÑA (CODIGO-CORREO)
requisitosPassword();
$('#cambiarContraseñaPorCorreo').attr('disabled', true);
$(".nueva-password").on('change', function(){
    cambiarPassPorCodigo = $(this).val();
});
$(".confirmar-password").on('input', function(){
    // var password_nuevo = cambiarPassPorCodigo;
    if($(this).val() == cambiarPassPorCodigo){
        $('.resultado-password').text('Correcto');
        $('.resultado-password').addClass('valid').removeClass('invalid');
        $('input.nueva-password').addClass('valid border-valid').removeClass('invalid border-invalid');
        $('input.confirmar-password').addClass('valid border-valid').removeClass('invalid border-invalid');
        $('#cambiarContraseñaPorCorreo').attr('disabled', false);                                              
    } else {
        $('.resultado-password').text('Contraseñas no coinciden');
        $('.resultado-password').addClass('invalid').removeClass('valid');
        $('input.nueva-password').addClass('invalid border-invalid').removeClass('valid border-valid');
        $('input.confirmar-password').addClass('invalid border-invalid').removeClass('valid border-valid');
        $('#cambiarContraseñaPorCorreo').attr('disabled', true);
    }
})



//MOSTRAR CONTRASEÑA
$('.show-pass').on('click', function () { 

    var action = $(this).attr('action');

    if(action == 'hide'){
        $('.password').attr('type', 'text')
        $('.show-pass').removeClass('far fa-eye').addClass('far fa-eye-slash').attr('action', 'show')
    }

    if(action == 'show'){
        $('.password').attr('type', 'password')
        $('.show-pass').removeClass('far fa-eye-slash').addClass('far fa-eye').attr('action', 'hide')
    }
});


