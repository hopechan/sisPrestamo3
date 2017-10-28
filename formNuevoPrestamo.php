<?php include 'seguridad.php'; ?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Préstamos</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/calcularCuotaMensual.js"></script>
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
                <?php
                if ($_SESSION['rol'] == 'A') {
                  echo '<ul class="nav nav-sidebar">
                    <li>
                      <a href="webParametros.php" class="w3 bar-item w3-button"><i class="fa fa-cog"></i> Configuracion </a>
                    </li>
                  </ul>
                  <ul class="nav nav-sidebar">
                    <li>
                    <a href="webUsers.php" class="w3 bar-item w3-button"><i class="fa fa-users"></i> Usuarios </a>
                    </li>
                  </ul>
                  <ul class="nav nav-sidebar">
                    <li>
                      <a href="reporteEstadosFinancieros.php" class="w3 bar-item w3-button"><i class="fa fa-university"></i> Estados Financieros </a>
                    </li>
                  </ul>
                  <ul class="nav nav-sidebar">
                    <li>
                      <a href="modificarPlantillaContrato.php" class="w3 bar-item w3-button"><i class="fa fa-file-text"></i> Editar Contrato </a>
                    </li>
                  </ul>
                  <ul class="nav nav-sidebar">
                    <li>
                      <a href="webBitacora.php" class="w3 bar-item w3-button"><i class="fa fa-address-book"></i> Bitacora</a>
                    </li>
                  </ul> ';
                }
                  ?>
              </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <form class="form-horizontal" id="formPrestamo" name="formPrestamo" action="guardarPrestamo.php" method="POST">
                <div class="form-group">
                  <label class="col-md-4 control-label" for="cliente">Clientes</label>
                  <div class="col-md-5">
                    <select id="cliente" name="cliente" class="form-control">
                      <?php
                        require_once "ControladorCliente.php";

                        $cCliente = new ControladorCliente();

                        $Cliente = $cCliente->obtener();

                        $numClientes = count($Cliente);

                        for ($i=0; $i < $numClientes; $i++) {
                          echo '<option value="' . $Cliente[$i]->dui . '">' . $Cliente[$i]->nombres . ' ' .$Cliente[$i]->apellidos ."</option>";
                        }
                      ?>
                  </select>
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label">Monto</label>
                  <div class="col-md-5">
                  <input id="monto" name="monto" placeholder="$" class="form-control input-md" type="number" onkeyup="calcularCuotaMensual()" required step="any" min="0">

                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label">Numero de Cuotas</label>
                  <div class="col-md-5">
                  <input id="num_cuotas" name="num_cuotas" placeholder="12" class="form-control input-md" type="number" onkeyup="calcularCuotaMensual()" required min="1">
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label">Interes del prestamo</label>
                  <div class="col-md-5">
                  <input id="interes" name="interes" step="any" placeholder="%" class="form-control input-md" type="number" onkeyup="calcularCuotaMensual()" required min="0" max="100" value=
                     <?php
                        require_once 'Parametro.php';
                        $par = new Parametro();

                        $Parametro = $par->obtener();

                        $tasa_interes = '"' . $Parametro[3]->valor . '"';
                        $interes_mora = '"' . $Parametro[4]->valor . '"';
                        $capitalizacion = $Parametro[5]->valor;

                        echo $tasa_interes;

                        if ($capitalizacion == 'M') {
                                        $capitalizacionO = '<label class="radio-inline" for="capitalizacion-m"><input name="capitalizacion" id="capitalizacion-m" value="M" checked="checked" type="radio">Mensual</label><label class="radio-inline" for="capitalizacion-d"><input name="capitalizacion" id="capitalizacion-d" value="D" type="radio">Diaria</label>';
                                    } else {
                                        $capitalizacionO = '<label class="radio-inline" for="capitalizacion-m"><input name="capitalizacion" id="capitalizacion-m" value="M" type="radio">Mensual</label><label class="radio-inline" for="capitalizacion-d"><input name="capitalizacion" id="capitalizacion-d" value="D" checked="checked" type="radio">Diaria</label>';
                                    }
                     ?>
                  >
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="fecha_inicio">Fecha de inicio</label>
                  <div class="col-md-5">
                  <input id="fecha_inicio" type="date" name="fecha_inicio" class="form-control input-md" onkeyup="calcularCuotaMensual()" type="text" required value=
                    <?php
                      echo '"' . date('Y-m-d') . '"';
                    ?>
                  />
                  </div>
                </div>

                 <!-- Multiple Radios (inline) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="capitalizacion">Capitalización</label>
                  <div class="col-md-5">
                    <?php
                       echo $capitalizacionO;
                    ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-4 control-label" for="interes_mora">Interés por mora</label>
                  <div class="col-md-5">
                    <input type="number"  step="any" min="0" max="100" name="tasa_mora" class="form-control input-md" placeholder="%" value=
                       <?php
                          echo $interes_mora;
                       ?>
                    />
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label">Valor de cuota</label>
                  <div class="col-md-5">
                  <input id="valor_cuota" name="valor_cuota" placeholder="0.00" class="form-control input-md" type="text" required readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-4 control-label" for="fecha_inicio">Fecha de finalización</label>
                  <div class="col-md-5">
                  <input id="fecha_fin"  type="text" name="fecha_fin" class="form-control input-md" readonly placeholder="MM-DD-YYYY"/>
                  </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="observaciones">Observaciones</label>
                  <div class="col-md-5">
                    <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
                  </div>
                </div>

                <div class="form-group" align="center">
                <button id="guardarPrestamo" type="submit" name="guardarPrestamo" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </form>
        </div>
        </div>
        </div>
        </body>
</html>
