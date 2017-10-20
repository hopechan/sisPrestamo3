<?php include 'seguridad.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Préstamos</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php
          require_once 'ControladorPrestamo.php';
          $cPrestamo = new ControladorPrestamo();
          $p = array();
          $p = $cPrestamo->obtenerPorId($_GET['id_prestamo']);

          $id_prestamo = $_GET['id_prestamo'].'</h5>';
          $dui = $p[0]->cliente->dui.'</h5>';
          $nombres = $p[0]->cliente->nombres.'</h5>';
          $apellidos = $p[0]->cliente->apellidos . '</h5>';
          $monto = '$' . $p[0]->monto.'</h5>';
          $tasa = $p[0]->tasa_interes.'% </h5>';
          $capitalizacion = $p[0]->capitalizacion;
         ?>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">SISTEMA PRÉSTAMOS</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="logout.php"><?php echo $_SESSION["NombreCompleto"]. " "; ?><i class="fa fa-sign-out"></i> Salir</a></li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar" id="sidebar">
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="index.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i> Principal</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="webClientes.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i> Clientes</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="webPrestamos.php" class="w3-bar-item w3-button"><i class="fa fa-list-alt"></i> Prestamos</a>
                        </li>
                    </ul>
                    <?php if ($_SESSION['rol'] == "A") {
                      echo '<ul class="nav nav-sidebar">
                        <li>
                          <a href="webParametros.php" class="w3 bar-item w3-button"><i class="fa fa-cog"></i> Configuracion </a>
                        </li>
                      </ul>
                      <ul class="nav nav-sidebar>"
                        <li>
                        <a href="webUsers.php" class="w3 bar-item w3-button"><i class="fa fa-users"></i> Usuarios </a>
                        </li>
                        </ul>';
                    }
                    ?>
                </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="container" id="panelInfo">
            <div class="row">
              <div class="col-md-6">
                <h4 id="titulo1">Datos del cliente</h4>
                      <h5 id="Clientedui2">DUI: <?php echo $dui; ?>
                      <h5 id="Clientenombres">Nombres: <?php echo $nombres;  ?>
                      <h5 id="Clienteapellidos">Apellidos: <?php echo $apellidos; ?>
              </div>
              <div class="col-md-6">
                <h4 id="titulo2">Datos del prestamo</h4>
                      <h5 id="PrestamoId">N° de prestamo: <?php echo $id_prestamo; ?>
                      <h5 id="montoTotal">Monto Total: <?php echo $monto; ?>
                      <h5 id="tasa">Tasa de interes: <?php echo $tasa; ?>
                      <h5 id="Capitalizacion">Capitalización: <?php if ($capitalizacion == 'M') {
                        echo "Mensual </h5>";
                      } else {
                        echo "Diaria </h5>";
                      }
                        ?></h5>
              </div>
            </div>
          </div>
          <table class="table table-condensed" id="resultadoBusqueda">
            <thead>
                <tr>
                <th>N°</th>
                <th>Monto</th>
                <th>Capital</th>
                <th>Interés</th>
                <th>Mora</th>
                <th>Saldo anterior</th>
                <th>Saldo actualizado</th>
                <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $Cuotas = $p[0]->cuotas;
                $numCuotas = count($p[0]->cuotas);
                for ($i = 0; $i < $numCuotas; $i++) {
                  echo "<tr>";
                  echo "<td>" . $Cuotas[$i]->num_cuota . "</td>";
                  echo '<td>$' . $Cuotas[$i]->valor . '</td>';
                  echo '<td>$' . $Cuotas[$i]->capital . '</td>';
                  echo '<td>$' . $Cuotas[$i]->interes . '</td>';
                  echo '<td>$' . $Cuotas[$i]->mora . '</td>';
                  echo '<td>$' . $Cuotas[$i]->saldo_anterior.'</td>';
                  echo '<td>$' . $Cuotas[$i]->saldo_actualizado . '</td>';
                  echo '<td>' . $Cuotas[$i]->fecha . '</td>';
                }
            ?>
            </tbody>
        </table>
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
