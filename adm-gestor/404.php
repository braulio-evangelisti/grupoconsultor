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
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">

    <title>Panel de control</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->

  </head>

  <body>

    <?php include('menu.php'); ?>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Oops!</h1>
        <p><?php echo $_SESSION['USERNAME']; ?>, no hemos encontrado la página.</p>
        <p><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default pull-right">Volver</a></p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
