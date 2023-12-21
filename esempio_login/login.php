<?php
session_start(); //attenzione! la sessione va avviata prima di qualunque output!
				 //compresi spazi vuoti etc
?>
<html>
	<head>
		<title>Esempio di login</title>
	</head>
	<body>
		<?php
		//verifico se è loggato o meno:
		//se non è loggato mostro il form per loggarsi
		//se è già loggato lo saluto
		if(isset($_SESSION["id"])){
			//pannello di controllo utente
			?>
			<h1>Ciao <?php echo $_SESSION["nome"]; ?></h1>
			<p><a href="logout.script.php">Clicca per il logout</a></p>
			<?php
		}
		else{
			//non è loggato quindi mostro il form
			?>
			<p>Dati dell'esempio:</p>
			<p>username: pippo</p>
			<p>password: pluto</p>
			<form id="login" name="login" method="post" action="login.script.php">
				
				<label for="usr">Nome utente</label>
				<input type="text" placeholder="Inserisci username" name="usr" required>

				<label for="pwd">Password</label>
				<input type="password" placeholder="Inserisci password" name="pwd" required>

				<input type="submit" name="submit" value="Login">
			</form>
			<form action="signup.php">
				<button type="submit">Sign Up</button>
			</form>
			<?php
			//comunico anche l'eventuale tentativo errato di login
			if(isset($_SESSION["errore_login"]) && $_SESSION["errore_login"]==true){
				echo "<p>Nome utente o password errati! Ritenta!</p>";
				unset($_SESSION["errore_login"]);
			}
		}
		?>
	</body>
</html>