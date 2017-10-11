<?php
require_once 'Conexion.php';
require_once 'Cliente.php';
require_once 'Documento.php';
require_once 'ControladorCliente.php';
require_once 'Bitacora.php';
session_start();

        $conn = new Conexion();
        $c = new Cliente();
        $cCliente = new ControladorCliente();
        //Objetos bitacora
        $b = new Bitacora();
        $controladorBitacora = new Bitacora();

            $c->setDui($_POST['dui']);
            $c->setNit($_POST['nit']);
            $c->setNombres($_POST['nombres']);
            $c->setApellidos($_POST['apellidos']);
            $c->setSexo($_POST['sexo']);
            $c->setDireccion($_POST['direccion']);
            $c->setTelefono($_POST['telefono']);
            $c->setFecha_nacimiento($_POST['fecha_nacimiento']);
            $c->setObservaciones($_POST['observaciones']);
            $c->setProfesion($_POST['profesion']);

            $tmp_name = $_FILES['imagen']['tmp_name'];
            $tipo_archivo = $_FILES['imagen']['type'];

            $contained_binary = addslashes(fread(fopen($tmp_name,"rb"), $_FILES['imagen']['size']));
            $binary_name = $_FILES['imagen']['name'];

            $d = new Documento();
            if(strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "png")) {

                $d->setDui($_POST['dui']);
                $d->setCorrelativo(1);
                $d->setNombre($binary_name);
                $d->setArchivo($contained_binary);
                $d->setDescripcion($_POST['descripcionImagen']);
            }

            $c->setDocumentos($d);

            $cCliente->agregar($c);
            //guarda la accion en la bitacora
            $accion = "El usuario ".$_SESSION["userName"]." creo el cliente con dui: " . $_POST['dui'];
            $id_bitacora = $controladorBitacora->maxID($_SESSION["id_usuario"]);
            $b->setId_bitacora($id_bitacora);
            $b->setId_usuario($_SESSION["id_usuario"]);
            $b->setFecha(date('Y-m-d h:i:s'));
            $b->setAccion($accion);
            $controladorBitacora->agregar($b);

            echo '<script type="text/javascript">
                  alert("Cliente Guardado");
                  window.location="webClientes.php";
                  </script>';
