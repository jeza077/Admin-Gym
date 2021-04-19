<?php
require_once("../../../controladores/mantenimiento.controlador.php");
require_once("../../../controladores/usuarios.controlador.php");
require_once "../../../modelos/usuarios.modelo.php";
require_once('../../../controladores/clientes.controlador.php');
require_once "../../../modelos/clientes.modelo.php";
require_once('../examples/tcpdf_include.php');
//date_default_timezone_set("America/Tegucigalpa");

session_start();

$descripcionEvento = "".$_SESSION['usuario']." Generó reporte pdf de clientes pagos histórico";
$accion = "Generar";
$bitacoraConsulta = ControladorMantenimientos::ctrBitacoraInsertar($_SESSION['id_usuario'], 7, $accion,
$descripcionEvento);

class PDF extends TCPDF{
    
    // Header de la pagina
    public function Header() {
        date_default_timezone_set("America/Tegucigalpa");

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
        $this->Image($image_file, 65, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        // Fuente
        $this->Ln(2);
        $this->SetFont('helvetica', 'B', 16);
        
        //establecer el color del texto
        $this->SetTextColor(255,0,0);

        // Title
        // $this->Cell(189, 5, 'GIMNASIO LA "ROCA"', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(260, 10, ''.$nombre.'', 0, 1, 'C');
        
        $this->SetTextColor(0,0,0);
        $this->SetFont('helvetica', '', 9);
        // $this->Cell(260, 3, 'Gimnasio La roca', 0, 1, 'C');
        $this->Cell(260, 3, ''.$direccion.'', 0, 1, 'C');
        // $this->Cell(260, 3, 'Calle xxxxxxxxxx.....', 0, 1, 'C');
        $this->Cell(260, 5, ''.$correo.'', 0, 1, 'C');

        $this->Ln(20); //Espacios
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(260, 3, 'REPORTE PAGOS CLIENTES HISTÓRICO', 0, 1, 'C');
        $this->Ln(3);
        $this->SetFont('helvetica', 'B', 11);

        $año = date('Y-m-d');
        $this->Cell(260, 3, 'Fecha '.$año.'', 0, 1, 'C');
    }

    // Footer de la pagina
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        // $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

        $fecha = date('Y-m-d H:i:s');
        $this->Cell(0, 10, ''.$fecha.'', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}


// Crear un nuevo documento PDF
// $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new PDF('l', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jesus Zuniga');
$pdf->SetTitle('Reporte Pagos Clientes Historico');
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

$pdf->Ln(45);

$pdf->SetFont('times', '', 13);
$pdf->SetFillColor(225, 235, 255);
$pdf->Cell(15, 5, 'No', 1, 0, 'C', 1);
$pdf->Cell(45, 5, 'No. Documento', 1, 0, 'C', 1);
$pdf->Cell(73, 5, 'Nombre', 1, 0, 'C', 1);
// $pdf->Cell(36, 5, 'Tipo Inscripcion', 1, 0, 'C', 1);
$pdf->Cell(28, 5, 'P. Matric.', 1, 0, 'C', 1);
$pdf->Cell(28, 5, 'Val. Descto.', 1, 0, 'C', 1);
$pdf->Cell(28, 5, 'P. Inscrip.', 1, 0, 'C', 1);
$pdf->Cell(28, 5, 'P. Total', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'Fecha Pago', 1, 0, 'C', 1);

if(isset($_GET["rango"])){

    $rango = $_GET["rango"];
    
} else {

    $rango = null;

} 


$clientes = ControladorClientes::ctrRangoHistorialPagosCliente($rango);


// var_dump($clientes);
// return;

$i = 1; //Contador
$max = 12; //Maximo de registros a mostrar en una pagina
if(!$clientes){
    // echo 'vacio';
    $pdf->Ln(15);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(170, 4, '******* NO HAS DATOS PARA MOSTRAR *******', 0, 0, 'C');
} else {

    
    foreach ($clientes as $key => $value) {
    
        if(($i%$max) == 0){
            $pdf->AddPage();
    
            $pdf->Ln(40);
            
            $pdf->SetFont('times', '', 13);
            $pdf->SetFillColor(225, 235, 255);
            $pdf->Cell(15, 5, 'No', 1, 0, 'C', 1);
            $pdf->Cell(45, 5, 'No. Documento', 1, 0, 'C', 1);
            $pdf->Cell(73, 5, 'Nombre', 1, 0, 'C', 1);
            // $pdf->Cell(36, 5, 'Tipo Inscripcion', 1, 0, 'C', 1);
            $pdf->Cell(28, 5, 'P. Matric.', 1, 0, 'C', 1);
            $pdf->Cell(28, 5, 'Val. Descto.', 1, 0, 'C', 1);
            $pdf->Cell(28, 5, 'P. Inscrip.', 1, 0, 'C', 1);
            $pdf->Cell(28, 5, 'P. Total', 1, 0, 'C', 1);
            $pdf->Cell(30, 5, 'Fecha Pago', 1, 0, 'C', 1);
        }
        // $pdf->Cell(15, 5, ''.$i.'', 1, 0, 'C');
    
        $pdf->Ln(8);
        $pdf->SetFont('times', '', 12);
        // $pdf->SetFillColor(225, 235, 255);
        $pdf->Cell(15, 4, ''.($key+1).'', 0, 0, 'C');
        $pdf->Cell(45, 4, ''.$value['num_documento'].'', 0, 0, 'C');
        $pdf->Cell(73, 4, ''.$value['nombre'].' '.$value['apellidos'].'', 0, 0, 'C');
        // $pdf->Cell(36, 4, ''.$value['tipo_inscripcion'].'', 0, 0, 'C');
        $pdf->Cell(28, 4, 'L.'.$value['pago_matricula'].'.00', 0, 0, 'C');
        $pdf->Cell(28, 4, 'L.'.$value['pago_descuento'].'.00', 0, 0, 'C');
        $pdf->Cell(28, 4, 'L.'.$value['pago_inscripcion'].'.00', 0, 0, 'C');
        $pdf->Cell(28, 4, 'L.'.$value['pago_total'].'.00', 0, 0, 'C');
        $pdf->Cell(30, 4, ''.$value['fecha_de_pago'].'', 0, 0, 'C');
        
        $i++;
    
    }
}

// Close and output PDF document
$pdf->Output('reporte_inscripciones_clientes_historico.pdf', 'I');

?>