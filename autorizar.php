<?php
 require_once 'User.php';
 require_once 'Bitacora.php';
 //Objeto usuario para administrar el acceso
$controlador = new User();
//Objetos bitacora
$b = new Bitacora();
$controladorBitacora = new Bitacora();
//Variables tomadas de login.php
$userName = $_POST['user'];
//MD5 es en solo sentido
$password = md5($_POST['password']);
$coindencia = $controlador->buscarUsuario($userName, $password);
$id_usuario = $coindencia[0]->id_user;
$passwordDB = $coindencia[0]->password;
$nombre = $coindencia[0]->nombres;
$apellidos = $coindencia[0]->apellidos;
$rol = $coindencia[0]->userType;
//se compara si los hash md5 son iguales
if ($password == $passwordDB) {
  //si son iguales guarda la accion en la bitacora y redirige a index.php
  $id_bitacora = $controladorBitacora->maxID($id_usuario);
  $fecha = date('Y-m-d-g-i-s');
  $accion = "El usuario " . $userName . " ingreso al sistema";
  $b->setId_bitacora($id_bitacora);
  $b->setId_usuario($id_usuario);
  $b->setFecha($fecha);
  $b->setAccion($accion);
  $controladorBitacora->agregar($b);

  //Se crea la sesion para este usuario
  session_start();
  $_SESSION["estado"] = "activo";
  $_SESSION["id_usuario"] = $id_usuario;
  $_SESSION["userName"] = $userName;
  $_SESSION["NombreCompleto"] = $nombre . ' ' . $apellidos;
  $_SESSION['rol'] = $rol;
  header('Location: index.php');
} else {
  echo '<script type="text/javascript">
  alert("La contraseña no es la correcta");
  window.location="login.php";
  </script>';
}
 ?>
