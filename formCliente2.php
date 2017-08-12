<?php
require_once 'Conexion.php';
require_once 'Cliente.php';
require_once 'Documento.php';
require_once 'ControladorCliente.php';


        $conn = new Conexion();
        $c = new Cliente();
        $cCliente = new ControladorCliente();

            $c->setDui($_POST['dui']);
            $c->setNit($_POST['nit']);
            $c->setNombres($_POST['nombres']);
            $c->setApellidos($_POST['apellidos']);
            $c->setSexo($_POST['sexo']);
            $c->setDireccion($_POST['direccion']);
            $c->setTelefono($_POST['telefono']);
            $c->setFecha_nacimiento($_POST['fecha_nacimiento']);
            $c->setObservaciones($_POST['observaciones']);

            $tmp_name = $_FILES['imagen']['tmp_name'];
            $tipo_archivo = $_FILES['imagen']['type'];

            $contained_binary = addslashes(fread(fopen($tmp_name,"rb"), $_FILES['imagen']['size']));
            $binary_name = $_FILES['imagen']['name'];

            $stmn2 = "SELECT MAX(correlativo) FROM documentos WHERE dui='" . $_POST['dui'] . "'";
            $resultado = $conn->execQueryO($stmn2);
            $max_correlativo = $resultado->fetch_assoc();
            $correlativo = $max_correlativo['MAX(correlativo)'] + 1;

            $d = new Documento();
            if(strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "png")) {

                $d->setDui($_POST['dui']);
                $d->setCorrelativo($correlativo);
                $d->setNombre($binary_name);
                $d->setArchivo($contained_binary);
                $d->setDescripcion($_POST['descripcionImagen']);
            }

            $c->setDocumentos($d);

            $cCliente->agregar($c);
            echo '<script type="text/javascript">
                  alert("Cliente Guardado");
                  window.location="webcliente.php";
                  </script>';

//header("Location: webcliente.php");
