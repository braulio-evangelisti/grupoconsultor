<?php

  require('func.includes/seguridad.php');
        
  $urlubic = "";

  include_once($urlubic."func.includes/config.inc.php");
  include_once($urlubic."func.includes/utiles.inc.php");

  $sql = $objGeneral->listar_registros("SELECT * FROM slider WHERE eliminado = 0 ORDER BY orden ");

  //Definimos alert segun resultado de operacion EDICION
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

    <title>Gestión de slider</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/footable.core.css" rel="stylesheet" type="text/css" />
    <!-- <link href="css/footable.metro.css" rel="stylesheet" type="text/css" /> -->
    
  </head>

  <body>

    <?php include('menu.php'); ?>

    <div class="container">

      <div class="row">

        <ol class="breadcrumb">
          <li><a href="proceso.php?op=panel/administracion">Home</a></li>
          <li class="active">Slider</li>
        </ol>

      </div>

      <!-- Título -->
      <div class="row">
        <div class="page-header">
          <h2>Slider <small></small><a href="proceso.php?op=alta/de/slider" class="btn btn-primary pull-right">Nuevo</a></h2>
        </div>
      </div>

      <div class="row">
        <?php echo $result; ?>
        <p>
          Buscar: <input id="filter" type="text">
        </p>
        <table class="table table-condensed table-hover footable toggle-square" data-filter="#filter" data-page-size="10">

            <thead>
              <tr>
                <th data-sort-ignore="true" width="200" data-hide="phone,tablet"></th>
                <th data-toggle="true">Título</th>
                <th data-sort-ignore="true" data-hide="phone,tablet" width="50">Orden</th>
                <th data-hide="phone" width="100">Estado</th>
                <th data-sort-ignore="true" width="30">Acciones</th>
              </tr>
            </thead>

            <tbody>

              <?php 
              if($sql)
              {
                foreach($sql as $slide)
                  {
              ?>

                <tr>
                  
                  <td>
                      <?php if($slide['imagen'] != ''){ ?>
                        <img src="<?php _global_siteurl; ?>frm_slider/<?php echo $slide['imagen']; ?>" height="80" class="thumbnail">
                      <?php } else { ?>
                        Sin imagen
                      <?php } ?>
                  </td>
                  
                  <td><?php echo ucfirst($slide['titulo']); ?> </td>
                  <td><?php echo $slide['orden']; ?> </td>
                  <td><?php if($slide['publicada'] == 'SI'){ echo '<span class="label label-success">Publicado</span>';}else{ echo '<span class="label label-danger">Borrador</span>';} ?> </td>
                  <td>
                    <a href="proceso.php?op=edicion/de/slider&amp;id=<?php echo $slide['idSlide']; ?>" class="btn btn-primary btn-xs" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a href="#" class="btn btn-danger btn-xs delete-row" data-id="<?php echo $slide['idSlide']; ?>" alt="<?php echo $slide['titulo']; ?>" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
                  </td>
                </tr>

              <?php 
                  }
              } else {
              ?>
                <tr>
                  <td colspan="5" class="text-center">
                    No se encontraron registros
                  </td>
                </tr>
              <?php
                }
              ?>
                            
            </tbody>

            <!-- FOOTER DE LA TABLA -->
            <tfoot>
              <tr>
                <td colspan="5" class="text-center">
                  <ul class="pagination pagination-centered pagination-sm hide-if-no-paging"></ul>
                </td>
              </tr>
            </tfoot>

          </table>


      </div>

      <?php include('footer.php'); ?>    

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Footable -->
    <script src="js/footable.js" type="text/javascript"></script>
    <script src="js/footable.sort.js" type="text/javascript"></script>
    <script src="js/footable.filter.js" type="text/javascript"></script>
    <script src="js/footable.paginate.js" type="text/javascript"></script>

    <!-- Otras funciones -->
    <script>
      $(document).ready(function(){

        //Inicializa la tabla      
        $('.footable').footable();

        //Boton eliminar de cada fila
        $('.footable').on( 'click', 'a.delete-row', function(event) {

          var id      = $(this).attr('data-id');
          var idOwner = $('#idOwner').text();
          var nombre  = $(this).attr('alt');
          var url     = 'frm_slider/procesar.php?action=delete';
          var tr      = $(this).closest('tr');

          if ( confirm( "Esta seguro que desea eliminar a " + nombre + "?" ) ) {

            $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: { id: id, idOwner: idOwner },
            success: function(data){

              //alert(JSON.stringify(data, null, 4));

              if(data.success){

                tr.fadeOut(1000,function(){ 
                    tr.remove();                    
                });
                
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
