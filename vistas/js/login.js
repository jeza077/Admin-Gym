//** FUNCION PARA PASAR A VERIFICAR EL EMAIL */
function toggleForm(){
    var container = document.querySelector('.login-box');
    container.classList.toggle('active')
}


//** FUNCION PARA PASAR A LAS PREGUNTAS DE SEGURIDAD */
function toggleQuestions(){
    var container = document.querySelector('.login-box');
    container.classList.toggle('quest')
}


//** FUNCION PARA PASAR A CAMBIAR LA CONTRASEÑA */
function togglePassword(){
    var container = document.querySelector('.login-box');
    container.classList.toggle('changePassword')
}


//** FUNCION PARA PASAR A REGISTRAR USUARIO */
function toggleRegistrar(){
    var container = document.querySelector('.login-box');
    container.classList.toggle('registro')
}



//** VALIDACIONES */
$('.usuario').keydown(impedirEspacios); //Impedir espacios en Input de Usuario del Login.
longitudString($('.usuario'),50); //Longitud maxima Input Usuario Login.



//** VERIFICAR CORREO Y TRAER PREGUNTAS DE SEGURIDAD PARA CAMBIAR PASSWORD */
$(".verificarCorreoPreguntas").on('click', function(event){
    event.preventDefault();
    // console.log("click")    
    $(".alert").remove();
        
    var emailIngresado = $('#verificarEmail').val();
    
    if(emailIngresado === ""){
        $("#verificarEmail").after('<div class="alert alert-danger mt-2">Por favor, ingresar correo</div>');
        setTimeout(function () {
            $('.alert').remove();
        }, 2000)
        $('#verificarEmail').focus();
    } else {
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
     
                console.log(idUsuario + ' ' + usuario);
    
                if(!respuesta) {//Si la Respuesta = FALSE entonces...
                    
                    //Mandamos una alerta diciendo que no existe correo asociado a ningun usuario.
                    $("#verificarEmail").after('<div class="alert alert-danger mt-2">Correo inexistente</div>');
                    setTimeout(function () {
                        $('.alert').remove();
                    }, 2000)
                    
                    //E inmeditamente Limpiamos el input
                    $("#verificarEmail").val("");
                    $('#verificarEmail').focus();
                    
                } else { //SI LA RESPUESTA ES TRUE ENTONCES...
                    
                    // TRAEMOS LAS RESPUESTAS DE SEGURIDAD
                    $("#verificarEmail").val("");
                    toggleQuestions();
                    $(".questionsBx").prepend("<p class='login-box-msg'>Hola <b>" + usuario + "</b>, contesta la siguiente pregunta de seguridad para poder cambiar la contraseña!</p>");
                    $("#preguntaSeguridad").append("<input type='text' class='form-control respuestaPregunta' placeholder='Agrega la respuesta' required>");
                    
                    $('.respuestaPregunta').keydown(permitirUnEspacio);


                    $('#verificarPreguntas').click(function (e) { 
                        e.preventDefault();
                        var valorPregunta = $('#preguntaSeleccionada').val();
                        var respuestaPregunta = $('.respuestaPregunta').val();
                        if(valorPregunta == ""){
                            // console.log('llenar');
                        } else {
                            // console.log(valorPregunta, respuestaPregunta);

                            //Compararemos la pregunta y la respuesta con las del usuario, para saber si son correctas----.
                            var datos = new FormData();
                            datos.append("usuario", usuario);
                            datos.append("idPregunta", valorPregunta);
                            datos.append("respuestaPregunta", respuestaPregunta);
                        
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

                                    if(respuesta == "" && usuario == 'SUPERADMIN'){

                                        Swal.fire({		
                                            icon: 'error',
                                            title: 'Pregunta/Respuesta no coinciden. Intente de nuevo.',
                                            showConfirmButton: false,
                                            heightAuto: false,  
                                            allowOutsideClick: false,
                                            timer: 2500
                                        });

                                    } else if(respuesta == "" && usuario != 'SUPERADMIN'){ //*Bloqueamos el usuario si no coinciden su pregunta y/o respuesta.
                                        
                                        var datos = new FormData();
                                        datos.append("usua", usuario);
          
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
                                                    Swal.fire({		
                                                        icon: 'error',
                                                        title: 'Pregunta/Respuesta no coinciden. Su usuario ha sido bloqueado.',
                                                        showConfirmButton: false,
                                                        heightAuto: false,
                                                        allowOutsideClick: false,
                                                        timer: 2500
                                                    });
                                                }

                                                setTimeout(function () {
                                                    window.location = 'login';
                                                }, 2500)
                                            }
                                        });

                                    } else {
                                        // console.log('bien');
                                        togglePassword();
                                        $("#passwords").append("<label class='mt-2'>Nueva contraseña</label>");
                                        $("#passwords").append("<input type='password' class='form-control password nueva-password' placeholder='Ingrese nueva contraseña' name='editarPassword' required>");
                                        $("#passwords").append("<label class='mt-2'>Confirmar contraseña</label>");
                                        $("#passwords").append("<input type='password' class='form-control password confirmar-password' placeholder='Confirmar contraseña'>");

                                        $("#btnCambiarPass").append("<button type='submit' class='btn btn-orange btn-block btn-flat' id='cambiarContraseña'>Cambiar Contraseña</button>")

                                        $("#linkLogin").append("<p class='link mt-3 ml-2'>Regresar al <a href='javascript:void(0);' onclick='toggleForm(); toggleQuestions(); togglePassword();'>Login</a></p>")

                                            //*CAMBIAR CONTRASEÑA
                                            requisitosPassword("center-end");

                                            $('#cambiarContraseña').attr('disabled', true);
                                            $(".nueva-password").on('change', function(){
                                                cambiarPass = $(this).val();
                                            });

                                            $('.nueva-password').keydown(impedirEspacios);
                                            $('.confirmar-password').keydown(impedirEspacios);
                                            
                                            $(".confirmar-password").on('input', function(){
                                                
                                                var confirPass = $(this).val();
                                                var btnCambiarPass = $('#cambiarContraseña');

                                                confirmarContraseña(cambiarPass, confirPass, btnCambiarPass)
                                            })
                                            
                                                $("#cambiarContraseña").on("click", function(event){  
                                                    event.preventDefault();
                                                    
                                                    var datos = new FormData();
                                                    datos.append("usuarioId", idUsuario);
                                                    datos.append("usuarioIngresado", usuario);
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
                                                            // console.log(respuesta);
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
                                            
                                                                        // toggleForm(); 
                                                                        // toggleQuestions();
                                                                        // togglePassword();

                                                                        window.location = 'login';
                                            
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
                                    }
                                    // $(".questionsBx").prepend("<p class='login-box-msg'>Hola <b>" + usuario + "</b>, contesta las siguientes preguntas de seguridad para poder cambiar la contraseña!</p>");
                                    
                                    // for(var i in respuesta){
                                    //     // console.log(respuesta[i][1]);
                                    //     $("#preguntaSeguridad").append("<label class='mt-2'>" + respuesta[i]['pregunta'] + "</label>");
                                    //     $("#preguntaSeguridad").append("<input type='text' class='form-control respuestaPregunta' placeholder='Agrega la respuesta' required>")
                                    // }
        
                                    // $("#preguntaSeguridad").append("<input type='text' class='form-control respuestaPregunta' placeholder='Agrega la respuesta' required>");
                                    
                                    // $('.respuestaPregunta').keydown(permitirUnEspacio);
            
        
                                    //**CONVERTIMOS LAS RESPUESTAS DEL USUARIO QUE VIENEN DE LA BASE DE DATOS, EN UN ARRAY
                                    /*
                                        // var preguntasRegistradas = respuesta.map(function(preguntasRegistrada){
                                        //     return preguntasRegistrada.pregunta; 
                                        // })
                                        // console.log(preguntasRegistradas);
        
                                    
                                        // var respuestasRegistradas = respuesta.map(function(respuestasRegistrada){
                                        //     return respuestasRegistrada.respuesta; 
                                        // })
                                        // console.log(respuestasRegistradas);
        
        
                                        // VERIFICAMOS SI LAS RESPUESTAS INGRESADAS CON LAS YA REGISTRADAS COINCIDEN
                                            // $("#verificarPreguntas").on("click", function (event) {
                                            //     event.preventDefault();
                                            
                                            //     //CONVERTIMOS LAS RESPUESTAS QUE INGRESO EL USUARIO EN UN ARRAY
                                            //         var respuestasIngresadas = new Array();
                                            //         var respuestaPreguntaAgregada = $('.respuestaPregunta'), 
                                            //         namesValues = [].map.call(respuestaPreguntaAgregada, function(respuestaPregunta){  
                                            //             respuestasIngresadas.push(respuestaPregunta.value);
                                            //         });
            
                                            //         // var respuestas = $('.respuestaPregunta').val();
                                            //         // respuestasIngresadas.push(respuestas);
            
                                            //         // console.log(respuestasIngresadas);
            
                                            //         var preguntaString = respuestasIngresadas.toString();
                                            //         var respuestaString = respuestasRegistradas.toString();
            
                                            //         if(preguntaString == respuestaString){
                                            //             togglePassword();
            
                                                        // $("#passwords").append("<label class='mt-2'>Nueva contraseña</label>");
                                                        // $("#passwords").append("<input type='password' class='form-control password nueva-password' placeholder='Ingrese nueva contraseña' name='editarPassword' required>");
                                                        // $("#passwords").append("<label class='mt-2'>Confirmar contraseña</label>");
                                                        // $("#passwords").append("<input type='password' class='form-control password confirmar-password' placeholder='Confirmar contraseña'>");
            
                                                        // $("#btnCambiarPass").append("<button type='submit' class='btn btn-orange btn-block btn-flat' id='cambiarContraseña'>Cambiar Contraseña</button>")
            
                                                        // $("#linkLogin").append("<p class='link mt-3 ml-2'>Regresar al <a href='#' onclick='toggleForm(); toggleQuestions(); togglePassword();'>Login</a></p>")
            
                                                        //     //CAMBIAR CONTRASEÑA
                                                        //     requisitosPassword();
            
                                                        //     $('#cambiarContraseña').attr('disabled', true);
                                                        //     $(".nueva-password").on('change', function(){
                                                        //         cambiarPass = $(this).val();
                                                        //     });
        
                                                        //     $('.nueva-password').keydown(impedirEspacios);
                                                        //     $('.confirmar-password').keydown(impedirEspacios);
                                                            
                                                        //     $(".confirmar-password").on('input', function(){
                                                        //         // var password_nuevo = cambiarPass;
                                                        //         if($(this).val() == cambiarPass){
                                                        //             $('.resultado-password').text('Correcto');
                                                        //             $('.resultado-password').addClass('valid').removeClass('invalid');
                                                        //             $('input.nueva-password').addClass('valid border-valid').removeClass('invalid border-invalid');
                                                        //             $('input.confirmar-password').addClass('valid border-valid').removeClass('invalid border-invalid');
                                                        //             $('#cambiarContraseña').attr('disabled', false);                                              
                                                        //         } else {
                                                        //             $('.resultado-password').text('Contraseñas no coinciden');
                                                        //             $('.resultado-password').addClass('invalid').removeClass('valid');
                                                        //             $('input.nueva-password').addClass('invalid border-invalid').removeClass('valid border-valid');
                                                        //             $('input.confirmar-password').addClass('invalid border-invalid').removeClass('valid border-valid');
                                                        //             $('#cambiarContraseña').attr('disabled', true);
                                                        //         }
                                                        //     })
                                                            
                                                        //         $("#cambiarContraseña").on("click", function(event){  
                                                        //             event.preventDefault();
                                                                    
                                                        //             var datos = new FormData();
                                                        //             datos.append("usuarioId", idUsuario);
                                                        //             datos.append("usuarioIngresado", usuario);
                                                        //             datos.append("cambiarPass", cambiarPass);
            
                                                        //             $.ajax({
            
                                                        //                 url:"ajax/usuarios.ajax.php",
                                                        //                 method: "POST",
                                                        //                 data: datos,
                                                        //                 cache: false,
                                                        //                 contentType: false,
                                                        //                 processData: false,  
                                                        //                 dataType: "json",
                                                        //                 success: function(respuesta) {
                                                        //                     // console.log(respuesta);
                                                        //                     if(respuesta == true){
                                                        //                         Swal.fire({
                                                        //                             icon: "success",
                                                        //                             title: "¡Contraseña cambiada correctamente!",
                                                        //                             showConfirmButton: true,
                                                        //                             confirmButtonText: "Cerrar",
                                                        //                             allowOutsideClick: false,
                                                        //                             closeOnConfirm: false
                                                        //                         }).then((result)=>{
                
                                                        //                             if(result.value){
                                                            
                                                        //                                 toggleForm(); 
                                                        //                                 toggleQuestions();
                                                        //                                 togglePassword();
            
                                                        //                                 // window.location('login')
                                                            
                                                        //                             }
                                                            
                                                        //                         });
                                                                                
                                                        //                     } else {
        
                                                        //                         Swal.fire({
                                                        //                             icon: "error",
                                                        //                             title: "¡La contraseña no cumple con los requisitos!",
                                                        //                             showConfirmButton: true,
                                                        //                             confirmButtonText: "Cerrar",
                                                        //                             closeOnConfirm: false
                                                        //                         })
                                                        //                     }
                                                                
                                                        //                 }
                                                                
                                                        //             })
                                                        //         })
            
                                            //         } else {
                                            //             Swal.fire({		
                                            //                 icon: 'error',
                                            //                 title: 'Respuestas no coinciden. Intente de nuevo.',
                                            //                 showConfirmButton: false,
                                            //                 heightAuto: false,  
                                            //                 timer: 1000
                                            //                 })
            
                                            //             $("#preguntaSeguridad input[type='text']").val("");
                                            //             // console.log("MAL");
                                            //         }
                                                                                
                                            // });
                                            */
                                    
            
                                }
                            });
                        }
                    });
                    
                }
            }
            
        })
    }    
    
})


