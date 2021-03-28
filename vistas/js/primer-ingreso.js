
//** FUNCION PARA PASAR A LA SIGUIENTE PREGUNTA DE SEGURIDAD */
function togglePregunta1(){
    var container = document.querySelector('body');
    container.classList.toggle('pregunta-uno');
}
function togglePregunta2(){
    var container = document.querySelector('body');
    container.classList.toggle('pregunta-dos');
}
function togglePregunta3(){
    var container = document.querySelector('body');
    container.classList.toggle('pregunta-tres');
}

//** FUNCION PARA MOSTRAR CONTENEDOR CAMBIAR CONTRASEÑA */ 
function togglePassPrimeraVez(){
    var container = document.querySelector('body');
    container.classList.toggle('password-primera-vez');
}

//**AGREGAR BOTONES A CONTENEDOR PREGUNTAS DE SEGURIDAD */
// Pregunta 1
$("#pregunta1").append("<a href='javascript:void(0);' class='btn btn-primary float-right' id='btnPreguntaDos'>Siguiente</a>");
$('#btnPreguntaDos').click(function (e) { 
    e.preventDefault();

    $('.alert').remove();
    let valorPregunta1 = $('#selectPreguntas1').val();
    var valorRespuesta1 = $('.respuesta1').val();
    let padre = $('#btnPreguntaDos').parent();

    if(valorPregunta1 == "" || valorPregunta1 == "Seleccionar..."){

        padre.after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>Por favor, seleccione una pregunta!</div>');
        setTimeout(function () {
            $('.alert').remove();
        }, 4000)
        

    } else if(valorRespuesta1 == ""){
        
        padre.after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>Por favor, ingrese una respuesta!</div>');
        setTimeout(function () {
            $('.alert').remove();
        }, 4000)
        
    } else {

        togglePregunta2();
        // Pregunta 2
        $(".btnAtras2").remove();
        $("#pregunta2").append("<a href='javascript:void(0);' class='btn btn-danger float-left btnAtras2' onclick='togglePregunta2();'>Atras</a>");
        $("#btnPreguntaTres").remove();
        $("#pregunta2").append("<a href='javascript:void(0);' class='btn btn-primary float-right' id='btnPreguntaTres'>Siguiente</a>");

        $('#btnPreguntaTres').click(function (e) { 
            e.preventDefault();

            $('.alert').remove();
            let valorPregunta2 = $('#selectPreguntas2').val();
            var valorRespuesta2 = $('.respuesta2').val();
            let padre = $('#btnPreguntaTres').parent();
            
            if(valorPregunta2 == "" || valorPregunta2 == "Seleccionar..."){

                padre.after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>Por favor, seleccione una pregunta!</div>');
                setTimeout(function () {
                    $('.alert').remove();
                }, 4000);        

                
            } else if(valorRespuesta2 == ""){
                
                padre.after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>Por favor, ingrese una respuesta!</div>');
                
            } else if(valorPregunta2 == valorPregunta1){

                padre.after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>Esta pregunta ya ha sido seleccionada,<br/> elige otra!</div>');
                setTimeout(function () {
                    $('.alert').remove();
                }, 4000)
                
            } else {
                
                togglePregunta3();
                // Pregunta 3
                $(".btnAtras3").remove();
                $("#pregunta3").append("<a href='javascript:void(0);' class='btn btn-danger float-left btnAtras3' onclick='togglePregunta3();'>Atras</a>");
                $("#btnPasswordSiguiente").remove();
                $("#pregunta3").append("<a href='javascript:void(0);' class='btn btn-primary float-right' id='btnPasswordSiguiente'>Siguiente</a>");
            
            }

            $('#btnPasswordSiguiente').click(function (e) { 
                e.preventDefault();
                $('.alert').remove();

                let valorPregunta3 = $('#selectPreguntas3').val();
                var valorRespuesta3 = $('.respuesta3').val();
                let padre = $('#btnPasswordSiguiente').parent();

                if(valorPregunta3 == "" || valorPregunta3 == "Seleccionar..."){

                    padre.after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>Por favor, seleccione una pregunta!</div>');
                    setTimeout(function () {
                        $('.alert').remove();
                    }, 4000)
                    
                } else if(valorRespuesta3 == ""){

                    padre.after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>Por favor, ingrese una respuesta!</div>');

                } else if(valorPregunta3 == valorPregunta2 || valorPregunta3 == valorPregunta1){

                    padre.after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>Esta pregunta ya ha sido seleccionada,<br/> elige otra!</div>');
                    setTimeout(function () {
                        $('.alert').remove();
                    }, 4000)    
                    
                } else {

                    togglePassPrimeraVez();
                    // Contraseña nueva primer ingreso
                    $("#passwordPrimerIngreso").append("<label class='mt-2'>Contraseña anterior</label>");
                    $("#passwordPrimerIngreso").append("<input type='password' class='form-control' placeholder='Ingrese contraseña anterior' id='passwordAnterior' name='passwordAnterior' required>");

                    $("#passwordPrimerIngreso").append("<label class='mt-2'>Nueva contraseña</label>");
                    $("#passwordPrimerIngreso").append("<input type='password' class='form-control password nueva-password' placeholder='Ingrese nueva contraseña' name='editarPassword' required>");
                    
                    $("#passwordPrimerIngreso").append("<label class='mt-2'>Confirmar contraseña</label>");
                    $("#passwordPrimerIngreso").append("<input type='password' class='form-control password confirmar-password' placeholder='Confirmar contraseña'>");

                    $("#guardarPassPrimerIngreso").append("<button type='submit' class='btn btn-orange btn-block btn-flat' id='cambiarPasPrimerIngreso'>Cambiar Contraseña</button>");

                    requisitosPassword("center-start");



                    $('#cambiarPasPrimerIngreso').attr('disabled', true);
                    $(".nueva-password").on('change', function(){
                        cambiarPass = $(this).val();
                    });

                    $('.nueva-password').keydown(impedirEspacios);
                    $('.confirmar-password').keydown(impedirEspacios);

                    $(".confirmar-password").on('input', function(){
                        var confirPass = $(this).val();
                        var btnCambiarPass = $('#cambiarPasPrimerIngreso');

                        confirmarContraseña(cambiarPass, confirPass, btnCambiarPass);
                    })

                    $(document).on('blur', '#passwordAnterior', function () { 

                        $('.alert').remove();
                        
                        let passAnterior = $(this).val();
                    
                        let datos = new FormData();
                        datos.append("passAnterior", passAnterior);
                    
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
                    
                                if(respuesta == false){
                                    $('#passwordAnterior').css('border', '1px solid red');
                                    $('#passwordAnterior').after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:5px 0 0 0"><i class="icon fas fa-ban"></i>La contraseña no coincide con la anterior. Intente de nuevo!</div>');
                                        setTimeout(function () {
                                            $('.alert').remove();
                                        }, 4000)
                                    $('#passwordAnterior').focus();
                                    $('#cambiarPasPrimerIngreso').attr('disabled', true);
                                    
                                } else {
                                    $('#passwordAnterior').css('border', '1px solid green');
                                    $('.alert').remove();
                                }
                            }
                        });
                    
                    });
                }
            });
        });

    }
});






// // Pregunta 3
// $("#pregunta3").append("<a href='javascript:void(0);' class='btn btn-danger float-left' onclick='togglePregunta3();'>Atras</a>");
// $("#pregunta3").append("<a href='javascript:void(0);' class='btn btn-primary float-right' onclick='togglePassPrimeraVez();'>Siguiente</a>");



