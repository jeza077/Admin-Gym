/*=============================================
// TABLA BITACORA DINAMICA
=============================================*/ 
lenguageDataTable('.tablaBitacora', 'ajax/datatable-bitacora.ajax.php');
lenguageDataTable('.tablaPermisosRol', 'ajax/datatable-permisos-rol.ajax.php');
// $('.tablaBitacora').DataTable( {
//     "ajax": "ajax/datatable-bitacora.ajax.php",
//     "deferRender": true,
//     "retrieve": true,
//     "processing": true,
//     "language": {

//       "sProcessing":     "Procesando...",
//       "sLengthMenu":     "Mostrar _MENU_ registros",
//       "sZeroRecords":    "No se encontraron resultados",
//       "sEmptyTable":     "Ningún dato disponible en esta tabla",
//       "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
//       "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
//       "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//       "sInfoPostFix":    "",
//       "sSearch":         "Buscar:",
//       "sUrl":            "",
//       "sInfoThousands":  ",",
//       "sLoadingRecords": "Cargando...",
//       "oPaginate": {
//       "sFirst":    "Primero",
//       "sLast":     "Último",
//       "sNext":     "Siguiente",
//       "sPrevious": "Anterior"
//       },
//       "oAria": {
//         "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//         "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//       }

//   }

// });


/*=====================================
//    GUARDAR ROL
========================================*/
$('.pantalla-permisos').hide();
$('#modalFooterPermisos').hide();

