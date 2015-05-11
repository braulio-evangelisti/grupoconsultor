<?php

	//print_r($_POST);
	//die();

	include_once("func.includes/class_login.php");
	include_once("func.includes/config.inc.php");
	include_once("func.includes/utiles.inc.php");
	require("func.includes/recaptchalib.php");

	#Obligatorio incluir las claves
	$publickey = "6LfcqgYTAAAAANoEOwwFmS-zKkxEpVcgzjPuOU4vs";
	$privatekey = "6LfcqgYTAAAAAIN5SPAFxQok4TtlAC2M7PKlcgx7";

	if (isset($_POST["procesar"]))
	{

		/* NECESARIO RESPONSE CAPTCHA */
	    $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

		if (empty($_POST["recaptcha_response_field"])) /* Si el captcha está vacío */
		{
			header("Location: index.php?estado=5");
			exit();
		}
		else if(!$resp->is_valid) /* Si el captcha es incorrecto */
		{
			header("Location: index.php?estado=5");
			exit();
		}
		else /* Si el captcha es correcto */
		{	

			$login = new Login();
			$login->setCryptMethod('sha1');

			$email 		= $login->setEscape($_POST['email']);
			$password 	= $login->setCrypt($_POST['password']);

		 	$user 	= "SELECT * FROM usuarios WHERE email='".$email."' AND eliminado=0";
			$result = $db->Execute($user);
			$row 	= $result->fields;

			if($row)
			{

				$db_password = $row['password'];

				if ($password == $db_password) 
				{

				session_start();

				$_SESSION['idUsuario']			= $row['idUsuario'];
				$_SESSION['user_login_session']	= true;
				$_SESSION['USERNAME']       	= $USERNAME	= $row['userName'];
				$_SESSION['ADMIN_PW']       	= $ADMIN_PW = $row['password'];
				$_SESSION['USER']  	        	= $USER		= $row['apellido']." ".$row['nombre'];
				$_SESSION['AVATAR'] 	  		= $row['imagen'];
				$_SESSION['NIVEL'] 	  			= $row['nivelPermiso'];

				header("Location: proceso.php?op=panel/administracion");
				exit();

				}
				else 
				{
					header("Location: index.php?estado=2");
					exit();
				}
			}
			else
			{
				header("Location: index.php?estado=1");
				exit();
			}

		} /*Captcha*/

	} /*Procesar*/
?>