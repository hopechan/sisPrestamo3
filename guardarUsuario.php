<?php
require_once 'Conexion.php';
require_once 'Usuario.php';
require_once 'ControladorUsuario.php';

$conn = new Conexion();
$u = new Usuario();
$cUsuario = new Usuario();

//recupera el maximo valor del id_usuario y le suma 1
$stmn = "SELECT MAX(ID_usuario) FROM Usuario";
$resultado = $conn->execQueryO($stmn);
$max_id_usuario = $resultado->fetch_assoc();

$id_usuario = $max_id_usuario['MAX(ID_usuario)'] + 1;
//Datos del formulario
$login = $_POST['login'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$clave = $_POST['clave'];
$rol = $_POST['rol'];

//almacena los datos en un objeto Usuario
$u->setId_usuario($id_usuario);
$u->setLogin($login);
$u->setNombres($nombres);
$u->setApellidos($apellidos);
$u->setClave($clave);
$u->setRol($rol);

$cUsuario->agregar($u);

//Alerta que se guardo :v
echo '<script type="text/javascript">
alert("Usuario creado exitosamente");
window.location="formUsuario.php";
</script>';
?>
