<?php
require_once 'Conexion.php';

$conn = new Conexion();

$dui = $_GET['dui'];
$correlativo = $_GET['correlativo'];

$stmn = "SELECT archivo FROM documentos WHERE dui = '" . $dui . "' AND correlativo = '" . $correlativo . "'";
$resultado = $conn->execQueryO($stmn);
$archivo = $resultado->fetch_assoc();

echo $archivo['archivo'];