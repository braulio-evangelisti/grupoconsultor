<?php

  require('func.includes/seguridad.php');
        
  $urlubic = "";

  include_once("func.includes/config.inc.php");
  include_once("func.includes/utiles.inc.php");

  //Recuperamos OP
  $op = secureParamToSql($_GET['op']);
  
  //Si es ALTA, usamos el form para insertar con la accion CREATE
  if($op == 'alta/de/institucionales') {

    $action   = 'create';
    $title    = 'Nuevo institucional';

  }

  //Si es EDICION, usamos el form para modificar con la accion UPDATE
  if($op == 'edicion/de/institucionales') {
     
    $action    = 'update';
    $title     = 'Editar institucional';
    
    $id = secureParamToSql($_GET['id']);

    $row = $objGeneral->seleccionar_registro("institucionales","idInstitucional",$id);
      
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
          <li class="active">Institucional</li>
          <a href="proceso.php?op=panel/institucionales" class="btn btn-default btn-xs pull-right">Volver</a>
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
        <form action="frm_institucionales/procesar.php?action=<?php echo $action; ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" role="form">
          
          <input type="hidden" name="idOwner" class="idOwner" value="<?php echo $_SESSION['idUsuario']; ?>" />
          <input type="hidden" name="idInstitucional" id="idInstitucional" value="<?php echo $row['idInstitucional']; ?>" />
          <input type="hidden" name="imagenOld" id="imagenOld" value="<?php echo $row['imagen']; ?>" />
          <input type="hidden" name="archivoOld" id="archivoOld" value="<?php echo $row['archivo']; ?>" />

          <div class="col-lg-9 contenido">

            <div class="form-group">
              <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo $row['titulo']; ?>" placeholder="Introduce el título aquí" required autofocus>
            </div>

            <?php if($action == 'update'){ ?>
            <div class="form-group">
              <label>Enlace permanente:</label> <i class="glyphicon glyphicon-new-window"></i> <a href="<?php echo _global_siteurl; ?>institucionales/<?php echo $row['idInstitucional']; ?>" target="_blank"><?php echo _global_siteurl; ?>institucionales/<?php echo $row['idInstitucional']; ?></a>
            </div>
            <?php } ?>

            <div class="form-group">
              <textarea name="descripcion" class="form-control" id="descripcion" rows="10" ><?php echo stripslashes($row['descripcion']); ?></textarea>
            </div>

            <div class="form-group">
              <label for="bajada" class="control-label">Bajada/Copete</label>
              <textarea name="copete" class="form-control" id="bajada" rows="3"><?php echo $row['copete']; ?></textarea>
            </div>

          </div> <!-- Fin col-9 -->

          <div class="col-lg-3 sidebar">

            <div class="panel panel-info">

                <div class="panel-heading">
                  <i class="glyphicon glyphicon-floppy-save"></i> Publicar
                </div>
                
                <div class="panel-body">

                  <p>
                    <label for="publicada" class="control-label"><i class="glyphicon glyphicon-eye-open"></i> Estado</label>
                    <input type="radio" name="publicada" value="SI" <?php if($row['publicada'] == 'SI'){ echo 'checked' ; } ?> > Publicado
                    <input type="radio" name="publicada" value="NO" <?php if($row['publicada'] == 'NO'){ echo 'checked' ; } ?> > Borrador
                  </p>
                  <?php if($action == 'update'){ ?>
                  <p>
                    <i class="glyphicon glyphicon-calendar"></i> Publicado el: <b><?php echo fecha_completa($row['add_date']); ?></b>
                  </p>
                  <?php } ?>

                </div>

                <div class="panel-footer" style="text-align: right;">
                  <?php if($action == 'update'){ ?>
                    <a href="#" class="delete-row pull-left" data-id="<?php echo $row['idInstitucional']; ?>" alt="<?php echo $row['titulo']; ?>" title="Eliminar" style="margin-top:6px;"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
                  <?php } ?>
                  <input name="procesar" type="submit" id="procesar" value="Guardar" class="btn btn-info btn-sm" />                  
                </div>

            </div>

            <div class="form-group">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <i class="glyphicon glyphicon-picture"></i> &nbsp;Imagen
                </div>
                <div class="panel-body">
                  <?php if($row['imagen'] != ''){ ?>
                    <img src="timthumb.php?src=<?php echo _global_siteurl; ?>adm-gestor/frm_institucionales/img/<?php echo $row['imagen']; ?>&amp;w=300" class="" style="width:100%;">
                  <?php } else { ?>
                    <p>Cargue una nueva imagen</p>
                  <?php } ?>
                  <p>
                    <input type="text" name="alt" class="form-control" id="alt" value="<?php echo $row['alt']; ?>" placeholder="Texto alternativo de la imagen" style="border-top-right-radius: 0;border-top-left-radius: 0;" >
                  </p>
                </div>
                <div class="panel-footer">
                  &nbsp;  
                  <div class="btn btn-default btn-xs pull-right uplMltBtn" title="Seleccionar imagen">
                    Cargar
                    <input type="file" name="imagen" id="imagen" value="<?php echo $row['imagen']; ?>" class="uplMlt" />
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <i class="glyphicon glyphicon-paperclip"></i> &nbsp;Archivo
                </div>
                <div class="panel-body">
                  <?php if($row['archivo'] != ''){ ?>
                    <?php if($row['archivo'] != ''){ echo '<strong><a href="frm_institucionales/'. $row['archivo'] .'" target="_blank"><i class="glyphicon glyphicon-paperclip text-primary"></i> ' . $row['archivo'] . '</a></strong>' ; } ?>
                  <?php } else { ?>
                    Cargue un archivo (solo PDF)
                  <?php } ?>
                </div>
                <div class="panel-footer">
                  &nbsp;  
                  <div class="btn btn-default btn-xs pull-right uplMltBtn" title="Seleccionar archivo">
                    Cargar
                    <input type="file" name="archivo" id="archivo" value="<?php echo $row['archivo']; ?>" class="uplMlt" />
                  </div>
                </div>
              </div>
            </div>

          </div> <!-- Fin sidebar -->

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
    <script src="js/summernote.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#descripcion').summernote({
          height: 300,                 // set editor height

          minHeight: 100,             // set minimum height of editor
          maxHeight: 500,             // set maximum height of editor

          focus: true,                 // set focus to editable area after initializing summernote
        });

        //Boton eliminar
        $('.panel-footer').on( 'click', 'a.delete-row', function(event) {

          var id      = $(this).attr('data-id');
          var idOwner = $('#idOwner').text();
          var nombre  = $(this).attr('alt');
          var url     = 'frm_institucionales/procesar.php?action=delete';
          /*var tr      = $(this).closest('tr');*/

          if ( confirm( "Esta seguro que desea eliminar " + nombre + "?" ) ) {

            $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: { id: id, idOwner: idOwner },
            success: function(data){

              //alert(JSON.stringify(data, null, 4));

              if(data.success){

                $(location).attr('href', 'proceso.php?op=panel/institucionales');                
              }

            },
            error: function(data){
              alert('Ocurrio un error eliminando el registro');
            }

            });

          }

          event.preventDefault();

        });

      });
    </script>

  </body>
</html>
