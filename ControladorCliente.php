<?php
require_once 'Conexion.php';
require_once 'Cliente.php';

class ControladorCliente {
    public function agregar(Cliente $c){
       try {
       $conn = new Conexion();

       $dui = $c->getDui();
       $documentos = $c->getDocumentos();
       $nit = $c->getNit();
       $nombres = $c->getNombres();
       $apellidos = $c->getApellidos();
       $sexo = $c->getSexo();
       $direccion = $c->getDireccion();
       $telefono = $c->getTelefono();
       $fecha_nacimiento = $c->getFecha_nacimiento();
       $observaciones = $c->getObservaciones();
       $stmn = "INSERT INTO  cliente(dui, nit, nombres, apellidos, sexo, direccion, telefonos, fecha_nacimiento, observaciones) values('" . $dui . "', '" . $nit . "', '" . $nombres . "', '" . $apellidos . "', '" . $sexo . "', '" . $direccion . "', '" . $telefono . "', '" . $fecha_nacimiento . "', '" . $observaciones . "')";

        $correlativo = $documentos->getCorrelativo();
        $nombre = $documentos->getNombre();
        $archivo = $documentos->getArchivo();
        $descripcion = $documentos->getDescripcion();

        if (!(empty($nombre))) {
            $stmn2  = "INSERT INTO documentos(dui, correlativo, nombre_archivo, archivo, descripcion) values('" . $dui . "', '" . $correlativo . "','" . $nombre . "', '" . $archivo . "','" . $descripcion . "')";
            
            $conn->execQuery($stmn2);
        }
        $conn->execQuery($stmn);

        } catch (ErrorPrestamo $e) {
          echo $e->nuevo();
        }
    }

    public function obtener(){
        try {
            $conn = new Conexion();
            $stmn = "SELECT * from cliente";
            $resultado = $conn->execQueryO($stmn);
            $Cliente = array();
            while ($cliente = $resultado->fetch_assoc()) {
                //Se crea y llena un objeto cliente ($c) con los datos correspondientes
                $c = new Cliente();
                $c->setDui($cliente['dui']);
                $c->setNit($cliente['nit']);
                $c->setNombres($cliente['nombres']);
                $c->setApellidos($cliente['apellidos']);
                $c->setSexo($cliente['sexo']);
                $c->setDireccion($cliente['direccion']);
                $c->setTelefono($cliente['telefonos']);
                $c->setFecha_nacimiento($cliente['fecha_nacimiento']);
                $c->setObservaciones($cliente['observaciones']);
                //Se añade el objeto cliente ($c) a la colección de objetos cliente
                array_push($Cliente, $c);
            }

            //Se cierra la conexión
            $conn = null;

            return $Cliente;
        } catch (ErrorPrestamo $e) {
            echo $e->nuevo();
        }
    }

    public function buscar($s){
            try {
                    $conn = new Conexion();
                    $stmn = "SELECT * FROM cliente WHERE dui LIKE '%" . $s . "%' OR nombres LIKE '%" . $s . "%' OR nit LIKE '%" . $s . "%' OR apellidos LIKE '%" . $s . "%'";
                    $resultado = $conn->execQueryO($stmn);
                    $Cliente = array();

                    while ($cliente = $resultado->fetch_assoc()) {
                        //Se crea y llena un objeto cliente ($c) con los datos correspondientes
                        $c = new Cliente();
                        $c->setDui($cliente['dui']);
                        $c->setNit($cliente['nit']);
                        $c->setNombres($cliente['nombres']);
                        $c->setApellidos($cliente['apellidos']);
                        $c->setSexo($cliente['sexo']);
                        $c->setDireccion($cliente['direccion']);
                        $c->setTelefono($cliente['telefonos']);
                        $c->setFecha_nacimiento($cliente['fecha_nacimiento']);
                        $c->setObservaciones($cliente['observaciones']);

                        //Se añade el objeto cliente ($c) a la colección de objetos cliente
                        array_push($Cliente, $c);
                    }
                    return $Cliente;

            } catch (ErrorPrestamo $e) {
                echo $e->nuevo();
            }
        }

    public function eliminar(Cliente $c){
        try {
            $conn = new Conexion();
            $stmn3 = "SELECT * FROM prestamo WHERE dui='" . $c->getDui() . "'";
            $resultado = $conn->execQueryO($stmn3);
            $bandera = $resultado->fetch_assoc();
            if(isset($bandera)) {
                echo '<script type="text/javascript">
                  alert("El cliente tiene préstamos asignados");
                  window.location="webcliente.php";
                  </script>';
            }
            else {
                $stmn = "DELETE FROM cliente WHERE dui='". $c->getDui() ."'";
                $stmn2 = "DELETE FROM documentos WHERE dui='" . $c->getDui() . "'";
                $conn->execQuery($stmn2);
                $conn->execQuery($stmn);
                echo '<script type="text/javascript">
                  alert("Cliente eliminado");
                  window.location="webcliente.php";
                  </script>';
            }
        } catch (ErrorPrestamo $e) {
            echo $e->nuevo();
        }
    }
}
