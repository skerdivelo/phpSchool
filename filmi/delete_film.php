<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["film_name"])) {
        $film_name = htmlspecialchars($_POST["film_name"]);

        require("config.php");
        $conn = new mysqli(SERVER, UTENTE, PASSWORD, DATABASE);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $recita_query = "DELETE FROM recita WHERE fk_film IN (SELECT id FROM film WHERE titolo LIKE ?)";
        $stmt_recita = $conn->prepare($recita_query);
        $film_name_param = "%" . $film_name . "%";
        $stmt_recita->bind_param("s", $film_name_param);
        $stmt_recita->execute();
        $stmt_recita->close();

        $delete_query = "DELETE FROM film WHERE titolo LIKE ?";
        $stmt_film = $conn->prepare($delete_query);
        $stmt_film->bind_param("s", $film_name_param);

        if ($stmt_film->execute()) {
            $_SESSION["success_message"] = "Il film è stato cancellato con successo.";
        } else {
            $_SESSION["error_message"] = "Errore nella cancellazione del film: " . $conn->error;
        }

        $stmt_film->close();
        $conn->close();
    } else {
        $_SESSION["error_message"] = "Inserisci il nome del film.";
    }

    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cancellazione Film</title>
</head>
<body>

<?php
if (isset($_SESSION["error_message"])) {
    echo "<p style='color: red;'>" . $_SESSION["error_message"] . "</p>";
    unset($_SESSION["error_message"]);
}

if (isset($_SESSION["success_message"])) {
    echo "<p style='color: green;'>" . $_SESSION["success_message"] . "</p>";
    unset($_SESSION["success_message"]);
}
?>

<form method="post" action="">
    <label for="film_name">Inserisci il nome del film:</label>
    <input type="text" name="film_name" id="film_name" required>
    <input type="submit" value="Cancella Film">
</form>

</body>
</html>
