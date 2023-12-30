<?php
session_start();
$_SESSION["errore_login"]=true; //se il login non viene effettuato correttamente,
								//questo flag permetterà di segnalare l'errore all'utente

if(isset($_POST["submit"])){

	//connessione al database
	require("config.php"); //parametri di connessione
	$mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
	if ($mydb->connect_errno) {
		echo "Errore nella connessione a MySQL: (" . $mydb->connect_errno . ") " . $mydb->connect_error;
		exit();
	}
	//la connessione è andata a buon fine: eseguo la query
	//questa volta utilizzo le prepared statements
	//per prevenire tentativi di sql injections
	//esempio: 
	//$stringa = "'ciao' OR 1 = 1";
	//$query = "SELECT nome, password FROM utenti WHERE username = ".$stringa;
	//otterrei come query: SELECT nome, password FROM utenti WHERE username = 'ciao' OR 1 = 1
	
	//select: prepared statement con segnaposto (?) per parametro
	$stmt = $mydb->prepare("SELECT id, nome, hash FROM utenti WHERE nome = (?)");
	//associo il parametro col tipo (s per stringa)
	$stmt->bind_param("s", $_POST["usr"]);
	//eseguo la query
	$stmt->execute();
	//associo i risultati a delle variabili (una variabile per campo)
	$stmt->bind_result($id, $nome, $hash);
	//fetch dei risultati
	while ($stmt->fetch()) { //eseguirà solo una iterazione
		//verifico la password
		//(nota: ci sono varie funzioni di cifratura/verifica per le password,
		//per esempio le funzioni password_hash e password_verify)
		if(password_verify($_POST["pwd"], $hash)){
			//setto la variabile di sessione che indica che è loggato
			unset($_SESSION["errore_login"]);
			$_SESSION["nome"] = $nome;
			$_SESSION["id"] = $id;
		}
	}
	//chiudo statement
	$stmt->close();
}

//ritorna alla pagina invocante	
header("Location: login.php");
exit();
?>
