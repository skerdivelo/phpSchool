<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Pokémon</title>
    <link rel="stylesheet" href="stile.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        h1 {
            margin: 0;
            padding: 0;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <h1>Elenco Pokémon</h1>
    </header>
    <main>
        <?php
            // Your PHP code here for database interactions
            /*instauro la connessione al database */
            require("config.php");  //file di config con i parametri di connessione
            $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
            if ($mydb->connect_errno) {
                echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                exit();  //termina la pagina
            }

            //query per prelevare l'elenco delle mama
            $query1 = "SELECT * FROM pokemon";
            //eseguo la query
            $risultato1 = $mydb->query($query1);

            // Check if there are results and display them
            if($risultato1->num_rows > 0){  
                echo "<table>";
                echo "<thead><tr><th>Nome</th><th>Tipo</th><th>Tipo 2</th></tr></thead>";
                echo "<tbody>";

                // Loop through the results, i.e., the list of Pokémon in the database
                while($pokemon = $risultato1->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$pokemon["nome"]."</td>";
                    echo "<td>".$pokemon["tipo"]."</td>";
                    echo "<td>".$pokemon["tipo2"]."</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>Non ci sono Pokémon nel database.</p>";
            }
        ?>
    </main>
</body>
</html>
