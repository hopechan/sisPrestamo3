<?php
require_once "ControladorCliente.php";
require_once "Cliente.php";

$c = new Cliente();
$cCliente = new ControladorCliente();

$c->setDui($_GET['dui']);
$c->setNit($_GET['nit']);
$c->setNombres($_GET['nombres']);
$c->setApellidos($_GET['apellidos']);
$c->setSexo($_GET['sexo']);
$c->setDireccion($_GET['direccion']);
$c->setTelefono($_GET['telefono']);
$c->setFecha_nacimiento($_GET['fecha_nacimiento']);
$c->setObservaciones($_GET['observaciones']);
$c->setProfesion($_GET['profesion']);

$cCliente->eliminar($c);
