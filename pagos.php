<?php

require_once 'Prestamo.php';
require_once 'Cuota.php';
require_once 'Conexion.php';

 $conn = new Conexion();
 $stmn =  "SELECT MAX(num_cuota) FROM Cuota WHERE ID_prestamo='" . $_POST['id_prestamo'] . "'";
 $resultado = $conn->execQueryO($stmn);
 $max_cuota = $resultado->fetch_assoc();
 $num_cuota = $max_cuota['MAX(num_cuota)'] + 1;

$c = new Cuota();
  $c->setId_prestamo($_POST['id_prestamo']);
  $c->setNum_cuota($num_cuota);
  $c->setValor($_POST['cuota']);
  $c->setInteres($_POST['interes']);
  $c->setCapital($_POST['capital']);
  $c->setFecha($_POST['fecha']);
  $c->setSaldo_anterior($_POST['saldo_anterior']);
  $c->setSaldo_actualizado($_POST['saldoNuevo']);
  $c->setMora($_POST['mora']);
  $p = new Prestamo();

  if ($_POST['cuota'] < ($_POST['interes'] + $_POST['mora'])) {
    echo '<script type="text/javascript">
                    alert("Cuota no valida");
                    window.location="http://localhost/sisPrestamov3/webprestamo.php";
                    </script>';
  }
  else {
   $p->agregarCuota($c);
   echo '<script type="text/javascript">
                  alert("Pago realizado exitosamente");
                  window.location="http://localhost/sisPrestamov3/webprestamo.php";
                  </script>';
  }
  //header("Location: index.php");
