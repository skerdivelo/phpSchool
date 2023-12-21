<?php
	session_start();
	
	//elimina la variabile di sessione
	unset($_SESSION["id"]);
	unset($_SESSION["nome"]);
	
	//ritorna alla pagina invocante	
	header("Location: login.php");
	exit();
?>
