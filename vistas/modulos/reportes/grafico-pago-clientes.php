<?php 
//   if(isset($_GET["fechaInicial"])){


//     $fechaInicial = $_GET["fechaInicial"];
//     $fechaFinal = $_GET["fechaFinal"];

//     // echo $fechaInicial;
//     // echo $fechaFinal;
// } else {

    // $fechaInicial = null;
    // $fechaFinal = null;

// } 
$tabla = "tbl_clientes";
$item = 'tipo_cliente';
$valor = 'Gimnasio';
$max = null;
$clientes = ControladorClientes::ctrMostrarClientesPagos($tabla, $item, $valor, $max);

    // echo '<pre>';
    // var_dump($clientes);
    // echo '</pre>';
    // return;
    $arrayFechas = array();
    $arrayVentas = array();
    $sumaPagosMes = array();

    foreach ($clientes as $key => $value) {
        // var_dump($value['pago_total']);
        #Capturamos sólo el año y el mes
        $fecha = substr($value["fecha_ultimo_pago"],0,7);

        // echo $fecha;
        #Introducir las fechas en arrayFechas
        array_push($arrayFechas, $fecha);

        #Capturamos las ventas
        $arrayVentas = array($fecha => $value["pago_total"]);
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
    // echo $key;
    // echo '<pre>';
    // var_dump($noRepetirFechas);
    // echo '</pre>';

?>

<div class="card bg-gradient-navy">
    <div class="card-header border-0">
        <h3 class="card-title" style="color:#fff">
            <i class="fas fa-th mr-1"></i>
            Grafico de Pago Clientes
        </h3>
    </div>

    <div class="card-body">
        <div class="chart" id="line-chart-clientes" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>
    </div>

</div>


<script src="vistas/plugins/jquery/jquery.min.js"></script>
<script src="vistas/plugins/morris.js/morris.min.js"></script>
<script src="vistas/plugins/raphael/raphael.min.js"></script>


<script>

	
var line = new Morris.Line({
    element          : 'line-chart-clientes',
    resize           : true,
    data             : [

    <?php

    if($noRepetirFechas != null){

	    foreach($noRepetirFechas as $key){

	    	echo "{ y: '".$key."', inscripcion: ".$sumaPagosMes[$key]." },";


	    }

	    echo "{y: '".$key."', inscripcion: ".$sumaPagosMes[$key]." }";

    }else{

       echo "{ y: '0', inscripcion: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['inscripcion'],
    labels           : ['inscripcion'],
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

/*
  var line = new Morris.Line({
    element          : 'line-chart-clientes',
    resize           : true,
    data             : [
      { y: '2011 Q1', item1: 2666 },
      { y: '2011 Q2', item1: 2778 },
      { y: '2011 Q3', item1: 4912 },
      { y: '2011 Q4', item1: 3767 },
      { y: '2012 Q1', item1: 6810 },
      { y: '2012 Q2', item1: 5670 },
      { y: '2012 Q3', item1: 4820 },
      { y: '2012 Q4', item1: 15073 },
      { y: '2013 Q1', item1: 10687 },
      { y: '2013 Q2', item1: 8432 }
    ],
    xkey             : 'y',
    ykeys            : ['item1'],
    labels           : ['Item 1'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });
  */

</script>