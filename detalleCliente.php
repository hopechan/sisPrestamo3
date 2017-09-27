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
        <?php
          $dui = $_GET['dui'].'</h5>';
          $nit = $_GET['nit'].'</h5>';
          $nombres = $_GET['nombres'].'</h5>';
          $apellidos = $_GET['apellidos'].'</h5>';
          $sexo = $_GET['sexo'].'</h5>';
          $direccion = $_GET['direccion'].'</h5>';
          $fecha_nacimiento = $_GET['fecha_nacimiento'].'</h5>';
          $telefono = $_GET['telefono'].'</h5>';
          $observaciones = $_GET['observaciones'].'</h5>';

         ?>
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
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="container" id="panelInfo">
              <div class="row">
                <div class="col-md-4" align="center">
                  <h4 id="tituloCliente"><?php echo $_GET['nombres'] . ' ' . $_GET['apellidos']; ?></h4>
                  <h4><img src=
                    <?php
                      echo '"verImagen.php?dui=' . $_GET['dui'] . '&correlativo=1"';
                    ?>
                   height="90"></h4>
                </div>
                <div class="col-md-4">
                  <h5 id="Clientedui">DUI: <?php echo $dui; ?>
                  <h5 id="Clientenit">NIT:  <?php echo $nit; ?>
                  <h5 id="Clientenombres">Nombres: <?php echo $nombres; ?>
                  <h5 id="Clienteapellidos">Apellidos: <?php echo $apellidos; ?>
                  <h5 id="Clienteobservaciones">Observaciones: <?php  echo $observaciones;?>
                </div>
                <div class="col-md-4">
                  <h5 id="Clientesexo">Sexo: <?php echo $sexo; ?>
                  <h5 id="ClientefechaNacimiento">Fecha de nacimiento: <?php echo $fecha_nacimiento; ?>
                  <h5 id="Clientedireccion">Direccion: <?php echo $direccion; ?>
                  <h5 id="Clientetelefono">Telefono: <?php echo $telefono; ?>
                </div>
              </div>
            </div>

            <br>

    <form class="form-horizontal" id="clienteDetalle" action="guardarModificacionCliente.php" method="POST" enctype="multipart/form-data">
      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="telefono">Telefono</label>
        <div class="col-md-5">
          <input id="telefono" name="telefono" value="<?php echo $_GET['telefono'];?>" class="form-control input-md" type="text" maxlength="9">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="direccion">Direccion</label>
        <div class="col-md-5">
          <textarea id="direccion" name="direccion" class="form-control"><?php echo $_GET['direccion'];?></textarea>
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="profesion">Profesión</label>
        <div class="col-md-5">
          <input id="profesion" name="profesion" value="<?php echo $_GET['profesion'];?>" class="form-control input-md" type="text">
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="observaciones">Observaciones</label>
        <div class="col-md-5">
          <textarea id="observaciones" name="observaciones" class="form-control"><?php echo $_GET['observaciones'];?></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
        <label class="col-md-4 control-label" for="observaciones">Documentos</label>
        <div class="col-md-5">
          <?php
             require_once 'Conexion.php';
             $conn = new Conexion();
             $dui = $_GET['dui'];
             $stmn = "SELECT COUNT(correlativo) FROM documento WHERE DUI = '" . $dui . "'";
             $stmn2 = "SELECT descripcion FROM documento WHERE DUI = '" . $dui . "'";
             $descripcionesImagen = array();
             $resultado2 = $conn->execQueryO($stmn2);
             while ($documentos = $resultado2->fetch_assoc()) {
              array_push($descripcionesImagen, $documentos['descripcion']);
             }
             $resultado = $conn->execQueryO($stmn);
             $counter = $resultado->fetch_assoc();

             for ($i = 1; $i < $counter['COUNT(correlativo)']+1; $i++) {
                echo '<a href="verImagenGrande.php?dui='.$dui.'&correlativo='.$i.'">';
                echo '<img src="verImagen.php?dui=' . $dui . '&correlativo=' . $i . '" height="90"></a> ' . $descripcionesImagen[$i-1];
                echo '<br><br>';
             }
          ?>
          </div>
          <div clas="row" align="center">
            <input type="file" id="imagen" name="imagen"><br><input type="text" name="descripcionImagen" placeholder="Descripcion de la imagen">
          </div>
        </div>
      </div>
      <input type="hidden" id="dui" name="dui" value="<?php echo $_GET['dui'];?>">
      <div class="form-group" align="center">
          <button id="editar" name="editar" class="btn btn-primary" type="submit">Guardar Cambios</button>
      </div>
    </form>
    </div>
    </div>
    </div>
  </body>
</html>