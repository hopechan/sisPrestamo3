<?php
session_start();
//Revisa si existe una sesion activa sino existe redirige a login.php
if ($_SESSION["estado"] != "activo") {
  header("Location: login.php");
}
 ?>
