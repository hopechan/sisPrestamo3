<?php
class Cuota {
   var $id_prestamo;
   var $num_cuota;
   var $valor;
   var $interes;
   var $capital;
   var $fecha;
   var $saldo_anterior;
   var $saldo_actualizado;
   var $mora;

   function calcularCuota(){
       try {
            if (isset($valor) && isset($saldo_anterior)) {
                $saldo_actualizado = $saldo_anterior-$valor;
                return $saldo_actualizado;
            }else{
            echo 'Algunos valores no estan ingresados';
            return null;
            }
            throw new ErrorPrestamo();
        } catch (ErrorPrestamo $e) {
           echo $e->nuevo($titulo, $ubicacion, $mensaje);
       }
   }

   function validar(){
       try {
           if (is_null($num_cuota,$valor,$interes,$capital,$fecha,$saldo_anterior,$saldo_actualizado)) {
           echo 'Clase no definida';
            }
            if($saldo_anterior<=0){
            echo 'Fin del Prestamo';
            }else if ($saldo_anterior<$valor) {
            echo 'Verificar el Valor de la Couta';
            } else {
            echo 'algo salio mal, verifica!';
            }
            throw new ErrorPrestamo();
        } catch (ErrorPrestamo $e) {
           echo $e->nuevo($titulo, $ubicacion, $mensaje);
       }
   }

   function getId_prestamo() {
     return $this->id_prestamo;
   }

   function getNum_cuota() {
       return $this->num_cuota;
   }

   function getValor() {
       return $this->valor;
   }

   function getInteres() {
       return $this->interes;
   }

   function getCapital() {
       return $this->capital;
   }

   function getFecha() {
       return $this->fecha;
   }

   function getSaldo_anterior() {
       return $this->saldo_anterior;
   }

   function getSaldo_actualizado() {
       return $this->saldo_actualizado;
   }

   function getMora(){
     return $this->mora;
   }

   function setId_prestamo($id_prestamo) {
        $this->id_prestamo = $id_prestamo;
   }

   function setNum_cuota($num_cuota) {
       $this->num_cuota = $num_cuota;
   }

   function setValor($valor) {
       $this->valor = $valor;
   }

   function setInteres($interes) {
       $this->interes = $interes;
   }

   function setCapital($capital) {
       $this->capital = $capital;
   }

   function setFecha($fecha) {
       $this->fecha = $fecha;
   }

   function setSaldo_anterior($saldo_anterior) {
       $this->saldo_anterior = $saldo_anterior;
   }

   function setSaldo_actualizado($saldo_actualizado) {
       $this->saldo_actualizado = $saldo_actualizado;
   }

   function setMora($mora){
     $this->mora = $mora;
   }

}
