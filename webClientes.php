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
        <script src="js/buscarCliente.js"></script>
    </head>
    <?php include 'seguridad.php'; ?>
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
                </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="container">
            <div class= "alert alert-sucess" id="alerta" style="display:none;"><strong>Cliente guardado correctamente</strong></div>
            <h1 class="page-header">Clientes</h1>
            <div class="col-md-8">
                <input type="text" class="form-control" name="busqueda" autocomplete="off" id="busqueda" onkeyup="buscar();" placeholder="Buscar...">
            </div>
            <a href="formNuevoCliente.php" class="btn btn-default"><i class="fa fa-plus"></i> Nuevo cliente</a>
        </div>
        <br>
        <table class="table table-condensed" id="resultadoBusqueda">
            <thead>
                <tr>
                <th>DUI</th>
                <th>NIT</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Sexo</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Fecha de nacimiento</th>
                <th>Profesión</th>
                <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once 'ControladorCliente.php';
                $cCliente = new ControladorCliente();
                $Cliente= $cCliente->obtener();
                $numClientes = count($Cliente);
                for ($i = 0; $i < $numClientes; $i++) {
	               	echo "<tr>";
	                echo "<td>" . $Cliente[$i]->dui . "</td>";
	                echo '<td>' . $Cliente[$i]->nit . '</td>';
	                echo '<td>' . $Cliente[$i]->nombres . '</td>';
	                echo '<td>' . $Cliente[$i]->apellidos . '</td>';
	                echo '<td>' . $Cliente[$i]->sexo . '</td>';
	                echo '<td>' . $Cliente[$i]->direccion . '</td>';
	                echo '<td>' . $Cliente[$i]->telefono . '</td>';
                    echo '<td>' . $Cliente[$i]->fecha_nacimiento . '</td>';
                    echo '<td>' . $Cliente[$i]->profesion . '</td>';
	                echo '<td>'.'<a href="detalleCliente.php?dui='.$Cliente[$i]->dui.'&nit='.$Cliente[$i]->nit.'&nombres='.$Cliente[$i]->nombres.'&apellidos='.$Cliente[$i]->apellidos.'&sexo='.$Cliente[$i]->sexo.'&direccion='.$Cliente[$i]->direccion.'&telefono='.$Cliente[$i]->telefono.'&fecha_nacimiento='.$Cliente[$i]->fecha_nacimiento.'&profesion=' . $Cliente[$i]->profesion . '&observaciones='.$Cliente[$i]->observaciones.'" data-toggle="tooltip" data-placement="bottom" title="Modificar"><button class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button></a>';
	                echo '<a href="eliminarCliente.php?dui='.$Cliente[$i]->dui.'&nit='.$Cliente[$i]->nit.'&nombres='.$Cliente[$i]->nombres.'&apellidos='.$Cliente[$i]->apellidos.'&sexo='.$Cliente[$i]->sexo.'&direccion='.$Cliente[$i]->direccion.'&telefono='.$Cliente[$i]->telefono.'&fecha_nacimiento='.$Cliente[$i]->fecha_nacimiento.'&observaciones='.$Cliente[$i]->observaciones.'&profesion='.$Cliente[$i]->profesion.'" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><button class="btn btn-sm btn-info" ><i class="fa fa-remove"></i></button></a></tr>';
	                echo '</tr>';
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
