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
        $stmn = "SELECT ID_usuario, login, Nombre, Apellidos, rol FROM usuario";
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

    function  createNewUser () {

    }    
}