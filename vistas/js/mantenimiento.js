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



})