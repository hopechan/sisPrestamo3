<?php
require __DIR__ . '/vendor/autoload.php';
require_once 'Parametro.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
  session_start();
  $connector = new CupsPrintConnector("impresora_DSI2");
  $printer = new Printer($connector);
  //Impresion
  $printer->text("----------------------------\n");
  $printer->setEmphasis(true);
  $printer->text("LIQUIDEZ\n");
  $printer->setEmphasis(false);
  $printer->text("LC= AC/PC\n");
  $printer->text("PrAcida = (AC - inv)/PC\n");
  $printer->text("----------------------------\n");
  $printer->setEmphasis(true);
  $printer->text("ACTIVIDAD\n");
  $printer->setEmphasis(false);
  $printer->text("RoInv = CBV/inv\n");
  $printer->text("PerPromCobro = CxC/(ventaAnual/360)\n");
  $printer->text("PerPromPago = CxP/(CompraAnual/360)\n");
  $printer->text("RoActivo = Ventas/Total Activo\n");
  $printer->text("----------------------------\n");
  $printer->setEmphasis(true);
  $printer->text("ENDEUDAMIENTO\n");
  $printer->setEmphasis(false);
  $printer->text("IEndeundamiento = TPasivo/TActivo\n");
  $printer->text("InteresFijo = UAI / Intereses\n");
  $printer->text("ICoberPagosFijos = UAI+arr/Int+arr\n");
  $printer->text("----------------------------\n");

  $printer->feed(4);
  $printer->cut();
  $printer->text("----------------------------\n");
  $printer->setEmphasis(true);
  $printer->text("RENTABILIDAD\n");
  $printer->setEmphasis(false);
  $printer->text("MUBruta = Ventas-CBV/Ventas\n");
  $printer->text("MUOpe = UtilOperativa/Ventas\n");
  $printer->text("MUNeta = GananciaAccionista/Ventas\n");
  $printer->text("GPA = GananAccion/#AccionesCirculando\n");
  $printer->text("RSA = GananAccion/TotalActivo\n");
  $printer->text("RSP = GananAccion/CapitalAcciones\n");
  $printer->setEmphasis(true);
  $printer->text("MERCADO\n");
  $printer->setEmphasis(false);
  $printer->text("P/G = PxA/GxA\n");
  $printer->text("M/L = CapitalAcciones/#AccionesCirculando\n");
  $printer->feed(4);
  $printer->cut();
  $printer->close();

 ?>
