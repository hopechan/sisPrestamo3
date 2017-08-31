<?php
class Cliente {
  public $dui;
  public $documentos;
  public $nit;
  public $nombres;
  public $apellidos;
  public $sexo;
  public $direccion;
  public $telefono;
  public $fecha_nacimiento;
  public $observaciones;
  

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

  function getNombres() {
      return $this->nombres;
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

  function getTelefono() {
      return $this->telefono;
  }

  function getFecha_nacimiento() {
      return $this->fecha_nacimiento;
  }

  function getObservaciones() {
      return $this->observaciones;
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

  function setNombres($nombres) {
      $this->nombres = $nombres;
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

  function setTelefono($telefono) {
      $this->telefono = $telefono;
  }

  function setFecha_nacimiento($fecha_nacimiento) {
      $this->fecha_nacimiento = $fecha_nacimiento;
  }

  function setObservaciones($observaciones) {
      $this->observaciones = $observaciones;
  }
  
  
}
