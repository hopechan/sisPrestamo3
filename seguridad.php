<?php
session_start();
//Revisa si existe una sesion activa sino existe redirige a login.php
//Falta que solo permita el acceso a las configuraciones a los administradores 
if ($_SESSION["estado"] != "activo") {
  header("Location: login.php");
}
 ?>
