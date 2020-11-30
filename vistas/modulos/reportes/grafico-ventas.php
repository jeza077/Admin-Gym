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

<div class="card bg-gradient-info">
    <div class="card-header border-0">
        <h3 class="card-title">
            <i class="fas fa-th mr-1"></i>
            Grafico de Ventas
        </h3>
    </div>

    <div class="card-body">
        <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>

</div>


<script src="vistas/plugins/jquery/jquery.min.js"></script>
<script src="vistas/plugins/chart.js/Chart.min.js"></script>

<script>

function getQueryVariable(variable) {
   var query = window.location.search.substring(1);
   var vars = query.split("&");
   for (var i=0; i < vars.length; i++) {
       var pair = vars[i].split("=");
       if(pair[0] == variable) {
           return pair[1];
       }
   }
   return false;
}

// console.log(window.location.search.substring(15));
// console.log(getQueryVariable('fechaFinal'));

var fechaInicial = getQueryVariable('fechaInicial');
var fechaFinal = getQueryVariable('fechaFinal')

var datos = new FormData();
datos.append('fechaInicial', fechaInicial);
datos.append('fechaFinal', fechaFinal);
// console.log(fechaInicial);
// console.log(fechaFinal);



$.ajax({

    url:"ajax/ventas-grafica.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,  
    dataType: "json",
    success: function (respuesta) {
        // console.log(respuesta);

        var arrayFechas = [];
        var arrayVentas = [];
        var sumaPagosMes = [];
        var suma = 0;

        respuesta.forEach(element => {
            // console.log(element.fecha);
            var fecha = element.fecha.substring(0,7);
            // console.log(fecha)
            arrayFechas.push(fecha)
            // console.log(arrayFechas)

            arrayVentas[fecha] = element.total;
            // console.log(arrayVentas)

            for(i in arrayVentas){
                suma = suma + parseInt(arrayVentas[i])
                // console.log(suma);
            }
         
            sumaPagosMes[fecha] = suma;


        });
            console.log(sumaPagosMes);
        // console.log(arrayFechas);


        // Sales graph chart
        var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
        // $('#revenue-chart').get(0).getContext('2d');

        var salesGraphChartData = {
          labels: arrayFechas,
          datasets: [
            {
              label: 'Digital Goods',
              fill: false,
              borderWidth: 2,
              lineTension: 0,
              spanGaps: true,
              borderColor: '#efefef',
              pointRadius: 3,
              pointHoverRadius: 7,
              pointColor: '#efefef',
              pointBackgroundColor: '#efefef',
              data: [2666, 2778, 4912, 3767, 6810, 5670, 4820, 15073, 10687, 8432]
            }
          ]
        }

        var salesGraphChartOptions = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              ticks: {
                fontColor: '#efefef'
              },
              gridLines: {
                display: false,
                color: '#efefef',
                drawBorder: false
              }
            }],
            yAxes: [{
              ticks: {
                stepSize: 5000,
                fontColor: '#efefef'
              },
              gridLines: {
                display: true,
                color: '#efefef',
                drawBorder: false
              }
            }]
          }
        }

        // This will get the first returned node in the jQuery collection.
        // eslint-disable-next-line no-unused-vars
        var salesGraphChart = new Chart(salesGraphChartCanvas, {
          type: 'line',
          data: salesGraphChartData,
          options: salesGraphChartOptions
        })


    }
})



</script>