<?php
Class Conexion {
    private $host = 'localhost';
    private $database = 'prestamosv3';
    private $username = 'root';
    private $password = '';

    function execQuery($stmn) {
    	$mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);
        return $mysqli->query($stmn);
    }

    function execQueryO($stmn) {
    	$mysqli = new mysqli($this->host, $this->username, $this->password, $this->database);
        return $mysqli->query($stmn);
    }
}
