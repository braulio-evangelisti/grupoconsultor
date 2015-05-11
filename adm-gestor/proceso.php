<?php

	switch($_REQUEST['op'])
	{
	// Página de ingreso al sistema de administración ----------------
		case "login":
		$url = "func.includes/validar.php";
		break;
		case "forgot":
		$url = "func.includes/forgot.php";
		break;
		case "reset":
		$url = "func.includes/reset.php";
		break;
		case "register":
		$url = "func.includes/register.php";
		break;
		
		case "panel/administracion":
		$url = "adminPanel.php";
		break;
		
		case "help":
		$url = "help.php";
		break;

	// Desloguearse del sistema de administración --------------------
		case "logout":
		$url = "func.includes/salir.php";
		break;

	// ==============================================================================

	// ==============================================================================
	
	// ABM Usuarios ------------------------------------------------------------------
		case "panel/usuarios": $url = "frm_usuarios/listar.php"; break;
		case "alta/de/usuarios": $url = "frm_usuarios/form.php"; break;
		case "edicion/de/usuarios": $url = "frm_usuarios/form.php"; break;
		case "eliminacion/de/usuarios": $url = "frm_usuarios/procesar.php"; break;

	// ABM Categorias ------------------------------------------------------------------
		case "panel/categorias": $url = "frm_categorias/listar.php"; break;
		case "alta/de/categorias": $url = "frm_categorias/form.php"; break;
		case "edicion/de/categorias": $url = "frm_categorias/form.php"; break;
		case "eliminacion/de/categorias": $url = "frm_categorias/procesar.php"; break;

	// ABM Institucional ------------------------------------------------------------------
		case "panel/institucionales": $url = "frm_institucionales/listar.php"; break;
		case "alta/de/institucionales": $url = "frm_institucionales/form.php"; break;
		case "edicion/de/institucionales": $url = "frm_institucionales/form.php"; break;
		case "eliminacion/de/institucionales": $url = "frm_institucionales/procesar.php"; break;

	// ABM Servicios ------------------------------------------------------------------
		case "panel/servicios": $url = "frm_servicios/listar.php"; break;
		case "alta/de/servicios": $url = "frm_servicios/form.php"; break;
		case "edicion/de/servicios": $url = "frm_servicios/form.php"; break;
		case "eliminacion/de/servicios": $url = "frm_servicios/procesar.php"; break;

	// ABM Novedades ------------------------------------------------------------------
		case "panel/novedades": $url = "frm_novedades/listar.php"; break;
		case "alta/de/novedades": $url = "frm_novedades/form.php"; break;
		case "edicion/de/novedades": $url = "frm_novedades/form.php"; break;
		case "eliminacion/de/novedades": $url = "frm_novedades/procesar.php"; break;

	// ABM Galerias
		case "panel/galerias": $url = "frm_galerias/listar.php"; break;
		case "alta/de/galerias": $url = "frm_galerias/form.php"; break;
		case "edicion/de/galerias": $url = "frm_galerias/form.php"; break;
		case "eliminacion/de/galerias": $url = "frm_galerias/procesar.php"; break;

	// ABM Slider ------------------------------------------------------------------
		case "panel/slider": $url = "frm_slider/listar.php"; break;
		case "alta/de/slider": $url = "frm_slider/form.php"; break;
		case "edicion/de/slider": $url = "frm_slider/form.php"; break;
		case "eliminacion/de/slider": $url = "frm_slider/procesar.php"; break;

	// ABM Portfolio ------------------------------------------------------------------
		case "panel/portfolio": $url = "frm_portfolio/listar.php"; break;
		case "alta/de/portfolio": $url = "frm_portfolio/form.php"; break;
		case "edicion/de/portfolio": $url = "frm_portfolio/form.php"; break;
		case "eliminacion/de/portfolio": $url = "frm_portfolio/procesar.php"; break;
	

	//Valor por defecto
		
		default:
		$url = "404.php";
	}

	require("$url");

?>