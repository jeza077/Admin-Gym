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
exportarPdf('.btnExportarRol', 'roles');

//** ------------------------------------*/
//         IMPRIMIR PDF Parametros
// --------------------------------------*/ 
exportarPdf('.btnExportarParametro', 'parametross');

//** ------------------------------------*/
//         IMPRIMIR PDF Parametros
// --------------------------------------*/ 
exportarPdf('.btnExportarAdministrar', 'administrarrol');












