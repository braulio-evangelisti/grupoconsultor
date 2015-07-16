<?php
  
	$urlubic = "adm-gestor/";

	include_once($urlubic."func.includes/config.inc.php");
	include_once($urlubic."func.includes/utiles.inc.php");

	if(isset($_GET['r'])) 
	{ 
		$result = secureParamToSql($_GET['r']); 
		
		if($result == 'ok')
		{ 
			$msg = 'Tu mensaje ha sido enviado. Muchas gracias!'; 
		}
		
		if($result == 'bad')
		{ 
			$msg = 'Ocurrió un problema enviando el mensaje. Intenta mas tarde.'; 
		}
		
		$anchor = "contact"; 
	}
	
	if(isset($_GET['rcv'])) 
	{ 
		$resultcv = secureParamToSql($_GET['rcv']); 
		
		if($resultcv == 'ok')
		{ 
			$msgcv = 'Tu curriculum ha sido enviado. Muchas gracias!'; 
		}
		
		if($resultcv == 'bad')
		{ 
			$msgcv = 'Ocurrió un problema enviando el mensaje. Intenta mas tarde.'; 
		}
		
		$anchor = "cv"; 
	}

?>
<!doctype html>
<html lang="en" class="no-js" dir="ltr">
    <head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $publicTitle; ?></title>
        <meta name="keyword" content="<?php echo $metaKeywords; ?>">
        <meta name="description" content="<?php echo $metaDesc; ?>">
        <meta name="author" content="<?php echo $metaAuth; ?>">

		<meta name="description" content="<?php echo $metaDesc; ?>" />
		<meta name="twitter:card" value="summary">
		<meta property="og:title" content="<?php echo $publicTitle; ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="http://www.grupoconsultorrrhh.com.ar/" />
		<meta property="og:image" content="http://grupoconsultorrrhh.com.ar/adm-gestor/frm_slider/1431372955_handshake-business-family-southeast-asia.jpg" />
		<meta property="og:description" content="<?php echo $metaDesc; ?>" />
		
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
		
		<!-- Fuente+CSS -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800|Varela' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="styles/screen.css">
		
		<!-- JS -->
        <script src="scripts/components/require.js" data-main="scripts/options"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
