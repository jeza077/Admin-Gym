<?php
// require_once "../../controladores/usuarios.controlador.php";
require_once('../../../controladores/usuarios.controlador.php');
require_once "../../../modelos/usuarios.modelo.php";
require_once('tcpdf_include.php');


class PDF extends TCPDF{
    
    // Header de la pagina
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $this->Image($image_file, 40, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
        // Fuente
        $this->Ln(5);
        $this->SetFont('helvetica', 'B', 16);
        
        // Title
        // $this->Cell(189, 5, 'GIMNASIO LA "ROCA"', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(189, 5, 'GIMNASIO LA "ROCA"', 0, 1, 'C');
        $this->SetFont('helvetica', '', 9);
        // $this->Cell(189, 3, 'Gimnasio La roca', 0, 1, 'C');
        $this->Cell(189, 3, 'Col. xxxxxxxxxx....', 0, 1, 'C');
        $this->Cell(189, 3, 'Calle xxxxxxxxxx.....', 0, 1, 'C');
        $this->Cell(189, 3, 'correo: gym@gmail.com', 0, 1, 'C');

        $this->Ln(15); //Espacios
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(189, 3, 'REPORTE DE USUARIOS', 0, 1, 'C');
        $this->Ln(3);
        $this->SetFont('helvetica', 'B', 11);
        $this->Cell(189, 3, 'Año 2020', 0, 1, 'C');
    }

    // Footer de la pagina
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}


// Crear un nuevo documento PDF
// $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jesus Zuniga');
$pdf->SetTitle('Reporte de Usuarios');
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

$pdf->Ln(40);

$pdf->SetFont('times', '', 13);
$pdf->SetFillColor(225, 235, 255);
$pdf->Cell(15, 5, 'No', 1, 0, 'C', 1);
$pdf->Cell(55, 5, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(40, 5, 'Usuario', 1, 0, 'C', 1);
$pdf->Cell(40, 5, 'Rol', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'Estado', 1, 0, 'C', 1);

$tabla = "tbl_usuarios";
$item = null;
$valor = null;
$usuarios = ControladorUsuarios::ctrMostrarSoloUsuarios($tabla, $item, $valor);

// var_dump($usuarios);


foreach ($usuarios as $key => $value) {

    if($key == 2){
        $pdf->AddPage();

        $pdf->Ln(40);
        
        $pdf->SetFont('times', '', 13);
        $pdf->SetFillColor(225, 235, 255);
        $pdf->Cell(15, 5, 'No', 1, 0, 'C', 1);
        $pdf->Cell(55, 5, 'Nombre', 1, 0, 'C', 1);
        $pdf->Cell(40, 5, 'Usuario', 1, 0, 'C', 1);
        $pdf->Cell(40, 5, 'Rol', 1, 0, 'C', 1);
        $pdf->Cell(30, 5, 'Estado', 1, 0, 'C', 1);
    }

    $pdf->Ln(8);
    $pdf->SetFont('times', '', 12);
    // $pdf->SetFillColor(225, 235, 255);
    $pdf->Cell(15, 4, ''.($key+1).'', 0, 0, 'C');
    $pdf->Cell(55, 4, ''.$value['nombre'].' '.$value['apellidos'].'', 0, 0, 'C');
    $pdf->Cell(40, 4, ''.$value['usuario'].'', 0, 0, 'C');
    $pdf->Cell(40, 4, ''.$value['rol'].'', 0, 0, 'C');
    if($value["estado"] == 0){
        $pdf->Cell(30, 4, 'Desactivado', 0, 0, 'C');
    } else {
        $pdf->Cell(30, 4, 'Activado', 0, 0, 'C');
    }


}

// Close and output PDF document
$pdf->Output('example_001.pdf', 'I');

?>