<?php
require_once 'Conexion.php';
require_once 'Cliente.php';
session_start();
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
       $profesion = $c->getProfesion();
       $stmn = "INSERT INTO  Cliente(DUI, NIT, Nombre, Apellidos, Sexo, direccion, telefonos, fecha_nacimiento, observaciones, profesion) values('" . $dui . "', '" . $nit . "', '" . $nombres . "', '" . $apellidos . "', '" . $sexo . "', '" . $direccion . "', '" . $telefono . "', '" . $fecha_nacimiento . "', '" . $observaciones . "', '" . $profesion . "')";

        $correlativo = $documentos->getCorrelativo();
        $nombre = $documentos->getNombre();
        $archivo = $documentos->getArchivo();
        $descripcion = $documentos->getDescripcion();

        if (!(empty($nombre))) {
            $stmn2  = "INSERT INTO Documento(DUI, correlativo, nombre_archivo, archivo, descripcion) values('" . $dui . "', '" . $correlativo . "','" . $nombre . "', '" . $archivo . "','" . $descripcion . "')";
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
            $stmn = "SELECT * from Cliente";
            $resultado = $conn->execQueryO($stmn);
            $Cliente = array();
            while ($cliente = $resultado->fetch_assoc()) {
                //Se crea y llena un objeto cliente ($c) con los datos correspondientes
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
                    $stmn = "SELECT * FROM Cliente WHERE DUI LIKE '%" . $s . "%' OR Nombre LIKE '%" . $s . "%' OR NIT LIKE '%" . $s . "%' OR Apellidos LIKE '%" . $s . "%'";
                    $resultado = $conn->execQueryO($stmn);
                    $Cliente = array();

                    while ($cliente = $resultado->fetch_assoc()) {
                        //Se crea y llena un objeto cliente ($c) con los datos correspondientes
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
            $stmn3 = "SELECT * FROM Prestamo WHERE DUI='" . $c->getDui() . "'";
            $resultado = $conn->execQueryO($stmn3);
            $bandera = $resultado->fetch_assoc();
            if(isset($bandera)) {
                echo '<script type="text/javascript">
                  alert("El cliente tiene préstamos asignados");
                  window.location="webClientes.php";
                  </script>';
            }
            else {
                $stmn = "DELETE FROM Cliente WHERE DUI='". $c->getDui() ."'";
                $stmn2 = "DELETE FROM Documentos WHERE DUI='" . $c->getDui() . "'";
                $conn->execQuery($stmn2);
                $conn->execQuery($stmn);
                //Objetos bitacora
                $b = new Bitacora();
                $controladorBitacora = new Bitacora();
                //guarda la accion en la bitacora
                $accion = "El usuario ".$_SESSION["userName"]." elimino al cliente: " . $_['dui'];
                $id_bitacora = $controladorBitacora->maxID($_SESSION["id_usuario"]);
                $b->setId_bitacora($id_bitacora);
                $b->setId_usuario($_SESSION["id_usuario"]);
                $b->setFecha(date('Y-m-d h:i:s'));
                $b->setAccion($accion);
                $controladorBitacora->agregar($b);

                echo '<script type="text/javascript">
                  alert("Cliente eliminado");
                  window.location="webClientes.php";
                  </script>';
            }
        } catch (ErrorPrestamo $e) {
            echo $e->nuevo();
        }
    }
}