$(document).on('click', '.btnGuardarRol', function (e) {
    e.preventDefault();
    // console.log('clcik')

    $(this).html('');
    // $(this).append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');

    
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
            // return;
            var idRol = respuesta;

            if(respuesta){
            Swal.fire({
                icon: "success",
                title: "¡El rol ha sido creado exitosamente!",
                showConfirmButton: true,
                // showCloseButton: true,
                confirmButtonText: "Cerrar",
                heightAuto: false,
                allowOutsideClick: false
    
              }).then((result)=>{
    
                if(result.value){
    
                //   window.location = "mantenimiento";
                    Swal.fire({

                        icon: "info",
                        title: "Por último, agregue los permisos",
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
                                    // console.log('consulta',consulta)
                                    // console.log('agregar',agregar)
                                    // console.log('actualizar',actualizar)
                                    // console.log('eliminar',eliminar)
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
                                            // console.log(respuesta)
    
                                            $('input[type=checkbox]').prop('checked',false);   
                                            $('#nuevaPantalla').val('Seleccione...');                                       
                                            if(respuesta == 'true'){
                                                $('#modalFooterPermisos').before('<div class="alert alert-success alert-dismissible ml-3 mr-3 mt-4" role="alert"><i class="icon fas fa-check"></i>Los permisos se agregaron correctamente.</div>');
                                                setTimeout(function () {
                                                    $('.alert').remove();
                                                }, 4000)
    
                                                
                                            } else if(respuesta == '"existe"'){
                                                console.log('agregue otra')
                                                $('#modalFooterPermisos').before('<div class="alert alert-danger alert-dismissible ml-3 mr-3 mt-4" role="alert"><i class="icon fas fa-ban"></i>La pantalla elegida ya ha sido asociada anteriormente a este rol.</div>');
                                                setTimeout(function () {
                                                    $('.alert').remove();
                                                }, 4000)
                                            } else {
                                                // $('input[type=checkbox]').prop('checked',false);
                                                $('#modalFooterPermisos').before('<div class="alert alert-danger alert-dismissible ml-3 mr-3 mt-4" role="alert"><i class="icon fas fa-ban"></i>¡Algo salió mal, intenta de nuevo!</div>');
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

function redireccionDinamica(selector, pantalla) {
    $(document).on('click', selector, function (e) {
        e.preventDefault();
        window.location = pantalla;
    });
}
redireccionDinamica('.btnGuardarCambios', 'rol');
// redireccionDinamica('.btnGuardarCambiosEditar', 'rol');


/* ========================================
//        GUARDAR PROVEEDOR
=========================================== */
$(document).on('click', '.btnGuardarProveedor', function (e) {
    e.preventDefault();
    // console.log('clcik')
    var nombre = $('input[name=nuevoNombre]').val();
    var correo = $('input[name=nuevoCorreo]').val();
    var telefono = $('input[name=nuevoTelefono]').val();
    // console.log(telefono)

    // return;
    var datos = new FormData();
    datos.append('nombre', nombre);
    datos.append('correo', correo);
    datos.append('telefono', telefono);

    $.ajax({
        
        url:"ajax/mantenimiento.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        success:function(respuesta){ 
            // console.log(respuesta)
            
            if(respuesta == 'true'){
                Swal.fire({
                    icon: "success",
                    title: "Proveedor creado exitosamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result) => {
                        if (result.value) {

                            var pathname = window.location.href;
                            // console.log(pathname);
                            if(pathname == 'http://localhost/admin/compras'){
                                // console.log('prov')
                                var btnSalirModal = $('.salirModal');
                                btnSalirModal.click();
                                $('#nuevoProveedor').remove();
                                selectDinamico();
                            } else {
                                
                                window.location = "proveedores";
                            }

                        }
                    })
        
            } else if(respuesta == '"Mal"'){

                Swal.fire({
                    title: "¡Campos no pueden ir vacíos, escrito en minúsculas o llevar caracteres especiales, intente de nuevo!",
                    icon: "error",
                    heightAuto: false,
                    allowOutsideClick: false
                });
            
            } else {
                
                Swal.fire({
                    title: "¡Algo salió mal, intente de nuevo!",
                    icon: "error",
                    heightAuto: false,
                    allowOutsideClick: false
                });
            } 
        }
    })

});


/*===================================
//    EDITAR ROL
====================================*/
$(document).on("click", ".btnEditarRol", function(){
    
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
            // console.log(respuesta);

            // $('#editarRol').val(respuesta['rol']);
            // $('#editarDescripcionRol').val(respuesta['descripcion']);
            // $('#editarIdRol').val(respuesta['id_rol']);
            $('#editarRol').attr('value', respuesta['rol']);
            $('#editarDescripcionRol').attr('value', respuesta['descripcion']);
            $('#editarIdRol').val(respuesta['id_rol']);


            if(respuesta){
    
                // $('input[name=editarRol]').attr('enable',true);
                // $('input[name=editarDescripcionRol]').attr('enable',true);
                
                //$('#modalFooterRol').hide();
                $('.pantalla-permisos').show();
                $('#modalFooterPermisosEditar').show();
                
                $(document).on('click', '#btnGuardarPermisosEditar', function (e) {
                    e.preventDefault();
                    $('.alert').remove();

                    var padreNotificacion = $('#btnGuardarPermisosEditar').parent();
                    // console.log(padreNotificacion)
                    
                    if($('#nuevaPantallaEditar').val() == 'Seleccione...' || $('#nuevaPantallaEditar').val() == "") {
    
                        padreNotificacion.after('<div class="form-group alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>Por favor, elige una pantalla!</div>');
                        setTimeout(function () {
                            $('.alert').remove();
                        }, 4000)
                                            
                    } else if(!$('input[name=nuevoEditarConsulta]').is(':checked') && !$('input[name=nuevoEditarAgregar]').is(':checked') && !$('input[name=nuevoEditarActualizar]').is(':checked') && !$('input[name=nuevoEditarEliminar]').is(':checked')){
                        
                        padreNotificacion.after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>Por favor, elige al menos un permiso!</div>');
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
                        // console.log('consulta',consulta)
                        // console.log('agregar',agregar)
                        // console.log('actualizar',actualizar)
                        // console.log('eliminar',eliminar)
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
                                // console.log(respuesta)

                                $('input[type=checkbox]').prop('checked',false);   
                                $('#nuevaPantallaEditar').val('Seleccione...');                                       
                                if(respuesta == 'true'){
                                    padreNotificacion.after('<div class="alert alert-success alert-dismissible" role="alert"  style="margin:70px 0 0 0"><i class="icon fas fa-check"></i>Los permisos se agregaron correctamente.</div>');
                                    setTimeout(function () {
                                        $('.alert').remove();
                                    }, 4000)

                                    
                                } else if(respuesta == '"existe"'){
                                    // console.log('agregue otra')
                                    padreNotificacion.after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>La pantalla elegida ya ha sido asociada anteriormente a este rol.</div>');
                                    setTimeout(function () {
                                        $('.alert').remove();
                                    }, 4000)
                                } else {
                                    // $('input[type=checkbox]').prop('checked',false);
                                    padreNotificacion.after('<div class="alert alert-danger alert-dismissible" role="alert" style="margin:70px 0 0 0"><i class="icon fas fa-ban"></i>Algo salió mal, intenta de nuevo!</div>');
                                    setTimeout(function () {
                                        $('.alert').remove();
                                    }, 4000)
                                }

                            }
                        });
                    }

                });


            }
         
        } 

    });


});

/*===================================
//    EDITAR PARAMETROS
====================================*/
$(document).on("click", ".btnEditarParametro", function(){
    
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
//    EDITAR INSCRIPCION
====================================*/
$(document).on("click", ".btnEditarInscripcion", function(){
    
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
            console.log(respuesta);

            $('#editarInscripcion').val(respuesta['tipo_inscripcion']);
            $('#editarPrecioInscripcion').val(respuesta['precio_inscripcion']);
            $('#editarDiasInscripcion').val(respuesta['cantidad_dias']);
            $('#editarIdInscripcion').attr('value', respuesta['id_inscripcion']);
            
         
        } 

    });



});

/*===================================
//    EDITAR MATRIUCLA
====================================*/
$(document).on("click", ".btnEditarMatricula", function(){
    
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
//    EDITAR DESCUENTO
====================================*/
$(document).on("click", ".btnEditarDescuento", function(){
    
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
            // console.log(respuesta)

            $('#editarDescuento').val(respuesta['tipo_descuento']);
            $('#editarValorDescuento').val(respuesta['valor_descuento']);
            $('#editarIdDescuento').val(respuesta['id_descuento']);
         
        } 

    });



});

