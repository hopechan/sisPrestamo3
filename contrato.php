<?php
require 'fpdf.php';
require 'Conexion.php';

////
require 'ControladorContrato.php';
////

$conn = new Conexion();

////
$cContrato = new ControladorContrato();
////

$dui = $_GET['dui'];
$idPrestamo = $_GET['id_prestamo'];

$plantillaContrato = '';

//Aquí están definidas las etiquetas (<nombreEtiqueta>) que se pueden usar en la plantilla del contrato
$etiquetasCliente = array('DUI', 'NIT', 'Nombre', 'Apellidos', 'fecha_nacimiento', 'Sexo', 'direccion', 'telefonos', 'profesion');
$etiquetasPrestamo = array('Monto', 'valor_cuota', 'tasa_interes', 'tasa_mora', 'cantidad_cuotas', 'fecha_inicio', 'fecha_fin', 'capitalizacion');

//abre el archivo de plantilla(plantillaContrato) en modo lectura(r)
$file = fopen('plantillaContrato.txt','r');

//añade cada línea del documento plantillaContrato a un string $plantillaContrato
while($line = fgets($file)) {
  $plantillaContrato .= $line;
}

$plantillaContrato = utf8_decode($plantillaContrato);
$contrato = '';

//Añade el texto anterior a la primera etiqueta de la plantillaContrato.
$contrato .= substr($plantillaContrato, 0, strpos($plantillaContrato,'<'));

//$flag le indica al while si todavía hay más etiquetas por procesar
$flag = true;

//$offset establece el final de la última etiqueta encontrada para comenzar
//a buscar a partir de ahí y no procesar infinitamente la primera etiqueta
$offset = 0;

$etiqueta = '';

while($flag) {
  if (strpos($plantillaContrato, '<', $offset) === false) {
    $flag = false;
  } else {
    $principioEtiqueta = strpos($plantillaContrato, '<', $offset);
    $finEtiqueta = strpos($plantillaContrato, '>', $principioEtiqueta);
    $offset = $finEtiqueta;
    $lengthEtiqueta = $finEtiqueta - $principioEtiqueta - 1;
    $etiqueta = substr($plantillaContrato, $principioEtiqueta + 1, $lengthEtiqueta);

    //Decide si la consulta a la DB se hace en la tabla Cliente o en la tabla Prestamo
    if (in_array($etiqueta, $etiquetasCliente)) {
      $tabla = 'cliente';
      $primaryKey = 'DUI';
      $valorPrimaryKey = $dui; 
    } else if (in_array($etiqueta, $etiquetasPrestamo)) {
      $tabla = 'prestamo';
      $primaryKey = 'ID_prestamo';
      $valorPrimaryKey = $idPrestamo;
    }

    $stmn = 'SELECT ' . $etiqueta . " FROM " . $tabla . " WHERE " . $primaryKey . " = '" . $valorPrimaryKey . "'";
    $resultado = $conn->execQueryO($stmn);
    $etiquetaDB = $resultado->fetch_assoc();
    $etiquetaContrato = utf8_decode($etiquetaDB[$etiqueta]);

    ////
    $tempEtiquetaContrato = $etiquetaContrato;

    switch ($etiqueta) {
        case 'DUI':
        case 'NIT':
            $etiquetaContrato = utf8_decode($cContrato->numerosDocALetras($tempEtiquetaContrato));
            break;
        case 'Monto':
        case 'valor_cuota':
            $etiquetaContrato = utf8_decode($cContrato->cantidadDineroALetras($tempEtiquetaContrato));
            break;
        case 'tasa_interes':
        case 'tasa_mora':
            $etiquetaContrato = utf8_decode($cContrato->numeros1Al99EnLetrasCuotasFechas(str_pad($tempEtiquetaContrato, 2, 0, STR_PAD_LEFT), '', '', ''));
            break;
        case 'cantidad_cuotas':
            $etiquetaContrato = utf8_decode($cContrato->numeros1Al999EnLetrasCuotasFechas(str_pad($tempEtiquetaContrato, 3, 0, STR_PAD_LEFT), '', '', ''));
            break;
        case 'Sexo':
            if ($etiquetaContrato == 'F') {
                $etiquetaContrato = 'Femenino';
            } else {
                $etiquetaContrato = 'Masculino';
            }
            break;
        case 'capitalizacion':
            if ($etiquetaContrato == 'M') {
                $etiquetaContrato = 'Mensual';
            } else {
                $etiquetaContrato = 'Diaria';
            }
            break;
        case 'fecha_inicio':
            $etiquetaContrato = utf8_decode($cContrato->fechaALetras($etiquetaContrato));
    }
    ////

    $contrato .= strtoupper($etiquetaContrato);
    $contrato .= substr($plantillaContrato, $finEtiqueta + 1, strpos($plantillaContrato, '<', $finEtiqueta) - $finEtiqueta - 1);
  }
}

//Añade el texto restante luego de procesar todas las etiquetas de la plantillaContrato.
$contrato .= substr($plantillaContrato, strpos($plantillaContrato, '>', $principioEtiqueta) + 1);

$pdf = new FPDF();
$pdf->SetMargins(20, 20, 20);
$pdf->addPage();
$pdf->SetFont('Times', '', 12);
$pdf->MultiCell(0, 10, $contrato, 'J');


$pdf->Output();