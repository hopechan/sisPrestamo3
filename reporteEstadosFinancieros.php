<?php
require ('fpdf.php');
require ('Conexion.php');

  //  $fecha = date_default_timezone_get();
    $con = new Conexion();

    /*Stmn1 es la consulta para extraer la suma de todos los montos prestados,
    asi como de lo que aun falta por cobrar (libre de interes)

      stmn2 es para extraer los intereses ganados y la mora tambien*/
    $stmn1 = "SELECT ROUND(SUM(Monto)) AS Prestamos, ROUND(SUM(Saldo)) AS 'Cuentas por cobrar' FROM prestamo WHERE Estado='A';";
    $stmn2 = "SELECT ROUND(SUM(interes),2) AS Intereses, ROUND(SUM(mora),2) AS 'Otros ingresos' FROM cuota;";


  $resultado = $con->execQueryO($stmn1);
  $resultado2 = $con->execQueryO($stmn2);



    while($fila = $resultado->fetch_assoc())
    {
        $inversionPrestamos = $fila['Prestamos'];
        $cuentasPorCobrar = $fila['Cuentas por cobrar'];
    }

    while ($fila2 = $resultado2->fetch_assoc())
    {
        $interes = $fila2['Intereses'];
        $mora = $fila2['Otros ingresos'];
    }


class reporteEstados extends FPDF
{
  function Header()
  {
    $stmn3 = "SELECT valor FROM parametro WHERE ID_parametro = 1;";
    $stmn4 = "SELECT curdate() AS Fecha;";
    $con2 = new Conexion();
    $resultado3 = $con2->execQueryO($stmn3);
    $resultado4 = $con2->execQueryO($stmn4);

    $fila3 = $resultado3->fetch_assoc();
    $empresa= $fila3['valor'];

    $fila4 = $resultado4->fetch_assoc();
    $fecha = $fila4['Fecha'];


    $this->SetFillColor(204,255,255);
    // Arial negrita 15
    $this->SetFont('Arial','B',15);
    //Titulo
   $this->Cell(0,10,utf8_decode('Préstamos ').$empresa.' a la fecha '.$fecha, 0,0,'C',1);
   // Salto de linea
   $this->Ln(15);
  }

  function Footer()
  {
    $this->SetFillColor(204,255,255);
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C',1);
}
}


$pdf = new reporteEstados();

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->setFont('Arial', 'I', 13);
$pdf->SetFillColor(204,255,204);
$pdf->Cell(0,10,utf8_decode('Activo                                                                                                                   $').$inversionPrestamos,0,1,'L',1);
$pdf->Cell(0,10,utf8_decode('Activo corriente                                                            $').$inversionPrestamos,0,1,'L',1);

$pdf->SetFillColor(192,192,192);
$pdf->SetFont('Times','',11);
//$pdf->Cell(0,10,'Hoy: '.date('Y-m-d'),0,0,'C',1);
//$pdf->Cell(0,10,utf8_decode('Capital invertido                               $').$inversionPrestamos,0,1,'L',1);
$pdf->Cell(0,10,utf8_decode('Cuentas por cobrar                            $').$cuentasPorCobrar,0,1,'L',1);
$pdf->Cell(0,10,utf8_decode('Caja                                                   $0'),0,1,'L',1);
$pdf->Cell(0,10,utf8_decode('Bancos                                               $').($inversionPrestamos - $cuentasPorCobrar),0,1,'L',1);
$pdf->Cell(0,10,utf8_decode('Otros activos corrientes                     $0'),0,1,'L',1);

$pdf->setFont('Arial', 'I', 13);
$pdf->SetFillColor(204,255,204);
$pdf->Cell(0,10,utf8_decode('Activo no corriente                                                        $0'),0,1,'L',1);

$pdf->SetFillColor(192,192,192);
$pdf->SetFont('Times','',11);
$pdf->Cell(0,10,utf8_decode('Edificio                                              $0'),0,1,'L',1);
$pdf->Cell(0,10,utf8_decode('Mobiliario y Equipo                          $0'),0,1,'L',1);
$pdf->Cell(0,10,utf8_decode('Vehículo                                            $0'),0,1,'L',1);
$pdf->Cell(0,10,utf8_decode('Otros activos                                      $0'),0,1,'L',1);

$pdf->setFont('Arial', 'I', 13);
$pdf->SetFillColor(204,255,204);
$pdf->Cell(0,10,utf8_decode('Pasivo                                                                                                                   $0'),0,1,'L',1);
$pdf->Cell(0,10,utf8_decode('Pasivo corriente                                                            $0'),0,1,'L',1);

$pdf->SetFillColor(192,192,192);
$pdf->SetFont('Times','',11);
$pdf->Cell(0,10,utf8_decode('Cuentas por pagar a corto plazo         $0'),0,1,'L',1);
$pdf->Cell(0,10,utf8_decode('Acreedores                                          $0'),0,1,'L',1);

$pdf->setFont('Arial', 'I', 13);
$pdf->SetFillColor(204,255,204);
$pdf->Cell(0,10,utf8_decode('Pasivo no corriente                                                       $0'),0,1,'L',1);
$pdf->SetFillColor(192,192,192);
$pdf->SetFont('Times','',11);
$pdf->Cell(0,10,utf8_decode('Cuentas por pagar a largo plazo          $0'),0,1,'L',1);

$pdf->setFont('Arial', 'I', 13);
$pdf->SetFillColor(204,255,204);
$pdf->Cell(0,10,utf8_decode('Capital                                                                                                                   $').$inversionPrestamos,0,1,'L',1);
$pdf->Ln(15);

$pdf->setFont('Arial', 'I', 13);
$pdf->SetFillColor(204,255,204);
$pdf->Cell(0,10,utf8_decode('Ganancia                                                                                                               $').($interes + $mora),0,1,'L',1);

$pdf->SetFillColor(192,192,192);
$pdf->SetFont('Times','',11);
$pdf->Cell(0,10,utf8_decode('Interés                                                   $').$interes,0,1,'L',1);
$pdf->Cell(0,10,utf8_decode('Mora                                                     $').$mora,0,1,'L',1);



$pdf->Output();

?>
