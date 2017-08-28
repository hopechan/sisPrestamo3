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
                            <a href="webparametros.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-wrench"></span> Configuración</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                  <form class="form-horizontal">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="nombre_usuario">Nombre de Usuario</label>
                        <div class="col-md-4">
                          <input id="nombre_usuario" name="nombre_usuario" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="contrasenia">Contraseña</label>
                        <div class="col-md-4">
                          <input id="contrasenia" name="contrasenia" type="password" placeholder="" class="form-control input-md" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="dui">DUI</label>
                        <div class="col-md-4">
                          <input id="dui" name="dui" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="nit">NIT</label>
                        <div class="col-md-4">
                          <input id="nit" name="nit" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="nombre">Nombre</label>
                        <div class="col-md-4">
                          <input id="nombre" name="nombre" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="apellidos">Apellidos</label>
                        <div class="col-md-4">
                          <input id="apellidos" name="apellidos" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <div class="col-md-4">
                          <input id="fecha_nacimiento" name="fecha_nacimiento" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="direccion">Direccion</label>
                        <div class="col-md-4">
                          <input id="direccion" name="direccion" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="telefonos">Telefonos</label>
                        <div class="col-md-4">
                          <input id="telefonos" name="telefonos" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-4  col-md-offset-2 main">
                          <button id="guardar_usuario" name="guardar_usuario" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Guardar Usuario</button>
                        </div>
                      </div>
                  </form>
                </div>
          </body>
    </html>
