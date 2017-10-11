<?php
require_once 'Conexion.php';
require_once 'Prestamo.php';

class ControladorPrestamo {

    public function agregar(Prestamo $p){
        try {
          $conn = new Conexion();

          $id_prestamo = $p->getId_prestamo();
          $cliente = $p->getCliente();
          $monto = $p->getMonto();
          $valor_cuota = $p->getValor_cuota();
          $cantidad_cuotas = $p->getCantidad_cuotas();
          $fecha_inicio = $p->getFecha_inicio();
          $fecha_ultimo_pago = $p->getFecha_ultimo_pago();
          $fecha_fin = $p->getFecha_fin();
          $tasa_interes = $p->getTasa_interes();
          $tasa_mora = $p->getTasa_mora();
          $saldo = $p->getSaldo();
          $estado = $p->getEstado();
          $observaciones = $p->getObservaciones();
          $capitalizacion = $p->getCapitalizacion();

          $stmn = "INSERT INTO prestamo(ID_prestamo, DUI, Monto, valor_cuota, tasa_interes, tasa_mora, cantidad_cuotas, fecha_inicio, fecha_fin,fecha_ultimo_pago, saldo, estado, observaciones, capitalizacion) values('" . $id_prestamo . "', '" . $cliente->dui . "', '" . $monto . "', '" . $valor_cuota . "', '" . $tasa_interes . "', '" . $tasa_mora . "', '" . $cantidad_cuotas . "', '" . $fecha_inicio . "', '" . $fecha_fin . "', '" . $fecha_ultimo_pago . "', '" . $saldo . "', '" . $estado . "', '" . $observaciones . "', '". $capitalizacion. "')";
          $conn->execQuery($stmn);
        } catch (ErrorPrestamo $e) {
            echo $e->nuevo();
        }
    }

    public function obtenerPorId($id_prestamo){
        try {
          $conn = new Conexion();
          $stmn = "SELECT * FROM prestamo WHERE ID_prestamo = '" . $id_prestamo . "'";
          $resultado = $conn->execQueryO($stmn);
          $Prestamo = array();
           while ($prestamos = $resultado->fetch_assoc()) {
             $p = new Prestamo();
             $p->setId_prestamo($prestamos['ID_prestamo']);

             $stmn2 = "SELECT * FROM cliente WHERE DUI = '" . $prestamos['DUI'] . "'";
             $resultado2 = $conn->execQueryO($stmn2);

             $c = new Cliente();
             $cliente = $resultado2->fetch_assoc();
             $c->setDui($cliente['DUI']);
                $c->setNit($cliente['NIT']);
                $c->setNombres($cliente['Nombre']);
                $c->setApellidos($cliente['Apellidos']);
                $c->setSexo($cliente['Sexo']);
                $c->setDireccion($cliente['direccion']);
                $c->setTelefono($cliente['telefonos']);
                $c->setFecha_nacimiento($cliente['fecha_nacimiento']);
                $c->setObservaciones($cliente['observaciones']);
                $c->setProfesion($cliente['profesion']);

                $p->setCliente($c);
             $p->setMonto($prestamos['Monto']);
             $p->setValor_cuota($prestamos['valor_cuota']);
             $p->setTasa_interes($prestamos['tasa_interes']);
             $p->setCantidad_cuotas($prestamos['cantidad_cuotas']);
             $p->setFecha_inicio($prestamos['fecha_inicio']);
             $p->setFecha_fin($prestamos['fecha_fin']);
             $p->setFecha_ultimo_pago($prestamos['fecha_ultimo_pago']);
             $p->setSaldo($prestamos['saldo']);
             $p->setEstado($prestamos['estado']);
             $p->setObservaciones($prestamos['observaciones']);
             $p->setCapitalizacion($prestamos['capitalizacion']);
             $p->setTasa_mora($prestamos['tasa_mora']);

             $stmn3="SELECT * FROM cuota where ID_prestamo = " . $prestamos['ID_prestamo'];
             $resultado3 = $conn->execQueryO($stmn3);
             $cuotas = array();
              while ($cuota = $resultado3->fetch_assoc()) {
                //Se crea y llena un objeto cuota ($cu) con los datos correspondientes
                $cu = new Cuota();
                $cu->setId_prestamo($cuota['ID_prestamo']);
                $cu->setNum_cuota($cuota['num_cuota']);
                $cu->setValor($cuota['valor']);
                $cu->setMora($cuota['mora']);
                $cu->setInteres($cuota['interes']);
                $cu->setFecha($cuota['fecha']);
                $cu->setCapital($cuota['capital']);
                $cu->setSaldo_anterior($cuota['saldo_anterior']);
                $cu->setSaldo_actualizado($cuota['saldo_actualizado']);

                array_push($cuotas, $cu);
            }
             $p->setCuotas($cuotas);

             array_push($Prestamo, $p);
           }
           $conn = null;
           return $Prestamo;
        }catch (ErrorPrestamo $e) {
            echo $e->nuevo();
        }
    }

