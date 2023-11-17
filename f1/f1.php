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
            echo "<table class='vincitori'>";
            echo "<h1 id='winPilots'>Pilots with max Victories</h1>";
            echo "<tr><td>";
            echo "<p>No results</p>";
            echo "</td></tr>";
            echo "</table>";
        }

        $query2 = 'SELECT scuderia.nome, COUNT(fkPilota) AS vittorie
                    FROM scuderia
                    INNER JOIN pilota ON scuderia.id = pilota.fkScuderia
                    INNER JOIN partecipa ON pilota.id = partecipa.fkPilota
                    WHERE partecipa.posizione = 1
                    GROUP BY scuderia.id
                    HAVING vittorie > 0
                    ORDER BY vittorie DESC';

        $risultato = $mydb->query($query2);
                    
        //controllo se ci sono effettivamente dei risultati, nel caso voglia fare qualcosa in caso contrario
        if($risultato->num_rows > 0){  
            //ciclo i risultati
            ?>
            <h1 id="winPilots">Team Victories </h1>
            <table border='1' class="vincitori">
                <tr><th>Nome</th><th>Vittorie</th></tr>
            <?php
            while($scuderia = $risultato->fetch_assoc()){
                echo "<tr><td>";
                echo "<p>".$scuderia["nome"]." </td><td> ".$scuderia["vittorie"]."</p>";
                echo "</td></tr>";
            }
            echo "</table>";
        }
        else{
            echo "<table class='vincitori'>";
            echo "<h1 id='winPilots'>Scuderie with at least 3 Victories</h1>";
            echo "<tr><td>";
            echo "<p>No results</p>";
            echo "</td></tr>";
            echo "</table>";
        }

        $query3 = 'SELECT p.id, p.nome, p.cognome, COUNT(*) AS vittorie
        FROM pilota p
        JOIN partecipa pa ON p.id = pa.fkPilota
        WHERE pa.posizione = 1
        GROUP BY p.id, p.nome, p.cognome
        HAVING vittorie >= 3
        ORDER BY p.cognome, p.nome;';

        $result3 = $mydb->query($query3);

        if ($result3->num_rows > 0) {
        echo "<h1 id='winPilots'>Pilots with at least 3 Victories</h1>";
        echo "<table class='vincitori'>";
        echo "<tr><th>Nome</th><th>Cognome</th><th>Victories</th></tr>";

        while ($row = $result3->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["cognome"] . "</td><td>" . $row["vittorie"] . "</td></tr>";
        }

        echo "</table>";
        } else {
            echo "<table class='vincitori'>";
            echo "<h1 id='winPilots'>Pilots with at least 3 Victories</h1>";
            echo "<tr><td>";
            echo "<p>No results</p>";
            echo "</td></tr>";
            echo "</table>";
        }

        $query4 = 'SELECT s.nome AS team_name, SUM(sp.importo) AS total_income
        FROM scuderia s
        LEFT JOIN sponsorizza sp ON s.id = sp.fkScuderia
        GROUP BY s.nome
        ORDER BY total_income DESC;';

        $result4 = $mydb->query($query4);

        if ($result4) {
        echo "<h1 id='winPilots'>Teams by Total Sponsor Income</h1>";
        echo "<table class='vincitori'>";
        echo "<tr><th>Team Name</th><th>Total Income</th></tr>";

        while ($row = $result4->fetch_assoc()) {
            echo "<tr><td>" . $row["team_name"] . "</td><td>" . $row["total_income"] . "</td></tr>";
        }

        echo "</table>";
        } else {
            echo "<table class='vincitori'>";
            echo "<h1 id='winPilots'>Pilots with at least 3 Victories</h1>";
            echo "<tr><td>";
            echo "<p>No results</p>";
            echo "</td></tr>";
            echo "</table>";
        }

    ?>
    </body>
</html>
