<?php
	
	//-------------------------------------------------------------------------
	// Funcion que escapa a las comillas simples o dobles que pueden ingresar en los campos
	//-------------------------------------------------------------------------
	function secureParamToSql($param)
	{
		$param = str_replace("*", "", $param);
		$param = str_replace("%", "", $param);
		$param = str_replace("'", "", $param);
		$param = str_replace("#", "", $param);
		$param = str_replace("&", "", $param);
		$param = str_replace("\"", "", $param);
		$param = str_replace("\\", "", $param);
		$param = str_replace("mysql","",$param);
		$param = str_replace("mssql","",$param);
		$param = str_replace("query","",$param);
		$param = str_replace("insert","",$param);
		$param = str_replace("select","",$param);
		$param = str_replace("update","",$param);
		$param = str_replace("delete","",$param);
		$param = str_replace("Character","",$param);
		$param = str_replace("MEMB_INFO","",$param);
		$param = str_replace("PHP_INFO","",$param);
		
		return $param;
	}
	
	//-------------------------------------------------------------------------
	// Devuelve un copete con las primeras 30 palabras de la descripcion
	//-------------------------------------------------------------------------

	function encabezado($descripcion)
	{
		$descripcion = explode(" ",$descripcion);
		
		for($i=0;$i<30;$i++)
		{
			$descripcion[$e] .= $descripcion[$i] . " ";
		}
	
		if($i<50)
		{
			return $descripcion[$e];
		}
		else
		{
			return $descripcion[$e]."...";
		}
	}

	//-------------------------------------------------------------------------
	// Random char
	//-------------------------------------------------------------------------

	function caracter_aleatorio() {
		
		mt_srand((double)microtime()*1000000);
		$valor_aleatorio = mt_rand(1,3);
		
		switch ($valor_aleatorio) {
		 case 1:
			  $valor_aleatorio = mt_rand(97, 122); 
			  break;
		 case 2:
			  $valor_aleatorio = mt_rand(48, 57);
			  break;
		 case 3:
			  $valor_aleatorio = mt_rand(65, 90);
			  break;
		}
		return chr($valor_aleatorio);
	}
	
	//-------------------------------------------------------------------------
	// Devuelve un string limpio de la fecha de tipo (2014-04-16 13:04:16) para imprimir en el nombre de un archivo
	//-------------------------------------------------------------------------

	function date_file($d){
		$date = substr($d,8,2).substr($d,5,2).substr($d,2,2);
		return($date);
	}

	//-------------------------------------------------------------------------
	// Devuelve extension de archivo
	//-------------------------------------------------------------------------

	function findExtension ($filename)
	{
	   $filename = strtolower($filename) ;
	   $exts = explode(".", $filename) ;
	   $n = count($exts)-1;
	   $exts = $exts[$n];
	   return $exts;
	}

	//-------------------------------------------------------------------------
	// Devuelve tamaño de archivo en KB
	//-------------------------------------------------------------------------

	function size_as_kb($yoursize) {
	  if($yoursize < 1024) {
	    return "{$yoursize} bytes";
	  } elseif($yoursize < 1048576) {
	    $size_kb = round($yoursize/1024);
	    return "{$size_kb} KB";
	  } else {
	    $size_mb = round($yoursize/1048576, 1);
	    return "{$size_mb} MB";
	  }
	}

	//-------------------------------------------------------------------------
	// Devuelve el da de la semana para una fecha dada en formato (YYYY-MM-DD)
	//-------------------------------------------------------------------------
	function dia_de_semana($date){
		if (empty($date))
			return "";
	
		switch (date("w", mktime(0, 0, 0, substr($date,5,2), substr($date,8,2), substr($date,0,4)))){
			case 0: return "Domingo";
			case 1: return "Lunes";
			case 2: return "Martes";
			case 3: return "Miércoles";
			case 4: return "Jueves";
			case 5: return "Viernes";
			case 6: return "Sábado";
			default: return "";
		}
	}
	
	//-------------------------------------------------------------------------
	// Devuelve la fecha dada (YYYY-MM-DD) en formato (dia_de_semana DD-MM-YYYY)
	//-------------------------------------------------------------------------
	function fecha_completa($date) {
	
		if (empty($date))
			return '';
		if ($date == '0000-00-00')
			return '---';
		
		switch(substr($date,5,2)) {
			case 1: $mes = 'Enero'; break;
			case 2: $mes = 'Febrero'; break;
			case 3: $mes = 'Marzo'; break;
			case 4: $mes = 'Abril'; break;
			case 5: $mes = 'Mayo'; break;
			case 6: $mes = 'Junio'; break;
			case 7: $mes = 'Julio'; break;
			case 8: $mes = 'Agosto'; break;
			case 9: $mes = 'Septiembre'; break;
			case 10: $mes = 'Octubre'; break;
			case 11: $mes = 'Noviembre'; break;
			case 12: $mes = 'Diciembre'; break;
		}
	
		return dia_de_semana($date).',  '.substr($date,8,2).' de '.$mes.' de '.substr($date,0,4);
	}

	//-------------------------------------------------------------------------
	// Devuelve la fecha dada (YYYY-MM-DD) en formato (DD-MM-YYYY)
	//-------------------------------------------------------------------------
	function fecha_completa_abreviada($date) {
	
		if (empty($date))
			return '';
		if ($date == '0000-00-00')
			return '---';
		
		switch(substr($date,5,2)) {
			case 1: $mes = '01'; break;
			case 2: $mes = '02'; break;
			case 3: $mes = '03'; break;
			case 4: $mes = '04'; break;
			case 5: $mes = '05'; break;
			case 6: $mes = '06'; break;
			case 7: $mes = '07'; break;
			case 8: $mes = '08'; break;
			case 9: $mes = '09'; break;
			case 10: $mes = '10'; break;
			case 11: $mes = '11'; break;
			case 12: $mes = '12'; break;
		}
		
		return substr($date,8,2).'/'.$mes.'/'.substr($date,0,4);
	}
	
	//-------------------------------------------------------------------------
	// recibe ao-mes-da... devuelve da-mes-ao
	//-------------------------------------------------------------------------

	function diaToAnio($date) {
	
		if (empty($date))
			return '';
		if ($date == '0000-00-00')
			return '00-00-0000';
			return substr($date,8,2)."-".substr($date,5,2)."-".substr($date,0,4);
	}

	//-------------------------------------------------------------------------
	// recibe da-mes-ao... devuelve ao-mes-da
	//-------------------------------------------------------------------------

	function anioToDia($date) {
	
		if (empty($date))
			return '';
		if ($date == '00-00-0000')
			return '0000-00-00';
			return substr($date,6,4)."-".substr($date,3,2)."-".substr($date,0,2);
	}

	//-------------------------------------------------------------------------
	// Funcin para validar si la noticia tiene mas de 30 das en la home y no sea mostrada
	//-------------------------------------------------------------------------

	function fechaBajaNoticia($fechaUno,$fechaDos){
	
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fechaUno))
			list($dia1,$mes1,$anio1) = split("/",$fechaUno);
		
		if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fechaUno))
			list($dia1,$mes1,$anio1) = split("-",$fechaUno);
		
		if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fechaDos))
			list($dia2,$mes2,$anio2) = split("/",$fechaDos);
		
		if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fechaDos))
			list($dia2,$mes2,$anio2) = split("-",$fechaDos);
			
			$dif = mktime(0,0,0,$mes1,$dia1,$anio1) - mktime(0,0,0,$mes2,$dia2,$anio2);
			
			$nroDias = floor($dif/(24*60*60));
	
		return($nroDias);      
	}

	//-------------------------------------------------------------------------
    // Pasar el mes de nuemero a letra
    //-------------------------------------------------------------------------

	function mesescrito($mes)
	{

		if ($mes == 01)
		{
			$mes = 'ENE';
		} 	
		elseif ($mes == 02)
		{
			$mes = 'FEB';
		}
		elseif ($mes == 03)
		{
			$mes = 'MAR';
		}
		elseif ($mes == 04)
		{
			$mes = 'ABR';
		} 
		elseif ($mes == 05)
		{
			$mes = 'MAY';
		} 
		elseif ($mes == 06)
		{
			$mes = 'JUN';
		} 
		elseif ($mes == 07)
		{
			$mes = 'JUL';
		} 
		elseif ($mes == 08)
		{
			$mes = 'AGO';
		} 
		elseif ($mes == 09)
		{
			$mes = 'SEP';
		} 
		elseif ($mes == 10)
		{
			$mes = 'OCT';
		} 
		elseif ($mes == 11)
		{
			$mes = 'NOV';
		} 

		else $mes = 'DIC';

		echo $mes;

	}

	//-------------------------------------------------------------------------
	// Devuelve la fecha dada (YYYY-MM-DD) en formato (DD-MM-YYYY)
	//-------------------------------------------------------------------------

	function fecha_to_esp($date) {
	
		if (empty($date))
			return '';
		if ($date == '0000-00-00')
			return '---';
		
		switch(substr($date,5,2)) {
			case 1: $mes = '01'; break;
			case 2: $mes = '02'; break;
			case 3: $mes = '03'; break;
			case 4: $mes = '04'; break;
			case 5: $mes = '05'; break;
			case 6: $mes = '06'; break;
			case 7: $mes = '07'; break;
			case 8: $mes = '08'; break;
			case 9: $mes = '09'; break;
			case 10: $mes = '10'; break;
			case 11: $mes = '11'; break;
			case 12: $mes = '12'; break;
		}
		
		return substr($date,8,2).'/'.$mes.'/'.substr($date,0,4);
	}

	//-------------------------------------------------------------------------
	// Devuelve la fecha dada (DD-MM-YYYY) en formato (YYYY-MM-DD)
	//-------------------------------------------------------------------------

	function fecha_to_eng($date) {
	
		if (empty($date))
			return '';
		if ($date == '00-00-0000')
			return '---';
		
		switch(substr($date,3,2)) {
			case 1: $mes = '01'; break;
			case 2: $mes = '02'; break;
			case 3: $mes = '03'; break;
			case 4: $mes = '04'; break;
			case 5: $mes = '05'; break;
			case 6: $mes = '06'; break;
			case 7: $mes = '07'; break;
			case 8: $mes = '08'; break;
			case 9: $mes = '09'; break;
			case 10: $mes = '10'; break;
			case 11: $mes = '11'; break;
			case 12: $mes = '12'; break;
		}
		
		return substr($date,6,4).'-'.$mes.'-'.substr($date,0,2);
	}

	//-------------------------------------------------------------------------
	// paso variables comunes a superglobales en caso de tener register_globals=off en el servidor	
	//-------------------------------------------------------------------------

	$keys_post = array_keys($_POST);
	foreach ($keys_post as $key_post)
	 {
	  $$key_post = secureParamToSql($_POST[$key_post]);
	 }

	$keys_get = array_keys($_GET);
	foreach ($keys_get as $key_get)
	 {
		$$key_get = secureParamToSql($_GET[$key_get]);
	 }
	
	//-------------------------------------------------------------------------
	// Redimensionar la imagen 
	//-------------------------------------------------------------------------
	
	function redimensionar_jpeg($img_original, $img_nueva, $img_nueva_anchura, $img_nueva_altura, $img_nueva_calidad)
	{
		// crear una imagen desde el original
		$img = ImageCreateFromJPEG($img_original);
		// crear una imagen nueva
		$thumb = imagecreatetruecolor($img_nueva_anchura,$img_nueva_altura);
		// redimensiona la imagen original copiandola en la imagen
		ImageCopyResized($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img));
		// guardar la nueva imagen redimensionada donde indicia $img_nueva
		ImageJPEG($thumb,$img_nueva,$img_nueva_calidad);
		ImageDestroy($img);
	}
	
	//-------------------------------------------------------------------------	
	// Para flexibilizar los includes 
	//-------------------------------------------------------------------------

	function incluir($n, $path)
	{
		if ($n == null || $n == 0)
		{
		include_once($path);
		}
			else if ($n == 2)
			{
			include_once("../../".$path);
			}
	}

	//-------------------------------------------------------------------------
	// thumb de un video youtube o vimeo
	//-------------------------------------------------------------------------

	function video_image($url){
    $image_url = parse_url($url);
    if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
        $array = explode("&", $image_url['query']);
        return "http://img.youtube.com/vi/".substr($array[0], 2)."/hqdefault.jpg";
    } else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".substr($image_url['path'], 1).".php"));
        return $hash[0]["thumbnail_large"];
    }
	}

	//-------------------------------------------------------------------------
	//traer codigo para incrustar video
	//-------------------------------------------------------------------------

	function getVideoEmbed($vurl){
	    $image_url = parse_url($vurl);
	    if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
	        $array = explode("&", $image_url['query']);
	        return '<iframe src="http://www.youtube.com/embed/' . substr($array[0], 2) . '?wmode=transparent" width="599" height="449" allowfullscreen style="border:0;"></iframe>';
	    } else if($image_url['host'] == 'www.youtu.be' || $image_url['host'] == 'youtu.be'){
	        $array = ltrim($image_url['path'],'/');
	        return '<iframe src="http://www.youtube.com/embed/' . $array . '?wmode=transparent" width="599px" height="449" allowfullscreen style="border:0;"></iframe>';
	    } else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
	        $hash = substr($image_url['path'], 1);
	        return '<iframe src="http://player.vimeo.com/video/' . $hash . '?title=0&amp;byline=0&amp;portrait=0" width="599" height="449" allowfullscreen style="border:0;"></iframe>';
	    }
	}

	//-------------------------------------------------------------------------
	// Get current URL
	//-------------------------------------------------------------------------

	function getPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
	}


?>