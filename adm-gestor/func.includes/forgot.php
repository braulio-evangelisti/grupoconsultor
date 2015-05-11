<?php

	//print_r($_POST);
	//die();

	include_once("func.includes/config.inc.php");
	include_once("func.includes/utiles.inc.php");
	include("func.includes/class.phpmailer.php");

	if (isset($_POST["procesar"]))
	{

		$email 	= secureParamToSql($_POST['email']);

		$user 	= "SELECT id FROM usuarios WHERE email='".$email."' AND eliminado=0";
		$result = $db->Execute($user);
		$row 	= $result->fields;

		if ($row < 1) // Validate email address
        {
            header("Location: index.php?estado=1");
			exit();
        }
        else
        {

        	$encrypt = sha1(90*13+$row['id']);
			$cuerpo  ='Hola, <br/> <br/>Su id de cuenta es: '.$row['id'].' <br><br>Click <a href="'. _global_siteurl .'adm-gestor/proceso.php?op=reset&encrypt=' . $encrypt . '">aquí</a> para resetear su password';
			
			$mail = new PHPMailer();
		    $mail->From = 'info@sitio.com.ar';
		    $mail->FromName = 'Administrador del sitio';
		    $mail->Host = "mail.sitio.com.ar";
		    $mail->Mailer = "smtp";
		    $mail->AddAddress($email);
		    $mail->Subject = "Forget Password";
		    $mail->Body = $cuerpo;
		    $mail->SMTPAuth = true;
		    $mail->CharSet = "UTF-8";
		    $mail->IsHTML(true);
		    $mail->Username = "test@sitio.com.ar";
		    $mail->Password = "bb9QcIEJlwIL"; 
			
		    if($mail->Send())
		    {
		      
		      header("Location: index.php?estado=6");
			  exit();

		    }
		      else
		      {
		        header("Location: index.php?estado=7");
			  exit();
		      }


		} /*row*/

	} /*Procesar*/
?>