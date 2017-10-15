<?php

require_once 'Prestamo.php';
require_once 'Cuota.php';
require_once 'Conexion.php';
require_once 'Bitacora.php';
session_start();

 $conn = new Conexion();
 $stmn =  "SELECT MAX(num_cuota) FROM cuota WHERE ID_prestamo='" . $_POST['id_prestamo'] . "'";
 $resultado = $conn->execQueryO($stmn);
 $max_cuota = $resultado->fetch_assoc();
 $num_cuota = $max_cuota['MAX(num_cuota)'] + 1;
 $usuario = $_SESSION['userName'];
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
                    window.location="webprestamo.php";
                    </script>';
  }
  else {
   $p->agregarCuota($c);
   $p->imprimir($c, $usuario);
   //Objetos bitacora
   $b = new Bitacora();
   $controladorBitacora = new Bitacora();
   //guarda la accion en la bitacora
   $accion = "El usuario ".$_SESSION["userName"]." realizo un pago al prestamo # " . $_POST['id_prestamo'];
   $id_bitacora = $controladorBitacora->maxID($_SESSION["id_usuario"]);
   $b->setId_bitacora($id_bitacora);
   $b->setId_usuario($_SESSION["id_usuario"]);
   $b->setFecha(date('Y-m-d h:i:s'));
   $b->setAccion($accion);
   $controladorBitacora->agregar($b);

   echo '<script type="text/javascript">
                  alert("Pago realizado exitosamente");
                  window.location="webPrestamos.php";
                  </script>';
  }