    public function obtenerActivos(){
        try {
          $conn = new Conexion();
          $stmn = "SELECT * FROM prestamo WHERE estado = 'A'";
          $resultado = $conn->execQueryO($stmn);
          $Prestamo = array();
           while ($prestamos = $resultado->fetch_assoc()) {
             $p = new Prestamo();
             $p->setId_prestamo($prestamos['ID_prestamo']);

             $stmn2 = "SELECT * FROM cliente WHERE DUI = '" . $prestamos['DUI'] . "'";
             $resultado2 = $conn->execQueryO($stmn2);

             $c = new Cliente();
             $cliente = $resultado2->fetch_assoc();
             $c->setDui($cliente['DUI']);
                $c->setNit($cliente['NIT']);
                $c->setNombres($cliente['Nombre']);
                $c->setApellidos($cliente['Apellidos']);
                $c->setSexo($cliente['Sexo']);
                $c->setDireccion($cliente['direccion']);
                $c->setTelefono($cliente['telefonos']);
                $c->setFecha_nacimiento($cliente['fecha_nacimiento']);
                $c->setObservaciones($cliente['observaciones']);
                $c->setProfesion($cliente['profesion']);

                $p->setCliente($c);
             $p->setMonto($prestamos['Monto']);
             $p->setValor_cuota($prestamos['valor_cuota']);
             $p->setTasa_interes($prestamos['tasa_interes']);
             $p->setCantidad_cuotas($prestamos['cantidad_cuotas']);
             $p->setFecha_inicio($prestamos['fecha_inicio']);
             $p->setFecha_fin($prestamos['fecha_fin']);
             $p->setFecha_ultimo_pago($prestamos['fecha_ultimo_pago']);
             $p->setSaldo($prestamos['saldo']);
             $p->setEstado($prestamos['estado']);
             $p->setObservaciones($prestamos['observaciones']);
             $p->setCapitalizacion($prestamos['capitalizacion']);
             $p->setTasa_mora($prestamos['tasa_mora']);

             $stmn3="SELECT * FROM cuota where ID_prestamo = " . $prestamos['ID_prestamo'];
             $resultado3 = $conn->execQueryO($stmn3);
             $cuotas = array();
              while ($cuota = $resultado3->fetch_assoc()) {
                //Se crea y llena un objeto cuota ($cu) con los datos correspondientes
                $cu = new Cuota();
                $cu->setId_prestamo($cuota['ID_prestamo']);
                $cu->setNum_cuota($cuota['num_cuota']);
                $cu->setValor($cuota['valor']);
                $cu->setInteres($cuota['interes']);
                $cu->setMora($cuota['mora']);
                $cu->setFecha($cuota['fecha']);
                $cu->setCapital($cuota['capital']);
                $cu->setSaldo_anterior($cuota['saldo_anterior']);
                $cu->setSaldo_actualizado($cuota['saldo_actualizado']);

                array_push($cuotas, $cu);
            }
             $p->setCuotas($cuotas);

             array_push($Prestamo, $p);
           }
           $conn = null;
           return $Prestamo;
        } catch (ErrorPrestamo $e) {
            echo $e->nuevo();
        }
    }

    public function obtenerInactivos(){
        try {
          $conn = new Conexion();
          $stmn = "SELECT * FROM prestamo WHERE estado = 'I'";
          $resultado = $conn->execQueryO($stmn);
          $Prestamo = array();
           while ($prestamos = $resultado->fetch_assoc()) {
             $p = new Prestamo();
             $p->setId_prestamo($prestamos['ID_prestamo']);

             $stmn2 = "SELECT * FROM cliente WHERE DUI = '" . $prestamos['DUI'] . "'";
             $resultado2 = $conn->execQueryO($stmn2);

             $c = new Cliente();
             $cliente = $resultado2->fetch_assoc();
             $c->setDui($cliente['DUI']);
                $c->setNit($cliente['NIT']);
                $c->setNombres($cliente['Nombre']);
                $c->setApellidos($cliente['Apellidos']);
                $c->setSexo($cliente['Sexo']);
                $c->setDireccion($cliente['direccion']);
                $c->setTelefono($cliente['telefonos']);
                $c->setFecha_nacimiento($cliente['fecha_nacimiento']);
                $c->setObservaciones($cliente['observaciones']);
                $c->setProfesion($cliente['profesion']);

                $p->setCliente($c);
             $p->setMonto($prestamos['Monto']);
             $p->setValor_cuota($prestamos['valor_cuota']);
             $p->setTasa_interes($prestamos['tasa_interes']);
             $p->setCantidad_cuotas($prestamos['cantidad_cuotas']);
             $p->setFecha_inicio($prestamos['fecha_inicio']);
             $p->setFecha_fin($prestamos['fecha_fin']);
             $p->setFecha_ultimo_pago($prestamos['fecha_ultimo_pago']);
             $p->setSaldo($prestamos['saldo']);
             $p->setEstado($prestamos['estado']);
             $p->setObservaciones($prestamos['observaciones']);
             $p->setCapitalizacion($prestamos['capitalizacion']);
             $p->setTasa_mora($prestamos['tasa_mora']);

             $stmn3="SELECT * FROM cuota where ID_prestamo = " . $prestamos['ID_prestamo'];
             $resultado3 = $conn->execQueryO($stmn3);
             $cuotas = array();
              while ($cuota = $resultado3->fetch_assoc()) {
                //Se crea y llena un objeto cuota ($cu) con los datos correspondientes
                $cu = new Cuota();
                $cu->setId_prestamo($cuota['ID_prestamo']);
                $cu->setNum_cuota($cuota['num_cuota']);
                $cu->setValor($cuota['valor']);
                $cu->setInteres($cuota['interes']);
                $cu->setMora($cuota['mora']);
                $cu->setFecha($cuota['fecha']);
                $cu->setCapital($cuota['capital']);
                $cu->setSaldo_anterior($cuota['saldo_anterior']);
                $cu->setSaldo_actualizado($cuota['saldo_actualizado']);

                array_push($cuotas, $cu);
            }
             $p->setCuotas($cuotas);

             array_push($Prestamo, $p);
           }
           $conn = null;
           return $Prestamo;
        } catch (ErrorPrestamo $e) {
            echo $e->nuevo();
        }
    }

