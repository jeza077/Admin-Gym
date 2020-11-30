<?php
 
require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

class AjaxVentaGrafica{
    /*=============================================
                EDITAR Producto
    =============================================*/

    public $fechaInicial;
    public $fechaFinal;

    public function ajaxMostrarGraficaVentas(){
        $fechaInicial = $this->fechaInicial;
        $fechaFinal = $this->fechaFinal;
        $ventas = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
        echo json_encode($ventas);
    }

}

/*=============================================
            EDITAR USUARIO
=============================================*/
if(isset($_POST["fechaInicial"])){
    $graficaVentas = new AjaxVentaGrafica();
    $graficaVentas->fechaInicial = $_POST["fechaInicial"];
    $graficaVentas->fechaFinal = $_POST["fechaFinal"];
    $graficaVentas->ajaxMostrarGraficaVentas();
}