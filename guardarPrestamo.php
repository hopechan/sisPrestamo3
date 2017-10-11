<?php
    require_once 'ControladorPrestamo.php';
    require_once 'Prestamo.php';
    require_once 'Cliente.php';
    require_once 'Conexion.php';
    require_once 'Bitacora.php';
    session_start();
    $p = new Prestamo();
    $c = new Cliente();
    $cPrestamo = new ControladorPrestamo();

    $dui = $_POST['cliente'];

    $conn = new Conexion();
    $stmn = "SELECT * FROM Cliente WHERE DUI = '" . $dui . "'";
    $resultado = $conn->execQueryO($stmn);

    $cliente = $resultado->fetch_assoc();

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

    $stmn2 = "SELECT MAX(ID_prestamo) FROM Prestamo";
    $resultado = $conn->execQueryO($stmn2);
    $max_id_prestamo = $resultado->fetch_assoc();

    $id_prestamo = $max_id_prestamo['MAX(ID_prestamo)'] + 1;

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
    //Objetos bitacora
    $b = new Bitacora();
    $controladorBitacora = new Bitacora();
    //guarda la accion en la bitacora
    $accion = "El usuario ".$_SESSION["userName"]." creo el prestamo # " . $id_prestamo;
    $id_bitacora = $controladorBitacora->maxID($_SESSION["id_usuario"]);
    $b->setId_bitacora($id_bitacora);
    $b->setId_usuario($_SESSION["id_usuario"]);
    $b->setFecha(date('Y-m-d h:i:s'));
    $b->setAccion($accion);
    $controladorBitacora->agregar($b);
    echo '<script type="text/javascript">
                  alert("Prestamo creado exitosamente");
                  window.location="webPrestamos.php";
                  </script>';
