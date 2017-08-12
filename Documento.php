<?php
class Documento {
  public $dui;
  public $correlativo;
  public $nombre;
  public $archivo;
  public $descripcion;

  function getDui(){
    return $this->dui;
  }

  function setDui($dui) {
      $this->dui = $dui;
  }

  function getCorrelativo(){
    return $this->correlativo;
  }

  function setCorrelativo($correlativo){
    $this->correlativo = $correlativo;
  }

  function getNombre(){
    return $this->nombre;
  }

  function setNombre($nombre){
    $this->nombre = $nombre;
  }

  function getArchivo(){
    return $this->archivo;
  }

  function setArchivo($archivo){
    $this->archivo = $archivo;
  }

  function getDescripcion(){
    return $this->descripcion;
  }

  function setDescripcion($descripcion){
    $this->descripcion = $descripcion;
  }
}
