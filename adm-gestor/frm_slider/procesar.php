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
	$sTable = "slider";
	$sId 	= "idSlide";

	//Nuevo registro
	if($_GET["action"] == "create")
	{
		//+ Extra fields

		if($_FILES['imagen']['name']  != "")
		{
			$imagen = time()."_".$_FILES['imagen']['name'];
			$destino =  "".$imagen ;
			move_uploaded_file($_FILES['imagen']['tmp_name'],$destino);

			$_POST['imagen'] = $imagen;
		}

		$_POST['add_user'] = $_POST['idOwner'];		
		$_POST['add_date'] = date("Y-m-d H:m:s");
		$_POST['eliminado'] = 0;

		//Insert record into database
		$ins = $objGeneral->insertar_registro($_POST, $sTable, $sId);
		
		if($ins){

			header('location: ../proceso.php?op=alta/de/slider&result=ok');

		} else {

			header('location: ../proceso.php?op=alta/de/slider&result=bad');

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
			$imagen = time()."_".$_FILES['imagen']['name'];
			$destino =  "".$imagen ;
			move_uploaded_file($_FILES['imagen']['tmp_name'],$destino);

			$_POST['imagen'] = $imagen;
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

			header('location: ../proceso.php?op=panel/slider&result=ok');

		} else {

			header('location: ../proceso.php?op=panel/slider&result=bad');

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