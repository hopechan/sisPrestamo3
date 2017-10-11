<?php
require_once 'Conexion.php';

class Parametro {
   public $id_parametro;
   public $nombre;
   public $valor;
   //SET
   function setId_parametro ($id_parametro) {
      $this->id_parametro = $id_parametro;
   }

   function setNombre ($nombre) {
      $this->nombre = $nombre;
   }

   function setValor ($valor) {
   	  $this->valor = $valor;
   }

   //GET
   function getId_parametro () {
   	  return $this->id_parametro;
   }

   function getNombre () {
   	  return $this->nombre;
   }

   function getValor () {
   	  return $this->valor;
   }

   //FUNCTIONS
   function obtener () {
   	  $conn = new Conexion();
   	  $stmn = "SELECT * FROM Parametro";
   	  $resultado = $conn->execQueryO($stmn);

   	  $Parametro = array();

   	  while ($parametro = $resultado->fetch_assoc()) {
   	     $par = new Parametro();

   	     $par->setId_parametro($parametro['ID_parametro']);
   	     $par->setNombre($parametro['nombre']);
   	     $par->setValor($parametro['valor']);

   	     array_push($Parametro, $par);
   	  }

   	  return $Parametro;
   }

   function modificar(Parametro $par) {
   		$conn = new Conexion();

   		$id_parametro = $par->getId_parametro();
   		$nombre = $par->getNombre();
   		$valor = $par->getValor();

   		$stmn = "UPDATE parametro SET valor = '" . $valor . "' WHERE ID_parametro = '" . $id_parametro . "'";
   		$conn->execQuery($stmn);
   }
}
