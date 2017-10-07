<?php
require_once 'Conexion.php';
Class Bitacora{

public $id_bitacora;
public $id_usuario;
public $fecha;
public $accion;

//GETTERS
  function getId_bitacora(){
    return $this->id_bitacora;
  }

  function getId_usuario(){
    return $this->id_usuario;
  }

  function getFecha(){
    return $this->fecha;
  }

  function getAccion(){
    return $this->accion;
  }

  //SETTERS
  function setId_bitacora($id_bitacora){
    $this->id_bitacora = $id_bitacora;
  }

  function setId_usuario($id_usuario){
    $this->id_usuario = $id_usuario;
  }

  function setFecha($fecha){
    $this->fecha = $fecha;
  }

  function setAccion($accion){
    $this->accion = $accion;
  }

  function agregar(Bitacora $b){
    $c = new Conexion();
    $id_bitacora = $b->getId_bitacora();
    $id_usuario = $b->getId_usuario();
    $fecha = $b->getFecha();
    $accion = $b->getAccion();
    $stmn = "INSERT INTO Bitacora(ID_bitacora, ID_usuario, Fecha, Accion) VALUES ('" .$id_bitacora. "', '" . $id_usuario. "','" . $fecha . "', '" . $accion . "')";
    $c->execQuery($stmn);
  }

  function maxID($id_usuario){
    $c = new Conexion();
    $stmn =  "SELECT MAX(ID_bitacora) FROM Bitacora WHERE ID_usuario='" . $id_usuario . "'";
    $resultado = $c->execQuery($stmn);
    $maxID = $resultado->fetch_assoc();
    $id_bitacora = $maxID['MAX(ID_bitacora)'] + 1;
    return $id_bitacora;
    }
}
