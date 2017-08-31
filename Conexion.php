<?php
Class Conexion {
    private $host = 'localhost';
    private $database = 'prestamosv2';
    private $username = 'root';
    private $password = '123456';

    function execQuery($stmn) {
    	$mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);
        $mysqli->query($stmn);
    }

    function execQueryO($stmn) {
    	$mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);
        return $mysqli->query($stmn);
    }
}
