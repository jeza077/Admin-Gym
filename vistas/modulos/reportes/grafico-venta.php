<?php 
  if(isset($_GET["fechaInicial"])){


    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

    // echo $fechaInicial;
    // echo $fechaFinal;
} else {

    $fechaInicial = null;
    $fechaFinal = null;

} 

    $ventas = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
 
    // echo '<pre>';
    // var_dump($ventas);
    // echo '</pre>';
    $arrayFechas = array();
    $arrayVentas = array();
    $sumaPagosMes = array();

    foreach ($ventas as $key => $value) {

        #Capturamos sólo el año y el mes
        $fecha = substr($value["fecha"],0,7);

        // echo $fecha;
        #Introducir las fechas en arrayFechas
        array_push($arrayFechas, $fecha);

        #Capturamos las ventas
        $arrayVentas = array($fecha => $value["total"]);
        // echo '<pre>';
        // var_dump($arrayVentas);
        // echo '</pre>';

        #Sumamos los pagos que ocurrieron el mismo mes
        foreach ($arrayVentas as $key => $value) {
		
            $sumaPagosMes[$key] += $value;
            // echo $key;
            // echo '<pre>';
            // var_dump($sumaPagosMes[$key]);
            // echo '</pre>';
            
        }

    }      

    $noRepetirFechas = array_unique($arrayFechas);
?>

<div class="card bg-gradient-teal">
    <div class="card-header border-0">
        <h3 class="card-title" style="color:#fff">
            <i class="fas fa-th mr-1"></i>
            Grafico de Ventas
        </h3>
    </div>

    <div class="card-body nuevoGraficoVentas">
        <div class="chart" id="line-chart-ventas" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>
    </div>

</div>


<script src="vistas/plugins/jquery/jquery.min.js"></script>
<script src="vistas/plugins/morris.js/morris.min.js"></script>
<script src="vistas/plugins/raphael/raphael.min.js"></script>


<script>

	
var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [

    <?php

    if($noRepetirFechas != null){

	    foreach($noRepetirFechas as $key){

	    	echo "{ y: '".$key."', ventas: ".$sumaPagosMes[$key]." },";


	    }

	    echo "{y: '".$key."', ventas: ".$sumaPagosMes[$key]." }";

    }else{

       echo "{ y: '0', ventas: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : 'L',
    gridTextSize     : 10
  });


//   var line = new Morris.Line({
//     element          : 'line-chart-ventas',
//     resize           : true,
//     data             : [
//       { y: '2011 Q1', item1: 2666 },
//       { y: '2011 Q2', item1: 2778 },
//       { y: '2011 Q3', item1: 4912 },
//       { y: '2011 Q4', item1: 3767 },
//       { y: '2012 Q1', item1: 6810 },
//       { y: '2012 Q2', item1: 5670 },
//       { y: '2012 Q3', item1: 4820 },
//       { y: '2012 Q4', item1: 15073 },
//       { y: '2013 Q1', item1: 10687 },
//       { y: '2013 Q2', item1: 8432 }
//     ],
//     xkey             : 'y',
//     ykeys            : ['item1'],
//     labels           : ['Item 1'],
//     lineColors       : ['#efefef'],
//     lineWidth        : 2,
//     hideHover        : 'auto',
//     gridTextColor    : '#fff',
//     gridStrokeWidth  : 0.4,
//     pointSize        : 4,
//     pointStrokeColors: ['#efefef'],
//     gridLineColor    : '#efefef',
//     gridTextFamily   : 'Open Sans',
//     gridTextSize     : 10
//   });

</script>