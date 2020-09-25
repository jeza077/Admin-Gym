/*=============================================
    INPUT MASK
=============================================*/

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

/*=============================================
    DATATABLES
=============================================*/
$(".tablas").DataTable({
    "responsive": true,
    "autoWidth": false,

    "language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}
  });

/*=============================================
    SIDEBAR MENU ACTIVO COLOR AZUL
=============================================*/
var pathname = window.location.href;
const claseActivo = $('.menu-lateral');
// console.log(claseActivo[3]);
var stock = claseActivo[3];

for (let i = 0; i < claseActivo.length -1; i++) {
    // console.log(claseActivo[i]['href']);
    if(pathname == claseActivo[i]['href']){
        $(claseActivo[i]).addClass('active');     
        break;
    }
    if(pathname == 'http://localhost/gym/equipo' || pathname == 'http://localhost/gym/productos'){
        $(stock).addClass('active')
    }
}

/*=============================================
  FUNCION QUE DETERMINE LA LONGITUD DE STRINGS
=============================================*/
function longitudString(selector, maxLongitud) {
	selector.keydown(function (e) {

		var valor = $(this).val();
		var codigo = e.which || e.keyCode;
		// console.log(valor.length)
		// console.log(codigo)

		if(valor.length >= maxLongitud && codigo != 8  && codigo != 116){
			e.preventDefault();
		}
	});
}

longitudString($('.usuario'),5);
longitudString($('.password'),16);

