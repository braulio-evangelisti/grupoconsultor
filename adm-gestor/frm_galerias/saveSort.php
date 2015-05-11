<?php
 	$urlubic = "../../adm-gestor/";
	include_once($urlubic."/func.includes/config.inc.php");

	$sort_order = $_REQUEST['sort_order'];
	$orders = explode(',',$_REQUEST['sort_order']);
 	
	foreach($orders as $order=>$id){		
		$query = 'UPDATE galerias SET orden = '.$order.' WHERE idGaleria = '.$id;
		$resultados  = $db->Execute($query);
				
	}

print_R($orders);

?>
