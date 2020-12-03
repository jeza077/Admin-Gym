/*=====================================
    GUARDAR ROL
========================================*/
$('.pantalla-permisos').hide();
$('#modalFooterPermisos').hide();

$(document).on('click', '.btnGuardarRol', function (e) {
    e.preventDefault();
    // console.log('clcik')

    $(this).html('');
    $(this).append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');

    
    // return;
    var nuevoRol = $('input[name=nuevoRol]').val();
    var nuevoRolDescripcion = $('input[name=nuevaDescripcionRol]').val();
    // console.log(nuevoRol);
    // console.log(nuevoRolDescripcion);

    var datos = new FormData();
    datos.append('nuevoRol', nuevoRol);
    datos.append('nuevoRolDescripcion', nuevoRolDescripcion);

    $.ajax({
        
        url:"ajax/mantenimiento.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        success:function(respuesta){ 
            // console.log(respuesta)
            var idRol = respuesta;

            if(respuesta){
            Swal.fire({
                icon: "success",
                title: "¡El rol ha sido creado exitosamente!",
                showConfirmButton: true,
                // showCloseButton: true,
                confirmButtonText: "Ok",
                heightAuto: false,
                allowOutsideClick: false
    
              }).then((result)=>{
    
                if(result.value){
    
                //   window.location = "mantenimiento";
                    Swal.fire({

                        icon: "info",
                        title: "Por ultimo, agregue los permisos",
                        showConfirmButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Vamos",
                        cancelButtonText: "No, cerrar",
                        heightAuto: false,
                        allowOutsideClick: false
            
                        }).then((result)=>{

                        if(result.value){

                            $('input[name=nuevoRol]').attr('disabled',true);
                            $('input[name=nuevaDescripcionRol]').attr('disabled',true);
                            
                            $('#modalFooterRol').hide();
                            $('.pantalla-permisos').show();
                            $('#modalFooterPermisos').show();

                            $(document).on('click', '#btnGuardarPermisos', function (e) {
                                e.preventDefault();
                                if(!$('input[name=nuevoConsulta]').is(':checked') && !$('input[name=nuevoAgregar]').is(':checked') && !$('input[name=nuevoActualizar]').is(':checked') && !$('input[name=nuevoEliminar]').is(':checked')){
                                   
                                    $('#modalFooterPermisos').before('<div class="alert alert-danger alert-dismissible ml-3 mr-3 mt-4" role="alert"><i class="icon fas fa-ban"></i>Por favor, elige al menos un permiso!</div>');
                                    setTimeout(function () {
                                        $('.alert').remove();
                                    }, 4000)
                                
                                
                                } else if($('#nuevaPantalla').val() == 'Seleccione...' || $('#nuevaPantalla').val() == "") {

                                    $('#modalFooterPermisos').before('<div class="alert alert-danger alert-dismissible ml-3 mr-3 mt-4" role="alert"><i class="icon fas fa-ban"></i>Por favor, elija una pantalla!</div>');
                                    setTimeout(function () {
                                        $('.alert').remove();
                                    }, 4000)
                                

                                } else {

                                    // console.log(datosPermisos);
    
                                    var pantalla = $('#nuevaPantalla').val();
                                    var consulta = false;
                                    var agregar = false;
                                    var actualizar = false;
                                    var eliminar = false;
    
                                    if($('input[name=nuevoConsulta]').is(':checked')){
                                        consulta = true;
                                    } else {
                                        consulta = false;
                                    }
    
                                    if($('input[name=nuevoAgregar]').is(':checked')){
                                        agregar = true;
                                    } else {
                                        agregar = false;
                                    }
    
                                    if($('input[name=nuevoActualizar]').is(':checked')){
                                        actualizar = true;
                                    } else {
                                        actualizar = false;
                                    }
    
                                    if($('input[name=nuevoEliminar]').is(':checked')){
                                        eliminar = true;
                                    } else {
                                        eliminar = false;
                                    }
                                                
                                    // console.log(parseInt(idRol))
                                    // console.log(pantalla)
                                    console.log('consulta',consulta)
                                    console.log('agregar',agregar)
                                    console.log('actualizar',actualizar)
                                    console.log('eliminar',eliminar)
                                    // return;
                                    var datos = new FormData();
                                    datos.append('idRol', idRol);
                                    datos.append('pantalla', pantalla);
                                    datos.append('consulta', consulta);
                                    datos.append('agregar', agregar);
                                    datos.append('actualizar', actualizar);
                                    datos.append('eliminar', eliminar);
    
    
                                    $.ajax({
            
                                        url:"ajax/mantenimiento.ajax.php",
                                        method:"POST",
                                        data: datos,
                                        cache: false,
                                        contentType:false,
                                        processData:false,
                                        success:function(respuesta){ 
                                            console.log(respuesta)
    
                                            $('input[type=checkbox]').prop('checked',false);   
                                            $('#nuevaPantalla').val('Seleccione...');                                       
                                            if(respuesta){
                                                $('#modalFooterPermisos').before('<div class="alert alert-success alert-dismissible ml-3 mr-3 mt-4" role="alert"><i class="icon fas fa-check"></i>Los permisos se agregaron correctamente.</div>');
                                                setTimeout(function () {
                                                    $('.alert').remove();
                                                }, 4000)
    
                                                
                                            } else {
                                                // $('input[type=checkbox]').prop('checked',false);
                                                $('#modalFooterPermisos').before('<div class="alert alert-danger alert-dismissible ml-3 mr-3 mt-4" role="alert"><i class="icon fas fa-ban"></i>Opps, algo salio mal. Intenta de nuevo!</div>');
                                                setTimeout(function () {
                                                    $('.alert').remove();
                                                }, 4000)
                                            }
    
                                        }
                                    });
                                }

                            });

                        } else {
                            window.location = "rol";

                        }

                    });
    
                }
    
              });

            }
       } 
  
    }); 
  


});

