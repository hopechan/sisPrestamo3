<?php
require 'fpdf.php';
require_once 'Prestamo.php';
require_once 'ControladorPrestamo.php';
require_once 'Cliente.php';
require_once 'Conexion.php';
class reporte extends FPDF{
  function Header(){
    // Arial negrita 15
    $this->SetFont('Arial','B',15);
    //Se mueve a la derecha
    $this->Cell(80);
    //Titulo
   $this->Cell(30,10,'Contrato de Prestamo',1,0,'C');
   // Salto de linea
   $this->Ln(20);
  }
}

$id_prestamo = $_GET['id_prestamo'];
$dui = $_GET['dui'];
$nombres = $_GET['nombres'];
$apellidos = $_GET['apellidos'];
$monto = $_GET['monto'];
$tasa = $_GET['tasa'];


$pdf = new reporte('P', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,'Yo '.$nombres.' '.$apellidos.' con DUI numero '.$dui,0,1);
$pdf->Cell(0,10,'He realizado un prestamo de $'.$monto,0,1);
$pdf->Cell(0,10,'Con una tasa de interes del '.$tasa.'%',0,1);
$pdf->Output();

?>
