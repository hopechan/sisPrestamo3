<?php
require_once 'Conexion.php';
Class User {
    public $id_user;
    public $username;
    public $nombres;
    public $apellidos;
    public $password;
    public $userType;

    //GETTERS
    function getId_user() {
        return $this->id_user;
    }

    function getUsername() {
        return $this->username;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getPassword() {
        return $this->password;
    }

    function getUserType() {
        return $this->userType;
    }

    //SETTERS
    function setId_user($id_user) {
        $this->id_user = $id_user;
    }
    function setUsername($username) {
        $this->username = $username;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setUserType($userType) {
        $this->userType = $userType;
    }

    function obtenerTodos() {
        $conn = new Conexion();
        //Adaptarla de acuerdo a la base de datos
        $stmn = "SELECT ID_usuario, login, Nombre, Apellidos, rol FROM Usuario";
        $resultado = $conn->execQueryO($stmn);
        $Users = array();
        while($user = $resultado->fetch_assoc()) {
            $u = new User();
            $u->setId_user($user['ID_usuario']);
            $u->setUsername($user['login']);
            $u->setNombres($user['Nombre']);
            $u->setApellidos($user['Apellidos']);
            $u->setUserType($user['rol']);
            array_push($Users, $u);
        }
        $conn = null;

        return $Users;
    }

    function buscarUsuario($userName, $password){
      $c = new Conexion();
      $stmn = "SELECT * FROM Usuario WHERE login = '" . $userName . "'";
      $resultado = $c->execQueryO($stmn);
      //Capturo el numero de filas de la consulta
      $num = $resultado->num_rows;
      //Se supone que el campo login es unico asi que las dos opciones posibles son 0 y 1 :v
      if ($num == 1) {
        //Si existe coindencia lo guarda en un array
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
        return $coindencia;
      } else {
        echo '<script type="text/javascript">
        alert("El usuario no existe");
        window.location="login.php";
        </script>';
      }
    }

}
