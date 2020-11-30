$( document ).ready(function() {


    $("#btn_respaldar").click(function(){
        respaldarBd();
      })
    
    $("#btn_restaurar").click(function(){
        restaurarBd();
      })
    
    
    });
    
    
    
    function respaldarBd(){
      var mesx=0;
      var totx=0;
      var v = 0;
    
    var form_data = new FormData();
    form_data.append("servidor",$('#servidor').val());
    form_data.append("usuario",$('#usuario').val());
    form_data.append("contrasenia",$('#contrasenia').val());
    form_data.append("nombrebd",$('#nombrebd').val());
    $.ajax({
      url: 'vistas/modulos/backup.php',
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,                         
      method: 'POST',
      success: function(data){
    
     
                    //var datar = data[0];
                    //console.log(datar[0].res);
                    if(data==1){
    
                      Swal.fire({
                        title: "Respaldo realizado con éxito.",
                        icon: "success",
                        showConfirmButton: true
                        
                      });
    
    
                    }else {
    
                      Swal.fire({
                        title: "Error al realizar el respaldo.",
                        icon: "error",
                        showConfirmButton: true
                        
                      });
    
                    } 
                    
                }
            });
        }
    
    
    
    function restaurarBd(){
      var mesx=0;
      var totx=0;
      var v = 0;
      /*if ($('#servidor').val()=='') { validate('servidor','nombre del servidor'); v = 1; } else { removervalidate('servidor'); }
      if ($('#usuario').val()=='') { validate('usuario','nombres del usuario de servidor '); v = 1; } else { removervalidate('usuario'); }
      if ($('#contrasenia').val()=='') { validate('contrasenia','contrasenia del usuario'); v = 1; } else { removervalidate('contrasenia'); }
      if ($('#nombrebd').val()=='') { validate('nombrebd','nombre de la base de datos a respaldar'); v = 1; } else { removervalidate('nombrebd'); }
      if (v==1) {
      sweetAlert("Atención", "Hay campos en blanco o no pasa todas la validaciones, por favor revise indicadores", "warning");("Atención", "Vuelva a intentar", "error");
      return;
    }  */
    var form_data = new FormData();
    form_data.append("servidor",$('#servidor2').val());
    form_data.append("usuario",$('#usuario2').val());
    form_data.append("contrasenia",$('#contrasenia2').val());
    form_data.append("nombrebd",$('#nombrebd2').val());
    form_data.append("restorePoint",$('#restorePoint').val());
    $.ajax({
      url: 'vistas/modulos/restore2.php',
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,                         
      type: 'post',
      success: function(data){
                    //var datar = data[0];
                    //console.log(datar[0].res);
                    if(data==1){
                      Swal.fire({
                        title: "Restauracion exitosa!",
                        icon: "success",
                        // background: "rgb(255 75 75 / 85%)",
                        showConfirmButton: true
                        
                      });
                      // console.log("exito");
    
                      // swal({title: "<div style='color:#636262'>Restauracion realizada con exito</div>",html: true,confirmButtonText: "Continuar"},function(){
                        
    
                      // }); 
                      //location.replace('vistas/modulos/prueba_restore.php');  
    
    
                    }else {
    
                      Swal.fire({
                        title: "Algo salio mal, intenta de nuevo!",
                        icon: "error",
                        // background: "rgb(255 75 75 / 85%)",
                        showConfirmButton: true
                        
                      });
                      // console.log("sorry");
    
                      // swal({
                      //   title: "<div style='color:#636262'>Hubo un Problema en el Servidor</div>",
                      //   text: "<div style='color:#636262'>No se pudo realizar la restauracion</div>",
                      //   html: true,
                      //   confirmButtonText: "Aceptar"},function(){
                          
    
                      //   });
                     // location.replace('vistas/modulos/prueba_restore.php');
                    } 
                    
                }
            });
        }
    
    
    
    
    
    