$(document).on('click', '.btnGuardarCambios', function () {
    window.location = 'rol';
});


/*=====================================
ACTIVAR ROL
========================================*/
$(".btnActivar").click(function(){

    var idRol = $(this).attr("idRol");
    var estadoRol = $(this).attr("estadoRol");
    // console.log(idRol)
    var datos = new FormData();
    datos.append("activarid", idRol);
    datos.append("activarRol",estadoRol);

    $.ajax({
        
      url:"ajax/mantenimiento.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType:false,
      processData:false,
      success:function(respuesta){ 
          console.log(respuesta)
     } 

    }) 

    if(estadoRol == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoRol',1);

    }else{


        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoRol',0);

    }

})


/*=====================================
ACTIVAR INSCRIPCIONES
========================================*/
$(".btnActivar").click(function(){

    var idInscripcion = $(this).attr("idInscripcion");
    var estadoInscripcion = $(this).attr("estadoInscripcion");
    // console.log(idInscripcion)
    var datos = new FormData();
    datos.append("activarid", idInscripcion);
    datos.append("activarInscripcion",estadoInscripcion);

    $.ajax({
        
      url:"ajax/mantenimiento.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType:false,
      processData:false,
      success:function(respuesta){ 
        //   console.log(respuesta)
     } 

    }) 

    if(estadoRol == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoInscripcion',1);

    }else{


        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoInscripcion',0);

    }

})





/*=====================================
ACTIVAR MATRICULA
========================================*/
$(".btnActivar").click(function(){

    var idMatricula = $(this).attr("idMatricula");
    var estadoMatricula = $(this).attr("estadoMatricula");
    // console.log(idInscripcion)
    var datos = new FormData();
    datos.append("activarid", idMatricula);
    datos.append("activarMatricula",estadoMatricula);

    $.ajax({
        
      url:"ajax/mantenimiento.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType:false,
      processData:false,
      success:function(respuesta){ 
        //   console.log(respuesta)
     } 

    }) 

    if(estadoRol == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoMatricula',1);

    }else{


        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoMatricula',0);

    }

})

/*=====================================
ACTIVAR DESCUENTO
========================================*/
$(".btnActivar").click(function(){

    var idDescuento = $(this).attr("idDescuento");
    var estadoDescuento = $(this).attr("estadoDescuento");
    // console.log(idInscripcion)
    var datos = new FormData();
    datos.append("activarid", idDescuento);
    datos.append("activarDescuento",estadoDescuento);

    $.ajax({
        
      url:"ajax/mantenimiento.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType:false,
      processData:false,
      success:function(respuesta){ 
        //   console.log(respuesta)
     } 

    }) 

    if(estadoRol == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoDescuento',1);

    }else{


        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoDescuento',0);

    }

})







$(document).ready(function () {

    $('.chkAutoriza').change(function () {
        if ($(this).prop('checked')) {
            $('.chkRechaza').prop('checked', false);
        }
    });

    $('.chkRechaza').change(function () {
        if ($(this).prop('checked')) {
            $('.chkAutoriza').prop('checked', false);
        }
    });
});