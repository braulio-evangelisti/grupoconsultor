<?php
	
	//Define host para ambos, local y web
	$host     = "localhost";
	
	//Setea datos de conexion locales/online, segun donde estemos trabajando 
	if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1') {

		$basedato = "gr_grupoconsultor"; 
		$user 	  = "root";
		$pass 	  = "evangelisti";
		define('_global_siteurl'	,'http://localhost/grupoconsultor/');

	} else {

		$basedato = "guooslor_sitio2015"; 
		$user 	  = "guooslor_user";
		$pass 	  = "4Oi[G.EE95#h";
		define('_global_siteurl'	,'http://grupoconsultorrrhh.com.ar/');

	}

	//Generales
	define('_global_sitepath'	,'adm-gestor/');	
	define('_global_sitename'	,'Sitio Web');
	define('_global_mail_info'  ,'admin@sitio.com.ar');
	define('_global_stmp'	    ,'mail.sitio.com.ar');
	define('_global_mail'	    ,'test@sitio.com.ar');
	define('_global_passw'	    ,'definir pass de test@sitio.com.ar para validar el php mailer');
	
	//Valores del HEAD
	$publicTitle 	= "Grupo Consultor RRHH";
	$admTitle 		= "Panel Administrativo";
	$metaAuth		= "Grupo Consultor RRHH";
	$metaDesc		= "Nos espacializamos en consultoria externa integral de recursos humanos, brindando asesoramiento en selección de personal, evaluaciones psicotecnicas, evaluaciones de desempeño por competencias, capacitacion y desarrollo organizacional.";
	$metaKeywords	= "Grupo, Consultor, Rosario, rrhh";

?>