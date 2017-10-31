<?php
require_once 'Bitacora.php';
  //Recupero la sesion actual
  session_start();
  //Objetos bitacora
  $controladorBitacora = new Bitacora();
  $id_usuario = $_SESSION["id_usuario"];
  $fecha = date('Y-m-d');
  $hora = date('h:i:s');
  $usuario = $_SESSION["userName"];
  $accion = "El usuario ".$usuario." cerro sesion ";
  $id_bitacora = $controladorBitacora->maxID($id_usuario);
    $b = new Bitacora();
    $b->setId_bitacora($id_bitacora);
    $b->setId_usuario($id_usuario);
    $b->setFecha($fecha . " " . $hora);
    $b->setAccion($accion);
    $controladorBitacora->agregar($b);
    session_destroy();
    header("Location: login.php");
 ?>
