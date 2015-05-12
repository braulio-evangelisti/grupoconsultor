<?php 
	$urlubic = "adm-gestor/";

	require($urlubic."func.includes/class.phpmailer.php");
	require($urlubic."func.includes/class.smtp.php");
/*
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
    {*/
    if($_FILES['cv']['name'] != "")
	{
		$temp_name = $_FILES['cv']['tmp_name'];
		$file_name = $_FILES['cv']['name']; 
		$file_name = str_replace("\\","",$file_name);
		$file_name = str_replace("'","",$file_name);
		$file_name = str_replace("&","",$file_name);
		$file_name = str_replace("#","",$file_name);
		$file_name = str_replace("!","",$file_name);
		$file_name = str_replace(" ","_",$file_name);
		$archivo   = time()."_".$file_name;
		
		$file_path = "cv/" . $archivo;
		if(move_uploaded_file($temp_name, $file_path))
		{	
			$file_path	= "http://grupoconsultorrrhh.com.ar/".$file_path;
		}
		else
		{
			$file_path = "no se subio".$file_path;	
		}
	}
    	
    	$body  = "<p>Este es un mensaje automatico desde el sitio web.</p><p>Han enviado un nuevo Curriculum Vitae.</p><p><a href='".$file_path."' target='_blank'>Ver CV</a></p>"; 
 
		$mail = new PHPMailer(); 
		  
		$mail->IsSMTP(); 
		$mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta 
		$mail->Username = "contacto@grupoconsultorrrhh.com.ar"; // Cuenta de e-mail 
		$mail->Password = "%vG~fg})!PHJ"; // Password 
		 
		$mail->Host = "localhost"; 
		$mail->From = "contacto@grupoconsultorrrhh.com.ar"; 
		$mail->FromName = "ENVIO DE CV DEL SITIO"; 
		$mail->Subject = "Nuevo CV desde grupoconsultorrrhh.com.ar "; 
		$mail->AddAddress("grupoconsulltor@fibertel.com.ar","Grupo Consultor RRHH");
		$mail->AddBCC("grafitodd@gmail.com","Grafito Diseño Digital");
		$mail->CharSet = "UTF-8";
		$mail->IsHTML(true); 
		 
		$mail->WordWrap = 50; 
		 
		$mail->Body = $body; 
		 
		$mail->Send(); 
		 	
	 	if($mail)
		{ 
			header ('Location: index.php?r=ok#cv'); 
		}
		else
		{
			header ('Location: index.php?r=bad#cv'); 
		}
	 
    /*}

}
else
{
	header ('Location: index.php?r=bad#contact'); 
}*/
 
?>