<body data-preloader="on">
    <!--[if lt IE 9]>
      <p class="browsehappy">Tu navegador se encuentra <strong>desactualizado</strong>. Por favor <a href="http://browsehappy.com/">actualiza tu navegador</a> para ver el sitio correctamente.</p>
    <![endif]-->

    <div id="home" data-smooth-scroll="on">
        <section class="box-intro-large">
           <?php
	  			$sqlSld = $objGeneral->listar_registros("SELECT * FROM slider WHERE publicada = 'SI' AND eliminado = '0' ORDER BY orden ASC");
				if($sqlSld != ''){
					foreach($sqlSld as $sld)
					{
			?>
            <div class="intro-container" <?php if($sld['imagen'] != ''){ ?> data-box-img="<?php echo _global_siteurl; ?>adm-gestor/frm_slider/<?php echo $sld['imagen']; ?>" <?php } ?> >
                <div class="box-img"><span></span></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="intro-logo hidden-xs">
                                <a href="index.php"><img src="images/load.svg" data-src="images/logo-intro.png" alt="Grupo Consultor RRHH"></a>
                            </div>
                        </div>
                    </div>                         
                </div> 

                <div class="container intro-center">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
							
                            <div class="text-center text-white">
                            	<img src="images/load.svg" data-src="images/cuz.png" alt="cuz">
                            	<p></p>
                                <h3 class="no-margin-header"><?php echo $sld['titulo']; ?></h3>
                                <p class="uppercase-header"><?php echo $sld['txtSlide1']; ?></p>
                            </div>

                        </div>
                    </div> 
                </div>

            </div>
            <?php
            		}
	   			}
			?>
        </section>

        <header class="main-header" data-sticky="true">
            <section class="header-navbar bg-alpha" data-menu-scroll="true">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 col-xs-4">
                            <figure class="identity">
                            	<a href="index.html">
                            		<img alt="Theme logo" src="images/logo.png">
                            	</a>
                            </figure>
                        </div> 
                        <div class="col-sm-10 col-xs-8">
                            <nav class="main-nav">
                            	<a href="#" class="responsive-menu align-right"><i class="icon-333 font-2x text-white"></i></a>
                            	<ul class="inline-list align-right uppercase">   			
                            		<li><a href="#home">Home</a><li>
                            		<li><a href="#about">Nosotros</a></li>
                            		<li><a href="#services">Servicios</a></li>
                            		<li><a href="#busquedas">Búsquedas</a></li>
                            		<li><a href="#news">Novedades</a></li>
                            		<li><a href="#contact">Contacto</a></li>
                            		<li><a href="#cv">CV</a></li>
                            	</ul>
                            </nav>
                        </div> 
                    </div> 
                </div> 
            </section> 
        </header> 

		<section id="about" class="box">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="fancy-title text-center uppercase">
							<h4 class="text-alpha">¿QUIENES SOMOS?</h4>
							<h6 class="text-grey text-air">Grupo Consultor - Rosario</h6>
						</div>
						<div class="space-1x"></div>
					</div>
				</div> 
				<div class="row">
					<ul class="loop-features clean-list">
						<?php 
							$sqlIns = $objGeneral->listar_registros("SELECT * FROM institucionales WHERE publicada = 'SI' AND eliminado = '0' ORDER BY idInstitucional ASC"); 

							if($sqlIns != '')
							{
			            		foreach($sqlIns as $ins)
		              			{
						?>
						<li class="col-md-3 col-sm-6">
							<div class="feature-item text-center">
								<?php if($ins['imagen'] != ''){ ?>
								<div class="featured-icon align-center">
									<img src="<?php echo _global_siteurl; ?>adm-gestor/frm_institucionales/img/<?php echo $ins['imagensm']; ?>">
								</div>
					            <?php } ?>			
								<h6 class="uppercase"><?php echo $ins['titulo']; ?></h6>
								<p><?php echo $ins['copete']; ?></p>
							</div>
						</li>
						<?php 
				            	}
				            }
				        ?>
					</ul>
				</div> 
			</div> 
		</section> 

		<section id="services" class="box box-title">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="fancy-title text-center uppercase">
							<h4 class="text-alpha">Servicios</h4>
							<h6 class="text-grey text-air">Trabajando en pos de la salud ocupacional de los Recursos Humanos.</h6>
						</div>
					</div>
				</div> 
			</div> 
		</section> 

		<section class="box box-no-bottom" data-box-img="images/servicios.jpg">
			<div class="box-img"><span></span></div>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div id="big-tabs-nav" class="slide-navigation align-center">
							<ul class="inline-list">
								<li>
									<a href="#" class="bg-white" data-target="prev">
										<i class="icon-110"></i>
									</a>
								</li>
								<li>
									<a href="#" class="bg-white" data-target="next">
										<i class="icon-111"></i>
									</a>
								</li>
							</ul>
						</div>
						<div class="big-tabs" data-sudo-slider='{"slideCount":5, "moveCount":1, "customLink":"#big-tabs-nav a, .big-tabs li", "continuous":true}'>
							<ul class="clean-list">
								<li data-target="4">
									<div class="tab-item uppercase text-center">
										<div class="shape-square bg-white">
											<i class="icon-524 font-6x"></i>
										</div>
										<h6 class="font-alpha"><small>Selección de personal</small></h6>
									</div>
								</li>
								<li data-target="5">
									<div class="tab-item uppercase text-center">
										<div class="shape-square bg-white">
											<i class="icon-44 font-6x"></i>
										</div>
										<h6 class="font-alpha"><small>Evaluaciones de potencial y orientacion profesional</small></h6>
									</div>
								</li>
								<li data-target="1" class="active-big-tab">
									<div class="tab-item uppercase text-center">
										<div class="shape-square bg-white">
											<i class="icon-130 font-6x"></i>
										</div>
										<h6 class="font-alpha"><small>Desarrollo organizacional</small></h6>
									</div>
								</li>
								<li data-target="2">
									<div class="tab-item uppercase text-center">
										<div class="shape-square bg-white">
											<i class="icon-247 font-6x"></i>
										</div>
										<h6 class="font-alpha"><small>Capacitación</small></h6>
									</div>
								</li>
								<li data-target="3">
									<div class="tab-item uppercase text-center">
										<div class="shape-square bg-white">
											<i class="icon-136 font-6x"></i>
										</div>
										<h6 class="font-alpha"><small>Capacitaciones Out Door</small></h6>
									</div>
								</li>
							</ul>
						</div>

						<div class="big-tabs-content" data-sudo-slider='{"customLink":"#big-tabs-nav a, .big-tabs li", "continuous":true}'>
							<ul class="inline-list">
								<li class="row">
									<div class="col-md-7">
										<figure class="text-center no-margin">
											<img src="images/desarrollo-organizacional.jpg" alt="Desarrollo Organizacional">
										</figure>
									</div>
									<div class="col-md-5">
										<h4>Desarrollo Organizacional</h4>
										<p>Intervenciones estratégicas generadas a partir del diagnóstico organizacional tendientes a promover el cambio organizacional, propiciado por medio de un espacio a través  de la implementación de técnicas específicas tendientes al restablecimiento de un clima general de comunicación y confianza, donde se elaboren las tensiones,  inestabilidades y malestares  que obstaculizan el desarrollo, promoviendo a partir de allí un proyecto de trabajo dando a la organización las herramientas necesarias para sostener y seguir desarrollándose en su entorno.</p>
									</div>
								</li>
								<li class="row">
									<div class="col-md-7">
										<figure class="text-center no-margin">
											<img src="images/servicios-rrhh.jpg" alt="Capacitación">
										</figure>
									</div>
									<div class="col-md-5">
										<h4>Capacitación</h4>
										<p>Todos nuestros cursos poseen instancias de práctica. Utilizamos estudios de caso, damatizaciones, videos, filmaciones, diseños de proyectos y toda una amplia gama de técnicas grupales (juegos vivenciales y de supervivencia). Las cuales pueden llevarse a cabo in-company o bien outdoor, de acuerdo al requerimiento de la empresa.  Los programas de capacitación  se realizan sobre la demanda  singular de cada Compañía, en base a la temática que la misma considere trabajar. </p>
										<p>No obstante se brinda un asesoramiento conjunto en pos de que haya un retorno de la capacitación realizada a largo plazo. </p>
									</div>
								</li>
								<li class="row">
									<div class="col-md-7">
										<figure class="text-center no-margin">
											<img src="images/capacitacion-outdoor.jpg" alt="Capacitaciones Out–Door">
										</figure>
									</div>
									<div class="col-md-5">
										<h4>Capacitaciones Out–Door</h4>
										<p>El entrenamiento Outdoor  es la combinación de la formación tradicional en la empresa con ejercicios al aire libre y una metodología basada en el aprendizaje a través de la experiencia directa. En los programas  Outdoor  se realizan actividades que combinan la competitividad deportiva, la diversión y el trabajo en equipo, abordándose aquellos aspectos que resultan cruciales para la gestión de los Recursos Humanos en toda organización, siendo el elemento diferenciador un entorno diferente donde se busca potenciar en los participantes una serie de habilidades y comportamientos que les serán muy útiles en el trabajo diario. </p>
									</div>
								</li>
								<li class="row">
									<div class="col-md-7">
										<figure class="text-center no-margin">
											<img src="images/seleccion-personal.jpg" alt="Selección de personal">
										</figure>
									</div>
									<div class="col-md-5">
										<h4>Seleccion de personal</h4>
										<p>En la actualidad es  reconocida la importancia que tiene el "capital humano"  como factor de éxito de una empresa. La calidad del "capital humano" con que cuente una empresa será una cuestión vital para que se alcancen los objetivos establecidos y para ello es indispensable tener un adecuado proceso de selección de personal. </p>
										<p>Nuestro servicio se orienta a es escoger y calificar los candidatos más adecuados para responder a las necesidades que plantea la organización, analizando previamente su cultura para poder, a partir de allí, comenzar el proceso integral de selección armándolo a la medida de la empresa cliente.</p>
									</div>
								</li>
								<li class="row">
									<div class="col-md-7">
										<figure class="text-center no-margin">
											<img src="images/busqueda.jpg" alt="Evaluaciones de potencial y orientacion de carrera profesional">
										</figure>
									</div>
									<div class="col-md-5">
										<h4>Evaluaciones de potencial y orientacion de carrera profesional</h4>
										<p>Identificar profesionales de alto potencial para futuras promociones a puestos directivos y de relevancia, o bien  a candidatos preseleccionados en procesos de reclutamiento, para determinar puntos de mejora a profundizar en procesos de desarrollo (coaching, mentoring)</p>

										<p>Orientación a profesionales  frente a un cambio laboral personal.</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div> 
			</div> 
		</section> 

		<section id="busquedas" class="box">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="fancy-title text-center uppercase">
							<h4 class="text-alpha">Novedades laborales</h4>
							<h6 class="text-grey text-air">Búsquedas activas</h6>
						</div>
						<div class="space-1x"></div>
					</div>
				</div> 
				<div class="row">
					<ul class="loop-features clean-list">
						<?php 
							$sqlNov = $objGeneral->listar_registros("SELECT * FROM novedades WHERE idCategoria = '1' AND publicada = 'SI' AND eliminado = '0' ORDER BY add_date DESC LIMIT 0,4"); 

							if($sqlNov != '')
							{
					            foreach($sqlNov as $nov)
					            {
						?>
						<li class="col-md-3 col-sm-6">
							<div class="feature-item text-center">
								<div class="featured-icon align-center">
									<?php if($nov['imagensm'] != ''){ ?>
									<a href="busqueda.php?idBusqueda=<?php echo $nov['idNovedad']; ?>">
										<img src="<?php echo _global_siteurl; ?>adm-gestor/frm_novedades/img/<?php echo $nov['imagensm']; ?>" alt="<?php echo $nov['alt']; ?>">
									</a>
						            <?php } else { ?>
						            <a href="busqueda.php?idBusqueda=<?php echo $nov['idNovedad']; ?>">
										<img src="images/novedad.jpg" alt="<?php echo $nov['titulo']; ?>">
									</a>
									<?php } ?>
								</div>			
								<h6 class="uppercase"><a href="busqueda.php?idBusqueda=<?php echo $nov['idNovedad']; ?>"><?php echo $nov['titulo']; ?></a></h6>
								<p><?php echo fecha_completa($nov['add_date']); ?></p>
								<hr class="hr-20 align-center">
								<a href="busqueda.php?idBusqueda=<?php echo $nov['idNovedad']; ?>" class="font-beta uppercase text-alpha">Ver</a>
							</div>
						</li>
						<?php 
				            	}
				            }
				        ?>
					</ul>
				</div> 
			</div> 
		</section> 

		<section id="news" class="box">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="fancy-title text-center uppercase">
							<h4 class="text-alpha">Novedades</h4>
							<h6 class="text-grey text-air">Ültimas noticias</h6>
						</div>
						<div class="space-1x"></div>
					</div>
				</div> 
				<div class="row">
					<ul class="loop-features clean-list">
						<?php 
							$sqlNov = $objGeneral->listar_registros("SELECT * FROM novedades WHERE idCategoria != '1' AND publicada = 'SI' AND eliminado = '0' ORDER BY add_date DESC LIMIT 0,4"); 

							if($sqlNov != '')
							{
					            foreach($sqlNov as $nov)
					            {
						?>
						<li class="col-md-3 col-sm-6">
							<div class="feature-item text-center">
								<div class="featured-icon align-center">
									<?php if($nov['imagensm'] != ''){ ?>
									<a href="novedad.php?idNovedad=<?php echo $nov['idNovedad']; ?>">
										<img src="<?php echo _global_siteurl; ?>adm-gestor/frm_novedades/img/<?php echo $nov['imagensm']; ?>" alt="<?php echo $nov['alt']; ?>">
									</a>
						            <?php } else { ?>
						            <a href="novedad.php?idNovedad=<?php echo $nov['idNovedad']; ?>">
										<img src="images/novedad.jpg" alt="<?php echo $nov['titulo']; ?>">
									</a>
									<?php } ?>
								</div>			
								<h6 class="uppercase"><a href="novedad.php?idNovedad=<?php echo $nov['idNovedad']; ?>"><?php echo $nov['titulo']; ?></a></h6>
								<p><?php echo encabezado($nov['copete']); ?>...</p>
								<hr class="hr-20 align-center">
								<a href="novedad.php?idNovedad=<?php echo $nov['idNovedad']; ?>" class="font-beta uppercase text-alpha">Leer más</a>
							</div>
						</li>
						<?php 
				            	}
				            }
				        ?>						
					</ul>
				</div> 
			</div> 
		</section> 

		<section class="box box-sep">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="text-center">
							<h4 class="font-alpha">Clientes</h4>
							<hr class="hr-10 align-center">
							<div class="spcae-2x"></div>
						</div>
					</div>
				</div> 

				<div class="row">
					<div class="col-md-12">
						<div class="text-center text-grey">
							<br>
							<br>
							<p>Confian en nosotros</p>	
						</div>
					</div>
				</div> 

				<div class="row">
					<ul class="clean-list partner-loop">
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/Logo_Banco_Macro.svg" alt="Banco Macro"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/John_Deere_logo.svg" alt="partner 2"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/molinos.png" alt="partner 3"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/logo_lavirginia.jpg" alt="partner 4"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/a+-ropa.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/banchio.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/cachamai.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/dunod.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/sibila.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/competencia.jpg" alt="partner 5"></a>
							</div>
						</li>

						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/docampo-lopez.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/zurschmiten.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/city-center.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/parodi.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/soy-lola.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/cechini-logo.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/sinax-medica.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/domus-logo.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/casaterra-logo.jpg" alt="partner 5"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/renova-logo.gif" alt="Renova"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/synthon-logo.jpg" alt="Synthon"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/aguas.jpg" alt="aguas"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/banco-stafe.jpg" alt="banco"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/ushuaia.jpg" alt="ushuaia"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/arzinc.jpg" alt="arzinc"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/bbva.jpg" alt="bbva"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/celulosa.jpg" alt="celulosa"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/tesis.jpg" alt="tesis"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/suasor.jpg" alt="suasor"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/comercio.jpg" alt="comercio"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/cedimet.jpg" alt="cedimet"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/grumaq.jpg" alt="grumaq"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/cristalux.jpg" alt="cristalux"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/serpi.jpg" alt="serpi"></a>
							</div>
						</li>
						<li class="col-md-05">
							<div class="partner-item bg-light-grey text-center">
								<a><img src="images/logos/spuches.jpg" alt="spuches"></a>
							</div>
						</li>

					</ul>		

				</div> 
				
			</div> 
		</section> 

		<section class="box" data-box-img="images/section-9.jpg">
	 		<div class="box-img"><span></span></div>
	 		<div class="container">
	 			<div class="row">
	 				<div class="col-md-12">
	 					<div class="text-white">
	 						<h6 class="uppercase"><!-- Casos de exito --></h6>
	 						<h4 class="font-alpha no-margin"><!-- Intervenciones en Consultoría de Desarrollo Organizacional --></h4>
	 						<!-- <hr class="hr-10 bg-white"> -->
	 						<p><!-- Cliente:  <b>Dunod propiedades</b> --></p>
	 						<ul>
	 							<!-- <li>Comunicación organizacional</li>
	 							<li>Encuesta de Clima organizacional</li> -->
	 						</ul>
	 						<div class="space-6x"></div>
	 					</div>
	 				</div>
	 			</div> 
	 		</div> 
	 	</section>

		<section id="contact" class="box">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="fancy-title text-center uppercase">
							<h4 class="text-alpha">Contacto</h4>
							<h6 class="text-grey text-air">Comunicate con nosotros</h6>
						</div>
					</div>
				</div> 

				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="space-1x text-center">
							<p class="col-md-12">
								<?php echo $msg;  ?>
							</p>
						</div>
						<h6 class="font-alpha uppercase text-center"><b>Envianos tu consulta</b></h6>
						<hr class="hr-10 align-center">
						<form action="enviar.php" method="POST" class="slim-form full-inputs row">
							<p class="col-md-4">
								<input type="text" name="nombre" required >
								<span class="uppercase font-beta text-beta">Nombre</span>
							</p>
							<p class="col-md-4">
								<input type="email" name="email" required >
								<span class="uppercase font-beta text-beta">Email</span>
							</p>
							<p class="col-md-4">
								<input type="text" name="asunto" required >
								<span class="uppercase font-beta text-beta">Asunto</span>
							</p>
							<p class="col-md-12">
								<textarea name="mensaje" required ></textarea>
								<span class="uppercase font-beta text-beta">Mensaje</span>
							</p>
							<div class="g-recaptcha col-md-4" data-sitekey="6LfcqgYTAAAAANoEOwwFmS-zKkxEpVcgzjPuOU4v"></div>
							<p class="col-md-8">
								<button type="submit" class="button-lg button-outline make-full uppercase">Enviar mensaje</button>
							</p>
						</form>
					</div>
				</div> 

				<section id="cv" class="box box-title">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="fancy-title text-center uppercase">
									<h4 class="text-alpha">Cargá tu CV</h4>
									<h6 class="text-grey text-air">Dejános tu curriculum</h6>
									<div class="space-1x text-center">
										<p class="col-md-12">
											<?php echo $msgcv;  ?>
										</p>
									</div>

									<form action="enviarcv.php" method="POST" enctype="multipart/form-data" class="slim-form full-inputs row">
										<p class="col-xs-12 col-md-3">
										  	<label class="myLabel">
											    <input type="file" name="cv" value="" required/>
											    <span>Seleccionar archivo</span>
											</label>
										</p>
										<p class="col-xs-12 col-md-8">
											<button type="submit" class="button-lg button-outline make-full uppercase">Enviar CV</button>
										</p>
									</form>

								</div>
							</div>
						</div> 
					</div> 
				</section> 

				<div class="row">
					<div class="col-md-12">
						<div class="space-4x"></div>
						<div class="vector-map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3348.240331004081!2d-60.6421404!3d-32.9446637!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95b7ab17c5ea247f%3A0x61d93824921f8bf4!2sCorrientes+729%2C+Rosario%2C+Santa+Fe!5e0!3m2!1ses!2sar!4v1429220302902" width="1140" height="456" frameborder="0" style="border:0;pointer-events:none;"></iframe>
						</div>
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
								<li><a href="#home">Home</a><li>
                        		<li><a href="#about">Nosotros</a></li>
                        		<li><a href="#services">Servicios</a></li>
                        		<li><a href="#busquedas">Búsquedas</a></li>
                        		<li><a href="#news">Novedades</a></li>
                        		<li><a href="#contact">Contacto</a></li>
                        		<li><a href="#cv">CV</a></li>
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
	
	<script src="scripts/components/jquery.js"></script>
	<script>
		window.onload = function(){
			function getUrlParameter(sParam)
			{
			    var sPageURL = window.location.search.substring(1);
			    var sURLVariables = sPageURL.split('&');
			    for (var i = 0; i < sURLVariables.length; i++) 
			    {
			        var sParameterName = sURLVariables[i].split('=');
			        if (sParameterName[0] == sParam) 
			        {
			            return sParameterName[1];
			        }
			    }
			}  

			var r = getUrlParameter('r'); 
			var rcv = getUrlParameter('rcv'); 

			console.log(r);
			console.log(rcv);

			if(r) 
			{
				
				location.hash = "#contact";

			}

			if(rcv) 
			{

				location.hash = "#cv";

			}
		};
	</script>
</body>
</html>
