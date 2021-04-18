<?php
require_once("../../../controladores/mantenimiento.controlador.php");
// require_once "../../controladores/usuarios.controlador.php";
require_once('../../../controladores/usuarios.controlador.php');
require_once "../../../modelos/usuarios.modelo.php";
require_once('../../../controladores/globales.controlador.php');
require_once "../../../modelos/globales.modelo.php";

require_once('../examples/tcpdf_include.php');


session_start();

$descripcionEvento = "".$_SESSION['usuario']." Generó reporte pdf de descuentos";
$accion = "Generar";
$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION['id_usuario'], 23, $accion,
$descripcionEvento);


class PDF extends TCPDF{
    
    // Header de la pagina
    public function Header() {
        // Logo
        $item="parametro";
        $valor="ADMIN_NOMBRE_EMPRESA";

        $nombreEmpresa = ControladorUsuarios::ctrMostrarParametros($item, $valor);
        // var_dump($nombreEmpresa ['valor']);
        $nombre = $nombreEmpresa ['valor'];
    
        $item="parametro";
        $valor="ADMIN_DIRECCION_EMPRESA";

        $direccionEmpresa = ControladorUsuarios::ctrMostrarParametros($item, $valor);
        // var_dump($direccionEmpresa ['valor']);
        $direccion = $direccionEmpresa ['valor'];
    
        $item="parametro";
        $valor="ADMIN_CORREO";

        $correoEmpresa = ControladorUsuarios::ctrMostrarParametros($item, $valor);
        // var_dump($correoEmpresa ['valor']);
        $correo = $correoEmpresa ['valor'];


        // Logo
        $image_file = K_PATH_IMAGES.'logo_gym.png';
        $this->Image($image_file, 40, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        // Fuente
        $this->Ln(2);
        $this->SetFont('helvetica', 'B', 16);
        
        //establecer el color del texto
        $this->SetTextColor(255,0,0);

        // Title
        // $this->Cell(189, 5, 'GIMNASIO LA "ROCA"', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(180, 10, ''.$nombre.'', 0, 1, 'C');
        
        $this->SetTextColor(0,0,0);
        $this->SetFont('helvetica', '', 9);
        // $this->Cell(180, 3, 'Gimnasio La roca', 0, 1, 'C');
        $this->Cell(180, 7, 'Direccion: '.$direccion.'', 0, 1, 'C');
        // $this->Cell(180, 3, 'Calle xxxxxxxxxx.....', 0, 1, 'C');
        $this->Cell(180, 3, 'Correo: '.$correo.'', 0, 1, 'C');

        $this->Ln(20); //Espacios
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(180, 3, 'REPORTE DE TIPOS DE DESCUENTOS', 0, 1, 'C');
        $this->Ln(3);
        $this->SetFont('helvetica', 'B', 11);
        $año = date('Y-m-d');
        // echo $año;

        // $this->Cell(180, 3, 'Del '.$fecha.'', 0, 1, 'C');

        $this->Cell(180, 3, 'Fecha '.$año.'', 0, 1, 'C');
    }

    // Footer de la pagina
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number

        date_default_timezone_set("America/Tegucigalpa");
        $fecha = date('Y-m-d H:i:s');
        $this->Cell(0, 10, ''.$fecha.'', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}


// Crear un nuevo documento PDF
// $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jesús Zuniga');
$pdf->SetTitle('Reporte de Descuento');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$pdf->Ln(60);

$pdf->SetFont('times', '', 13);
$pdf->SetFillColor(225, 235, 255);
$pdf->Cell(15, 5, 'No', 1, 0, 'C', 1);
$pdf->Cell(75, 5, 'Tipo de Descuento', 1, 0, 'C', 1);
$pdf->Cell(50, 5, 'Valor de descuento (%)', 1, 0, 'C', 1);
$pdf->Cell(40, 5, 'Estado', 1, 0, 'C', 1);

//$tabla = "tbl_inscripcion";
if(isset($_GET["rango"])){


    $rango = $_GET["rango"];
    // $fechaFinal = $_GET["fechaFinal"];
    // $ventas = ControladorVentas::ctrRango($rango);

    // echo $rango;
    // echo $fechaFinal;
} else {

    $rango = null;
    // $fechaFinal = null;
    // $ventas = ControladorVentas::ctrRango($rango);

} 

$descuento = ControladorGlobales::ctrRangoDescuento($rango);
// var_dump($descuento);

if(!$descuento){  

    $pdf->Ln(15);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(170, 4, '******* NO HAY DATOS PARA MOSTRAR *******', 0, 0, 'C');


}
else{
    $i = 1; //Contador
    $max = 12; //Maximo de registros a mostrar en una pagina

    foreach ($descuento as $key => $value) {

        if(($i%$max) == 0){
            $pdf->AddPage();

            $pdf->Ln(40);
            
            $pdf->SetFont('times', '', 13);
            $pdf->SetFillColor(225, 235, 255);
            $pdf->Cell(15, 5, 'No', 1, 0, 'C', 1);
            $pdf->Cell(75, 5, 'Tipo de descuento', 1, 0, 'C', 1);
            $pdf->Cell(50, 5, 'Valor de descuento (%)', 1, 0, 'C', 1);
            $pdf->Cell(40, 5, 'Estado', 1, 0, 'C', 1);
        }
        // $pdf->Cell(15, 5, ''.$i.'', 1, 0, 'C');

        $pdf->Ln(8);
        $pdf->SetFont('times', '', 12);
        // $pdf->SetFillColor(225, 235, 255);
        $pdf->Cell(15, 4, ''.($key+1).'', 0, 0, 'C');
        $pdf->Cell(75, 4, ''.$value['tipo_descuento'].' ', 0, 0, 'C');
        $pdf->Cell(50, 4, ''.$value['valor_descuento'].'', 0, 0, 'C');
        if($value["estado"] == 0){
            $pdf->Cell(40, 4, 'Desactivado', 0, 0, 'C');
        } else {
            $pdf->Cell(40, 4, 'Activado', 0, 0, 'C');
        }
        $i++;

    }

}

ob_end_clean();

// Close and output PDF document
$pdf->Output('reporte_descuento.pdf', 'I');

?>