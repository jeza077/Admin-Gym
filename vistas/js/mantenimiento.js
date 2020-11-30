/*=====================================
ACTIVAR ROL
========================================*/
$(".btnActivar").click(function(){

    var idRol = $(this).attr("idRol");
    var estadoRol = $(this).attr("estadoRol");
    console.log(idRol)
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