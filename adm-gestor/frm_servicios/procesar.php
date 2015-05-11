<?php

try
{
	//Open database connection
	$urlubic = "../";

	include_once($urlubic."func.includes/config.inc.php");
	include_once($urlubic."func.includes/class.upload.php");
	include_once($urlubic."func.includes/utiles.inc.php");

	/* 
	* Definir tabla y clave
	*/
	$sTable = "servicios";
	$sId 	= "idServicio";

	//Nuevo registro
	if($_GET["action"] == "create")
	{
		//+ Extra fields
		$_POST['fecha'] = date("Y-m-d H:m:s");

		if($_FILES['imagen']['name']  != "")
		{
			$foo = new Upload($_FILES['imagen']);

			if ($foo->uploaded)
			{

				$foo->file_name_body_add = '-large';
				$foo->image_resize       = true;
				$foo->image_x 			 = 1170;
   				$foo->image_ratio_y 	 = true;
				$foo->Process('img/');
				$_POST['imagen']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->file_name_body_add = '-medium';
				$foo->image_resize       = true;
				$foo->image_x            = 720;
				$foo->image_ratio_y		 = true;
				$foo->Process('img/');
				$_POST['imagenmd']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->file_name_body_add = '-small';
				$foo->image_resize       = true;
				$foo->image_ratio_crop   = true;
				$foo->image_x            = 270;
				$foo->image_y            = 200;
				$foo->Process('img/');
				$_POST['imagensm']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->Clean();
			}
		}
		
		if($_FILES['archivo']['name']  != "")
		{
			$archivo = time()."_".$_FILES['archivo']['name'];
			$destino =  "".$archivo ;
			move_uploaded_file($_FILES['archivo']['tmp_name'],$destino);

			$_POST['archivo'] = $archivo;
		}

		$_POST['add_user'] = $_POST['idOwner'];		
		$_POST['add_date'] = date("Y-m-d H:m:s");
		$_POST['eliminado'] = 0;

		//Insert record into database
		$ins = $objGeneral->insertar_registro($_POST, $sTable, $sId);
		
		if($ins){

			header('location: ../proceso.php?op=alta/de/servicios&result=ok');

		} else {

			header('location: ../proceso.php?op=alta/de/servicios&result=bad');

		}
	}
	//Editar registro
	else if($_GET["action"] == "update")
	{
		//Get ID
		$id = secureParamToSql($_POST[$sId]);

		//+ Extra fields
		if($_FILES['imagen']['name']  != "")
		{
			$foo = new Upload($_FILES['imagen']);

			if ($foo->uploaded)
			{

				$foo->file_name_body_add = '-large';
				$foo->image_resize       = true;
				$foo->image_x 			 = 1170;
   				$foo->image_ratio_y 	 = true;
				$foo->Process('img/');
				$_POST['imagen']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->file_name_body_add = '-medium';
				$foo->image_resize       = true;
				$foo->image_x            = 720;
				$foo->image_ratio_y		 = true;
				$foo->Process('img/');
				$_POST['imagenmd']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->file_name_body_add = '-small';
				$foo->image_resize       = true;
				$foo->image_ratio_crop   = true;
				$foo->image_x            = 270;
				$foo->image_y            = 200;
				$foo->Process('img/');
				$_POST['imagensm']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->Clean();
			}
		}
		else
		{
			$_POST['imagen'] = $_POST['imagenOld'];
		}
		
		if($_FILES['archivo']['name']  != "")
		{
			$archivo = time()."_".$_FILES['archivo']['name'];
			$destino =  "".$archivo ;
			move_uploaded_file($_FILES['archivo']['tmp_name'],$destino);

			$_POST['archivo'] = $archivo;
		}
		else
		{
			$_POST['archivo'] = $_POST['archivoOld'];
		}

		$_POST['edit_user'] = $_POST['idOwner'];		
		$_POST['edit_date'] = date("Y-m-d H:m:s");

		//Update record in database
		$upd = $objGeneral->actualizar_registro($_POST, $sTable, $sId, $id);

		if($upd){

			header('location: ../proceso.php?op=panel/servicios&result=ok');

		} else {

			header('location: ../proceso.php?op=panel/servicios&result=bad');

		}
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{

		//Defino el array donde voy a mandar los resultados de vuelta
		$result = array();

		//Get ID
		$id = secureParamToSql($_POST['id']);

		$_POST['kill_user'] = $_POST['idOwner'];		
		$_POST['kill_date'] = date("Y-m-d H:m:s");
		$_POST['eliminado'] = 1;

		//"Delete" from database
		$result['success'] = $objGeneral->actualizar_registro($_POST, $sTable, $sId, $id);

		//Return data
		print(json_encode($result));
		
	}

}
catch(Exception $ex)
{
    //Return error message
	$result = array();
	$result['Result'] = "ERROR";
	$result['Message'] = $ex->getMessage();
	print_r(json_encode($result));
}
	
?>