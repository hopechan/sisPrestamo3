<?php
require_once 'Bitacora.php';
session_start();
session_destroy();
//Objetos bitacora
$b = new Bitacora();
$controladorBitacora = new Bitacora();
$fecha = date('Y-m-d');
$hora = date('h:i:s');
$accion = "El usuario ".$_SESSION["userName"]." cerro sesion ";
$id_bitacora = $controladorBitacora->maxID($_SESSION["id_usuario"]);
$b->setId_bitacora($id_bitacora);
$b->setId_usuario($_SESSION["id_usuario"]);
$b->setFecha($fecha . " " . $hora);
$b->setAccion($accion);
$controladorBitacora->agregar($b);
header("Location: login.php");
 ?>
