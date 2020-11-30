/*--=====================================
        VARIABLE LOCAL STORAGE
======================================--*/
var pathname = window.location.href;

if(localStorage.getItem("capturarRangoGraficaVentas") != null && pathname == 'http://localhost/Admin-Gym/reportes'){

  $("#daterange-btn-reporte span").html('<i class="fa fa-calendar"></i> Rango de fecha');
  localStorage.removeItem("capturarRangoGraficaVentas");
  localStorage.clear();
  
} else if(localStorage.getItem("capturarRangoGraficaVentas") != null) {
  $("#daterange-btn-reporte span").html(localStorage.getItem("capturarRangoGraficaVentas"));

} else {
  $("#daterange-btn-reporte span").html('<i class="fa fa-calendar"></i> Rango de fecha');
}

$('#daterange-btn-reporte').on('click', function () {  
    $('.daterangepicker').addClass('graficoVentas');
})

// /*=============================================
//     DATERANGE PICKER
//   ===========================================*/
datarangeDinamico($('#daterange-btn-reporte'), $('#daterange-btn-reporte span'), 'capturarRangoGraficaVentas', 'reportes');

// /*=============================================
//         CAPTURAR HOY
// =============================================*/  
datarangeDinamicoHoy(".daterangepicker.graficoVentas .ranges li", 'capturarRangoGraficaVentas', 'Hoy', 'reportes');
