<?php
require_once 'Cliente.php';
require_once 'Cuota.php';
require_once 'Conexion.php';

class Prestamo {
    var $id_prestamo;
    var $cliente;
    var $monto;
    var $valor_cuota;
    var $tasa_interes;
    var $tasa_mora;
    var $cantidad_cuotas;
    var $fecha_inicio;
    var $fecha_fin;
    var $fecha_ultimo_pago;
    var $saldo;
    var $estado;
    var $observaciones;
    var $capitalizacion;
    var $cuotas;


    function crearNuevaCuota(){
        try {
            $cuota = new Cuota();
            return $cuota;
        } catch (ErrorPrestamo $e) {
            echo $e->nuevo($titulo, $ubicacion, $mensaje);
        }
    }

    function calcularCuotaMensual(){
        try {
            $numerador=($tasa_interes($tasa_interes +1))^($cantidad_cuotas);
            $denominador=($tasa_interes + 1)^($cantidad_cuotas) - 1;
            $valor_cuota= $monto*($numerador/$denominador);
            $fecha_inicio = date("Y-m-d H:i:s"); //devuelve en formato DATETIME igual a mysql   2001-03-10 17:16:18
            $fecha_fin = date('Y-m-d', strtotime("$fecha_inicio + $cantidad_cuotas day"));
            throw new ErrorPrestamo();
        } catch (ErrorPrestamo $e) {
            echo $e->nuevo($titulo, $ubicacion, $mensaje);
        }
    }

    function agregarCuota(Cuota $c) {
        try {
            $id_prestamo = $c->getId_prestamo();
            $num_cuota = $c->getNum_cuota();
            $valor = $c->getValor();
            $interes = $c->getInteres();
            $fecha = $c->getFecha();
            $capital = $c->getCapital();
            $saldo_anterior = $c->getSaldo_anterior();
            $saldo_actualizado = $c->getSaldo_actualizado();
            $mora = $c->getMora();
            $cuotas = array();
            array_push($cuotas, $c);
            $conn = new Conexion();
            $stmn = "INSERT INTO cuota(id_prestamo, num_cuota, valor, interes, fecha, capital, saldo_anterior, saldo_actualizado, mora) VALUES ('".$id_prestamo."','".$num_cuota."', '".$valor."','".$interes."','".$fecha."','".$capital."','".$saldo_anterior."','".$saldo_actualizado."','".$mora."')";
            $conn->execQuery($stmn);
            if ($saldo_actualizado != 0) {
                $stmn2 = "UPDATE prestamo SET fecha_ultimo_pago= '".$fecha."', saldo='".$saldo_actualizado."', fecha_fin = '" . $fecha . "' WHERE id_prestamo='".$id_prestamo."'";
                $conn->execQuery($stmn2);
            } else {
                $stmn2 = "UPDATE prestamo SET fecha_ultimo_pago= '".$fecha."', saldo='".$saldo_actualizado."',estado = 'I', fecha_fin = '" . $fecha . "' WHERE id_prestamo='".$id_prestamo."'";
                $conn->execQuery($stmn2);
            }
            
        } catch (ErrorPrestamo $e) {
            echo $e->nuevo($titulo, $ubicacion, $mensaje);
        }
    }

    function calcularInteresMensual() {
        //I = F - P
        //F = P(1 + i)^n
        try {
            $fin = date("Y-m-d H:i:s"); //fecha actual
            $fechaI = new DateTime($fecha_inicio);
            $fechaF = new DateTime($fin);
            $intervalo = $fechaI->diff($fechaF);
            $intervalMeses=$intervalo->format("%m");
            $intervalAnios=$intervalo->format("%y")*12;
       //echo "hay una diferencia de ".($intervalMeses+$intervalAnios)." meses";
            $n=$intervalMeses+$intervalAnios;
            $F = $monto(1 + $tasa_interes)^$n;
            $interes = $F - $monto;
            throw new ErrorPrestamo();
        } catch (ErrorPrestamo $e) {
            echo $e->nuevo($titulo, $ubicacion, $mensaje);
        }
    }

    function validar(){
        if (is_null($id_prestamo,$cliente,$monto,$valor_cuota,$tasa_interes,$cantidad_cuotas,$fecha_inicio,$fecha_fin,$fecha_ultimo_pago,$saldo,$estado,$observaciones,$cuotas)) {
            echo 'Clase vacia!!';
        }
    }


    //GET
    function getId_prestamo() {
        return $this->id_prestamo;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getMonto() {
        return $this->monto;
    }

    function getValor_cuota() {
        return $this->valor_cuota;
    }

    function getTasa_interes() {
        return $this->tasa_interes;
    }

    function getTasa_mora () {
        return $this->tasa_mora;
    }

    function getCantidad_cuotas() {
        return $this->cantidad_cuotas;
    }

    function getFecha_inicio() {
        return $this->fecha_inicio;
    }

    function getFecha_fin() {
        return $this->fecha_fin;
    }

    function getFecha_ultimo_pago() {
        return $this->fecha_ultimo_pago;
    }

    function getSaldo() {
        return $this->saldo;
    }

    function getEstado() {
        return $this->estado;
    }

    function getObservaciones() {
        return $this->observaciones;
    }

    function getCapitalizacion() {
        return $this->capitalizacion;
    }

    function getCuotas() {
        return $this->cuotas;
    }

    //SET
    function setId_prestamo($id_prestamo) {
        $this->id_prestamo = $id_prestamo;
    }

    function setCliente(Cliente $c) {
        $this->cliente = $c;
    }

    function setMonto($monto) {
        $this->monto = $monto;
    }

    function setValor_cuota($valor_cuota) {
        $this->valor_cuota = $valor_cuota;
    }

    function setTasa_interes($tasa_interes) {
        $this->tasa_interes = $tasa_interes;
    }

    function setTasa_mora($tasa_mora) {
        $this->tasa_mora = $tasa_mora;
    }

    function setCantidad_cuotas($cantidad_cuotas) {
        $this->cantidad_cuotas = $cantidad_cuotas;
    }

    function setFecha_inicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    function setFecha_fin($fecha_fin) {
        $this->fecha_fin = $fecha_fin;
    }

    function setFecha_ultimo_pago($fecha_ultimo_pago) {
        $this->fecha_ultimo_pago = $fecha_ultimo_pago;
    }

    function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }

    function setCapitalizacion($capitalizacion) {
        $this->capitalizacion = $capitalizacion;
    }

    function setCuotas($cuotas) {
        $this->cuotas = $cuotas;
    }
}
