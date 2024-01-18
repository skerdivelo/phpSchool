<?php
    require("config.php");
    $mydb = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);
    if ($mydb->connect_errno) {
        echo "Errore nella connessione a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        exit();
    }

    $titolo = '';
    $attori = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titolo = $_POST['film'];
        $stmt = $mydb->prepare("
            SELECT attore.nome, attore.cognome 
            FROM attore 
            INNER JOIN recita ON attore.id = recita.fkAttore 
            INNER JOIN film ON recita.fkFilm = film.id 
            WHERE film.titolo = ?
        ");
        $stmt->bind_param("s", $titolo);
        $stmt->execute();
        $results = $stmt->get_result();
        while($row = $results->fetch_assoc()){
            $attori[] = $row["nome"] . ' ' . $row["cognome"];
        }
    }

    $stmt = $mydb->prepare("SELECT titolo FROM film");
    $stmt->execute();
    $results = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film</title>
</head>
<body>
    <form method="post">
        <select name="film">
            <?php
                if($results->num_rows>0){
                    while($row = $results->fetch_assoc()){
                        echo "<option ".($titolo == $row["titolo"] ? 'selected' : '').">".$row["titolo"]."</option>";
                    }
                }else{
                    echo "No results";
                }
            ?>
        </select>
        <input type="submit" value="Mostra Attori">
    </form>
    <?php
        if (!empty($attori)) {
            echo '<ul>';
            foreach ($attori as $attore) {
                echo '<li>' . $attore . '</li>';
            }
            echo '</ul>';
        }
    ?>
</body>
</html>
