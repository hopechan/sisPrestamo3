  <?php include 'seguridad.php'; ?>
   <!DOCTYPE html>
       <head>
           <meta charset="UTF-8">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <title>Sistema Préstamos</title>
           <link rel="stylesheet" href="css/bootstrap.css">
           <link rel="stylesheet" href="css/dashboard.css">
           <link rel="stylesheet" href="css/font-awesome.min.css">
           <script src="js/jquery-3.2.1.js"></script>
           <script src="js/bootstrap.min.js"></script>
           <script src="js/modificarPlantillaContrato.js"></script>
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
                   </div>

                   <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                       <div class="container">
                           <h1 class="page-header">Plantilla de contrato</h1>
                           <label>Etiquetas Cliente</label>
                           <br>
                           <button type="button" class="btn btn-sm btn-default" value="DUI" onclick="anadirEtiqueta()">DUI</button>
                           <button type="button" class="btn btn-sm btn-default" value="NIT" onclick="anadirEtiqueta()">NIT</button>
                           <button type="button" class="btn btn-sm btn-default" value="Nombre" onclick="anadirEtiqueta()">Nombres</button>
                           <button type="button" class="btn btn-sm btn-default" value="Apellidos" onclick="anadirEtiqueta()">Apellidos</button>
                           <button type="button" class="btn btn-sm btn-default" value="Sexo" onclick="anadirEtiqueta()">Sexo</button>
                           <button type="button" class="btn btn-sm btn-default" value="direccion" onclick="anadirEtiqueta()">Dirección</button>
                           <button type="button" class="btn btn-sm btn-default" value="profesion" onclick="anadirEtiqueta()">Profesión</button>
                           <br>
                           <br>
                           <label>Etiquetas Préstamo</label>
                           <br>
                           <button type="button" class="btn btn-sm btn-default" value="Monto" onclick="anadirEtiqueta()">Monto</button>
                           <button type="button" class="btn btn-sm btn-default" value="valor_cuota" onclick="anadirEtiqueta()">Valor de cuota</button>
                           <button type="button" class="btn btn-sm btn-default" value="tasa_interes" onclick="anadirEtiqueta()">Tasa de interés</button>
                           <button type="button" class="btn btn-sm btn-default" value="tasa_mora" onclick="anadirEtiqueta()">Tasa de mora</button>
                           <button type="button" class="btn btn-sm btn-default" value="cantidad_cuotas" onclick="anadirEtiqueta()">Cantidad de cuotas</button>
                           <button type="button" class="btn btn-sm btn-default" value="fecha_inicio" onclick="anadirEtiqueta()">Fecha de inicio</button>
                           <button type="button" class="btn btn-sm btn-default" value="capitalizacion" onclick="anadirEtiqueta()">Capitalización</button>
                       </div>
                       <br>
                               <form class="form-horizontal" method="POST" action="guardarPlantillaContrato.php">
                                   <textarea class="form-control" id="plantillaContrato" name="plantillaContrato" rows="30"><?php
                                       $file = fopen('plantillaContrato.txt', 'r');
                                       while($line = fgets($file)) {
                                           echo $line;
                                       }
                                   ?></textarea>
                                   <br>
                                   <button id="guardarPlantillaContrato" type="submit" name="guardarPlantillaContrato" class="btn btn-primary">
                                       <i class="fa fa-save">
                                       </i> Guardar
                                   </button>
                               </form>
                   </div>
               </div>
           </div>
       </body>
   </html>
