<?php

  require('func.includes/seguridad.php');
        
  $urlubic = "";

  include_once("func.includes/config.inc.php");
  include_once("func.includes/utiles.inc.php");

  //Recuperamos OP
  $op = secureParamToSql($_GET['op']);
  
  //Si es ALTA, usamos el form para insertar con la accion CREATE
  if($op == 'alta/de/slider') {

      $action   = 'create';
      $title    = 'Nuevo slide';

  }

  //Si es EDICION, usamos el form para modificar con la accion UPDATE
  if($op == 'edicion/de/slider') {
     
      $action    = 'update';
      $title     = 'Editar slide';
      
      $id = secureParamToSql($_GET['id']);

      $row = $objGeneral->seleccionar_registro("slider","idSlide",$id);
      
  }

  //Definimos alert segun resultado de operacion ALTA
  switch ($_GET['result']) {
    case 'bad':
        $result = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><i class='glyphicon glyphicon-warning-sign'></i> Ocurrió un error durante la operación.</div>";
    break;
    case 'ok':
        $result = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><i class='glyphicon glyphicon-ok-sign'></i> La operación se ha realizado con éxito.</div>";
    break;
  }
  
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

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    
  </head>

  <body>

    <?php include('menu.php'); ?>

    <div class="container">

      <div class="row">

        <ol class="breadcrumb">
          <li><a href="proceso.php?op=panel/administracion">Home</a></li>
          <li class="active">Slider</li>
          <a href="proceso.php?op=panel/slider" class="btn btn-default btn-xs pull-right">Volver</a>
        </ol>

      </div>

      <!-- Título -->
      <div class="row">
        <div class="page-header">
          <h2><?php echo $title; ?> <small></small></h2>
        </div>
      </div>

      <div class="row">
        <?php echo $result; ?>
        <form action="frm_slider/procesar.php?action=<?php echo $action; ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" role="form">
          
          <input type="hidden" name="idOwner" class="idOwner" value="<?php echo $_SESSION['idUsuario']; ?>" />
          <input type="hidden" name="idSlide" id="idSlide" value="<?php echo $row['idSlide']; ?>" />
          <input type="hidden" name="imagenOld" id="imagenOld" value="<?php echo $row['imagen']; ?>" />

          <?php if($row['imagen'] != ''){ ?>
          <div class="form-group">
            <div class="col-sm-12">
              <img src="timthumb.php?src=<?php echo _global_siteurl; ?>adm-gestor/frm_slider/<?php echo $row['imagen']; ?>&amp;w=1170" class="thumbnail" style="width:100%;">
            </div>
          </div>
          <?php } ?>

          <div class="form-group">
            <label for="imagen" class="col-sm-4 control-label">Imagen</label>
            <div class="col-sm-6">
              <div class="btn btn-info btn-xs pull-right uplMltBtn" title="Seleccionar imagen">
                Cargar
                <input type="file" name="imagen" id="imagen" value="<?php echo $row['imagen']; ?>" class="uplMlt" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="alt" class="col-sm-4 control-label">Texto alternativo</label>
            <div class="col-sm-6">
              <input type="text" name="alt" class="form-control" id="alt" value="<?php echo $row['alt']; ?>" placeholder="Texto alternativo de la imagen" >
            </div>
          </div>
          
          <div class="form-group">
            <label for="titulo" class="col-sm-4 control-label">Título</label>
            <div class="col-sm-6">
              <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo $row['titulo']; ?>" required autofocus >
            </div>
          </div>

          <div class="form-group">
            <label for="txtSlide1" class="col-sm-4 control-label">Línea 1</label>
            <div class="col-sm-6">
              <input type="text" name="txtSlide1" class="form-control" id="txtSlide1" value="<?php echo $row['txtSlide1']; ?>" required >
            </div>
          </div>

          <div class="form-group">
            <label for="txtSlide2" class="col-sm-4 control-label">Línea 2</label>
            <div class="col-sm-6">
              <input type="text" name="txtSlide2" class="form-control" id="txtSlide2" value="<?php echo $row['txtSlide2']; ?>" >
            </div>
          </div>

          <div class="form-group">
            <label for="txtSlide3" class="col-sm-4 control-label">Línea 3</label>
            <div class="col-sm-6">
              <input type="text" name="txtSlide3" class="form-control" id="txtSlide3" value="<?php echo $row['txtSlide3']; ?>" >
            </div>
          </div>

          <div class="form-group">
            <label for="txtSlide4" class="col-sm-4 control-label">Línea 4</label>
            <div class="col-sm-6">
              <input type="text" name="txtSlide4" class="form-control" id="txtSlide4" value="<?php echo $row['txtSlide4']; ?>" >
            </div>
          </div>

          <div class="form-group">
            <label for="orden" class="col-sm-4 control-label">Orden</label>
            <div class="col-sm-6">
              <input type="text" name="orden" class="form-control" id="orden" value="<?php echo $row['orden']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="publicada" class="col-sm-4 control-label">Publicar</label>
            <div class="col-sm-6">
              <input type="radio" name="publicada" value="SI" <?php if($row['publicada'] == 'SI'){ echo 'checked' ; } ?> > SI
              <input type="radio" name="publicada" value="NO" <?php if($row['publicada'] == 'NO'){ echo 'checked' ; } ?> > NO
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
              <input name="procesar" type="submit" id="procesar" value="Guardar" class="btn btn-primary pull-right" />
            </div>
          </div>

        </form>

      </div>

      <?php include('footer.php'); ?>    

    </div> <!-- /container -->




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Otras funciones -->

  </body>
</html>
