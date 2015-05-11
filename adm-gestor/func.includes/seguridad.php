<?php

	session_start();
	
	if($_SESSION["user_login_session"] != true)
	{
		header("Location: index.php?estado=3");
	}	
?>