//** VERIFICAR CORREO Y ENVIAR CORREO PARA CAMBIAR PASSWORD */
$(".verificarCorreo").on('click', function(event){
    event.preventDefault();

    var emailIngresado = $('#verificarEmail').val();
    
    if(emailIngresado === ""){
        $("#verificarEmail").after('<div class="alert alert-danger mt-2">Por favor, ingresar correo</div>');
        setTimeout(function () {
            $('.alert').remove();
        }, 2000)
        $('#verificarEmail').focus();
    } else {
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
                    $('#verificarEmail').focus();
                    
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
                                
                            } else {
                                Swal.fire({
                                    title: "No se pudo enviar el correo. Por favor, intente de nuevo.",
                                    icon: "error",
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
    }   
})


//** VALIDACIONES PARA LUEGO CAMBIAR CONTRASEÑA CONTRASEÑA (CODIGO-CORREO) */
requisitosPassword("center-end");
$('#cambiarContraseñaPorCorreo').attr('disabled', true);
$(".nueva-password").on('change', function(){
    cambiarPassPorCodigo = $(this).val();
});
$(".confirmar-password").on('input', function(){

    let confirPass = $(this).val();
    let btnCambiarPass = $('#cambiarContraseñaPorCorreo');

    confirmarContraseña(cambiarPassPorCodigo, confirPass, btnCambiarPass);
})


//** MOSTRAR CONTRASEÑAS EN LOGIN */
$('.show-pass').on('click', function () { 
    var action = $(this).attr('action');
    var mostrarPass = $('.show-pass');
    var nuevaPass = $('input[name="ingPassword"]');
    mostrarContraseña(nuevaPass, mostrarPass, action);
});


//** MOSTRAR CONTRASEÑAS EN RECUPERAR CONTRASEÑAS */
$('.show-nueva-pass').on('click', function () { 
    var action = $(this).attr('action');
    var mostrarPass = $('.show-nueva-pass');
    var nuevaPass = $('.nueva-password');
    mostrarContraseña(nuevaPass, mostrarPass, action);
});

$('.show-confir-pass').on('click', function () { 
    var action = $(this).attr('action');
    var mostrarPass = $('.show-confir-pass');
    var confirmarPass = $('.confirmar-password');
    mostrarContraseña(confirmarPass, mostrarPass, action);
});

