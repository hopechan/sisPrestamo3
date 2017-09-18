<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Préstamos</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/buscarPrestamos.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">SISTEMA PRÉSTAMOS</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                </ul>
            </div>
        </nav>
       <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar" id="sidebar">
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="index.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-home"></span> Principal</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="webcliente.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-user"></span> Clientes</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="webprestamo.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-list-alt"></span> Prestamos</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="reporteEstadosFinancieros.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-usd"></span> Estados Financieros</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="webparametros.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-wrench"></span> Configuración</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="webUsuarios.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-user"></span> Usuarios</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="webBitacora.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-calendar"></span> Bitacora</a>
                        </li>
                    </ul>
                </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="container">
            <h1 class="page-header">Préstamos</h1>
            <div class="col-md-8">
                <input type="text" class="form-control" name="busqueda" autocomplete="off" id="busqueda" onkeyup="buscarPrestamos();" placeholder="Buscar...">
            </div>
            <a href="formPrestamo.php" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo préstamo</a>
        </div>
        <br>
        <h3 align="center">ACTIVOS</h3>
        <table class="table table-condensed" id="resultadoBusqueda">
            <thead>
              <tr>
              <th>ID</th>
              <th>DUI</th>
              <th>Nombre</th>
              <th>Monto</th>
              <th>Saldo</th>
              <th>Interés</th>
              <th>Cancelado</th>
              <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once 'ControladorPrestamo.php';
              require_once 'Conexion.php';
              $cPrestamo = new ControladorPrestamo();
              $prestamos = $cPrestamo->obtenerActivos();
              $numPrestamos = count($prestamos);
              for ($i=0; $i <$numPrestamos ; $i++) {
                $conn = new Conexion();
                $stmn = "SELECT MAX(num_cuota) FROM   Cuota WHERE ID_prestamo='" . $prestamos[$i]->id_prestamo . "'";
                $resultado = $conn->execQueryO($stmn);
                $max_cuota = $resultado->fetch_assoc();
                $porcentaje = (100-($prestamos[$i]->saldo / $prestamos[$i]->monto)*100);
                $cu = $max_cuota['MAX(num_cuota)'];
                echo '<tr>';
                   echo '<td>' . $prestamos[$i]->id_prestamo. '</td>';
                   echo '<td>' . $prestamos[$i]->cliente->dui . '</td>';
                   echo '<td>' . $prestamos[$i]->cliente->nombre . ' ' . $prestamos[$i]->cliente->apellidos . '</td>';
                   echo '<td>$' . $prestamos[$i]->monto. '</td>';
                   echo '<td>$' . $prestamos[$i]->saldo . '</td>';
                   echo '<td>' . $prestamos[$i]->tasa_interes. '%</td>';
                   echo '<td>' . round($porcentaje, 2). '%</td>';
                   echo '<td>'.'<a href="detallePrestamo.php?id_prestamo='.$prestamos[$i]->id_prestamo.'" data-toggle="tooltip" data-placement="bottom" title="Detalle"><button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-eye-open"></i></button></a>';
                   echo '<a data-toggle="tooltip" data-placement="bottom" title="Nuevo pago" href="webpago.php?id_prestamo='.$prestamos[$i]->id_prestamo.'&fecha_ultimo_pago='.$prestamos[$i]->fecha_ultimo_pago.'&nombres='.$prestamos[$i]->cliente->nombre.'&apellidos='.$prestamos[$i]->cliente->apellidos.'&monto='.$prestamos[$i]->monto.'&tasa_interes='.$prestamos[$i]->tasa_interes.'&cantidad_cuotas='.$prestamos[$i]->cantidad_cuotas.'&valor_cuota='.$prestamos[$i]->valor_cuota.'" ><button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-usd"></i></button></a>';
                   echo '<a href="reporte.php?id_prestamo='.$prestamos[$i]->id_prestamo.'&dui='.$prestamos[$i]->cliente->dui.'&nombres='.$prestamos[$i]->cliente->nombre.'&apellidos='.$prestamos[$i]->cliente->apellidos.'&monto='.$prestamos[$i]->monto.'&tasa='.$prestamos[$i]->tasa_interes.'" data-toggle="tooltip" data-placement="bottom" title="Contrato"><button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-file"></i></button></a></tr>';
              }
               ?>
            </tbody>
        </table>
        <h3> <br></h3>
        </div>
        </div>
        </div>
        <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

    </body>
</html>
