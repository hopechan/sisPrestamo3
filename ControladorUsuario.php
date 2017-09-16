<?php
require_once 'Conexion.php';
require_once 'Usuario.php';

class ControladorUsuario{
  function obtenerTodos() {
      $conn = new Conexion();
      $stmn = "SELECT ID_usuario, login, Nombre, Apellidos, clave, rol FROM Usuario";
      $resultado = $conn->execQueryO($stmn);
      $Users = array();
      while($user = $resultado->fetch_assoc()) {
          $u = new User();
          $u->setId_usuario($user['ID_usuario']);
          $u->setLogin($user['login']);
          $u->setNombres($user['nombres']);
          $u->setApellidos($user['apellidos']);
          $u->setClave($user['clave']);
          $u->setRol($user['rol']);
          array_push($Users, $u);
      }
      $conn = null;
      return $Users;
  }

  function agregar(Usuario $u){
    try {
      $conn = new Conexion();
      //recupera el objeto usuario
      $id_usuario = $u->getId_usuario();
      $login = $u->getLogin();
      $nombres = $u->getNombres();
      $apellidos = $u->getApellidos();
      $clave = $u->getClave();
      $rol = $u->getRol();
      //Sentencia SQL, se utiliza MD5 para la contraseña
      $stmn = "INSERT INTO Usuario(id_usuario,login,nombres, apellidos, clave, rol) VALUES('". $id_usuario ."', '" . $login . "', '" . $nombres ."', '" . $apellidos ."', MD5('". $clave ."'), '" .$rol. "')";
      $conn->execQuery($stmn);
      //Si todo sale bien usuario guardado :v
    } catch (ErrorPrestamo $e) {
      echo $e->nuevo();
    }
  }
}
 ?>
