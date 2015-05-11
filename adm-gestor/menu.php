<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand label-info" href="proceso.php?op=panel/administracion" title="Pantalla de inicio"><i class="glyphicon glyphicon-home"></i></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-th-large"></i> Contenidos
          <ul class="dropdown-menu" role="menu">
            <li><a href="proceso.php?op=panel/slider">Slider</a></li>
            <li><a href="proceso.php?op=panel/portfolio">Portfolio</a></li>
            <li><a href="proceso.php?op=panel/novedades">Blog/Novedades</a></li>
            <li><a href="proceso.php?op=panel/institucionales">Institucional</a></li>
            <li><a href="proceso.php?op=panel/servicios">Servicios</a></li>
          </ul>
        </li>   

        <li><a href="proceso.php?op=panel/categorias"><i class="glyphicon glyphicon-tags"></i> &nbsp;Categorias</a></li>

        <?php if($_SESSION['NIVEL'] == 0){ ?>
          <li><a href="proceso.php?op=panel/usuarios"><i class="glyphicon glyphicon-user"></i> Usuarios</a></li>
        <?php } ?>

        <li><a href="<?php echo _global_siteurl; ?>" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> Visitar sitio</a></li>

      </ul>

      <ul class="nav navbar-nav navbar-right">
                
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bienvenido, <?php echo $_SESSION['USERNAME']; ?> 
            &nbsp; 
            <?php if($_SESSION['AVATAR'] != ''){ ?>
              <img src="<?php echo _global_siteurl; ?>adm-gestor/frm_usuarios/<?php echo $_SESSION['AVATAR']; ?>" class="hidden-xs" width="20" height="20">
            <?php } ?>
            <span style="display:none;" id="idOwner"><?php echo $_SESSION['idUsuario']; ?></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="proceso.php?op=edicion/de/usuarios&amp;id=<?php echo $_SESSION['idUsuario']; ?>">Editar mi perfil</a></li>
            <li><a href="proceso.php?op=logout" title="Salir">Cerrar sesión</a></li>
          </ul>
        </li> 

      </ul>

    </div><!--/.nav-collapse -->
  </div>
</div>