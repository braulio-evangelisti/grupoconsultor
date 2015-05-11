<?php

  require('func.includes/seguridad.php');
        
  $urlubic = "";

  include_once("func.includes/config.inc.php");
  include_once("func.includes/utiles.inc.php");

  //Recuperamos OP
  $op = secureParamToSql($_GET['op']);
  
  //Si es ALTA, usamos el form para insertar con la accion CREATE
  if($op == 'alta/de/categorias') {

    $action   = 'create';
    $title    = 'Nueva categoria';

  }

  //Si es EDICION, usamos el form para modificar con la accion UPDATE
  if($op == 'edicion/de/categorias') {
     
    $action    = 'update';
    $title     = 'Editar categoria';
    
    $id = secureParamToSql($_GET['id']);

    $row = $objGeneral->seleccionar_registro("categorias","idCategoria",$id);
      
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
    <link href="css/select2.css" rel="stylesheet">
    <link href="css/select2-bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    
  </head>

  <body>

    <?php include('menu.php'); ?>

    <div class="container">

      <div class="row">

        <ol class="breadcrumb">
          <li><a href="proceso.php?op=panel/administracion">Home</a></li>
          <li class="active">Categorias</li>
          <a href="proceso.php?op=panel/categorias" class="btn btn-default btn-xs pull-right">Volver</a>
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
        <form action="frm_categorias/procesar.php?action=<?php echo $action; ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" role="form">
          
          <input type="hidden" name="idOwner" class="idOwner" value="<?php echo $_SESSION['idUsuario']; ?>" />
          <input type="hidden" name="idCategoria" id="idCategoria" value="<?php echo $row['idCategoria']; ?>" />

          <div class="col-lg-9 contenido">

            <div class="form-group">
              <label for="nombre" class="control-label">Nombre</label>
              <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $row['nombre']; ?>" placeholder="Ingrese el nombre de la categoria (sin espacios)" required autofocus>
            </div>            
            
            <div class="form-group">
              <label for="tipo" class="control-label">Tipo</label>
              <select class="form-control input-sm" id="tipo" name="tipo" required>
                <option value="">Seleccione</option>
                <option value="novedad" <?php if($row['tipo'] == 'novedad'){ echo 'selected="selected"' ; } ?>>Novedad</option>
                <option value="institucional" <?php if($row['tipo'] == 'institucional'){ echo 'selected="selected"' ; } ?>>Institucional</option>
                <option value="portfolio" <?php if($row['tipo'] == 'portfolio'){ echo 'selected="selected"' ; } ?>>Portfolio</option>
                <option value="servicios" <?php if($row['tipo'] == 'servicios'){ echo 'selected="selected"' ; } ?>>Servicios</option>
              </select>
            </div>

            

          </div> <!-- Fin col-9 -->

          <div class="col-lg-3 sidebar">

            <div class="panel panel-info">

                <div class="panel-heading">
                  <i class="glyphicon glyphicon-floppy-save"></i> Publicar
                </div>
                
                <div class="panel-body">

                  <p>
                    <label for="Publicada" class="control-label"><i class="glyphicon glyphicon-eye-open"></i> Estado</label>
                    <input type="radio" name="publicada" value="SI" <?php if($row['publicada'] == 'SI'){ echo 'checked' ; } ?> > Publicada
                    <input type="radio" name="publicada" value="NO" <?php if($row['publicada'] == 'NO'){ echo 'checked' ; } ?> > Borrador
                  </p>
                  <?php if($action == 'update'){ ?>
                  <p>
                    <i class="glyphicon glyphicon-calendar"></i> Creada el: <b><?php echo fecha_completa($row['add_date']); ?></b>
                  </p>
                  <?php } ?>

                </div>

                <div class="panel-footer" style="text-align: right;">
                  <?php if($action == 'update'){ ?>
                    <a href="#" class="delete-row pull-left" data-id="<?php echo $row['idCategoria']; ?>" alt="<?php echo $row['nombre']; ?>" title="Eliminar" style="margin-top:6px;"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
                  <?php } ?>
                  <input name="procesar" type="submit" id="procesar" value="Guardar" class="btn btn-info btn-sm" />                  
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

    <script type="text/javascript">
      $(document).ready(function() {
        //Boton eliminar
        $('.panel-footer').on( 'click', 'a.delete-row', function(event) {

          var id      = $(this).attr('data-id');
          var idOwner = $('#idOwner').text();
          var nombre  = $(this).attr('alt');
          var url     = 'frm_categorias/procesar.php?action=delete';
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

                $(location).attr('href', 'proceso.php?op=panel/categorias');                
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
