<!DOCTYPE html>
<html>
<head>
    <title>Film and Actors</title>
</head>
<body>

<form method="post" action="">
    <label for="film">Seleziona un film:</label>
    <select name="film" id="film">
        <?php
        require("config.php");
        $db = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
        if ($db->connect_errno) {
            echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            exit();
        }

        // Fetch the list of films
        $film_query = "SELECT id, titolo FROM film";
        $film_result = $db->query($film_query);

        if ($film_result->num_rows > 0) {
            while ($row = $film_result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['titolo'] . "</option>";
            }
        }

        $db->close();
        ?>
    </select>
    <input type="submit" value="Mostra Attori">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedFilmId = $_POST["film"];

    $db = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
    if ($db->connect_errno) {
        echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        exit();
    }

    $actors_query = "SELECT a.nome, a.cognome FROM attore a
                    INNER JOIN recita r ON a.id = r.fk_attore
                    WHERE r.fk_film = $selectedFilmId";

    $actors_result = $db->query($actors_query);

    if ($actors_result->num_rows > 0) {
        echo "<h2>Attori che recitano in questo film:</h2>";
        echo "<ul>";
        while ($row = $actors_result->fetch_assoc()) {
            echo "<li>" . $row['nome'] . " " . $row['cognome'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nessun attore trovato per questo film.</p>";
    }

    $db->close();
}
?>

</body>
</html>
