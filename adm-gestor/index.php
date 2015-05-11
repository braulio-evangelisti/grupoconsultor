<?php 
  
$urlubic = "";

include_once($urlubic."func.includes/config.inc.php");
include_once($urlubic."func.includes/utiles.inc.php");
require($urlubic."func.includes/recaptchalib.php");

#Obligatorio incluir las claves
$publickey = "6LfcqgYTAAAAANoEOwwFmS-zKkxEpVcgzjPuOU4v";
$privatekey = "6LfcqgYTAAAAAIN5SPAFxQok4TtlAC2M7PKlcgx7";

switch ($_GET['estado']) {
  case 1:
      $estado = "<div class='alert alert-danger'><strong>Error!</strong> Email incorrecto.</div>";
      break;
  case 2:
      $estado = "<div class='alert alert-danger'><strong>Error!</strong> Contraseña incorrecta.</div>";
      break;
  case 3:
      $estado = "<div class='alert alert-warning'><strong>Error!</strong> Ud. no tiene permiso para ver esta página.</div>";
      break;
  case 4:
      $estado = "<div class='alert alert-success'><strong>La sesión ha finalizado!</strong><br>Ingrese nuevamente desde aqui.</div>";
      break;
  case 5:
      $estado = "<div class='alert alert-warning'><strong>Error!</strong> Verifique el campo captcha. </div>";
      break;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $publicTitle; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?php echo $metaDesc; ?>">
    <meta name="author" content="<?php echo $metaAuth; ?>">
    <meta name="keywords" content="<?php echo $metaKeywords; ?>">
    <link rel="icon" href="../img/favicon.ico">

    <title>Iniciar sesión</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <script type="text/javascript">
      /* 
      Para cambiar el theme del captcha.
      themes: red|white|blackglass|clean
      */
      var RecaptchaOptions = {
        theme : 'clean',
        lang  : 'es',
      };
    </script>

  </head>

  <body>

    <div class="container">

     <form id="signin" class="form-signin" role="form" method="POST" action="proceso.php?op=login">
        <h2 class="form-signin-heading"><i class="glyphicon glyphicon-lock"></i> Iniciar sesión</h2>

        <?php echo $estado; ?>

          <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
          
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <i id="show-hide-passwd" action="hide" class="glyphicon glyphicon-eye-open form-control-feedback" style="top:5px;cursor:pointer;"></i>
          </div>  

          <!-- Mostrar el campo captcha -->
          <?php echo recaptcha_get_html($publickey); ?>      
          <br>

          <input type="checkbox" name="recordar" id="recordar" value="true" /> No cerrar sesión  
          &middot;
          <a href="#forget" onclick="forgetpassword();" >Olvide mi contraseña</a>  
          
          <br>
          &nbsp;
          <br>

          <button class="btn btn-lg btn-primary btn-block" type="submit" name="procesar">Ingresar</button>

      </form>

      <br>

      <form id="passwd" class="form-signin" role="form" method="POST" action="proceso.php?op=forgot" style="display:none;">
        <input id="email" class="form-control" name="email" type="text"  placeholder="Email to get Password">
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="procesar">Reset Password</button>
      </form>

    </div> <!-- /container -->
    <footer class="footer">
      <p>© <?php echo date('Y'); ?></p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    
    <script>
      $(document).on('ready', function() {

        $('#show-hide-passwd').on('click', function(e) {
          e.preventDefault();
   
          var current = $(this).attr('action');
   
          if (current == 'hide') {
            $(this).prev().attr('type','text');
            $(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action','show');
          }
   
          if (current == 'show') {
            $(this).prev().attr('type','password');
            $(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action','hide');
          }
        })
      })

      function forgetpassword() {
        $("#signin").hide();
        $("#passwd").show();
      }

    </script>

  </body>
</html>