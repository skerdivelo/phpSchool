<!doctype html>
<html>
    <head>
    </head>
    <link rel="stylesheet" href="style.css">
    <body>
    <?php
        /*instauro la connessione al database */
        require("config.php");  //file di config con i parametri di connessione
        $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
        if ($mydb->connect_errno) {
            echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            exit();  //termina la pagina
        }

        /* $query = "SELECT nome, cognome, COUNT(*)
                    FROM pilota 
                    GROUP BY nome, cognome
                    HAVING COUNT(*)>=1
                    ORDER BY DESC"; */

        $query = 'SELECT nome,cognome, COUNT(*) AS vittorie
                    FROM pilota
                    JOIN partecipa ON pilota.id = partecipa.fkPilota
                    WHERE partecipa.posizione = 1
                    GROUP BY nome, cognome
                    ORDER BY vittorie DESC';
        //eseguo la query
		$risultato = $mydb->query($query);
			
		//controllo se ci sono effettivamente dei risultati, nel caso voglia fare qualcosa in caso contrario
		if($risultato->num_rows > 0){  
			//ciclo i risultati
            ?>
            <h1 id="winPilots">Winning Pilots</h1>
            <table border='1' class="vincitori">
                <tr><th>Nome</th><th>Cognome</th><th>Vittorie</th></tr>
            <?php
			while($pilota = $risultato->fetch_assoc()){
                echo "<tr><td>";
                echo "<p>".$pilota["nome"]." </td><td> ".$pilota["cognome"]. " </td><td> ".$pilota["vittorie"]."</p>";
                echo "</td></tr>";
            }
            echo "</table>";
        }
        else{
            echo "<p>Nessun risultato</p>";
        }
    ?>
    </body>
</html>