/*===================================
//    EDITAR GENERO
====================================*/
$(document).on("click", ".btnEditarSexo", function(){
    
    var idGenero = $(this).attr("idGenero");
    // console.log(idGenero)
    var datos = new FormData();
    datos.append("idGenero", idGenero);

    $.ajax({

        url:"ajax/mantenimiento.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        dataType: "json",
        success:function(respuesta){ 
            // console.log(respuesta)

            $('#editarGenero').val(respuesta['sexo']);
            $('#editarIdGenero').val(respuesta['id_sexo']);
         
        } 

    });
});

/*===================================
//    EDITAR DOCUMENTO
====================================*/
$(document).on("click", ".btnEditarDocumento", function(){
    
    var idDocumento = $(this).attr("idDocumento");
    // console.log(idDocumento)
    var datos = new FormData();
    datos.append("idDocumento", idDocumento);

    $.ajax({

        url:"ajax/mantenimiento.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        dataType: "json",
        success:function(respuesta){ 
            // console.log(respuesta)

            $('#editarDocumento').val(respuesta['tipo_documento']);
            $('#editarIdDocumento').val(respuesta['id_documento']);
         
        } 

    });
});

/*===================================
//    EDITAR PREGUNTA
====================================*/
$(document).on("click", ".btnEditarPregunta", function(){
    
    var idPregunta = $(this).attr("idPregunta");
    // console.log(idPregunta)
    var datos = new FormData();
    datos.append("idPregunta", idPregunta);

    $.ajax({

        url:"ajax/mantenimiento.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        dataType: "json",
        success:function(respuesta){ 
            // console.log(respuesta)

            $('#editarPregunta').val(respuesta['pregunta']);
            $('#editarIdPregunta').val(respuesta['id_preguntas']);
         
        } 

    });
});

