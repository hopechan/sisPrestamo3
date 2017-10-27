<?php
require_once 'Parametro.php';
require_once 'Bitacora.php';
session_start();
$nombre_empresa = $_POST['nombre_empresa'];
$correo = $_POST['email'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$tasa_interes = $_POST['tasa_interes'];
$interes_mora = $_POST['interes_mora'];
$capitalizacion = $_POST['capitalizacion'];

$Parametro = array();

$par0 = new Parametro();
$par0->setId_parametro(1);
$par0->setNombre('Nombre de la empresa');
$par0->setValor($nombre_empresa);
array_push($Parametro, $par0);

$par1 = new Parametro();
$par1->setId_parametro(2);
$par1->setNombre('Correo');
$par1->setValor($correo);
array_push($Parametro, $par1);

$par2 = new Parametro();
$par2->setId_parametro(3);
$par2->setNombre('Teléfono');
$par2->setValor($telefono);
array_push($Parametro, $par2);

$par3 = new Parametro();
$par3->setId_parametro(4);
$par3->setNombre('Interés');
$par3->setValor($tasa_interes);
array_push($Parametro, $par3);

$par4 = new Parametro();
$par4->setId_parametro(5);
$par4->setNombre('Mora');
$par4->setValor($interes_mora);
array_push($Parametro, $par4);

$par5 = new Parametro();
$par5->setId_parametro(6);
$par5->setNombre('Capitalización');
$par5->setValor($capitalizacion);
array_push($Parametro, $par5);

$par6 = new Parametro();
$par6->setId_parametro(7);
$par6->setNombre('Dirección');
$par6->setValor($direccion);
array_push($Parametro, $par6);

for ($i = 0; $i<7; $i++) {
	$par0->modificar($Parametro[$i]);
}
//Objetos bitacora
$b = new Bitacora();
$controladorBitacora = new Bitacora();
//guarda la accion en la bitacora
$accion = "El usuario ".$_SESSION["userName"]. " modifico los parametros del sistema";
$id_bitacora = $controladorBitacora->maxID($_SESSION["id_usuario"]);
$b->setId_bitacora($id_bitacora);
$b->setId_usuario($_SESSION["id_usuario"]);
$b->setFecha(date('Y-m-d h:i:s'));
$b->setAccion($accion);
$controladorBitacora->agregar($b);

echo '<script type="text/javascript">
								alert("Cambios realizados exitosamente");
								window.location="webParametros.php";
								</script>';
