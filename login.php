<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Préstamos</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
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
            </div>
        </nav>
        <div><img src="font/avatar.png" width=178 height="178" vspace="10" hspace="560" alt="imagen avatar"></div>
        <br>
        <form class="form-horizontal" method="POST" action="index.php" data-toggle="validator" role="form">
        <div class="form-group">
          <label class="col-md-4 control-label" for="Usuario">Usuario</label>
          <div class="col-md-4">
            <input id="Usuario" name="Usuario" type="text" placeholder="Ingrese nombre de usuario" class="form-control input-md" required="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label" for="password">Contraseña</label>
          <div class="col-md-4">
            <input id="password" name="password" type="password" placeholder="Ingrese contraseña" class="form-control input-md" required="">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-4 control-label" for="login"></label>
            <div class="col-md-8">
              <button id="login" name="login" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Entrar</button>
            </div>
          </div>
      </form>
    </body>
    </html>