/*===================================
    EDITAR PROVEEDOR
====================================*/
$(document).on("click", ".btnEditarProveedor", function(){
    
    var idProveedor = $(this).attr("idProveedor");
    console.log(idProveedor)

    var datos = new FormData();
    datos.append("idProveedor", idProveedor);

    $.ajax({

        url:"ajax/mantenimiento.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType:false,
        processData:false,
        dataType: "json",
        success:function(respuesta){ 
            // console.log(respuesta)

            $('#editarNombre').val(respuesta['nombre']);
            $('#editarCorreo').val(respuesta['correo']);
            $('#editarTelefono').val(respuesta['telefono']);
            $('#editarIdProveedor').val(respuesta['id_proveedor']);
        } 

    });


});




/*** Borrar Roles ***/
let boton = '.btnEliminarRoles';
let atributo = 'ideliminarRoles';
let get = 'idEliminarRoles';
let titulo = "¿Estás seguro de querer borrar el rol?";
let texto = "¡Si no lo estas, puedes cancelar la acción!";
let ruta = 'rol';
borrarDinamico(boton, atributo, get, titulo, texto, ruta);

/*** Borrar Matricula ***/
boton = '.btnEliminarMatricula';
atributo = 'ideliminarMatricula';
get = 'idEliminarMatricula';
titulo = "¿Estás seguro de querer borrar la matricula?";
texto = "¡Si no lo estas, puedes cancelar la acción!";
ruta = 'matricula';
borrarDinamico(boton, atributo, get, titulo, texto, ruta);

/*** Borrar Inscripcion ***/
boton = '.btnEliminarInscripcion';
atributo = 'idEliminarInscripcion';
get = 'idEliminarInscripcion';
titulo = "¿Estás seguro de querer borrar la inscripción?";
texto = "¡Si no lo estas, puedes cancelar la acción!";
ruta = 'inscripcion';
borrarDinamico(boton, atributo, get, titulo, texto, ruta);

/*** Borrar Descuentos ***/
boton = '.btnEliminarDescuento';
atributo = 'ideliminarDescuento';
get = 'idEliminarDescuento';
titulo = "¿Estás seguro de querer borrar el descuento?";
texto = "¡Si no lo estas, puedes cancelar la acción!";
ruta = 'descuento';
borrarDinamico(boton, atributo, get, titulo, texto, ruta);

/*** Borrar Genero ***/
boton = '.btnEliminarGenero';
atributo = 'idEliminarGenero';
get = 'idEliminarGenero';
titulo = "¿Estás seguro de querer borrar el género?";
texto = "¡Si no lo estas, puedes cancelar la acción!";
ruta = 'genero';
borrarDinamico(boton, atributo, get, titulo, texto, ruta);

/*** Borrar Documento ***/
boton = '.btnEliminarDocumento';
atributo = 'idEliminarDocumento';
get = 'idEliminarDocumento';
titulo = "¿Estás seguro de querer borrar el documento?";
texto = "¡Si no lo estas, puedes cancelar la acción!";
ruta = 'documentos';
borrarDinamico(boton, atributo, get, titulo, texto, ruta);

/*** Borrar Pregunta ***/
boton = '.btnEliminarPregunta';
atributo = 'idEliminarPregunta';
get = 'idEliminarPregunta';
titulo = "¿Estás seguro de querer borrar la pregunta?";
texto = "¡Si no lo estas, puedes cancelar la acción!";
ruta = 'preguntas-seguridad';
borrarDinamico(boton, atributo, get, titulo, texto, ruta);

/*** Borrar Proveedores ***/
boton = '.btnEliminarProveedor';
atributo = 'idEliminarProveedor';
get = 'idProveedor';
titulo = "¿Estás seguro de querer borrar el proveedor?";
texto = "¡Si no lo estas, puedes cancelar la acción!";
ruta = 'proveedores';
borrarDinamico(boton, atributo, get, titulo, texto, ruta);






