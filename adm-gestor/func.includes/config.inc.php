<?php

	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	include_once("utiles.inc.php");
	
	include('data.inc.php'); 

	$usuarios_sesion = "validacion";

	$size 	   = 512000;
	$ext  	   = array('.jpg','.jpeg','.JPG','.JPEG','.png','.PNG');
	$file_name = $_FILES['imagen']['name'];
	//$file_ext  = substr($file_name, strrpos($file_name,"."));

	function filled_array($arr){
		for($i=0; $i<count($arr); $i++){
			if($arr[$i]!='')
				return true;
		}	
		return false;
	}

	$level = ($levelFrom == null) ? 0 : $levelFrom;

	incluir($level,$urlubic."func.adodb/adodb.inc.php");
	$db = ADONewConnection("mysql"); 
	$db->SetFetchMode(ADODB_FETCH_ASSOC); 
	$db->debug = false; 
	$db->Connect($host, $user, $pass, $basedato); 
	incluir($level,$urlubic."func.adodb/adodb.inc.php");
	incluir($level,$urlubic."func.includes/general.php");
	$objGeneral = new General ($db);

?>