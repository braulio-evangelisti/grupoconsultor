<?php

  require('func.includes/seguridad.php');
        
  $urlubic = "";

  include_once($urlubic."func.includes/config.inc.php");
  include_once($urlubic."func.includes/utiles.inc.php");

  $sql = $objGeneral->listar_registros("SELECT * FROM novedades WHERE eliminado = '0' ORDER BY add_date DESC");

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

    <title>Gestión de novedades</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/footable.core.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
  </head>

  <body>

    <?php include('menu.php'); ?>

    <div class="container">
      
      <div class="row">

        <ol class="breadcrumb">
          <li><a href="proceso.php?op=panel/administracion">Home</a></li>
          <li class="active">Novedades</li>
        </ol>

      </div>

      <!-- Título -->
      <div class="row">
        <div class="page-header">
          <h2>Novedades <small></small><a href="proceso.php?op=alta/de/novedades" class="btn btn-primary pull-right">Nuevo</a></h2>
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
                <th data-sort-ignore="true" width="30" data-hide="all"></th>
                <th data-toggle="true">Título</th>
                <th data-sort-initial="descending" data-hide="phone,tablet" width="100">Fecha</th>
                <th width="100">Estado</th>
                <th data-sort-ignore="true" width="130">Acciones</th>
              </tr>
            </thead>

            <tbody>

              <?php 
              if($sql)
              {
                foreach($sql as $novedades)
                  {
              ?>

                <tr>
                  
                  <td>
                      <?php if($novedades['imagen'] != ''){ ?>
                        <img src="timthumb.php?src=<?php echo _global_siteurl; ?>adm-gestor/frm_novedades/img/<?php echo $novedades['imagen']; ?>&amp;w=300" height="150" class="thumbnail">
                      <?php } else { ?>
                        Sin imagen
                      <?php } ?>
                  </td>
                  
                  <td><?php echo ucfirst($novedades['titulo']); ?> </td>
                  <td><?php echo fecha_to_esp($novedades['add_date']); ?> </td>
                  <td><?php if($novedades['publicada'] == 'SI'){ echo '<span class="label label-success">Publicado</span>';}else{ echo '<span class="label label-danger">Borrador</span>';} ?> </td>
                  <td>
                    <a href="proceso.php?op=panel/galerias&amp;origen=0&amp;id=<?php echo $novedades['idNovedad']; ?>" class="btn btn-primary btn-xs" title="Galeria"><i class="glyphicon glyphicon-picture"></i></a>
                    <a href="proceso.php?op=edicion/de/novedades&amp;id=<?php echo $novedades['idNovedad']; ?>" class="btn btn-info btn-xs" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                    
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="Compartir">
                        <i class="glyphicon glyphicon-share"></i> 
                      </button>
                      <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li role="presentation" class="dropdown-header">Compartir</li>
                        <li>
                          <a title="Compartir en Facebook" class="social" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo _global_siteurl; ?>novedades/<?php echo $novedades['idNovedad']; ?>" onClick="MyWindow=window.open(this.href,'MyWindow','scrollbars=no,menubar=no,height=300,width=600,resizable=no,toolbar=no,location=no,status=no'); return false;">
                            <i class="fa fa-facebook"></i> Facebook
                          </a>
                        </li>
                        <li>
                          <a title="Compartir en Twitter" class="social" href="https://twitter.com/home?status=<?php echo $novedades['titulo']; ?>: <?php echo _global_siteurl; ?>novedades/<?php echo $novedades['idNovedad']; ?> (via @grafitodd)" onClick="MyWindow=window.open(this.href,'MyWindow','scrollbars=no,menubar=no,height=300,width=600,resizable=no,toolbar=no,location=no,status=no'); return false;">
                            <i class="fa fa-twitter"></i> Twitter
                          </a>
                        </li>
                        <li>
                          <a title="Compartir en Google+" class="social" href="https://plus.google.com/share?url=<?php echo _global_siteurl; ?>novedades/<?php echo $novedades['idNovedad']; ?>" onClick="MyWindow=window.open(this.href,'MyWindow','scrollbars=no,menubar=no,height=300,width=600,resizable=no,toolbar=no,location=no,status=no'); return false;">
                            <i class="fa fa-google-plus"></i> Google+
                          </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                          <a title="Compartir en LinkedIn" class="social" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo _global_siteurl; ?>novedades/<?php echo $id; ?>&amp;title=<?php echo $novedades['titulo']; ?>&amp;summary=&amp;source=" onClick="MyWindow=window.open(this.href,'MyWindow','scrollbars=no,menubar=no,height=300,width=600,resizable=no,toolbar=no,location=no,status=no'); return false;">
                            <i class="fa fa-linkedin"></i> LinkedIn
                          </a>
                        </li>
                      </ul>
                    </div>
                    
                    <a href="#" class="btn btn-danger btn-xs delete-row" data-id="<?php echo $novedades['idNovedad']; ?>" alt="<?php echo $novedades['titulo']; ?>" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>

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
          var url     = 'frm_novedades/procesar.php?action=delete';
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