/*=====================================
ACTIVAR ROL
========================================*/
$(document).on("click", ".btnActivarRol", function(){

    let idActivarDinamico = $(this).attr("idRol");
    let estadoDinamico = $(this).attr("estadoRol");
    let tablaDinamica = 'tbl_roles';
    let idTablaDinamica = 'id_rol';
    let idPantallaDinamica = 18;
    // console.log(estadoGenero)
    let datos = new FormData();
    datos.append("idActivarDinamico", idActivarDinamico);
    datos.append("estadoDinamico",estadoDinamico);
    datos.append("tablaDinamica",tablaDinamica);
    datos.append("idTablaDinamica",idTablaDinamica);
    datos.append("idPantallaDinamica",idPantallaDinamica);


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

    if(estadoDinamico == 0){
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
ACTIVAR PERMISOS ROL
========================================*/
$(document).on("click", ".btnActivarPermisos", function(){

    var idPermiso = $(this).attr("idPermiso");
    var estadoPermiso = $(this).attr("estadoPermiso");
    var tipoPermiso = $(this).attr("tipoPermiso");

    // console.log(idPermiso)
    // console.log(estadoPermiso)
    // console.log(tipoPermiso)

    // return;

    var datos = new FormData();
    datos.append("idPermiso", idPermiso);
    datos.append("estadoPermiso", estadoPermiso);
    datos.append("tipoPermiso", tipoPermiso);


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

    if(estadoPermiso == 0){

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('No');
        $(this).attr('estadoPermiso',1);

    }else{

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Si');
        $(this).attr('estadoPermiso',0);

    }

})

/*=====================================
ACTIVAR INSCRIPCIONES
========================================*/
$(document).on("click", ".btnActivarInscripcion", function(){

    let idActivarDinamico = $(this).attr("idInscripcion");
    let estadoDinamico = $(this).attr("estadoInscripcion");
    let tablaDinamica = 'tbl_inscripcion';
    let idTablaDinamica = 'id_inscripcion';
    let idPantallaDinamica = 21;
    // console.log(estadoGenero)
    let datos = new FormData();
    datos.append("idActivarDinamico", idActivarDinamico);
    datos.append("estadoDinamico",estadoDinamico);
    datos.append("tablaDinamica",tablaDinamica);
    datos.append("idTablaDinamica",idTablaDinamica);
    datos.append("idPantallaDinamica",idPantallaDinamica);


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

    if(estadoDinamico == 0){
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
$(document).on("click", ".btnActivarMatricula", function(){

    let idActivarDinamico = $(this).attr("idMatricula");
    let estadoDinamico = $(this).attr("estadoMatricula");
    let tablaDinamica = 'tbl_matricula';
    let idTablaDinamica = 'id_matricula';
    let idPantallaDinamica = 22;
    // console.log(estadoGenero)
    let datos = new FormData();
    datos.append("idActivarDinamico", idActivarDinamico);
    datos.append("estadoDinamico",estadoDinamico);
    datos.append("tablaDinamica",tablaDinamica);
    datos.append("idTablaDinamica",idTablaDinamica);
    datos.append("idPantallaDinamica",idPantallaDinamica);

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

    if(estadoDinamico == 0){
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
$(document).on("click", ".btnActivarDescuento", function(){

    let idActivarDinamico = $(this).attr("idDescuento");
    let estadoDinamico = $(this).attr("estadoDescuento");
    let tablaDinamica = 'tbl_descuento';
    let idTablaDinamica = 'id_descuento';
    let idPantallaDinamica = 23;
    // console.log(estadoGenero)
    let datos = new FormData();
    datos.append("idActivarDinamico", idActivarDinamico);
    datos.append("estadoDinamico",estadoDinamico);
    datos.append("tablaDinamica",tablaDinamica);
    datos.append("idTablaDinamica",idTablaDinamica);
    datos.append("idPantallaDinamica",idPantallaDinamica);

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

    if(estadoDinamico == 0){
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

/*=====================================
ACTIVAR GENERO
========================================*/
$(document).on("click", ".btnActivarGenero", function(){

    let idActivarDinamico = $(this).attr("idGenero");
    let estadoDinamico = $(this).attr("estadoGenero");
    let tablaDinamica = 'tbl_sexo';
    let idTablaDinamica = 'id_sexo';
    let idPantallaDinamica = 35;
    // console.log(estadoGenero)
    let datos = new FormData();
    datos.append("idActivarDinamico", idActivarDinamico);
    datos.append("estadoDinamico",estadoDinamico);
    datos.append("tablaDinamica",tablaDinamica);
    datos.append("idTablaDinamica",idTablaDinamica);
    datos.append("idPantallaDinamica",idPantallaDinamica);

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

    if(estadoDinamico == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoGenero',1);

    }else{


        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoGenero',0);

    }

})

/*=====================================
ACTIVAR DOCUMENTO
========================================*/
$(document).on("click", ".btnActivarDocumento", function(){

    let idActivarDinamico = $(this).attr("idDocumento");
    let estadoDinamico = $(this).attr("estadoDocumento");
    let tablaDinamica = 'tbl_documento';
    let idTablaDinamica = 'id_documento';
    let idPantallaDinamica = 24;
    // console.log(estadoGenero)
    let datos = new FormData();
    datos.append("idActivarDinamico", idActivarDinamico);
    datos.append("estadoDinamico",estadoDinamico);
    datos.append("tablaDinamica",tablaDinamica);
    datos.append("idTablaDinamica",idTablaDinamica);
    datos.append("idPantallaDinamica",idPantallaDinamica);


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

    if(estadoDinamico == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoDocumento',1);

    }else{


        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoDocumento',0);

    }

})

/*=====================================
ACTIVAR PREGUNTA
========================================*/

$(document).on("click", ".btnActivarPregunta", function(){

    let idActivarDinamico = $(this).attr("idPreguntaActivar ");
    let estadoDinamico = $(this).attr("estadoPregunta");
    let tablaDinamica = 'tbl_preguntas';
    let idTablaDinamica = 'id_preguntas';
    let idPantallaDinamica = 32;
    // console.log(estadoGenero)
    let datos = new FormData();
    datos.append("idActivarDinamico", idActivarDinamico);
    datos.append("estadoDinamico",estadoDinamico);
    datos.append("tablaDinamica",tablaDinamica);
    datos.append("idTablaDinamica",idTablaDinamica);
    datos.append("idPantallaDinamica",idPantallaDinamica);

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
    

    if(estadoDinamico == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoPregunta',1);

    }else{


        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoPregunta',0);

    }
    

})




//** ------------------------------------*/
//         IMPRIMIR PDF INSCRIPCiON
// --------------------------------------*/ 
exportarPdf('.btnExportarInscripcion', 'inscripcion');

//** ------------------------------------*/
//         IMPRIMIR PDF MATRICULA
// --------------------------------------*/ 
exportarPdf('.btnExportarMatricula', 'matricula');

//** ------------------------------------*/
//         IMPRIMIR PDF DOCUMENTO
// --------------------------------------*/ 
exportarPdf('.btnExportarDocumento', 'documentos');

//** ------------------------------------*/
//         IMPRIMIR PDF DESCUENTO
// --------------------------------------*/ 
exportarPdf('.btnExportarDescuento', 'descuento');

//** ------------------------------------*/
//         IMPRIMIR PDF ROl
// --------------------------------------*/ 
exportarPdf('.btnExportarRol', 'rol');

//** ------------------------------------*/
//         IMPRIMIR PDF PREGUNTAS
// --------------------------------------*/ 
exportarPdf('.btnExportarPreguntas', 'preguntas-seguridad');

//** ------------------------------------*/
//         IMPRIMIR PDF PARAMETROS
// --------------------------------------*/ 
exportarPdf('.btnExportarParametro', 'parametros');

//** ------------------------------------*/
//         IMPRIMIR PDF PROVEEDORES
// --------------------------------------*/ 
exportarPdf('.btnExportarProveedores', 'proveedores');

//** ------------------------------------*/
//         IMPRIMIR PDF OBJETOS
// --------------------------------------*/ 
exportarPdf('.btnExportarObjetos', 'objetos');

//** ------------------------------------*/
//       IMPRIMIR PDF PERMISOS-ROL
// --------------------------------------*/ 
exportarPdf('.btnExportarPermisosRol', 'permisos-rol');



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