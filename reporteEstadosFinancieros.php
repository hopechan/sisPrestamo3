<?php
require 'fpdf.php';
class reporteEstados extends FPDF{
  function Header(){
    // Arial negrita 15
    $this->SetFont('Arial','B',15);
    //Se mueve a la derecha
    $this->Cell(80);
    //Titulo
   $this->Cell(30,10,'Estados Financieros',1,0,'C');
   // Salto de linea
   $this->Ln(20);
  }
}



$pdf = new reporteEstados('P', 'mm', 'Letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,'Balance General',0,1);
$pdf->Cell(0,10,'Estado de Resultados',0,1);
$pdf->Cell(0,10,'Estado de cambios en el patrimonio',0,1);
$pdf->Output();

?>
