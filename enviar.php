<?php 
	$urlubic = "adm-gestor/";

	require($urlubic."func.includes/class.phpmailer.php");
	require($urlubic."func.includes/class.smtp.php");

	$siteKey = '6LfcqgYTAAAAANoEOwwFmS-zKkxEpVcgzjPuOU4v';
	$secret = '6LfcqgYTAAAAAIN5SPAFxQok4TtlAC2M7PKlcgx7';	
	$lang = 'es';

if(isset($_POST['g-recaptcha-response']))
{
	$captcha = $_POST['g-recaptcha-response'];

	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
    
    if($response.success == false)
    {
  		header ('Location: index.php?r=bad#contact'); 
    }
    else
    {
    	
    	$body  = "<p>Este es un mensaje automatico desde el sitio web.</p></p>Nombre: <strong>" . $_POST['nombre'] . "</strong></p><p>Email: <strong>" . $_POST['email'] . "</strong></p><p>Asunto: <strong>" . $_POST['asunto'] . "</strong></p><p>Mensaje: <strong>" . $_POST['mensaje'] . "</strong></p>"; 
 
		$mail = new PHPMailer(); 
		  
		$mail->IsSMTP(); 
		$mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta 
		$mail->Username = "contacto@grupoconsultorrrhh.com.ar"; // Cuenta de e-mail 
		$mail->Password = "%vG~fg})!PHJ"; // Password 
		 
		$mail->Host = "localhost"; 
		$mail->From = $_POST['email']; 
		$mail->FromName = $_POST['nombre']; 
		$mail->Subject = "Nuevo contacto desde grupoconsultorrrhh.com.ar "; 
		/*$mail->AddAddress("grupoconsultor@fibertel.com.ar","Grupo Consultor RRHH");*/
		$mail->AddBCC("grafitodd@gmail.com");
		$mail->CharSet = "UTF-8";
		$mail->IsHTML(true); 
		 
		$mail->WordWrap = 50; 
		 
		$mail->Body = $body; 
		 
		$mail->Send(); 
		 	
	 	if($mail)
		{ 
			header ('Location: /?r=ok#contact'); 
		}
		else
		{
			header ('Location: /?r=bad#contact'); 
		}
		 
    }

}
else
{
	header ('Location: /?r=bad#contact'); 
}
 
?>