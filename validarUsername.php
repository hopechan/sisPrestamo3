<?php
require_once "Conexion.php";

$username = $_POST['username'];

$conn = new Conexion();
$stmn = "SELECT login FROM usuario WHERE login = '" . $username . "'";
$resultado = $conn->execQueryO($stmn);
$isTheUsernameAlreadyInTheDB = $resultado->fetch_assoc();


if (is_null($isTheUsernameAlreadyInTheDB)) { 
    $existe = "false";
    echo($existe);
} else {
    $existe = "true";
    echo($existe);
}
