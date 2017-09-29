<?php

require_once "Conexion.php";
require_once 'Bitacora.php';
session_start();
$conn = new Conexion();

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$username = $_POST['username'];
$password = $_POST['password'];
$userType = $_POST['userType'];

$stmn2 = "SELECT MAX(ID_usuario) FROM Usuario";
$resultado = $conn->execQueryO($stmn2);
$max_id_usuario = $resultado->fetch_assoc();

$id_usuario = $max_id_usuario['MAX(ID_usuario)'] + 1;

$stmn = "INSERT INTO Usuario(ID_usuario, login, Nombre, Apellidos, clave, rol) VALUES('" . $id_usuario . "', '" . $username . "', '" . $nombres . "', '" . $apellidos . "', MD5('" . $password . "'), '" . $userType . "')";
$conn->execQuery($stmn);

//Objetos bitacora
$b = new Bitacora();
$controladorBitacora = new Bitacora();
//guarda la accion en la bitacora
$accion = "El usuario ".$_SESSION["userName"]." creo al usuario: " . $_POST['username'];
$id_bitacora = $controladorBitacora->maxID($_SESSION["id_usuario"]);
$b->setId_bitacora($id_bitacora);
$b->setId_usuario($_SESSION["id_usuario"]);
$b->setFecha(date('Y-m-d h:i:s'));
$b->setAccion($accion);
$controladorBitacora->agregar($b);
echo '<script type="text/javascript">
alert("Usuario creado exitosamente");
window.location="formNewUser.php";
</script>';
