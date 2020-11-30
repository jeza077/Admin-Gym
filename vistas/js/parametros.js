/*===================================
MODIFICAR PARAMETROS
====================================*/
$(".btnEditarParametro").click(function(){
    
    var idParametro = $(this).attr("idParametro");
     // console.log("idParametro",idParametro);
     

    var datos = new FormData();
    datos.append("idParametro", idParametro);

    $.ajax({

        url:"ajax/parametro.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        dataType: "json",
        success:function(respuesta){ 

            // console.log(respuesta);
    
            $('#editarParametro').val(respuesta['parametro']);
            $('#editarValorParametro').val(respuesta['valor']);
            $('#editarIdParametro').val(respuesta['id_parametro']);
         
        } 

    });



});

/*===================================
MODIFICAR PARAMETROS
====================================*/
$(".btnEditarRol").click(function(){
    
    var idRol = $(this).attr("editarIdRol");

    var datos = new FormData();
    datos.append("idRol", idRol);

    $.ajax({

        url:"ajax/parametro.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        dataType: "json",
        success:function(respuesta){ 

            $('#editarRol').val(respuesta['rol']);
            $('#editarDescripcionRol').val(respuesta['descripcion']);
            $('#editarIdRol').val(respuesta['id_rol']);
         
        } 

    });



});
