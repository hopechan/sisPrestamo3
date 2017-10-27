<?php include 'seguridad.php';
if ($_SESSION['rol'] != 'A') {
	header("Location: index.php");
}
?>
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
        <script type="text/javascript">
          jQuery(function($){
            $("#telefono").mask("9999-9999", {
              completed:function(){
                $("#telefono").addClass("ok")
              }
            });
          });
        </script>
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
					            <ul>';
                    }
                      ?>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                	<h1 class="page-header">Configuración</h1>
                	<form class="form-horizontal" method="POST" action="guardarParametros.php">
                		<div class="container" id="panelInfo">
	                		<div class="form-group">
                                <?php
                                    require_once 'Parametro.php';

                                    $par = new Parametro();
                                    $Parametro = $par->obtener();
                                    $nombre_empresa = '"' . $Parametro[0]->valor . '"';
                                    $correo = '"' . $Parametro[1]->valor . '"';
                                    $telefono = '"' . $Parametro[2]->valor . '"';
                                    $interes = '"' . $Parametro[3]->valor . '"';
                                    $mora = '"' . $Parametro[4]->valor . '"';
                                    $capitalizacion = $Parametro[5]->valor;
                                    $direccion = $Parametro[6]->valor;

                                    if ($capitalizacion == 'M') {
                                        $capitalizacionO = '<label class="radio-inline" for="capitalizacion-m"><input name="capitalizacion" id="capitalizacion-m" value="M" checked="checked" type="radio">Mensual</label><label class="radio-inline" for="capitalizacion-d"><input name="capitalizacion" id="capitalizacion-d" value="D" type="radio">Diaria</label>';
                                    } else {
                                        $capitalizacionO = '<label class="radio-inline" for="capitalizacion-m"><input name="capitalizacion" id="capitalizacion-m" value="M" type="radio">Mensual</label><label class="radio-inline" for="capitalizacion-d"><input name="capitalizacion" id="capitalizacion-d" value="D" checked="checked" type="radio">Diaria</label>';
                                    }
                                ?>
	                			<label class="col-md-4 control-label">Nombre de la empresa</label>
	                			<div class="col-md-4">
	                				<input id="nombre_empresa" name="nombre_empresa" class="form-control input-md" type="text" required value=
                                        <?php
                                        echo $nombre_empresa;
                                        ?>
                                    >
	                			</div>
	                		</div>
	                		<div class="form-group">
	                			<label class="col-md-4 control-label">Correo electrónico</label>
	                			<div class="col-md-4">
	                				<input id="email" name="email" class="form-control input-md" type="email" required value=
                                        <?php
                                        echo $correo;
                                        ?>
                                    >
	                			</div>
	                		</div>

                            <div class="form-group">
                               <label class="col-md-4 control-label">Dirección</label>
                               <div class="col-md-4">
                               <textarea class="form-control input-md" id="direccion" name="direccion">
                                  <?php
                                     echo $direccion;
                                  ?>
                               </textarea>
                               </div>
                            </div>

	                		<div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Teléfono</label>
                                <div class="col-md-4">
                                    <input id="telefono" name="telefono" placeholder="Ingrese teléfono del cliente" class="form-control input-md" required="" type="text" maxlength="9" value=
                                        <?php
                                            echo $telefono;
                                        ?>
                                    >
                                </div>
                            </div>
                		</div>
                		<div class="container" id="panelInfo">
                			<div class="form-group">
	                			<label class="col-md-4 control-label">Tasa de interés</label>
	                			<div class="col-md-4">
	                				<input id="tasa_interes" name="tasa_interes" class="form-control input-md" type="number" required min="0" max="100" value=
                                        <?php
                                        echo $interes;
                                        ?>
                                    >
	                			</div>
	                		</div>
	                		<div class="form-group">
	                			<label class="col-md-4 control-label">Interés por mora</label>
	                			<div class="col-md-4">
	                				<input id="interes_mora" name="interes_mora" class="form-control input-md" type="number" required min="0" max="100" value=
                                        <?php
                                        echo $mora;
                                        ?>
                                    >
	                			</div>
	                		</div>
	                		<div class="form-group">
	                			<label class="col-md-4 control-label">Capitalización</label>
	                			<div class="col-md-4">
					               <?php
                                    echo $capitalizacionO;
                                   ?>
					          	</div>
	                		</div>
                		</div>
                		<div class="form-group" align="center">
                			<button id="guardar" name="guardar" class="btn btn-primary" type="submit">Guardar</button>
                		</div>
                	</form>
                </div>
        	</div>
        </div>
	</body>
</html>
