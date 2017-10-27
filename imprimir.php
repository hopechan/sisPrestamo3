o<?php
require __DIR__ . '/vendor/autoload.php';
require_once 'Parametro.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
  session_start();
  $connector = new CupsPrintConnector("impresora_DSI2");
  $printer = new Printer($connector);
  //Variables
  $fecha = date('d-m-Y');
  $hora = date('h:i:s');
  $valor_cuota = $_POST['cuota'];
  $nuevo_saldo = $_POST['saldoNuevo'];
  $mora = $_POST['mora'];
  $total = $valor_cuota + $mora;
  $par = new Parametro();

  $Parametro = $par->obtener();
    $nombre_empresa =  $Parametro[0]->valor;
    $direccion = $Parametro[6]->valor;
    $telefono = $Parametro[2]->valor;
    $usuario = $_SESSION["NombreCompleto"];
  //Impresion
  $printer->setEmphasis(true);
  $printer->text($nombre_empresa . "\n");
  $printer->text($direccion . "\n");
  $printer->text("Telefono: " . $telefono . "\n");
  $printer->text("Cajero: " . $usuario . "\n");
  $printer->setEmphasis(false);
  $printer->feed();
  $printer->text("Pago efectuado el: ".$fecha . "\n");
  $printer->text("a las: " .$hora ."\n");
  $printer->text("----------------------------\n");
  $printer->setEmphasis(true);
  $printer->text("Pago:          $". $valor_cuota . "\n");
  $printer->text("Mora:          $" .$mora . "\n");
  $printer->text("----------------------------\n");
  $printer->text("Total a pagar: $" .$total . "\n");
  $printer->text("----------------------------\n");
  $printer->text("Nuevo Saldo:   $". $nuevo_saldo . "\n");
  $printer->feed(4);
  $printer->cut();
  $printer->close();
 ?>
