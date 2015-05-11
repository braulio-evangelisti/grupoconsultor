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
	$sTable = "galerias";
	$sId 	= "idGaleria";

	//Get ID del contenido que refiere
	$idRef = $_POST['idContenido'];

	/* 
	* Recupera la fuente (Novedades, Institucional, etc)
	*/
	$origen = $_POST['origen'];
	switch($origen)
    {
      case "0":
      $_POST['origen'] = "NOVED";
      break;

      case "1":
      $_POST['origen'] = "INSTIT";
      break; 

      case "2":
      $_POST['origen'] = "PORT";
      break;

      case "3":
      $_POST['origen'] = "SERV";
      break;             
    }

	//Nuevo registro
	if($_GET["action"] == "create")
	{

		if($_FILES['imagen']['name']  != "")
		{
			$foo = new Upload($_FILES['imagen']);

			if ($foo->uploaded)
			{

				$foo->file_name_body_add = '-large';
				$foo->image_resize       = true;
				$foo->image_x 			 = 1170;
   				$foo->image_ratio_y 	 = true;
				$foo->Process('./');
				$_POST['imagen']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->file_name_body_add = '-medium';
				$foo->image_resize       = true;
				$foo->image_x            = 720;
				$foo->image_ratio_y		 = true;
				$foo->Process('./');
				$_POST['imagenmd']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->file_name_body_add = '-small';
				$foo->image_resize       = true;
				$foo->image_ratio_crop   = true;
				$foo->image_x            = 270;
				$foo->image_y            = 200;
				$foo->Process('./');
				$_POST['imagensm']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->Clean();
			}
		}

		$_POST['add_user'] = $_POST['idOwner'];		
		$_POST['add_date'] = date("Y-m-d H:m:s");
		$_POST['eliminado'] = 0;

		//Insert record into database
		$ins = $objGeneral->insertar_registro($_POST, $sTable, $sId);
		
		if($ins){

			header('location: ../proceso.php?op=panel/galerias&origen='.$origen.'&id='.$idRef.'&result=ok');

		} else {

			header('location: ../proceso.php?op=panel/galerias&origen='.$origen.'&id='.$idRef.'&result=bad');

		}
	}
	//Editar registro
	else if($_GET["action"] == "update")
	{
		//Get ID a editar
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
				$foo->Process('./');
				$_POST['imagen']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->file_name_body_add = '-medium';
				$foo->image_resize       = true;
				$foo->image_x            = 720;
				$foo->image_ratio_y		 = true;
				$foo->Process('./');
				$_POST['imagenmd']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->file_name_body_add = '-small';
				$foo->image_resize       = true;
				$foo->image_ratio_crop   = true;
				$foo->image_x            = 270;
				$foo->image_y            = 200;
				$foo->Process('./');
				$_POST['imagensm']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

				$foo->Clean();
			}
		}
		else
		{
			$_POST['imagen'] = $_POST['imagenOld'];
		}

		$_POST['edit_user'] = $_POST['idOwner'];		
		$_POST['edit_date'] = date("Y-m-d H:m:s");

		//Update record in database
		$upd = $objGeneral->actualizar_registro($_POST, $sTable, $sId, $id);

		if($upd){

			header('location: ../proceso.php?op=panel/galerias&origen='.$origen.'&id='.$idRef.'&result=ok');

		} else {

			header('location: ../proceso.php?op=panel/galerias&origen='.$origen.'&id='.$idRef.'&result=bad');

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
	//Upload multiple (uploadMultiAction)
	else if($_GET["action"] == "uploadMulti")
	{

		$_POST['add_user'] = $_POST['idOwner'];		
		$_POST['add_date'] = date("Y-m-d H:m:s");				

		if($_FILES['imagen']['name']  != "")
		{

			/*foreach ($_FILES['imagen']['name'] as $filename => $value) {
			    
			    //Upload
			    $imagen = time()."_".$_FILES['imagen']['name'][$filename];
				$destino =  "".$imagen ;
				move_uploaded_file($_FILES['imagen']['tmp_name'][$filename],$destino);

				$_POST['imagen'] = $imagen;

			    //Insert records into database
				$ins = $objGeneral->insertar_registro($_POST, $sTable, $sId);

			}*/

			$files = array();
			foreach ($_FILES['imagen'] as $k => $l) {
				foreach ($l as $i => $v) {
					if (!array_key_exists($i, $files))
						$files[$i] = array();
						$files[$i][$k] = $v;
				}
			}

			foreach ($files as $file) {

				$foo = new Upload($file);

				if ($foo->uploaded)
				{

					$foo->file_name_body_add = '-large';
					$foo->image_resize       = true;
					$foo->image_x 			 = 1170;
	   				$foo->image_ratio_y 	 = true;
					$foo->Process('./');
					$_POST['imagen']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

					$foo->file_name_body_add = '-medium';
					$foo->image_resize       = true;
					$foo->image_x            = 720;
					$foo->image_ratio_y		 = true;
					$foo->Process('./');
					$_POST['imagenmd']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

					$foo->file_name_body_add = '-small';
					$foo->image_resize       = true;
					$foo->image_ratio_crop   = true;
					$foo->image_x            = 270;
					$foo->image_y            = 200;
					$foo->Process('./');
					$_POST['imagensm']		 = $foo->file_dst_name_body.'.'.$foo->file_dst_name_ext;

					$foo->Clean();

					//Insert records into database
					$ins = $objGeneral->insertar_registro($_POST, $sTable, $sId);
				}

			}
		
		}

		if($ins){

			header('location: ../proceso.php?op=panel/galerias&origen='.$origen.'&id='.$idRef.'&result=ok');

		} else {

			header('location: ../proceso.php?op=panel/galerias&origen='.$origen.'&id='.$idRef.'&result=bad');

		}
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