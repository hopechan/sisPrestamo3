<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Préstamos</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/formNewUser.js"></script>
        <script type="text/javascript">
          function validar(e) {
            tecla=(document.all)?e.keyCode:e.which;
            if (tecla==8) return true;
            patron =/[A-Za-zÑñáéíóúÁÉÍÓÚ\s]/;
            te=String.fromCharCode(tecla);
            return patron.test(te);
          }
        </script>
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
                        <a href="webClientes.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-user"></span> Clientes</a>
                    </li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li>
                        <a href="webPrestamos.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-list-alt"></span> Prestamos</a>
                    </li>
                </ul>
              </div>
                <br>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                  <form id="newUser" class="form-horizontal" method="POST" action="saveUser.php">
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="nombres">Nombres</label>
                        <div class="col-md-4">
                          <input id="nombres" name="nombres" type="text" class="form-control input-md" required onkeypress="return validar(event)">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="apellidos">Apellidos</label>
                        <div class="col-md-4">
                          <input id="apellidos" name="apellidos" type="text" class="form-control input-md" required onkeypress="return validar(event)">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="username">Nombre de usuario</label>
                        <div class="col-md-4">
                          <input id="username" name="username" type="text" class="form-control input-md" required onkeyup="comprobarEspacios();comprobarUsername()" onchange="comprobarUsername()">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="password">Contraseña</label>
                        <div class="col-md-4">
                          <input id="password" name="password" type="password" class="form-control input-md" required onkeyup="comprobarEspacios();comprobarPasswords()">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="passwordAgain">Repetir contraseña</label>
                        <div class="col-md-4">
                          <input id="passwordAgain" name="passwordAgain" type="password" class="form-control input-md" required onkeyup="comprobarEspacios();comprobarPasswords()">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="userType">Tipo de usuario</label>
                        <div class="col-md-4">
                          <select id="userType" name="userType" class="form-control" onclick="comprobarPasswords()">
                            <option value="A">Administrador</option>
                            <option value="S" selected>Usuario estándar</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="saveUser"></label>
                        <div class="col-md-4">
                          <button id="saveUser" type="submit" name="saveUser" class="btn btn-primary" disabled><span class="glyphicon glyphicon-save"></span>Guardar</button>
                        </div>
                      </div>
                  </form>
                </div>
          </body>
    </html>
-