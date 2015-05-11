<?php

  require('func.includes/seguridad.php');
        
  $urlubic = "";

  include_once($urlubic."func.includes/config.inc.php");
  include_once($urlubic."func.includes/utiles.inc.php");

  $sql = $objGeneral->listar_registros("SELECT * FROM usuarios WHERE eliminado = '0' ORDER BY add_date DESC");

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

    <title>Gestión de usuarios</title>

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
          <li class="active">Usuarios</li>
        </ol>

      </div>

      <!-- Título -->
      <div class="row">
        <div class="page-header">
          <h2>Usuarios <small></small><a href="proceso.php?op=alta/de/usuarios" class="btn btn-primary pull-right">Nuevo</a></h2>
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
                <th data-sort-initial="ascending">Nombre</th>
                <th data-hide="phone">Email</th>
                <th data-hide="phone,tablet">Nombre de usuario</th>
                <th data-sort-ignore="true" width="30">Acciones</th>
              </tr>
            </thead>

            <tbody>

              <?php 
              if($sql)
              {
                foreach($sql as $usuarios)
                  {
              ?>

                <tr>
                  <td><?php echo $usuarios['apellido'] . " " . $usuarios['nombre']; ?> </td>
                  <td><a href="mailto:<?php echo $usuarios['email']; ?>"><?php echo $usuarios['email']; ?></a></td>
                  <td><?php echo $usuarios['userName']; ?> </td>
                  <td>
                    <a href="proceso.php?op=edicion/de/usuarios&amp;id=<?php echo $usuarios['idUsuario']; ?>" class="btn btn-primary btn-xs" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a href="#" class="btn btn-danger btn-xs delete-row" data-id="<?php echo $usuarios['idUsuario']; ?>" alt="<?php echo $usuarios['nombre']; ?>" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
                  </td>
                </tr>

              <?php 
                  }
              } else {
              ?>
                <tr>
                  <td colspan="4" class="text-center">
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
                <td colspan="4" class="text-center">
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
          var url     = 'frm_usuarios/procesar.php?action=delete';
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
