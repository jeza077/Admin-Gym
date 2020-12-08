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
MODIFICAR ROL
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


            if(respuesta){
                // Swal.fire({
                //     icon: "success",
                //     title: "¡El  rol sera editado!",
                //     showConfirmButton: true,
                //     // showCloseButton: true,
                //     confirmButtonText: "Ok",
                //     heightAuto: false,
                //     allowOutsideClick: false
        
                //   }).then((result)=>{
        
                //     if(result.value){
        
                    //   window.location = "mantenimiento";
                       
    
                            //if(result.value){
    
                                $('input[name=editarRol]').attr('enable',true);
                                $('input[name=editarDescripcionRol]').attr('enable',true);
                                
                                //$('#modalFooterRol').hide();
                                $('.pantalla-permisos').show();
                                $('#modalFooterPermisosEditar').show();
    
                                $(document).on('click', '#btnGuardarPermisosEditar', function (e) {
                                    e.preventDefault();
                                    if(!$('input[name=nuevoEditarConsulta]').is(':checked') && !$('input[name=nuevoEditarAgregar]').is(':checked') && !$('input[name=nuevoEditarActualizar]').is(':checked') && !$('input[name=nuevoEditarEliminar]').is(':checked')){
                                       
                                        $('#modalFooterPermisosEditar').before('<div class="alert alert-danger alert-dismissible ml-3 mr-3 mt-4" role="alert"><i class="icon fas fa-ban"></i>Por favor, elige al menos un permiso!</div>');
                                        setTimeout(function () {
                                            $('.alert').remove();
                                        }, 4000)
                                    
                                    
                                    } else if($('#nuevaPantallaEditar').val() == 'Seleccione...' || $('#nuevaPantallaEditar').val() == "") {
    
                                        $('#modalFooterPermisosEditar').before('<div class="alert alert-danger alert-dismissible ml-3 mr-3 mt-4" role="alert"><i class="icon fas fa-ban"></i>Por favor, elija una pantalla!</div>');
                                        setTimeout(function () {
                                            $('.alert').remove();
                                        }, 4000)
                                    
    
                                    } else {
    
                                        // console.log(datosPermisos);
        
                                        var pantalla = $('#nuevaPantallaEditar').val();
                                        var consulta = false;
                                        var agregar = false;
                                        var actualizar = false;
                                        var eliminar = false;
        
                                        if($('input[name=nuevoEditarConsulta]').is(':checked')){
                                            consulta = true;
                                        } else {
                                            consulta = false;
                                        }
        
                                        if($('input[name=nuevoEditarAgregar]').is(':checked')){
                                            agregar = true;
                                        } else {
                                            agregar = false;
                                        }
        
                                        if($('input[name=nuevoEditarActualizar]').is(':checked')){
                                            actualizar = true;
                                        } else {
                                            actualizar = false;
                                        }
        
                                        if($('input[name=nuevoEditarEliminar]').is(':checked')){
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
                                                //console.log(respuesta)
        
                                                $('input[type=checkbox]').prop('checked',false);   
                                                $('#nuevaPantallaEditar').val('Seleccione...');                                       
                                                if(respuesta){
                                                    $('#modalFooterPermisosEditar').before('<div class="alert alert-success alert-dismissible ml-3 mr-3 mt-4" role="alert"><i class="icon fas fa-check"></i>Los permisos se agregaron correctamente.</div>');
                                                    setTimeout(function () {
                                                        $('.alert').remove();
                                                    }, 4000)
        
                                                    
                                                } else {
                                                    // $('input[type=checkbox]').prop('checked',false);
                                                    $('#modalFooterPermisosEditar').before('<div class="alert alert-danger alert-dismissible ml-3 mr-3 mt-4" role="alert"><i class="icon fas fa-ban"></i>Opps, algo salio mal. Intenta de nuevo!</div>');
                                                    setTimeout(function () {
                                                        $('.alert').remove();
                                                    }, 4000)
                                                }
        
                                            }
                                        });
                                    }
    
                                });
    
                           // } else {

                               // window.location = "rol";
    
                           // }
                    //}
        
                 // });
    
                }
         
        } 

    });


});

/*===================================
MODIFICAR INSCRIPCION
====================================*/
$(".btnEditarInscripcion").click(function(){
    
    var idInscripcion = $(this).attr("editarIdInscripcion");

    var datos = new FormData();
    datos.append("idInscripcion", idInscripcion);

    $.ajax({

        url:"ajax/parametro.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        dataType: "json",
        success:function(respuesta){ 

            $('#editarInscripcion').val(respuesta['tipo_inscripcion']);
            $('#editarPrecioInscripcion').val(respuesta['precio_inscripcion']);
            $('#editarIdInscripcion').val(respuesta['id_inscripcion']);
         
        } 

    });



});



