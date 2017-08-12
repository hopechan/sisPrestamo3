<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Préstamos</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/buscar.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">SISTEMA PRÉSTAMOS</a>
                </div>
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
                            <a href="webparametros.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-wrench"></span> Configuración</a>
                        </li>
                    </ul>
                </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="container">
            <h1 class="page-header">Clientes</h1>
            <div class="col-md-8">
                <input type="text" class="form-control" name="busqueda" autocomplete="off" id="busqueda" onkeyup="buscar();" placeholder="Buscar...">
            </div>
            <a href="formCliente.php" class="btn btn-default">Nuevo cliente</a>
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
	                echo '<td>'.'<a href="detalleCliente.php?dui='.$Cliente[$i]->dui.'&nit='.$Cliente[$i]->nit.'&nombres='.$Cliente[$i]->nombres.'&apellidos='.$Cliente[$i]->apellidos.'&sexo='.$Cliente[$i]->sexo.'&direccion='.$Cliente[$i]->direccion.'&telefono='.$Cliente[$i]->telefono.'&fecha_nacimiento='.$Cliente[$i]->fecha_nacimiento.'&observaciones='.$Cliente[$i]->observaciones.'" data-toggle="tooltip" data-placement="bottom" title="Modificar"><button class="btn btn-sm btn-info"><i class="glyphicon glyphicon-eye-open"></i></button></a>';
	                echo '<a href="eliminar.php?dui='.$Cliente[$i]->dui.'&nit='.$Cliente[$i]->nit.'&nombres='.$Cliente[$i]->nombres.'&apellidos='.$Cliente[$i]->apellidos.'&sexo='.$Cliente[$i]->sexo.'&direccion='.$Cliente[$i]->direccion.'&telefono='.$Cliente[$i]->telefono.'&fecha_nacimiento='.$Cliente[$i]->fecha_nacimiento.'&observaciones='.$Cliente[$i]->observaciones.'" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><button class="btn btn-sm btn-info" ><i class="glyphicon glyphicon-remove"></i></button></a></tr>';
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
