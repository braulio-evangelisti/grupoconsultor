<?php
      
  require('func.includes/seguridad.php');
  
  $urlubic = "";

  include_once("func.includes/config.inc.php");
  include_once("func.includes/utiles.inc.php");
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $metaDesc; ?>">
    <meta name="keywords" content="<?php echo $metaKeywords; ?>">
    <meta name="author" content="<?php echo $metaAuth; ?>">
    <link rel="icon" href="../img/favicon.ico">

    <title><?php echo $admTitle; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->

  </head>

  <body>

    <?php include('menu.php'); ?>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Bienvenido, <?php echo $_SESSION['USERNAME']; ?></h1>
        <p>Este es el escritorio de su panel de control.</p>
        <p>Entre sus características principales se encuentran:</p>
        <p>
          <dl>
            <dt><i class="glyphicon glyphicon-ok"></i> &nbsp;Gestionar usuarios</dt>
            <dd><small>Gestión de los usuarios ingresados al sistema.</small></dd>
            <p></p>
            <dt><i class="glyphicon glyphicon-ok"></i> &nbsp;Administrar permisos</dt>
            <dd><small>Administración de permisos concedidos a usuarios según nivel de contenido.</small></dd>
            <p></p>  
            <dt><i class="glyphicon glyphicon-ok"></i> &nbsp;Actualizar contenido</dt>
            <dd><small>Crear y actualizar el contenido del sitio.</small></dd>
          </dl>
        </p>
          
        </p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
