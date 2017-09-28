<?php
 require_once 'User.php';
$controlador = new User();
$userName = $_POST['user'];
$password = md5($_POST['password']);
$coindencia = $controlador->buscarUsuario($userName, $password);
$passwordDB = $coindencia[0]->password;

if ($password == $passwordDB) {
  header('Location: index.php');
} else {
  echo '<script type="text/javascript">
  alert("El usuarion no existe o la contraseña no es la correcta");
  window.location="login.php";
  </script>';
}


 ?>
