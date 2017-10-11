<?php

require_once "Conexion.php";
require_once 'Bitacora.php';
require_once 'User.php';
session_start();
$conn = new Conexion();

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$username = $_POST['username'];
$password = $_POST['password'];
$userType = $_POST['userType'];

$controladorUsuario = new User();
  $stmn2 = "SELECT MAX(ID_usuario) FROM usuario";
  $resultado = $conn->execQueryO($stmn2);
  $max_id_usuario = $resultado->fetch_assoc();

  $id_usuario = $max_id_usuario['MAX(ID_usuario)'] + 1;

  $stmn = "INSERT INTO usuario(ID_usuario, login, Nombre, Apellidos, clave, rol) VALUES('" . $id_usuario . "', '" . $username . "', '" . $nombres . "', '" . $apellidos . "', MD5('" . $password . "'), '" . $userType . "')";
  $conn->execQuery($stmn);

  //Objetos bitacora
  $b = new Bitacora();
  $controladorBitacora = new Bitacora();
  $fecha = date('Y-m-d');
  $hora = date('h:i:s');
  //guarda la accion en la bitacora
  $accion = "El usuario ".$_SESSION["userName"]." creo al usuario: " . $_POST['username'];
  $id_bitacora = $controladorBitacora->maxID($_SESSION["id_usuario"]);
  $b->setId_bitacora($id_bitacora);
  $b->setId_usuario($_SESSION["id_usuario"]);
  $b->setFecha($fecha . " " . $hora);
  $b->setAccion($accion);
  $controladorBitacora->agregar($b);
  echo '<script type="text/javascript">
  alert("Usuario creado exitosamente");
  window.location="formNewUser.php";
  </script>';
