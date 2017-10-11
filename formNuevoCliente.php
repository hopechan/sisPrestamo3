<!DOCTYPE html>
<?php include 'seguridad.php';?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Préstamos</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
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
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">SISTEMA PRÉSTAMOS</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="logout.php"><?php echo $_SESSION["NombreCompleto"]. " "; ?><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
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
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <form class="form-horizontal" enctype="multipart/form-data" action="guardarCliente.php" method="POST">
        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="textinput">DUI</label>
          <div class="col-md-4">
          <input id="dui" name="dui" placeholder="Ingrese DUI" class="form-control input-md" required type="text" maxlength="10">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="NIT">NIT</label>
          <div class="col-md-4">
          <input id="nit" name="nit" placeholder="Ingrese NIT" class="form-control input-md" required type="text" maxlength="17">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="nombre">Nombres</label>
          <div class="col-md-5">
          <input id="nombres" name="nombres" placeholder="Ingrese nombres del cliente" class="form-control input-md" required type="text" onkeypress="return validar(event)">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="apellidos">Apellidos</label>
          <div class="col-md-5">
          <input id="apellidos" name="apellidos" placeholder="Ingrese apellidos del cliente" class="form-control input-md" required type="text" onkeypress="return validar(event)">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="fecha_nacimiento">Fecha de Nacimiento</label>
          <div class="col-md-4">
          <input type="date" id="fecha_nacimiento" name="fecha_nacimiento">
          </div>
        </div>

        <!-- Multiple Radios (inline) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="sexo">Sexo</label>
          <div class="col-md-4">
            <label class="radio-inline" for="sexo-0">
              <input name="sexo" id="sexo-0" value="M" checked="checked" type="radio">
              Masculino
            </label>
            <label class="radio-inline" for="sexo-1">
              <input name="sexo" id="sexo-1" value="F" type="radio">
              Femenino
            </label>
          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="direccion">Dirección</label>
          <div class="col-md-4">
            <textarea class="form-control" id="direccion" name="direccion" placeholder="Ingrese dirección del cliente"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="textinput">Teléfono</label>
          <div class="col-md-4">
          <input id="telefono" name="telefono" placeholder="Ingrese teléfono del cliente" class="form-control input-md" required="" type="text" maxlength="9">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="profesion">Profesión</label>
          <div class="col-md-5">
            <input id="profesion" name="profesion" placeholder="Ingrese profesión del cliente" class="form-control input-md" required type="text" onkeypress="return validar(event)">
          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="observaciones">Observaciones</label>
          <div class="col-md-4">
            <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
          </div>
        </div>

        <!-- Upload files -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="guardar_cliente">Documentos del cliente</label>
            <div class="col-md-4">
              <input type="file" name="imagen"/><br><input type="text" name="descripcionImagen" placeholder="Descripcion de la imagen">
            </div>
          </div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="guardar_cliente"></label>
          <div class="col-md-4">
            <button id="guardarCliente" type="submit" name="guardarCliente" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Guardar Cliente</button>
          </div>
        </div>
        </form>
        </div>
        </div>
    </body>
</html>
