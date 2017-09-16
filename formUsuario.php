<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Préstamos</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    </head>
    <body>
      <script type="text/javascript">
        jQuery(function($){
          $("#dui").mask("99999999-9", {
            completed:function(){
              $("#dui").addClass("ok")
            }
          });

          $("#nit").mask("9999-999999-999-9");
          $("#telefono").mask("9999-9999")
        });
      </script>
      <script type="text/javascript">
        function validar(e) {
          tecla=(document.all)?e.keyCode:e.which;
          if (tecla==8) return true;
          patron =/[A-Za-zÑñáéíóúÁÉÍÓÚ\s]/;
          te=String.fromCharCode(tecla);
          return patron.test(te);
        }
      </script>
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
                            <a href="webBitacora.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-calendar"></span> Bitacora</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                  <form class="form-horizontal" data-toggle="validator" role="form" action="guardarUsuario.php" method="POST">
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="login">Nombre de Usuario</label>
                        <div class="col-md-4">
                          <span><input id="login" name="login" type="text" placeholder="Escriba un ID para el usuario" class="form-control input-md" required=""></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="clave">Contraseña</label>
                        <div class="col-md-4">
                          <input id="clave" name="clave" type="password" data-minlength="6" placeholder="Ingrese contraseña" class="form-control input-md" required="">
                          <div class="help-block">Seis caracteres como minimo</div>
                        </div>
                      </div>
                      <div  id="pswd_info"></div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="clave2">Verificar Contraseña</label>
                        <div class="col-md-4">
                          <input id="clave2" name="clave2" type="password" placeholder="Vuelva a ingresar la contraseña" class="form-control input-md" data-match="#clave" data-match-error="Las contraseñas no son iguales" required="">
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="nombre">Nombre</label>
                        <div class="col-md-4">
                          <input id="nombres" name="nombres" type="text" placeholder="Ingrese Nombres" class="form-control input-md" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="apellidos">Apellidos</label>
                        <div class="col-md-4">
                          <input id="apellidos" name="apellidos" type="text" placeholder="Ingrese Apellidos" class="form-control input-md" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="rol">Rol</label>
                        <div class="col-md-2">
                          <select id="rol" name="rol" class="form-control">
                            <option value="A">Administrador</option>
                            <option value="U">Usuario</option>
                          </select>
                        </div>
                        </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="guardar_usuario"></label>
                        <div class="col-md-4">
                          <button id="guardarUsuario" type="submit" name="guardarUsuario" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Guardar Usuario</button>
                        </div>
                      </div>
                  </form>
                </div>
          </body>
    </html>
