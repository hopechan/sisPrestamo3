<?php include 'seguridad.php';
if ($_SESSION['rol'] != 'A') {
	header("Location: index.php");
}
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Préstamos</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
				<link rel="stylesheet" href="css/datatable.min.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/buscarPrestamos.js"></script>
				<script src="js/datatable.min.js"></script>
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

                 <br>
                 <table class="table table-condensed" id="tablaUsuario">
                     <thead>
                         <tr>
                         <th>ID Usuario</th>
                         <th>Username</th>
                         <th>Nombres</th>
                         <th>Apellidos</th>
                         <th>Tipo de usuario</th>
                         </tr>
                     </thead>
                     <tbody>
                        <?php
                            require_once 'User.php';
                            $user = new User();
                            $Users = $user->obtenerTodos();
                            $numUsers = count($Users);
                            for ($i = 0; $i < $numUsers; $i++) {
                                echo "<tr>";
                                echo "<td>" . $Users[$i]->getId_user() . "</td>";
                                echo "<td>" . $Users[$i]->getUsername() . "</td>";
                                echo "<td>" . $Users[$i]->getNombres() . "</td>";
                                echo "<td>" . $Users[$i]->getApellidos() . "</td>";
                                echo "<td>";
                                if ($Users[$i]->getUserType() == "A") {
                                    echo "Administrador";
                                } else {
                                    echo "Usuario standard";
                                }
                                echo "</td>";
																echo "</tr>";
                            }
                        ?>
                     </tbody>
                 </table>
            </div>
						<script>
						$('#tablaUsuario').dataTable(
							{
    						"iDisplayLength": 5,
    						"aLengthMenu": [[5, 10], [5, 10]],
    					"oLanguage":
    					{
        				"sLengthMenu": "_MENU_ Registros por p&aacute;gina"
    			} ,
				});
						</script>
    </body>
    </html>
