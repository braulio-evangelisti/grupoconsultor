<?php

  require('func.includes/seguridad.php');
        
  $urlubic = "";

  include_once($urlubic."func.includes/config.inc.php");

  $origen = secureParamToSql($_GET['origen']);
  $id = secureParamToSql($_GET['id']);

  $sql = $objGeneral->listar_registros("SELECT * FROM galerias WHERE idContenido=".$id." AND eliminado = 0 ORDER BY orden ASC");

  /* 
  * Recupera la fuente (Novedades, Institucional, etc)
  */
  switch($origen)
    {
      case "0":
      $ref = "novedades";
      break;

      case "1":
      $ref = "institucionales";
      break; 

      case "2":
      $ref = "portfolio";
      break; 

      case "3":
      $ref = "servicios";
      break;             
    }

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

    <title>Gestión de galerias</title>

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
          <li class="active">Galeria</li>
          <a href="proceso.php?op=panel/<?php echo $ref; ?>" class="btn btn-default btn-xs pull-right">Volver</a>
        </ol>

      </div>

      <!-- Título -->
      <div class="row">
        <div class="page-header info">
          <h2>
            Galeria 
            <small>
              <i class="glyphicon glyphicon-info-sign" data-html="true" data-toggle="tooltip" data-placement="right" title="- Arrastre para cambiar el orden. <br />- Click para editar elemento. <br />- Click en la papelera para eliminar."></i>
            </small>
            <a href="proceso.php?op=alta/de/galerias&amp;origen=<?php echo $origen; ?>&amp;idRef=<?php echo $id; ?>" class="btn btn-primary pull-right" title="Agregar un elemento a la galeria">Nuevo</a>
          </h2>
        </div>
      </div>

      <div class="row">

      <?php 
        if($sql)
        {
      ?>

        <div id="sortable-thumbs" class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
               
      <?php
          foreach($sql as $imagen)
            {
      ?>

          <div id="<?php echo $imagen['idGaleria']; ?>" class="imagen" >
          <!-- <div style="float:left;margin-right:10px;"> -->
            <?php if($imagen['imagen'] != ''){ ?>
              <a href="proceso.php?op=edicion/de/galerias&amp;origen=<?php echo $origen; ?>&amp;idRef=<?php echo $id; ?>&amp;id=<?php echo $imagen['idGaleria']; ?>" title="Editar">
                <img src="timthumb.php?src=<?php echo _global_siteurl; ?>adm-gestor/frm_galerias/<?php echo $imagen['imagen']; ?>&amp;w=147&amp;h=147" class="thumbnail">
              </a>  
            <?php } elseif($imagen['urlVideo'] != '') { ?>
              <a href="proceso.php?op=edicion/de/galerias&amp;origen=<?php echo $origen; ?>&amp;idRef=<?php echo $id; ?>&amp;id=<?php echo $imagen['idGaleria']; ?>" title="Editar">
                <img src="timthumb.php?src=<?php echo video_image($imagen['urlVideo']); ?>&amp;w=147&amp;h=147" class="thumbnail">
              </a>
            <?php } else { ?>
              Sin imagen
            <?php } ?>
            
            <a href="#" class="delete-gal" data-id="<?php echo $imagen['idGaleria']; ?>" alt="<?php echo $imagen['titulo']; ?>" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
          </div>

      <?php 
            }
      ?>

        </div>

      <?php
        } else {
      ?>

        <div class="col-xs-9">
          No se encontraron registros
        </div>
          
      <?php
        }
      ?>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" style="padding-right:0;">
          
          <form action="frm_galerias/procesar.php?action=uploadMulti" method="POST" enctype="multipart/form-data" role="form">
            <input type="hidden" name="idOwner" class="idOwner" value="<?php echo $_SESSION['idUsuario']; ?>" />
            <input type="hidden" name="origen" id="origen" value="<?php echo $origen; ?>" />
            <input type="hidden" name="idContenido" id="idContenido" value="<?php echo $id; ?>" />
            <input type="hidden" name="tipo" value="i" id="tipo_0" />

            <div class="panel panel-info">

                <div class="panel-heading">
                  Múltiples elementos 
                  <div class="btn btn-info btn-xs pull-right uplMltBtn" title="Seleccionar archivos">
                    <i class="glyphicon glyphicon-folder-open"></i>
                    <input id="uploadFile" type="file" name="imagen[]" class="uplMlt" multiple required/>
                  </div>
                </div>
                
                <div class="panel-body">

                  <p>
                    <div id="imagePreview">Seleccione archivos para subir<br><small>(solo formato de imágenes)</small></div>
                  </p>

                </div>

                <div class="panel-footer">
                  &nbsp;                  
                  <input type="submit" value="Subir" class="btn btn-info btn-xs pull-right" title="Subir imagenes">
                </div>

            </div>

          </form>

          <?php echo $result; ?>

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
    
    <script type="text/javascript" src="js/mootools-1.2.3.js"></script>
    <script type="text/javascript" src="js/mootools-1.2.3.1-more.js"></script>

    <script>
      $(document).ready(function(){

        document.ondragstart = function () { return false; };

        $("#sortable-thumbs").on("mouseenter", function() {

            var sb = new Sortables('sortable-thumbs', {
            /* set options */
            clone:true,
            revert: true,
            /* initialization stuff here */
            initialize: function() {
                      
            },
            /* once an item is selected */
            onStart: function(el,cl) {       
              el.setStyle('opacity','0');
              el.setStyle('filter','alpha(opacity=0)');
              el.setStyle('z-index','1');        
            },
            onSort: function(el, clone){
              sorted = true;
            },
            /* when a drag is complete */
            onComplete: function(el) {
              el.setStyle('opacity','1');
              el.setStyle('filter','alpha(opacity=1)');
              el.setStyle('z-index','0');
              
              if(sorted) {
                  sorted = false; // clear it out again
                  
                    //build a string of the order
                    var sort_order = '';          
                    sort_order = sb.serialize();
                    
                    //do an ajax request
                    var req = new Request({
                        url:'frm_galerias/saveSort.php',
                        method:'post',
                        autoCancel:true,
                        data:'sort_order=' + sort_order,
                        onRequest: function() {},
                        onSuccess: function(data) {
                          /*alert(data);*/
                           //update divs if needed
                        }
                      }).send();
                      
                    }
              
            }
          });
        });

        //Boton eliminar de cada fila
        $('.imagen').on( 'click', 'a.delete-gal', function(event) {

          var id      = $(this).attr('data-id');
          var idOwner = $('#idOwner').text();
          var nombre  = $(this).attr('alt');
          var url     = 'frm_galerias/procesar.php?action=delete';
          var tr      = $(this).closest('.imagen');

          if ( confirm( "Esta seguro que desea eliminar " + nombre + "?" ) ) {

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

        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })

        $(function() {
          $("#uploadFile").on("change", function()
          { 

            $("#imagePreview").empty();

            if (this.files && this.files[0]) {
              $(this.files).each(function () {

                var name = this.name;
                var ext = '';
                var size = this.size;
                var reader = new FileReader();

                reader.readAsDataURL(this);
                ext = name.substr( (name.lastIndexOf('.') +1) );
                size = humanFileSize(size);

                reader.onload = function (e) {
                    $("#imagePreview").append("<p style='width:100%;float:left;border-bottom:1px solid #CCC;'><img class='thumb' src='" + e.target.result + "' style='float:left;max-widht:50px;max-height:50px;margin-bottom:5px;'><b class='pull-right' style='text-align:right;text-transform:uppercase;'>" + ext + "<br>" + size + "</b></p>");
                }

              });
            } else {

              $("#imagePreview").empty();

            }

          });
        });

        function humanFileSize(size) {
            var i = Math.floor( Math.log(size) / Math.log(1024) );
            return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
        };

      });
    </script>

  </body>
</html>
