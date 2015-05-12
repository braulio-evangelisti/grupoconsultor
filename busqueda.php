<?php 

  $urlubic = "adm-gestor/";
  include_once($urlubic . "func.includes/config.inc.php");
  include_once($urlubic . "func.includes/utiles.inc.php");
  
  $id = secureParamToSql($_GET['idBusqueda']);

  $sql = "SELECT * FROM novedades WHERE idNovedad = '".$id ."' AND eliminado = 0";
  $result = $db->Execute($sql);
  $row = $result->fields;

  $categoria = $objGeneral->seleccionar_registro('categorias','idCategoria', $row['idCategoria']);
        
?>
<!doctype html>
<html lang="en" class="no-js" dir="ltr">
    <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $publicTitle . " - " . $row['titulo']; ?></title>
        <meta name="keyword" content="<?php echo $metaKeywords; ?>">
        <meta name="description" content="<?php echo $metaDesc; ?>">
        <meta name="author" content="<?php echo $metaAuth; ?>">
        
        <meta name="description" content="<?php echo stripslashes($row['descripcion']); ?>" />
		<meta name="twitter:card" value="summary">
		<meta property="og:title" content="<?php echo $row['titulo']; ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="http://www.grupoconsultorrrhh.com.ar/busqueda.php?idBusqueda=<?php echo $id; ?>" />
		<meta property="og:image" content="<?php echo _global_siteurl; ?>adm-gestor/frm_novedades/img/<?php echo $row['imagen']; ?>" />
		<meta property="og:description" content="<?php echo stripslashes($row['descripcion']); ?>" />

        <!-- Favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
		<link rel="manifest" href="favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800|Varela' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="styles/screen.css">

        <!-- Magnific Popup core CSS file -->
		<link rel="stylesheet" href="styles/magnific-popup.css"> 

        <script src="scripts/components/require.js" data-main="scripts/options"></script>

    </head>
	<body data-preloader="on">
    <!--[if lt IE 9]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <div id="home" data-smooth-scroll="on">

        <section class="box-intro-page bg-black" data-box-img="images/bus-header.jpg">
            <div class="box-img"><span></span></div>
                <div class="container intro-center">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="text-center text-alpha uppercase">
                                <i class="icon-334 font-3x"></i>
                                <h4 class="no-margin"><b><?php echo $row['titulo']; ?></b></h4>
                            </div>
                        </div>
                    </div> 
                </div>
        </section>

        <header class="main-header" data-sticky="true">
            <section class="header-navbar bg-alpha" data-menu-scroll="true">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 col-xs-4">
                            <figure class="identity">
                            	<a href="index.php">
                            		<img alt="Theme logo" src="images/logo.png">
                            	</a>
                            </figure>
                        </div> 
                        <div class="col-sm-10 col-xs-8">
                            <nav class="main-nav">
                            	<a href="#" class="responsive-menu align-right"><i class="icon-333 font-2x text-white"></i></a>
                            	<ul class="inline-list align-right uppercase"> 
                            		<li><a href="index.php#busquedas">Volver</a></li>
                            	</ul>
                            </nav>
                        </div> 
                    </div> 
                </div> 
            </section> 
        </header> 

		<section class="box-breadcrumbs box-sep">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="breadcrumbs-links uppercase align-center">
							<ul class="inline-list text-grey">
								<li>
									<a href="index.php">Home</a>
								</li>
								<li>Búsquedas activas</li>
							</ul>
						</div>
					</div>
				</div> 
			</div> 
		</section> 

		<section class="box">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<ul class="clean-list posts-loop">
							<li class="post-item">
								<div class="post-share">
									<a href="#" class="close-box"><i class="icon-120 font-2x"></i></a>
									<ul class="inline-list social-networks text-white align-center">									
										<li class="facebook-network">
											<a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo _global_siteurl; ?>busqueda.php?idBusqueda=<?php echo $id; ?>"><i class="icon-182"></i></a>
										</li>
										<li class="twitter-network">
											<a href="https://twitter.com/home?status=<?php echo $row['titulo']; ?>: <?php echo _global_siteurl; ?>busqueda.php?idBusqueda=<?php echo $id; ?> (via @<?php echo $meta['twitter']; ?>)"><i class="icon-510"></i></a>
										</li>
										<li class="linkedin-network">
											<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo _global_siteurl; ?>busqueda.php?idBusqueda=<?php echo $id; ?>&amp;title=<?php echo $row['titulo']; ?>"><i class="icon-297"></i></a>
										</li>
									</ul>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php if($row['imagenmd'] != ''){ ?>
						              	<figure class="text-center post-thumb">
											<img src="images/load.svg" data-src="<?php echo _global_siteurl; ?>adm-gestor/frm_novedades/img/<?php echo $row['imagenmd']; ?>" alt="<?php echo $row['alt']; ?>">
											<figcaption>
												<span class="bg-alpha"><i class="icon-79"></i></span>
											</figcaption>
										</figure>
							            <?php } ?>
									</div>
									<div class="col-md-12">
										<div class="post-content">
											<h5 class="font-alpha post-title uppercase"><b><?php echo $row['titulo']; ?></b></h5>
											<p><?php echo $row['copete']; ?></p>
											<p><?php echo stripslashes($row['descripcion']); ?></p>
											
											<?php if($row['archivo'] != ''){ ?>
								            <p>
							              		<strong>
							              			<a href="<?php _global_siteurl; ?>adm-gestor/frm_novedades/<?php echo $row['archivo']; ?>" target="_blank">
							              				<img src="<?php _global_siteurl; ?>adm-gestor/img/files/<?php echo substr($row['archivo'], -3); ?>.png" alt="<?php echo $row['archivo']; ?>" style="height:30px;" > Descargar archivo
							              			</a>
							              		</strong>
								            </p>
								            <?php } ?>
								            <hr>

											<!-- Galeria -->
											<?php
							              		$sqlG = $objGeneral->listar_registros("SELECT * FROM galerias WHERE idContenido = ".$row['idNovedad']." AND eliminado=0 ORDER BY orden ASC");
							              		if($sqlG)
							              		{
								            ?>
											<div>
												<ul class="row" style="padding-left:0px;">
													<?php
										                foreach($sqlG as $rowG)
										                {
										                  if(strpos($rowG['urlVideo'], 'youtube')){
									              	?>
									              	<li class="col-sm-2">
														<figure>
															<a class="image-link mfp-iframe" href="<?php echo $rowG['urlVideo']; ?>">
																<img src="<?php echo video_image($rowG['urlVideo']); ?>" alt="<?php echo $rowG['alt']; ?>" style="opacity: 1; display: inline;">
															</a>
														</figure>
													</li>
									              	<?php
									                  	} elseif(strpos($rowG['urlVideo'], 'vimeo')) {  
									              	?>
									              	<li class="col-sm-2">
														<figure>
															<a class="image-link mfp-iframe" href="<?php echo $rowG['urlVideo']; ?>">
																<img src="<?php echo video_image($rowG['urlVideo']); ?>" alt="<?php echo $rowG['alt']; ?>" style="opacity: 1; display: inline;">
															</a>
														</figure>
													</li>
									              	<?php
								                  		} else {  
									              	?>
													<li class="col-sm-2">
														<figure>
															<a class="image-link" href="<?php echo _global_siteurl; ?>adm-gestor/frm_galerias/<?php echo $rowG['imagen']; ?>">
																<img src="<?php echo _global_siteurl; ?>adm-gestor/frm_galerias/<?php echo $rowG['imagensm']; ?>" alt="<?php echo $rowG['alt']; ?>" style="opacity: 1; display: inline;">
															</a>
														</figure>
													</li>
													<?php 
									                  		}
										                } 
									              	?>
												</ul>
											</div>
											<?php 
									            }
								          	?>
											<!-- Fin galeria -->
											<br>
											<div class="post-meta">
												<div class="row">
													<div class="col-md-8">
														<ul class="inline-list text-grey meta-list">
															<li><?php echo fecha_completa($row['add_date']); ?></li>
															<!-- <li>by
																<a href="#" class="text-alpha uppercase">unik <span><img src="images/load.svg" data-src="http://placehold.it/50x50/222/aaa" alt="avatar"></span></a>
															</li> -->
														</ul>
													</div>
													<div class="col-md-4">
														<ul class="inline-list meta-social align-right">
															<li>
																<a href="#" class="blog-sharing"><i class="icon-410"></i> Compartir</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<div class="tag-box">
							<ul class="inline-list uppercase">
								<li>
									<span>Categoria:</span>
								</li>
								<li><a href="#"><?php echo $categoria['nombre']; ?></a></li>
							</ul>
						</div>

					</div>

					<div class="col-md-3">
						<aside class="main-sidebar row" data-masonry=".widget">
							
							<div class="widget widget-text col-md-12 col-sm-6">
								<h6 class="uppercase widget-title">Sobre nosotros</h6>
								
								<div class="widget-content style-alpha">
									Nos espacializamos en consultoria externa integral de recursos humanos, brindando asesoramiento en selección de personal, evaluaciones psicotecnicas, evaluaciones de desempeño por competencias, capacitacion y desarrollo organizacional.
								</div>
							</div> 
							
							<div class="widget widget-recent-posts col-md-12 col-sm-6">
								<h6 class="uppercase widget-title">Búsquedas recientes</h6>
								
								<div class="widget-content style-alpha">
									<ul class="clean-list recent-posts-loop">
										<?php 
											$sqlNov = $objGeneral->listar_registros("SELECT * FROM novedades WHERE idNovedad != ".$id." AND idCategoria = '1' AND publicada = 'SI' AND eliminado = '0' ORDER BY add_date DESC LIMIT 0,4"); 

											if($sqlNov != '')
											{
									            foreach($sqlNov as $nov)
									            {
										?>
										<li class="row row-fit">
											<div class="col-sm-4">
												<figure>
													<?php if($nov['imagensm'] != ''){ ?>
													<a href="busqueda.php?idBusqueda=<?php echo $nov['idNovedad']; ?>">
														<img src="images/load.svg" data-src="<?php echo _global_siteurl; ?>adm-gestor/frm_novedades/img/<?php echo $nov['imagensm']; ?>" alt="<?php echo $nov['alt']; ?>">
													</a>
													<?php } else { ?>
										            <a href="busqueda.php?idBusqueda=<?php echo $nov['idNovedad']; ?>">
														<img src="images/novedad.jpg" alt="<?php echo $nov['titulo']; ?>">
													</a>
													<?php } ?>
												</figure>
											</div>
											<div class="col-sm-8">
												<a href="busqueda.php?idBusqueda=<?php echo $nov['idNovedad']; ?>"><b><?php echo $nov['titulo']; ?></b></a>
											</div>
										</li>
										<?php 
								            	}
								            }
								        ?>
									</ul>
								</div>
							</div> 

						</aside>
					</div>			
				</div> 
			</div> 
		</section> 

		<footer class="main-footer">
			<section class="footer-social bg-alpha">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<ul class="inline-list social-networks align-center text-white">
								<li class="facebook-network">
									<a href="https://www.facebook.com/grupoconsultor.rr.hh" target="_blank"><i class="icon-182"></i></a>
								</li>
								<!-- <li class="twitter-network">
									<a href="#twitter"><i class="icon-510"></i></a>
								</li> -->
								<li class="linkedin-network">
									<a href="https://www.linkedin.com/profile/view?id=33527440" target="_blank"><i class="icon-297"></i></a>
								</li>
							</ul>
						</div>
					</div> 
				</div> 
			</section> 

			<section class="footer-menu-box">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<ul class="inline-list footer-menu align-center uppercase">
								<li><a href="index.php">Volver a inicio</a><li>
							</ul>
						</div>
					</div> 
				</div> 
			</section> 

			<section class="footer-copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p class="copyright align-center text-center uppercase">
								<span>copyright &copy; 2014 </span>
								<a href="http://grupoconsultorrrhh.com.ar/">Grupo Consultor RRHH </a>
								<span> desrrollo by </span>
								<a href="http://grafitodd.com.ar/" target="_blank">Grafito DD</a>	
							</p>
						</div>
					</div> 
				</div> 
			</section> 
		</footer> 

	</div> 
	
</body>
</html>
