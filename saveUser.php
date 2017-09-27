<?php

require_once "Conexion.php";

$conn = new Conexion();

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$username = $_POST['username'];
$password = $_POST['password'];
$userType = $_POST['userType'];

$stmn2 = "SELECT MAX(ID_usuario) FROM usuario";
$resultado = $conn->execQueryO($stmn2);
$max_id_usuario = $resultado->fetch_assoc();

$id_usuario = $max_id_usuario['MAX(ID_usuario)'] + 1;

$stmn = "INSERT INTO usuario(ID_usuario, login, Nombre, Apellidos, clave, rol) VALUES('" . $id_usuario . "', '" . $username . "', '" . $nombres . "', '" . $apellidos . "', MD5('" . $password . "'), '" . $userType . "')";
$conn->execQuery($stmn);

echo '<script type="text/javascript">
alert("Usuario creado exitosamente");
window.location="users.php";
</script>';