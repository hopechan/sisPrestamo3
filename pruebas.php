<?php
require_once 'Conexion.php';
require_once 'User.php';
$c = new Conexion();
$stmn = "SELECT * FROM Usuario WHERE login = 'hope'";
$resultado = $c->execQueryO($stmn);
//Capturo el numero de filas de la consulta
$num = $resultado->num_rows;
//Se supone que el campo login es unico asi que las dos opciones posibles son 0 y 1 :v
if ($num == 1) {
  //Si existe coindencia lo guarda
  $coindencia = array();
  while ($user = $resultado->fetch_assoc()) {
    $us = new User();
    $us->setId_user($user['ID_usuario']);
    $us->setUsername($user['login']);
    $us->setNombres($user['Nombre']);
    $us->setApellidos($user['Apellidos']);
    $us->setPassword($user['clave']);
    $us->setUserType($user['rol']);
    array_push($coindencia, $us);
  }
  var_dump($coindencia);
} else {
  return False;
}
 ?>
