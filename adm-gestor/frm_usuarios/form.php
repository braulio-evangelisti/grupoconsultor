<?php

  require('func.includes/seguridad.php');
        
  $urlubic = "";

  include_once("func.includes/config.inc.php");
  include_once("func.includes/utiles.inc.php");

  //Recuperamos OP
  $op = secureParamToSql($_GET['op']);
  
  //Si es ALTA, usamos el form para insertar con la accion CREATE
  if($op == 'alta/de/usuarios') {

    $action   = 'create';
    $title    = 'Nuevo usuario';

  }

  //Si es EDICION, usamos el form para modificar con la accion UPDATE
  if($op == 'edicion/de/usuarios') {
     
    $action    = 'update';
    $title     = 'Editar usuario';
    
    $id = secureParamToSql($_GET['id']);

    $row = $objGeneral->seleccionar_registro("usuarios","idUsuario",$id);
      
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
          <li class="active">Usuarios</li>
          <a href="proceso.php?op=panel/usuarios" class="btn btn-default btn-xs pull-right">Volver</a>
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
        <form action="frm_usuarios/procesar.php?action=<?php echo $action; ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" role="form">
          
          <input type="hidden" name="idOwner" class="idOwner" value="<?php echo $_SESSION['idUsuario']; ?>" />
          <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $row['idUsuario']; ?>" />
          <input type="hidden" name="passwordOld" id="passwordOld" value="<?php echo $row['password']; ?>" />
          <input type="hidden" name="imagenOld" id="imagenOld" value="<?php echo $row['imagen']; ?>" />

          <div class="col-lg-9 contenido">

            <div class="form-group">
              <label for="nombre" class="control-label">Nombre</label>
              <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $row['nombre']; ?>" placeholder="Ingrese su nombre" required autofocus>
            </div>

            <div class="form-group">
              <label for="apellido" class="control-label">Apellido</label>
              <input type="text" name="apellido" class="form-control" id="apellido" value="<?php echo $row['apellido']; ?>" placeholder="Ingrese su apellido" required >
            </div>

            <div class="form-group">
              <label for="dni" class="control-label">DNI</label>
              <input type="text" name="dni" class="form-control" id="dni" value="<?php echo $row['dni']; ?>" placeholder="Número de DNI sin puntuación">
            </div>

            <div class="form-group">
              <label for="fecRegistro" class="control-label">Fecha de nacimiento</label>
              <input type="text" name="fecRegistro" class="form-control input-mask-date" id="fecRegistro" value="<?php echo fecha_to_esp($row['fecRegistro']); ?>" placeholder="dia/mes/año">
            </div>

            <div class="form-group">
              <label for="email" class="control-label">Email</label>
              <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email']; ?>" placeholder="ejemplo@dominio.com" required>
            </div>

            <div class="form-group">
              <label for="pais" class="control-label">País</label>
            
              <?php 
                $paises = $objGeneral->listar_registros("SELECT * from tbpaises"); 
                if($paises)
                {
              ?>
              <select name="idPais" id="pais" class="form-control select2" >
                <option>Seleccione un país</option>
                <?php 
                  foreach($paises as $pais)
                    {
                ?>
                <option value="<?php echo $pais['idPais']; ?>" <?php if($pais['idPais'] == $row['idPais']){ echo 'selected'; } ?> ><?php echo $pais['pais']; ?></option>
                <?php 
                    } 
                ?>
              </select>
              <?php 
                } 
              ?>
            
            </div>


            <div class="form-group">
              <label for="provincia" class="control-label">Provincia</label>
              <select name="idProvincia" id="provincia" class="form-control select2" >
                <option value="<?php echo $provincia['idProvincia']; ?>" ><?php echo $provincia['provincia']; ?></option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="localidad" class="control-label">Localidad</label>
              <select name="idLocalidad" id="localidad" class="form-control select2" >
                <option value="<?php echo $row['idLocalidad']; ?>" ><?php echo $localidad['localidad']; ?></option>
              </select>
            </div>

            <div class="form-group">
              <label for="userName" class="control-label">Nombre de usuario</label>
              <input type="text" name="userName" class="form-control" id="userName" value="<?php echo $row['userName']; ?>">
            </div>

            <div class="form-group">
              <label for="password" class="control-label">Password</label>
              <input type="password" name="password" class="form-control" id="password" value="<?php echo $row['password']; ?>" required >
            </div>
            
            <div class="form-group">
              <label for="nivelPermiso" class="control-label">Permisos</label>
              <select class="form-control input-sm" id="nivelPermiso" name="nivelPermiso" required>
                <option value="">Seleccione</option>
                <option value="0" <?php if($row['nivelPermiso'] == '0'){ echo 'selected="selected"' ; } ?>>Administrador</option>
                <option value="3" <?php if($row['nivelPermiso'] == '3'){ echo 'selected="selected"' ; } ?>>Colaborador</option>
                <option value="8" <?php if($row['nivelPermiso'] == '8'){ echo 'selected="selected"' ; } ?>>Cliente</option>
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
                    <label for="confirmado" class="control-label"><i class="glyphicon glyphicon-eye-open"></i> Estado</label>
                    <input type="radio" name="confirmado" value="SI" <?php if($row['confirmado'] == 'SI'){ echo 'checked' ; } ?> > Confirmado
                    <input type="radio" name="confirmado" value="NO" <?php if($row['confirmado'] == 'NO'){ echo 'checked' ; } ?> > Pendiente
                  </p>
                  <?php if($action == 'update'){ ?>
                  <p>
                    <i class="glyphicon glyphicon-calendar"></i> Ingresado el: <b><?php echo fecha_completa($row['add_date']); ?></b>
                  </p>
                  <?php } ?>

                </div>

                <div class="panel-footer" style="text-align: right;">
                  <?php if($action == 'update'){ ?>
                    <a href="#" class="delete-row pull-left" data-id="<?php echo $row['idUsuario']; ?>" alt="<?php echo $row['nombre']; ?>" title="Eliminar" style="margin-top:6px;"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
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
                    <img src="timthumb.php?src=<?php echo _global_siteurl; ?>adm-gestor/frm_usuarios/<?php echo $row['imagen']; ?>&amp;w=300" class="" style="width:100%;">
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
    <script src="js/jquery.maskedinput.min.js"></script>
    <script src="js/select2.js"></script>
    <script src="js/select2_locale_es.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        //Boton eliminar
        $('.panel-footer').on( 'click', 'a.delete-row', function(event) {

          var id      = $(this).attr('data-id');
          var idOwner = $('#idOwner').text();
          var nombre  = $(this).attr('alt');
          var url     = 'frm_usuarios/procesar.php?action=delete';
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

                $(location).attr('href', 'proceso.php?op=panel/usuarios');                
              }

            },
            error: function(data){
              alert('Ocurrio un error eliminando el registro');
            }

            });

          }

          event.preventDefault();

        });

        //Mascara para la fecha
        $.mask.definitions['~']='[+-]';
        $('.input-mask-date').mask('99/99/9999');

        //
        $("#pais").select2({
          placeholder: "Selecciona un valor",
        });
        $("#provincia").select2({
          placeholder: "Selecciona un valor",
        });
        $("#localidad").select2({
          placeholder: "Selecciona un valor",
        });
        
        //Get provincias
        $("#pais").change(function(){

          var id = $(this).find(":selected").val();
          var url = 'frm_usuarios/procesar.php';
          var dataString = 'idPais='+ id +'&action=getProv';

          var idProvincia;
          var provincia;

          $('#provincia').empty().append('<option></option>');
          $('#localidad').empty().append('<option></option>');

          $.ajax({                                      
            url: url,                                            
            data: dataString,   // tambien puede ser: data: { action: "getProv", idPais : id },                                 
            dataType: 'json', 
            beforeSend: function(url)
            {
              //alert(JSON.stringify(dataString, null, 4));
              $('#bgloading').fadeIn();
            },                    
            success: function(data)          
            {
                               
              $(data).each(function( key,value ) {
                //console.log(JSON.stringify(data, null, 4));
                idProvincia = data[key]['idProvincia'];
                provincia = data[key]['provincia'];

                $('#provincia').append('<option value="'+ idProvincia +'">'+ provincia +'</option>');

              });

              $('#bgloading').fadeOut();

              $("#provincia").select2("open");
                
            },
            error: function(result) {
              alert("No se encontraron datos para la opción seleccionada.");
              $('#bgloading').fadeOut();
            }
          });

        });
        
        //Get localidad
        $("#provincia").change(function(){

          var id = $(this).find(":selected").val();
          var url = 'frm_usuarios/procesar.php';
          var dataString = 'idProvincia='+ id +'&action=getLoc';

          var idLocalidad;
          var localidad;

          $('#localidad').empty().append('<option></option>');

          $.ajax({                                      
            url: url,                                            
            data: dataString,   // tambien puede ser: data: { action: "getLoc", idProvincia : id },                                 
            dataType: 'json', 
            beforeSend: function(url)
            {
              $('#bgloading').fadeIn();
              //alert(JSON.stringify(dataString, null, 4));
            },                    
            success: function(data)          
            {
                     
              $(data).each(function( key,value ) {
                //console.log(JSON.stringify(data, null, 4));
                idLocalidad = data[key]['idLocalidad'];
                localidad = data[key]['localidad'];

                $('#localidad').append('<option value="'+ idLocalidad +'">'+ localidad +'</option>');

              });

              $('#bgloading').fadeOut();

              $("#localidad").select2("open");
                
            },
            error: function(result) {
              alert("No se encontraron datos para la opción seleccionada.");
              $('#bgloading').fadeOut();
            }
          });

        });

      });
    </script>

  </body>
</html>
