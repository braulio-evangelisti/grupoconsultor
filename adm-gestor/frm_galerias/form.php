<?php

  require('func.includes/seguridad.php');
        
  $urlubic = "";

  include_once("func.includes/config.inc.php");
  include_once("func.includes/utiles.inc.php");

  //Recuperamos OP
  $op     = secureParamToSql($_GET['op']);
  $origen = secureParamToSql($_GET['origen']);
  $idRef  = secureParamToSql($_GET['idRef']);
  
  //Si es ALTA, usamos el form para insertar con la accion CREATE
  if($op == 'alta/de/galerias') {

      $action         = 'create';
      $title          = 'Nuevo elemento';
      $panel_detalles = false;

  }

  //Si es EDICION, usamos el form para modificar con la accion UPDATE
  if($op == 'edicion/de/galerias') {
     
      $action         = 'update';
      $title          = 'Editar elemento';
      
      $id = secureParamToSql($_GET['id']);

      $row = $objGeneral->seleccionar_registro("galerias","idGaleria",$id);

      if ($row['tipo'] == 'i') {
        $panel_detalles = true;
      }
      
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
    <link href="css/summernote.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    
  </head>

  <body>

    <?php include('menu.php'); ?>

    <div class="container">

      <div class="row">

        <ol class="breadcrumb">
          <li><a href="proceso.php?op=panel/administracion">Home</a></li>
          <li class="active">Galeria</li>
          <a href="proceso.php?op=panel/galerias&amp;origen=<?php echo $origen; ?>&amp;id=<?php echo $idRef; ?>" class="btn btn-default btn-xs pull-right">Volver</a>
        </ol>

      </div>

      <!-- Título -->
      <div class="row">
        <div class="page-header">
          <h2><?php echo $title; ?> <small></small></h2>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-9">
        
          <?php echo $result; ?>
          
          <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified" role="tablist">

                <?php if($row['tipo'] == 'i'){ ?>
                  <li role="presentation" class="active" >
                      <a href="#imgTab" aria-controls="imgTab" role="tab" data-toggle="tab">Imagen</a>
                  </li>
                  <li class="disabled">
                    <a href="#">Video</a>
                  </li>

                <?php } elseif($row['tipo'] == 'v'){ ?>

                  <li class="disabled">
                    <a href="#">Imagen</a>
                  </li>
                  <li role="presentation" class="active">
                      <a href="#vidTab" aria-controls="vidTab" role="tab" data-toggle="tab">Video</a>
                  </li>

                <?php } else { ?>

                  <li role="presentation" class="active" >
                      <a href="#imgTab" aria-controls="imgTab" role="tab" data-toggle="tab">Imagen</a>
                  </li>
                  <li role="presentation">
                      <a href="#vidTab" aria-controls="vidTab" role="tab" data-toggle="tab">Video</a>
                  </li>

                <?php } ?>
              

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">

              <!-- TAB IMAGEN -->
              <div role="tabpanel" class="tab-pane <?php if($row['tipo'] != 'v'){ echo 'active'; } ?>" id="imgTab">
                <form action="frm_galerias/procesar.php?action=<?php echo $action; ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" role="form">
            
                  <input type="hidden" name="idOwner" class="idOwner" value="<?php echo $_SESSION['idUsuario']; ?>" />
                  <input type="hidden" name="origen" id="origen" value="<?php echo $origen; ?>" />
                  <input type="hidden" name="idContenido" id="idContenido" value="<?php echo $idRef; ?>" />
                  <input type="hidden" name="idGaleria" id="idGaleria" value="<?php echo $row['idGaleria']; ?>" />
                  <input type="hidden" name="imagenOld" id="imagenOld" value="<?php echo $row['imagen']; ?>" />
                  <input type="hidden" name="tipo" value="i" id="tipo_0" />

                  <?php if($row['imagen'] != ''){ ?>
                  <div class="form-group">
                    <label for="thumb" class="control-label">&nbsp;</label>
                      <img src="timthumb.php?src=<?php echo _global_siteurl; ?>adm-gestor/frm_galerias/<?php echo $row['imagen']; ?>&amp;w=900" class="thumbnail" style="width:100%;">
                  </div>
                  <?php } ?>

                  <div class="form-group">
                    <label for="titulo" class="control-label">Título</label>
                      <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo pathinfo($row['titulo'], PATHINFO_FILENAME); ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="imagen" class="control-label">Imagen</label>
                      <input type="file" name="imagen" id="imagen" value="<?php echo $row['imagen']; ?>" />
                  </div>

                  <div class="form-group">
                    <label for="alt" class="control-label">Texto alternativo</label>
                      <input type="text" name="alt" class="form-control" id="alt" value="<?php echo $row['alt']; ?>" required>
                  </div>

                  <div class="form-group">
                    <div class="">
                      <input name="procesar" type="submit" id="procesar" value="Guardar" class="btn btn-primary pull-right" />
                    </div>
                  </div>

                </form>

              </div>

              <!-- TAB VIDEO -->
              <div role="tabpanel" class="tab-pane <?php if($row['tipo'] == 'v'){ echo 'active'; } ?>" id="vidTab">
                
                <form action="frm_galerias/procesar.php?action=<?php echo $action; ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" role="form">
            
                  <input type="hidden" name="idOwner" class="idOwner" value="<?php echo $_SESSION['idUsuario']; ?>" />
                  <input type="hidden" name="origen" id="origen" value="<?php echo $origen; ?>" />
                  <input type="hidden" name="idContenido" id="idContenido" value="<?php echo $idRef; ?>" />
                  <input type="hidden" name="idGaleria" id="idGaleria" value="<?php echo $row['idGaleria']; ?>" />
                  <input type="hidden" name="imagenOld" id="imagenOld" value="<?php echo $row['imagen']; ?>" />
                  <input type="hidden" name="tipo" value="v" id="tipo_1" />

                  <?php if($row['urlVideo'] != ''){ ?>
                  <div class="form-group">
                    <label for="thumb" class="control-label">&nbsp;</label>
                      <p style="text-align:center;"> 
                        <?php echo getVideoEmbed($row['urlVideo']); ?>
                      </p>
                  </div>
                  <?php } ?>

                  <div class="form-group">
                    <label for="titulo" class="control-label">Título</label>
                      <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo pathinfo($row['titulo'], PATHINFO_FILENAME); ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="urlVideo" class="control-label">URL del video <small></small></label>
                      <input type="text" name="urlVideo" class="form-control" id="urlVideo" value="<?php echo $row['urlVideo']; ?>" placeholder="ejemplo: https://www.youtube.com/watch?v=nBFdvcF7auY" required>
                  </div>

                  <div class="form-group">
                    <label for="alt" class="control-label">Texto alternativo</label>
                      <input type="text" name="alt" class="form-control" id="alt" value="<?php echo $row['alt']; ?>" required>
                  </div>

                  <div class="form-group">
                    <div class="">
                      <input name="procesar" type="submit" id="procesar" value="Guardar" class="btn btn-primary pull-right" />
                    </div>
                  </div>

                </form>

              </div>
            </div>

          </div>

          

        </div>

        <div class="col-sm-3" style="padding-right:0;">
          <br>

          <?php if($panel_detalles){ ?>

            <div class="panel panel-info">
              <!-- Default panel contents -->
              <div class="panel-heading">Detalles</div>
              <?php 

                $ext = strtoupper(pathinfo($row['imagen'], PATHINFO_EXTENSION));
                list($ancho, $alto, $tipo, $atributos) = getimagesize("frm_galerias/" . $row['imagen']);
                $size = size_as_kb(filesize("frm_galerias/" . $row['imagen']));

              ?>
              <div class="panel-body">
                <p>
                  <i class="glyphicon glyphicon-calendar"></i> Subido en: <b><?php echo fecha_completa($row['add_date']); ?></b>
                </p>
                <!-- <p> Debe ser una url publica
                  URL del archivo:
                  <input type="text" class="" readonly="readonly" name="url" value="<?php echo _global_siteurl; ?>frm_galerias/<?php echo $row['imagen']; ?>" style="width:100%;">
                </p> -->
                <p style="text-overflow:ellipsis;overflow:hidden;">
                  Nombre de archivo: <b><?php echo $row['imagen']; ?></b>
                </p>
                <p>
                  Tipo de archivo: <b><?php echo $ext; ?></b>
                </p>
                <p>
                  Tamaño de archivo: <b><?php echo $size; ?></b>
                </p>
                <p>
                  Dimensiones: <b><?php echo $ancho . ' x ' . $alto; ?> </b>
                </p>
              </div>

            </div>

          <?php } ?>
          

        </div>

      </div>

      <?php include('footer.php'); ?>    

    </div> <!-- /container -->




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Otras funciones -->
    <script src="js/summernote.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#descripcion').summernote({
          height: 200,                 // set editor height

          minHeight: 100,             // set minimum height of editor
          maxHeight: 500,             // set maximum height of editor

          focus: true,                 // set focus to editable area after initializing summernote
        });
      });
    </script>

  </body>
</html>
