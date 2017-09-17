<?php
class Cliente {
  public $dui;
  public $nombre;
  public $apellidos;
  public $sexo;
  public $nit;
  public $fecha_nacimiento;
  public $observaciones;
  public $direccion;
  public $telefonos;
  public $profesion;
  public $documentos;


  //get
  function getDui() {
      return $this->dui;
  }

  function getDocumentos() {
    return $this->documentos;
  }

  function getNit() {
      return $this->nit;
  }

  function getNombre() {
      return $this->nombre;
  }

  function getApellidos() {
      return $this->apellidos;
  }

  function getSexo() {
      return $this->sexo;
  }

  function getDireccion() {
      return $this->direccion;
  }

  function getTelefonos() {
      return $this->telefonos;
  }

  function getFecha_nacimiento() {
      return $this->fecha_nacimiento;
  }

  function getObservaciones() {
      return $this->observaciones;
  }

  function getProfesion(){
    return $this->profesion;
  }

  //set
  function setDui($dui) {
      $this->dui = $dui;
  }

  function setDocumentos(Documento $d) {
    $this->documentos = $d;
  }

  function setNit($nit) {
      $this->nit = $nit;
  }

  function setNombre($nombre) {
      $this->nombre = $nombre;
  }

  function setApellidos($apellidos) {
      $this->apellidos = $apellidos;
  }

  function setSexo($sexo) {
      $this->sexo = $sexo;
  }

  function setDireccion($direccion) {
      $this->direccion = $direccion;
  }

  function setTelefonos($telefonos) {
      $this->telefonos = $telefonos;
  }

  function setFecha_nacimiento($fecha_nacimiento) {
      $this->fecha_nacimiento = $fecha_nacimiento;
  }

  function setObservaciones($observaciones) {
      $this->observaciones = $observaciones;
  }

  function setProfesion($profesion){
    $this->profesion = $profesion;
  }
}