    public function obtenerPorCliente($s){
        try {

          $conn = new Conexion();
          $stmn = "SELECT * FROM cliente  WHERE DUI LIKE '%" . $s . "%' OR Nombre LIKE '%" . $s . "%' OR Apellidos LIKE '%" . $s . "%'";
          $resultado = $conn->execQueryO($stmn);
          $Prestamo = array();
           while ($cliente = $resultado->fetch_assoc()) {
             //Guardo el cliente
             $c = new Cliente();
             $c->setDui($cliente['DUI']);
             $c->setNit($cliente['NIT']);
             $c->setNombres($cliente['Nombre']);
             $c->setApellidos($cliente['Apellidos']);
             $c->setSexo($cliente['Sexo']);
             $c->setDireccion($cliente['direccion']);
             $c->setTelefono($cliente['telefonos']);
             $c->setFecha_nacimiento($cliente['fecha_nacimiento']);
             $c->setObservaciones($cliente['observaciones']);
             $c->setProfesion($cliente['profesion']);

             //Busco todos los prestamos del cliente
             $stmn2 = "SELECT * FROM prestamo WHERE DUI = '" . $cliente['DUI'] . "'";
             $resultado2 = $conn->execQueryO($stmn2);

             $p = new Prestamo();
             $prestamos = $resultado2->fetch_assoc();
             //Guardo los prestamos
             $p->setId_prestamo($prestamos['ID_prestamo']);
             $p->setCliente($c);
             $p->setMonto($prestamos['Monto']);
             $p->setValor_cuota($prestamos['valor_cuota']);
             $p->setTasa_interes($prestamos['tasa_interes']);
             $p->setCantidad_cuotas($prestamos['cantidad_cuotas']);
             $p->setFecha_inicio($prestamos['fecha_inicio']);
             $p->setFecha_fin($prestamos['fecha_fin']);
             $p->setFecha_ultimo_pago($prestamos['fecha_ultimo_pago']);
             $p->setSaldo($prestamos['saldo']);
             $p->setEstado($prestamos['estado']);
             $p->setObservaciones($prestamos['observaciones']);
             $p->setCapitalizacion($prestamos['capitalizacion']);
             $p->setTasa_mora($prestamos['tasa_mora']);

             //Busco las cuotas de los prestamos
             $stmn3="SELECT * FROM cuota where ID_prestamo = ". $prestamos['ID_prestamo'];
             $resultado3 = $conn->execQueryO($stmn3);
             $cuotas = array();
              while ($cuota = $resultado3->fetch_assoc()) {
                //Se crea y llena un objeto cuota ($cu) con los datos correspondientes
                $cu = new Cuota();
                $cu->setId_prestamo($cuota['ID_prestamo']);
                $cu->setNum_cuota($cuota['num_cuota']);
                $cu->setValor($cuota['valor']);
                $cu->setInteres($cuota['interes']);
                $cu->setMora($cuota['mora']);
                $cu->setFecha($cuota['fecha']);
                $cu->setCapital($cuota['capital']);
                $cu->setSaldo_anterior($cuota['saldo_anterior']);
                $cu->setSaldo_actualizado($cuota['saldo_actualizado']);

                array_push($cuotas, $cu);
            }
             $p->setCuotas($cuotas);

             array_push($Prestamo, $p);
           }
           $conn = null;
           return $Prestamo;
        } catch (ErrorPrestamo $e) {
            echo $e->nuevo();
        }
    }
}
