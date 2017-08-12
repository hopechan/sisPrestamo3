<?php
require_once 'Conexion.php';
require_once 'Documento.php';

$conn = new Conexion();

$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$observaciones = $_POST['observaciones'];

$stmn = "UPDATE cliente SET telefonos = '" . $telefono . "', direccion = '" . $direccion . "',observaciones = '" . $observaciones . "' WHERE dui = '" . $_POST['dui'] . "'";
$conn->execQuery($stmn);

$tmp_name = $_FILES['imagen']['tmp_name'];
$tipo_archivo = $_FILES['imagen']['type'];

$contained_binary = addslashes(fread(fopen($tmp_name,"rb"), $_FILES['imagen']['size']));
$binary_name = $_FILES['imagen']['name'];
$stmn2 = "SELECT MAX(correlativo) FROM documentos WHERE dui='" . $_POST['dui'] . "'";
$resultado = $conn->execQueryO($stmn2);
$max_correlativo = $resultado->fetch_assoc();
$correlativo = $max_correlativo['MAX(correlativo)'] + 1;

$d = new Documento();
if(strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "png") || strpos($tipo_archivo, "pdf")) {

                $d->setDui($_POST['dui']);
                $d->setCorrelativo($correlativo);
                $d->setNombre($binary_name);
                $d->setArchivo($contained_binary);
                $d->setDescripcion($_POST['descripcionImagen']);
            }

$dui= $d->getDui();
$correlativo = $d->getCorrelativo();
$nombre = $d->getNombre();
$archivo = $d->getArchivo();
$descripcion = $d->getDescripcion();
if (!(empty($nombre))) {
	$stmn2  = "INSERT INTO documentos(dui, correlativo, nombre_archivo, archivo, descripcion) values('" . $dui . "', '" . $correlativo . "','" . $nombre . "', '" . $archivo . "','" . $descripcion . "')";
$conn->execQuery($stmn2);
}
header('Location: webcliente.php');