/*===================================
MODIFICAR MATRIUCLA
====================================*/
$(".btnEditarMatricula").click(function(){
    
    var idMatricula = $(this).attr("editarIdMatricula");

    var datos = new FormData();
    datos.append("idMatricula", idMatricula);

    $.ajax({

        url:"ajax/parametro.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        dataType: "json",
        success:function(respuesta){ 

            $('#editarMatricula').val(respuesta['tipo_matricula']);
            $('#editarPrecioMatricula').val(respuesta['precio_matricula']);
            $('#editarIdMatricula').val(respuesta['id_matricula']);
         
        } 

    });



});

/*===================================
MODIFICAR DESCUENTO
====================================*/
$(".btnEditarDescuento").click(function(){
    
    var idDescuento = $(this).attr("editarIdDescuento");
    //console.log(idDescuento)
    var datos = new FormData();
    datos.append("idDescuento", idDescuento);

    $.ajax({

        url:"ajax/parametro.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        dataType: "json",
        success:function(respuesta){ 
            console.log(respuesta)

            $('#editarDescuento').val(respuesta['tipo_descuento']);
            $('#editarValorDescuento').val(respuesta['valor_descuento']);
            $('#editarIdDescuento').val(respuesta['id_descuento']);
         
        } 

    });



});

/** ------------------------------------*/
//         BORRAR INSCRIPCION
// --------------------------------------*/ 
$(document).on('click', '.btnEliminarInscripcion', function () {
    var ideliminarInscripcion = $(this).attr('ideliminarInscripcion');

    Swal.fire({
        title: "¿Estas seguro de borrar la inscripcion?",
        text: "¡Si no lo estas, puedes cancelar la accion!",
        icon: "info",
        showCancelButton: true,
        cancelButtonColor: "#DC3545",
        heightAuto: false,
        allowOutsideClick: false
    }).then((result)=>{
        if(result.value){
            window.location = `index.php?ruta=inscripcion&idEliminarInscripcion=${ideliminarInscripcion}`;
            
        }
    });
});

/** ------------------------------------*/
//         BORRAR MATRICULA
// --------------------------------------*/ 
$(document).on('click', '.btnEliminarMatricula', function () {
    var ideliminarMatricula = $(this).attr('ideliminarMatricula');

    Swal.fire({
        title: "¿Estas seguro de borrar la matricula?",
        text: "¡Si no lo estas, puedes cancelar la accion!",
        icon: "info",
        showCancelButton: true,
        cancelButtonColor: "#DC3545",
        heightAuto: false,
        allowOutsideClick: false
    }).then((result)=>{
        if(result.value){
            window.location = `index.php?ruta=matricula&idEliminarMatricula=${ideliminarMatricula}`;
            
        }
    });
});

/** ------------------------------------*/
//         BORRAR DESCUENTO
// --------------------------------------*/ 
$(document).on('click', '.btnEliminarDescuento', function () {
    var ideliminarDescuento = $(this).attr('ideliminarDescuento');

    Swal.fire({
        title: "¿Estas seguro de borrar el descuento?",
        text: "¡Si no lo estas, puedes cancelar la accion!",
        icon: "info",
        showCancelButton: true,
        cancelButtonColor: "#DC3545",
        heightAuto: false,
        allowOutsideClick: false
    }).then((result)=>{
        if(result.value){
            window.location = `index.php?ruta=descuento&idEliminarDescuento=${ideliminarDescuento}`;
            
        }
    });
});

/** ------------------------------------*/
//         BORRAR ROlES
// --------------------------------------*/ 
$(document).on('click', '.btnEliminarRoles', function () {
    var ideliminarRoles = $(this).attr('ideliminarRoles');

    Swal.fire({
        title: "¿Estas seguro de borrar el rol?",
        text: "¡Si no lo estas, puedes cancelar la accion!",
        icon: "info",
        showCancelButton: true,
        cancelButtonColor: "#DC3545",
        heightAuto: false,
        allowOutsideClick: false
    }).then((result)=>{
        if(result.value){
            window.location = `index.php?ruta=rol&idEliminarRoles=${ideliminarRoles}`;
            
        }
    });
});

//** ------------------------------------*/
//         IMPRIMIR PDF INSCRIPCiON
// --------------------------------------*/ 
exportarPdf('.btnExportarInscripcion', 'inscripcion');

//** ------------------------------------*/
//         IMPRIMIR PDF MATRICULA
// --------------------------------------*/ 
exportarPdf('.btnExportarMatricula', 'matricula');

//** ------------------------------------*/
//         IMPRIMIR PDF DESCUENTO
// --------------------------------------*/ 
exportarPdf('.btnExportarDescuento', 'descuento');

//** ------------------------------------*/
//         IMPRIMIR PDF ROl
// --------------------------------------*/ 
exportarPdf('.btnExportarRol', 'rol');

//** ------------------------------------*/
//         IMPRIMIR PDF Parametros
// --------------------------------------*/ 
exportarPdf('.btnExportarParametro', 'parametross');

//** ------------------------------------*/
//         IMPRIMIR PDF Parametros
// --------------------------------------*/ 
exportarPdf('.btnExportarAdministrar', 'administrarrol');












