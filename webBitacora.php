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
                             <a href="webUsuarios.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-calendar"></span> Bitacora</a>
                         </li>
                     </ul>
                 </div>
                 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                 <div class="container">
                     <h1 class="page-header">Bitacora General</h1>
                     <div class="col-md-8">
                         <input type="text" class="form-control" name="busqueda" autocomplete="off" id="busqueda" onkeyup="buscar();" placeholder="Buscar...">
                     </div>
                 </div>
                 <br>
                 <table class="table table-condensed" id="resultadoBusqueda">
                     <thead>
                         <tr>
                         <th>ID usuario</th>
                         <th>Fecha</th>
                         <th>Hora</th>
                         <th>Accion</th>
                         </tr>
                     </thead>
                     <tbody>
                     </tbody>
                 </table>
                 </div>
    </body>
    </html>
