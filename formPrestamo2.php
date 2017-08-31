<?php
    require_once 'ControladorPrestamo.php';
    require_once 'Prestamo.php';
    require_once 'Cliente.php';
    require_once 'Conexion.php';

    $p = new Prestamo();
    $c = new Cliente();
    $cPrestamo = new ControladorPrestamo();

    $dui = $_POST['cliente'];

    $conn = new Conexion();
    $stmn = "SELECT * FROM cliente WHERE dui = '" . $dui . "'";
    $resultado = $conn->execQueryO($stmn);

    $cliente = $resultado->fetch_assoc();

    $c->setDui($cliente['dui']);
    $c->setNit($cliente['nit']);
    $c->setNombres($cliente['nombres']);
    $c->setApellidos($cliente['apellidos']);
    $c->setSexo($cliente['sexo']);
    $c->setDireccion($cliente['direccion']);
    $c->setTelefono($cliente['telefonos']);
    $c->setFecha_nacimiento($cliente['fecha_nacimiento']);
    $c->setObservaciones($cliente['observaciones']);

    $stmn2 = "SELECT MAX(id_prestamo) FROM prestamo";
    $resultado = $conn->execQueryO($stmn2);
    $max_id_prestamo = $resultado->fetch_assoc();

    $id_prestamo = $max_id_prestamo['MAX(id_prestamo)'] + 1;

    $p->setId_prestamo($id_prestamo);
    $p->setCliente($c);
    $p->setMonto($_POST['monto']);
    $p->setValor_cuota($_POST['valor_cuota']);
    $p->setTasa_interes($_POST['interes']);
    $p->setTasa_mora($_POST['tasa_mora']);
    $p->setCantidad_cuotas($_POST['num_cuotas']);
    $p->setFecha_inicio($_POST['fecha_inicio']);
    $p->setFecha_ultimo_pago($_POST['fecha_inicio']);
    $p->setFecha_fin($_POST['fecha_fin']);
    $p->setSaldo($_POST['monto']);
    $p->setEstado("A");
    $p->setObservaciones($_POST['observaciones']);
    $p->setCapitalizacion($_POST['capitalizacion']);

    $cPrestamo->agregar($p);

    echo '<script type="text/javascript">
                  alert("Prestamo creado exitosamente");
                  window.location="webprestamo.php";
                  </script>';
