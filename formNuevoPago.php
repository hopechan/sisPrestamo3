<!DOCTYPE html>
<?php include 'seguridad.php'; ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pagos</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="css/circle.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/calcularNuevoPago.js"></script>
        <?php
          require_once 'Prestamo.php';
          require_once 'Conexion.php';

          $conn = new Conexion();

          $id_prestamo = $_GET['id_prestamo'];
          $nombres = $_GET['nombres'].'</h5>';
          $apellidos = $_GET['apellidos'].'</h5>';
          $monto = $_GET['monto'];
          $tasa = $_GET['tasa_interes'];
          $num_cuota = $_GET['cantidad_cuotas'];
          $valor_cuota = $_GET['valor_cuota'];

          $stmn = "SELECT * FROM Prestamo WHERE ID_prestamo = '" . $_GET['id_prestamo'] . "'";
          $resultado = $conn->execQueryO($stmn);
          $prestamo = $resultado->fetch_assoc();

          $stmn2 = "SELECT MAX(num_cuota) FROM Cuota WHERE ID_prestamo='" . $_GET['id_prestamo'] . "'";
          $resultado2 = $conn->execQueryO($stmn2);
          $max_cuota = $resultado2->fetch_assoc();
          $cu = $max_cuota['MAX(num_cuota)'] + 1;

          $saldo = $prestamo['saldo'];
          $fecha_ultimo_pago = $prestamo['fecha_ultimo_pago'];
          $capitalizacion = $prestamo['capitalizacion'];
          $tasa_mora = $prestamo['tasa_mora'];
          $fecha_inicio = $prestamo['fecha_inicio'];

          $porcentaje = 100 -($saldo/$monto) * 100;
          $p = round($porcentaje, 2);
         ?>
    </head>
    <body onload="calcularNuevoPago()">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">SISTEMA PRÉSTAMOS</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="logout.php"><?php echo $_SESSION["NombreCompleto"]. " "; ?><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
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
                      <a href="webClientes.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-user"></span> Clientes</a>
                  </li>
              </ul>
              <ul class="nav nav-sidebar">
                  <li>
                      <a href="webPrestamos.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-list-alt"></span> Prestamos</a>
                  </li>
              </ul>
            </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="container" id="panelInfo">
          <div class="row">
            <div class="col-md-6">
              <h4 id="titulo1">DATOS DEL CLIENTE</h4>
              <h5 id="Clientenombres">Nombres: <?php echo $nombres;  ?>
              <h5 id="Clienteapellidos">Apellidos: <?php echo $apellidos; ?>
            </div>
            <div class="col-md-6">
              <h4 id="titulo2">DATOS DEL PRÉSTAMO</h4>
              <h5 id="PrestamoId">N° de prestamo: <?php echo $id_prestamo.'</h5>'; ?>
              <h5 id="montoTotal">N° de cuota: <?php echo $cu .'/'. $num_cuota.'</h5>'; ?>
              <h5 id="valor_cuota">Valor Cuota: <?php echo $valor_cuota.'</h5>'; ?>
            </div>
          </div>
        </div>
        <br>
        <!-- Cambie el action para probar la impresion-->
        <form class="form-horizontal" action="imprimir.php" method="POST">

        <div class="form-group" >
          <label class="control-label col-md-4" for="cuota" id="labelCuota">Valor de la cuota</label>
          <div class="col-md-5">
            <input class="form-control" type="number" required name="cuota" id="cuota" onkeyup="calcularNuevoPago()" value="<?php echo $valor_cuota;?>" step="any" min="0.01">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-4" for="saldo_anterior" id="labelSaldo">Saldo Anterior</label>
            <div class="col-md-5">
              <input class="form-control" type="text"  name="saldo_anterior" id="saldo_anterior" value="<?php echo $saldo;?>" readonly>
            </div>
        </div>

        <div class="form-group">
        <label class="control-label col-md-4" for="saldoNuevo" id="labelSaldoNuevo">Nuevo Saldo</label>
          <div class="col-md-5">
          <input class="form-control" type="text" name="saldoNuevo" id="saldoNuevo" readonly>
          </div>
        </div>

        <div class="form-group">
        <label class="control-label col-md-4" for="interes" id="labelInteres">Interes</label>
        <div class="col-md-5">
        <input class="form-control" type="text" name="interes" id="interes" readonly>
        </div>
        </div>

        <div class="form-group">
        <label class="control-label col-md-4" for="capital" id="labelCapital">Capital</label>
        <div class="col-md-5">
        <input class="form-control" type="number" name="capital" id="capital" readonly>
        </div>
        </div>

        <div class="form-group">
        <label class="control-label col-md-4" for="mora" id="labelMora">Mora</label>
        <div class="col-md-5">
        <input class="form-control" type="number" name="mora" id="mora" readonly>
        </div>
        </div>

        <div class="form-group" align="center">
        <!--<button id="registrarPago" type="submit" name="registrarPago" class="btn btn-primary">Registrar Pago</button>-->
        <!-- Deshabilite el boton de registrar pago para probar la impresion -->
        <button id="imprimir" type="submit" name="imprimir" class="btn btn-primary">Imprimir</button>
        </div>

        <!-- Estos input deben estar text -->
        <input type="hidden" id="id_prestamo" name="id_prestamo" value="<?php echo $id_prestamo;?>" />
        <input type="hidden" id="fecha" name="fecha" value="<?php echo date('Y-m-d');?>"/>
        <input type="hidden" id="fecha_ultimo_pago"  name="fecha_ultimo_pago" value="<?php echo $fecha_ultimo_pago;?>" />
        <input type="hidden" id="capitalizacion" name="capitalizacion" value="<?php echo $capitalizacion; ?>"/>
        <input type="hidden" id="tasa" name="tasa" value="<?php echo $tasa;?>" />
        <input type="hidden" id="monto" name="monto" value="<?php echo $monto; ?>" />
        <input type="hidden" id="tc" name="tc" value="<?php echo $num_cuota; ?>" />
        <input type="hidden" id="tasa_mora" name="tasa_mora" value="<?php echo $tasa_mora; ?>"/>
        <input type="hidden" id="num_cuota" name="num_cuota" value="<?php echo $cu; ?>"/>
        <input type="hidden" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fecha_inicio;?>"/>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
